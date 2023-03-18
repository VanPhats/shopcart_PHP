<?php

include 'connection.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:login.php');
};

if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   $select_cart = mysqli_query
   ($conn, "SELECT * FROM `cart` WHERE name = '$product_name' 
   AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($select_cart) > 0){
      $message[] = 'product already added to cart!';
   }else{
      mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, image, quantity) VALUES('$user_id', '$product_name', '$product_price', '$product_image', '$product_quantity')") or die('query failed');
      $message[] = 'product added to cart!';
   }

};

if(isset($_POST['update_cart'])){
   $update_quantity = $_POST['cart_quantity'];
   $update_id = $_POST['cart_id'];
   mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_quantity' WHERE id = '$update_id'") or die('query failed');
   $message[] = 'cart quantity updated successfully!';
}

if(isset($_GET['remove'])){
   $remove_id = $_GET['remove'];
   mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$remove_id'") or die('query failed');
   header('location:cart.php');
}
  
if(isset($_GET['delete_all'])){
   mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
   header('location:cart.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>shopping cart</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
   <link rel="stylesheet" type="text/css" href="./style3.css">

</head>
<body>
<?php include 'header.php'; ?>
<?php
if(isset($message)){
   foreach($message as $message){
      echo '<div class="message" onclick="this.remove();">'.$message.'</div>';
   }
}
?>
<div class="cart-container">
   <div class="user-profile">

         <?php
         $select_user = mysqli_query($conn, "SELECT * FROM `user_form` WHERE id = '$user_id'") or die('query failed');
         if(mysqli_num_rows($select_user) > 0){
            $fetch_user = mysqli_fetch_assoc($select_user);
            $success = false;
            // Get the User IP
              
         };
      ?>
         <p> username : <span><?php echo $fetch_user['name']; ?></span> </p>
         <p> email : <span><?php echo $fetch_user['email']; ?></span> </p>
         <div class="flex">
            <a href="login.php?logout=<?php echo $user_id; ?>" onclick="return confirm('bạn muốn đăng xuất?');" class="delete-btn">logout</a>
         </div>
   </div>
   <h1 class="heading">shopping cart</h1>

   <table>
      <thead>
         <th>image</th>
         <th>name</th>
         <th>price</th>
         <th>quantity</th>
         <th>total price</th>
         <th>action</th>
      </thead>
      <tbody>
      <?php
         $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
         $grand_total = 0;
         if(mysqli_num_rows($select_cart ) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart )){
      ?>
         <tr>
            <td><img src="image/<?php echo $fetch_cart['image']; ?>" height="100" alt=""></td>
            <td><?php echo $fetch_cart['name']; ?></td>
            <td><?php echo $fetch_cart['price']; ?>VND</td>
            <td>
               <form action="" method="post">
                  <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">
                  <input type="number" min="1" name="cart_quantity" value="<?php echo $fetch_cart['quantity']; ?>">
                  <input type="submit" name="update_cart" value="update" class="option-btn">
               </form>
            </td>
            <!-- <td><?php echo $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?></td> -->
            <td><a href="cart.php?remove=<?php echo $fetch_cart['id']; ?>" class="delete-btn" onclick="return confirm('remove item from cart?');">remove</a></td>
         </tr>
      <?php
         $grand_total += $sub_total;
            }
         }else{
            echo '<tr><td style="padding:20px; text-transform:capitalize;" colspan="6">no item added</td></tr>';
         }
      ?>
      <tr class="table-bottom">
      <td><a href="products.php" class="option-btn">Tiếp tục mua hàng</a></td>
         <td colspan="3"><h1>Tổng tiền: </h1></td>
         <td style="font-weight: bold;" ><?php echo $grand_total; ?>VND</td>
         <td><a href="cart.php?delete_all" onclick="return confirm('delete all from cart?');" class="delete-btn <?php echo ($grand_total > 1)?'':'disabled'; ?>">delete all</a></td>
      </tr>
   </tbody>
   </table>

   <div class="checkout-btn">  
      <a href="checkout.php" class="btn <?php echo ($grand_total > 1)?'':'disabled'; ?>"> Đặt hàng</a>
   </div>
  
</div>


<script>!function(s,u,b,i,z){var o,t,r,y;s[i]||(s._sbzaccid=z,s[i]=function(){s[i].q.push(arguments)},s[i].q=[],s[i]("setAccount",z),r=["widget.subiz.net","storage.googleapis"+(t=".com"),"app.sbz.workers.dev",i+"a"+(o=function(k,t){var n=t<=6?5:o(k,t-1)+o(k,t-3);return k!==t?n:n.toString(32)})(20,20)+t,i+"b"+o(30,30)+t,i+"c"+o(40,40)+t],(y=function(k){var t,n;s._subiz_init_2094850928430||r[k]&&(t=u.createElement(b),n=u.getElementsByTagName(b)[0],t.async=1,t.src="https://"+r[k]+"/sbz/app.js?accid="+z,n.parentNode.insertBefore(t,n),setTimeout(y,2e3,k+1))})(0))}(window,document,"script","subiz", "acrpkewcavhjnwsailmw")</script>

</body>
</html>