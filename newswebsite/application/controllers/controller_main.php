<?php
require_once ("/../models/model_menu.php"); 
require_once ("/../models/model_main.php"); 
class Controller_Main extends Controller
{
	function __construct()
	{
		$this->model = new MainPage();
		$this->view = new View();
		$this->menu = new Menu();
	}

	function action_index()
	{	
		$data = $this->menu->getoRubrics(); //using oRubrics doesn't work for unknown reason!!!
		//var_dump($data);
		//$this->view->generate('menu_view.php','template_view.php',$data);

		//parent::action_index(); //tried to generate menu in parent class but it failed

		if ($_GET["page"] !== null){
			$page = $_GET["page"];
		}
		else {
			$page = 1;
		}
		if ($page <0) $page = 1;

		$items = 5; //number of news on the page
		$start = $page * $items - $items;  
		$data3= $page;
		$count = $this->model->countModel();
		$totalpages = ceil($count/$items);
		$data4=$totalpages;

		$data = $this->model->getoNews($start,$items);	
		//var_dump($data);
		$items = 3; //number of news on the page
		$start = 0;

		$dataleft = $this->model->getoNews($start,$items);
		$this->view->generate('main_view.php', 'template_view.php',$data, null,$data3,$data4,$dataleft);
	}
}