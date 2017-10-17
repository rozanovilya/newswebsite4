<?php
require_once ("/../models/model_menu.php"); 
class Controller_Pages extends Controller
{
	function __construct()
	{
		parent::__construct();
		$this->menu = new Menu();
	}
	function action_index()
	{
		//this code doesn't work!!!
		$data = $this->menu; //using oRubrics doesn't work for unknown reason!!!
		var_dump($this);
		$this->view->generate('menu_view.php','template_view.php',$data);
	}
}