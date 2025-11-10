<?php
require_once 'class/members.php';
$member = new Members();

// buat nambah member baru
if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // idnya aku buat auto_increment, jdnya gaperlu dimasukin sama kita
    $member->createMember(null, $name, $email, $phone);

    // refresh halaman biar tabel lgsng terupdate
    header("Location: ?page=members");
    exit;
}

// ambil semua data member
$members = $member->getAllMembers();
?>

<!-- tampilan tabel member -->
<h3>Member List</h3>
<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Action</th>
    </tr>

    <!-- klo ada data -->
    <?php if (!empty($members)): ?>
        <?php foreach ($members as $m): ?>
            <tr>
                <td><?= htmlspecialchars($m['id']) ?></td>
                <td><?= htmlspecialchars($m['name']) ?></td>
                <td><?= htmlspecialchars($m['email']) ?></td>
                <td><?= htmlspecialchars($m['phone']) ?></td>
                <td>
                    <!-- link ke halaman edit sama delete -->
                    <a href="?page=edit_member&id=<?= $m['id'] ?>">Edit</a> |
                    <a href="?page=delete_member&id=<?= $m['id'] ?>" onclick="return confirm('Yakin mau hapus member ini?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <!-- klo blm ada data -->
        <tr>
            <td colspan="5" align="center">Belum ada data member.</td>
        </tr>
    <?php endif; ?>
</table>

<!-- form nambah member -->
<h3>Add New Member</h3>
<form method="POST">
    <label>Name:</label><br>
    <input type="text" name="name" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Phone:</label><br>
    <input type="text" name="phone" required><br><br>

    <button type="submit" name="add">Add Member</button>
</form>