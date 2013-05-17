<?php
class Typesdevice extends AppModel {
    public $name = 'Typesdevice';
    
    public $hasMany = array(
        'Wifi' => array(
            'className'  => 'Wifi',
            'foreignKey' => 'typesdevice_id',
            'dependent'  => true
        )
    );
}
?>