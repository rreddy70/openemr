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

    <!-- reminder intervals -->
    <?php $intervals = $viewBean->rule->reminderIntervals ?>
    <?php if ( $intervals) { ?>
    <p>
        <span><?php out('Reminder Intervals'); ?></span>
        <span>
                <?php foreach($intervals->getTypes() as $type) {?>
                    <div>
                        <p><?php out($type->lbl) ?></p>
                        <?php foreach( $intervals->getDetailFor( $type ) as $detail ) {?>
                        <span><?php out($detail->intervalRange->lbl) ?>:</span>
                        <span><?php out($detail->amount) ?></span>
                        <span><?php out($detail->timeUnit->lbl) ?></span>
                        <?php } ?>
                    </div>
                <?php } ?>
        </span>
    </p>
    <?php } ?>

    <!-- rule filter criteria -->
    <?php $filters = $viewBean->rule->filters ?>
    <?php if ( $filters ) { ?>
    <p>
        <span><?php out('Demographic filter criteria'); ?></span>
        <p>
            <?php foreach($filters->criteria as $criteria) { ?>
                <!-- title -->
                <div>
                    <span><?php out( $criteria->getTitle() ) ?></span>
                </div>
                <!-- requirements -->
                <div>
                    <span><?php out( $criteria->getRequirements() ) ?></span>
                </div>
            <?php } ?>
        </p>
    </p>
    <?php } ?>
</div>