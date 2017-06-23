<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace PMMigration\Tables;

/**
 * Description of SessionTable
 *
 * @author Aydoom
 */
class SessionTable extends \PMMigration\Core\DefTable {
	
    public $name = 'session';
    public $fields = [];

    /**
     * 
     * @param type $name
     */
    public function __construct($name = false)
    {
        parent::__construct($name);
        
        $this->defId("id");
        $this->defId("id_user", false);
        $this->defVarchars(["name"]);
        $this->addField("access", "tinyint")->def(1);
        $this->addField("trash", "tinyint")->def("NULL");
        $this->defDates(["registerDate", "trashDate"]);
    }
}
