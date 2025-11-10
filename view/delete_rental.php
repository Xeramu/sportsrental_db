<?php
require_once 'class/Rentals.php';
$rental = new Rentals();

$id = $_GET['id'] ?? null;

if ($id) {
    $rental->deleteRental($id);
}

header("Location: ?page=rentals");
exit;
?>