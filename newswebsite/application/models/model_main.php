<?php
require_once('model_news.php');
require_once('model_menu.php');
class MainPage extends Model
{
	static $table = 'News';
	public $oNews;
	function setoNews($oNews)
	{
		$this->oNews = $oNews;
	}
	function getoNews($start = 0, $items = 1)
	{
	//	if ($this->oNews){
			$query = self::$oDbConnection->prepare("SELECT * FROM News ORDER BY NewsId DESC LIMIT $start ,$items");
			$query->execute();
			$res = $query->fetchAll(PDO::FETCH_CLASS, "News");
			return $res;
	//	}
	}
		static function countModel()
	{
		$Class = get_called_class();
		$table = $Class::$table;
		$query = self::$oDbConnection->prepare("SELECT count(*) AS Total FROM $table");
		$query->execute();
		$res = $query->fetch(PDO::FETCH_ASSOC);
		$total = $res['Total'];
		return $total;
	}

}