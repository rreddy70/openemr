<p class="row">
    <span class="left_col colhead req" data-field="fld_value"><?php out('Age');?> <?php echo xl($criteria->type)?></span>
    <span class="end_col"><input id="fld_value" type="text" name="fld_value" class="field" value="<?php echo $criteria->getRequirements(); ?>"></span>
</p>
<br/>

<p class="row">
    <span class="left_col colhead req" data-field="fld_timeunit"><?php out('Unit');?></span>
    <span class="end_col">
    <?php echo timeunit_select( array( "value" => $criteria->timeUnit ) ); ?>
    </span>
</p>
<br/>

<!-- optional/required and inclusion/exclusion fields -->
<?php echo common_fields( array( "optional" => $criteria->optional, "inclusion" => $criteria->inclusion ) ); ?>