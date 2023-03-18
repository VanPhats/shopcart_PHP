<?php 
	include 'connection.php';
	session_start();

	$user_id = $_SESSION['user_id'];
	
	if(!isset($user_id)){
	   header('location:login.php');
	}
	
	if (isset($_POST['add_product'])) {
		$name = $_POST['p_name'];
		$price = $_POST['p_price'];
		$detail= $_POST['p_detail'];
		$p_image = $_FILES['p_image']['name'];
		$p_image_temp_name = $_FILES['p_image']['tmp_name'];
		$p_image_folder = 'image/'.$p_image;

		$query = "INSERT INTO `products`(`name`, `price`,`image`,`detail`) VALUES ('$name', '$price', '$p_image','$detail')";
		$insert_query = mysqli_query($conn, $query);

		if ($insert_query) {
			move_uploaded_file($p_image_temp_name, $p_image_folder);
			$message[] = 'product added sucessfully';
			header('location:admin.php');
		}else{
			$message[] = 'product did not added sucessfully';
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
	<link rel="stylesheet" type="text/css" href="style3.css">
	<title>add products</title>
</head>
<body>
	<?php include 'header.php'; ?>
	<div class="form">
		<form method="post" enctype="multipart/form-data">
			<h3>add a new product</h3>
			<input type="text" name="p_name" placeholder="enter product name" required>
			<input type="number" name="p_price" min="0" placeholder="enter product price" required>
			<input type="file" name="p_image" accept="image/png, image/jpg, image/jpeg" required>
			<input type="detail" name="p_detail"  placeholder="enter product deatail " required>
			<input type="submit" name="add_product" value="add product" class="btn">
			
		</form>
		<a href="admin.php">Cancle</a>
	</div>
</body>
</html>