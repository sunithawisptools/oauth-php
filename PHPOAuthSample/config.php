<?php
  // setting up session
  /* note: This is not a secure way to store oAuth tokens. You should use a secure
  *     data sore. We use this for simplicity in this example.
  */
  session_save_path('/tmp');
  session_start();

  define('OAUTH_CONSUMER_KEY', 'qyprduMSTUFfnioydGKKJeYPtUxR5Z');
  define('OAUTH_CONSUMER_SECRET', 'uY7J1HDZBThi6OzGDQzzM3hOkN46td7NGptIlaaZ');
  define('BASE_URL', 'http://192.168.0.104/test/sunitha/oauth-php-master');
  
  if(strlen(OAUTH_CONSUMER_KEY) < 5 OR strlen(OAUTH_CONSUMER_SECRET) < 5 ){
    echo "<h3>Set the consumer key and secret in the config.php file before you run this example</h3>";
  }
  
 ?>
