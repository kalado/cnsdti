<?php
class Client extends AppModel {
    public $name = 'Client';
    
    public $hasMany = array(
        'Schedule' => array(
            'className'  => 'Schedule',
            'foreignKey' => 'client_id',
            'dependent'  => true
        )
    );
}
?>