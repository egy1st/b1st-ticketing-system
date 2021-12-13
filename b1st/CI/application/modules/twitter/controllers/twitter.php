<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class twitter extends MX_Controller {

	public function __construct()
	{
		B1st_authenticate();
		B1st_selectbacklanguage();
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('download');
		$this->load->helper('twitter');
		$this->load->model('twitter_model');

	}

	public function getTweet($id)
	{
		$result = array();
		
		$tweet = B1st_get_tweet_by_id($id);
		if(!empty($tweet))
		{
			$body = "Sender name: " . $tweet->sender->name . "\r\n" ;
			$body .= "Sent at: " . $tweet->sender->created_at . "\r\n" ;
        	$body .= "Sender username: " . $tweet->sender_screen_name . "\r\n" . "\r\n" ;
			$body .= "Message: " . $tweet->text . "\r\n" ;
			
			$result['body'] = $body ; 
			$result['id'] = $tweet->sender_id ; // "$tweet->id";
			//$result['replyurl'] =  'https://twitter.com/intent/tweet?in_reply_to_status_id=' . $result['idstr'] ;
			$result['status'] = 1;
		}
		else
		{

			$result['status'] = 0;
		}

		echo json_encode($result);
		
	}
	
	
	public function reply_DM($id, $txt)
	{
				
		$response = B1st_postReply($id, $txt);
	}
	
	
	public function index()
	{
		$data['tweets'] = $this->twitter_model->getAllTweets();
 		$this->load->view('twitter',$data);	
	}

	public function getTweets()
	{
		$result = array();
		
		$tweets = B1st_get_latest_tweets();
		if(!empty($tweets))
		{
			$result['content'] = '';
			$num = 0;
			foreach ($tweets as $tweet) {
				if(!$this->twitter_model->tweetExists($tweet->id))
				{

				  $string = substr($tweet->text,0,15).'...';

				  $idata['tid'] = $tweet->id;
				  $idata['body'] = $tweet->text;
				  $idata['deleted'] = 0;

				  $this->twitter_model->insertTweet($idata);
				
				$txt = (B1st_check_already_posted($tweet->id,'tweet')) ? "<strong class='scanthreat has-tip' title=\"Already posted as ticket\">[P]</strong>" : "";

				$result['content'] .= '<li><a onclick="getTweet(\''.$tweet->id.'\')" href="javascript:void(0)">'.$string.''.$txt.'</a><button class="has-tip" title="Delete Tweet" type="button" onclick="deleteTweet(\''.$tweet->id.'\',this);" ><i class="fa fa-trash"></i></button></li>';
				$num++;
				}
			}
			$result['total'] = $num; 
			$result['status'] = 1;
		}
		else
		{
			$result['status'] = 0;
			$result['msg'] = "some Error occured please try again !!";
		}

		
		echo json_encode($result);
	}

	
	public function download($filename)
	{
		$d = file_get_contents(TICKET_PLUGIN_PATH."/tmp/".$filename);
		force_download($filename,$d);

	}

	public function deleteTweet($id)
	{
		$where['tid'] = $id;
		if($this->twitter_model->deleteTweet($where))
		{
			echo "ok";
			return;
		}

		echo "error";
	}
	
	
		
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
