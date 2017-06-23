<?php 

namespace PMMigration\Tables;

class UserTable extends \PMMigration\Core\DefTable {
	
    public $name = 'user';
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
        $this->defVarchars(["name", "username"]);
        $this->addField("email", "varchar")->len(100)->def("NULL");
        $this->defVarchar("password");
        $this->addField("block", "tinyint")->def("NULL");
        $this->addField("sendEmail", "tinyint")->def("NULL");
        $this->defDates(["registerDate", "lastvisitDate"]);
        $this->addField("token", "varchar")->len(100)->def("NULL");
    }

}