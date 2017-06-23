<?php 

namespace PMMigration\Tables;

class KeyTable extends \PMMigration\Core\DefTable {
	
    public $name = 'key';
    public $fields = [];

    /**
     * 
     * @param type $name
     */
    public function __construct($name = false)
    {
        parent::__construct($name);
        
        $this->defId("id");
        $this->defId("id_user_group", false);
        $this->defVarchar("code");
        $this->addField("id_user", 'int')->def("NOT NULL")->len(11);
    }

}