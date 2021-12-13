<?php

function B1st_get_latest_tweets()
{
require_once('TwitterAPIExchange.php');
     
	 $settings = (array)B1st_getSettingsValue('twitter');

     $access_token = $settings['oauth_access_token'];
     $access_token_secret = $settings['oauth_access_token_secret'];
     $consumer_key = $settings['consumer_key'];
     $consumer_secret = $settings['consumer_secret'];
     $screen_name = $settings['screen_name'];
     $count = $settings['count'];

/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
$settings = array(
    'oauth_access_token' => $access_token,
    'oauth_access_token_secret' => $access_token_secret,
    'consumer_key' => $consumer_key,
    'consumer_secret' => $consumer_secret
);


// $url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';  by MAA this recieve tweets but the next receive notifications
$url = 'https://api.twitter.com/1.1/direct_messages.json' ;
$getfield = "?include_entities=true&include_rts=true&screen_name=".$screen_name."&count=".$count;
$requestMethod = 'GET';

$twitter = new TwitterAPIExchange($settings);
$response = $twitter->setGetfield($getfield)
    ->buildOauth($url, $requestMethod)
    ->performRequest();

return json_decode($response);
}

function B1st_get_tweet_by_id($id)
{
    require_once('TwitterAPIExchange.php');
    
     $settings = (array)B1st_getSettingsValue('twitter');

     $access_token = $settings['oauth_access_token'];
     $access_token_secret = $settings['oauth_access_token_secret'];
     $consumer_key = $settings['consumer_key'];
     $consumer_secret = $settings['consumer_secret'];
     $screen_name = $settings['screen_name'];
     $count = $settings['count'];

/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
$settings = array(
    'oauth_access_token' => $access_token,
    'oauth_access_token_secret' => $access_token_secret,
    'consumer_key' => $consumer_key,
    'consumer_secret' => $consumer_secret
);

$url = 'https://api.twitter.com/1.1/direct_messages/show.json';
$getfield = "?id=".$id;
$requestMethod = 'GET';

$twitter = new TwitterAPIExchange($settings);
$response = $twitter->setGetfield($getfield)
    ->buildOauth($url, $requestMethod)
    ->performRequest();

return json_decode($response);
}


function B1st_postReply($id, $txt)
{
require_once('TwitterAPIExchange.php');
     
	
	$settings = (array)B1st_getSettingsValue('twitter');

     $access_token = $settings['oauth_access_token'];
     $access_token_secret = $settings['oauth_access_token_secret'];
     $consumer_key = $settings['consumer_key'];
     $consumer_secret = $settings['consumer_secret'];
     $screen_name = $settings['screen_name'];
     $count = $settings['count'];

/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
$settings = array(
    'oauth_access_token' => $access_token,
    'oauth_access_token_secret' => $access_token_secret,
    'consumer_key' => $consumer_key,
    'consumer_secret' => $consumer_secret
);

$url = 'https://api.twitter.com/1.1/direct_messages/new.json' ;
$requestMethod = 'POST';
$postfields = array(
    'user_id' => $id, 
	'text' => urldecode($txt)
);

$twitter = new TwitterAPIExchange($settings);
new TwitterAPIExchange($settings);
$response = $twitter->buildOauth($url, $requestMethod)
    ->setPostfields($postfields)
    ->performRequest();
	var_dump($response);
}
