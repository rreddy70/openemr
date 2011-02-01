<?php $rule = $viewBean->rule ?>

<script language="javascript" src="<?php js_src('detail.js') ?>"></script>
<script type="text/javascript">
    var detail = new rule_detail( {editable: <?php echo $rule->isEditable() ? "true":"false"; ?>});
    detail.init();
</script>

<table class="header">
  <tr >
        <td class="title"><?php out('Rule Detail'); ?></td>
        <td>
            <a href="index.php?action=browse!list" class="iframe_medium css_button"><span>Back</span></a>
        </td>
  </tr>
</table>

<div class="rule_detail">
    <!-- summary -->
    <div class="section text">
        <p class="header">
            <?php out('Summary'); ?>
            <a href="index.php?action=edit!summary&id=<?php echo $rule->id ?>"
               class="action_link" id="edit_summary">(<?php out('edit') ?>)</a>
        </p>
        <p><b><?php echo $rule->title ?></b>
        (<?php echo implode( ", ", $rule->getRuleTypeLabels() ); ?>)
        </p>
    </div>

    <!-- reminder intervals -->
    <?php $intervals = $rule->reminderIntervals; if ( $intervals) { ?>
    <div class="section text">
        <p class="header"><?php out('Reminder intervals'); ?> <a href="index.php?action=edit!intervals&id=<?php echo $rule->id ?>" class="action_link">(<?php out('edit') ?>)</a></p>

        <p>
            <div>
                <span class="left_col colhead"><u><?php out("Type") ?></u></span>
                <span class="end_col colhead"><u><?php out("Detail") ?></u></span>
            </div>

            <?php foreach($intervals->getTypes() as $type) {?>
                <div>
                <span class="left_col"><?php echo $type->lbl ?></span>
                <span class="end_col">
                    <?php echo $intervals->displayDetails( $type ) ?>
                </span>
                </div>
            <?php } ?>
        </p>
    </div>
    <?php } ?>

    <!-- rule filter criteria -->
    <?php $filters = $rule->filters; if ( $filters ) { ?>
    <div class="section text">
        <p class="header"><?php out('Demographics filter criteria'); ?> <a href="" class="action_link">(add)</a></p>
        <p>
            <div>
                <span class="left_col">&nbsp;</span>
                <span class="mid_col"><u><?php out("Criteria") ?></u></span>
                <span class="mid_col"><u><?php out("Characteristics") ?></u></span>
                <span class="end_col"><u><?php out("Requirements") ?></u></span>
            </div>

            <?php foreach($filters->criteria as $criteria) { ?> 
                <div>
                    <span class="left_col">
                        <a href="index.php?action=edit!filter&id=<?php echo $rule->id ?>&guid=<?php echo $criteria->guid ?>" class="action_link">(<?php out('edit') ?>)</a>
                        <a href="index.php?action=delete!filter&id=<?php echo $rule->id ?>&guid=<?php echo $criteria->guid ?>" class="action_link">(delete)</a></span>
                    <span class="mid_col"><?php echo( $criteria->getTitle() ) ?></span>
                    <span class="mid_col"><?php echo( $criteria->getCharacteristics() ) ?></span>
                    <span class="end_col"><?php echo( $criteria->getRequirements() ) ?></span>
                </div>
            <?php } ?>
        </p>
    </div>
    <?php } ?>

    <!-- rule target criteria -->
    <?php $targets = $rule->targets; if ( $targets ) { ?>
    <div class="section text">
        <p class="header"><?php out('Clinical targets'); ?> <a href="" class="action_link">(add)</a></p>
        <p>
            <div>
                <span class="left_col">&nbsp;</span>
                <span class="mid_col"><u><?php out("Criteria") ?></u></span>
                <span class="mid_col"><u><?php out("Characteristics") ?></u></span>
                <span class="end_col"><u><?php out("Requirements") ?></u></span>
            </div>

            <?php foreach($targets->criteria as $criteria) { ?>
                <div>
                    <span class="left_col">
                        <a href="index.php?action=edit!target&id=<?php echo $rule->id ?>&guid=<?php echo $criteria->guid ?>" class="action_link">(<?php out('edit') ?>)</a>
                        <a href="index.php?action=delete!target&id=<?php echo $rule->id ?>&guid=<?php echo $criteria->guid ?>" class="action_link">(delete)</a></span>
                    </span>
                    <span class="mid_col"><?php echo( $criteria->getTitle() ) ?></span>
                    <span class="mid_col"><?php echo( $criteria->getCharacteristics() ) ?></span>
                    <span class="end_col">
                            <?php echo( $criteria->getRequirements() ) ?>
                            <?php echo is_null( $criteria->getInterval() ) ?  "" :
                            " | " . out("Interval", false) . ": " . $criteria->getInterval() ?>
                    </span>
                </div>
            <?php } ?>
        </p>
    </div>
    <?php } ?>

    <!-- rule actions -->
    <?php $actions = $rule->actions; if ( $actions) { ?>
    <div class="section text">
        <p class="header"><?php out('Actions'); ?> <a href="" class="action_link">(add)</a></p>
        <p>
            <div>
                <span class="left_col">&nbsp;</span>
                <span class="end_col"><u><?php out("Category/Title") ?></u></span>
            </div>

            <div>
            <?php foreach($actions->actions as $action) { ?>
                <span class="left_col"><a href="" class="action_link">(<?php out('edit') ?>)</a> <a href="" class="action_link">(delete)</a></span>
                <span class="end_col"><?php echo $action->getTitle() ?></span>
            <?php } ?>
            </div>
        </p>
    </div>
    <?php } ?>


</div>