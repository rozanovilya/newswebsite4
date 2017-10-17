<?php
require_once ("/../models/model_menu.php"); 
require_once("/../models/model_main.php");
//require_once ("controller_pages.php"); 
class Controller_News extends Controller
{
	function __construct()
	{
		$this->model = new News();
		$this->view = new View();
		$this->menu = new Menu();
	}
	function action_index($id = null)
	{

		if ($_POST){
			//var_dump($_POST);
			$oComment = new Comment;
			$oComment->CommentText = $_POST['commenttext'];
			$oComment->NewsId = $id;
			$oComment->CommentDate = Date(DATE_RFC822);
			$username = $_POST['username'];
			$passwordHash = crypt($_POST['password'], '$2a$07$rozanovilyausessomesillystringforsalt$'); //password_hash($_POST['password'],PASSWORD_DEFAULT);
			$password = $_POST['password'];
			$oUser = User::getModel($username);
			//var_dump($oUser);
			$data2 = null;
			$oComment->CommentAuthorId = $oUser->UserId;
			$oComment->Moderated = true;
			if ($oUser == null) $data2 =  "Неправильный логин"; 
			else
			{
				if (hash_equals($passwordHash,$oUser->PasswordHash)){ //doesn't work
				Comment::saveModel($oComment); //saving anonymous comments works
				}
				else {
					$data2= "Пароль неверный";
				}
			}

		}

		unset($_POST['username']); //doesn't seem to help
		unset($_POST['password']);
		unset($_POST['commenttext']);
		$_POST = array();

		$data = $this->menu->getoRubrics(); //using oRubrics doesn't work for unknown reason!!!
		//var_dump($data);
		//$this->view->generate('menu_view.php','template_view.php',$data);

		//parent::action_index(); //tried to generate menu in parent class but it failed

		$data = $this->model->getModel($id);	
		//var_dump($data);

		$this->model = new MainPage();
		$items = 3; //number of news on the page
		$start = 0;

		$dataleft = $this->model->getoNews($start,$items);

		$this->view->generate('news_view.php', 'template_view.php',$data,$data2,null,null,$dataleft);
	}
}