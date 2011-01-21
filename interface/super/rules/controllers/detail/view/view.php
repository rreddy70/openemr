<table class="header">
  <tr >
        <td class="title"><?php out('Rule Detail'); ?></td>
        <td>
            <a href="index.php?action=browse!list" class="iframe_medium css_button"><span>Back</span></a>
        </td>
  </tr>
</table>

<div class="rule_detail">
    <p class="summary">
        <span><?php out('Title'); ?></span>
        <span><?php out($viewBean->rule->title) ?></span>
    </p>
    <p>
        <span><?php out('Type'); ?></span>
        <span>
            <?php foreach($viewBean->rule->ruleTypes as $type) {?>
                <?php out($type) ?>
            <?php } ?>
        </span>
    </p>
</div>