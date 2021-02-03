<?php
  session_start();
  $count = 0;
  // connecto database
  
  $title = "Bookart";
  require_once "./template/header.php";
  require_once "./functions/database_functions.php";
  $conn = db_connect();
  $row = select4LatestBook($conn);
?> 
     
 <html>
  <head>
    <link rel="icon" type="png" href="book.png">
  </head>
  </html>

  <div class="jumbotron"  style=" background: url('https://www.wallpapertip.com/wmimgs/13-132050_soft-gradient-color-background.jpg') no-repeat center center;background-size: cover;height:400px
;
  " >
     <br/> <br/>
      <p class="lead text-center text-muted"><b><strong><em>OUR LATEST BOOKS</em></b></strong></p>
      <br><br>
      <div class="row">
        <?php foreach($row as $book) { ?>
      	<div class="col-md-3">
      		<a href="book.php?bookisbn=<?php echo $book['book_isbn']; ?>">
           <img class="img-responsive img-thumbnail" src="./bootstrap/img/<?php echo $book['book_image']; ?>">
          </a>
      	</div>
        <?php } ?>
      </div>
      
<?php
  if(isset($conn)) {mysqli_close($conn);}
  require_once "./template/footer.php";
?>

