<?php include'head.php' ?>
<?php 
	//require 'admin/database.php';
	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
	
	if ( null==$id || !(is_numeric($id))) {
		//header("Location: index.php");
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "select articles.*, category.Name from articles,category where articles.TheLoai = category.Id and articles.Id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		Database::disconnect();
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
				<h1 style="font-size:20px; font-weight: bold"><?php echo $data['TieuDe'];?></h1>				
				<span class="glyphicon glyphicon-calendar time">
					<?php 
						$date = date_create($data['Ngay']);
						echo date_format($date, 'd/m/Y H:i:s');
					?>
				</span>						
				<hr>
				<?php echo $data['NoiDung'];?>
				<hr>
				Tag <a class="tag" href="articles.php?id=<?php echo $data['TheLoai'];?>"><?php echo $data['Name'];?></a>
				<hr>
			  </div>
           </div>

        </div>
    </section>
	<?php include'bottom.php' ?>