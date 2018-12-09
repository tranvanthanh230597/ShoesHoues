<?php include'head.php' ?>
<?php 	
	if ( !empty($_GET['keyword'])) {
		$keyword = $_GET['keyword'];
	}	
	else {
		header("Location: index.php");
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
				<div class="panel panel-primary panel-product">
				<div class="panel-heading">Kết quả tìm kiếm</div>
							
							<div class="row">
							<?php 
							$pdo = Database::connect();	
						
							if (!isset($_GET['page'])) {
							$page = 1;
							}
							else
							{
								$page = $_REQUEST['page'];
							}
							$n = 4; //number product on a page
							$vitri = ($page - 1) * $n;	
			              	$sql1 = 'select * from shoes where shoes_name like "%'.$keyword.'%"';
			              	if($result = $pdo->query($sql1))
							{
							    //đếm số trang lấy được
							    $recordnumber = $result->rowCount();
							    if ($recordnumber%$n ==0)
							    {
							    	$pagenumber = $recordnumber/$n;
							    }	
							    else{
							    	$pagenumber = floor($recordnumber/$n) + 1;								    		 	
							    }
							    
							}							
							$sql = 'select * from shoes where shoes_name like "%'.$keyword.'%" ORDER BY id_shoes DESC limit '.$vitri.','.$n;
							if($result1 = $pdo->query($sql))
							{
							    //đếm số trang lấy được
							    $recordnumber = $result1->rowCount();
							    if ($recordnumber ==0)
							    {
							    	echo '<h5>Không có sản phẩm nào được tìm thấy với từ khóa "<span style="color: red">'.$keyword.'</span>"</h5>';
							    }
							}	
							foreach ($pdo ->query($sql) as $row) {
								echo '<div class="col-xs-6 col-md-3 products">';
								echo '<a href="product.php?id_shoes='.$row['id_shoes'].'" title="'.$row['shoes_name'].'">';
								echo '<img class="img-responsive product" src="images/products/'.$row['image'].'" alt="'.$row['shoes_name'].'"/>';
								echo '</a>';
								echo '<a href="product.php?id_shoes='.$row['id_shoes'].'"class="title_product">';
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
								if ($row['sale_price']!=null && $row['sale_price']!=0)
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
								echo '<a class="btn btn-success btn-xs add_cart" href="cart.php?id_shoes='.$row['id_shoes'].'" role="button">Đặt hàng</a>';
								echo '</div>';
								echo '</div>';
							}
							Database::disconnect();	
						?>

								
					
					</div>
					
				</div>
					
				<?php 
		            	if($page>1){echo '<a class="btn btn-success" href="search.php?keyword='.$keyword.'&&page='.($page-1).'">Trang trước</a>';}
		            	echo '&nbsp;';
						for ($i=1 ; $i<=$pagenumber ; $i++) {
							if ($i == $page) {
							       echo $i;
							       echo '&nbsp;';
							} 
							else {
							      echo '<a class="btn btn-info" href="search.php?keyword='.$keyword.'&&page='.$i.'">'.$i.'</a>';
							      echo '&nbsp;';
							}
						}
						if($page<$pagenumber){echo '<a class="btn btn-success" href="search.php?keyword='.$keyword.'&&page='.($page+1).'"">Trang sau</a>';}
					?>	
			  </div>
           </div>

        </div>
    </section>
	<?php include'bottom.php' ?>