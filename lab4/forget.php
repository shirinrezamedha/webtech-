<html>
<head>

</head>
<body>

<h2 style="text-align:center;"> Change Password</h2></br>

<div style="text-align:right;">
<a href="loging.php"><button>Loging</button></a>
</div>
<?php
$error= '';
$message = '';

$cpErr =  $npErr = $rpErr = $rpErr2 = $npErr2= $npErr3=  $emailErr="";
$cp = $np = $rp ="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {



if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
  }
   


  if (empty($_POST["cp"])) {
    $cpErr = "Current Password is required";
  }

   else {
    $cp = test_input($_POST["cp"]);
  }


    
  if (empty($_POST["np"])) {
    $npErr = "New password is required";
  }
   elseif((strlen($_POST["np"]))<8){

    $npErr2="Must enter 8 digit";
  }
  elseif(($_POST["np"])==($_POST["cp"]))
  {
    $npErr3 = "Same password,Try Again";
  }
 
   else {
    $np = test_input($_POST["np"]);
  }



if (empty($_POST["rp"])) {
    $rpErr = "password is required";
  }
elseif(($_POST["np"])!=($_POST["rp"]))
{
  $rpErr2 = "Same password is required";
}
   else {
    $rp = test_input($_POST["rp"]);
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}



if(isset($_POST["submit"])){

$data = file_get_contents('userdata.json');

// decode json to array
$json_arr = json_decode($data, true);

foreach ($json_arr as $key => $value) {
    if ($value['Email'] == $_POST["email"] && $value['Password']==$_POST["cp"] &&$_POST["np"]==$_POST["rp"] && $_POST["np"] != $_POST["cp"] ) {
        $json_arr[$key]['Password'] =$_POST["rp"] ;

          file_put_contents('userdata.json', json_encode($json_arr));
         $message="<label class='text-danger'>Successful</label>";
    }
    else
{
   $error = "<label class='text-danger'>Incorrect Email or password</label>"; 

}
  
}

 
}
else {
  echo '';
}


?>



  <form style="text-align:center;" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
 <div class="container" style="width:500px;"> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
  Email: <input type="text" name="email"required>

  <br><br>

  Current Password: <input type="password" name="cp" required >
  <span class="error">* <?php echo $cpErr;?></span>
   <span class="error"> <?php echo $npErr3;?></span>
  <br><br>

  New Password: <input type="password" name="np" required >
  <span class="error">* <?php echo $npErr;?></span>
  <span class="error"> <?php echo $npErr2;?></span>
  <span class="error"> <?php echo $npErr3;?></span>
   <span class="error"> <?php echo $rpErr2;?></span>
  <br><br>
  
  Retype new Password: <input type="password" name="rp" required >
  <span class="error">* <?php echo $rpErr;?></span>
   <span class="error"> <?php echo $rpErr2;?></span>
  <br><br>
  
  
  
  <input type="submit" name="submit" value="Submit" class="btn btn-info">

<?php   
                     if(isset($error))  
                     {  
                          echo $error;  
                     }  
                     ?>

                     <?php   
                     if(isset($message))  
                     {  
                          echo $message;  
                     }  
                     ?>

</form>
</div>




</body>
</html>