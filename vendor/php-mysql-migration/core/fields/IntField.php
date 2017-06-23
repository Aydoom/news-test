<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace PMMigration\Core\Fields;

/**
 * Description of IntField
 *
 * @author Aydoom
 */
class IntField extends \PMMigration\Core\Field {

    public $autoincrement = false;

    public $type = "INT";
    
    /**
     * 
     * @return $this
     */
    public function autoincrement()
    {
        $this->autoincrement = true;
        
        return $this;
    }
    
    /**
     * 
     */
    public function getString()
    {
        $ai = ($this->autoincrement) ? " AUTO_INCREMENT" : "";
        
        return parent::getString() . $ai;
    }
}
