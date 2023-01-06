<?php
session_start();
include "db.php";
	if(isset($_POST['username']) && isset($_POST['password'])){


		function validate($data){
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
		$uname = validate($_POST['username']);
		$pass = validate($_POST['password']);

		if(empty($uname)){
			header("Location: index.php?error=User Name is required");
			exit();	

		}else if(empty($pass)){
			header("Location: index.php?error=Password is required");
			exit();

		}else{
			$sql_student = "SELECT * FROM patient WHERE username='".$uname."'";
			
			$result_stuednt = mysqli_query($conn, $sql_student);
			
			if(mysqli_num_rows($result_stuednt) == 1){
				$sql_student = "SELECT * FROM patient WHERE username='".$uname."'";
				$result_stuednt = mysqli_query($conn, $sql_student);
				mysqli_num_rows($result_stuednt);
				$row = mysqli_fetch_assoc($result_stuednt);

				if($row['username'] === $uname && $row['passwords'] === $pass){

					$_SESSION['username'] = $row['username'];
					$_SESSION['id'] = $row['id'];
					$_SESSION['name'] = $row['name'];
					 header("Location: dd.html");
					 exit();   
					
				}else{
					header("Location: index.php?error=Incorrect username or Password 1");
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
 ?>