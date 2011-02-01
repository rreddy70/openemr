<p class="row">
    <span class="left_col colhead req" data-fld="fld_value"><?php echo $criteria->getTitle(); ?></span>
    <span class="end_col"><input id="fld_value" type="text" name="fld_value" class="field" value="<?php echo $criteria->getRequirements(); ?>"></span>
</p>

<?php //echo textfield_row(array("name" => "fld_value",
      //                         "title" => $criteria->getTitle(),
      //                         "value" =>$criteria->getRequirements() ) ); ?>


<!-- optional/required and inclusion/exclusion fields -->
<?php echo common_fields( array( "criteria" => $criteria) ); ?>