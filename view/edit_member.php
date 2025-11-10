<?php
require_once 'class/members.php';
$member = new Members();

// Ambil ID dari URL
$id = $_GET['id'] ?? null;
if (!$id) {
    echo "Member ID tidak ditemukan!";
    exit;
}

// Ambil data lama member
$data = $member->getMemberById($id);

// Kalau form disubmit
if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $member->updateMember($id, $name, $email, $phone);
    header("Location: ?page=members");
    exit;
}
?>

<h3>Edit Member</h3>
<form method="POST">
    <label>Name:</label><br>
    <input type="text" name="name" value="<?= htmlspecialchars($data['name']) ?>" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" value="<?= htmlspecialchars($data['email']) ?>" required><br><br>

    <label>Phone:</label><br>
    <input type="text" name="phone" value="<?= htmlspecialchars($data['phone']) ?>" required><br><br>

    <button type="submit" name="update">Update Member</button>
</form>

<br>
<a href="?page=members">← Kembali</a>