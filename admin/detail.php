<?php 
	require 'database.php';
	$id_shoes = null;
	if ( !empty($_GET['id_shoes'])) {
		$id_shoes = $_REQUEST['id_shoes'];
	}
	
	if ( null==$id_shoes || !(is_numeric($id_shoes))) {
		header("Location: product.php");
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "select shoes.*, sneakers.sneakers from shoes,sneakers where shoes.id_sneakers = sneakers.id_sneakers and id_shoes = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id_shoes));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		Database::disconnect();
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
    				<h3>CHI TIẾT SẢN PHẨM</h3>
    			</div>
				<div class="row">
					<div class="col-xs-12 col-md-8">						
			    			<form class="form-horizontal">		
				    			  <div class="form-group">
								    <label for="inputEmail3" class="col-sm-2 control-label">Mã sản phẩm</label>
								    <div class="col-sm-10">
								      	<?php echo $data['id_shoes'];?>						
								    </div>
								  </div>				 		    				
								  <div class="form-group">
								    <label for="inputEmail3" class="col-sm-2 control-label">Tên Giày</label>
								    <div class="col-sm-10">
								      	<?php echo $data['shoes_name'];?>
								    </div>
								  </div>
								   <div class="form-group">
								    <label for="inputEmail3" class="col-sm-2 control-label">Tên hãng</label>
								    <div class="col-sm-10">
								      	<?php echo $data['sneakers'];?>
								    </div>
								  </div>
								  <div class="form-group">
								    <label for="inputEmail3" class="col-sm-2 control-label">Giá</label>
								    <div class="col-sm-10">
								      	<?php echo number_format($data['price']);?> $
								    </div>
								  </div>
								  <div class="form-group">
								    <label for="inputEmail3" class="col-sm-2 control-label">Giá sale off</label>
								    <div class="col-sm-10">
								      	<?php echo number_format($data['sale_price']);?> $
								    </div>
								  </div>
								  <div class="form-group">
								    <label for="inputEmail3" class="col-sm-2 control-label">Mô tả</label>
								    <div class="col-sm-10">
								      	<?php echo $data['description'];?>						
								    </div>
								  </div>							  
								  <div class="form-group">
								    <div class="col-sm-offset-2 col-sm-10">							      	
						  				<a class="btn" href="product.php">Quay lại</a>
								    </div>
								  </div>
								  
							</form>
					</div>
					<div class="col-xs-12 col-md-4">
						<?php if ($data['image']!=null): ?>							
							<img src="../images/products/<?php echo $data['image'];?>" width="444px" height="308px">
						<?php endif; ?>						
					</div>
	    		</div>
    	</div>
    </section>
    <?php include 'footer.php' ?>
</body>
</html>