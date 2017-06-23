<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace PMMigration\Core;

/**
 * Description of DefTable
 *
 * @author Aydoom
 */
class DefTable extends Table{
    
    /**
     * 
     * @param type $name
     */
    public function defDate($name) {
        $this->addField($name, "datetime");
    }
    
    /**
     * 
     * @param type $names
     */
    public function defDates($names) {
        if(!is_array($names)) {
            $names = [$names];
        }
        
        foreach ($names as $name) {
            $this->defDate($name);
        }
    }
    
    /**
     * 
     * @param type $name
     * @param type $primary
     */
    public function defId($name, $primary = true) {
        if ($primary) {
            $this->addField($name, 'int')
                ->len(11)
                ->def('not null')
                ->autoincrement()
                ->primary_key();
        } else {
            $this->addField($name, 'int')
                ->len(11)
                ->def('not null');
        }
    }
    /**
     * 
     * @param type $name
     * @param type $primary
     */
    public function defIds($names) {
        foreach($names as $name) {
            $this->defId($name, false);
        }
    }
    
    /**
     * 
     */
    public function defText() {
        $this->addField('id', 'text')->len(512);
    }

    /**
     * 
     * @param type $name
     */
    public function defVarchar($name) {
        $this->addField($name, 'varchar')
                ->len(100)
                ->def('not null')
                ->compare('utf-8');
    }

    /**
     * 
     * @param type $names
     */
    public function defVarchars($names) {
        foreach($names as $name) {
            $this->defVarchar($name);
        }
    }
    
    public function write() {
        
    }
}
