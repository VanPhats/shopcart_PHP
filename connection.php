<!-- 
	$conn = mysqli_connect("localhost", "root", "", "cart") or die('connection failed');

?> -->

<?php
$servername='localhost';
$username="root";
$password="";
 
try
{
	$conn = mysqli_connect("localhost", "root", "", "cart") or die('connection failed');
    $pdo=new PDO("mysql:host=$servername;dbname=cart",$username,$password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    //echo 'connected';
}
catch(PDOException $e)
{
    echo '<br>'.$e->getMessage();
}
     
?>