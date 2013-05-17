<?php
App::uses('AppController', 'Controller');

class EquipmentsController extends AppController {
	
	public function index($msg = null){
        $this->set('title_for_layout', 'Listagem dos Equipamentos');
        $this->paginate = array(
            'limit' => 10
        );
        $data = $this->paginate('Equipment');
        
        if(isset($msg)){
            $this->set("msg",$msg);
        }
        
        $this->set("listRegistros", $data);
    }
    
    public function add(){
    	$this->set('title_for_layout', 'Adicionar Equipamento');
        
        if(isset($this->request->data['Equipment'])){
            $this->Equipment->save($this->request->data);
            $this->redirect("/equipments/index/ok");
        }
    }
    
    public function edit($id = null){
    	$this->set('title_for_layout', 'Editar Equipamento');
        
        if(empty($this->request->data)) {
            $this->request->data = $this->Equipment->findById($id);
        } else {
            $this->request->data['Equipment']['id'] = $id;
            $this->Equipment->save($this->request->data);
            
            $this->redirect("/equipments/index/editok");
        }
        
        $this->render("add");
    }
    
    public function delete($id = null){
        $this->Equipment->delete($id);
        $this->redirect("/equipments/index/editok");
    }
    
    public function multidelete(){
        foreach($this->request->data as $id) {
            $this->Equipment->delete($id['Equipment']["id"]);
        }
        $this->redirect("/equipments/index/editok");
    }
}
?>