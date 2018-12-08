<nav class="nav-bottom">
        <div class="container">
            <div class="row">
				<div class="col-md-12">
				
					<ul class="nav nav-pills" id="menu" role="tablist">
						<li><a href="index.php">Trang chủ</a></li>						
						<?php 
													//include 'admin/database.php';
							$pdo = Database::connect();
							$sql = 'SELECT * FROM `sneakers` LIMIT 10';
							foreach ($pdo ->query($sql) as $row) {
								echo '<li><a href="category.php?id='.$row['id_sneakers'].'">'.$row['sneakers'].'</a></li>';
							}
						?>			
												
					</ul>
		
				</div>
			</div>
        </div>
    </nav>
	<section class="center_content_footer">
		<div class="container">
			<div class="row">
				<div class="col-md-3">
					
					<a href="index.html"><img height="100px" width="200px" style="margin-top:20px" src="images/bookstore.png" title="Du lịch Miền Trung | Khám phá Miền Trung" alt="ve_mien_trung_logo"/></a>	
					<br/>
				</div>
				
				<div class="col-md-3">
					<h5 class="bottom">Về chúng tôi</h5>
					
					<ul>
						
						<li><a href="#">Giới thiệu về Bookonline</a></li>
						<li><a href="#">Tuyển dụng</a></li>
						<li><a href="#">Góc báo chí</a></li>
						<li><a href="#">Cam kết</a></li>
						<li><a href="#">Chính sách khách hàng</a></li>
					</ul>
				</div>
				<div class="col-md-3">
					<h5 class="bottom">Trợ giúp</h5>
					<ul>
						
						<li><a href="#">Quy định sử dụng</a></li>
						<li><a href="#">Hướng dẫn mua hàng</a></li>
						<li><a href="#">Phương thức thanh toán</a></li>
						<li><a href="#">Phương thức vận chuyển</a></li>
						<li><a href="#">Câu hỏi thường gặp</a></li>
					</ul>
				</div>
				<div class="col-md-3">
					<h5 class="bottom">Nhận tin khuyến mãi</h5>
					<ul>						
				  		<li class="email_promotion">
				  			<div class="left-inner-addon ">
							    <i class="glyphicon glyphicon-envelope"></i>
							    <input type="text"
							           class="form-control" 
							           placeholder="Địa chỉ email" />
							</div>
				  		</li>				  				  		
				  		<li><button type="submit" class="btn btn-success">Đăng kí</button></li>
				  	</ul>					
				</div>
			</div>
		</div>
	</section>
    <script>
        $('.carousel').carousel();
    </script>
</body>
</html>