<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>



<?php

################ Exercise 1
$name = "Olya";
$age = 31;

echo "My name is ".$name." <br/> I am ".$age." <br/>";

unset($name);
unset($age);

################ Exercise 2
define("CITY", "Kiev ");
defined("CITY");

echo CITY;
define("CITY", "London");
echo CITY;

################ Exercise 3
$book = array("title"=>"Как стать гением: Жизненная стратегия творческой личности", "author"=>"Г.С. Альтшуллер, И.М. Верткин", "pages"=>"450");
echo "<br/><br/>Недавно я прочитал книгу \"".$book["title"]."\", написанную авторами ".$book["author"].", я осилил все ".$book["pages"]." страниц, мне она очень понравилась<br/><br/>";

################ Exercise 4
$book1 = array("title"=>"Читая между строк ДНК", "author"=>"Петер Шпорк", "pages"=>"550");
$book2 = array("title"=>"Оставь свой след", "author"=>"Блейк Майкоски", "pages"=>"350");
$books = [$book1, $book2];

$sum = $books[0]["pages"]*1 + $books[1]["pages"]*1;

echo "Недавно я прочитал книги \"".$books[0]["title"]."\" и \"".$books[1]["title"]."\", написанные соответственно авторами ".$books[0]["author"]." и ".$books[1]["author"].", я осилил в сумме ".$sum." страниц, не ожидал от себя подобного";

?>



</body>
</html>