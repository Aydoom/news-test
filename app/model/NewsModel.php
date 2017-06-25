<?php
namespace app\model;
use core\Model;

class NewsModel extends Model {
    
    
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
    
    
    public function validate($data) {
        
        return (!empty($data['title']) && !empty($data['shortText']));
    }
}
