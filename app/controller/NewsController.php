<?php 

namespace app\controller;

use core\controller;
use core\request;

class NewsController extends Controller {
	
    public function index() {
    }
     
     public function show(){
        $page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_NUMBER_INT);
        $keyword = filter_input(INPUT_GET, 'keyword', FILTER_SANITIZE_STRING);
        $search = filter_input(INPUT_GET, 'search', FILTER_SANITIZE_STRING);
        
        if (empty($page)) {
            $page = 1;
        }
        
        $news = $this->loadModel('news');
        $conditions = [
            'limit' => ($page - 1) * 20 . ", 20",
            'order by' => ['desc' => 'registerDate'],
        ];
        if (!empty($keyword)) {
            $conditions['where'] = ['keywords' => '%' . $keyword . ';%'];
        }
        if (!empty($search)) {
            $conditions['where'] = ['title' => '%' . $search . '%'];
        }
        $articles = $news->find($conditions);
        
        foreach ($articles as $key => $value) {
            $articles[$key]['keywords'] = explode(";", $value['keywords']);
        }
        
        $this->_set('articles', json_encode($articles));
     }

    /**
     * Add News
     */
    public function create() {
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
        $params = json_decode(file_get_contents('php://input'),true);
        $data = $params['params']['form'];
        pr($data);
        $news = $this->loadModel('news');
        if ($news->save($data)) {
            return 'ok';
        } else {
            return 'error';
        }
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
