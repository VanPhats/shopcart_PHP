<?php
include 'connection.php';
	session_start();
	$user_id = $_SESSION['user_id'];

    $id="";
    if(isset($_GET["id"]))
    {
        $id =$_GET["id"];
    };

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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
 
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="./style3.css">
</head>
<body>
<?php include 'header.php'; ?>

<div class ="col-md-12"></div>
<div class="container">
    <h1 style="color:black">Product detail</h1>
    
<?php
				$select_products=mysqli_query($conn, "SELECT * FROM `products`WHERE id=$id");
				if (mysqli_num_rows($select_products)>0) {
					while($fetch_products=mysqli_fetch_assoc($select_products)){
                        ?>
                    <!-- <div class="row">
                        <div class="col-md-5">
                       
                        <img  src="image/<?php echo $fetch_products['image']; ?>" style ="width:100%;">
                        <input type="hidden" name="price" value="<?php echo $fetch_products['price']; ?>">

                         </div>
                        <div class="col-md-7">
                        <h1>name product:<?php echo $fetch_products['name']; ?></h1>
                        <p> price: <?php echo $fetch_products['price']; ?>$</p>
                        <p> detail: <?php echo $fetch_products['detail']; ?></p>
                        <input type="submit" name="add_to_cart" value="add to cart" class="btn">
                        </div>
  
                    </div> -->
                    <form method="post">
				<div class="row">
                    <div class="col-md-5">
                            <img src="image/<?php echo $fetch_products['image']; ?>"style ="width:100%;">
                        </div>
                    <div class="col-md-7">
					<h3><?php echo $fetch_products['name']; ?></h3>
					<div class="price">Price:<?php echo $fetch_products['price']; ?> VND</div>
                   
					<input type="hidden" name="name" value=" <?php echo $fetch_products['name']; ?>" >
					<input type="hidden" name="price" value="<?php echo $fetch_products['price']; ?>">
					<input type="hidden" name="image" value="<?php echo $fetch_products['image']; ?>">
                    <p> detail: <?php echo $fetch_products['detail']; ?></p>
					<input type="submit" name="add_to_cart" value="add to cart" class="btn">
                    </div>
				</div>
                    <?php
                    }
                }
               
                
               
?>  
    </div>
<br><br>


<script>!function(s,u,b,i,z){var o,t,r,y;s[i]||(s._sbzaccid=z,s[i]=function(){s[i].q.push(arguments)},s[i].q=[],s[i]("setAccount",z),r=["widget.subiz.net","storage.googleapis"+(t=".com"),"app.sbz.workers.dev",i+"a"+(o=function(k,t){var n=t<=6?5:o(k,t-1)+o(k,t-3);return k!==t?n:n.toString(32)})(20,20)+t,i+"b"+o(30,30)+t,i+"c"+o(40,40)+t],(y=function(k){var t,n;s._subiz_init_2094850928430||r[k]&&(t=u.createElement(b),n=u.getElementsByTagName(b)[0],t.async=1,t.src="https://"+r[k]+"/sbz/app.js?accid="+z,n.parentNode.insertBefore(t,n),setTimeout(y,2e3,k+1))})(0))}(window,document,"script","subiz", "acrpkewcavhjnwsailmw")</script>
<?php include 'footer.php'; ?>
</body>
</html>