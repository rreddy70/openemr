<p class="row">
    <span class="left_col colhead req" data-fld="fld_sex"><?php out('Sex');?></span>
    <span class="end_col">
    <?php echo sex_select( array( "target"=>"fld_sex",
                                  "name" => "fld_sex",
                                  "sex" => $criteria->male ? 'male' : 'female' ) ); ?>
    </span>
</p>

<br/>

<!-- optional/required and inclusion/exclusion fields -->
<?php echo common_fields( array( "criteria" => $criteria) ); ?>