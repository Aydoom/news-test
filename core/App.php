<?php 

namespace core;

class App {
	
    public $controller;
    public $action;
    public $view;
    
    static public $actionUri;

    
    public function abort($error) {
        if ($error === 404) {
            Error::e404();
        }
    }
    
    /**
     * Функция для переноса данных из контроллера во вьювер
     * 
     * @param type $name
     * @return type
     */
    public function fetch($name) {
        
        return $this->controller->_get($name);
    }

    /**
     * Функция запуска приложения
     * 
     * @param type $controller
     * @param type $action
     * @param type $param
     */
    public function run($controller, $action) {
        self::$actionUri = DS . strtolower($controller) . DS . strtolower($action) . DS;
        $className = 'app\controller\\' . ucfirst($controller) . "Controller";

        $this->controller = new $className($action);
        $this->controller->before();
        $this->controller->$action();

        $this->view();
    }
	
    /**
     * Функция отображения вьювера
     */
    public function view() {
        $fileName = VIEW . $this->controller->view . ".php";
        if (file_exists($fileName)) {
            require $fileName;
        } else {
            Error::msg("View not found: " . $this->controller->name . "/"
                    . $this->controller->action . ".php - отсутсвует!");
        }
    }
}