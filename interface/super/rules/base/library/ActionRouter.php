<?php

/**
 * This is a very simple action routing class for a given controller. Given
 * a controller and action (typically from ControllerRouter), it goes through
 * these steps to find out which function in that controller should be invoked:
 *
 * todo - document these steps
 * 
 * @author aron
 */
class ActionRouter {

    var $controller;
    var $path;
    var $webRoot;
    var $appRoot;
    var $action;

    function __construct($controller, $action, $path) {
        $this->controller = $controller;
        $this->action = $action;
        $this->path = $path;
        $this->appRoot = base_dir();
        $this->webRoot = $GLOBALS['webroot'];
    }

    function route() {
        if ( !$this->action ) {
            $this->action = "default";
        }

        $result = $this->perform($this->action);

        $forward = $result->_forward;
        if ($forward) {
            $this->perform($forward);
            return;
        }

        $_redirect = $result->_redirect;
        if ($_redirect) {
            $baseTemplatesDir = base_dir() . "base/template";
            require($baseTemplatesDir . "/redirect.php");
        }
    }

    function perform( $action ) {
        $action_method = '_action_' . $action;

        // execute the default action if action is not found
        method_exists($this->controller, $action_method) ?
                $this->controller->$action_method() : $this->controller->_action_default();
        $result = $this->controller->viewBean;

        // resolve view location
        $viewName = $result->_view;
        $view_location = $this->path . "/view/" . $viewName;
        if ( !is_file($view_location) ) {
            // try common
            $view_location = base_dir() . "base/view/" . $viewName;
        }

        if ( !is_file($view_location) ) {
            // no view template
            return $result;
        }

        // set viewbean in page scope
        $viewBean = $result;

        $viewBean->_appRoot = $this->appRoot;
        $viewBean->_webRoot = $this->webRoot;
        $viewBean->_view_body = $view_location;

        $template = $this->resolveTemplate( $result->_template );
        require($template);
        return $result;
    }

    function resolveTemplate( $templateName ) {
        // try local
        $template_location = $this->path . "/template/" . $templateName;

        // try common
        if ( !is_file($template_location) ) {
            $template_location = base_dir() . "base/template/" . $templateName;
        }

        if ( is_file($template_location) ) {
            // return template if its found
            return $template_location;
        } else {
            // otherwise use the basic template
            $baseTemplatesDir = base_dir() . "base/template";
            return $baseTemplatesDir . "/basic.php";
        }
    }

}
?>
