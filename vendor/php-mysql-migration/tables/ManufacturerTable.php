<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace PMMigration\Tables;

/**
 * Description of ManufacturerTable
 *
 * @author Aydoom
 */
class ManufacturerTable extends \PMMigration\Core\DefTable {

    public $name = 'manufacturer';
    public $fields = [];

    public function __construct($name = false)
    {
        if ($name) {
            $this->name = $name;
        }
        
        $this->defId('id');
        $this->defVarchars(['name', 'logo']);
        $this->defText('description');
        $this->defDates(['date_create', 'date_update']);
        $this->defId('id_creator', false);
        $this->defId('id_updater', false);
    }
}
