<?php $rule = $viewBean->rule ?>
<?php $intervals = $rule->reminderIntervals ?>

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

<div class="rule_detail edit text">
    <p class="header"><?php out('Reminder intervals'); ?> </p>

    <form action="index.php?action=edit!submit_intervals" method="post" id="frm_submit">
    <input type="hidden" name="id" value="<?php echo $rule->id ?>"/>

    <div class="intervals">
        <p>
            <span class="left_col colhead"><u><?php out("Type") ?></u></span>
            <span class="end_col colhead"><u><?php out("Detail") ?></u></span>
        </p>

    <?php foreach( ReminderIntervalType::values() as $type ) { ?>
    <?php foreach( ReminderIntervalRange::values() as $range ) { ?>
    <?php $first = true; $detail = $intervals->getDetailFor( $type, $range ); ?>
        <p>
            <span class="left_col <?php echo $first ? "req" : ""?>" data-grp="<?php echo $type->code ?>"><?php echo $type->lbl ?></span>
            <span class="mid_col"><?php echo $range->lbl ?></span>
            <span class="mid_col">
                <input data-grp-tgt="<?php echo $type->code ?>"
                       type="text"
                       name="<?php echo $type->code ?>-<?php echo $range->code ?>"
                       value="<?php echo is_null( $detail ) ? "" : $detail->amount ?>" />
            </span>
            <span class="end_col">
                <select data-grp-tgt="<?php echo $type->code ?>" type="dropdown" name="<?php echo $type->code ?>-<?php echo $range->code ?>-timeunit">
                    <option id="">--<?php out("Select"); ?>--</option>
                    <?php foreach( TimeUnit::values() as $unit ) { ?>
                    <option id="<?php echo $unit->code ?>" value="<?php echo $unit->code ?>" <?php echo $detail->timeUnit == $unit ? "SELECTED" : "" ?>>
                            <?php echo $unit->lbl ?>
                    </option>
                    <?php } ?>
                </select>
            </span>
        </p>
    <?php $first = false; ?>
    <?php } ?>
    <?php } ?>

    </div>

    </form>
    
</div>

<div id="required_msg" class="small">
    <span class="required">*</span><?php out("Required fields"); ?>
</div>
