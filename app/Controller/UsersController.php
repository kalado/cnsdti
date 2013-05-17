<?php
App::uses('AppController', 'Controller');

class UsersController extends AppController {
	
	public function index($msg = null){
        $this->set('title_for_layout', 'Listagem de Usuários');
        $this->paginate = array(
            'limit' => 10
        );
        $data = $this->paginate('User');
        
        if(isset($msg)){
            $this->set("msg",$msg);
        }
        
        $this->set("listRegistros", $data);
    }
    
    public function add(){
    	$this->set('title_for_layout', 'Adicionar Usuário');
        
        if(isset($this->request->data['User'])){
            $this->request->data['User']['password'] = $this->generateHash($this->request->data['User']['password']);
            $this->User->save($this->request->data);
            $this->redirect("/users/index/ok");
        }
    }
    
    public function edit($id = null){
    	$this->set('title_for_layout', 'Editar Usuário');
        
        if(empty($this->request->data)) {
            $this->request->data = $this->User->findById($id);
        } else {
            $this->request->data['User']['id'] = $id;
            $this->User->save($this->request->data);
            
            $this->redirect("/users/index/editok");
        }
        
        $this->render("add");
    }
    
    public function delete($id = null){
        $this->User->delete($id);
        $this->redirect("/users/index/editok");
    }
    
    public function multidelete(){
        foreach($this->request->data as $id) {
            $this->User->delete($id['User']["id"]);
        }
        $this->redirect("/users/index/editok");
    }
    
    public function login($msg = ""){
    	$this->layout = false;
        if(!empty($this->request->data)){
            $this->request->data['User']['senha'] = md5($this->request->data['User']['senha']);
            $dados = $this->User->find("all", array("limit"=>"1","conditions" => array("User.login = '".($this->request->data['User']['login'])."'", "User.senha = '".($this->request->data['User']['senha'])."'")));
            if(count($dados) == 1){
                $sessionDados['Session']['id'] = $dados[0]['User']['id'];
                $sessionDados['Session']['nome'] = $dados[0]['User']['nome'];
                if($this->Session->write("CokatoAdminSession",$sessionDados)){
                    $this->redirect("/users/");
                } else {
                    $this->set("msg","Senha ou Usuário incorreto, favor tentar novamente");
                };
            } else {
                $this->set("msg","Senha ou Usuário incorreto, favor tentar novamente");
            }
        }
    }
	
}
?>