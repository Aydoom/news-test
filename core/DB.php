<?php
namespace core;

class DB extends \PDO{

    public $table;
    public $config;
    
    /**
     * Constructor
     * @param type $config
     */
    public function __construct($config, $table) {
        $this->config = $config;
        $this->table = $table;
        
        $dns = 'mysql:host=' . $config['host']
                . ';port=3306;dbname=' . $config['dbname'];
        
        $options = [\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'];
        
        try {
            parent::__construct($dns, $config['user'], $config['password'], $options);
        } catch (PDOException $e) {
            Error::msg('Подключение не удалось: ' . $e->getMessage());
        }        
    }

    
    public function delete($id) {
        $query = $this->prepare("DELETE FROM `" . $this->table . "` WHERE id = ?");
        $result = $query->execute([$id]); 

        return $result;
    }
    
    /**
     * 
     * @param type $conditions
     * @return type
     */
    public function find($conditions = []) {
        $query = $this->prepare(Sql::getSelect($this->table, $conditions));
        if (!empty($conditions['where'])) {
            foreach ($conditions['where'] as $field => $value) {
                $cond[":$field"] = trim(str_replace("LIKE", "", $value), "<>=!");
            }
        }
        $query->execute($cond);
        
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    
    public function insert($data) {
        $query = $this->prepare("INSERT INTO `" . $this->config['dbname'] . '`.`'
                    . $this->table . "` " . "("
                    . implode(", ", array_keys($data)) . ")"
                    . " VALUES(:" . implode(", :", array_keys($data)) . ")");
       
        $result = $query->execute($data);
        if(!$result) {
            Error::msg($this->errorInfo());
        }

        return ($result);
    }
    

    public function update($data) {
        $path = [];
        foreach ($data as $field => $value) {
            $path[]= " $field=:$field";
        }

        $sql = "UPDATE `" . $this->config['dbname'] . '`.`' . $this->table
                . "` SET " . implode(", ", $path);
        $query = $this->prepare($sql . ' WHERE id=:id');
        
        $result = $query->execute($data);
        if(!$result) {
            Error::msg($this->errorInfo());
        }

        return ($result);
    }

}
