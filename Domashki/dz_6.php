<?php
session_start ();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style.css">
	<title></title>
</head>
<body>

<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	// Creating array
	$_SESSION['users'][] = [
		'radio' => $_POST['radio'],
		'name' => $_POST['name'],
		'email' => $_POST['email'],
		'checkbox' => $_POST['checkbox'],
		'phone' => $_POST['phone'],
		'city' => $_POST['city'],
		'cat' => $_POST['cat'],
		'title' => $_POST['title'],
		'descr' => $_POST['descr'],
		'price' => $_POST['price'],
		];
	echo '<div class="red">Информация внесена!</div>';
} else {
	echo '<div class="red">Заполните поля!</div>';
}

$cities = [
	'c1' => 'Kiev',
	'c2' => 'London',
	'c3' => 'New York'
];

$cats = [
	'c1' => 'Black Unicorns',
	'c2' => 'White Dragons',
	'c3' => 'Abrakadabra'
];

?>

<form action="/dz_6.php" method="post">
	<div class="anon">
		<input type="radio" name="radio" id="r1" tabindex="2" value="r1" checked="checked"/>
		<label for="r1">Частное лицо</label>
		
		<input type="radio" name="radio" id="r2" tabindex="3" value="r2" />
		<label for="r2">Компания</label>
	</div>

	<table class="anon">
		<tbody>
			<tr>
				<td><label for="name">Ваше имя</label></td>
				<td><input type="text" name="name" id="name" value="" tabindex="1" /></td>
			</tr>
			<tr>
				<td><label for="name">Электронная почта</label></td>
				<td><input type="email" name="email" id="email" value="" tabindex="2" /></td>
			</tr>
			<tr>
				<td></td>
				<td>
					<input type="checkbox" name="checkbox" id="checkbox" />
					<label for="checkbox">Я не хочу получать вопросы по объявлению по e-mail</label>
				</td>
			</tr>
			<tr>
				<td><label for="phone">Номер телефона</label></td>
				<td><input type="phone" name="phone" id="phone" value="" tabindex="3" /></td>
			</tr>
			<tr>
				<td><label for="city">Город</label></td>
				<td>
					<select name="city" id="city">
						<?php
							foreach ($cities as $key => $city) {
								echo '<option value="'.$key.'">'.$city.'</option>';
							}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td><label for="cat">Категория</label></td>
				<td>
					<select name="cat" id="cat">
						<?php
							foreach ($cats as $key => $cat) {
								echo '<option value="'.$key.'">'.$cat.'</option>';
							}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td><label for="title">Название объявления</label></td>
				<td><input type="text" name="title" id="title" tabindex="4" /></td>
			</tr>
			<tr>
				<td><label for="descr">Описание объявления</label></td>
				<td><textarea cols="40" rows="8" name="descr" id="descr"></textarea></td>
			</tr>
			<tr>
				<td><label for="price">Цена</label></td>
				<td><input type="text" name="price" id="price" value="0" tabindex="5" />руб.</td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" value="Отправить" /></td>
			</tr>
		</tbody>
	</table>
</form>

<table class="tbl_goods">
	<thead>
		<tr>
			<th>Название объявления</th>
			<th>Цена</th>
			<th>Имя</th>
			<th>Удалить?</th>
		</tr>
	</thead>
	<tbody>
<?php
if (isset($_SESSION['users'])) {
	foreach($_SESSION['users'] as $key => $user) {
		echo '
		<tr>
			<td><a class="ttl" href="/dz_6.php?anon='.$key.'">'.$user['title'].'</a></td>
			<td>'.$user['price'].'</td>
			<td>'.$user['name'].'</td>
			<td><a href="/dz_6.php?id='.$key.'">Удалить</a></td>
		</tr>
		';
	}
}
?>
	</tbody>
</table>
<?php
if (isset($_GET['id'])) {
	$id = (int)$_GET['id'];
	unset($_SESSION['users'][$id]);
}

if (isset($_GET['anon'])) {
	$id = (int)$_GET['anon'];
	$user =	$_SESSION['users'][$id];

	$user_city = '';
	foreach ($cities as $key => $city) {
		if ($key == $user['city']) {
			$user_city .= '<option value="'.$key.'" selected="selected">'.$city.'</option>';
		} else {
			$user_city .= '<option value="'.$key.'">'.$city.'</option>';
		}
	}

	$user_cats = '';
	foreach ($cats as $key => $cat) {
		if ($key == $user['city']) {
			$user_cats .= '<option value="'.$key.'" selected="selected">'.$cat.'</option>';
		} else {
			$user_cats .= '<option value="'.$key.'">'.$cat.'</option>';
		}
	}

	if ($user['radio'] == 'r1') {
		$r1 = 'checked="checked"';
		$r2 = '';
	} else {
		$r2 = 'checked="checked"';
		$r1 = '';
	}

	if ($user['checkbox'] == 'on') {
		$chk = 'checked="checked"';
	} else {
		$chk = '';
	}

	echo '<br><br>
	Here is radio: '.$user['radio'].'
	<br><br>
	Here is checkbox: '.$user['checkbox'].'
	<br><br>
	<div class="anon">
		<input type="radio" name="radio" id="r1" tabindex="2" value="choice-1" '.$r1.' />
		<label for="r1">Частное лицо</label>
		
		<input type="radio" name="radio" id="r2" tabindex="3" value="choice-2" '.$r2.' />
		<label for="r2">Компания</label>
	</div>
	<table class="anon">
		<tbody>
			<tr>
				<td><label for="name">Ваше имя</label></td>
				<td><input type="text" name="name" id="name" value="'.$user['name'].'" tabindex="1" /></td>
			</tr>
			<tr>
				<td><label for="name">Электронная почта</label></td>
				<td><input type="email" name="email" id="email" value="'.$user['email'].'" tabindex="2" /></td>
			</tr>
			<tr>
				<td></td>
				<td>
					<input type="checkbox" name="checkbox" id="checkbox" '.$chk.' />
					<label for="checkbox">Я не хочу получать вопросы по объявлению по e-mail</label>
				</td>
			</tr>
			<tr>
				<td><label for="phone">Номер телефона</label></td>
				<td><input type="phone" name="phone" id="phone" value="'.$user['phone'].'" tabindex="3" /></td>
			</tr>
			<tr>
				<td><label for="city">Город</label></td>
				<td>
					<select name="city" id="city">
						'.$user_city.'
					</select>
				</td>
			</tr>
			<tr>
				<td><label for="cat">Категория</label></td>
				<td>
					<select name="cat" id="cat">
						'.$user_cats.'
					</select>
				</td>
			</tr>
			<tr>
				<td><label for="title">Название объявления</label></td>
				<td><input type="text" name="title" id="title" tabindex="4" value="'.$user['title'].'" /></td>
			</tr>
			<tr>
				<td><label for="descr">Описание объявления</label></td>
				<td><textarea cols="40" rows="8" name="descr" id="descr">'.$user['descr'].'</textarea></td>
			</tr>
			<tr>
				<td><label for="price">Цена</label></td>
				<td><input type="text" name="price" id="price" value="'.$user['price'].'" tabindex="5" />руб.</td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" value="Отправить" /></td>
			</tr>
		</tbody>
	</table>
	';
}

?>
</body>
</html>