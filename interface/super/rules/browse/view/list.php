<?php out('This is sample text.'); ?>

<form action="/interface/super/rules/browse/index.php?action=submit" method="POST">
    <?php out('Name')?>: <input type="text" name="name" value='<? out($viewBean->name) ?>'/>
    <?php out('Age')?>: <input type="text" name="age" value='<? out($viewBean->age) ?>'/>
    <input type="submit"/>
</form>

<p>
    Click <a href="/interface/super/rules/browse/index.php?action=forward">here</a> to be
    forwarded to an action with an undecorated view.
</p>


<p>
    Click <a href="/interface/super/rules/browse/index.php?action=yahoo">here</a> to be
    redirected to Yahoo.
</p>