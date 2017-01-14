<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="../../style.css">
	<title></title>
</head>
<body>

<?php

//POST

$news='Четыре новосибирские компании вошли в сотню лучших работодателей
Выставка университетов США: открой новые горизонты
Оценку «неудовлетворительно» по качеству получает каждая 5-я квартира в новостройке
Студент-изобретатель раскрыл запутанное преступление
Хоккей: «Сибирь» выстояла против «Ак Барса» в пятом матче плей-офф
Здоровое питание: вегетарианская кулинария
День святого Патрика: угощения, пивной теннис и уличные гуляния с огнем
«Красный факел» пустит публику на ночные экскурсии за кулисы и по закоулкам столетнего здания
Звезды телешоу «Голос» Наргиз Закирова и Гела Гуралиа споют в «Маяковском»';
$news=  explode("\n", $news);

// Текст новости (для красоты)
$new_text = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facilis alias laboriosam accusantium voluptas est voluptates autem reiciendis consequatur quod eveniet veniam qui, vitae atque itaque labore ducimus rerum architecto temporibus! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repudiandae quibusdam odit provident sed est ea nisi dolorum laboriosam nostrum voluptate impedit quidem, nesciunt inventore, sunt veniam aliquid voluptatum fugiat ab. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ullam, delectus tempora deserunt modi exercitationem excepturi praesentium nihil doloremque temporibus voluptatibus dolores eum! Minima eveniet quo odit id atque tempora laudantium?';

// Функция вывода всех новостей
function all_news($news) {
	echo '<h2>Все новости</h2>';
	foreach($news as $key => $new) {
		echo '<p>'.$new.'<p>';
	}
	echo '
		<form action="/dz5_2.php/new" method="post">
			<div>
				<label for="num">Введите номер статьи: </label>
				<input type="text" name="num" id="num" value="0" tabindex="1" />
			</div>
			<div>
				<input type="submit" value="Submit" />
			</div>
		</form>
	';
}

// Выводим конкретную новость
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$id = (int)$_POST['num'];
	if (array_key_exists($id, $news)) {
		echo '<h2>'.$news[$id].'</h2>';
		echo '<p>'.$new_text.'</p>';
	} else {
		echo '<h2>ERROR 404</h2>';
		echo '<p class="center">Page does not exist</p>';
		header("HTTP/1.0 404 Not Found");
	}
	echo '<h2><a href="/dz5_2.php">GO BACK</a></h2>';
// Выводим все новости
} else {
	all_news($news);
}

// Функция вывода всего списка новостей.

// Функция вывода конкретной новости.

// Точка входа.
// Если новость присутствует - вывести ее на сайте, иначе мы выводим весь список

// Был ли передан id новости в качестве параметра?
// если параметр не был передан - выводить 404 ошибку
// http://php.net/manual/ru/function.header.php

?>

</body>
</html>