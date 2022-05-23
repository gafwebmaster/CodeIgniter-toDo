<?php if (isset($validation)): ?>
<div>
<?= $validation->listErrors() ?>
</div>
<?php endif ?>

<?php if (session()->get('success')): ?>
	<?= session()->get('success') ?>
<?php endif ?>

<form action="/users/profile" method="post">
	<input type="text" name="name" value="<?= $user['name'] ?>" >
	<input type="text" name="email" value="<?= $user['email'] ?>" >
	<input type="text" name="phone" value="<?= $user['phone'] ?>" >
	<input type="password" name="password" value="" placeholder="Password">
	<input type="password" name="password_confirm" value="" placeholder="Confirm Password">
	<button type="submit">Update</button>
</form>