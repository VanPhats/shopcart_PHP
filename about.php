<?php

include 'connection.php';
session_start();
$user_id = $_SESSION['user_id'];

?>
<!DOCTYPE html>
<html>
 <head>
  <title>About</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
  <link rel="stylesheet" type="text/css" href="styleab.css">
 </head>
 <body>
 <?php include 'header.php'; ?>
 <div class="about-section">
  <h1>About Us Page</h1>
  <p>Welcome to PN.SHOP</p>
  <p>No. 1 store in Vietnam </p>
</div>

    <h2 style="text-align:center">Our Team</h2>
    <div class="row">
        <div class="column">
            <div class="card">
            <img src="images/1.jpg" alt="Jane" style="width:100%">
                <div class="container">
                <h2>Thiều Văn Phát</h2>
                <p class="title">Leader</p>
                <p>No.1 codder VietNam</p>
                <p>vanphat2k1@gmail.com</p>
                
                </div>
            </div>
     </div>

        <div class="column">
            <div class="card">
            <img src="images/2.png" alt="Mike" style="width:100%">
            <div class="container">
                <h2>Nguyễn Minh Nhật</h2>
                <p class="title">Destroy projects</p>
                <p>Cool boy</p>
                <p>minhnhat@gmail.com</p>
                </div>
            </div>
    </div>
</div>
</div>
  <br />
  <h2 align="center">Comment For Us</h2>
  <br />
  <div class="container">
   <form method="POST" id="comment_form">
    <div class="form-group">
     <input type="text" name="comment_name" id="comment_name" class="form-control" placeholder="Enter Name" />
    </div>
    <div class="form-group">
     <textarea name="comment_content" id="comment_content" class="form-control" placeholder="Enter Comment" rows="5"></textarea>
    </div>
    <div class="form-group">
     <input type="hidden" name="comment_id" id="comment_id" value="0" />
     <input type="submit" name="submit" id="submit" class="btn btn-info" value="Comment" />
     <div> <h2>Comments of people</h2></div>
    </div>
   </form>
   <span id="comment_message"></span>
   <br />
   <div id="display_comment"></div>
  </div>
  <?php include 'footer.php'; ?>
 </body>
</html>

<script>
$(document).ready(function(){
 
 $('#comment_form').on('submit', function(event){
  event.preventDefault();
  var form_data = $(this).serialize();
  $.ajax({
   url:"add_comment.php",
   method:"POST",
   data:form_data,
   dataType:"JSON",
   success:function(data)
   {
    if(data.error != '')
    {
     $('#comment_form')[0].reset();
     $('#comment_message').html(data.error);
     $('#comment_id').val('0');
     load_comment();
    }
   }
  })
 });

 load_comment();

 function load_comment()
 {
  $.ajax({
   url:"fetch_comment.php",
   method:"POST",
   success:function(data)
   {
    $('#display_comment').html(data);
   }
  })
 }

 $(document).on('click', '.reply', function(){
  var comment_id = $(this).attr("id");
  $('#comment_id').val(comment_id);
  $('#comment_name').focus();
 });
 
});
</script>

