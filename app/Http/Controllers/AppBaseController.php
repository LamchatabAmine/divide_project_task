<?php

namespace App\Http\Controllers;

class AppBaseController extends Controller {
    /**
     * @param string $method
     * @param array $parameters
     * @return mixed
     */
    public function callAction($method, $parameters) {
        // Get the base name of the controller class (e.g., UserController)
        $controllerClassName = class_basename(get_class($this));
        // Derive the model name by removing 'Controller' from the controller class name
        $modelName = str_replace('Controller', '', $controllerClassName);
        $modelClass = app()->getNamespace().'Models\\'.$modelName;
        // Extract the action method name (ex., 'index', 'store')
        $action = $method."-".$modelName;
        // Authorize the action on a new instance of the model
        $this->authorize($action, new $modelClass);
        // // Continue with the execution of the intended controller action
        return parent::callAction($method, $parameters);
    }
}
