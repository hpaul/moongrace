<?php

class Registry {
	
	public static $_instance = '';

	public static $uri = array();
	
	public static function singleton() {
		if(empty(self::$_instance)) {
			$obj = __CLASS__;
			self::$_instance = $obj;
		}
		return self::$_instance;
	}
}