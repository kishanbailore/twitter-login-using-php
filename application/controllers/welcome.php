<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();

/*define('CONSUMER_KEY', 'XkGizTkrCZTkmIIv13b0ngX8y');
define('CONSUMER_SECRET', '8c3oudtioHgkShsZRW3AmtCVsE17j2udUSv1Nv7y36rTIHcKjt');
define('OAUTH_CALLBACK', 'http://localhost/twitterLogin/success');*/
include_once APPPATH . "libraries/oauth.php";
include_once APPPATH . "libraries/twitteroauth.php";

class Welcome extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
	}
	public function index()
	{
		$this->load->view('welcome_message');
	}
	public function success()
	{
		if(isset($_REQUEST['oauth_token']) && $_SESSION['token']  !== $_REQUEST['oauth_token'])
		{
			
			redirect('welcome','refresh');
			
		}
		elseif(isset($_REQUEST['oauth_token']) && $_SESSION['token'] == $_REQUEST['oauth_token']) 
		{
			$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['token'] , $_SESSION['token_secret']);
			$access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);
			if($connection->http_code == '200')
			{

					$user_info = $connection->get('account/verify_credentials', ['include_email' => 'true']); 
					echo '<pre>'; print_r($user_info);
					unset($_SESSION['token']);
					unset($_SESSION['token_secret']);
			}
		}
		else
		{

			if(isset($_GET["denied"]))
			{
				redirect('welcome','refresh');
			}

			//Fresh authentication
			$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
			$request_token = $connection->getRequestToken(OAUTH_CALLBACK);
			
			//Received token info from twitter
			$_SESSION['token'] 			= $request_token['oauth_token'];
			$_SESSION['token_secret'] 	= $request_token['oauth_token_secret'];
			
			//Any value other than 200 is failure, so continue only if http code is 200
			if($connection->http_code == '200')
			{
				//redirect user to twitter
				$twitter_url = $connection->getAuthorizeURL($request_token['oauth_token']);
				redirect($twitter_url); 
			}else{
				echo "error connecting to twitter! try again later!";
			}
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */