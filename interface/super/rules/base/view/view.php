<p>
<?php out('Thanks for submitting your form.'); ?>
</p>

<p>
<?php out('This is what you submitted:') ?>
</p>

<ul>
    <li><?php out('Name')?>: <?= $viewBean->name ?></li>
    <li><?php out('Age')?>: <?= $viewBean->age?></li>
</ul>

<a href="/interface/super/rules/browse/index.php">Back</a>