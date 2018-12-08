<?php 
	
	require 'database.php';

	if ( !empty($_POST)) {
		// keep track validation errors
		$sneakersError = null;	
		
		// keep track post values
		$sneakers = $_POST['sneakers'];
			
		// validate input
		$valid = true;
		if (empty($sneakers)) {
			$sneakersError = 'Nhập tên Hãng';
			$valid = false;
		}			
		
		// insert data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO sneakers (sneakers) values( ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($sneakers));
			Database::disconnect();
			header("Location: category.php");
		}
	}
?>
<?php 
    	include 'head.php';
     ?>

<body>
	<header>
        <div class="container">        	
	            <a href="#">
					<h1>QUẢN LÝ HÃNG</h1>
	            </a>	         
        </div>
    </header>
    <?php 
    	include 'menu.php';
     ?>
    <section>
    	<div class="container">
    			<div class="row">
    				<h3>THÊM HÃNG MỚI</h3>
    			</div>
				<div class="row">
	    			<form class="form-horizontal" role="form" action="category-add.php" method="post">						 
						  <div class="form-group">
						    <label for="inputEmail3" class="col-sm-2 control-label">Tên Hãng(*)</label>
						    <div class="col-sm-10">
						      	<input type="text" class="form-control" name="sneakers" id="inputEmail3" placeholder="Tên Hãng">
						      	<?php if (!empty($sneakersError)): ?>
					      			<span class="help-inline"><?php echo $sneakersError;?></span>
					      		<?php endif; ?>
						    </div>
						  </div>
						  
						  <div class="form-group">
						    <div class="col-sm-offset-2 col-sm-10">
						      	<button type="submit" class="btn btn-success">Thêm</button>
				  				<a class="btn" href="category.php">Quay lại</a>
						    </div>
						  </div>
					</form>
	    		</div>
    	</div>
    </section>
</body>
</html>