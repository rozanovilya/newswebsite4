<?php
class Menu extends Model
{
	public $oRubrics = array();
	function setoRubrics($oRubrics)
	{
		$this->oRubrics= $oRubrics;
	}
	function getoRubrics()
	{
		//if ($this->oRubrics){
			$query = self::$oDbConnection->prepare("SELECT * FROM Rubrics");
			$query->execute();
			$res = $query->fetchAll(PDO::FETCH_CLASS, "Rubric");
			return $res;
		//}
	}

}