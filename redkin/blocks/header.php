<?php
	session_start();
	require_once "mysqli.php";
	db_connect();
	$login=$_SESSION['user'];
	$head="SELECT * FROM users WHERE login='$login'";
	$reshead=mysqli_query($conn,$head);
	while($rowr = mysqli_fetch_assoc($reshead))
	{
		$statuss=$rowr['status'];
		$id_user=$rowr['id_user'];
	}
	// Массив с товарами и проверка на наличие в корзине
	$headtrash = "SELECT * FROM trash WHERE id_user='$id_user'";		
	$resheadtrash = mysqli_query($conn, $headtrash);
	if(mysqli_num_rows($resheadtrash) > 0)
	{
		$tr="(заполнена)";
	}
	else
	{
		$tr="";
	}
	if( isset($_SESSION['LogIn']) ) 
	{
		$resultet=<<<_TXT
 <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item active">
       <a class="link" href="index.html"><span>Главная</span></a>
      </li>
    </ul>
		<div class="dropdown" style="margin-left:20px;">
  <a style="background-color: white" class="btn btn-secondary" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Сортировать
  </a>
<a id="select-sort"></a>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
	<a class="dropdown-item" href="index.html?sort=ascp">по возрастанию цены</a>
	<a class="dropdown-item" href="index.html?sort=descp">по убыванию цены</a>
	<a class="dropdown-item" href="index.html?sort=ascn">по наименованию</a>
  </div>
   </div>
   </div>
   <div class="dropdown" style="margin-left:20px;">
    <a style="background-color: white" class="btn btn-secondary" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Категория
  </a>
<a id="select-sort"></a>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
	<a class="dropdown-item" href="category.html?category=gardens">Сады</a>
	<a class="dropdown-item" href="category.html?category=electronics">Электроника</a>
	<a class="dropdown-item" href="category.html?category=plumbing">Водопровод</a>
	<a class="dropdown-item" href="category.html?category=tools">Инструменты</a>
  </div>
    </div>
    <form class="form-inline my-2 my-lg-0">
      <input style="margin-left:20px" class="form-control mr-sm-2" type="search" placeholder="Поиск" name="search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Поиск</button>
    </form>
_TXT;
	}
	db_close();
?>

<html lang="ru">
<head>
<link href="style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
	<meta charset="utf-8">
	<title>Главная</title>	
</head>
<body>
<nav  class="navbar navbar-expand-sm bg-light">
<img src="Безымянный1.jpg" max-width=80%; height=100px; />

<?php 
if($statuss=="root")
		{
			echo "<a href='indextrash.html'><button>Просмотр заказов</button></a>";
			echo "<a href='addcus.html'><button>Добавить заказчика</button></a>";
			echo "<a href='reg.html'><button>Добавить пользователя</button></a>";
			echo "<a href='add.html'><button>Добавление товара</button></a>";
			echo "<a href='trash.html'><button id='trash-menu-txt'>Корзина$tr</button></a>";
			echo "<a href='logout.php'><button>Выйти</button></a>";
		}
		else if($statuss=="admin")
		{
			echo "<a href='addcus.html'><button>Добавить заказчика</button></a>";
			echo "<a href='add.html'><button>Добавление товара</button></a>";
			echo "<a href='trash.html'><button id='trash-menu-txt'>Корзина$tr</button></a>";
			echo "<a href='logout.php'><button>Выйти</button></a>";
		}
		else if($statuss=="user")
		echo "<a href='logout.php'><button>Выйти</button></a>";

?>
</div>
</nav>
<form method="GET" action="search.html?search=">
<nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color: #e3f2fd;">
<?=$resultet?>
</nav>

</form>
</body>