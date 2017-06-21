<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace core;

/**
 * Description of DB
 *
 * @author Aydoom
 */
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
            die('Подключение не удалось: ' . $e->getMessage());
        }        
    }
    
    /**
     * 
     * @param type $conditions
     * @return type
     */
    public function count($conditions = []) {
        $sql = 'SELECT COUNT(*) FROM `' . $this->table . '`';
        $sql.= Sql::getConditions($conditions);
        
        $query = $this->prepare($sql);
        $cond = (empty($conditions['where'])) ? [] : $conditions['where'];
        $query->execute($cond);
        $output = $query->fetchAll();

        return $output[0][0];
    }

    
    /**
     * 
     * @param type $conditions
     * @return type
     */
    public function find($conditions = []) {
        $query = $this->prepare(Sql::getSelect($this->table, $conditions));
        $cond = (empty($conditions['where'])) ? [] : array_map(
                    function ($item) {
                        return trim($item, "<>=!");   
                    }, $conditions['where']);
        
        $query->execute($cond);

        if (isset($conditions['left join'])) {
            $result = Stmt::fetchAll($query);
        } else {
            $result = $query->fetchAll(\PDO::FETCH_ASSOC);
        }

        return $result;
    }
    
    /**
     * 
     * @param type $data
     * @return type
     */
    public function insert($data) {
        $query = $this->prepare("INSERT INTO `" . $this->config['dbname'] . '`.`'
                    . $this->table . "` " . "("
                    . implode(", ", array_keys($data)) . ")"
                    . " VALUES(:" . implode(", :", array_keys($data)) . ")");
       
        $query->execute($data);
        if(!$query) {
            pr($this->errorInfo());
        }

        return $this->lastInsertId();
    }

}
