<?php

class Controller_Menu extends Controller
{
	function __construct()
	{
		$this->model = new Menu();
		$this->view = new View();
	}
	function action_index()
	{	
		$data = $this->model;
		$this->view->generate('menu_view.php', 'template_view.php',$data);
	}
}