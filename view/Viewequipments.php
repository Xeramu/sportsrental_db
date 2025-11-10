<?php
require_once 'class/equipments.php';
$equipment = new Equipments();

// tambah equipment baru
if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $type = $_POST['type'];
    $brand = $_POST['brand'];
    $stock = $_POST['stock'];

    // manggil fungsi createequipment dari class equipments
    $equipment->createEquipment($name, $type, $brand, $stock);

    // refresh halaman biar tabel lgsng terupdate
    header("Location: ?page=equipments");
    exit;
}

// ambil semua data equipment
$equipments = $equipment->getAllEquipments();
?>

<!-- tampilan dafter equipment -->
<h3>Equipment List</h3>
<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Type</th>
        <th>Brand</th>
        <th>Stock</th>
        <th>Action</th>
    </tr>

    <!-- klo ada data -->
    <?php if (!empty($equipments)): ?>
        <?php foreach ($equipments as $b): ?>
            <tr>
                <td><?= htmlspecialchars($b['id']) ?></td>
                <td><?= htmlspecialchars($b['name']) ?></td>
                <td><?= htmlspecialchars($b['type']) ?></td>
                <td><?= htmlspecialchars($b['brand']) ?></td>
                <td><?= htmlspecialchars($b['stock']) ?></td>
                <td>
                    <!-- link ke halaman edit sama delete -->
                    <a href="?page=edit_equipment&id=<?= $b['id'] ?>">Edit</a> |
                    <a href="?page=delete_equipment&id=<?= $b['id'] ?>" onclick="return confirm('Yakin mau hapus equipment ini?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <!-- klo blm ada data -->
        <tr>
            <td colspan="6" align="center">Belum ada data equipment.</td>
        </tr>
    <?php endif; ?>
</table>

<!-- form buat nambah equipment baru -->
<h3>Add New Equipment</h3>
<form method="POST">
    <label>Name:</label><br>
    <input type="text" name="name" required><br><br>

    <label>Type:</label><br>
    <input type="text" name="type" required><br><br>

    <label>Brand:</label><br>
    <input type="text" name="brand"><br><br>

    <label>Stock:</label><br>
    <input type="number" name="stock" min="0" required><br><br>

    <button type="submit" name="add">Add Equipment</button>
</form>