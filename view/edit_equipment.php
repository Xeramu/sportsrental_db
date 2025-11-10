<?php
require_once 'class/equipments.php';
$equipment = new Equipments();

// Ambil ID dari URL
$id = $_GET['id'] ?? null;
if (!$id) {
    echo "Equipment ID tidak ditemukan!";
    exit;
}

// Ambil data lama equipment
$data = $equipment->getEquipmentById($id);
if (!$data) {
    echo "Data equipment tidak ditemukan!";
    exit;
}

// Kalau form disubmit
if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $type = $_POST['type'];
    $brand = $_POST['brand'];
    $stock = $_POST['stock'];

    $equipment->updateEquipment($id, $name, $type, $brand, $stock);
    header("Location: ?page=equipments");
    exit;
}
?>

<h3>Edit Equipment</h3>

<form method="POST">
    <label>Name:</label><br>
    <input type="text" name="name" value="<?= htmlspecialchars($data['name']) ?>" required><br><br>

    <label>Type:</label><br>
    <input type="text" name="type" value="<?= htmlspecialchars($data['type']) ?>" required><br><br>

    <label>Brand:</label><br>
    <input type="text" name="brand" value="<?= htmlspecialchars($data['brand']) ?>"><br><br>

    <label>Stock:</label><br>
    <input type="number" name="stock" min="0" value="<?= htmlspecialchars($data['stock']) ?>" required><br><br>

    <button type="submit" name="update">Update Equipment</button>
</form>

<br>
<a href="?page=equipments">← Kembali ke daftar equipment</a>