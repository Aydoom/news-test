<?php

namespace core;

/**
 * Description of Stmt
 *
 * @author Aydoom
 */
class Stmt {

    //public $has_join = false;
    public $tables = [];
    
    static public function fetchAll($data) {
        $stmt = new static();
        $rows = $data->fetchAll(\PDO::FETCH_NUM);
        $columns = $stmt->getColumns($data);
        $output = [];
        foreach ($rows as $row) {
            $index = $row[0];
            foreach ($row as $colNum => $value) {
                $table = $columns[$colNum]['table'];
                $name = $columns[$colNum]['name'];
                if ($stmt->isMainTable($table)) {
                    $output[$index][$name] = $value;
                } elseif ($name == 'id') {
                    $index2 = $value;
                    $output[$index][$table][$index2][$name] = $value;
                } else {
                    $output[$index][$table][$index2][$name] = $value;
                }
            }  
        }
        
        return $stmt->inReadable($output);
    }
    
    public function getColumns($data) {
        $countColumns = $data->columnCount();
        $result = [];
        for ($i = 0; $i < $countColumns; $i++) {
            $column = $data->getColumnMeta($i);
            $result[$i] = [
                'table' => $column['table'],
                'name' => $column['name']
            ];
            if ($i == 0) {
                $this->tables['main'] = $column['table'];
            } else {
                $this->tables['slave'][] = $column['table'];
            }
        }
        
        return $result;
    }
    
    public function isMainTable($tableName) {
        return ($tableName === $this->tables['main']);
    }
    
    public function isSlaveTable($tableName) {
        return (in_array($tableName, $this->tables['slave']));
    }
    
    public function inReadable($rows) {
        $result = array_values($rows);
        foreach($result as $num => $row) {
            foreach($row as $colName => $val) {
                if($this->isSlaveTable($colName)) {
                    $result[$num][$colName] = array_values(($val));
                }
            }
        }
        
        return $result;
    }
}