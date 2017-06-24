<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace core;
use core\Request;
/**
 * Description of Model
 *
 * @author Aydoom
 */
class Model {
    
    public $validRules = [];
    public $validErrors = [];
    public $hasErrors = false;
    
    public $modelName;
    
    public $lastId;
    
    public $behaviors = [];
    
    public $preConditions = [];


    public function belongTo($tableName) {
        $this->preConditions['left join'] = [
            'table' => $tableName, 
            'on' => [
                "$this->modelName.id" => "$tableName.id_$this->modelName"
            ]];
        
        return $this;
    }
    
    /**
     * 
     */
    public function __construct() {
        $this->modelName = substr(array_pop(explode("\\", get_class($this))), 0, -5);
    }
    
    /**
     * 
     * @param type $name
     * @return type
     */
    public function getFieldName($name) {
        return strtolower($this->modelName) . "Form." . $name;
    }
    
    /**
     * 
     * @return type
     */
    public function getLastId() {
        return $this->lastId;
    }    
    /**
     * 
     * @param type $name
     * @return type
     */
    public function hasCustomRule($name) {
        return (in_array($name, get_class_methods($this)));
    }
    
    /**
     * 
     * @param type $conditions
     * @return type
     */
    public function find($conditions = []) {
        $db = new DB(config(), strtolower($this->modelName));
        
        foreach ($this->behaviors as $behavior) {
            $conditions = $behavior->beforeFind($conditions);
        }

        $result = $db->find(array_merge($conditions, $this->preConditions));
        foreach ($this->behaviors as $behavior) {
            $result = $behavior->afterFind($result);
        }
        
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
     * @param type $behaviorName
     * @param type $options
     * @return $this
     */
    public function loadBehavior($behaviorName, $options = []) {
        $name = strtolower($behaviorName);
        $className = 'plugins\\Behaviors\\'
                . ucfirst($name) . "Behavior";
        $this->behaviors[$name] = new $className($this, $options);
        
        return $this;
    }
    /**
     * 
     * @param type $data
     * @return type
     */
    public function save($data) {
        $db = new DB(config(), strtolower($this->modelName));
        pr($data);
        if (!empty($data['id'])) {
            $db->update($data);
            $this->lastId = $id;
        } else {
            $this->lastId = $db->insert($data);
        }
        return (!empty($this->lastId));
    }
    
    /**
     * 
     * @return type
     */
    public function validation() {
        foreach($this->validRules as $field => $rules) {
            $fieldName = $this->getFieldName($field);            
            if (!is_array($rules)) {
                $rules = [$rules];
            }
            
            $this->validErrors[$field] = $this->validationRun($rules, 
                                            Request::get($fieldName), $field);
        }

        return !$this->hasErrors;
    }
    
    private function validationRun($rules, $data, $field) {
        $valid = new Validation($this);
        $validRules = $valid->getListRules(); 
        $errors = [];
        foreach($rules as $rule) {
            $ruleName = $rule['rule'];
            if (substr_count($ruleName, "::") === 1) {
                $names = explode("::", $ruleName);
                $extRuleName = $names[1];
                $valid->extention($names[0])->$extRuleName($data, $rule, $field);                
            } elseif (in_array($ruleName, $validRules)) {
                $error = $valid->on($ruleName, $data, $rule, $field);
            } elseif ($this->hasCustomRule($ruleName)) {
                $error = $this->$ruleName($data, $rule, $field);
            } 
            
            if($error !== Null) {
                $errors[] = $error;
                $this->hasErrors = true;
            }
        }

        return $errors;
    }
}
