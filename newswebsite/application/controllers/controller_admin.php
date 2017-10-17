<?php
require_once ("/../models/model_menu.php"); 
require_once ("/../models/model_main.php"); 
class Controller_Admin extends Controller
{
	function __construct()
	{
		$this->model = new MainPage();
		$this->view = new View();
	}

	function action_index()
	{	

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
		$this->view->generate('admin_view.php', 'template_view.php',$data,null,$data3,$data4);
	}
}