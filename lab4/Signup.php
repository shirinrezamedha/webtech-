<?php  
 $message = '';  
 $error = '';  
 if(isset($_POST["submit"]))  
 {  
      if (!preg_match("/^[a-zA-Z-' ]*$/",($_POST["fname"])))  
      {  
           $error = "<label class='text-danger'>Name,Only use letter.</label>";  
      }
      

      else if (!filter_var(($_POST["email"]), FILTER_VALIDATE_EMAIL)) 
      {  
           $error = "<label class='text-danger'>Enter an valide e-mail</label>";  
      } 
      else if(empty($_POST["pnumber"]))  
      {  
           $error = "<label class='text-danger'>Enter Phone Number</label>";  
      }


     else if(empty($_POST["np1"]))  
      {  
           $error = "<label class='text-danger'>Enter a username</label>";  
      }  

      elseif((strlen($_POST["np1"]))<8){

       $error="<label class='text-danger'>Password,Must enter 8 digit</label>";
     }


      else if(empty($_POST["rp1"]))  
      {  
           $error = "<label class='text-danger'>password is required</label>";  
      }  

      elseif(($_POST["rp1"])!=($_POST["np1"]))
     {
          $error = "<label class='text-danger'>Same password is required</label>"; 

      }

      else if (empty($_POST["dob"])) {
          $error = "<label class='text-danger'>Date Of Birt is required</label>";  
       } 
      else if(empty($_POST["gender"]))  
      {  
           $error = "<label class='text-danger'>Gender cannot be empty</label>";  
      } 
       
      else  
      {  
           if(file_exists('userdata.json'))  
           {  
                $current_data = file_get_contents('userdata.json');  
                // echo "old data: <br>". $current_data."<br>";
                $array_data = json_decode($current_data, true);  
                $new_data = array(  
                     
    'Name'=> $_POST["fname"],
    'Email'=>$_POST["email"],
    'phone number'=>$_POST["pnumber"],
    'Password'=>$_POST["np1"],
    'Dob'=>$_POST["dob"],
    'Gender'=>$_POST["gender"]
                );  

                // echo "new data:";
                // echo json_encode($new_data);
                $array_data[] = $new_data;  
                $final_data = json_encode($array_data);  

                // echo "final data: <br>". $final_data."<br>";
                if(file_put_contents('userdata.json', $final_data))  
                {  
                     $message = "<label class='text-success'>File Appended Success fully</p>";  
                }  
           }  
           else  
           {  
                $error = 'JSON File not exits';  
           }  
      }  
 }  
 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>Registration</title> 
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  

<br></br> 
<div style="text-align:right;">
<a href="h.php"><button>Home</button></a>
<a href="loging.php"><button>Loging</button></a>

</div>
     </head>  
      <body>  
           <br />  
           <div class="container" style="width:500px;">  
                <h3 align="">Registration</h3>                
                <form method="post">  
                   
                     <br />  
                     <label>Name</label>  
                     <input type="text" name="fname" class="form-control"  /><br />  

                    

                     <label>E-mail</label>
                     <input type="text" name = "email" class="form-control"   /><br />


                     <label>Phone Number</label>
                     <input type="text" name = "pnumber" class="form-control"   /><br />


                     <label>Password</label>
                     <input type="password" name = "np1" class="form-control"   /><br />
                   
                     <label>Confirm Password</label>
                     <input type="password" name = "rp1" class="form-control"   /><br />

                    <fieldset>
                    <legend>Gender</legend>
                    <input type="radio" id="male" name="gender" value="male" >
                     <label for="male">Male</label>                     
                     <input type="radio" id="female" name="gender" value="female">
                     <label for="female">Female</label>
                     <input type="radio" id="other" name="gender" value="other">
                     <label for="other">Other</label><br>

                     <legend>Date of Birth:</legend>
                     <input type="date" name="dob"   > <br><br>
                    </fieldset> 
                     
                   

                     <input type="submit" name="submit" value="Submit" class="btn btn-info" /><br />                      
                     <?php  
                     if(isset($message))  
                     {  
                          echo $message;  
                     }  
                     ?>  

                     <?php   
                     if(isset($error))  
                     {  
                          echo $error;  
                     }  
                     ?>

                </form>  
           </div>  
           <br />  
      </body>  
 </html>  