<?php 
    	include 'head.php';
     ?>
<body>
	<header>
        <div class="container">        	
	            <a href="#">
					<h1>QUẢN LÝ ADMIN</h1>
	            </a>	         
        </div>
    </header>
    <?php 
    	include 'menu.php';
     ?>
    <section>
    	<div class="container">
			<div class="row">
				<table class="table table-striped table-bordered">
		              <thead>
		                <tr>
		                  <th>Mã admin</th>
		                  <th>Tên admin</th>		                 
		                  <th>Email</th>		                 
		                  <th>pass</th>		                 
		                  <th>Chưc vụ</th>		                 
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
		              	$sql1 = 'select * from user';
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
	              			             
		              	$sql = 'select * from user limit '.$vitri.', 5';
		              	foreach ($pdo->query($sql) as $row) {
		              		echo '<tr class="success">';
		              			echo '<td>'.$row['Id'].'</td>';
		              			echo '<td>'.$row['Name'].'</td>';		              			
		              			echo '<td>'.$row['Email'].'</td>';		              			
		              			echo '<td>'.$row['Password'].'</td>';		              			
		              			echo '<td>'.$row['Quyen'].'</td>';		              			
		              		echo '</tr>';
		              	}
		              	Database::disconnect();	
		               ?>
		              </tbody>
	            </table>
	            

			</div>
    	</div>
    </section>
    <?php include"footer.php"; ?>
</body>
</html>