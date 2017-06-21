<?php

namespace app\model;

use core\Model;

/**
 * Description of NewsModel
 *
 * @author Aydoom
 */
class NewsModel extends Model {
    public $validRules = [
        'name' => [
            ['rule' => 'required', 'message' => 'it must be filled'],
            ['rule' => 'name'],
            ['rule' => 'lenght', 'min' => 3, 'max' => 15],
        ],
    ];
    
    public function save($data) {
        
        return parent::save([
            'name'          => $data['name'],
            'registerDate'  => date("Y-m-d H:i:s")
        ]);
    }

}
