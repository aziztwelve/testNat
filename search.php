<?php
//twitter search
require "library/twitteroauth.php";

//db connect
$servername = "localhost";
$username = "root";
$password = "1202";
$dbname = "testNat";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
	die("failed");
}



//connect to twitter api
$consumer_key = "0HDUKVQB8DDZrbNtISd5IxNVW";
$consumer_secret = "i0EU18HQP5twtq8Jf1L5srGCjUSdxebi2AHBueXShE8qGbeDt6";
$access_token = "1264302404-HasLpqsg4ZifD6kmqBJwVlxD7bo7CvOKB3aZjrb";
$access_token_secret = "YA3VsmanxXeqyecKCa9lwtymptPf76KaSJa4PyOIgGeXc";

$twitter = new TwitterOAuth($consumer_key,$consumer_secret, $access_token, $access_token_secret);
$twit = $twitter->get('https://api.twitter.com/1.1/search/tweets.json?q=popular&result_type=recent&count=5');

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Twitter API SEARCH</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<style>
	table{ 
	margin-top: 30px;
	width:100%;
    border:4px solid gray;
    padding:2px;
    border-top-width: 0px;
}
.marg{
	margin-left: 95px;
}
</style>
</head>

<body>

	<form action="" method="post">
		<label>Поиск: <input type="text" name="keyword"></label>

		<br>
  		<input class="marg" type="submit" value="Search">
	</form>

	<?php 
		//search by keyword
		if (isset($_POST['keyword'])) {
			$twit = $twitter->get('https://api.twitter.com/1.1/search/tweets.json?q='.$_POST['keyword'].'&result_type=recent&count=5');

			echo '<table>';
					echo '<tr><th>name</th><th >text</th></tr>';
					foreach ($twit->statuses as $result) {
						echo '<tr>';
							echo '<td>',$result->user->name,'</td>';
							echo '<td>',$result->text,'</td>';
							// echo '<td>',$result->retweet_count,'</td>';
							// echo '<td>',$result->id,'</td>';
						echo '</tr>';
					}
			echo '</table><br />';
		}
		$conn->close();
	?>
</body>
</html>