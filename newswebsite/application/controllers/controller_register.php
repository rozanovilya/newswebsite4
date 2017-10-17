<?php
require_once ("/../models/model_menu.php"); 
require_once ("/../models/model_user.php"); 
require_once("/../models/model_main.php");
class Controller_Register extends Controller
{
	function __construct()
	{
		$this->model = new User();
		$this->view = new View();
		$this->menu = new Menu();
	}
	function action_index($id)
	{	
		$data = $this->menu->getoRubrics(); //using oRubrics doesn't work for unknown reason!!!
		//var_dump($data);
		//$this->view->generate('menu_view.php','template_view.php',$data);

		$data = null;
		if ($_POST){
			$UserName = $_POST['username'];
			$PasswordHash = crypt($_POST['password'], '$2a$07$rozanovilyausessomesillystringforsalt$'); //password_hash($_POST['password'],PASSWORD_DEFAULT);
			$oUser = User::getModel($UserName);
			If ($oUser){
				$data = "Пользователь с таким логином уже существует!";
			}
			else{
				$oUser = New User;
				$oUser->UserName = $UserName;
				$oUser->PasswordHash = $PasswordHash;
				$oUser->Administrator = false;
				$oUser->Journalist = false;
				$oUser->Editor = false;
				$oUser->Moderator = false;
				User::saveModel($oUser);
				$data = "Вы успешно зарегистрированы";
			}	
		}
		else {
			$data = null;
		}


		$this->model = new MainPage();
		$items = 3; //number of news on the page
		$start = 0;

		$dataleft = $this->model->getoNews($start,$items);

		$this->view->generate('register_view.php','template_view.php',$data,null,null,null,$dataleft);
	}
}