<p class="row">
    <span class="left_col colhead req" data-field="fld_value"><?php echo $criteria->getTitle(); ?></span>
    <span class="end_col"><input id="fld_value" type="text" name="fld_value" class="field" value="<?php echo $criteria->getRequirements(); ?>"></span>
</p>

<!-- optional/required and inclusion/exclusion fields -->
<?php echo common_fields( array( "optional" => $criteria->optional, "inclusion" => $criteria->inclusion ) ); ?>