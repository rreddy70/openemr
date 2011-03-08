<table class="header">
  <tr>
        <td class="title"><?php echo htmlspecialchars(xl('Clinical Decision Rules Alert Manager'), ENT_NOQUOTES); ?></td>
        
  </tr>
  <tr>
        <td>
        	<a href="javascript:document.cdralertmgr.submit();" class="css_button"><span>Save</span></a><a href="javascript:document.cdralertmgr.reset();" class="css_button" ><span>Cancel</span></a>
        </td>
  </tr>        
</table>

&nbsp;

<form name="cdralertmgr" method="post" action="index.php?action=alerts!submitactmgr" >
<table cellpadding="1" cellspacing="0" class="showborder">
        <tr class="showborder_head">
                <th width="250px"><?php echo htmlspecialchars( xl('Title'), ENT_NOQUOTES); ?></th>
                <th width="40px">&nbsp;</th>
                <th width="10px"><?php echo htmlspecialchars( xl('Active Alert'), ENT_NOQUOTES); ?></th>
                <th width="40px">&nbsp;</th>
                <th width="10px"><?php echo htmlspecialchars( xl('Passive ALert'), ENT_NOQUOTES); ?></th>
                <th width="40px">&nbsp;</th>
                <th width="10px"><?php echo htmlspecialchars( xl('Patient Reminder'), ENT_NOQUOTES); ?></th>
                <th></th>
        </tr>
        <?php $index = -1; ?>
        <?php foreach($viewBean->rules as $rule) {?>
        <?php $index++; ?>
        <tr height="22">
                <td><?php echo htmlspecialchars(xl($rule->get_rule()), ENT_NOQUOTES);?></td>
				<td>&nbsp;</td>
				<?php if ($rule->active_alert_flag() == "1"){  ?>
                	<td><input type="checkbox" name="active[<?php echo $index ?>]" checked="yes"></td>
                <?php }else {?>
                	<td><input type="checkbox" name="active[<?php echo $index ?>]" ></td>
				<?php } ?>                
				<td>&nbsp;</td>
                <?php if ($rule->passive_alert_flag() == "1"){ ?>
                	<td><input type="checkbox" name="passive[<?php echo $index ?>]]" checked="yes"></td>
                <?php }else {?>
	                <td><input type="checkbox" name="passive[<?php echo $index ?>]]"></td>
				<?php } ?>                
				<td>&nbsp;</td>
                <?php if ($rule->patient_reminder_flag() == "1"){ ?>
                	<td><input type="checkbox" name="reminder[<?php echo $index ?>]]" checked="yes"></td>
                <?php }else {?>
	                <td><input type="checkbox" name="reminder[<?php echo $index ?>]]"></td>
				<?php } ?>                
                <td><input style="display:none" name="id[<?php echo $index ?>]]" value=<?php echo htmlspecialchars(xl($rule->get_id()), ENT_NOQUOTES); ?> /></td>								
        </tr>
		<?php }?>
</table>
</form>


