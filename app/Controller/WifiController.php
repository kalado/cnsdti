<?php
App::uses('AppController', 'Controller');

class WifiController extends AppController {
	
	public $uses = array("Wifi","Typesdevice", "Sector");
	
	public function index($msg = null){
        $this->set('title_for_layout', 'Listagem de Dispositivos');
        $this->paginate = array(
            'limit' => 10
        );
        $data = $this->paginate('Wifi');
        
        if(isset($msg)){
            $this->set("msg",$msg);
        }
        
        $this->set("listRegistros", $data);
    }
    
    public function add(){
    	$this->set('title_for_layout', 'Adicionar Dispostivo');
        
        if(isset($this->request->data['Wifi'])){
            $this->Wifi->save($this->request->data);
            $this->redirect("/wifi/index/ok");
        }
        
        $typesdevices = $this->Typesdevice->find("list",array("fields"=>"id, name"));
        $sectors = $this->Sector->find("list",array("fields"=>"id, name"));
        $this->set("typesdevices",$typesdevices);
        $this->set("sectors",$sectors);
    }
    
    public function edit($id = null){
    	$this->set('title_for_layout', 'Editar Dispostivo');
        
        if(empty($this->request->data)) {
            $this->request->data = $this->Wifi->findById($id);
        } else {
            $this->request->data['Wifi']['id'] = $id;
            $this->Wifi->save($this->request->data);
            
            $this->redirect("/wifi/index/editok");
        }
        
        $typesdevices = $this->Typesdevice->find("list",array("fields"=>"id, name"));
        $sectors = $this->Sector->find("list",array("fields"=>"id, name"));
        $this->set("typesdevices",$typesdevices);
        $this->set("sectors",$sectors);
        
        $this->render("add");
    }
    
    public function delete($id = null){
        $this->Wifi->delete($id);
        $this->redirect("/wifi/index/editok");
    }
    
    public function multidelete(){
        foreach($this->request->data as $id) {
            $this->Wifi->delete($id['Wifi']["id"]);
        }
        $this->redirect("/wifi/index/editok");
    }
}
?>