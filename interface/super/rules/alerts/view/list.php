<form name="cdralertmgr" method="post" action="/interface/super/rules/alerts/index.php?action=submit" >
<table cellpadding="1" cellspacing="0" class="showborder">
        <tr class="showborder_head">
                <th width="250px">Title</th>
                <th width="40px">&nbsp;</th>
                <th width="10px">Active</th>
                <th width="40px">&nbsp;</th>
                <th width="10px">Passive</th>
                <th width="40px">&nbsp;</th>
                <th width="10px">Reminders</th>
                <th></th>
        </tr>
        <?php $index = -1; ?>
        <?php foreach($viewBean->rules as $rule) {?>
        <?php $index++; ?>
        <tr height="22">
                <td><?php out($rule->get_rule());?></td>
				<td>&nbsp;</td>
				<?php if ($rule->active_alert_flag() == "1"){  ?>
                	<td><input type="checkbox" name="active[<?php echo($index)?>]" checked="yes"></td>
                <?php }else {?>
                	<td><input type="checkbox" name="active[<?php echo($index)?>]" ></td>
				<?php } ?>                
				<td>&nbsp;</td>
                <?php if ($rule->passive_alert_flag() == "1"){ ?>
                	<td><input type="checkbox" name="passive[<?php echo($index)?>]]" checked="yes"></td>
                <?php }else {?>
	                <td><input type="checkbox" name="passive[<?php echo($index)?>]]"></td>
				<?php } ?>                
				<td>&nbsp;</td>
                <?php if ($rule->patient_reminder_flag() == "1"){ ?>
                	<td><input type="checkbox" name="reminder[<?php echo($index)?>]]" checked="yes"></td>
                <?php }else {?>
	                <td><input type="checkbox" name="reminder[<?php echo($index)?>]]"></td>
				<?php } ?>                
                <td><input style="display:none" name="id[<?php echo($index)?>]]" value="{$rule->get_id()}" /></td>								
        </tr>
		<?php }?>
</table>
<br>
<a href="javascript:document.cdralertmgr.submit();" class="css_button"><span>Save</span></a><a href="javascript:document.cdralertmgr.reset();" class="css_button" ><span>Cancel</span></a>
</form>


