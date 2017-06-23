<?php 

namespace PMMigration\Core;

use PMMigration\Core\Fields as Fields;
/**
 * 
 */
abstract class Table {
    
    public $name = "table";
    public $fields = [];
    public $insert = [];
 
    abstract public function write();

    /**
     * 
     * @param type $name
     */
    public function __construct($name = false)
    {
        if ($name) {
            $this->name = $name;
        }
        
        $this->write();
    }
 
    /**
     * 
     * @param type $name
     * @param type $type
     */
    public function addField($name, $type)
    {
        switch(strtolower($type)):
            case "datetime": 
                $field = new Fields\DateTimeField($name);
                break;
            case "tinyint": 
                $field = new Fields\TinyIntField($name);
                break;
            default:
                $className = 'PMMigration\\Core\\Fields\\'
                    . ucfirst(strtolower($type)) . "Field";
                $field = new $className($name);
                break;
        endswitch;
        
        $this->fields[$name] = $field;
        
        return $this->fields[$name];
    }
	
    public function getFields() {
        return $this->fields;
    }
    
    /**
     * 
     */
    public function getQuery()
    {
        foreach ($this->fields as $name => $field) {
            $fields[] = $field->getString();
            if ($field->primary) {
                $add = "PRIMARY KEY({$name})";
            }
        }
        
        $query = "CREATE TABLE `{$this->name}` (" . implode(", ", $fields);
            $query.= ($add) ? ", {$add}" : "";
        $query.=")";

        return $query;
    }

    public function setInsert($fields = [], $values = []) {
        $query = "INSERT INTO `{$this->name}` (`" . implode('`, `', $fields) . "`)"
                . "VALUES ('" . implode("', '", $values) . "')";
        
        $this->insert[] = $query;
    }
}