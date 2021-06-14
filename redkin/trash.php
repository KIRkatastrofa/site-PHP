<?php
	session_start();
	if( !isset($_SESSION['LogIn']) ) 
	{
		header("Location: aut.html");
		exit(1);
	}
	require_once "mysqli.php";
	$login=$_SESSION['user'];
	$count=1;
	$key=true;
	if(!empty($_GET["product"])) {
		
		db_connect();
		$id=$_GET["product"];
		$query1 = "SELECT * FROM product WHERE id_product='$id'";
		$search = mysqli_query($conn, $query1);
		while($row = mysqli_fetch_assoc($search))
		{
			$price=$row['price'];
		}
		$qw3= "SELECT * FROM users WHERE login='$login'";
		$sear3=mysqli_query($conn, $qw3);
		while($row3 = mysqli_fetch_assoc($sear3))
		{
			$id_user=$row3['id_user'];
		}
		$qw2= "SELECT * FROM trash WHERE id_product='$id'";
		$sear2=mysqli_query($conn, $qw2);
		while($row2 = mysqli_fetch_assoc($sear2))
		{
			if($row2['id_product']==$id and $row2['id_user']==$id_user)
			{
				$id_trash=$row2['id_trash'];
				$count=$row2['counttr']+1;
				$totalprice=$price*$count;
				$key=false;
			}
		}
		if($key==true)
		{
		$qw="INSERT INTO trash (id_product, counttr, totalprice, id_user) VALUES ('$id','$count','$price','$id_user')";
		$sear = mysqli_query($conn, $qw);
		}
		else if($key==false)
		{
		$qw="UPDATE trash SET id_product='$id', counttr='$count', totalprice='$totalprice', id_user='$id_user' WHERE id_trash='$id_trash'";
		$sear = mysqli_query($conn, $qw);
		}
		db_close();
	}

?>