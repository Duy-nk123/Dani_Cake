<?php 


//ket noi co so du lieu
$hostname = 'localhost';
$username='root';
$password='';
$dbname='bakery';
$port=3307;
$conn = new mysqli($hostname, $username, $password, $dbname, $port);
function query($sql)
{
	global $hostname;
	global $username;
	global $password;
	global $dbname;
	global $port;
	global $conn;
	// $conn = new mysqli($hostname, $username, $password, $dbname, $port);
	if($conn->connect_error)
	{
		//neu nhu ket noi khong thanh cong thi dung chuong trinh
		echo "Connection fail<br>";
		//dung chuong trinh
		die($conn->connect_error);
	}
	
	//chay cau truy van lay ket qua
	$result = $conn->query($sql);
	if(!$result)
	{
		//Neu khong co ket qua ($result=null) thi dung chuong trinh
		echo "SQL execution fail <br>";
		die($conn->error);
	}
	//lay tat ca cac ban ghi tu ket qua
	$rows = $result->fetch_all();
	//$rows = $result->fetch_all(MYSQLI_ASSOC);
	return $rows;
}
function execsql($sql,&$conna)
{
	global $hostname;
	global $username;
	global $password;
	global $dbname;
	global $port;
	$conn = new mysqli($hostname, $username, $password, $dbname, $port);
	if($conn->connect_error)
	{
		//neu nhu ket noi khong thanh cong thi dung chuong trinh
		echo "Connection fail<br>";
		//dung chuong trinh
		die($conn->connect_error);
	}	
	//chay cau truy van lay ket qua
	$result = $conn->query($sql);
	$conna = $conn;
	return $result;
}
function execsql1($sql)
{
	global $hostname;
	global $username;
	global $password;
	global $dbname;
	global $port;
	$conn = new mysqli($hostname, $username, $password, $dbname, $port);
	if($conn->connect_error)
	{
		//neu nhu ket noi khong thanh cong thi dung chuong trinh
		echo "Connection fail<br>";
		//dung chuong trinh
		die($conn->connect_error);
	}	
	//chay cau truy van lay ket qua
	$result = $conn->query($sql);
	return $result;
}
?>