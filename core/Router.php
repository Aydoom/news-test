<?php 

namespace core;

/**
 * Description of Router
 *
 * @author Aydoom
 */
class Router {
    
    static public $request;
    static public $method;
    
    public $baseDir = "/";
    static public $rootDir = "/";
    
    public $paths = [];
    public $args = [];
    
    static public $exit = false;
    
    /**
     * Constructor
     */
    public function __construct() {
        $requestUri = filter_input(INPUT_SERVER, 'REQUEST_URI', 
                            FILTER_SANITIZE_SPECIAL_CHARS);
        $requestDir = $this->getRootDir();
        $lenRequest = strpos($requestUri, $requestDir)
                        - strlen($requestDir) + strlen($requestUri);
        self::$request = substr($requestUri, -$lenRequest);                
       
        $this->setMethod();
        $this->paths = explode("/", array_shift(explode("?", self::$request)));
    }
    
    /**
     * 
     * @param type $route
     * @param type $action
     * @return $this
     */
    public function any($route, $action) {
        $this->run($route, $action);

        return $this;
    }
    
    /**
     * 
     * @param type $route
     * @param type $action
     * @return $this
     */
    public function delete($route, $action) {
        if (self::$method === 'delete') {
            $this->run($route, $action);
        }
        
        return $this;
    }
    
    /**
     *
    */
    private function compareRoute($route) {
        $paths = explode("/", array_shift(explode("?", $route)));

        if (count($paths) !== count($this->paths)) {
            return false;
        } else {
            foreach ($paths as $key => $path) {
               if ($path != $this->paths[$key]) {
                   return false;
               }
           }           
        }
        
        return true;
    }
    
    /**
     * 
     * @param type $route
     * @param type $action
     * @return $this
     */
    public function get($route, $action) {
        if (self::$method === 'get') {
            $this->run($route, $action);
        }

        return $this;
    }
    
    /**
     * Function getRootDir()
     *
    */
    public function getRootDir() {
        $scriptName = filter_input(INPUT_SERVER, 'SCRIPT_NAME', 
                                    FILTER_SANITIZE_SPECIAL_CHARS);
        self::$rootDir = implode("/", array_slice(explode("/", $scriptName), 0, -1));
        
        return self::$rootDir;
    }
   
    /**
     * 
     * @param type $route
     * @param type $action
     * @return $this
     */
    public function post($route, $action) {
        if (self::$method === 'post') {
            $this->run($route, $action);
        }
        
        return $this;
    }
    
    /**
     * 
     * @param type $route
     * @param type $action
     * @return $this
     */
    public function put($route, $action) {
        if (self::$method === 'put') {
            $this->run($route, $action);
        }
        
        return $this;
    }    
    
    /**
     * 
     * @param type $route
     * @param type $action
     * @return $this
     */
    public function run($route, $action) {
        if (self::$exit) {
            return $this;
        } elseif ($route === '*' || $this->compareRoute($route)) {
            call_user_func_array($action, $this->args);
            self::$exit = true;
        }
        
        return $this;
    }
    
    private function setMethod() {
        $method = strtolower(filter_input(INPUT_SERVER, 'REQUEST_METHOD', 
                            FILTER_SANITIZE_SPECIAL_CHARS));
        if ($method === 'post') {
            $postType = strtolower(filter_input(INPUT_POST, 'method', 
                            FILTER_SANITIZE_SPECIAL_CHARS));
            self::$method = (empty($postType)) ? $method : $postType;
        } else {
            self::$method = $method;
        }
    }
}