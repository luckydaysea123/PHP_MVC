<main>
	<?php if (isset($DATA['message'])): ?>
	<p><?= Security::escape($DATA['message']); ?></p>
	<?php endif; ?>

	<form method="POST">
		<label>
			<span>Name:</span>
			<input type="text" name="department_name" required>
		</label>
        <label>
			<span>Address:</span>
			<input type="text" name="department_address" required>
		</label>
		<label>
			<span>Phone:</span>
			<textarea name="department_phone" required></textarea>
		</label>
		<button type="submit">Create</button>
	</form>
</main>
