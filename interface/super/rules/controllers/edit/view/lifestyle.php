<p class="row">
    <span class="left_col colhead req" data-fld="fld_lifestyle"><?php echo $criteria->getTitle(); ?></span>
    <span class="end_col">
    <?php echo lifestyle_select( array( "target" => "fld_lifestyle",
                                        "name" => "fld_lifestyle",
                                        "value" => $criteria->type,
                                        "options" => $criteria->getOptions() ) ); ?>
    </span>
</p>

<br/>

<p class="lifestyle">
    <span class="left_col colhead req"><?php out('Value'); ?></span>
    <span class="end_col">
        <input type="radio" name="fld_value_type" class="field" value="match"
               <?php echo !is_null($criteria->matchValue) ? "CHECKED" : ""?>> <?php out("Match") ?>
        <input type="text" name="fld_value" class="field short" value="<?php echo $criteria->matchValue ?>" />
    </span>
</p>

<p class="row lifestyle">
    <span class="left_col colhead">&nbsp;</span>
    <span class="end_col">
        <input type="radio" name="fld_value_type" class="field" value="any"
               <?php echo is_null($criteria->matchValue) ? "CHECKED" : ""?>> <?php out("Any") ?>
    </span>
</p>

<br/>

<!-- optional/required and inclusion/exclusion fields -->
<?php echo common_fields( array( "criteria" => $criteria) ); ?>