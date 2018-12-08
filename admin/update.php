<?php 
	
	require 'database.php';

	$id_shoes = null;
	$name = null;
	if ( !empty($_GET['id_shoes'])) {
		$id_shoes = $_REQUEST['id_shoes'];
	}
	
	if ( null==$id_shoes ) {
		header("Location: product.php");
	}
	if ( !empty($_POST)) {
		// keep track validation errors
		$shoes_nameError = null;
		$sneakersError = null;
		$descriptionError = null;
		$PriceError = null;
		$ImageError = null;
		
		// keep track post values
		
		$shoes_name = $_POST['shoes_name'];
		$sneakers = $_POST['sneakers'];
		$price = $_POST['price'];
		$description = $_POST['description'];	
		$sale_price = $_POST['sale_price'];
		$image = null;

		//var_dump($_POST); die();
				
		// validate input
		$valid = true;
		if (empty($shoes_name)) {
			$shoes_nameError = 'Nhập tên Giày';
			$valid = false;
		}
		
		if (empty($sneakers)) {
			$sneakersError = 'Chọn hãng';
			$valid = false;
		}
		if (empty($price)) {
			$PriceError = 'Nhập giá sản phẩm';
			$valid = false;
		}
		if (empty($description)) {
			$descriptionError = 'Nhập mô tả';
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
	   	else
	   	{
	   		$name = null;
	   	}
	   	
		// cập nhật dữ liệu
		if ($valid) {			
			if ($name != null){
				$pdo = Database::connect();
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql = "UPDATE shoes  set shoes_name = ?, id_sneakers =?, price = ?, image = ?, description = ?, sale_price = ? WHERE id_shoes = ?";
				$q = $pdo->prepare($sql);
				$q->execute(array($shoes_name,$sneakers,$price,$name,$description,$sale_price,$id_shoes));
				Database::disconnect();
				header("Location: product.php");
			}
			else
			{
				$pdo = Database::connect();
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql = "UPDATE shoes  set shoes_name = ?, id_sneakers =?, price = ?, description = ?, sale_price = ? WHERE id_shoes = ?";
				$q = $pdo->prepare($sql);
				$q->execute(array($shoes_name,$sneakers,$price,$description,$sale_price,$id_shoes));
				Database::disconnect();
				header("Location: product.php");
				
			}			
			
		}
	}
	 else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM shoes INNER JOIN sneakers ON shoes.id_sneakers=sneakers.id_sneakers where id_shoes = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id_shoes));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$id_shoes = $data['id_shoes'];
		$shoes_name = $data['shoes_name'];
		$sneakers = $data['sneakers'];
		$price = $data['price'];
		$image = $data['image'];
		$description = $data['description'];
		$sale_price = $data['sale_price'];
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
    				<h3>CHỈNH SỬA SẢN PHẨM</h3>
    			</div>
				<div class="row">
					<div class="col-xs-12 col-md-8">
		    			<form class="form-horizontal" role="form" action="update.php?id_shoes=<?php echo $id_shoes?>" enctype="multipart/form-data" method="post">						 
		    				<!--<input type="hidden" class="form-control" name="id" value="<?php echo !empty($id)?$id:'';?>">-->
							  <div class="form-group">
							    <label for="inputEmail3" class="col-sm-2 control-label">Tên Giày:</label>
							    <div class="col-sm-10">
							      	<input type="text" class="form-control" name="shoes_name" id="inputEmail3" placeholder="Tên Giày" value="<?php echo !empty($shoes_name)?$shoes_name:'';?>">
							      	<?php if (!empty($shoes_nameError)): ?>
						      			<span class="help-inline"><?php echo $shoes_nameError;?></span>
						      		<?php endif; ?>
							    </div>
							  </div>
							  <div class="form-group">
							    <label for="inputEmail3" class="col-sm-2 control-label">Mô tả:</label>
							    <div class="col-sm-10">
							      	<input  type="text" class="form-control" name="description" id="inputEmail3" placeholder="Mô tả" value="<?php echo !empty($description)?$description:'';?>">
							      	<?php if (!empty($descriptionError)): ?>
						      			<span class="help-inline"><?php echo $description;?></span>
						      		<?php endif; ?>
						      		</input>
							    </div>
							  </div>
							   <div class="form-group">
							    <label for="inputEmail3" class="col-sm-2 control-label">Tên hãng:</label>
							    <div class="col-sm-10">
							      	<select name="sneakers" class="form-control">
								      	<?php 							      		
				              				$pdo = Database::connect();
				              				$sql = 'SELECT * FROM sneakers';
				              				foreach ($pdo->query($sql) as $row) {		
				              					if ($row["id_sneakers"] != $category){
				              						echo '<option value="'.$row["id_sneakers"].'">'.$row["sneakers"].'</option>';
				              					}
				              					else
				              					{
				              						echo '<option selected="selected" value="'.$row["Id"].'">'.$row["TenChungLoai"].'</option>';	
				              					}	              							              		
				              					
				              				}
				              				Database::disconnect();	
								      	 ?>
						      	 	</select>
							    </div>
							  </div>
							  <div class="form-group">
							    <label for="inputEmail3" class="col-sm-2 control-label">Giá</label>
							    <div class="col-sm-10">
							      	<input type="text" class="form-control" name="price" id="inputEmail3" placeholder="Giá sản phẩm" value="<?php echo !empty($price)?$price:'';?>">
							      	<?php if (!empty($PriceError)): ?>
						      			<span class="help-inline"><?php echo $PriceError;?></span>
						      		<?php endif; ?>
							    </div>
							  </div>
							  <div class="form-group">
								    <label for="inputEmail3" class="col-sm-2 control-label">Giá khuyến mãi</label>
								    <div class="col-sm-10">
								      	<input type="text" class="form-control" name="sale_price" id="inputEmail3" placeholder="Giá khuyến mãi" value="<?php echo !empty($sale_price)?$sale_price:'';?>">						      	
								    </div>
						  	</div>
							  <div class="form-group">
							    <label for="inputEmail3" class="col-sm-2 control-label">Chọn hình ảnh</label>
							    <div class="col-sm-10">
							      	<input type="file" name="file" id="exampleInputFile">
							      	<?php if (!empty($ImageError)): ?>
						      			<span class="help-inline"><?php echo $ImageError;?></span>
						      		<?php endif; ?>    							
							    </div>
							  </div>
							  <div class="form-group">
							    <div class="col-sm-offset-2 col-sm-10">
							      	<button type="submit" class="btn btn-success">Cập nhật</button>
					  				<a class="btn" href="product.php">Quay lại</a>
							    </div>
							  </div>
						</form>
					</div>
					<div class="col-xs-12 col-md-4">
						<?php if ($image!=null): ?>							
							<img src="../images/products/<?php echo $image;?>" width="444px" height="308px">
						<?php endif; ?>						
					</div>
	    		</div>
    	</div>
		
    </section>
    <?php include'footer.php'; ?>
</body>
</html>