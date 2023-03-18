<?php 
	include 'connection.php';
	session_start();
	$user_id = $_SESSION['user_id'];
	if (isset($_POST['order_btn'])) {
		$name = $_POST['name'];
		$number = $_POST['number'];
		$email = $_POST['email'];
		$payment_method = $_POST['payment-method'];
		$flate = $_POST['flate'];
		$street = $_POST['street'];
		$city = $_POST['city'];
		$state = $_POST['state'];
		$country = $_POST['country'];
		$pin = $_POST['pin'];

		$cart_query = mysqli_query($conn, "SELECT * FROM `cart`WHERE user_id = '$user_id'");
		$price_total = 0;
		if (mysqli_num_rows($cart_query) > 0) {
			while($product_item= mysqli_fetch_assoc($cart_query)){
				$product_name[]=$product_item['name'] .' ('.$product_item['quantity'].' )';
				$product_price=number_format($product_item['price'] * $product_item['quantity']);
				$price_total+=$product_price;
			}
		}
	
		$total_product=implode(', ', $product_name);
		$detail_query= mysqli_query($conn, "INSERT INTO `orders`( `name`, `number`, `email`, `method`, `flat`, `street`, `city`, `state`, `country`, `pin`, `total_products`, `total_price`) VALUES ('$name','$number','$email','$payment_method','$flate','$street','$city','$state','$country','$pin','$total_product','$price_total')") or die('query failed');
		
		if ($cart_query && $detail_query) {
			echo "
				<div class='order-confirm-container'>
					<div class='message-container'>
						<h3>thank you for shopping</h3>
						<div class='order-detail'>
							<span>".$total_product."</span>
							<span class='total'>total : $".$price_total."/-</span>
						</div>
						<div class='customer-details'>
							<p>Your name : <span>".$name."</span></p>
							<p>Your number : <span>".$number."</span></p>
							<p>Your email : <span>".$email."</span></p>
							<p>Your address : <span> ".$street.",".$flate.", ".$state.", ".$city.",  ".$country.", ".$pin."</span></p>
							
							
						</div>
						<a href='products.php' class='btn'>continue shopping</a>
					</div>
				</div>
			";
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
	<div class="checkout-form">
		<h1>thông tin thanh toán</h1>
		<div class="display-order">
			<?php 
			 $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
				//$select_cart=mysqli_query($conn, "SELECT * FROM `cart`");
				$total=0;
				$grand_total=0;
				if (mysqli_num_rows($select_cart)>0) {
					while($fetch_cart=mysqli_fetch_assoc($select_cart)){
						$total_price = $fetch_cart['price']* $fetch_cart['quantity'];
						$grand_total = $total += $total_price;
					
			?>
			<span><?= $fetch_cart['name']; ?>(<?= $fetch_cart['quantity']; ?>)</span>
			<?php 
					}
				}
			?>
			<span class="grand-total">Tổng tiền : $<?= $grand_total; ?></span>
		</div>
		<form method="post">
			<div class="input-field">
				<span>Tên</span>
				<input type="text" name="name" placeholder="Nhập tên" required>
			</div>
			<div class="input-field">
				<span>Số điện thoại</span>
				<input type="number" name="number" placeholder="Nhập số điện thoại" required>
			</div>
			<div class="input-field">
				<span> email</span>
				<input type="email" name="email" placeholder="Email" required>
			</div>
			<div class="input-field">
				<span>Phường thức thanh toán </span>
				<select name="payment-method">
					<option value="cash on delivery">Phương thức thanh toán</option>
					<option value="credit card">COD</option>
					<option value="paytm">Paypal</option>
				
				</select>
			</div>
			<div class="input-field">
				<span>Tên đường</span>
				<input type="text" name="street" placeholder="nhập tên đường" required>
			</div>
			<div class="input-field">
				<span>Phường</span>
				<input type="text" name="flate" placeholder="nhập phường xã" required>
			</div>
			<div class="input-field">
				<span>quận</span>
				<input type="text" name="state" placeholder="nhập quận" required>
			</div>
			
			<div class="input-field">
				<span>Thành phố</span>
				<input type="text" name="city" placeholder="nhập thành phố" required>
			</div>
			
			<div class="input-field">
				<span>Quốc gia</span>
				<input type="text" name="country" placeholder="nhập quốc gia" required>
			</div>
		
			<input type="submit" name="order_btn" value="Đặt hàng" class="btn">
		</form>
		<form class="" method ="POST" target="_blank" enctype="application/x-www-form-urlencoded"
			action ="xulythanhtoanmomo.php">
			<input type="hidden" value="<?php echo $grand_total?>" name ="grand_total">
				<input type ="submit" name="momo" value="Thanh toan momo QRCODE" class="option-btn">
		</form>
	</div>
</body>
</html>