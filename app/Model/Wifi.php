<?php
class Wifi extends AppModel {
    public $name = 'Wifi';
    public $useTable = 'wifi';
    
    var $belongsTo = array("Sector","Typesdevice");
}
?>