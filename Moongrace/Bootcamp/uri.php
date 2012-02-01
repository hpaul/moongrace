<?php
/**
 * URI Base
 *
 * @package Moongrace
 * @author  Claudiu Tașcă
 * @copyright 2011 - 2012
 */

class Uri extends Application {

	private $string = '';
	private $segments = array();

	/**
	 * Loads the request URI, prepares it and loads it into $segments
	 *
	 * @return void
	 * @author Claudiu Tașcă
	 */
	public function __construct() {
		$this -> string = $this -> get_uri_string();
		$this -> set_array();
	}
	
	public function __get($what='')
	{
		if($what == 'string') return $this->string;
	}

	/**
	 * Get uri string
	 *
	 * @return string
	 */
	public function get_uri_string() {
		
		//Parse the request URI
		$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

		//Explode controller action and rest segments
		//Clean empty key
		$uri = array_merge(array_diff(explode('/',$uri), array('')));

		return $uri;
	}

	/**
	 * Set uri array
	 *
	 * @return void
	 * @author Claudiu Tașcă
	 */
	private function set_array() {
		$this -> segments = explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
		if((!isset($this -> segments[1]) || empty($this -> segments[1])) || (!isset($this -> segments[0]) || $this -> segments[0]) == '')
			$this -> segments[1] = 'index';
		if(!isset($this -> segments[0]) || $this -> segments[0] == '')
			$this -> segments[0] = DEFAULT_CONTROLLER;
	}

	/**
	 * Route the current URL to specific Controller and action
	 *
	 * Default controller defined in config
	 * Default action is index
	 * @return array
	 */
	public function route($uri_string = array()) {
		if(!isset($uri_string[0])) {
			$router['Controller'] = Config::default_action;
			$router['Action'] = 'index';
		}
		
		//We nedd to know if the request has input
		elseif(count($uri_string) > 2) {
			$router['Controller'] = $uri_string[0];
			$router['Action'] = $uri_string[1];
			
			uset($uri_string[0]);
			uset($uri_string[1]);
			foreach($uri_string as $input) {
				$router['input'][] = $input;
			}
		}
		elseif(!isset($uri_string[1])) {
			$router['Controller'] = $uri_string[0];
			$router['Action'] = 'index';
		}
		else {
			$router['Controller'] = $uri_string[0];
			$router['Action'] = $uri_string[1];
		}

		return $router;
	}

	/**
	 * Returns segment array
	 *
	 * @return array
	 * @author Claudiu Tașcă
	 */
	public function segments() {
		if(empty($this -> segments))
			return array();
		return $this -> segments;
	}

	/**
	 * Returns segment
	 *
	 * @return string
	 * @param $id (Segment ID)
	 * @example uri::segments(0) = CONTROLLER
	 * @author Claudiu Tașcă
	 */
	public function segment($id = 0) {
		return $this -> segments[$id];
	}

	/**
	 * Returns URI string
	 *
	 * @return string
	 * @author Claudiu Tașcă
	 */
	public function uri_string() {
		return $this -> string;
	}

}
?>
