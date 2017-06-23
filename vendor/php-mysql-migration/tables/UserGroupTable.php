<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace PMMigration\Tables;

/**
 * Description of UserGroupTable
 *
 * @author Aydoom
 */
class UserGroupTable extends \PMMigration\Core\DefTable {
	
    public $name = 'user_group';
    public $fields = [];

    /**
     * 
     * @param type $name
     */
    public function __construct($name = false)
    {
        parent::__construct($name);
        
        $this->defId("id");
        $this->addField("level", "int")->len("1");
        $this->addField("type", "varchar")->len("50");
    }

    
    public function write() {
        $fields = ['level', 'type'];
        
        $this->setInsert($fields, [1, 'super_admin']);
        $this->setInsert($fields, [2, 'admin']);
        $this->setInsert($fields, [3, 'specialist']);
    }
}
