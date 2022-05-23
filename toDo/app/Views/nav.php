<?php
$uri = service('uri');
if(session()->get('isLoggedIn')): ?>
    <hr>
        <strong>Manager</strong>
        <a href="/">Users list</a>
        <a href="/users/add">Add User</a>        
        <a href="/users/forgot_password">Forgot Password</a>
        <a href="">Logs</a>
        <a href="/users/logout">Logout</a>
    <hr>
        <strong>Users</strong>
        <a href="/users/profile">Profile</a>
        <a href="/tasks">Tasks</a>
        <a href="/task/add">Add Task</a>
    <hr>
<?php else: ?>
    <hr>
        <a href="/">Login</a>
        <a href="/user/add">Create new account</a>        
<?php endif; ?>