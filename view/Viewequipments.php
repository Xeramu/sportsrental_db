<h3>Equipment List</h3>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Type</th>
        <th>Brand</th>
        <th>Stock</th>
    </tr>
    <?php foreach ($equipment->getAllEquipments() as $b): ?>
    <tr>
        <td><?= $b['id'] ?></td>
        <td><?= $b['name'] ?></td>
        <td><?= $b['type'] ?></td>
        <td><?= $b['brand'] ?></td>
        <td><?= $b['stock'] ?></td>
    </tr>
    <?php endforeach; ?>
</table>