<?php
require_once 'config/config.php';

class Equipments {
    private $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }

    // CREATE: nambah alat baru
    public function createEquipment($name, $type, $brand, $stock) {
        $stmt = $this->db->prepare("
            INSERT INTO equipments (name, type, brand, stock)
            VALUES (?, ?, ?, ?)
        ");
        return $stmt->execute([$name, $type, $brand, $stock]);
    }

    // READ: ambil semua data alat
    public function getAllEquipments() {
        $stmt = $this->db->prepare("SELECT * FROM equipments");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // READ (by ID): ambil data alat bersasarkan id
    public function getEquipmentById($id) {
        $stmt = $this->db->prepare("SELECT * FROM equipments WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // UPDATE: ubah smua data alat
    public function updateEquipment($id, $name, $type, $brand, $stock) {
        $stmt = $this->db->prepare("
            UPDATE equipments 
            SET name = ?, type = ?, brand = ?, stock = ?
            WHERE id = ?
        ");
        return $stmt->execute([$name, $type, $brand, $stock, $id]);
    }

    // UPDATE: ubah stok alat aja. Ntar kepake buat rentals
    public function updateStock($id, $stock) {
        $stmt = $this->db->prepare("UPDATE equipments SET stock = ? WHERE id = ?");
        return $stmt->execute([$stock, $id]);
    }

    // DELETE: hapus alat by id
    public function deleteEquipment($id) {
        $stmt = $this->db->prepare("DELETE FROM equipments WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>