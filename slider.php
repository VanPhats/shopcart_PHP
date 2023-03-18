<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="./styles1.css">
</head>
<body>
<div class ="slider">
		<div class ="slides">
			<input type="radio" name = "radio-btn" id = "radio1">
			<input type="radio" name = "radio-btn" id = "radio2">
			<input type="radio" name = "radio-btn" id = "radio3">
			<input type="radio" name = "radio-btn" id = "radio4">


			<div class="slide fist">
				<img src="./baner/baner1.jpg" alt="">
			</div>
			<div class="slide">
				<img src="./baner/hinh8.jpg" alt="">
			</div>
			<div class="slide">
				<img src="./baner/hinh7.jpg" alt="">
			</div>
			<div class="slide">
				<img src="./baner/baner.jpg" alt="">
			</div>


			<div class="navigation-auto">
				<div class="auto-btn1"></div>
				<div class="auto-btn2"></div>
				<div class="auto-btn3"></div>
				<div class="auto-btn4"></div>
				
		</div>
		</div>
			<div class="navigation-manual">
				<label for="radio1" class="manual-btn"></label>
				<label for="radio2" class="manual-btn"></label>
				<label for="radio3" class="manual-btn"></label>
				<label for="radio4" class="manual-btn"></label>
				
		</div>
	</div>
    <script type="text/javascript">
        var counter =1;
        setInterval(function(){
            document.getElementById('radio'+counter).checked =true;
            counter++;
            if(counter>4){
                counter =1;
            }
        },5000);
        </script>
</body>
</html>