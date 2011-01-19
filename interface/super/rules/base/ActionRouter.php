<?php

/**
 * This is a very simple action routing class for a given controller:
 * 
 * @author aron
 */
class ActionRouter {

    var $controller;
    var $path;
    var $webRoot;
    var $appRoot;

    function __construct($controller, $path, $appRoot, $webRoot) {
        $this->controller = $controller;
        $this->path = $path;
        $this->appRoot = $appRoot;
        $this->webRoot = $webRoot;
    }

    function route() {
        $action = _get('action', 'default');
        $result = $this->perform($action);

        $forward = $result->_forward;
        if ($forward) {
            $this->perform($forward);
            return;
        }

        $_redirect = $result->_redirect;
        if ($_redirect) {
            $baseTemplatesDir = _base_dir() . "base/template";
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
            $view_location = _base_dir() . "base/view/" . $viewName;
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
            $template_location = _base_dir() . "base/template/" . $templateName;
        }

        if ( is_file($template_location) ) {
            // return template if its found
            return $template_location;
        } else {
            // otherwise use the basic template
            $baseTemplatesDir = _base_dir() . "base/template";
            return $baseTemplatesDir . "/basic.php";
        }
    }

}
?>
