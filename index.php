<?php

require "vendor/autoload.php";
require "library/safemysql.class.php";

use Abraham\TwitterOAuth\TwitterOAuth;

define("CONSUMER_KEY",     "0HDUKVQB8DDZrbNtISd5IxNVW");
define("CONSUMER_SECRET",     "i0EU18HQP5twtq8Jf1L5srGCjUSdxebi2AHBueXShE8qGbeDt6");

$access_token = " 1264302404-HasLpqsg4ZifD6kmqBJwVlxD7bo7CvOKB3aZjrb";
$access_token_secret = "YA3VsmanxXeqyecKCa9lwtymptPf76KaSJa4PyOIgGeXc";

		//SEARCH BY 'POPULAR'
		function search(array $query)
		{
		  $toa = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token, $access_token_secret);
		  return $toa->get('search/tweets', $query);
		}
		 
		$query = array(
		  "q" => "popular",
		   "count" => 5,
		);
		  
		$results = search($query);
        echo '<table>';
		echo '<tr><th>name</th><th>text</th></tr>';
		
			foreach ($results->statuses as $result) {
			echo '<tr>';
				echo '<td>',$result->user->name,'</td>';
				echo '<td>',$result->source,'</td>';
			echo '</tr>';
			}
		echo '</table><br/>';




		//SAVE TO DATABASE
		if($results != null){
			

		$db    = new SafeMysql();

		foreach($results->statuses as $item){
		 // var_dump($item->user);
			$name = $item->lang;
			$text = $item->id;
		}
		 $raw = $db->query( "INSERT INTO tweet ( lang, id_tweet ) VALUES (?s, ?s)",$name, $text);
			
		if ($raw === TRUE) {
		    echo "New record created successfully";
		} else {
		    echo "Error: Ups, something wrong";
		}

}
		

  

  