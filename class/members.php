<?php
require_once 'config/config.php';

class Members {
    private $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }

    // CREATE: nambah member
    public function createMember($id, $name, $email, $phone) {
        $stmt = $this->db->prepare("
            INSERT INTO members (id, name, email, phone)
            VALUES (?, ?, ?, ?)
        ");
        return $stmt->execute([$id, $name, $email, $phone]);
    }

    // READ: ambil smua data member
    public function getAllMembers() {
        $stmt = $this->db->prepare("SELECT * FROM members");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // READ (by ID): ambil data member bersasarkan id
    public function getMemberById($id) {
        $stmt = $this->db->prepare("SELECT * FROM members WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // UPDATE: ubah data member
    public function updateMember($id, $name, $email, $phone) {
        $stmt = $this->db->prepare("
            UPDATE members 
            SET name = ?, email = ?, phone = ? 
            WHERE id = ?
        ");
        return $stmt->execute([$name, $email, $phone, $id]);
    }

     // DELETE: hapus member by id
    public function deleteMember($id) {
        $stmt = $this->db->prepare("DELETE FROM members WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>