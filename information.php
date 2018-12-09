<?php 
if ( !empty($_POST)) {
	require'admin/database.php';
		// keep track validation errors
		$nameError = null;
		$phoneError = null;
		$addressError = null;
		$id_shoesError = null;
		$totalError = null;
		$trangthaiError = null;
		
		// keep track post values
		$name = $_POST['name'];
		$phone = $_POST['phone'];
		$address = $_POST['address'];
		$id_shoes = $_POST['id_shoes'];
		$quantity = $_POST['quantity'];
		$total = $_POST['total'];
		$trangthai = 'Chua duyet';
		// validate input
		$valid = true;
		if (empty($name)) {
			$nameError = 'Nhập tên khách hàng';
			$valid = false;
		}
		if (empty($phone)) {
			$phoneError = 'Nhập SDT';
			$valid = false;
		}

		if (empty($address)) {
			$addressError = 'Nhập địa chỉ';
			$valid = false;
		}
		if (empty($id_shoes)) {
			$id_shoesError = 'Nhập giá sản phẩm';
			$valid = false;
		}
		if (empty($total)) {
			$totalError = 'Nhập giá sản phẩm';
			$valid = false;
		}
		// insert data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO cart (id_shoes,quantity,total,name,phone,address,trangthai) values( ? , ?, ?, ?, ? , ?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($id_shoes,$quantity,$total,$name,$phone,$address,$trangthai));
			Database::disconnect();
			header("Location: information.php");
		}
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
					<div class="panel-heading">NHẬP THÔNG TIN ĐẶT HÀNG</div>
					<div class="row product_detail">
						<div class="col-xs-12 col-md-12">
							Quý khách Đã thực hiện đặt hàng thành công.
						</div>
					</div>
				</div>
					
			  </div>
           </div>

        </div>
    </section>
	<?php include'bottom.php' ?>