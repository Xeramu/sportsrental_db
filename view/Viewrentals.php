<h3>Rental List</h3>
<!-- nampilin tabel rental -->
<table border="1">
    <tr>
        <th>ID</th>
        <th>Equipment</th>
        <th>Member</th>
        <th>Rent Date</th>
        <th>Return Date</th>
        <th>Action</th>
    </tr>

    <?php 
    // ngambil smua tabel rental
    $rentals = $rental->getAllRentals();
    // klo ada data
    if (!empty($rentals)): ?>
        <?php foreach ($rentals as $r): ?>
        <tr>
            <td><?= htmlspecialchars($r['id']) ?></td>
            <td><?= htmlspecialchars($r['equipment_name']) ?></td>
            <td><?= htmlspecialchars($r['member_name']) ?></td>
            <td><?= htmlspecialchars($r['rent_date']) ?></td>
            <td><?= htmlspecialchars($r['return_date'] ?? 'Not Returned') ?></td>
            <td>
                <!-- kepage return, edit, sama delete rwntal -->
                <?php if (!$r['return_date']): ?>
                    <a href="?page=rentals&return=<?= $r['id'] ?>">Return</a> |
                <?php endif; ?>
                <a href="?page=edit_rental&id=<?= $r['id'] ?>">Edit</a> |
                <a href="?page=delete_rental&id=<?= $r['id'] ?>" onclick="return confirm('Yakin mau hapus rental ini?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <!-- klo blm ada data -->
        <tr>
            <td colspan="6" align="center">Belum ada data rental.</td>
        </tr>
    <?php endif; ?>
</table>

<!-- buat minjem alat -->
<h3>Borrow Equipment</h3>
<form method="POST">
    <label>Equipment:</label>
    <select name="equipment_id">
        <?php foreach ($equipment->getAllEquipments() as $e): ?>
            <option value="<?= $e['id'] ?>"><?= $e['name'] ?></option>
        <?php endforeach; ?>
    </select>

    <label>Member:</label>
    <select name="member_id">
        <?php foreach ($member->getAllMembers() as $m): ?>
            <option value="<?= $m['id'] ?>"><?= $m['name'] ?></option>
        <?php endforeach; ?>
    </select>

    <button type="submit" name="borrow">Borrow</button>
</form>