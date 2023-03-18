<?php

include 'connection.php';
session_start();

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

   $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      // Insert User Time Login
                       
      $user_id = $_SESSION['user_id'];
      $_SESSION['login']=$email;                                            
      $row = mysqli_fetch_assoc($select);
      $_SESSION['user_id'] = $row['id'];
      $uip=$_SERVER['REMOTE_ADDR']; // get the user ip 
      // query for inser user log in to data base
      $query="INSERT INTO `userlog`(userId,username,userIp) VALUES('".$_SESSION['user_id']."','".$_SESSION['login']."','$uip')";   
      // $query = "INSERT INTO `products`(`name`, `price`,`image`,`detail`) VALUES ('$name', '$price', '$p_image','$detail')";  
      $insert_query = mysqli_query($conn, $query);  
      header('location:products.php');
                             
                                            
   }else{
      $message[] = 'incorrect password or email!';
   }

}
  
                                      
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>

   <link rel="stylesheet" type="text/css" href="style3.css">

</head>
<body>

<?php
if(isset($message)){
   foreach($message as $message){
      echo '<div class="message" onclick="this.remove();">'.$message.'</div>';
   }
}
?>
   
<div class="form-container">

   <form action="" method="post">
      <h3>login now</h3>
      <input type="email" name="email" required placeholder="enter email" class="box">
      <input type="password" name="password" required placeholder="enter password" class="box">
      <input type="submit" name="submit" class="btn" value="Đăng nhập">
      <p>Bạn có tài khoản chưa? <a href="regsister.php">Đăng ký đê!</a></p>
   </form>

</div>

</body>
</html>