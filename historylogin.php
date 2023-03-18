<?php
session_start();
include('connection.php');
$user_id = $_SESSION['user_id'];

error_reporting(0);
if($_SESSION['login'])
{
	?>

	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="robots" content="noindex, nofollow">
		<title>Login Form</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
		<link rel="stylesheet" type="text/css" href="./style7.css">
	</head>
	<body>
		<div class="container">
			<div>&nbsp;</div>
			<div class="  d-flex flex-row align-items-center justify-content-between">
				<div class="">
					<a href="admin.php"><button type="button" class="btn btn-sm btn-primary"  ><i class="fas fa-plus" ></i> Quay lại trang quản lý
					</button></a>
				</div>
			</div>
				<div>&nbsp;</div>
			<div class="show-product ">
				<table id="" class="table table-bordered">
					<thead>
						<tr>
							<th>User Name</th>
							<th>User Ip</th>
							<th>Login Time</th>
						</tr>
					</thead>
				<tbody>
      				<?php
     					 $select_orders = mysqli_query($conn, "SELECT * FROM `userlog`") or die('query failed');
      					if(mysqli_num_rows($select_orders) > 0){
         				while($fetch_orders = mysqli_fetch_assoc($select_orders)){
    					  ?>
    					  <tr>
        
						<td><?php echo $fetch_orders['username']; ?> </td>
						<td><?php echo $fetch_orders['userIp']; ?></td>
						<td><?php echo $fetch_orders['loginTime']; ?></td>
						
        
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
	</div>
		</div> 
	</body>
	<?php
} else{
	header('location:logout.php');
}
?>
