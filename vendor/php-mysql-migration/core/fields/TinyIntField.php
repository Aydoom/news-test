<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace PMMigration\Core\Fields;

/**
 * Description of TinyIntField
 *
 * @author Aydoom
 */
class TinyIntField extends \PMMigration\Core\Field  {

    public $autoincrement = false;

    public $len = 4;
    
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
    
    /**
     * The function is setting the length of field
     * 
     * @param type $count
     * @return $this
     */
    public function len($count)
    {
        $handleCount = ($count > 4) ? 4 : $count;
        return parent::len($handleCount);
    }
}
