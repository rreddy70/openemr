<?php
/************************************************************************
                        CdrAlertManager.php - Copyright Ensoftek

**************************************************************************/

require_once("ORDataObject.class.php");
require_once("CDRHelper.class.php");
require_once ($GLOBALS['fileroot'] . "/library/clinical_rules.php");

/**
 * class CdrAlertManager
 *
 */
class CdrAlertManager extends ORDataObject{


        /**
         * Constructor 
         */
        function CdrAlertManager ($id = "", $prefix = "") {
        }
        
        
        function populate($pid) {
        	    $cdra = array();
        	
        	    $rules = resolve_rules_sql('patient_reminder', $pid, TRUE);
        	    
        	    foreach( $rules as $rowRule ) {
        	    	  //echo $rowRule['id']." ".$rowRule['pid']." ".$rowRule['patient_reminder_flag']. '\n';
		              $rule_id = $rowRule['id'];
		              $cdra[] = new CdrResults($rule_id, $rowRule['active_alert_flag'], $rowRule['passive_alert_flag'], $rowRule['patient_reminder_flag'], $rowRule['pid']);
        	    }
        	    
		        return $cdra;
        }
        
        
        function getrulenamefromid($rule_id) {
		    	$rez = sqlStatement("SELECT `title` FROM `list_options` " .
		                "WHERE option_id=?", array($rule_id) );
		        
		    	
		    	for($iter=0; $row=sqlFetchArray($rez); $iter++) {
		           return $row['title'];
		        }
		    	  	
	    }
	    
	    function update($pid, $rule_ids, $patient_reminders) {
        	
        	    for($index=0; $index < count($rule_ids); $index++) { 
		              $rule_id = $rule_ids[$index];
		              $patient_reminder = $patient_reminders[$index];
		              
		              $cdra = new CdrResults($rule_id, "", "", $patient_reminder);
		              
		              /*
		               * 1. If radio button is 'ON', Then add the patient specific(by patient_id) 
							   row(if any) from the 'clinical_rules' table and set 'patient_reminder_flag' to '1'
							
							
							2. If radio button is 'OFF', Then add the patient specific(by patient_id) 
							   row(if any) from the 'clinical_rules' table and set 'patient_reminder_flag' to '0'
							
							3. If radio button is 'DEF', Then remove the patient specific(by patient_id) 
							   row(if any) from the 'clinical_rules' table


		               */
		                // The array values come in as 0->OFF 1->ON 2->DEF
		              
             	    	$cdra->add_edit_del_patient_specific_alert($pid, $rule_id, $patient_reminder);
		              		              		              		              
        	    }  

        	    
        }
	    
        
	    
} // end of CdrAlertManager
?>
