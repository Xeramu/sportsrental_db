<h3>Rental List</h3>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Equipment</th>
        <th>Member</th>
        <th>Rent Date</th>
        <th>Return Date</th>
        <th>Action</th>
    </tr>
    <?php foreach ($rental->getAllRentals() as $r): ?>
    <tr>
        <td><?= $r['id'] ?></td>
        <td><?= $r['equipment_name'] ?></td>
        <td><?= $r['member_name'] ?></td>
        <td><?= $r['rent_date'] ?></td>
        <td><?= $r['return_date'] ?? 'Not Returned' ?></td>
        <td>
            <?php if (!$r['return_date']): ?>
                <a href="?page=rentals&return=<?= $r['id'] ?>">Return</a>
            <?php endif; ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

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