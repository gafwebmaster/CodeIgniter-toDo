<?php if (session()->get('success')): ?>
	<?= session()->get('success') ?>
<?php endif ?>

<?php if (isset($validation)): ?>
<div>
<?= $validation->listErrors() ?>
</div>
<?php endif ?>

<form action="/" method="post">
	<input type="text" name="email" value="<?= set_value('email') ?>" placeholder="Email">
	<input type="text" name="password" value="" placeholder="Password">
	<button type="submit">Login</button>
</form>


