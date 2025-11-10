<?php
require_once 'class/equipments.php';
require_once 'class/members.php';
require_once 'class/rentals.php';

// inisialisasi objek class
$equipment = new Equipments();
$member = new Members();
$rental = new Rentals();

// proses minjem alat dr fungsi rentals alias create
if (isset($_POST['borrow'])) {
    $rental->createRental($_POST['equipment_id'], $_POST['member_id']); 
}

// proses pengembalian alat
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
    <!-- header halaman -->
    <?php include 'view/header.php'; ?>

    <main>
        <h2>Welcome to Sports Equipment Rental System</h2>

        <!-- navgiasgi antar halaman -->
        <nav>
            <a href="?page=equipments">Equipments</a> |
            <a href="?page=members">Members</a> |
            <a href="?page=rentals">Rentals</a>
        </nav>
        <hr>

        <?php
        // routing halaman berdasarkan parameter
        if (isset($_GET['page'])) {
            $page = $_GET['page'];

            // tampilkan halaman sesuai pilihan menu
            if ($page == 'equipments') {
                include 'view/Viewequipments.php';
            } elseif ($page == 'members') {
                include 'view/Viewmembers.php';
            } elseif ($page == 'rentals') {
                include 'view/Viewrentals.php';
            } 
            // rputing CRUD buat member
            elseif ($page == 'edit_member') {
                include 'view/edit_member.php';
            } elseif ($page == 'delete_member') {
                include 'view/delete_member.php';
            }
            // routing CRUD buat equimenpst
            elseif ($page == 'edit_equipment') {
                include 'view/edit_equipment.php';
            } elseif ($page == 'delete_equipment') {
                include 'view/delete_equipment.php';
            }
            // routing CRUD buat rental
            elseif ($page == 'edit_rental') {
                include 'view/edit_rental.php';
            } elseif ($page == 'delete_rental') {
                include 'view/delete_rental.php';
            }
            // klo parameter engga dikenali
            else {
                echo "<p>Halaman tidak ditemukan.</p>";
            }
        } else {
            echo "<p>Silakan pilih menu di atas untuk mulai.</p>";
        }
        ?>
    </main>

    <!-- footer -->
    <?php include 'view/footer.php'; ?>
</body>
</html>