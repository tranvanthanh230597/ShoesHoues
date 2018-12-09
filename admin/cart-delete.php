<?php 
	require 'database.php';
	$id_cart = 0;
	
	if ( !empty($_GET['id_cart'])) {
		$id_cart = $_REQUEST['id_cart'];
	}
	
	if ( !empty($_POST)) {
		// keep track post values
		$id_cart = $_POST['id_cart'];
		
		// delete data
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "DELETE FROM cart  WHERE id_cart = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id_cart));
		Database::disconnect();
		header("Location: cart.php");
		
	} 
?>

<?php 
    	include 'head.php';
     ?>
<body>
	<header>
        <div class="container">        	
	            <a href="#">
					<h1>QUẢN LÝ ĐƠN HÀNG</h1>
	            </a>	         
        </div>
    </header>
    <?php 
    	include 'menu.php';
     ?>
    <section>
    	<div class="container">
    			<div class="row">
    				<h3>XÓA ĐƠN HÀNG</h3>
    			</div>
				<div class="row">
					<form class="form-horizontal" action="cart-delete.php" method="post">
	    			  <input type="hidden" name="id_cart" value="<?php echo $id_cart;?>"/>
					  <p class="alert alert-error">Bạn có chắc muốn xóa ?</p>
					  <div class="form-actions">
						  <button type="submit" class="btn btn-danger">Yes</button>
						  <a class="btn" href="cart.php">No</a>
						</div>
					</form>
	    		</div>
    	</div>
    </section>
<?php include"footer.php"; ?>
  </body>
</html>