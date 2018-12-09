<?php include'head.php' ?>
<?php 
	//require 'admin/database.php';
	$id_shoes = null;
	if ( !empty($_GET['id_shoes'])) {
		$id_shoes = $_REQUEST['id_shoes'];
	}
	
	if ( null==$id_shoes || !(is_numeric($id_shoes))) {
		header("Location: index.php");
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "select shoes.*,sneakers.sneakers as namesneakers, sneakers.id_sneakers from shoes,sneakers where sneakers.id_sneakers = sneakers.id_sneakers and id_shoes = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id_shoes));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		Database::disconnect();
	}
?>

    
    <section>
        <div class="container">
           <div class="row">
              <div class="col-xs-12 col-md-3">
					<div class="panel panel-primary">
						<div class="panel-heading">Danh mục sản phẩm</div>
						<ul class="nav nav-pills nav-stacked">
							  
							 <?php 
							include 'menu_left.php';
							
						 ?>		
						</ul>
					</div>
					<div class="promotion">
						<a href=""><img class="img-responsive" src="images/quangcao1.jpg" alt="Quang cao 1"/></a>
						<a href=""><img class="img-responsive" src="images/quangcao2.png" alt="Quang cao 1"/></a>
					</div>
                    
              </div>
              <div class="col-xs-12 col-md-9">
				<div class="panel panel-primary panel-product ">
					<div class="panel-heading">THÔNG TIN GIÀY</div>
					<div class="row product_detail">
						<div class="col-xs-12 col-md-4">
							<img src="images/products/<?php echo $data['image']; ?>" class="img-responsive image_detail"   alt="<?php echo $data['shoes_name']; ?>">
						</div>
						<div class="col-xs-12 col-md-8">
						<ul class="information">						
							<li><h1 class="title"><?php echo $data['shoes_name'];?></h1></li>
							<li>Loại giày:<span class="name"> <?php echo $data['namesneakers'];?></span></li>
							<?php 
								if($data['sale_price']!=null)
								{
									echo '<li>Giá bán: ';
									echo '<span class="name price">'.number_format($data['sale_price']).'$</span>';
									echo '</li>';
									echo '<li>';
									echo 'Giá bìa: <span class="name price_promotion">'.number_format($data['price']).'$</span>';
									echo '</li>';
								}
								else
								{
									echo '<li>Giá bán: <span class="name price"> '.number_format($data['price']).'$</span></li>';	
								}
							 ?>							
							<li>Thông tin giày: <span class="description">
								<?php 
									if($data['description']!=null) {
										echo $data['description'];
									}
									else{
										echo "Đang cập nhật";
									}
									?>
								</span></li>
							<li><a href="cart.php?id=<?php echo $data['id_shoes'];?>" class="btn btn-success">Thêm vào giỏ hàng</a></li>							
						</ul>
						</div>
								
					
					</div>
				</div>
					<div class="panel panel-primary panel-product">
						<div class="panel-heading">Giày cùng hãng</div>
						<div class="row">
						
							<ul class="nav nav-pills nav-stacked">
								<?php 				
										$pdo = Database::connect();			
										$sql = 'select * from shoes,sneakers where shoes.id_sneakers='.$data['id_sneakers'].' ORDER BY id_shoes DESC LIMIT 4';
										foreach ($pdo ->query($sql) as $row) {
											echo '<div class="col-xs-6 col-md-3 products">';
											echo '<a href="#" title="'.$row['shoes_name'].'">';
											echo '<img class="img-responsive product" src="images/products/'.$row['image'].'" alt="'.$row['shoes_name'].'"/>';
											echo '</a>';
											echo '<a href="#"class="title_product">';
											if (strlen($row['shoes_name'])<30)
											{
												echo $row['shoes_name'];
											}
											else
											{
												echo substr($row['shoes_name'], 0, 30).'...';
											}
											
											echo '</a>	<br/>';
											echo '<div id="price">';
											if ($row['sale_price']!=null)
											{
												echo '<span class="price_product">'.number_format($row['sale_price']).'$</span>';
												echo '<span class="price_product_right">'.number_format($row['price']).'$</span>';
												echo '</div>';
												echo '<div id="product_footer">';
												echo '<img class="img-responsive hot" src="images/icon/hot-icon.gif" alt="book online deal">';
											}
											else
											{
												echo '<span class="price_product">'.number_format($row['price']).'$</span>';
												echo '</div>';
												echo '<div id="product_footer">';
											}
											echo '<a class="btn btn-success btn-xs add_cart" href="#" role="button">Đặt hàng</a>';
											echo '</div>';
											echo '</div>';
										}
								?>
							</ul>
						</div>
					</div>
					
			  </div>
           </div>

        </div>
    </section>
	<?php include'bottom.php' ?>