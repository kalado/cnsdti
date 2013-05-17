<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	public $components = array('DebugKit.Toolbar');
	
	public function ifLogin() {
        $session = $this->Session->read("CokatoSession");
        if (isset($session['Session']['id']) && isset($session['Session']['token'])) {
            $cliente = $this->Cliente->find("all", array('conditions' => 'Cliente.token = "' . $session['Session']['token'] . '" AND Cliente.id = ' . $session['Session']['id']));
            if (count($cliente) <> 1) {
                $this->redirect("/gestao/clientes/login");
                return false;
            }
        } else {
            $this->redirect("/gestao/clientes/login");
            return false;
        }
        return true;
    }

    public function gerarUrl($string, $model, $id) {
        $string = Inflector::slug($string);
        str_replace("√¥", "o", $string);
        str_replace("√µ", "o", $string);
        str_replace("√≥", "o", $string);
        str_replace("√≤", "o", $string);
        str_replace("√∂", "o", $string);

        str_replace("√¢", "a", $string);
        str_replace("√£", "a", $string);
        str_replace("√°", "a", $string);
        str_replace("√†", "a", $string);
        str_replace("√§", "a", $string);

        str_replace("√™", "e", $string);
        str_replace("√©", "e", $string);
        str_replace("√®", "e", $string);

        str_replace("√≠", "i", $string);
        str_replace("√¨", "i", $string);

        str_replace("√ß", "c", $string);
        str_replace("ÔøΩ", "", $string);

        $string = strtolower($string);

        $params = array(
            'conditions' => array($model . ".url = '" . $string . "' and " . $model . ".id <> " . $id)
        );
        $url = $this->$model->find('first', $params);

        if ($url != "") {
            $url2 = $string . rand(0, 20);
            $string = $this->gerarUrl($url2, $model);
        }
        return $string;
    }

    public function generateHash($string) {
        return md5($string);
    }
    
    public function generateDate($data){
	    $dt = explode(" ", $data);
	    if(isset($dt[1])){
		    $hora = " ".$dt[1];
	    } else {
		    $hora = "";
	    }
	    	    
	    $dta = explode("-", $dt[0]);
	    
	    return $dta[2]."-".$dta[1]."-".$dta[0].$hora;
    }
}
