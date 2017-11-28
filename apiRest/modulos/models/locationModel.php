<?php

require_once('./core/dbAbstractModel.php');


class Location extends dbAbstractModel{
	
public $point1_lat
public $point1_long
public $point2_lat
public $point2_long
public $unit = 'km'
public $decimals = 2

	function __construct() {
		$this->dbname = 'tinderparada';

	}





}
?>