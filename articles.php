<?php include'head.php' ?>
<?php 	
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}	
	else {
		header("Location: index.php");
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
				<div class="panel panel-primary panel-product">
				<div class="panel-heading">Danh sách bài đăng</div>
							
							
							<?php 
							$pdo = Database::connect();	

							if (!isset($_GET['page'])) {
							$page = 1;
							}
							else
							{
								$page = $_REQUEST['page'];
							}
							$n = 5; //number product on a page
							$vitri = ($page - 1) * $n;	
			              	$sql1 = 'select * from articles where TheLoai = '.$id;
			              	if($result = $pdo->query($sql1))
							{
							    //đếm số trang lấy được
							    $recordnumber = $result->rowCount();
							    if ($recordnumber%$n ==0)
							    {
							    	$pagenumber = $recordnumber/$n;
							    }	
							    else{
							    	$pagenumber = floor($recordnumber/$n) + 1;								    		 	
							    }
							    
							}							
							$sql = 'select * from articles where TheLoai = '.$id.' ORDER BY Id DESC limit '.$vitri.','.$n;
							if($result1 = $pdo->query($sql))
							{
							    //đếm số trang lấy được
							    $recordnumber = $result1->rowCount();
							    if ($recordnumber ==0)
							    {
							    	echo '<h5>Không có bài viết trong chủ đề này</h5>';
							    }
							}	
							foreach ($pdo ->query($sql) as $row) {
							?>
							<div class="media">
								<a class="pull-left" href="article.php?id=<?php echo $row['Id'] ?>">
									<img class="media-object" height="120px" width="150px" src="<?php echo $row['HinhAnh'] ?>" alt="...">
								</a>
								<div class="media-body">								
									
									<h4><?php echo $row['TieuDe'] ?></h4>

									<?php 
										if (strlen($row['MoTa'])<380)
										{
											echo $row['MoTa'];
										}
										else
										{
											echo substr($row['MoTa'], 0, 380).'...';
										}
									?>
									<br>
									<a class="pull-left read-more btn btn-info" href="article.php?id=<?php echo $row['Id'] ?>">Xem chi tiết <span class="glyphicon glyphicon-circle-arrow-right"></span></a>
								</div>
							</div>						
							<?php
							}
							Database::disconnect();	
						?>

				
					
				</div>
					
				<?php 
		            	if($page>1){echo '<a class="btn btn-success" href="articles.php?id='.$id.'&page='.($page-1).'">Trang trước</a>';}
		            	echo '&nbsp;';
						for ($i=1 ; $i<=$pagenumber ; $i++) {
							if ($i == $page) {
							       echo $i;
							       echo '&nbsp;';
							} 
							else {
							      echo '<a class="btn btn-info" href="articles.php?id='.$id.'&page='.$i.'">'.$i.'</a>';
							      echo '&nbsp;';
							}
						}
						if($page<$pagenumber){echo '<a class="btn btn-success" href="articles.php?id='.$id.'&page='.($page+1).'"">Trang sau</a>';}
					?>	
			  </div>
           </div>

        </div>
    </section>
	<?php include'bottom.php' ?>