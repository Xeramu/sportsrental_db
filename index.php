<?php
require_once 'class/Equipments.php';
require_once 'class/Members.php';
require_once 'class/Rentals.php';

// Inisialisasi objek
$equipment = new Equipments();
$member = new Members();
$rental = new Rentals();

// Proses peminjaman alat
if (isset($_POST['borrow'])) {
    $rental->borrowEquipment($_POST['equipment_id'], $_POST['member_id']);
}

// Proses pengembalian alat
if (isset($_GET['return'])) {
    $rental->returnEquipment($_GET['return']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to El Sports Rentals</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'view/header.php'; ?>

    <main>
        <h2>Welcome to Sports Equipment Rental System</h2>
        <nav>
            <a href="?page=equipments">Equipments</a> |
            <a href="?page=members">Members</a> |
            <a href="?page=rentals">Rentals</a>
        </nav>

        <?php
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
            if ($page == 'equipments') include 'view/Viewequipments.php';
            elseif ($page == 'members') include 'view/Viewmembers.php';
            elseif ($page == 'rentals') include 'view/Viewrentals.php';
        }
        ?>
    </main>

    <?php include 'view/footer.php'; ?>
</body>
</html>