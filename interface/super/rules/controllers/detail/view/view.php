<table class="header">
  <tr >
        <td class="title"><?php out('Rule Detail'); ?></td>
        <td>
            <a href="index.php?action=browse!list" class="iframe_medium css_button"><span>Back</span></a>
        </td>
  </tr>
</table>

<?php $rule = $viewBean->rule ?>
<div class="rule_detail">
    <!-- summary -->
    <div class="section text">
        <p class="header"><?php out('Summary'); ?></p>
        <p><b><?php echo $rule->title ?></b>
        (<?php echo implode( ", ", $rule->ruleTypes ); ?>)
        </p>
    </div>

    <!-- reminder intervals -->
    <?php $intervals = $rule->reminderIntervals; if ( $intervals) { ?>
    <div class="section text">
        <p class="header"><?php out('Reminder intervals'); ?></p>

        <p>
            <div>
                <span class="left_label colhead"><u><?php out("Type") ?></u></span>
                <span class="right_value colhead"><u><?php out("Detail") ?></u></span>
            </div>

            <?php foreach($intervals->getTypes() as $type) {?>
                <div>
                <span class="left_label"><?php echo $type->lbl ?></span>
                <span class="right_value">
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
        <p class="header"><?php out('Demographics filter criteria'); ?></p>

        <p>
            <div>
                <span class="left_label"><u><?php out("Criteria") ?></u></span>
                <span class="mid_value"><u><?php out("Characteristics") ?></u></span>
                <span class="right_value"><u><?php out("Requirements") ?></u></span>
            </div>

            <?php foreach($filters->criteria as $criteria) { ?>
                <div>
                    <span class="left_label"><?php echo( $criteria->getTitle() ) ?></span>
                    <span class="mid_value"><?php echo( $criteria->getCharacteristics() ) ?></span>
                    <span class="right_value"><?php echo( $criteria->getRequirements() ) ?></span>
                </div>
            <?php } ?>
        </p>
    </div>
    <?php } ?>

    <!-- rule target criteria -->
    <?php $targets = $rule->targets; if ( $targets ) { ?>
    <div class="section text">
        <p class="header"><?php out('Clinical targets'); ?></p>
        <p>
            <div>
                <span class="left_label"><u><?php out("Criteria") ?></u></span>
                <span class="mid_value"><u><?php out("Characteristics") ?></u></span>
                <span class="right_value"><u><?php out("Requirements") ?></u></span>
            </div>

            <?php foreach($targets->criteria as $criteria) { ?>
                <div>
                    <span class="left_label"><?php echo( $criteria->getTitle() ) ?></span>
                    <span class="mid_value"><?php echo( $criteria->getCharacteristics() ) ?></span>
                    <span class="right_value">
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
        <p class="header"><?php out('Actions'); ?></p>
        <p>
            <div>
                <u><?php out("Category/Title") ?></u>
            </div>

            <div>
            <?php foreach($actions->actions as $action) { ?>
                <?php echo $action->getTitle() ?><br>
            <?php } ?>
            </div>
        </p>
    </div>
    <?php } ?>


</div>