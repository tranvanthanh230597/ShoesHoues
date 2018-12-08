<?php 
	
	require 'database.php';

	$id_sneakers = null;
	$name = null;
	if ( !empty($_GET['id_sneakers'])) {
		$id_sneakers = $_REQUEST['id_sneakers'];
	}
	
	if ( null==$id_sneakers ) {
		header("Location: category.php");
	}
	if ( !empty($_POST)) {
		// keep track validation errors
		$sneakersError = null;
		
		// keep track post values
		
		$sneakers = $_POST['sneakers'];

		//var_dump($_POST); die();
				
		// validate input
		$valid = true;
		if (empty($sneakers)) {
			$sneakersError = 'Nhập tên hãng';
			$valid = false;
		}
		
		
		// cập nhật dữ liệu
		if ($valid) {			
			
				$pdo = Database::connect();
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql = "UPDATE sneakers  set sneakers = ? where id_sneakers=?";
				$q = $pdo->prepare($sql);
				$q->execute(array($sneakers,$id_sneakers));
				Database::disconnect();
				header("Location: category.php");
		}
	 else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT `id_sneakers`, `sneakers` FROM `sneakers` WHERE id_sneakers = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id_sneakers,$sneakers));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$id_sneakers = $data['id_sneakers'];
		$sneakers = $data['sneakers'];
		var_dump($data);
		Database::disconnect();
	}}
?>

<?php 
    	include 'head.php';
     ?>
<body>
	<header>
        <div class="container">        	
	            <a href="#">
					<h1>QUẢN LÝ SẢN PHẨM</h1>
	            </a>	         
        </div>
    </header>
    <?php 
    	include 'menu.php';
     ?>
    <section>
    	<div class="container">
    			<div class="row">
    				<h3>CHỈNH SỬA HÃNG</h3>
    			</div>
				<div class="row">
					<div class="col-xs-12 col-md-8">
		    			<form class="form-horizontal" role="form" action="category_update.php?id_sneakers=<?php echo $id_sneakers ?>" enctype="multipart/form-data" method="post">						 
							  <div class="form-group">
							    <label for="inputEmail3" class="col-sm-2 control-label">Tên hãng:</label>
							    <div class="col-sm-10">
							      	<input  type="text" class="form-control" name="sneakers" id="inputEmail3" placeholder="" value="<?php echo $id_sneakers; ?>">
						      		</input>
							    </div>
							  </div>
							 
							  <div class="form-group">
							    <div class="col-sm-offset-2 col-sm-10">
							      	<button type="submit" class="btn btn-success">Cập nhật</button>
					  				<a class="btn" href="category.php">Quay lại</a>
							    </div>
							  </div>
						</form>
					</div>
	    		</div>
    	</div>
		
    </section>
    <?php include"footer.php"; ?>
</body>
</html>