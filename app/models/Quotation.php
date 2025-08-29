<?php
class Quotation extends BaseModel {
    public function create(int $prescriptionId, int $pharmacyUserId, array $items): int {
        $this->db->beginTransaction();
        try {
            $q = $this->db->prepare("INSERT INTO quotations (prescription_id, pharmacy_user_id, total) VALUES (?,?,0)");
            $q->execute([$prescriptionId, $pharmacyUserId]);
            $qid = (int)$this->db->lastInsertId();

            $total = 0;
            $qi = $this->db->prepare(
                "INSERT INTO quotation_items (quotation_id, drug_name, quantity, unit_price, line_total)
                 VALUES (?,?,?,?,?)"
            );
            foreach ($items as $it) {
                $lt = (float)$it['quantity'] * (float)$it['unit_price'];
                $total += $lt;
                $qi->execute([$qid, $it['drug_name'], (int)$it['quantity'], (float)$it['unit_price'], $lt]);
            }
            $u = $this->db->prepare("UPDATE quotations SET total=? WHERE id=?");
            $u->execute([$total, $qid]);

            $this->db->commit();
            return $qid;
        } catch (Throwable $e) {
            $this->db->rollBack(); throw $e;
        }
    }

    public function updateOrCreate(int $prescriptionId, int $pharmacyUserId, array $items): int {
        // Check if quotation already exists
        $existing = $this->findByPrescription($prescriptionId);
        
        if ($existing) {
            // Update existing quotation
            $this->db->beginTransaction();
            try {
                $qid = (int)$existing['id'];
                
                // Delete existing items
                $deleteItems = $this->db->prepare("DELETE FROM quotation_items WHERE quotation_id = ?");
                $deleteItems->execute([$qid]);
                
                // Add new items
                $total = 0;
                $qi = $this->db->prepare(
                    "INSERT INTO quotation_items (quotation_id, drug_name, quantity, unit_price, line_total)
                     VALUES (?,?,?,?,?)"
                );
                foreach ($items as $it) {
                    $lt = (float)$it['quantity'] * (float)$it['unit_price'];
                    $total += $lt;
                    $qi->execute([$qid, $it['drug_name'], (int)$it['quantity'], (float)$it['unit_price'], $lt]);
                }
                
                // Update quotation total and reset status to 'sent'
                $u = $this->db->prepare("UPDATE quotations SET total=?, status='sent', updated_at=NOW() WHERE id=?");
                $u->execute([$total, $qid]);

                $this->db->commit();
                return $qid;
            } catch (Throwable $e) {
                $this->db->rollBack(); 
                throw $e;
            }
        } else {
            // Create new quotation
            return $this->create($prescriptionId, $pharmacyUserId, $items);
        }
    }
    public function findByPrescription(int $prescriptionId): ?array {
        $stmt = $this->db->prepare("SELECT * FROM quotations WHERE prescription_id=? LIMIT 1");
        $stmt->execute([$prescriptionId]);
        $q = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$q) return null;
        $items = $this->db->prepare("SELECT * FROM quotation_items WHERE quotation_id=?");
        $items->execute([$q['id']]);
        $q['items'] = $items->fetchAll(PDO::FETCH_ASSOC);
        return $q;
    }
    public function setStatus(int $quotationId, string $status): void {
        $stmt = $this->db->prepare("UPDATE quotations SET status=? WHERE id=?");
        $stmt->execute([$status, $quotationId]);
    }
    public function findWithUser(int $quotationId): ?array {
        $stmt = $this->db->prepare("SELECT q.*, p.user_id, u.email AS user_email
                                    FROM quotations q
                                    JOIN prescriptions p ON p.id=q.prescription_id
                                    JOIN users u ON u.id=p.user_id
                                    WHERE q.id=?");
        $stmt->execute([$quotationId]);
        $q = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$q) return null;
        $items = $this->db->prepare("SELECT * FROM quotation_items WHERE quotation_id=?");
        $items->execute([$q['id']]);
        $q['items'] = $items->fetchAll(PDO::FETCH_ASSOC);
        return $q;
    }
}
