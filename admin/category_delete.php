<?php 
	require 'database.php';
	$id_sneakers = 0;
	
	if ( !empty($_GET['id_sneakers'])) {
		$id_sneakers = $_REQUEST['id_sneakers'];
	}
	
	if ( !empty($_POST)) {
		// keep track post values
		$id_sneakers = $_POST['id_sneakers'];
		
		// delete data
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "DELETE FROM sneakers  WHERE id_sneakers = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id_sneakers));
		Database::disconnect();
		header("Location: category.php");
		
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
    				<h3>XÓA THỂ LOẠI</h3>
    			</div>
				<div class="row">
					<form class="form-horizontal" action="category_delete.php" method="post">
	    			  <input type="hidden" name="id" value="<?php echo $id;?>"/>
					  <p class="alert alert-error">Bạn có chắc muốn xóa ?</p>
					  <div class="form-actions">
						  <button type="submit" class="btn btn-danger">Yes</button>
						  <a class="btn" href="category.php">No</a>
						</div>
					</form>
	    		</div>
    	</div>
    </section>
    <?php include"footer.php"; ?>
  </body>
</html>