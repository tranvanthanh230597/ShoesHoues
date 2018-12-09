<?php 	
	// Thêm giỏ hàng
	@session_start();
	if (isset($_GET['id'])){
		$id = $_GET['id'];
		if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])){
			$count = count($_SESSION['cart']);
			$flag = false;
			for ($i = 0; $i < $count; $i++){
				if($_SESSION['cart'][$i]['id']==$id){
					$_SESSION['cart'][$i]['number']+=1;
					$flag = true;
					break;
				}
			}
			if($flag == false){
				$_SESSION['cart'][$count]['id'] = $id;
				$_SESSION['cart'][$count]['number'] = 1;
			}
		}
		else
		{
			$_SESSION['cart'] = array();
			$_SESSION['cart'][0]['id'] = $id;
			$_SESSION['cart'][0]['number'] = 1;
		}
	}
	//Xóa giỏ hàng
	if(isset($_GET['del'])){
		$del = $_GET['del'];
		if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])){			
			for ($i = 0; $i < count($_SESSION['cart']); $i++){
				if($_SESSION['cart'][$i]['id']==$del){
					unset($_SESSION['cart'][$i]);				
					break;
				}
			}			
		}
	
	}
	// Cập nhật giỏ hàng
	if(isset($_POST['submit']))
	{
	 foreach($_POST['qty'] as $key=>$value)
	 {
	  if(($value == 0) and (is_numeric($value)))
	  {
	   unset ($_SESSION['cart'][$key]);
	  }
	  elseif(($value > 0) and (is_numeric($value)))
	  {
	   $_SESSION['cart'][$key]['number']=$value;
	  }
	 }
	 header("location:cart.php");
	}
	
?> 
<?php include'head.php' ?>   
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
					<div class="panel-heading">GIỎ HÀNG CỦA BẠN</div>
					<div class="row product_detail">
						<div class="col-xs-12 col-md-12">
							<h5 style="float:left">Bạn có 
							<?php 
							$sosanpham = 0;		              
		                	if(isset($_SESSION['cart']))
		                		{
		                			$sosanpham = count($_SESSION['cart']);
		                			echo $sosanpham;		                			
		                		}
		                	else 
		                		{
		                			echo '0';
		                		} 
		                	?> sản phẩm trong giỏ hàng</h5>
		                	<form action="cart.php" method="post">
		                		<?php 
								if ($sosanpham!=0) {
																
							 	?>
								<table class="table table-striped table-bordered">
					              <thead>
					                <tr>
					                  <th>Hình ảnh</th>
					                  <th>Tên sản phẩm</th>
					                  <th>Giá</th>
					                  <th>Số lượng</th>
					                  <th>Tổng cộng</th>			                 
					                </tr>
					              </thead>
					              <tbody>
					              <?php
					              	//require 'admin/database.php';
					              	$pdo = Database::connect();	
					              	$total = 0;
					              	for ($i = 0; $i < count($_SESSION['cart']); $i++){						              		          		              			            
							              	$sql = 'select * from shoes  where id_shoes ='.$_SESSION['cart'][$i]['id'];
							              	foreach ($pdo->query($sql) as $row){
							              		echo '<tr class="warning">';
							              			echo  '<td>';
							              			echo '<img src="images/products/'.$row['image'].'" class="img-responsive image_product"  alt="image product">';
							              			echo '</td>';		              			
							              			echo '<td>'.$row['shoes_name'];
							              			echo '<br>';
							              			echo '<a class="btn" href="cart.php?del='.$row["id_shoes"].'">Xóa</a>';
							              			echo '</td>';		              			
							              			echo '<td style="text-align: right;">'.$row['sale_price'].'$</td>';		              					              	
							              			echo '<td width="100px">';
							              			echo '<input type="text" name="qty['.$i.']" class="form-control" value="'.$_SESSION['cart'][$i]['number'].'">';
							              			echo '</td>';	
							              			echo '<td>';
							              			$quantity=  $_SESSION['cart'][$i]['number'];
							              			$id_shoes  = $_SESSION['cart'][$i]['id'];
							              			$money = $row['sale_price']* $_SESSION['cart'][$i]['number'];
							              			$total +=$money;
							              			echo ($money);
							              			echo '$</td>';		              			
							              		echo '</tr>';
							              	}
							            
					              	}
					              	Database::disconnect();	
					               ?>
					              </tbody>
				            </table>
						</div>						
						<div class="col-xs-12 col-md-12">
							<input type='submit' class="btn btn-success btn_left" name='submit' value='Cập nhật giỏ hàng' />							
							<div class="info_right">
								Tổng tiền: <span class="price info_right"><?php echo ($total);  ?>$</span><br>
								Tổng thanh toán: <span class="price info_right"><?php echo ($total);  ?>$</span> <br>
								(Đã gồm VAT)
							</div>
						</div>						
						</form>
						<form action="information.php" method="post">
						  <div class="form-group">
						    <label for="exampleInputEmail1">Họ Và Tên(*)</label>
						    <input type="text" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Họ và Tên" name="name">
						    <?php if (!empty($nameError)): ?>
					      			<span class="help-inline"><?php echo $nameError;?></span>
					      		<?php endif; ?>
						    <small id="emailHelp" class="form-text text-muted">We'll never share your name with anyone else.</small>
						  </div>
						  <div class="form-group">
						    <label for="exampleInputPassword1">Số điện thoại(*)</label>
						    <input type="text" class="form-control" id="phone" placeholder="SDT" name="phone">
						    <?php if (!empty($phoneError)): ?>
					      			<span class="help-inline"><?php echo $phoneError;?></span>
					      		<?php endif; ?>
						  </div>
						  <div class="form-group">
						    <label for="exampleInputPassword1">Địa chỉ(*)</label>
						    <input type="text" class="form-control" id="address" placeholder="Address" name="address">
						    <?php if (!empty($addressError)): ?>
					      			<span class="help-inline"><?php echo $addressError;?></span>
					      		<?php endif; ?>
						  </div>

						  <div class="form-group">
						    <input type="hidden" class="form-control" id="id_shoes" placeholder="id_shoes" name="id_shoes" value="<?php echo ($id_shoes); ?>">
						    <input type="hidden" class="form-control" id="quantity" placeholder="quantity" name="quantity" value="<?php echo ($quantity); ?>">
						    <input type="hidden" class="form-control" id="total" placeholder="total" name="total" value="<?php echo ($total); ?>">
						  </div>
							<a href=""></a>
						  <button type="submit" class="btn btn-lg btn-warning btn_left"">Đặt hàng</button>
						</form>
						
							<?php } ?>
						<?php 
							if ($sosanpham==0) {
								echo '<br>';
								echo '<br>';
								echo '<a href="index.php" class="btn btn-lg btn-warning btn_left">Quay lại cửa hàng</a>';
							}
															
						 	?>
					</div>
				</div>
					
			  </div>
           </div>

        </div>
    </section>
<?php include'bottom.php' ?>