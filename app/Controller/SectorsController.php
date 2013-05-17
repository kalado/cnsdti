<?php
App::uses('AppController', 'Controller');

class SectorsController extends AppController {
	
	public function index($msg = null){
        $this->set('title_for_layout', 'Listagem de Setores');
        $this->paginate = array(
            'limit' => 10
        );
        $data = $this->paginate('Sector');
        
        if(isset($msg)){
            $this->set("msg",$msg);
        }
        
        $this->set("listRegistros", $data);
    }
    
    public function add(){
    	$this->set('title_for_layout', 'Adicionar Setor');
        
        if(isset($this->request->data['Sector'])){
            $this->Sector->save($this->request->data);
            $this->redirect("/sectors/index/ok");
        }
    }
    
    public function edit($id = null){
    	$this->set('title_for_layout', 'Editar Setor');
        
        if(empty($this->request->data)) {
            $this->request->data = $this->Sector->findById($id);
        } else {
            $this->request->data['Sector']['id'] = $id;
            $this->Sector->save($this->request->data);
            
            $this->redirect("/sectors/index/editok");
        }
        
        $this->render("add");
    }
    
    public function delete($id = null){
        $this->Sector->delete($id);
        $this->redirect("/sectors/index/editok");
    }
    
    public function multidelete(){
        foreach($this->request->data as $id) {
            $this->Sector->delete($id['Sector']["id"]);
        }
        $this->redirect("/sectors/index/editok");
    }
}
?>