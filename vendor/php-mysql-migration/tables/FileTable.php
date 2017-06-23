<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace PMMigration\Tables;

/**
 * Description of fileTable
 *
 * @author Angel
 */
class FileTable extends \PMMigration\Core\DefTable {
	
    public $name = 'file';
    public $fields = [];

    /**
     * 
     * @param type $name
     */
    public function __construct($name = false)
    {
        parent::__construct($name);
        
        $this->defId("id");
        $this->defId("id_session", false);
        $this->defVarchar("name");
        $this->addField("aliace", "varchar")->len(30)->def("NULL");
        $this->addField("ser_number", "varchar")->len(30)->def("NULL");
        $this->defDates("loadDate");
        $this->addField("trash", "tinyint")->def("NULL");
    }

}