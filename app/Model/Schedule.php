<?php
class Schedule extends AppModel {
    public $name = 'Schedule';
    
    var $belongsTo = array("Client","Equipment");
}
?>