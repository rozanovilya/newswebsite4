<?php
require_once ("/../models/model_menu.php"); 
require_once("/../models/model_main.php");
class Controller_Rubric extends Controller
{
	function __construct()
	{
		$this->model = new Rubric();
		$this->view = new View();
		$this->menu = new Menu();
	}
	function action_index($id)
	{	
		$data = $this->menu->getoRubrics(); //using oRubrics doesn't work for unknown reason!!!
		//var_dump($data);
		//$this->view->generate('menu_view.php','template_view.php',$data);

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

		$data = $this->model->getModel($id);
		$count = $data->countModel($data);

		$totalpages = ceil($count/$items);
		$data4=$totalpages;  

		$data2 = $data->getoNews($start,$items);

		$this->model = new MainPage();
		$items = 3; //number of news on the page
		$start = 0;

		$dataleft = $this->model->getoNews($start,$items);

		$this->view->generate('rubric_view.php', 'template_view.php',$data, $data2,$data3,$data4,$dataleft);
	}
}