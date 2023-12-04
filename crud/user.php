<?php

    include 'connect.php';
    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
        $password = $_POST['password'];

        $sql = "INSERT INTO crud (name, email, mobile, password)
        VALUES ('$name', '$email', '$mobile', '$password')";
        
        $result = mysqli_query($con, $sql);

        if($result){
           // echo "Data inserted successfully";
           header('location:display.php');
        } else {
            die(mysqli_error($con));
        }
    }

    if (isset($_POST['backToHome'])) {
    header('location: display.php'); // Change 'home.php' to the actual home page URL
    exit(); // Add exit() to stop further execution
}
?>





<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>CRUD Application</title> 
    <style>
        *{
            margin: 20px;
        }
    </style>
  </head>
  <body>
    <form method="post">
  <div class="form-group col-md-4">
    <label>Name</label>
     <input type="text" class="form-control" name="name" placeholder="Enter your name" autocomplete="off">
   
    </div>

    <div class="form-group col-md-4">
    <label>Email</label>
     <input type="email" class="form-control" name="email" placeholder="Enter your email" autocomplete="off">    
    </div>

    <div class="form-group col-md-4">
    <label>Mobile</label>
     <input type="text" class="form-control" name="mobile" placeholder="Enter your mobile" autocomplete="off">    
    </div>

    <div class="form-group col-md-4">
    <label>Password</label>
     <input type="password" class="form-control" name="password" placeholder="Enter your password" autocomplete="off">  
    </div>

    <button style="margin-left: 40px;" type="submit" class="btn btn-primary" name="submit" >Submit</button>
    <button style="margin-left: 235px;" type="submit" class="btn btn-primary" name="backToHome" >Home</button>
</form>

  </body>
</html>