<?php
class Prescription extends BaseModel {
    public function create(int $userId, string $note, string $address, string $slot): int {
        $stmt = $this->db->prepare(
          "INSERT INTO prescriptions (user_id, note, delivery_address, delivery_slot)
           VALUES (?,?,?,?)"
        );
        $stmt->execute([$userId, $note, $address, $slot]);
        return (int)$this->db->lastInsertId();
    }
    public function addImage(int $prescriptionId, string $path): void {
        $stmt = $this->db->prepare("INSERT INTO prescription_images (prescription_id, path) VALUES (?,?)");
        $stmt->execute([$prescriptionId, $path]);
    }
    public function forUser(int $userId): array {
        $stmt = $this->db->prepare("SELECT * FROM prescriptions WHERE user_id=? ORDER BY created_at DESC");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function all(): array {
        return $this->db->query("SELECT p.*, u.name AS user_name FROM prescriptions p
                                 JOIN users u ON u.id=p.user_id
                                 ORDER BY p.created_at DESC")->fetchAll(PDO::FETCH_ASSOC);
    }
    public function findWithImages(int $id): ?array {
        $stmt = $this->db->prepare("SELECT * FROM prescriptions WHERE id=?");
        $stmt->execute([$id]);
        $p = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$p) return null;
        $imgs = $this->db->prepare("SELECT * FROM prescription_images WHERE prescription_id=?");
        $imgs->execute([$id]);
        $p['images'] = $imgs->fetchAll(PDO::FETCH_ASSOC);
        return $p;
    }
    public function setStatus(int $id, string $status): void {
        $stmt = $this->db->prepare("UPDATE prescriptions SET status=? WHERE id=?");
        $stmt->execute([$status, $id]);
    }
}
