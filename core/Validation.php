<?php

namespace core;

/**
 * Description of Validation
 *
 * @author Aydoom
 */
class Validation {
    
    public $model;
    public $exten = [];
    
    public function __construct($model) {
        $this->model = $model;
    }
    
    /**
     * Extention - для подключения дополнительных классов валидации
     * 
     * @param type $name
     * @return type
     */
    public function extention($name) {
        $handName = ucfirst(strtolower($name));
        if (empty($this->exten[$handName])) {
            $className = $handName . 'Validation';
            $this->exten[$handName] = new $className($this->name);
        }
        
        return $this->exten[$handName];
    }
    
    /**
     * Equal - значение поля равно значению сравнения
     * 
     * @param type $data
     * @param type $rule
     * @return type
     */
    public function equal($data, $rule) {
        if (empty($data)) {
            return null;
        } else {
            $message = ($rule['message']) ? $rule['message'] :
                        'it must does match with "' . $rule['field'] . '"';
            $dataForEqual = strtolower($this->model->modelName)
                                . 'Form.' . $rule['field'];

            return ($data == Request::get($dataForEqual)) ? null : $message;
        }
    }
    
    /**
     * 
     * @return type
     */
    public function getListRules() {
        $methods = get_class_methods($this);
        $ignore = ['__construct'];
        
        foreach($ignore as $method) {
            $key = array_search($method, $methods);
            unset($methods[$key]);
        }
        
        return $methods;
    }
    
    /**
     * Name - значение поля только буквы, числа, точки, запятые и тире
     * 
     * @param type $data
     * @param type $rule
     * @return type
     */
    public function name($data, $rule) {
        if (empty($data)) {
            return null;
        } else {
            preg_match("/[a-zA-Zа-яА-ЯЁё,.\:\)\(\-\d\s]*/u", $data, $matches);
            $message = ($rule['message']) ? $rule['message'] :
                        'Только буквы, цифры и знаки препинания';

            return ($data !== $matches[0]) ? $message : null;
        }
    }
    
    /**
     * Numbers - значение поля только цифры
     * 
     * @param type $data
     * @param type $rule
     * @return type
     */
    public function numbers($data, $rule) {
        preg_match("/[0-9]*/u", $data, $matches);
        $message = ($rule['message']) ? $rule['message'] :
                    'it must be only numbers';

        return ($data !== $matches[0]) ? $message : null;
    }
    
    
    public function on($nameMethod, $data, $rule, $field) {
        if (empty($data) && $nameMethod !== 'required') {
            return null;
        } else {
            return $this->$nameMethod($data, $rule, $field);
        }
    }

    /**
     * 
     * @param type $data
     * @param type $rule
     * @return type
     */
    public function lenght($data, $rule) {
        if (empty($data)) {
            return null;
        } else {
            $len = mb_strlen($data);
            $min = (empty($rule['min'])) ? 3 : $rule['min'];
            $max = (empty($rule['max'])) ? 10 : $rule['max'];

            $message = ($rule['message']) ? $rule['message'] :
                        'length is must be between '
                        . $min . " - " . $max;

            return ($len >= $min && $len <= $max) ? null : $message;
        }
    }
    
    /**
     * 
     * @param type $data
     * @param type $rule
     * @return type
     */
    public function required($data, $rule) {
        return (empty($data)) ? $rule['message'] : null;
    }
    
    /**
     * 
     * @param type $data
     * @param type $rule
     * @return type
     */
    public function text($data, $rule) {
        if (empty($data)) {
            return null;
        } else {
            preg_match("/[a-zA-Zа-яА-ЯЁё,.\s]*/u", $data, $matches);

            return ($data !== $matches[0]) ? $rule['message'] : null;
        }
    }
    
    /**
     * 
     * @param type $data
     * @param type $rule
     * @return type
     */
    public function textEn($data, $rule) {
        if (empty($data)) {
            return null;
        } else {
            preg_match("/[a-zA-Z,.\s]*/", $data, $matches);

            return ($data !== $matches[0]) ? $rule['message'] : null;
        }
    }
    
    /**
     * 
     * @param type $data
     * @param type $rule
     * @param type $field
     * @return type
     */
    public function unique($data, $rule, $field) {
        if (empty($data)) {
            return null;
        } else {
            $message = ($rule['message']) ? $rule['message'] :
                'it must be unique';
            $result = $this->model->find([
                'where' => [$field => $data],
                'limit' => 1]);

            return (empty($result)) ? null : $message;
        }
    }
}
