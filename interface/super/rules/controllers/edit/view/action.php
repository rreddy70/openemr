<?php $action = $viewBean->action?>
<?php $rule = $viewBean->rule?>

<script language="javascript" src="<?php js_src('edit.js') ?>"></script>
<script language="javascript" src="<?php js_src('bucket.js') ?>"></script>
<script type="text/javascript">
    var edit = new rule_edit( {});
    edit.init();

    var bucket = new bucket( {} );
    bucket.init();
</script>

<table class="header">
  <tr>
        <td class="title"><?php out('Rule Edit'); ?></td>
        <td>
            <a href="index.php?action=detail!view&id=<?php echo $action->id ?>" class="iframe_medium css_button">
                <span><?php out("Cancel") ?></span>
            </a>
            <a href="javascript:;" class="iframe_medium css_button" id="btn_save"><span><?php out("Save") ?></span></a>
        </td>
  </tr>
</table>

<div class="rule_detail edit text">
    <p class="header"><?php out('Action'); ?> </p>

    <form action="index.php?action=edit!submit_action" method="post" id="frm_submit">
    <input type="hidden" name="guid" value="<?php echo $action->guid ?>"/>
    <input type="hidden" name="id" value="<?php echo $action->id ?>"/>
    <input type="hidden" name="group_id" value="<?php echo $action->groupId ?>"/>

    <!-- custom rules input -->
    <p class="row">
        <span class="left_col colhead req" data-field="fld_target"><?php out('For target'); ?></span>
        <span class="end_col">
            <select data-grp-tgt="" type="dropdown" name="fld_target" id="">
                <option id="" value="">--<?php out("Select"); ?>--</option>
                <?php foreach( $rule->targets->criteria as $criteria ) { ?>
                <option id="<?php echo $criteria->guid?>" 
                        value="<?php echo $criteria->guid?>"
                        <?php echo $action->targetCriteria->guid == $criteria->guid ? "SELECTED" : "" ?>>
                        <?php echo $criteria->getTitle()?>
                </option>
                <?php } ?>
            </select>
        </span>
    </p>

    <!-- category -->
    <?php echo textfield_row(array("id" => "fld_category_lbl",
                                   "name" => "fld_category_lbl",
                                   "title" => xl("Category"),
                                   "value" => $action->getCategoryLabel() ) ); ?>
    <br/><a href="javascript:;" id="change_category">(change)</a>
    <input type="hidden" id="fld_category" name="fld_category" value="<?php echo $action->category?>" />

    <!-- item -->
    <?php echo textfield_row(array("id" => "fld_item_lbl",
                                   "name" => "fld_item_lbl",
                                   "title" => xl("Item"),
                                   "value" => $action->getItemLabel() ) ); ?>
    <br/><a href="javascript:;" id="change_item">(change)</a>
    <input type="hidden" id="fld_item" name="fld_item" value="<?php echo $action->item?>" />

    <!-- reminder link  -->
    <?php echo textfield_row(array("id" => "fld_link",
                                   "name" => "fld_link",
                                   "title" => xl("Link"),
                                   "value" => $action->reminderLink ) ); ?>

    <!-- reminder message  -->
    <?php echo textfield_row(array("id" => "fld_message",
                                   "name" => "fld_message",
                                   "title" => xl("Message"),
                                   "value" => $action->reminderMessage ) ); ?>


    <!-- custom rules input -->
    <p class="row">
        <span class="left_col colhead req" data-field="fld_custom_input"><?php out('Custom input?'); ?></span>
        <span class="end_col">
            <select data-grp-tgt="" type="dropdown" name="fld_custom_input" id="">
                <option id="" value="">--<?php out("Select"); ?>--</option>
                <option id="Yes" value="yes" <?php echo $action->customRulesInput ? "SELECTED" : "" ?>><?php out("Yes");?></option>
                <option id="No" value="no" <?php echo !$action->completed ? "SELECTED" : "" ?>><?php out("No");?></option>
            </select>
        </span>
    </p>

    </form>

</div>

<div id="required_msg" class="small">
    <span class="required">*</span><?php out("Required fields"); ?>
</div>
