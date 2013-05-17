<?php
App::uses('AppController', 'Controller');

class TypesdevicesController extends AppController {
	
	public function index($msg = null){
        $this->set('title_for_layout', 'Listagem de Dispositivos');
        $this->paginate = array(
            'limit' => 10
        );
        $data = $this->paginate('Typesdevice');
        
        if(isset($msg)){
            $this->set("msg",$msg);
        }
        
        $this->set("listRegistros", $data);
    }
    
    public function add(){
    	$this->set('title_for_layout', 'Adicionar Tipo de Dispostivo');
        
        if(isset($this->request->data['Typesdevice'])){
            $this->Typesdevice->save($this->request->data);
            $this->redirect("/typesdevices/index/ok");
        }
    }
    
    public function edit($id = null){
    	$this->set('title_for_layout', 'Editar Tipo de Dispostivo');
        
        if(empty($this->request->data)) {
            $this->request->data = $this->Typesdevice->findById($id);
        } else {
            $this->request->data['Typesdevice']['id'] = $id;
            $this->Typesdevice->save($this->request->data);
            
            $this->redirect("/typesdevices/index/editok");
        }
        
        $this->render("add");
    }
    
    public function delete($id = null){
        $this->Typesdevice->delete($id);
        $this->redirect("/typesdevices/index/editok");
    }
    
    public function multidelete(){
        foreach($this->request->data as $id) {
            $this->Typesdevice->delete($id['Typesdevice']["id"]);
        }
        $this->redirect("/typesdevices/index/editok");
    }
}
?>