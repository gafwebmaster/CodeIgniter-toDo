<?php if (isset($validation)): ?>
<div>
<?= $validation->listErrors() ?>
</div>
<?php endif ?>
<form action="/user/add" method="post">
	<input type="text" name="name" value="<?= set_value('name') ?>" placeholder="Name">
	<input type="text" name="email" value="<?= set_value('email') ?>" placeholder="Email">
	<input type="text" name="phone" value="<?= set_value('phone') ?>" placeholder="Phone">
	<input type="password" name="password" value="" placeholder="Password">
	<input type="password" name="password_confirm" value="" placeholder="Confirm Password">
	<button type="submit">Login</button>
</form>