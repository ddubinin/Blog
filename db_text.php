<?php 


/*
header('Content-Type: text/html; charset=utf-8');
$connection = mysqli_connect('localhost', 'vh218006_dubinin', 'Qr7iXmPD', 'vh218006_opros');
	if($connection == false)
	{
*/

$connection = mysqli_connect(
	$config['db']['server'],
	$config['db']['username'],
	$config['db']['password'],
	$config['db']['name']
);	

if($connection == false)
{	
	echo "Не удалось подключиться к базе данных <br>";
	echo mysqli_connect_error();
	exit();
}
?>