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
    		<div class="row header1">
			  	<h3>Kết quả tìm kiếm</h3>
			</div>			
			
			<div class="row">
				<table class="table table-striped table-bordered">
		              <thead>
		                <tr>
		                  <th>Mã Giày</th>
		                  <th>Tên Giày</th>
		                  <th>Hình ảnh</th>
		                  <th>Hãng</th>
		                  <th>Giá ($)</th>	
		                  <th>Giá khuyến mãi ($)</th>	                  
		                  <th>Thao tác</th>
		                </tr>
		              </thead>
		              <tbody>
		              <?php 
		              	$keyword = $_POST['keyword'];
		              	if ($keyword != null)
		              	{		              				              
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
			              	$sql1 = 'select * from shoes where shoes_name like "%'.$keyword.'%"';
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
		              			             
			              	$sql = 'select shoes.*, sneakers.sneakers from shoes,sneakers  where shoes.id_sneakers = sneakers.id_sneakers and shoes_name like "%'.$keyword.'%" ORDER BY id_shoes DESC limit '.$vitri.', 5';
			              	foreach ($pdo->query($sql) as $row) {
			              		echo '<tr class="success">';
			              			echo '<td>'.$row['id_shoes'].'</td>';
			              			echo '<td>'.$row['shoes_name'].'</td>';
			              			echo  '<td>';
			              			echo '<img src="../images/products/'.$row['image'].'" class="img-responsive image_product"  alt="image product">';
			              			echo '</td>';
			              			echo '<td>'.$row['sneakers'].'</td>';		              			
			              			echo '<td style="text-align: right;">'.number_format($row['price']).'</td>';
			              			echo '<td style="text-align: right;">'.number_format($row['sale_price']).'</td>';
			              			echo '<td width=250>';
			              			echo '<a class="btn btn-info" href="detail.php?id_shoes='.$row["id_shoes"].'">Xem chi tiết</a>';
			              			echo '&nbsp;';
			              			echo '<a class="btn btn-success" href="update.php?id_shoes='.$row["id_shoes"].'">Sửa</a>';
			              			echo '&nbsp;';
			              			echo '<a class="btn btn-danger" href="delete.php?id_shoes='.$row["id_shoes"].'">Xóa</a>';
			              			echo '</td>';
			              		echo '</tr>';
			              	}
			              	Database::disconnect();	
			            }
			            else
			            {
			            	header("Location: product.php");
			            }
		               ?>
		              </tbody>
	            </table>
	            <?php 
	            	if($page>1){echo '<a class="btn btn-success" href="search.php?page='.($page-1).'">Trang trước</a>';}
	            	echo '&nbsp;';
					for ($i=1 ; $i<=$pagenumber ; $i++) {
						if ($i == $page) {
						       echo $i;
						       echo '&nbsp;';
						} 
						else {
						      echo '<a class="btn btn-info" href="search.php?page='.$i.'">'.$i.'</a>';
						      echo '&nbsp;';
						}
					}
					if($page<$pagenumber){echo '<a class="btn btn-success" href="search.php?page='.($page+1).'"">Trang sau</a>';}
				?>
				<a class="btn" href="product.php">Quay lại</a>
			</div>
    	</div>
    </section>
    <?php include"footer.php"; ?>
</body>
</html>