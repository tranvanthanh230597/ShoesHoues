<?php 
	@session_start();		
	if(isset($_POST['submit'])){		
		$email = $_POST['email'];
		$password = $_POST['password'];	
		include 'database.php';
		$pdo = Database::connect();	
		$sql = 'select * from user where email LIKE "'.$email.'" AND password like "'.$password.'"';
		echo 'true';	
		if($result = $pdo->query($sql))
			{
				//đếm số trang lấy được
				$row = $result->fetch(PDO::FETCH_ASSOC);
				$recordnumber = $result->rowCount();
				echo $recordnumber;
				if($recordnumber>0){
					session_start(); 
					$_SESSION['login'] = $row['Id'];							
					header("Location: index.php");
					
				}		    
				else
				{
					$error = 'Tài khoản đăng nhập không đúng';
				}
			}	              			    
	}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="UTF-8">
    <link rel="stylesheet" href="../css/bootstrap.min.css"/>    
 	<link rel="stylesheet" href="css/product.css"/>
	
    <script type="text/javascript" src="../js/jquery-1.11.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>    
</head>
<body>
	<div class="container">

      <form style="width:30%; margin:auto; margin-top: 150px;" class="form-signin" role="form" action="login.php" method="post">
        <h2 class="form-signin-heading">Đăng nhập</h2>
        <input type="email" name="email" class="form-control" placeholder="Địa chỉ email" required autofocus>
        <br>
        <input type="password" name="password" class="form-control" placeholder="Mật khẩu" required> 
        <br>      
        <input class="btn btn-lg btn-primary btn-block" name="submit" type="submit" value="Đăng nhập" />
      </form>

    </div> <!-- /container -->
</body>
</html>