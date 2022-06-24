<ul>
    <?php foreach ($users as $user): ?>
    <li><?= $user->name ?> | <?= $user->email ?> | <?= $user->phone ?> | <?= $user->level_access ?> | <a href="/user/profile/<?= $user->id ?>">Edit</a></li>
    <?php endforeach ?>
</ul>