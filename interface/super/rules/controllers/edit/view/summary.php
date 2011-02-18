<?php $rule = $viewBean->rule ?>

<script language="javascript" src="<?php js_src('edit.js') ?>"></script>
<script type="text/javascript">
    var edit = new rule_edit( {});
    edit.init();
</script>

<table class="header">
  <tr>
        <td class="title"><?php out('Rule Edit'); ?></td>
        <td>
            <a href="index.php?action=detail!view&id=<?php echo $rule->id ?>" class="iframe_medium css_button">
                <span><?php out("Cancel") ?></span>
            </a>
            <a href="javascript:;" class="iframe_medium css_button" id="btn_save"><span><?php out("Save") ?></span></a>
        </td>
  </tr>
</table>

<div class="rule_detail edit summry text">
    <p class="header"><?php out('Summary'); ?> </p>

    <form action="index.php?action=edit!submit_summary" method="post" id="frm_submit">
    <input type="hidden" name="id" value="<?php echo $rule->id ?>"/>

    <p class="row">
    <span class="left_col colhead req" data-fld="fld_title"><?php out("Title") ?></span>
    <span class="end_col"><input type="text" name="fld_title" class="field" id="fld_title" value="<?php echo $rule->title ?>"></span>
    </p>
    
    <p class="row">
    <span class="left_col colhead req" data-fld="fld_ruleTypes[]"><?php out("Type") ?></span>
    <span class="end_col">
        <?php foreach ( RuleType::values() as $type ) {?>
        <input name="fld_ruleTypes[]"
               value="<?php echo $type ?>"
               type="checkbox" <?php echo $rule->hasRuleType(RuleType::from($type)) ? "CHECKED": "" ?>>
        <?php echo RuleType::from($type)->lbl ?>
        <?php } ?>
    </span>
    </p>

    </form>
    
</div>

<div id="required_msg" class="small">
    <span class="required">*</span>Required fields
</div>
