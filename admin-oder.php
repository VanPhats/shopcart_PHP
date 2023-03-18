<?php

include 'connection.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin-login.php');
}

if(isset($_POST['update_order'])){

   $order_update_id = $_POST['order_id'];
   // $update_payment = $_POST['update_payment'];
   // mysqli_query($conn, "UPDATE `orders` SET payment_status = '$update_payment' WHERE id = '$order_update_id'") or die('query failed');
   // $message[] = 'payment status has been updated!';

}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `orders` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_orders.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>orders</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="style3.css">

</head>
<body>
   
<?php include 'admin-header.php'; ?>

<section class="show-product" >

   <h1 class="title">placed orders</h1>
   <a href="admin.php">admin dashboard</a>
   <table>
   <thead>
         <th>Tên </th>
         <th>số điện thoại </th>
         <th>email</th>
         <!-- <th>payment method</th> -->
         <th>tên đường, phường </th>
         <th>quận </th>
         <th>thành phố </th>
        
         <th>sản phẩm </th>
         <th>tổng tiền </th>
      </thead>
    <tbody>
      <?php
      $select_orders = mysqli_query($conn, "SELECT * FROM `orders`") or die('query failed');
      if(mysqli_num_rows($select_orders) > 0){
         while($fetch_orders = mysqli_fetch_assoc($select_orders)){
      ?>
      <tr>
         <td><?php echo $fetch_orders['name']; ?> </td>
         <td><?php echo $fetch_orders['number']; ?> </td>
         <td><?php echo $fetch_orders['email']; ?></td>
         <td><?php echo $fetch_orders['street']; ?></td>
         <td><?php echo $fetch_orders['flat']; ?></td>
         <td><?php echo $fetch_orders['city']; ?></td>
         <td><?php echo $fetch_orders['total_products']; ?> </td>
         <td>$<?php echo $fetch_orders['total_price']; ?></td>
        
        
         <form action="" method="post">
            <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id']; ?>">
            
         </form>
      </tr>
      <?php
         }
      }else{
         echo '<p class="empty">no orders placed yet!</p>';
      }
      ?>
   
   </tbody>
   </table>
</section>


<!-- custom admin js file link  -->
<script src="js/admin_script.js"></script>

</body>
</html>