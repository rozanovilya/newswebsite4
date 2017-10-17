<?php
require_once ("model_rubric.php");  
require_once ("model_comment.php");  
class News extends Model
{
	private $NewsId;
	private $NewsDate;
	private $NewsRubric;
	private $SeoH1;
	private $SeoTitle;
	private $SeoDescription;
	private $PreviewPhoto;
	private $NewsText;
	private $NewsSource;
	private $NewsAuthorId;
	private $oNewsAuthor;
	private $oNewsRubric;
	private $oComments;

	protected static $table ='News';
	protected static $id = 'NewsId';

	static function saveModel($obj)
	{
		$isSaved = parent::isSaved($obj->NewsId);
		$table = News::$table;
		if ($isSaved){
			$query = self::$oDbConnection->prepare("UPDATE $table 
				SET NewsId=:NewsId, NewsDate =:NewsDate, NewsRubric = :NewsRubric, SeoH1 = :SeoH1,SeoTitle =:SeoTitle,
					SeoDescription = :SeoDescription, PreviewPhoto = :PreviewPhoto, NewsText = :NewsText,
					NewsSource = :NewsSource, NewsAuthorId = :NewsAuthorId
					WHERE NewsId = :NewsId");
		}
		else{
			$query = self::$oDbConnection->prepare("INSERT INTO $table (NewsId,NewsDate,NewsRubric,SeoH1,SeoTitle,SeoDescription,PreviewPhoto,NewsText,NewsSource,NewsAuthorId)
				VALUES (:NewsId,:NewsDate,:NewsRubric,:SeoH1,:SeoTitle,:SeoDescription,:PreviewPhoto,:NewsText,:NewsSource,:NewsAuthorId)");
		}
		$query->bindParam('NewsId',$obj->NewsId);
		$query->bindParam('NewsDate',$obj->NewsDate);
		$query->bindParam('NewsRubric',$obj->NewsRubric);
		$query->bindParam('SeoH1',$obj->SeoH1);
		$query->bindParam('SeoTitle',$obj->SeoTitle);
		$query->bindParam('SeoDescription',$obj->SeoDescription);
		$query->bindParam('PreviewPhoto',$obj->PreviewPhoto);
		$query->bindParam('NewsText',$obj->NewsText);
		$query->bindParam('NewsSource',$obj->NewsSource);
		$query->bindParam('NewsAuthorId',$obj->NewsAuthorId);
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
	function setNewsDate($NewsDate)
	{
   		$this->NewsDate = $NewsDate;
	}
	function getNewsDate()
	{
    	return $this->NewsDate;
	}
	function setNewsRubric($NewsRubric)
	{
    	$this->NewsRubric = $NewsRubric;
	}
	function getNewsRubric()
	{
    	return $this->NewsRubric;
	}
	function setSeoH1($SeoH1)
	{
    	$this->SeoH1 = $SeoH1;
	}
	function getSeoH1()
	{
    	return $this->SeoH1;
	}
	function setSeoTitle($SeoTitle)
	{
		$this->SeoTitle = $SeoTitle;
	}
	function getSeoTitle()
	{
		return $this->SeoTitle;
	}
	function setSeoDescription($SeoDescription)
	{
		$this->SeoDescription = $SeoDescription;
	}
	function getSeoDescription()
	{
		return $this->SeoDescription;
	}
	function setPreviewPhoto($PreviewPhoto)
	{
		$this->PreviewPhoto = $PreviewPhoto;
	}
	function getPreviewPhoto()
	{
		return $this->PreviewPhoto;
	}
	function setNewsText($NewsText)
	{
		$this->NewsText = $NewsText;
	}
	function getNewsText()
	{
		return $this->NewsText;
	}
	function setNewsSource($NewsSource)
	{
		$this->NewsSource = $NewsSource;
	}
	function getNewsSource()
	{
		return $this->NewsSource;
	}
	function setNewsAuthorId($NewsAuthorId)
	{
		$this->NewsAuthorId = $NewsAuthorId;
	}
	function getNewsAuthorId()
	{
		return $this->NewsAuthorId;
	}
	function getoNewsAuthor()
	{
		//if ($this->oNewsAuthor){
			//getting the object from the database
		$Class = 'User';
		$table = 'Users';
		$idname ='UserId';
		$query = self::$oDbConnection->prepare("SELECT * FROM $table WHERE $idname=:id");
		$query->execute(['id'=>$this->NewsAuthorId]);
		$res = $query->fetch(PDO::FETCH_ASSOC);
		//var_dump($res);
		//return ($res) ? new $Class($res) : null;
		return $res;
		//}
	}
	function setoNewsAuthor($oNewsAuthor)
	{
		$this->oNewsAuthor = $oNewsAuthor;
	}
	function getoNewsRubric()
	{
		$Class = 'Rubric';
		$table = 'rubrics';
		$idname ='RubricId';
		$query = self::$oDbConnection->prepare("SELECT * FROM $table WHERE $idname=:id LIMIT 1");
		$query->execute(['id'=>$this->NewsRubric]);
		$res = $query->fetch(PDO::FETCH_ASSOC);
		//var_dump($res);
		//return ($res) ? new $Class($res) : null;
		//return $res;
		return new $Class($res);
	}
	function setoNewsRubric($oNewsRubric)
	{
		return $this->oNewsRubric;
	}
	function setoComments($oComments)
	{
		$this->oComments = $oComments;
	}
		function getoComments()
	{
		$Class = 'Comment';
		$table = 'Comments';
		$idname ='NewsId';
		$query = self::$oDbConnection->prepare("SELECT * FROM $table WHERE $idname=:id ORDER BY 'CommentDate'");
			$query->execute(['id'=>$this->NewsId]);
			$res = $query->fetchAll(PDO::FETCH_CLASS, "Comment");
		//var_dump($res);
		//return ($res) ? new $Class($res) : null;
		return $res;
		//return new $Class($res);
	}


}