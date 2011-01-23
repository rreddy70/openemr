<?php
require_once( library_src( 'RuleCriteriaFactory.php') );

/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RuleCriteriaTargetFactory
 *
 * @author aron
 */
class RuleCriteriaTargetFactory extends RuleCriteriaFactory {
    var $strategyMap;

    function __construct() {
        $this->strategyMap['target_age_min'] = new RuleCriteriaAgeBuilder();
        $this->strategyMap['target_age_max'] = new RuleCriteriaAgeBuilder();
        $this->strategyMap['target_sex'] = new RuleCriteriaSexBuilder();
        $this->strategyMap['target_lists'] = new RuleCriteriaListsBuilder();
        $this->strategyMap['target_database'] = new RuleCriteriaDatabaseBuilder();
        $this->strategyMap['target_interval'] = null;
    }

    function getStrategyMap() {
        return $this->strategyMap;
    }
}
?>
