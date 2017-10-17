<?php
class Model
{

	static $oDbConnection;

	function __construct($args = [])
	{
		foreach ( $args as $key => $value)
			$this->$key = $value;
	}

	public function __get($property)
	{

		$functionname = 'get'.$property;
			return $this->$functionname();	
	}
	public function __set($property, $value)
	{
			$functionname = 'set'.$property;
			if (method_exists($this, $functionname)){
				$this->$functionname($value);
			}
	}


	static function getModel($id)
	{
		$Class = get_called_class();
		$table = $Class::$table;
		$idname =$Class::$id;
		//if (empty($table))
		//	return null;
		$query = self::$oDbConnection->prepare("SELECT * FROM $table WHERE $idname=:id");
		$query->execute(['id'=>$id]);
		$res = $query->fetch(PDO::FETCH_ASSOC);
		return ($res) ? new $Class($res) : null;
	}

	static function isSaved($id)
	{
		$Class = get_called_class();
		$table = $Class::$table;
		$idname =$Class::$id;
		$queryIfExists = self::$oDbConnection->prepare("SELECT * FROM $table WHERE $idname=:id");
		$queryIfExists->execute(['id'=>$id]);
		$res = $queryIfExists->fetch(PDO::FETCH_ASSOC);
		return $res;
	}
}