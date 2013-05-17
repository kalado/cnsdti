<?php
class Equipment extends AppModel {
    public $name = 'Equipment';
    public $useTable = "equipments";
    
    public $hasMany = array(
        'Schedule' => array(
            'className'  => 'Schedule',
            'foreignKey' => 'equipment_id',
            'dependent'  => true
        )
    );
}
?>