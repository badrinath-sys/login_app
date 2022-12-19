<?php
class home_Model extends CI_Model 
{
	function saverecords($name,$password)
	{
	$query="insert into users values('','$name','$password')";
	$this->db->query($query);
	}
}