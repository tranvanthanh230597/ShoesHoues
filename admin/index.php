
<?php 		
    	include 'head.php';    
     ?>
<body>
	<header>
        <div class="container">
            <a href="#">
				<h1>Trang quản trị cửa hàng giày</h1>
            </a>
            
        </div>
    </header>
    <?php 
    	include 'menu.php';
     ?>
    <section>
    	<div class="container">
    		<div class="row">
			  	<div class="col-xs-6 col-md-3">
			  		<div class="menu_metro">
			  				<a href="product.php"><img src="../images/icon/product.png" class="img-responsive icon" alt="Product"></a>
			  				<div class="title_menu">
			  					<a href="product.php"><span class="title">Sản phẩm</span></a>	
			  				</div>
			  				
			  		</div>
			  	</div>
			  	<div class="col-xs-6 col-md-3">
			  		<div class="menu_metro">
			  				<img src="../images/icon/article.png" class="img-responsive icon" alt="Product">
			  				<div class="title_menu">
			  					<a href="category.php"><span class="title">Hãng giày</a>	
			  				</div>
			  				
			  		</div>
			  	</div>
			  	<div class="col-xs-6 col-md-3">
			  		<div class="menu_metro">
			  				<img src="../images/icon/cart.png" class="img-responsive icon" alt="Product">
			  				<div class="title_menu">
			  					<a href="#"><span class="title">Đặt hàng</span></a>	
			  				</div>
			  				
			  		</div>
			  	</div>
			  	<div class="col-xs-6 col-md-3">
			  		<div class="menu_metro">
			  				<img src="../images/icon/member.png" class="img-responsive icon" alt="Product">
			  				<div class="title_menu">
			  					<a href="admin.php"><span class="title">Thành viên</span></a>	
			  				</div>
			  				
			  		</div>
			  	</div>
    	</div>
    </section>
    <?php include "footer.php" ?>
</body>
</html>