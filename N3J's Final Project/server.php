<?php if (session_status() == PHP_SESSION_NONE) {
    session_start();}

// initializing variables
$username = "";
$email    = "";
$firstname = "";
$lastname= "";
$studentid="";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'id21534139_integviolationfinal', 'ABCabc..123', 'id21534139_finalproject');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  //validate input , if no error 
  // receive all input values from the form
  $firstname = mysqli_real_escape_string($db, $_POST['firstname']);
  $lastname = mysqli_real_escape_string($db, $_POST['lastname']);
  $studentid = mysqli_real_escape_string($db, $_POST['studentid']);
$email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
  if (!is_string($firstname)) {
    array_push($errors, "String value is required in firstname");
  }

  if (!is_string($lastname)) {
    array_push($errors, "String value is required in lastname");
  }

  if (!is_numeric($studentid)) {
    array_push($errors, "Student ID must be numeric value only");
  }

  if (!preg_match("/^[A-Z0-9._-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/i",$email)) {
       array_push($errors, "Invalid Email Format");
  }
  

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($studentid)) { array_push($errors, "Student ID is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE studentid='$studentid' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['studentid'] === $studentid) {
      array_push($errors, "Student ID is already Registered");
    }

    if ($user['email'] === $email) {
      array_push($errors, "Email already exists");
    }
  }

  

      // Finally, register user if there are no errors in the form
      if (count($errors) == 0) {
      	$password = md5($password_1);//encrypt the password before saving in the database
      	
                if (!empty($studentid)) {
                  $firstnumber = substr($studentid, 0, 1);
                  
                      if ($firstnumber == 1) {
                          $restriction = 1  ; //teacher
                      } else if ($firstnumber > 1) {
                        $restriction = 2 ; //student
                      }   else if ($firstnumber == 0){
                        $restriction = 0 ; //admin
                      }   
                      
        } 
    
      	$query = "INSERT INTO users (studentid,firstname,lastname, email, password, restriction) 
      			  VALUES('$studentid','$firstname','$lastname', '$email', '$password','$restriction')";
      	      mysqli_query($db, $query);
    
        $_SESSION['studentid'] = $studentid;
        $_SESSION['firstname'] = $firstname;
    
        $destination = "SELECT restriction from users" ;
        $destinationQ = mysqli_query($db, $destination);
        $row = mysqli_fetch_assoc($destinationQ);
    
    
        if($row['restriction'] == 1){
          header('location: indexstudent.php');
        }else if($row['restriction'] == 2){
          header('location: indexfaculty.php');
        }else{
          header('location: index.php');
        }
      }
    
}

// LOGIN USER

if (isset($_POST['login_user'])) {

  $studentid = mysqli_real_escape_string($db, $_POST['studentid']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

 if (empty($studentid)) {
  	array_push($errors, "Student id is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }
  if (!is_numeric($studentid)) {
  	array_push($errors, "Student ID must be numeric");
  }
 
  

  if (count($errors) == 0) {
  	$password = md5($password);
  	$query = "SELECT * FROM users WHERE studentid='$studentid' AND password='$password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
      //knowing the restriction 
      $query = "SELECT restriction , firstname FROM users WHERE studentid = '$studentid'";
      $result = $db->query($query);
      $row = $result->fetch_assoc();
       
      if ($row['restriction'] == 1){
        $_SESSION['studentid'] = $studentid;  
  	    $_SESSION['success'] = "You are currently Logged in";
  	  header('location: indexfaculty.php');
      }
       if ($row['restriction'] == 2){
        $_SESSION['studentid'] = $studentid;
  	    $_SESSION['success'] = "You are currently Logged in";
  	   // echo '1 value located' . $row['firstname'] ;
  	    header('location: indexstudent.php');
      } 
      if ($row['restriction'] == 0){
        $_SESSION['studentid'] = $studentid;
  	    $_SESSION['success'] = "You are currently Logged in";
  	  header('location: dashboard.php');
      }
  	}else {
  		array_push($errors, "Wrong username/password combination");
  	}
  	
  	if (mysqli_num_rows($results) == 0){
      echo 'No records Selected' ;
    }
  }
}
?>