# twitter-login-using-php
Login with twitter using php


 At first go to the https://apps.twitter.com/app/new and login at your Twitter developer account.
 Create new apps with the following details.

    Name: Your application Name. This is shown to the user while authorizing.
    Description: Your application Description. This is shown to user while authorizing.
    Website: Your application website.
    Callback URL: After authorization, this URL is called with oauth_token.

 Now change the apps permission to Read and Write or Read, Write and Access direct messages.
 
 
 After the apps creation you have to click on Test OAuth. Also you should login with your twitter account for test OAuth. After that you would be redirected to the OAuth Settings page. At the OAuth Settings page you can see the Consumer key and Consumer secret.
 
     define('CONSUMER_KEY', 'Twitter Consumer Key');
    define('CONSUMER_SECRET', 'Twitter Consumer Secret');
    define('OAUTH_CALLBACK', 'http://localhost/twitterLogin/index.php/welcome/sucess');
    
    $user_info = $connection->get('account/verify_credentials', ['include_email' => 'true']);
    
    Give all the details.
    
    
    
    
    
    
    
