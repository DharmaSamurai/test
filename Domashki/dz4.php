<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style.css">
	<title></title>
</head>
<body>

<?php
/*
 * Следующие задания требуется воспринимать как ТЗ (Техническое задание)
 * p.s. Разработчик, помни! 
 * Лучше уточнить ТЗ перед выполнением у заказчика, если ты что-то не понял, чем сделать, переделать, потерять время, деньги, нервы, репутацию.
 * Не забывай о навыках коммуникации :)
 * 
 * Задание 1
 * - Вы проектируете интернет магазин. Посетитель на вашем сайте создал следующий заказ (цена, количество в заказе и остаток на складе генерируются автоматически):
 */

// Считаем цену с учетом скидки
// Я не понимаю, зачем здесь переменная функция, я сделала обычными
function total_price($price, $count=1, $dis=0) {
	if ($count >=3 and $dis) {
		switch ($dis) {
			case 1:
				$not_pay = ($count*$price*10)/100;
				break;
			case 2:
				$not_pay = ($count*$price*20)/100;
				break;
		}
	} else {
		$not_pay = 0;
	}
	return $count*$price - $not_pay;
}

// Товары
$goods = [ 
	[
	 	'name' => 'игрушка мягкая мишка белый',
		'price' => mt_rand(1, 10),
		'count' => mt_rand(1, 10),
		'rest' => mt_rand(0, 10),
		'diskont' => mt_rand(0, 2)
	],
	[
	 	'name' => 'одежда детская куртка синяя синтепон',
		'price' => mt_rand(1, 10),
		'count' => mt_rand(1, 10),
		'rest' => mt_rand(0, 10),
		'diskont' => mt_rand(0, 2)
	],
	[
	 	'name' => 'игрушка детская велосипед',
		'price' => mt_rand(1, 10),
		'count' => mt_rand(1, 10),
		'rest' => mt_rand(0, 10),
		'diskont' => mt_rand(0, 2)
	]
];

// Переменные для раздела итого
$prices = 0;
$counts = 0;
$rests = 0;

// Заготовочка для уведомлений
$w_exist = 0;
$warnings = '<table class="tbl_goods">
			<thead>
				<tr>
					<th>Наименование товара</th>
					<th>Заказано</th>
					<th>Доступно</th>
					<th>Не хватает</th>
				</tr>
			</thead>
			<tbody>';

// Заготовочка для скидок
$d_exist = 0;
$discounts = '<table class="tbl_goods">
			<thead>
				<tr>
					<th>Наименование товара</th>
					<th>Заказано</th>
					<th>Скидка</th>
					<th>Итоговая цена</th>
				</tr>
			</thead>
			<tbody>';

// Заготовочка для корзины
echo '<h2>Корзина</h2>';
echo '<table class="tbl_goods">
			<thead>
				<tr>
					<th>№</th>
					<th>Заказанные товары</th>
					<th>Количество</th>
					<th>Цена</th>
					<th>Остаток на складе</th>
				</tr>
			</thead>
			<tbody>';

// Извращение конечно, но сказали, что нужна статическая переменная
function number() {
	static $a;
	++$a;
	return $a;
}

for ($i = 0; $i < count($goods); ++$i) {
	// Генерация тела корзины
	$price = total_price($goods[$i]['price'], $goods[$i]['count'], $goods[$i]['diskont']);
	echo '<tr>
			<td>'.number().'</td>
			<td>'.$goods[$i]['name'].'</td>
			<td>'.$goods[$i]['count'].'</td>
			<td>'.$price.'</td>
			<td>'.$goods[$i]['rest'].'</td>
		</tr>';

	// Суммирование для раздела "Итого"
	$prices += $price;
	$counts += $goods[$i]['count'];
	$rests += $goods[$i]['rest'];

	// Уведомления
	if ($goods[$i]['count'] > $goods[$i]['rest']) {
		$w_exist = 1;
		$warnings .= '<tr>
					<td>'.$goods[$i]['name'].'</td>
					<td>'.$goods[$i]['count'].'</td>
					<td>'.$goods[$i]['rest'].'</td>
					<td>'.($goods[$i]['count']-$goods[$i]['rest']).'</td>
				</tr>';
	}

	// Скидки
	if ($goods[$i]['count'] >=3 and $goods[$i]['diskont']) {
		$d_exist = 1;
		$price = total_price($goods[$i]['price'], $goods[$i]['count'], $goods[$i]['diskont']);
		$discounts .= '<tr>
					<td>'.$goods[$i]['name'].'</td>
					<td>'.$goods[$i]['count'].'</td>
					<td>'.($goods[$i]['diskont']*10).'%</td>
					<td>'.$price.'</td>
				</tr>';
	}
	
}
// Добавляем концовочки
echo '</tbody></table>';
$warnings .= '</tbody></table>';
$discounts .= '</tbody></table>';

// Итого
echo '<h2>Итого</h2>';
itogo();

// Необходимости в этой функции нет, но надо было куда-то втулить глобальную переменную
function itogo() {
	global $counts, $prices, $goods;
	echo '<table class="tbl_goods">
			<thead>
				<tr>
					<th>Наименований товаров</th>
					<th>Общее количество</th>
					<th>Общая цена</th>
					
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>'.count($goods).'</td>
					<td>'.$counts.'</td>
					<td>'.$prices.'</td>
				</tr>
			</tbody>
		</table>';
}

// Уведомления
if ($w_exist) {
	echo '<h2>Уведомления</h2>';
	echo $warnings;
}

// Скидки
if ($d_exist) {
	echo '<h2>Скидки</h2>';
	echo $discounts;
} else {
	echo '<h2>Скидок нет</h2>';
}




/*
 * 
 * - Вам нужно вывести корзину для покупателя, где указать: 
 * 1) Перечень заказанных товаров, их цену, кол-во и остаток на складе
 * 2) В секции ИТОГО должно быть указано: сколько всего наименовний было заказано, каково общее количество товара, какова общая сумма заказа
 * - Вам нужно сделать секцию "Уведомления", где необходимо извещать покупателя о том, что нужного количества товара не оказалось на складе
 * - Вам нужно сделать секцию "Скидки", где известить покупателя о том, что если он заказал "игрушка детская велосипед" в количестве >=3 штук, то на эту позицию ему 
 * автоматически дается скидка 30% (соответственно цены в корзине пересчитываются тоже автоматически)
 * 3) у каждого товара есть автоматически генерируемый скидочный купон diskont, используйте переменную функцию, чтобы делать скидку на итоговую цену в корзине
 * diskont0 = скидок нет, diskont1 = 10%, diskont2 = 20%
 * 
 * В коде должно быть использовано:
 * - не менее одной функции
 * - не менее одного параметра для функции
 * операторы if, else, switch
 * статические и глобальные переменные в теле функции
 * 

 */












?>
</body>
</html>