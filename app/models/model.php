<?php
class Model
{

	protected $db;
	protected $table = "";
	public function __construct()
	{
		$dns = 'mysql:dbname=' . DB_NAME . ";host=" . DB_HOST;
		try {
			$this->db = new PDO($dns, DB_USER, DB_PASSWORD);
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			echo $e->getMessage();
			exit();
		}
	}

	
	/*
	* Find by column, returns count if $count = true
	* @return int
	*/
	public function getBy($columnName, $value, $count = false)
	{
		try 
		{
			$sth = $this->db->prepare("SELECT * FROM $this->table WHERE $columnName = :columnValue");
			$sth->bindParam(':columnValue', $value, PDO::PARAM_STR);
			$sth->execute();
			$resultSet = $sth->fetchAll(PDO::FETCH_ASSOC);
			if ($count) 
			{
				return count($resultSet);
			}
			return $resultSet;
		} catch (PDOException $e) 
		{
			return false;
		}
	}

	/*
	* Insert
	* @param array $data
	* @return int
	*/
	public function save($data = array())
	{
		$fields = array_keys($data); // here you have to trust your field names!
		$values = array_values($data);
		$fieldlist = implode(',', $fields);
		$qs = str_repeat("?,", count($fields) - 1);
		$sql = "insert into $this->table($fieldlist) values(${qs}?)";
		try {
			$sth = $this->db->prepare($sql);
			$sth->execute($values);
			return $this->db->lastInsertId();
		} catch (PDOException $e) 
		{
		return false;
		}
	}

	/* 
	* Delete
	* @param null $id
	* @return int
	*/
	public function delete($id = null)
	{
		try {
			$sth = $this->db->prepare("DELETE FROM $this->table WHERE id = ? LIMIT 1");
			return $sth->execute(array($id));
		} catch (PDOException $e) 
		{
		return false;
		}
	}
	
	public function question()
	{
		try 
		{
			$sth = $this->db->prepare("SELECT * FROM tbl_question");
			//$sth->bindParam(':columnValue', $value, PDO::PARAM_STR);
			$sth->execute();
			$resultSet = $sth->fetchAll(PDO::FETCH_ASSOC);
			
			return $resultSet;
		} catch (PDOException $e) 
		{
			return false;
		}
	}
	public function answers()
	{
		try 
		{
			$sth = $this->db->prepare("SELECT * FROM tbl_answer");
			//$sth->bindParam(':columnValue', $value, PDO::PARAM_STR);
			$sth->execute();
			$resultSet = $sth->fetchAll(PDO::FETCH_ASSOC);
			
			return $resultSet;
		} catch (PDOException $e) 
		{
			return false;
		}
	}
	public function save_poll($answer_id)
	{
		$fields = array_keys($data); // here you have to trust your field names!
		$values = array_values($data);
		$fieldlist = implode(',', $fields);
		$qs = str_repeat("?,", count($fields) - 1);
		$sql = "INSERT INTO tbl_poll(question_id,answer_id,member_id) VALUES ('1','" . $answer_id . "','1')";
		
		//$sql = "insert into $this->table($fieldlist) values(${qs}?)";
		try {
			$sth = $this->db->prepare($sql);
			$sth->execute($values);
			return $this->db->lastInsertId();
		} catch (PDOException $e) 
		{
		return false;
		}
	}
	public function results()
	{
		try 
		{
			$sth = $this->db->prepare("SELECT count(t1.answer) as ans_count,t1.id,t1.answer FROM `tbl_answer` as t1 left join tbl_poll as t2 on t1.id=t2.answer_id group by t1.id");
			//$sth->bindParam(':columnValue', $value, PDO::PARAM_STR);
			$sth->execute();
			$resultSet = $sth->fetchAll(PDO::FETCH_ASSOC);
			
			return $resultSet;
		} catch (PDOException $e) 
		{
			return false;
		}
	}
	
	
}