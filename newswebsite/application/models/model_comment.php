<?php
require_once ("model_user.php"); 

class Comment extends Model
{
	private $NewsId;
	private $CommentId;
	private $CommentDate;
	private $CommentAuthorId;
	private $oCommentAuthor;
	private $CommentText;
	private $Moderated;

	protected static $table ='Comments';
	protected static $id = 'CommentId';

		static function saveModel($obj)
	{
		$isSaved = parent::isSaved($obj->CommentId);
		$table = Comment::$table;
		if ($isSaved){
			$query = self::$oDbConnection->prepare("UPDATE $table 
				SET NewsId=:NewsId, CommentId=:CommentId,CommentDate=:CommentDate,CommentAuthorId=:CommentAuthorId,CommentText=:CommentText,Moderated=:Moderated
					WHERE CommentId = :CommentId");
		}
		else{
			$query = self::$oDbConnection->prepare("INSERT INTO $table (NewsId,CommentId,CommentDate,CommentAuthorId,CommentText,Moderated)
				VALUES (:NewsId,:CommentId,:CommentDate,:CommentAuthorId,:CommentText,:Moderated)");
		}
		$query->bindParam('NewsId',$obj->NewsId);
		$query->bindParam('CommentId',$obj->CommentId);
		$query->bindParam('CommentDate',$obj->CommentDate);
		$query->bindParam('CommentAuthorId',$obj->CommentAuthorId);
		$query->bindParam('CommentText',$obj->CommentText);
		$query->bindParam('Moderated',$obj->Moderated);
		$query->execute();
	}

	function setNewsId($NewsId)
	{
		$this->NewsId = $NewsId;
	}
	function getNewsId()
	{
		return $this->NewsId;
	}
	function setCommentId($CommentId)
	{
		$this->CommentId = $CommentId;
	}
	function getCommentId()
	{
		return $this->CommentId;
	}
	function setCommentDate($CommentDate)
	{
		$this->CommentDate = $CommentDate;
	}
	function getCommentDate()
	{
		return $this->CommentDate;
	}
	function setCommentAuthorId($CommentAuthorId)
	{
		$this->CommentAuthorId = $CommentAuthorId;
	}
	function getCommentAuthorId()
	{
		return $this->CommentAuthorId;
	}
	function setoCommentAuthor($oCommentAuthor)
	{
		$this->oCommentAuthor = $oCommentAuthor;
	}
	function getoCommentAuthor()
	{
		//if ($this->oCommentAuthor){
			//get the object from the database
			$Class = 'User';
			$table = 'Users';
			$idname ='UserId';
			$query = self::$oDbConnection->prepare("SELECT * FROM $table WHERE $idname=:id");
			$query->execute(['id'=>$this->CommentAuthorId]);
			$res = $query->fetch(PDO::FETCH_ASSOC);
			return ($res) ? new $Class($res) : null;
			//var_dump($res);
			//return $res;	
		//}
	}
	function setCommentText($CommentText)
	{
		$this->CommentText = $CommentText;
	}
	function getCommentText()
	{
		return $this->CommentText;
	}
	function setModerated($Moderated)
	{
		$this->Moderated = $Moderated;
	}
	function getModerated()
	{
		return $this->Moderated;
	}

}