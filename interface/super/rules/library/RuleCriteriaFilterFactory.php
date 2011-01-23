<?php
require_once( library_src( 'RuleCriteriaFactory.php') );
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RuleCriteraFilterFactory
 *
 * @author aron
 */
class RuleCriteriaFilterFactory extends RuleCriteriaFactory {
    var $strategyMap;

    function __construct() {
        $this->strategyMap['filt_age_min'] = new RuleCriteriaAgeBuilder();
        $this->strategyMap['filt_age_max'] = new RuleCriteriaAgeBuilder();
        $this->strategyMap['filt_sex'] = new RuleCriteriaSexBuilder();
        $this->strategyMap['filt_lists'] = new RuleCriteriaListsBuilder();
        $this->strategyMap['filt_database'] = new RuleCriteriaDatabaseBuilder();
    }

    function getStrategyMap() {
        return $this->strategyMap;
    }

}
?>
