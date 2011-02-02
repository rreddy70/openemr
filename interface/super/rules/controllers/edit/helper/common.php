<!--

General Helpers

-->

<?php function render_select( $args ) { ?>
<select data-grp-tgt="<?php echo $args['target'] ?>" type="dropdown" name="<?php echo $args['name'] ?>" id="<?php echo $args['id']?>">
    <option id="" value="">--<?php out("Select"); ?>--</option>
    <?php foreach( $args['options'] as $option ) { ?>
    <option id="<?php echo $option['id'] ?>" value="<?php echo $option['id'] ?>" <?php echo $args['value'] == $option['id'] ? "SELECTED" : "" ?>>
        <?php echo $option['label'] ?>
    </option>
    <?php } ?>
</select>
<?php } ?>

<?php function textfield_row( $args ) { ?>
<p class="row">
    <span class="left_col colhead req" data-field="<?php echo $args['name']?>"><?php echo $args['title'] ?></span>
    <span class="end_col">
        <input data-grp-tgt="<?php echo $args['target']?>" class="field <?php echo $args['class']?>"
               type="text"
               name="<?php echo $args['name']?>"
               value="<?php echo $args['value']?>" />
    </span>
</p>
<?php } ?>

<!--

Compound Helpers

-->
<?php function common_fields( $args ) { ?>
<?php $criteria = $args['criteria'];  ?>
<p class="row">
    <span class="left_col colhead req" data-field="fld_optional"><?php out('Optional'); ?></span>
    <span class="end_col">
        <input id="fld_optional" type="radio" name="fld_optional" class="field" value="yes"
               <?php echo $criteria->optional ? "CHECKED" : ""?>> <?php out("Yes") ?>
        <input id="fld_optional" type="radio" name="fld_optional" class="field" value="no"
               <?php echo !$criteria->optional ? "CHECKED" : ""?>> <?php out("No") ?>
    </span>
</p>

<p class="row">
    <span class="left_col colhead req" data-field="fld_inclusion"><?php out('Inclusion'); ?></span>
    <span class="end_col">
        <input id="fld_inclusion" type="radio" name="fld_inclusion" class="field" value="yes"
               <?php echo $criteria->inclusion ? "CHECKED" : ""?>> <?php out("Yes") ?>
        <input id="fld_inclusion" type="radio" name="fld_inclusion" class="field" value="no"
               <?php echo !$criteria->inclusion ? "CHECKED" : ""?>> <?php out("No") ?>
    </span>
</p>

<?php if ( $criteria->interval && $criteria->intervalType )  { ?>
<p class="row">
    <span class="left_col colhead req" data-field="fld_target_interval"><?php out('Interval'); ?></span>
    <span class="end_col">
        <input data-grp-tgt="flt_target_interval" class="field short"
               type="text"
               name="fld_target_interval"
               value="<?php echo $criteria->interval ?>" />

        <?php echo timeunit_select( array( "target"=>"fld_target_interval", "name" => "fld_target_interval_type", "value" => $criteria->intervalType ) ); ?>
    </span>
</p>
<?php } ?>
<?php } ?>

<?php function timeunit_select( $args ) { ?>
<select data-grp-tgt="<?php echo $args['target'] ?>" type="dropdown" name="<?php echo $args['name'] ?>" id="<?php echo $args['id']?>">
    <option id="" value="">--<?php out("Select"); ?>--</option>
    <?php foreach( TimeUnit::values() as $unit ) { ?>
    <option id="<?php echo $unit->code ?>" value="<?php echo $unit->code ?>" <?php echo $args['value'] == $unit ? "SELECTED" : "" ?>>
        <?php echo $unit->lbl ?>
    </option>
    <?php } ?>
</select>
<?php } ?>

