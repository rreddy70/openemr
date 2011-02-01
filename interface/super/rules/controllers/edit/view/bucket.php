<!-- category -->
<?php echo textfield_row(array("name" => "fld_category_lbl",
                               "title" => xl("Category"),
                               "value" => $criteria->getCategoryLabel() ) ); ?>
<input type="hidden" name="fld_category" value="<?php echo $criteria->category?>" />

<!-- item -->
<?php echo textfield_row(array("name" => "fld_item_lbl",
                               "title" => xl("Item"),
                               "value" => $criteria->getItemLabel() ) ); ?>
<input type="hidden" name="fld_item" value="<?php echo $criteria->item?>" />


<!-- completed -->
<p class="row">
    <span class="left_col colhead req" data-field="fld_completed"><?php out('Completed?'); ?></span>
    <span class="end_col">
        <select data-grp-tgt="" type="dropdown" name="fld_completed" id="">
            <option id="" value="">--<?php out("Select"); ?>--</option>
            <option id="Yes" value="yes" <?php echo $criteria->completed ? "SELECTED" : "" ?>><?php out("Yes");?></option>
            <option id="No" value="no" <?php echo !$criteria->completed ? "SELECTED" : "" ?>><?php out("No");?></option>
        </select>
    </span>
</p>

<!-- frequency -->
<p class="row">
    <span class="left_col colhead req" data-field="fld_frequency"><?php out('Frequency'); ?></span>
    <span class="end_col">
        <select data-grp-tgt="" type="dropdown" name="fld_frequency_comparator" id="">
            <option id="" value="">--<?php out("Select"); ?>--</option>
            <option id="le" value="le" <?php echo $criteria->frequencyComparator == "le" ? "SELECTED" : "" ?>><?php echo "<=" ;?></option>
            <option id="lt" value="lt" <?php echo $criteria->frequencyComparator == "lt" ? "SELECTED" : "" ?>><?php echo "<" ;?></option>
            <option id="eq" value="eq" <?php echo $criteria->frequencyComparator == "eq" ? "SELECTED" : "" ?>><?php echo "=" ;?></option>
            <option id="gt" value="gt" <?php echo $criteria->frequencyComparator == "gt" ? "SELECTED" : "" ?>><?php echo ">" ;?></option>
            <option id="ge" value="ge" <?php echo $criteria->frequencyComparator == "ge" ? "SELECTED" : "" ?>><?php echo ">=" ;?></option>
            <option id="ne" value="ne" <?php echo $criteria->frequencyComparator == "ne" ? "SELECTED" : "" ?>><?php echo "!=" ;?></option>
        </select>

        <input data-grp-tgt="fld_frequency" class="field short"
           type="text"
           name="fld_frequency"
           value="<?php echo $criteria->frequency ?>" />
    </span>

<br/>

<!-- optional/required and inclusion/exclusion fields -->
<?php echo common_fields( array( "criteria" => $criteria) ); ?>