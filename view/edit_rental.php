<?php
require_once 'class/Rentals.php';
require_once 'class/Equipments.php';
require_once 'class/Members.php';

$rental = new Rentals();
$equipment = new Equipments();
$member = new Members();

$id = $_GET['id'] ?? null;
$data = $rental->getRentalById($id);

if (!$data) {
    echo "<p>Rental tidak ditemukan.</p>";
    exit;
}

if (isset($_POST['update'])) {
    $rental->updateRental($id, $_POST['equipment_id'], $_POST['member_id'], $_POST['rent_date'], $_POST['return_date']);
    header("Location: ?page=rentals");
    exit;
}
?>

<h3>Edit Rental</h3>
<form method="POST">
    <label>Equipment:</label>
    <select name="equipment_id">
        <?php foreach ($equipment->getAllEquipments() as $e): ?>
            <option value="<?= $e['id'] ?>" <?= $e['id'] == $data['equipment_id'] ? 'selected' : '' ?>><?= $e['name'] ?></option>
        <?php endforeach; ?>
    </select>

    <label>Member:</label>
    <select name="member_id">
        <?php foreach ($member->getAllMembers() as $m): ?>
            <option value="<?= $m['id'] ?>" <?= $m['id'] == $data['member_id'] ? 'selected' : '' ?>><?= $m['name'] ?></option>
        <?php endforeach; ?>
    </select>

    <label>Rent Date:</label>
    <input type="date" name="rent_date" value="<?= $data['rent_date'] ?>" required>

    <label>Return Date:</label>
    <input type="date" name="return_date" value="<?= $data['return_date'] ?>">

    <button type="submit" name="update">Update Rental</button>
</form>