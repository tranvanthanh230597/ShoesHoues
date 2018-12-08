<?php 
	require 'database.php';
	$id_shoes = 0;
	
	if ( !empty($_GET['id_shoes'])) {
		$id_shoes = $_REQUEST['id_shoes'];
	}
	
	if ( !empty($_POST)) {
		// keep track post values
		$id_shoes = $_POST['id_shoes'];
		
		// delete data
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "DELETE FROM shoes  WHERE id_shoes = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id_shoes));
		Database::disconnect();
		header("Location: product.php");
		
	} 
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
    				<h3>XÓA SẢN PHẨM</h3>
    			</div>
				<div class="row">
					<form class="form-horizontal" action="delete.php" method="post">
	    			  <input type="hidden" name="id_shoes" value="<?php echo $id_shoes;?>"/>
					  <p class="alert alert-error">Bạn có chắc muốn xóa ?</p>
					  <div class="form-actions">
						  <button type="submit" class="btn btn-danger">Yes</button>
						  <a class="btn" href="product.php">No</a>
						</div>
					</form>
	    		</div>
    	</div>
    </section>
<?php include"footer.php"; ?>
  </body>
</html>