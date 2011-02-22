<?php out('This is sample text.'); ?>

<form action="/interface/super/rules/index.php?action=test!submit" method="POST">
    <?php out('Name')?>: <input type="text" name="name"/>
    <?php out('Age')?>: <input type="text" name="age"/>
    <input type="submit"/>
</form>

<p>
    Click <a href="/interface/super/rules/index.php?action=test!forward">here</a> to be
    forwarded to an action with an undecorated view.
</p>

<p>
    Click <a href="/interface/super/rules/index.php?action=test!yahoo">here</a> to be
    redirected to Yahoo.
</p>

<p>
    Click <a href="/interface/super/rules/index.php?action=test!json">here</a> to get json.
</p>

