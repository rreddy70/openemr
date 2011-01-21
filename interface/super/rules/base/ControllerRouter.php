<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControllerRouter
 *
 * @author aron
 */
class ControllerRouter {

    /**
     * xxx todo: error handling
     */
    function route() {
        $actionParam = _get( "action" );
        $paramParts = explode("!", $actionParam);
        $controller = $paramParts[0];
        $action = $paramParts[1];

        $controllerDir = controller_dir($controller);
        $controllerFile = $controllerDir . "/controller.php";
        require_once( $controllerFile );
        $controllerClassName = "Controller_$controller";
        $controllerInstance = new $controllerClassName();

        $actionRouter = new ActionRouter(
                $controllerInstance,
                $action,
                $controllerDir,
                $GLOBALS['srcdir'] . "/../",
                $GLOBALS['webroot']
        );

        $actionRouter->route();
    }
    
}
?>
