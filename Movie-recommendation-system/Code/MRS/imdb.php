
<!DOCTYPE html>
<html lang="en">
    <head>
		<meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title>Movie Recommendation System</title>
        <meta name="description" content="Custom Login Form Styling with CSS3" />
        <meta name="keywords" content="css3, login, form, custom, input, submit, button, html5, placeholder" />
        <meta name="author" content="Codrops" />
        <link rel="shortcut icon" href="../favicon.ico"> 
        <link rel="stylesheet" type="text/css" href="css/style.css" />
		<script src="js/modernizr.custom.63321.js"></script>
		<!--[if lte IE 7]><style>.main{display:none;} .support-note .note-ie{display:block;}</style><![endif]-->
		<style>
			@import url(http://fonts.googleapis.com/css?family=Ubuntu:400,700);
			body {
				background: #563c55 url(images/blurred.jpg) no-repeat center top;
				-webkit-background-size: cover;
				-moz-background-size: cover;
				background-size: cover;
			}
			.container > header h1,
			.container > header h2 {
				color: #fff;
				text-shadow: 0 1px 1px rgba(0,0,0,0.7);
			}
		</style>
    </head>
    <body>
        <div class="container">
		
			<!-- Codrops top bar -->
            <div class="codrops-top">
               <center> <p style="font-size:18px">ILS Z-639 <strong>Social Media Mining </strong> Term Project By Raghuveer, Suhas, Srikanth and Supreeth
                </p> </center>
              <!--  <span class="right">
                    <p
                        <strong>Raghuveer, Suhas, Srikanth and Supreeth</strong>
                    </p>
                </span> -->
            </div><!--/ Codrops top bar -->
			
			<header>
			
		<?php	session_start();
include_once 'test.php';

//$con=mysqli_connect("localhost","test","shata");

if(!isset($_SESSION['user']))
{
 header("Location: login.php");
}
$res=mysql_query("SELECT * FROM users WHERE user_id='".$_SESSION['user']."'");
if (!$res) { // add this check.
    die('Invalid query: ' . mysql_error());
}
$userRow=mysql_fetch_array($res); ?>
	<span style="float: left; position: relative; top: -11px;">	<img height="40px" src="welcome.gif" alt="welcome" /></span>&nbsp;&nbsp; &nbsp;<span style="float: left; color: white; font-weight: bold"> <?php echo $userRow['username']; ?>, </span>

<?php
$gen=mysql_query("SELECT genre FROM rating WHERE user_id='".$_SESSION['user']."' AND rating = 5");
?>
<span style="float: left; color: white;"> &nbsp; <?php echo "Your favourite genres: "; ?> </span> 
<?php while ($row = mysql_fetch_array($gen,MYSQL_ASSOC)){ 
if (strpos($row["genre"],",")!=FALSE) {
$a1 = explode(",",$row["genre"]); 
}
else
{
array_push($a1, $row["genre"]);
}
}
$a = array_map('trim',$a1);
$b = array_unique($a);
$c=0;
while($c < sizeof($b)){?>
<span style="float: left; color: white; font-weight: bold;"> &nbsp <?php if($c == (sizeof($b)-2)){ echo $b[$c]." and";} elseif($c == (sizeof($b)-1)){ echo $b[$c];} else {echo $b[$c].","; } $c++;?> <br></span>
<?php } ?>

<a href="logout.php?logout"><span style="float: right; color: white; font-style: italic";>Sign Out</span></a> 
				<!--<h1><strong>Movie Recommendation System</strong></h1>
                <h2>We'll tell you what you need to watch ;) </h2> -->
				

				<div class="support-note">
					<span class="note-ie">Sorry, This is supported only by the modern browsers.</span>
				</div>
				
			</header>
			
			<section class="main">

				
			<!--<form action="logout.php" method="post">
		<input type="submit" value="Log Off"><br>
		</form>-->
			</section> <br />
			<span style="float: left; font-size:20px;color: white;"> Recommended <strong>IMDB </strong>Movies</span>
			<span style="float: right; font-size:20px;color: white;"> <a style="color:white" href="home.php"> Back to <strong>Youtube </strong>Recommendation</a></span> 
			<br /> <br />
			<?php
			/*

$movie_list=mysql_query("select DISTINCT video_id from rating 
where genre in ( select distinct A.genre from rating A, rating B where B.user_id = '".$_SESSION['user']."' and B.rating = 5
AND A.genre like CONCAT('%',B.genre,'%'))
and user_id <> '".$_SESSION['user']."' and rating = 5 ORDER BY RAND() LIMIT 8");

echo "<div>";

while ($row = mysql_fetch_array($movie_list,MYSQL_ASSOC)) {
echo '<iframe width="300" height="200" src="https://www.youtube.com/embed/' . $row["video_id"] .'"frameborder="0" allowfullscreen></iframe>';
}

echo "</div>"; */

$imdb_list=mysql_query("select DISTINCT IMDB_ID from imdb
where IMDB_genre in (select distinct genre from rating where user_id='".$_SESSION['user']."' and rating = 5)
order by IMDB_Rating, Rand()desc LIMIT 10");

echo "<div style=\"left: 75px;position:relative;\">";

while ($row = mysql_fetch_array($imdb_list,MYSQL_ASSOC)) {
echo '<a href="http://www.imdb.com/title/'. $row["IMDB_ID"] .'" target="_blank"> <img width="214" height="317" src= "images/' . $row["IMDB_ID"] . '.jpg" > </a>'; 
}

echo "</div>";

?>
        </div>
    </body>
</html>