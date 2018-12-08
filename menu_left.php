<?php 
							//include 'admin/database.php';
	$pdo = Database::connect();
	$sql = 'SELECT * FROM `sneakers` LIMIT 10';
	foreach ($pdo ->query($sql) as $row) {
		echo '<li><a href="category.php?id='.$row['id_sneakers'].'">'.$row['sneakers'].'</a></li>';
	}
?>			