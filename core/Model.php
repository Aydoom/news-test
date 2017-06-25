<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace core;
/**
 * Description of Model
 *
 * @author Aydoom
 */
class Model {
    public $modelName;
    public $lastId;
    
    /**
     * 
     */
    public function __construct() {
        $this->modelName = substr(array_pop(explode("\\", get_class($this))), 0, -5);
    }
    
    public function delete ($id) {
        $db = new DB(config(), strtolower($this->modelName));
        
        return $db->delete($id);
    }
  

    /**
     * 
     * @param type $conditions
     * @return type
     */
    public function find($conditions = []) {
        $db = new DB(config(), strtolower($this->modelName));
        $result = $db->find($conditions);
        
        return $result;
    }
    
    /**
     * 
     * @param type $modelName
     * @return type
     */
    public function loadModel($modelName) {
        $className = 'app\\Model\\' . ucfirst($modelName) . "Model";
        $this->models[$modelName] = new $className();
        
        return $this->models[$modelName];
    }

    /**
     * 
     * @param type $data
     * @return type
     */
    public function save($data) {
        $db = new DB(config(), strtolower($this->modelName));

        if (!empty($data['id']) && $db->update($data)) {
            $this->lastId = $data['id'];
        } else {
            $this->lastId = $db->insert($data);
        }
        return (!empty($this->lastId));
    }
}
