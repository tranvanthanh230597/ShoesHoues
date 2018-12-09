<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="GallerySoft.info" />
    <meta charset="UTF-8" />
	<title>Shoes House :)</title>    
    <link rel="stylesheet" href="css/bootstrap.min.css"/>    
	<link rel="stylesheet" href="css/home.css"/>	
    <script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript">
    	function validation(){    	
    		var length = document.form_search.keyword.value.length;
    		if (length ==0)
    		{    			
    			alert("Vui lòng nhập tên sản phẩm cần tìm");
    			keyword.focus();
    			return false;
    		}    		
    		return true;
    			    	
    	}
    </script>
</head>

<body>
    <header>
        <div class="container">
        	<div class="row top">
				<div class="col-md-4">
		            <a href="#">
		                <img src="images/bookstore.png" id="logo" class="img-responsive" alt="Book Online" />
		            </a>
		        </div>
		        <div class="col-xs-9 col-md-6">
		            <a href="#">
		                <img src="images/banner-book-shelf.png" id="logo2" class="img-responsive" alt="Book Online" />
		            </a>
		        </div>
		        <div class="col-xs-3 col-md-2">
		        	<div class="cart_zone">
			        	<a href="cart.php">
			                <img src="images/cart.png" id="logo3" class="img-responsive" alt="Book Online" />
			                Giỏ hàng (
			                <?php 
			                	@session_start();
			                	if(isset($_SESSION['cart']))
			                		{
			                			echo count($_SESSION['cart']);
			                		}
			                	else 
			                		{
			                			echo '0';
			                		} 
			                ?>
			                )
			            </a>
					</div>
		        </div>
            </div>
        </div>
    </header>
            <nav class="navbar navbar-default" role="navigation">
			  <div class="container-fluid container">
			    <!-- Brand and toggle get grouped for better mobile display -->
			    <div class="navbar-header">
			      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
			        <span class="sr-only">Toggle navigation</span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			      </button>			     
			      <a class="navbar-brand" href="index.php"><span class="glyphicon glyphicon-home"></span></a>
			    </div>

			    <!-- Collect the nav links, forms, and other content for toggling -->
			    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			      <ul class="nav navbar-nav">
			        										
						<li class="dropdown">
					          <a href="index.php" class="dropdown-toggle" data-toggle="dropdown">Cửa hàng giày <span class="caret"></span></a>
					          <ul class="dropdown-menu" role="menu">
					          		<?php 
										include 'admin/database.php';
										$pdo = Database::connect();
										$sql = 'select * from sneakers LIMIT 10';
										foreach ($pdo ->query($sql) as $row) {
											echo '<li><a href="category.php?id_sneakers='.$row['id_sneakers'].'">'.$row['sneakers'].'</a></li>';
											echo '<li class="divider"></li>';
										}
									 ?>						  							 				            
            						
					          </ul>
					    </li>
						<li><a href="index.php">Giày HOT...</a></li>		
						<li><a href="index.php">Giày mới</a></li>					
			      </ul>			     
			      <ul class="nav navbar-nav navbar-right">
			  
			        <form action="search.php?keyword=" class="form_search" name="form_search" onsubmit="return validation();" method="get" role="search">
						<div class="right-inner-addon ">					   
						    <i type="submit" class="glyphicon glyphicon-search"></i>
						    <input name="keyword" type="search"
						           class="form-control" 
						           placeholder="Nhập sản phẩm cần tìm" />
						</div>
					</form>
				
			      </ul>
			    </div><!-- /.navbar-collapse -->
			  </div><!-- /.container-fluid -->
			</nav>

    