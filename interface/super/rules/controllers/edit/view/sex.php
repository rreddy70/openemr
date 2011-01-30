<p class="row">
    <span class="left_col colhead req" data-field="fld_sex"><?php out('Sex');?></span>
    <span class="end_col">
    <?php echo sex_select( array( "sex" => $criteria->male ? 'male' : 'female' ) ); ?>
    </span>
</p>

<br/>

<!-- optional/required and inclusion/exclusion fields -->
<?php echo common_fields( array( "optional" => $criteria->optional, "inclusion" => $criteria->inclusion ) ); ?>