<?

header('Content-Type: text/html; charset=utf-8');
/*
$connection = mysqli_connect('localhost', 'vh218006_dubinin', 'Qr7iXmPD', 'vh218006_opros');
	if($connection == false)
	{
		echo "Не удалось подключиться к базе данных <br>";
		echo mysqli_connect_error();
		exit();
	}
*/

include('db_text.php');

$result = mysqli_query($connection, "SELECT * FROM `articles_categories`");

/* выведет по строку
$r1 = mysqli_fetch_assoc($result);
$r2 = mysqli_fetch_assoc($result);
print_r($r2);
*/

 /* выведет список всех полей
while ($record = mysqli_fetch_assoc($result)) {
	print_r($record);
	echo '<hr>';
}
*/

// echo 'Записей найдено: ' .mysqli_num_rows($result); выведет кол-во записей

if(mysqli_num_rows($result) == 0)
{
	echo 'Категорий не найдено';
}else
{?>

	<ul>
		<?php
			while( ($cat = mysqli_fetch_assoc($result)) )
			{
				$articles_count = mysqli_query($connection, "SELECT COUNT(`id`) AS `total_count` FROM `articles` WHERE `categorie_id` = " .$cat['id']); 
				/* потому как из сущности не может получить число, нужно применить 
				fetch_assoc к $articles_count*/
				$articles_count_result = mysqli_fetch_assoc($articles_count);
				/*print_r($articles_count_result);exit(); */ // выведет : Array([total_count]=> 1)
				echo '<li>' .$cat['title']. ' ('. ($articles_count_result['total_count']) .')</li>';
			}  

		 ?>
	</ul>
<?php 
}
?>

<!--  параметр date -->


<?php 

$start_date = '2018-02-14 10:00:00';
$start_date_timestamp = strtotime($start_date); // показывает сколько сек прошло с создания UNIX 1970.01.01

$diff = time() - $start_date_timestamp;
$days_passed = floor((($diff / 60) / 60) / 24);

echo ' Между ' .date('d.m.Y H:i:s', $start_date_timestamp) . ' и ' .date('d.m.Y H:i:s') .' прошло ' . $days_passed. ' дня!'

 ?>


<form action="handle.php" method="post">
	<input type="text" placeholder="Ваш логин" name='login'>
	<input type="text" placeholder="Ваш пароль" name="password">
	<hr>
	<input type="submit" value="Отправить">

</form>	

<?
mysqli_close($connection);
?>

