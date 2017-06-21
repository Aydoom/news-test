<?php 

namespace app\controller;

use core\controller;
use core\request;

class NewsController extends Controller {
	
    public function index($page = 1) {
    }
     
     public function show(){
        $page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_NUMBER_INT);
        if (empty($page)) {
            $page = 1;
        }
        
        $news = $this->loadModel('news');

        $articles = $news->find([
            'limit' => ($page - 1) * 20 . ", 20", 
            'order by' => ['desc' => 'registerDate'],
        ]);
        
        foreach ($articles as $key => $value) {
            $articles[$key]['keywords'] = explode(";", $value['keywords']);
        }
        
        $this->_set('articles', json_encode($articles));
     }

    /**
     * Add News
     */
    public function add() {
        $session = $this->loadModel('session');
        $error = '';
        if ($this->isPut() && $session->validation() && $session->fileValidation()) {
            if($session->save(Request::get("sessionForm"))) {
                $files = new File();
                $files->getFromForm("sessionForm", 'files', $session->lastId);
                if($files->save(FILES)) {
                    $pars = new iBDL\Plugins\Sensor\Parser();
                    $file = $this->loadModel('file');
                    $file->save($files->getAll(), $session->lastId);
                }
                
                $this->redirect("session/index");
            }
            
        }
        
        $this->_set('title', 'Создание сессии' . $error);
    }



    public function update() {
        
    }



    public function remove() {

    }



    public function view($id) {
        $model = $this->loadModel('session')->belongTo('file');
        
        $session = $model->find([
            'where' => ['id_user' => Auth::$user['id'], 'id' => $id]
        ]);
        $this->_set('session', $session[0]);
        
    }

	
}
