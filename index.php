<?php
echo "Hello, my name is Olya!";

error_report(E_ALL|E_ERROR|E_WARNING|E_PARSE|E_NOTICE);
ini_set('display_errors', 1);
echo $x;
echo 'test';

$my_age = '28';
$age = 0x1A;
settype($my_age, 'integer');

var_dump($my_age + $age);
print_r($my_age);

$a = 'Ardhanarishvara';
$text = "Hello $a! How are you?";
$text2 = "Hello \$a! How are you?";
$text3 = 'Hello '.$a.'! How are you?';
echo $text;
echo $text2;
echo $text3;

$t = TRUE;
$f = FALSE;

$id = (int)$_GET['id'];
$id2 = $_GET['id'];
settype($id2, 'int');

var_dump($id);
var_dump($id2);

// Exercise 3
echo "ceil: ".ceil(5.65454545)."<br/>";
echo "floor: ".floor(5.65454545)."<br/>";
echo "round: ".round(5.65454545, 3)."<br/>";
echo min(40, 22, 3, 5, 19, 20);
echo "<br/>";
echo max(55, 4, 77, 22, 14, 21);
echo "<br/>";

echo "Rand: ".rand(0, 100)."<br/>";
mt_srand(time());
echo "MT_Rand: ".mt_rand(10, 100)."<br/>";

$str = ' |  abc  .  ';
echo strlen($str)."<br/>";
echo ltrim($str)."<br/>";
echo rtrim($str)."<br/>";
echo trim($str, '|. ')."<br/>";
echo strtoupper($str)."<br/>";

// pattern string matches
if (preg_match('/(\d+)/', 'ras dva tree 4', $matches)) {
	echo 'yes<br/>';
}

if (preg_match('/Ticket\s+(\d+)/i', 'Ticket 10 bla bla bla lorem ipsum', $matches2)) {
	echo 'yes2<br/>';
}

echo count($_SERVER);
echo "\n";

echo sort($_SERVER).'<br/>';

$timestamp = strtotime('2014-11-21 1:26:00');
echo $timestamp.'<br/>';
echo date('l d.m.Y H:i:s', $timestamp).'<br/>';

?>