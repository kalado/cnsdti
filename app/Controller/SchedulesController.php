<?php
App::uses('AppController', 'Controller');

class SchedulesController extends AppController {
	
	public $uses = array("Schedule","Schedulesfixe","Equipment");
	
	public function equipment($id = null){
		$this->set('title_for_layout', 'Agendar ');
        if(isset($id)){
	        $equipamento = $this->Equipment->findById($id);
	        $this->set("equipamento",$equipamento);
        } else {
	        $this->redirect("/equipment/index");
        }
    }
    
    public function getschedules(){
    	$this->layout = "ajax";
	    $id = $_POST['id'];
	    $data = $_POST['date'];
	    $agendamentos = $this->Schedule->find("all", array("conditions"=>"Schedule.equipment_id=".$id." AND Schedule.date = '".$this->generateDate($data)."'","fields"=>array("id","hour","rotation","classroom","clientname")));
	    
	    if($data == date("d-m-Y")){
	    	$agendamentos[0]["dtAtual"] = "true";
	    } else {
		    $agendamentos[0]["dtAtual"] = "false";
	    }
	    
	    $this->set("json",$agendamentos);
	    $this->render("json");
    }
    
    public function saveschedules(){
	    $this->layout = "ajax";
	    $id = $_POST['id'];
	    $data = $_POST['date'];
	    $classroom = $_POST['classroom'];
	    $ids = $_POST['ids'];
	    $cliente = $_POST['clientname'];
	    
	    foreach($ids as $ideq){
		 	$agendamento = explode(".",$ideq);
		 	
		 	$dados['Schedule']['id'] = "";
		 	$dados['Schedule']['client_id'] = "1";
		 	$dados['Schedule']['equipment_id'] = $id;
		 	$dados['Schedule']['date'] = $this->generateDate($data);
		 	$dados['Schedule']['hour'] = $agendamento[1];
		 	$dados['Schedule']['rotation'] = $agendamento[0];
		 	$dados['Schedule']['classroom'] = $classroom;
		 	$dados['Schedule']['clientname'] = $cliente;
		 	
		 	$this->Schedule->save($dados);
	    }
	    
	    $agendamentos = $this->Schedule->find("all", array("conditions"=>"Schedule.equipment_id=".$id." AND Schedule.date = '".$this->generateDate($data)."'","fields"=>array("id","hour","rotation","clientname","classroom")));
	    
	    if($data == date("d-m-Y")){
	    	$agendamentos[0]["dtAtual"] = "true";
	    } else {
		    $agendamentos[0]["dtAtual"] = "false";
	    }
	    
	    $this->set("json",$agendamentos);
	    $this->render("json");
    }
    
    public function getschedulesfixes(){
    	$this->layout = "ajax";
	    $id = $_POST['id'];
	    $data = $_POST['date'];
	    $agendamentos = $this->Schedulesfixe->find("all", array("conditions"=>"Schedule.equipment_id=".$id." AND Schedule.date = '".$this->generateDate($data)."'","fields"=>array("id","hour","rotation","classroom","clientname")));
	    
	    if($data == date("d-m-Y")){
	    	$agendamentos[0]["dtAtual"] = "true";
	    } else {
		    $agendamentos[0]["dtAtual"] = "false";
	    }
	    
	    $this->set("json",$agendamentos);
	    $this->render("json");
    }
}
?>