<?php 

namespace core;

class App {
	
    public $controller;
    public $action;
    public $param;
    public $view;
    
    static public $actionUri;

    
    public function abort($error) {
        if ($error === 404) {
            require VIEW . "/errors/404.php";
        }
    }
    
    /**
     * Function get data from controller saves
     * 
     * @param type $name
     * @return type
     */
    public function fetch($name) {
        
        return $this->controller->_get($name);
    }

    /**
     * function run controller
     * 
     * @param type $controller
     * @param type $action
     * @param type $param
     */
    public function run($controller, $action, $param = null) {
        self::$actionUri = DS . strtolower($controller) . DS . strtolower($action) . DS;
        $className = 'app\controller\\' . ucfirst($controller) . "Controller";
        $this->controller = new $className($action);
        if(is_null($param)) {
            $this->controller->$action();
        } else {
            $this->controller->$action(...array_values($param));
        }
        
        if (!empty($this->controller->redirect)) {
            $this->redirect($this->controller->redirect);
            die();
        }

        $this->view();
    }
	
    /**
     * function redirect()
     */
    public function redirect($uri) {
        $location = 'http://' . $_SERVER['SERVER_NAME']
            . substr($_SERVER['SCRIPT_NAME'], 0 , -9) . ltrim($uri, '/');

        header('Location: ' . $location);
    }
	
    /**
     * function view()
     */
    public function view() {
        $fileName = $this->controller->view;
        if (file_exists($fileName)) {
            require $fileName;
        } else {
            pr("Нет вьювера: " . $this->controller->name . "/"
                    . $this->controller->action . ".php - отсутсвует!");
        }
    }
}