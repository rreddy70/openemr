<?php function common_fields( $args ) { ?>
<p class="row">
    <span class="left_col colhead req" data-field="fld_optional"><?php out('Optional'); ?></span>
    <span class="end_col">
        <input id="fld_optional" type="radio" name="fld_optional" class="field" value="yes"
               <?php echo $args['optional'] ? "CHECKED" : ""?>> <?php out("Yes") ?>
        <input id="fld_optional" type="radio" name="fld_optional" class="field" value="no"
               <?php echo !$args['optional'] ? "CHECKED" : ""?>> <?php out("No") ?>
    </span>
</p>

<p class="row">
    <span class="left_col colhead req" data-field="fld_inclusion"><?php out('Inclusion'); ?></span>
    <span class="end_col">
        <input id="fld_inclusion" type="radio" name="fld_inclusion" class="field" value="yes"
               <?php echo $args['inclusion'] ? "CHECKED" : ""?>> <?php out("Yes") ?>
        <input id="fld_inclusion" type="radio" name="fld_inclusion" class="field" value="no"
               <?php echo !$args['inclusion'] ? "CHECKED" : ""?>> <?php out("No") ?>
    </span>
</p>
<?php } ?>

<?php function timeunit_select( $args ) { ?>
<select data-grp-tgt="<?php echo $args['target'] ?>" type="dropdown" name="<?php echo $args['name'] ?>" id="<?php echo $args['id']?>">
    <option id="">--<?php out("Select"); ?>--</option>
    <?php foreach( TimeUnit::values() as $unit ) { ?>
    <option id="<?php echo $unit->code ?>" value="<?php echo $unit->code ?>" <?php echo $args['value'] == $unit ? "SELECTED" : "" ?>>
            <?php echo $unit->lbl ?>
    </option>
    <?php } ?>
</select>
<?php } ?>

<?php function sex_select( $args ) { ?>
<select data-grp-tgt="<?php echo $args['target'] ?>" type="dropdown" name="<?php echo $args['name'] ?>" id="<?php echo $args['id']?>">
    <option id="">--<?php out("Select"); ?>--</option>
    <option id="male" value="male" <?php echo $args['sex'] == 'male' ? "SELECTED" : "" ?>><?php out("Male");?></option>
    <option id="female" value="male" <?php echo $args['sex'] == 'female' ? "SELECTED" : "" ?>><?php out("Female");?></option>
</select>
<?php } ?>
