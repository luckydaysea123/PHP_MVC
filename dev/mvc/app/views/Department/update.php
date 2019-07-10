<main>
	<?php if (isset($DATA['message'])): ?>
	<p><?= Security::escape($DATA['message']); ?></p>
	<?php endif; ?>

	<?php if (!$DATA['department']): ?>
	<p>/</p>
	<?php else: ?>
	<form method="POST">
		<input type="hidden" name="id" value="<?= Security::escape($DATA['department']->department_id); ?>">
		<label>
			<span>Name:</span>
			<input type="text" name="name" value="<?= Security::escape($DATA['department']->department_name); ?>" required>
		</label>
		<label>
			<span>Address:</span>
			<input type="text" name="address" value="<?= Security::escape($DATA['department']->department_address); ?>" required>
		</label>
        <label>
			<span>Phone:</span>
			<input type="text" name="phone" value="<?= Security::escape($DATA['department']->department_phone); ?>" required>
		</label>
		<button type="submit">Update</button>
	</form>
	<?php endif; ?>
</main>
