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
    		<div class="row header1">
			  	<form action="search.php" method="post" name="form_search" onsubmit="return validation();">
				  	<div class="col-xs-6 col-md-4">
				  		<input name="keyword" type="text" class="form-control" id="exampleInputPassword1" placeholder="Nhập tên sản phẩm cần tìm">
				  	</div>
				  	<div class="col-xs-6 col-md-2">
				  		<p>							
							<button type="submit" class="btn btn-success">Tìm kiếm</button>
						</p>
				  	</div>
			  	</form>
			</div>			
			
			<div class="row">
				<table class="table table-striped table-bordered">
		              <thead>
		                <tr>
		                  <th>Mã Đơn hàng</th>
		                  <th>Tên Giày</th>
		                  <th>Số lượng</th>
		                  <th>Tổng giá</th>
		                  <th>Tên khách hàng</th>	
		                  <th>Số điện thoại</th>	                  
		                  <th>Địa chỉ</th>
		                  <th>Trạng thái</th>
		                  <th>thao tác</th>
		                </tr>
		              </thead>
		              <tbody>
		              <?php 
		              	include 'database.php';
		              	if (!isset($_GET['page'])) {
							$page = 1;
						}
						else
						{
							$page = $_REQUEST['page'];
						}
						$vitri = ($page - 1) * 5;
		              	$pdo = Database::connect();	
		              	$sql1 = 'select * from shoes';
		              	if($result = $pdo->query($sql1))
						{
						    //đếm số trang lấy được
						    $recordnumber = $result->rowCount();
						    if ($recordnumber%5 ==0)
						    {
						    	$pagenumber = $recordnumber/5;
						    }	
						    else{
						    	$pagenumber = floor($recordnumber/5) + 1;								    		 	
						    }
						    
						}
	              			             
		              	$sql = 'select cart.*, shoes.shoes_name from shoes,cart  where shoes.id_shoes = cart.id_shoes ORDER BY id_shoes DESC limit '.$vitri.', 5';
		              	foreach ($pdo->query($sql) as $row) {
		              		echo '<tr class="success">';
		              			echo '<td>'.$row['id_cart'].'</td>';
		              			echo '<td>'.$row['shoes_name'].'</td>';
		              			echo '<td>'.$row['quantity'].'</td>';		              			
		              			echo '<td>'.$row['total'].'</td>';		              			
		              			echo '<td>'.$row['name'].'</td>';		              			
		              			echo '<td>'.$row['phone'].'</td>';		              			
		              			echo '<td>'.$row['address'].'</td>';		              			
		              			echo '<td>'.$row['trangthai'].'</td>';		              			
		              			echo '<td width=250>';
		              			echo '<a class="btn btn-success" href="cart-update.php?id_cart='.$row["id_cart"].'">Duyệt</a>';
		              			echo '&nbsp;';
		              			echo '<a class="btn btn-danger" href="cart-delete.php?id_cart='.$row["id_cart"].'">Xóa</a>';
		              			echo '</td>';
		              		echo '</tr>';
		              	}
		              	Database::disconnect();	
		               ?>
		              </tbody>
	            </table>
	            <?php 
	            	if($page>1){echo '<a class="btn btn-success" href="cart.php?page='.($page-1).'">Trang trước</a>';}
	            	echo '&nbsp;';
					for ($i=1 ; $i<=$pagenumber ; $i++) {
						if ($i == $page) {
						       echo $i;
						       echo '&nbsp;';
						} 
						else {
						      echo '<a class="btn btn-info" href="cart.php?page='.$i.'">'.$i.'</a>';
						      echo '&nbsp;';
						}
					}
					if($page<$pagenumber){echo '<a class="btn btn-success" href="cart.php?page='.($page+1).'"">Trang sau</a>';}
				?>

			</div>
    	</div>
    </section>
    <?php include"footer.php"; ?>
</body>
</html>