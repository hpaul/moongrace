<?php 

class Welcome extends Controller {
	public function __construct() {
			
	}
	
	public function index()
	{
		$this->loadView('index');
	}

	public function shit()
	{
		echo 'Mananci cacat';
	}
}

?>
