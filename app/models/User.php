<?php
class User extends BaseModel {
    public function create(array $data): int {
        $sql = "INSERT INTO users (name,email,password_hash,address,contact_no,dob,role)
                VALUES (:name,:email,:hash,:address,:contact_no,:dob,:role)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':name'=>$data['name'],
            ':email'=>$data['email'],
            ':hash'=>password_hash($data['password'], PASSWORD_BCRYPT),
            ':address'=>$data['address'] ?? null,
            ':contact_no'=>$data['contact_no'] ?? null,
            ':dob'=>$data['dob'] ?? null,
            ':role'=>$data['role'] ?? 'user',
        ]);
        return (int)$this->db->lastInsertId();
    }
    public function findByEmail(string $email): ?array {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email=? LIMIT 1");
        $stmt->execute([$email]);
        $u = $stmt->fetch(PDO::FETCH_ASSOC);
        return $u ?: null;
    }
    public function findById(int $id): ?array {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id=?");
        $stmt->execute([$id]);
        $u = $stmt->fetch(PDO::FETCH_ASSOC);
        return $u ?: null;
    }
}
