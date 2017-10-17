<?php
require_once ("/../models/model_news.php"); 
require_once ("/../models/model_menu.php"); 
class Controller_Adminnews extends Controller
{
	function __construct()
	{
		$this->model = new News();
		$this->view = new View();
		$this->menu = new Menu();
	}
	function action_index($id=null)
	{	
	//if ($_POST){


		$data = $this->menu->getoRubrics();
		$oNews = New News;
		if ($id){
			$oNews = $this->model->getModel($id);
			//$data=$oNews;
			//var_dump($oNews);
			if ($oNews){
				if(!isset($_POST['NewsRubric'])){
					$_POST['NewsRubric'] = $oNews->oNewsRubric->RubricName;
				}
				if(!isset($_POST['NewsRubricId'])){ 
					$_POST['NewsRubricId'] = $oNews->NewsRubric;
				}
				if(!isset($_POST['SeoH1'])){ 
					$_POST['SeoH1'] = $oNews->SeoH1;
				}
				if(!isset($_POST['SeoTitle'])){ 	
					$_POST['SeoTitle'] = $oNews->SeoTitle;
				}
				if(!isset($_POST['SeoDescription'])){ 
					$_POST['SeoDescription'] = $oNews->SeoDescription;
				}
				if(!isset($_POST['NewsText'])){ 
					$_POST['NewsText'] = $oNews->NewsText;
				}
				if(!isset($_POST['NewsSource'])){ 
					$_POST['NewsSource'] = $oNews->NewsSource;
				}
				if(!isset($_POST['PreviewPhoto'])){ 
					$_POST['PreviewPhoto'] = $oNews->PreviewPhoto;
				}
				//var_dump($_POST);

			}
		}
		if ($id){
			$oNews->NewsId = $id;
		}
		$oNews->NewsDate = Date(DATE_RFC822);
		$oNews->NewsRubric = $_POST['NewsRubricId'];
		$oNews->SeoH1 = $_POST['SeoH1'];
		$oNews->SeoTitle = $_POST['SeoTitle'];
		$oNews->SeoDescription = $_POST['SeoDescription'];
		$oNews->NewsText = $_POST['NewsText'];
		$oNews->NewsSource = $_POST['NewsSource'];
		$oNews->PreviewPhoto = $_POST['PreviewPhoto'];

		//saving file to server
		//var_dump($_FILES);
		$photo = $_FILES['PreviewPhoto'];
		//if (isset( $_FILES['PreviewPhoto'])){
		//	var_dump($_FILES['PreviewPhoto']);
		//}
		$photo['name'] = 'news'.$id.".jpg";

		$photo['name']= substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 11).".jpg";
		//var_dump($photo['name']);
		$dir = 'images/';
		$path = $dir.$photo['name'];



		if (move_uploaded_file($photo['tmp_name'], $path)){
			$oNews->PreviewPhoto = $photo['name'];
		}	
    		


		//var_dump($oNews);
		$username = $_POST['username'];
		$password = $_POST['password'];
		$oUser = User::getModel($username);
		if ($oUser == null){
			$data2 = "Неправильный логин";
			goto label;
		}
		$passwordHash = crypt($_POST['password'], '$2a$07$rozanovilyausessomesillystringforsalt$');
		if (!hash_equals($passwordHash,$oUser->PasswordHash)){
			$data2 = "Неправильный пароль";
			goto label;
		}
		if (!$oUser->Journalist){
			$data2 = "Недостаточно прав";
			goto label;
		}

		News::saveModel($oNews);
		$_FILES = array();
	label:	$this->view->generate('adminnews_view.php','template_view.php',$data,$data2);
		}
	//}	
}
