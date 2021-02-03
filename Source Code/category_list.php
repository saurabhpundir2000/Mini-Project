<?php
	session_start();
	require_once "./functions/database_functions.php";
	$conn = db_connect();

	$query = "SELECT * FROM category ORDER BY category_name";
	$result = mysqli_query($conn, $query);
	if(!$result){
		echo "Can't retrieve data " . mysqli_error($conn);
		exit;
	}
	if(mysqli_num_rows($result) == 0){
		echo "Empty category ! Something wrong! check again";
		exit;
	}

	$title = "List Of Categories";
	require "./template/header.php";
?>
<div class="jumbotron"  style=" background: url('https://lh3.googleusercontent.com/proxy/9Fmf1M0wunKZYNne9ZiXY9ByAvg6J9qrFKri-hLW9IOk8oyIVcVaaafYyPXe99hDqejvKt8csqBD4FZ0nwKQesaMcHwsV-0Dh4HhTkWgZE2bDUbAzwnUpS-prBODMiNGodYFjOXYmK62y6lGYhverfDd_MVacsYTIJfeOS_JsGQ') no-repeat center center
;
  " >
	<p class="lead" style="font-family:Times New Roman;">List of Category</p>
	<ul>
	<?php 
		while($row = mysqli_fetch_assoc($result)){
			$count = 0; 
			$query = "SELECT categoryid FROM books";
			$result2 = mysqli_query($conn, $query);
			if(!$result2){
				echo "Can't retrieve data " . mysqli_error($conn);
				exit;
			}
			while ($pubInBook = mysqli_fetch_assoc($result2)){
				if($pubInBook['categoryid'] == $row['categoryid']){
					$count++;
				}
			}
	?>
		<li>
			<span class="badge"><?php echo $count; ?></span>
		    <a href="bookPerCat.php?catid=<?php echo $row['categoryid']; ?>"><?php echo $row['category_name']; ?></a>
		</li>
	<?php } ?>
		<li>
			<a href="books.php">List full of books</a>
		</li>
	</ul>
	</div>
<?php
	mysqli_close($conn);
	require "./template/footer.php";
?>