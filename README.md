#  OAuth-PHP
PHP Sample for OAuth

Welcome to the Intuit Developer's PHP Sample OAuth App.

This sample app is meant to provide a working example of oAuth management. 

OAuth Management APIs consists of the following:

1.	Intuit OAuth Service URLs— URLs to use to access Intuit OAuth Services.
2.	setup()— Specifies the URL needed by the Connect to QuickBooks button.
3.	Disconnect— Invalidates the OAuth access token in the request, thereby disconnecting the user from QuickBooks for this app.
4.	Reconnect— Invalidates the OAuth access token used in the request and generates a new one.

Please note that while these examples work, features not called out above are not intended to be taken and used in production business applications. In other words, this is not a seed project to be taken cart blanche and deployed to your production environment.  

For example, certain concerns are not addressed at all in our samples (e.g. security, privacy, scalability). In our sample apps, we strive to strike a balance between clarity, maintainability, and performance where we can. However, clarity is ultimately the most important quality in a sample app.

Therefore there are certain instances where we might forgo a more complicated implementation (e.g. caching a frequently used value, robust error handling, more generic domain model structure) in favor of code that is easier to read. In that light, we welcome any feedback that makes our samples apps easier to learn from.

## Table of Contents

* [Requirements](#requirements)
* [First Use Instructions](#first-use-instructions)
* [Running the code](#running-the-code)
* [High Level Workflow](#high-level-workflow)
* [Functional Details](#functional-details)
* [Project Structure](#project-structure)
* [How To Guides](#how-to-guides)


## Requirements

In order to successfully run this sample app you need a few things:

1. Latest version of PHP on your machine. This sample uses PHP 5.6.3.
2. Install Apache Server and configure PHP 5 to run with Apache Server
3. Download Intuit’s latest PHP devkit from GitHub https://developer.intuit.com/docs/0100_quickbooks_online/0400_tools/0005_accounting/0209_php. This sample uses v3-php-sdk-2.2.0-RC. (v3-php-sdk-2.2.0-RC is also included in this repository for your convenience!) 
5. For Oauth implementation, this sample uses the Pecl Oauth library. Please download the Oauth 
package from this [page](http://pecl.php.net/package/oauth)
<ul>
  <li>Instructions for Windows:
      <ul>
      <li>
      Download the php_oauth.dll and copy it to the ext folder of your PHP installation.
      </li>
      <li>
      Add the entry “extension=php_oauth.dll” in your php.ini file.
      </li>
      </ul>
  </li>
  <li>Instructions for MAC OSX:
      <ul>
      Follow this link: http://lupomontero.com/installing-phps-oauth-pecl-extension-on-mac-os-x-snow-leopard/
      </ul>
  </li>
</ul>
6. A [developer.intuit.com](http://developer.intuit.com) account
7. An app on [developer.intuit.com](http://developer.intuit.com) and the associated app token, consumer key, and consumer secret.

## First Use Instructions

1. Clone the GitHub repo to your computer
2. Place our PHPOAuthSample folder and the downloaded v3-php-sdk-2.2.0-RC folder inside the web folder of the Apache web server.
3. This sample is using the sandbox environment by default. So, you need to use the development tokens of your app for running this sample. If you want to switch to production, please make sure that you change the baseUrl in app.config file inside PHPOAuthSample folder to quickbooks.api.intuit.com from sandbox-quickbooks.api.intuit.com. Also, make sure that you configure the sample app to use prod tokens instead of development tokens.
4. **Configuring the app tokens**: Go to your app on developer.intuit.com and copy the OAuth Consumer Key and OAuth Consumer Token from the keys tab. Add these values to the **config.php** file in our PHPOAuthSample folder.
5. Set the **session_save_path** variable in config.php file to the path of a directory on your local machine where you want to save the session data (preferably temp folder)

## Running the code

Once the sample app code is on your computer, you can do the following steps to run the app:

1. Index.php is the starting page for our sample. Open the index.php file in the web browser.
2. Connect your app to Quickbooks, by clicking on “Connect to QuickBooks” button and follow the steps.
3. After successfully connecting the app to QuickBooks, you will see the realmID, Oauth token and Oauth secret on the webpage. Add these values to the app.config file inside the PHPOAuthSample folder before proceeding.
<ul>
<li>
**Note**: Configuring the Oauth tokens manually in app.config file is only for demonstartion purpose in this sample app. In real time production app, save the oath_token, oath_token_secret, and realmId and creation date in a persistent storage, associating them with the user who is currently authorizing access. Your app needs these values for subsequent requests to Quickbooks Data Services. Be sure to encrypt the access token and access token secret before saving them in persistent storage.
</li>
<li>
Please refer to this [link](https://developer.intuit.com/docs/0100_quickbooks_online/0100_essentials/0085_develop_quickbooks_apps/0004_authentication_and_authorization/connect_from_within_your_app) for implementing oauth in your app.
</li>
</ul>

### High Level Workflow

1. Connect to a QuickBooks Online company by clicking on **Connect to QuickBooks** button.
2. Update app.config file with the obtained realmID and OAuth tokens
3. Use "Disconnect" button to disconnect the app
4. Use "Reconnect" button to regenerate the tokens


### Functional Details
Buttons and their functionalities:

1. **Disconnect the app**: Allows the user to disconnect the app from QuickBooks, by deleting the oauth token and secret of the app associated with that user.  If you need to connect to Quickbooks later again, you have to go through the “Connect to QuickBooks” process to generate the new oauth tokens. (Check implementation in disconnect.php) 
2. **Reconnect the app**: Before the token expires, your app can obtain a new token to provide uniterrupted service by calling the Reconnect API. (Check implementation in reconnect.php)
   
    The following conditions must be met in order to renew the OAuth access token:
    <ul>
        <li>The renewal must be made within 30 days of token expiry. Note that when your app received the token during the OAuth grant, the expiry date was calculated (180 days).Only production approved apps can make this call for unlimited connections. Developer and non approved prod instances can test in playground and are limited to 10 connections. The current token must still be active.</li>
        <li>Note: For Production app, it is advised to run a scheduled daily job to regenerate the tokens, if the current date is more than 150 days and less than 180 days from the Creation date of OAuth tokens (obtained from the persistent storage)</li>
    </ul>

### Project Structure
1.	**index.php**: Contains the code for adding "Connect to QuickBooks" button.
2.	**oauth.php**: Code needed for obtaining the oAuth tokens.
3.	**Disconnect.php**: Contains the code for calling disconnect function of OAuth Management API
4.	**Reconnect.php**: Contains the code for calling disconnect function of OAuth Management API
5. All the styles are located in StyleElements.php file present inside CSS Styles folder.

### How To Guides

The following How-To guides related to implementation tasks necessary to produce a production-ready Intuit Partner Platform app:
* <a href="https://developer.intuit.com/docs/0100_quickbooks_online/0100_essentials/0085_develop_quickbooks_apps/0004_authentication_and_authorization/connect_from_within_your_app" target="_blank">OAuth How To Guide </a>



