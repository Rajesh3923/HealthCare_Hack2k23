<?php
session_start();
include_once 'database.php';
    if(isset($_POST['Email']) && isset($_POST['Firstname']) && isset($_POST['Lastname'])&& isset($_POST['Password']))
    {
        $Email = $_POST['Email'];
        $Firstname = $_POST['Firstname'];
        $Lastname = $_POST['Lastname'];
        $Password = $_POST['Password'];
		
		$email = validate($_POST['Email']);
        $fname = validate($_POST['Firstname']);
		$lname = validate($_POST['Lastname']);
		$pass = validate($_POST['Password']);

		if(empty($email)){
			header("Location: index.php?error=Email is required");
			exit();	

		}else if(empty($fname)){
			header("Location: index.php?error=Firstname is required");
			exit();

		}else if(empty($lname)){
			header("Location: index.php?error=Lastname is required");
			exit();
		}else if(empty($pass)){
			header("Location: index.php?error=Password is required");
			exit();
		}
		else{
			$sql_student = "SELECT * FROM Logindetails WHERE Email='".$email."'";
			
			$result_stuednt = mysqli_query($conn, $sql_student);
			
			if(mysqli_num_rows($result_stuednt) == 1){
				$sql_student = "SELECT * FROM Logindetails WHERE Email='".$email."'";
				$result_stuednt = mysqli_query($conn, $sql_student);
				mysqli_num_rows($result_stuednt);
				$row = mysqli_fetch_assoc($result_stuednt);

				if($row['Email'] === $email && $row['Firstname'] === $fname && $row['Lastname'] === $lname && $row['Password'] === $pass){

					$_SESSION['Email'] = $row['Email'];
					$_SESSION['Firstname'] = $row['Firstname'];
					$_SESSION['Lastname'] = $row['Lastname'];
					$_SESSION['Password'] = $row['Password'];
					 header("Location: login.html");
					 exit();   
					
				}else{
					header("Location: index.php?error=Incorrect email or Password 1");
					exit();
				}
			}
			else{
				header("Location: index.php?error=User doesn't exist");
				exit();
			}
		}

	}else{
		header("Location: index.php?");
		exit();	
	}
    
    /*
       

	if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
		$uri = 'https://';
	} else {
		$uri = 'http://';
	}
	$uri .= $_SERVER['HTTP_HOST'];
	header('Location: '.$uri.'/dashboard/');
	exit;
?>
Something is wrong with the XAMPP installation :-(

*/
