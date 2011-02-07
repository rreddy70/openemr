<!-- age -->
<p class="row">
    <span class="left_col colhead req" data-fld="fld_value"><?php out('Age');?> <?php echo $criteria->getType(); ?></span>
    <span class="end_col"><input id="fld_value" type="text" name="fld_value" class="field short" value="<?php echo $criteria->getRequirements(); ?>"></span>
</p>

<!-- age unit -->
<p class="row">
    <span class="left_col colhead req" data-fld="fld_timeunit"><?php out('Unit');?></span>
    <span class="end_col">
    <?php echo timeunit_select( array( "target"=>"fld_timeunit", "name" => "fld_timeunit", "value" => $criteria->timeUnit ) ); ?>
    </span>
</p>

<input type="hidden" name="fld_type" value="<?php echo $criteria->type ?>"/>

<br/>

<!-- optional/required and inclusion/exclusion fields -->
<?php echo common_fields( array( "criteria" => $criteria) ); ?>