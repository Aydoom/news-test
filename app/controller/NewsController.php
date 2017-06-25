<?php
namespace app\controller;
use core\Controller;

class NewsController extends Controller {
    
    public $view = 'news/show';
    public $newsModel;
    
    
    public function before() {
        $this->newsModel = $this->loadModel('news');
    }
    
    
    public function index() {
        $this->view = 'news/index';
    }


    public function show() {
        $countNews = $this->_getParams('countNews');
        $keyword = $this->_getParams('keyword');
        $search = $this->_getParams('search');

        $start = (empty($countNews)) ? 0 : $countNews;
        $conditions = [
            'limit' => $start . ", 20",
            'order by' => ['desc' => 'registerDate'],
        ];
        
        if (!empty($keyword)) {
            $conditions['where'] = ['keywords' => '%' . $keyword . ',%'];
        }
        if (!empty($search)) {
            $conditions['where'] = ['title' => '%' . $search . '%'];
        }

        $articles = $this->newsModel->find($conditions);
        foreach ($articles as $key => $value) {
            $articles[$key]['keywords'] = explode(",", $value['keywords']);
        }

        $this->_set('articles', json_encode($articles));
    }


    public function create() {
        $data = $this->_getParams('form');
        
        if ($this->newsModel->validate($data)) {
            if ($this->newsModel->save($data)) {
                $this->_set('articles', json_encode($data));
            } else {
                $this->_error('Сохранить новость не удалось');
            }
        } else {
            $this->_error('Не все поля заполнены');
        }
    }
    

    public function update() {
        $data = $this->_getParams('form');
        
        if ($this->newsModel->validate($data)) {
            if ($this->newsModel->save($data)) {
                $this->_set('articles', json_encode($data));
            } else {
                $this->_error('Изменить новость не удалось');
            } 
        } else {
            $this->_error('Не все поля заполнены');
        }
    }


    public function delete() {
        $id = $this->_getParams('id');
        
        if ($this->newsModel->delete($id)) {
            $this->_set('articles', true);
        } else {
            $this->_error('Удалить не получилось');
        }
    }
    
 
    private function _getParams($name) {
        switch ($name) {
            case in_array($name, ['id, countNews']):
                return filter_input(INPUT_GET, $name, FILTER_SANITIZE_NUMBER_INT);
            case in_array($name, ['keyword, search']):
                return filter_input(INPUT_GET, $name, FILTER_SANITIZE_STRING);
            default:            
                $params = json_decode(file_get_contents('php://input'), true);
                return $params['params'][$name];
        }
    }

    
    private function _error($msg) {
        $this->view = 'news/error';
        $this->_set('error', $msg);
    }
}
