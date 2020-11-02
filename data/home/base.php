<?php

/**
 * 
 */
class Database extends PDO
{
    private $_display = "";
	function __construct()
	{
		parent::__construct("mysql:host=freedb.tech;dbname=freedbtech_myelination","freedbtech_username","password");
	}


	public function select($sql, $array = array(), $fetchMode = PDO::FETCH_ASSOC)
    {
        $sth = $this->prepare($sql);
        foreach ($array as $key => $value) {
            $sth->bindValue("$key", $value);
        }
        
        $sth->execute();
        return $sth->fetchAll($fetchMode);
    }

    

    public function display($sql){
		$num = 1;
        $sth = $this->prepare($sql);
		$sth->execute();
		$this->_display = "";
		while ($row=$sth->fetch()) {
			
			$this->_display .= "<input type='hidden' value='".$row["review_id"]."' id='review_id'>";
			$this->_display .= "<p>".$num." ".$row["review_question"]."</p>";
			$this->_display .= "<input type = 'text' placeholder = 'answer' id = 'useranswer_id".$num."' class='form-control' style='margin-bottom:8px;'>";
			$this->_display .= "<input type = 'button' value = 'check' class='btn btn-warning btn-sm' id = 'check_id".$num."'>";
			$this->_display.="<hr><br>";
			$num+=1;
			
		}
		echo $this->_display;

      
	}
	

	public function insert($sql,$param = array()){
		$sth = $this->prepare($sql);
        $sth->execute($param);
		
	}

	public function getData($sql){
		$sth = $this->prepare($sql);
		$sth->execute();
		return $sth->fetch();
	}


	public function update($sql){
		$sth = $this->prepare($sql);
		$sth->execute();
		
	}


	public function getValue($sql,$array = array(), $fetchMode = PDO::FETCH_ASSOC){
		$sth = $this->prepare($sql);

        foreach ($array as $key => $value) {
            $sth->bindValue("$key", $value);
        }
        
        $sth->execute();
        return $sth->fetchAll($fetchMode);
	}

	public function deleteData($id){
		
		$sth = $this->prepare("DELETE FROM `myelination_tbl` WHERE `myelination_tbl`.`myelination_id` =".$id);
		$sth->execute();
		return $id;
	}

	

}