<?php
require_once 'class/equipments.php';
$equipment = new Equipments();

$id = $_GET['id'] ?? null;

if ($id) {
    $equipment->deleteEquipment($id);
}

header("Location: ?page=equipments");
exit;
?>