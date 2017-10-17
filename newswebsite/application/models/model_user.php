<?php
require_once ("model_news.php"); 
require_once ("model_comment.php"); 
class User extends Model
{
	private $UserId;
	private $UserName;
	private $PasswordHash;
	private $Administrator;
	private $Journalist;
	private $Editor;
	private $Moderator;
	public $oNews = array();
	public $oComments = array();

	protected static $table ='Users';
	protected static $id = 'UserName';

	static function saveModel($obj)
	{
		$isSaved = parent::isSaved($obj->UserName);
		$table = User::$table;
		if ($isSaved){
			$query = self::$oDbConnection->prepare("UPDATE $table 
				SET UserId=:UserId,UserName=:UserName,PasswordHash=:PasswordHash,Administrator=:Administrator,Journalist=:Journalist,Editor=:Editor,Moderator=:Moderator
					WHERE UserId = :UserId");
		}
		else{
			$query = self::$oDbConnection->prepare("INSERT INTO $table (UserId,UserName,PasswordHash,Administrator,Journalist,Editor,Moderator)
				VALUES (:UserId,:UserName,:PasswordHash,:Administrator,:Journalist,:Editor,:Moderator)");
		}
		$query->bindParam('UserId',$obj->UserId);
		$query->bindParam('UserName',$obj->UserName);
		$query->bindParam('PasswordHash',$obj->PasswordHash);
		$query->bindParam('Administrator',$obj->Administrator);
		$query->bindParam('Journalist',$obj->Journalist);
		$query->bindParam('Editor',$obj->Editor);
		$query->bindParam('Moderator',$obj->Moderator);
		$query->execute();
	}

	function setUserId($UserId)
	{
		$this->UserId = $UserId;
	}
	function getUserId()
	{
		return $this->UserId;
	}
	function setUserName($UserName)
	{
		$this->UserName = $UserName;
	}
	function getUserName()
	{
		return $this->UserName;
	}
	function setPasswordHash($PasswordHash)
	{
		$this->PasswordHash = $PasswordHash;
	}
	function getPasswordHash()
	{
		return $this->PasswordHash;
	}
	function setAdministrator($Administrator)
	{
		$this->Administrator = $Administrator;
	}
	function getAdministrator()
	{
		return $this->Administrator;
	}
	function setJournalist($Journalist)
	{
		$this->Journalist = $Journalist;
	}
	function getJournalist()
	{
		return $this->Journalist;
	}
	function setEditor($Editor)
	{
		$this->Editor = $Editor;
	}
	function getEditor()
	{
		return $this->Editor;
	}
	function setModerator($Moderator)
	{
		$this->Moderator = $Moderator;
	}
	function getModerator()
	{
		return $this->Moderator;
	}
	function setoNews($oNews)
	{
		$this->oNews = $oNews;
	}
	function getoNews()
	{
		if ($this->oNews){
		//get the array of objects from the database
			$Class = 'News';
			$table = 'News';
			$idname ='NewsAuthorId';
			$query = self::$oDbConnection->prepare("SELECT * FROM $table WHERE $idname=:id");
			$query->execute(['id'=>$this->UserId]);
			$res = $query->fetchAll(PDO::FETCH_CLASS, "News");
			return ($res) ? new $Class($res) : null;			
		}

	}
	function setoComments($oComments)
	{
		$this->oComments = $oComments;
	}
	function getoComments()
	{
		if ($this->oComments){
		//get the array of objects from the database
			$Class = 'Comment';
			$table = 'Comments';
			$idname ='CommentAuthorId';
			$query = self::$oDbConnection->prepare("SELECT * FROM $table WHERE $idname=:id");
			$query->execute(['id'=>$this->UserId]);
			$res = $query->fetchAll(PDO::FETCH_CLASS, "Comments");
			return ($res) ? new $Class($res) : null;				
		}

	}

}