<?php
require_once 'config/config.php';
require_once 'equipments.php';
require_once 'members.php';

class Rentals {
    private $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }

    /* ===============================
       CREATE: Tambah data peminjaman
       =============================== */
    public function createRental($equipment_id, $member_id) {
        // Cek stok alat dulu
        $stmt = $this->db->prepare("SELECT stock FROM equipments WHERE id = ?");
        $stmt->execute([$equipment_id]);
        $equipmentData = $stmt->fetch();

        if ($equipmentData && $equipmentData['stock'] > 0) {
            // Kurangi stok alat
            $equipment = new Equipments();
            $equipment->updateStock($equipment_id, $equipmentData['stock'] - 1);

            // Tambah data rental
            $stmt = $this->db->prepare("
                INSERT INTO rentals (equipment_id, member_id, rent_date)
                VALUES (?, ?, CURDATE())
            ");
            return $stmt->execute([$equipment_id, $member_id]);
        }

        return false; // stok kosong
    }

    /* ===============================
       READ: Ambil semua data rental
       =============================== */
    public function getAllRentals() {
        $stmt = $this->db->prepare("
            SELECT rentals.*, 
                   equipments.name AS equipment_name, 
                   members.name AS member_name
            FROM rentals
            JOIN equipments ON rentals.equipment_id = equipments.id
            JOIN members ON rentals.member_id = members.id
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /* ===============================
       READ: Ambil satu data rental by ID
       =============================== */
    public function getRentalById($id) {
        $stmt = $this->db->prepare("
            SELECT rentals.*, 
                   equipments.name AS equipment_name, 
                   members.name AS member_name
            FROM rentals
            JOIN equipments ON rentals.equipment_id = equipments.id
            JOIN members ON rentals.member_id = members.id
            WHERE rentals.id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /* ===============================
       UPDATE: Pengembalian alat
       =============================== */
    public function returnEquipment($rental_id) {
        // Ambil data rental
        $stmt = $this->db->prepare("SELECT equipment_id FROM rentals WHERE id = ?");
        $stmt->execute([$rental_id]);
        $rental = $stmt->fetch();

        if ($rental) {
            // Ambil stok alat
            $stmt = $this->db->prepare("SELECT stock FROM equipments WHERE id = ?");
            $stmt->execute([$rental['equipment_id']]);
            $equipmentData = $stmt->fetch();

            // Update stok alat
            $equipment = new Equipments();
            $equipment->updateStock($rental['equipment_id'], $equipmentData['stock'] + 1);

            // Update tanggal pengembalian
            $stmt = $this->db->prepare("UPDATE rentals SET return_date = CURDATE() WHERE id = ?");
            return $stmt->execute([$rental_id]);
        }

        return false;
    }

    /* ===============================
       UPDATE: Edit data rental (opsional)
       =============================== */
    public function updateRental($id, $equipment_id, $member_id, $rent_date, $return_date = null) {
        $stmt = $this->db->prepare("
            UPDATE rentals 
            SET equipment_id = ?, member_id = ?, rent_date = ?, return_date = ?
            WHERE id = ?
        ");
        return $stmt->execute([$equipment_id, $member_id, $rent_date, $return_date, $id]);
    }

    /* ===============================
       DELETE: Hapus data rental
       =============================== */
    public function deleteRental($id) {
        // ambil dulu equipment_id biar stok bisa dikembalikan
        $stmt = $this->db->prepare("SELECT equipment_id FROM rentals WHERE id = ?");
        $stmt->execute([$id]);
        $rental = $stmt->fetch();

        if ($rental) {
            // ambil stok alat
            $stmt = $this->db->prepare("SELECT stock FROM equipments WHERE id = ?");
            $stmt->execute([$rental['equipment_id']]);
            $equipmentData = $stmt->fetch();

            // tambahkan stok kembali
            $equipment = new Equipments();
            $equipment->updateStock($rental['equipment_id'], $equipmentData['stock'] + 1);
        }

        // hapus data rental
        $stmt = $this->db->prepare("DELETE FROM rentals WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>