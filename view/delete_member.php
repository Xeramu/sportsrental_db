<?php
require_once 'class/members.php';
$member = new Members();

$id = $_GET['id'] ?? null;

if ($id) {
    $member->deleteMember($id);
}

header("Location: ?page=members");
exit;
?>