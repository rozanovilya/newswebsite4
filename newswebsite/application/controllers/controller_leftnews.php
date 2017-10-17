<?php
require_once ("/../models/model_menu.php"); 
require_once ("/../models/model_main.php"); 
class Controller_LeftNews extends Controller
{
	function __construct()
	{
		$this->model = new MainPage();
		$this->view = new View();
		$this->menu = new Menu();
	}

	function action_index()
	{	


		$items = 3; //number of news on the page
		$start = 1;

		$dataleft = $this->model->getoNews($start,$items);	
		$this->view->generate('leftnews_view.php', 'template_view.php',$dataleft, null,null,null);
	}
}