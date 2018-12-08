<?php 
	
	require 'database.php';

	if ( !empty($_POST)) {
		// keep track validation errors
		$shoes_nameError = null;
		$NameCategoryError = null;
		$sneakersError = null;
		$PriceError = null;
		$ImageError = null;
		
		// keep track post values
		$shoes_name = $_POST['shoes_name'];
		$sneakers = $_POST['sneakers'];
		$price = $_POST['price'];	
		$description = $_POST['description'];	
		$sale_price = $_POST['sale_price'];
		// validate input
		$valid = true;
		if (empty($shoes_name)) {
			$shoes_nameError = 'Nhập tên giày';
			$valid = false;
		}
		if (empty($sneakers)) {
			$sneakersError = 'Nhập hãng';
			$valid = false;
		}

		if (empty($description)) {
			$NameCategoryError = 'Nhập chủ đề sản phẩm';
			$valid = false;
		}
		if (empty($price)) {
			$PriceError = 'Nhập giá sản phẩm';
			$valid = false;
		}
		// Kiểm tra hình ảnh
		if($_FILES['file']['name'] != NULL){ // Đã chọn file
	        // Tiến hành code upload file
	        if($_FILES['file']['type'] == "image/jpeg"
	        || $_FILES['file']['type'] == "image/png"
	        || $_FILES['file']['type'] == "image/gif"){
	        // là file ảnh
	        // Tiến hành code upload    
	            if($_FILES['file']['size'] > 1048576){
	                $ImageError = 'File không được lớn hơn 1MB';
					$valid = false;
	            }
	            else{
	                // file hợp lệ, tiến hành upload
	                $path = "../images/products/"; // file sẽ lưu vào thư mục data
	                $tmp_name = $_FILES['file']['tmp_name'];
	                $name = $_FILES['file']['name'];
	                $type = $_FILES['file']['type']; 
	                $size = $_FILES['file']['size']; 
	                // Upload file
	                if ($valid){
	                	move_uploaded_file($tmp_name,$path.$name);	
	                }                
	           }
	        }
	        else{
	           // không phải file ảnh
	           	$ImageError = 'Định dạng file không hợp lệ';
				$valid = false;
	        }
	   	}
	   	else{
	        $ImageError = 'Vui lòng chọn hình ảnh cho sản phẩm';
			$valid = false;
	   	}
		// insert data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO shoes (shoes_name,id_sneakers,price,image, description,sale_price) values(?, ?, ?, ?,?,?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($shoes_name,$sneakers,$price,$name,$description,$sale_price));
			Database::disconnect();
			header("Location: product.php");
		}
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
    				<h3>THÊM SẢN PHẨM MỚI</h3>
    			</div>
				<div class="row">
	    			<form class="form-horizontal" role="form" action="product-add.php" enctype="multipart/form-data" method="post">						 
						  <div class="form-group">
						    <label for="inputEmail3" class="col-sm-2 control-label">Tên giày (*)</label>
						    <div class="col-sm-10">
						      	<input type="text" class="form-control" name="shoes_name" id="inputEmail3" placeholder="Tên Giày">
						      	<?php if (!empty($shoes_nameError)): ?>
					      			<span class="help-inline"><?php echo $Nameshoesname_Error;?></span>
					      		<?php endif; ?>
						    </div>
						  </div>
						  <div class="form-group">
						    <label for="inputEmail3" class="col-sm-2 control-label">Mô tả</label>
						    <div class="col-sm-10">
						      	<textarea name="description" class="form-control" placeholder="Nhập mô tả" rows="3"></textarea>						      						      
						    </div>
						  </div>
						   <div class="form-group">
						    <label for="inputEmail3" class="col-sm-2 control-label">Tên hãng (*)</label>
						    <div class="col-sm-10">
						      	<select name="sneakers" class="form-control">
							      	<?php 							      		
			              				$pdo = Database::connect();
			              				$sql = 'SELECT * FROM sneakers';
			              				foreach ($pdo->query($sql) as $row) {			              							              		
			              					echo '<option value="'.$row["id_sneakers"].'">'.$row["sneakers"].'</option>';
			              				}
			              				Database::disconnect();	
							      	 ?>
						      	 </select>
						    </div>
						  </div>
						  <div class="form-group">
						    <label for="inputEmail3" class="col-sm-2 control-label">Giá (*)</label>
						    <div class="col-sm-10">
						      	<input type="text" class="form-control" name="price" id="inputEmail3" placeholder="Giá sản phẩm">
						      	<?php if (!empty($PriceError)): ?>
					      			<span class="help-inline"><?php echo $PriceError;?></span>
					      		<?php endif; ?>
						    </div>
						  </div>
						  <div class="form-group">
						    <label for="inputEmail3" class="col-sm-2 control-label">Giá khuyến mãi</label>
						    <div class="col-sm-10">
						      	<input type="text" class="form-control" name="sale_price" id="inputEmail3" placeholder="Giá khuyến mãi">						      	
						    </div>
						  </div>
						  <div class="form-group">
						    <label for="inputEmail3" class="col-sm-2 control-label">Chọn hình ảnh (*)</label>
						    <div class="col-sm-10">
						      	<input type="file" name="file" id="exampleInputFile">
						      	<?php if (!empty($ImageError)): ?>
					      			<span class="help-inline"><?php echo $ImageError;?></span>
					      		<?php endif; ?>    							
						    </div>
						  </div>
						  <div class="form-group">
						    <div class="col-sm-offset-2 col-sm-10">
						      	<button type="submit" class="btn btn-success">Thêm</button>
				  				<a class="btn" href="product.php">Quay lại</a>
						    </div>
						  </div>
					</form>
	    		</div>
    	</div>
    </section>
    <?php include"footer.php"; ?>
</body>
</html>