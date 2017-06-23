<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace PMMigration\Core\Fields;

/**
 * Description of BooleanField
 *
 * @author Aydoom
 */
class BooleanField {

    public $type = "Boolean";
    
    /**
     * 
     */
    public function getString()
    {
        return "{$this->name} " . strtoupper($this->type);
    }
}
