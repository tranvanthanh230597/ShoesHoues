<?php include'head.php' ?>
    <section>
        <div class="container">
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                  <ol class="carousel-indicators">
                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                  </ol>
                
                  <!-- Wrapper for slides -->
                  <div class="carousel-inner">
                    <div class="item active">
                      <img class="img-responsive" src="images/slide/slide1.jpg"  alt="slide1"/>
                      <div class="carousel-caption">
                       
                      </div>
                    </div>
                    <div class="item">
                      <img class="img-responsive" src="images/slide/slide2.jpg" alt="slide2"/>
                      <div class="carousel-caption">
                       
                      </div>
                    </div>
                    <div class="item">
                      <img class="img-responsive" src="images/slide/slide3.jpg" alt="slide3"/>
                      <div class="carousel-caption">
                        
                      </div>
                    </div>
                  </div>
                
                  <!-- Controls -->
                  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                  </a>
                  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                  </a>
                </div>
        </div>
    </section>


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
					<div class="panel-heading">Giày HOT...</div>
					<div class="row">
						<?php 
							$pdo = Database::connect();
							$sql = 'select * from shoes LIMIT 8';
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
								echo '<a class="btn btn-success btn-xs add_cart" href="cart.php?id='.$row['id_shoes'].'" role="button">Đặt hàng</a>';
								echo '</div>';
								echo '</div>';
							}
						?>		
					
					</div>
				</div>
					<div class="panel panel-primary panel-product">
						<div class="panel-heading">Giày mới...</div>
						<div class="row">
						
							<ul class="nav nav-pills nav-stacked">
								<?php 							
										$sql = 'select * from shoes ORDER BY id_shoes DESC LIMIT 8';
										foreach ($pdo ->query($sql) as $row) {
											echo '<div class="col-xs-6 col-md-3 products">';
											echo '<a href="product.php?id_shoes='.$row['id_shoes'].'" title="'.$row['shoes_name'].'">';
											echo '<img class="img-responsive product" src="images/products/'.$row['image'].'" alt="'.$row['shoes_name'].'"/>';
											echo '</a>';
											echo '<a href="product.php?id_shoes='.$row['id_shoes'].'" title="'.$row['shoes_name'].'">';
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
											echo '<a class="btn btn-success btn-xs add_cart" href="cart.php?id='.$row['id_shoes'].'" role="button">Đặt hàng</a>';
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