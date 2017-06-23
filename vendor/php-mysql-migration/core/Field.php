<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace PMMigration\Core;

/**
 * Description of Field
 *
 * @author Aydoom
 */
abstract class Field {
    
    public $def = NULL;

    public $len = 32;
    
    public $name;
    
    public $primary = false;
    
    public $type = "None";
    
    /**
     * 
     * @param type $name
     */
    public function __construct($name) {
        $this->name = $name;
    }
    
    /**
     * 
     * @param type $value
     * @return $this
     */
    public function def($value = "null")
    {
        $this->def = $value;
        
        return $this;
    }

    /**
     * 
     */
    public function getString()
    {
        $default = ($this->def) ? strtoupper(" {$this->def}") : "";
        
        return "{$this->name} " 
                . strtoupper($this->type)
                . "({$this->len})"
                . $default;
    }
    
    /**
     * The function is setting the length of field
     * 
     * @param type $count
     * @return $this
     */
    public function len($count)
    {
        if (is_numeric($count)) {
            $this->len = $count;
        }
        
        return $this;
    }
    
    /**
     * 
     * @return $this
     */
    public function primary_key()
    {
        $this->primary = true;
        
        return $this;
    }
}
