<?php $allowed = $viewBean->allowed?>
<?php $ruleId = $viewBean->id;?>

<script type="text/javascript">
</script>

<table class="header">
  <tr>
        <td class="title"><?php out('Rule Edit'); ?></td>
        <td>
            <a href="index.php?action=detail!view&id=<?php echo $ruleId ?>" class="iframe_medium css_button">
                <span><?php out("Cancel") ?></span>
            </a>
        </td>
  </tr>
</table>

<div class="rule_detail edit text">
    <p class="header"><?php out('Add criteria'); ?> </p>
    <ul>
    <?php foreach ( $allowed as $type ) { ?>
        <li>
        <a href="index.php?action=edit!choose_criteria&id=<?php echo $ruleId?>&type=<?php echo $viewBean->type?>&criteriaType=<?php echo $type->code ?>"><?php echo $type->lbl; ?></a>
        </li>
    <?php } ?>
    </ul>
</div>