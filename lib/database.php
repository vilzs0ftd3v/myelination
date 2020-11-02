<?php

/**
 * 
 */
class Database extends PDO
{
	
	function __construct()
	{
		parent::__construct("mysql:host=freedb.tech;dbname=freedbtech_myelination","freedbtech_username","password");
	}
}