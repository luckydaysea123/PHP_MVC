<main>
	<?php if (empty($DATA['departments'])): ?>
	<p>Department list is currently empty.</p>
	<?php else: ?>
	<div class="table-responsive">
		<table>
			<thead>
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Address</th>
					<th>Phone</th>
                    <th colspan="2">Action</th>
			</thead>
			<tbody>
				<?php foreach ($DATA['departments'] as $department): ?>
				<tr>
					<td><?= Security::escape($department->department_id); ?></td>
					<td><?= Security::escape($department->department_name); ?></td>
					<td><?= Security::escape($department->department_address); ?></td>
					<td><?= Security::escape($department->department_phone); ?></td>
					<td>
						<a href="<?= Utils::generateLink('departments/update/' . $department->department_id) ?>">
							Update
						</a>
					</td>
					<td>
						<a onclick="return confirm('Are you sure?');" href="<?= Utils::generateLink('departments/delete/' . $department->department_id) ?>">
							Delete
						</a>
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	<?php endif; ?>

	<p>
		<a href="<?= Utils::generateLink('departments/create'); ?>">Add Department</a>
	</p>
</main>
