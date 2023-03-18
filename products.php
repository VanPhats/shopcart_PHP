<?php 
	include 'connection.php';
	session_start();
	$user_id = $_SESSION['user_id'];

	if (isset($_POST['add_to_cart'])) {
		$name = $_POST['name'];
		$price = $_POST['price'];
		$image = $_POST['image'];
		$quantity=1;
	//	$select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
		$select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name='$name'AND user_id = '$user_id'") or die('query failed');
		if (mysqli_num_rows($select_cart)>0) {
			$message[] = 'product already added in your cart';
		}else{
			$query = "INSERT INTO `cart`(`name`,`user_id`,`price`,`image`,`quantity`) VALUES ('$name','$user_id', '$price', '$image', '$quantity')";
			$insert_query = mysqli_query($conn, $query);
			$message[] = 'product added in your cart';
		}
	};
		 
	
?>
<?php
include 'connection.php';
$searchErr = '';
$employee_details='';
if(isset($_POST['save']))
{
    if(!empty($_POST['search']))
    {
        $search = $_POST['search'];
        $stmt = $pdo->prepare("SELECT*FROM `products` WHERE name LIKE '%$search%'");
        $stmt->execute();
        $employee_details = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //print_r($employee_details);
         
    }
    else
    {
        $searchErr = "Please enter the information";
    }
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
	<link rel="stylesheet" type="text/css" href="./style5.css">
	<title>Products</title>
</head>
<body>
	
	<?php include 'header.php'; ?>
	<?php include 'slider.php';?>
	<section class="seach">
	<form class="form-horizontal" action="#" method="post">
    <div class="row">
        <div class="form-group">
            <label class="control-label col-sm-4" for="email"><b>Tìm kiếm sản phẩm:</b></label>
            <div class="col-sm-5">
              <input type="text" class="form-control" name="search" placeholder="nhập từ khóa tìm kiếm">
			  
              
            </div>
            <div class="col-sm-6">
				<button type="submit" name="save" class="option-btn">Search</button>
            </div>
        </div>
        <div class="form-group">
            <span class="error" style="color:red;">* <?php echo $searchErr;?></span>
        </div>
         
    </div>
    </form>
	<br/><br/>
    <h3><u> kết quả tìm kiếm sản phẩm</u></h3>
          <tbody>
                <?php
                 if(!$employee_details)
                 {
                    echo '<u>Không có kết quả tìm kiếm</u>';
                 }
                 else{
                    foreach($employee_details as $key=>$value)
                    {
                        ?>
						</tbody>
						</section>
	<div class="product-container">
        <div class="product-item-container">
			<form method="post">
				<div class="box">
					<img src="image/<?php echo  $value['image']; ?>" >
					<h3><?php echo  $value['name']; ?></h3>
					<div class="price"><?php echo  $value['price']; ?>VND</div>
					<input type="hidden" name="name" value="<?php echo $value['name']; ?>">
					<input type="hidden" name="price" value="<?php echo  $value['price']; ?>">
					<input type="hidden" name="image" value="<?php echo  $value['image']; ?>">
					<input type="submit" name="add_to_cart" value="add to cart" class="btn">
					<a class="btn"href="productsdt.php?id=<?php echo $value["id"]; ?>">View detail</a>
				</div>
				</form>
		</div>
			<?php 
					}
				}
			?>
		</div>
                       
             
        
    </div>


	<?php 
			if (isset($message)) {
				foreach ($message as $message) {
					echo '
						<div class="message">
							<span>'.$message.'</span>
							<i class="bi bi-x-circle" onclick="this.parentElement.remove()"></i>
						</div>

					';
				}
			}
		?>
	
		
	<div class="product-container">
		<h1> products </h1>
		<div class="product-item-container">
			<?php 
				$select_products=mysqli_query($conn, "SELECT * FROM `products`");
				if (mysqli_num_rows($select_products)>0) {
					while($fetch_products=mysqli_fetch_assoc($select_products)){


			?>
			<form method="post">
				<div class="box">
					<img src="image/<?php echo $fetch_products['image']; ?>">
					<h3><?php echo $fetch_products['name']; ?></h3>
					<div class="price"><?php echo $fetch_products['price']; ?> VND</div>
					 <input type="hidden" name="name" value="<?php echo $fetch_products['name']; ?>" >
					<input type="hidden" name="price" value="<?php echo $fetch_products['price']; ?>">
					<input type="hidden" name="image" value="<?php echo $fetch_products['image']; ?>">
						<a class="" href="productsdt.php?id=<?php echo $fetch_products["id"]; ?>">View detail</a>
					<input type="submit" name="add_to_cart" value="add to cart" class="btn">
				
				</div>
			</form>
			
			<?php 
					}
				}
			?>
		</div>
	</div>
	<script>!function(s,u,b,i,z){var o,t,r,y;s[i]||(s._sbzaccid=z,s[i]=function(){s[i].q.push(arguments)},s[i].q=[],s[i]("setAccount",z),r=["widget.subiz.net","storage.googleapis"+(t=".com"),"app.sbz.workers.dev",i+"a"+(o=function(k,t){var n=t<=6?5:o(k,t-1)+o(k,t-3);return k!==t?n:n.toString(32)})(20,20)+t,i+"b"+o(30,30)+t,i+"c"+o(40,40)+t],(y=function(k){var t,n;s._subiz_init_2094850928430||r[k]&&(t=u.createElement(b),n=u.getElementsByTagName(b)[0],t.async=1,t.src="https://"+r[k]+"/sbz/app.js?accid="+z,n.parentNode.insertBefore(t,n),setTimeout(y,2e3,k+1))})(0))}(window,document,"script","subiz", "acrpkewcavhjnwsailmw")</script>
<?php include 'footer.php'; ?>
</body>
</html>