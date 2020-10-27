<?php
$res=null;
$mysqli = new mysqli('localhost','root','','moviedb');
$set=$_POST['search'];

if (mysqli_connect_errno())
      {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }

$result=$mysqli->query
("SELECT * from actors where name='$set'")
or die($mysqli->error);

?>
	<style>
	.login{
width:360px;
margin:50px auto;
font:Cambria, "Hoefler Text", "Liberation Serif", Times, "Times New Roman", serif;
border-radius:10px;
border:2px solid #ccc;
padding:10px 40px 25px;
margin-top:70px; 
}
.country{
font-size:20px;
font-color:#fff;
}
body{
	font-size:20px;
	background-color:#DAF7P7 ;
}
h1{
	color: blue;
	text-align:center;
	 text-transform: uppercase;
}
.director{
	font-size:20px;
}

		.search-btn{
  background-color: #4CAF50;
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  border-radius:25px;
  cursor: pointer;
  
}
</style>
<div class="login">

<?php while($movie = mysqli_fetch_array($result) ): ?>
<h1><?= $movie['name'] ?></h1>
<span class='country'>Nationality:<?= $movie['country'] ?></span>
 
        <?php
        echo '<br>';
		//movies
		$result2 = $mysqli->query("SELECT movieid FROM movieactor WHERE actorid={$movie['actorid']}") or
		die($mysqli->error);
		
		$actors = $result2->fetch_all();
		
		$actors= array_column($actors,0); 
		//print_r($genres);
		for($i = 0; $i< count($actors);$i++)
		{
		$actor = $mysqli->query("SELECT title FROM movies where movieid ='{$actors[$i]}'")->fetch_assoc();
		
		$s=count($actors)> 1 ? 's' : '';
	    echo $i == 0 ? "<span class='content yellow'>Acted Movie$s: </span>" : '';
		echo "<span>".$actor['title']."</span>";
		echo $actors[$i] != end($actors) ? ', ' : '';
		}
		//echo '<br>';
		?>
				   <div class="bottom"> <button class="search-btn" onclick="location.href='index.php';">Go Back</button></div>

	
		<?php endwhile; ?>	
			</div>