<?php
class Sector extends AppModel {
    public $name = 'Sector';
    
    public $hasMany = array(
        'Wifi' => array(
            'className'  => 'Wifi',
            'foreignKey' => 'sector_id',
            'dependent'  => true
        )
    );
}
?>