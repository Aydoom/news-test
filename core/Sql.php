<?php

namespace core;

/**
 * Description of SQL
 *
 * @author Aydoom
 */
class Sql {
    
    static $table;
    
    static public function getSelect($table, $conditions = []) {
        self::$table = $table;
        $sql = 'SELECT ' . self::getFields($table, $conditions)
                                                    . ' FROM `' . $table . '`';
        
        $sql.= self::getConditions($conditions);
        
        return $sql;
    }
    
    static public function getFields($table, $conditions) {
        if (!empty($conditions['fields'])) {
            if (!is_array($conditions['fields'])) {
                $conditions['fields'] = [$conditions['fields']];
            }
            foreach($conditions['fields'] as &$field) {
                $field = "`$table`.`$field`";
            }
            
            $fields = implode(", ", $conditions['fields']);
        } else {
            $fields = "*";
        }
        
        return $fields;
    }
    
    static public function getConditions($conditions) {
        $output = [];
        foreach($conditions as $operator => $value) {
            switch ($operator) {
                case 'left join':
                    $output[5] = self::getLeftJoin($value);                    
                    break;
                case 'where':
                    $output[10] = self::getWhere($value);                    
                    break;
                case 'order by':
                    $output[15] = self::getOrderBy($value);
                    break;
                case 'limit' :
                    $output[20] = "LIMIT $value";
                    break;
            }
        }
        ksort($output);
        
        return implode(" ", $output);
    }

    
    static public function getOrderBy($value) {
        if (!is_array($value)) {
            $value = ['asc' => $value];
        }
        
        $output = [];
        foreach($value as $type => $fields) {
            if (!is_array($fields)) {
                $fields = [$fields];
            }
            
            foreach($fields as $field) {
                $output[]= "`$field` " . strtoupper($type);
            }
        }
        
        return "ORDER BY " . implode(", ", $output);
    }    
    
    
    static public function getWhere($conditions) {
        $handler = function ($field, $val, $glue, $hasGlue) {
            $matches = [];
            if (substr_count($val, "LIKE") === 1 || substr_count($val, "%") > 0) {
                $sign = "LIKE";
            } else {
                preg_match_all('/([=!<>]+)(.+)/u', "=$val", $matches);
                $sign = (strlen($matches[1][0]) > 1) ? ltrim($matches[1][0], "=") 
                        : $matches[1][0];
            }
            $echoGlue = ($hasGlue) ? strtoupper($glue) : "";
                                                            
            return " $echoGlue `" . self::$table . "`.`$field` $sign :$field";             
        };
        
        if (is_array($conditions)) {
            $output = " WHERE ";
            
            $hasGlue = false;
            foreach($conditions as $field => $val) {
                
                if(is_array($val)) {
                    foreach($val as $f => $v) {
                        $output.= $handler($f, $v, $field, $hasGlue);
                        $hasGlue = true;
                    }
                } else {
                    $output.= $handler($field, $val, "AND", $hasGlue);
                    $hasGlue = true;
                }
            }
        } else {
            $output = NULL;
        }
        
        return $output;
    }
}
