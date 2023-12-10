<?php
if(!isset($_SESSION)){ 
  session_start(); 
}
define('TITLE', 'Contact');
define('PAGE', 'contact');
//include('./mainInclude/header.php'); 
//include('./mainInclude/footer.php'); 
include('./dbConnection.php');





 if(isset($_REQUEST['submit'])){
  if(($_REQUEST['c_message'] == "")){
   // msg displayed if required field missing
   $passmsg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fileds </div>';
  } else {
   $c_name = $_REQUEST["c_name"];
   $c_subject = $_REQUEST["c_subject"];
   $c_email = $_REQUEST["c_email"];
   $c_message = $_REQUEST["c_message"];
   $sql = "INSERT INTO contact (c_name, c_subject, c_email, c_message) VALUES ('$c_name', '$c_subject', '$c_email', '$c_message')";

   if($conn->query($sql) == TRUE){
   // below msg display on form submit success
   $passmsg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Submitted Successfully </div>';
   } else {
   // below msg display on form submit failed
   $passmsg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to Submit </div>';
      }
    }
 }

?>



<!--Start Contact Us-->
<div class="container mt-4" id="Contact">  <!--Start Contact Us Container-->
      <h2 class="text-center mb-4">Contact US</h2> <!-- Contact Us Heading -->
      <div class="row">  <!--Start Contact Us Row-->
        <div class="col-md-8"> <!--Start Contact Us 1st Column-->
          <form action="" method="post">
            <input type="text" class="form-control" name="c_name" placeholder="Name"><br>
            <input type="text" class="form-control" name="c_subject" placeholder="Subject"><br>
            <input type="email" class="form-control" name="c_email" placeholder="E-mail"><br>
            <textarea class="form-control" name="c_message" placeholder="How can we help you?" style="height:150px;"></textarea><br>
            <input class="btn btn-primary" type="submit" value="Send" name="submit"><br><br>
            <?php if(isset($passmsg)) {echo $passmsg; } ?>
          </form>
        </div> <!-- End Contact Us 1st Column-->

        <div class="col-md-4 stripe text-white text-center">  <!-- Start Contact Us 2nd Column-->
          <h4>BUX2.0</h4>
          <p>BUX2.0, 
          Near Brac University, 
          Mohakhali,Dhaka<br /> 
          Phone: 01723456789 <br />
          www.bux2.com </p>
        </div> <!-- End Contact Us 2nd Column-->
      </div> <!-- End Contact Us Row-->
    </div> <!-- End Contact Us Container-->
    <!-- End Contact Us -->