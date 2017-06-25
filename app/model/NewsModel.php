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
        $dataSave = [
            'title' => $data['title'],
            'shortText' => $data['shortText'],
            'keywords' => (is_array($data['keywords'])) 
                            ? implode(", ", $data['keywords']) : $data['keywords']
        ];
        $dataSave['keywords'] = trim($dataSave['keywords'], ',') . ',';
        
        if (!empty($data['id'])) {
            $dataSave['id'] = $data['id'];
        }
        
        if (!empty($data['registerDate'])) {
            $dataSave['registerDate'] = $data['registerDate'];
        } else {
            $dataSave['registerDate'] = date("Y-m-d H:i:s");
        }
        
        return parent::save($dataSave);
    }

}
