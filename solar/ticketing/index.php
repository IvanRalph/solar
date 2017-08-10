<?php
include "php/sql-statements.php";

$db = new DB();
require_once 'config.php';
require_once 'lib/Google_Client.php';
require_once 'lib/Google_Oauth2Service.php';

$client = new Google_Client();
$client->setApplicationName("Solar IT Service Desk");

$client->setClientId(CLIENT_ID);
$client->setClientSecret(CLIENT_SECRET);
$client->setRedirectUri(REDIRECT_URI);
$client->setApprovalPrompt(APPROVAL_PROMPT);
$client->setAccessType(ACCESS_TYPE);

$oauth2 = new Google_Oauth2Service($client);

if (isset($_GET['code'])) {
  $client->authenticate($_GET['code']);
  $_SESSION['token'] = $client->getAccessToken();
  echo '<script type="text/javascript">window.close();</script>'; exit;
}

if (isset($_SESSION['token'])) {
 $client->setAccessToken($_SESSION['token']);
}

if (isset($_REQUEST['error'])) {
 echo '<script type="text/javascript">window.close();</script>'; exit;
}

if ($client->getAccessToken()) {
  $user = $oauth2->userinfo->get();

  // print_r($user);
  // die();

  $checkUser = $db->getRows('users', array('where'=>array('google_id'=>$user['id'])));
  $userData = array(
        'username'=>$user['email'],
        'email'=>$user['email'],
        'firstname'=>$user['given_name'],
        'lastname'=>$user['family_name'],
        'user_type_id'=>'1',
        'google_id'=>$user['id']
    );
  
  if($checkUser == 0 || $checkUser == false){
    $insert = $db->insert('users', $userData);
  }else{
    $update = $db->update('users', $userData, array('google_id'=>$user['id']));
  }

  // The access token may have been updated lazily.
  $_SESSION['token'] = $client->getAccessToken();
  $_SESSION['gid'] = $user['id'];

  switch($checkUser[0]['user_type_id']){
    case 1: 
      $header = "requestor/index.php";
      break;
    case 2:
      $header = "approver/index.php";
      break;
    case 3:
      $header = "it/index.php";
      break;
    default:
      $header = "index.php";
      break;
  }

  if(isset($_SESSION['token'])){
    header("location: " . $header);
  }

} else {
  $authUrl = $client->createAuthUrl();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="google-signin-client_id" content="737582773898-s4mm5icfspplc31ifolic1cl5fncnj14.apps.googleusercontent.com">
    <!-- <link rel="shortcut icon" href="assets/ico/favicon.png"> -->

    <title>IT Service Desk</title>

    <!-- Icons -->
    <link href="requestor/css/font-awesome.min.css" rel="stylesheet">
    <link href="requestor/css/simple-line-icons.css" rel="stylesheet">

    <!-- Main styles for this application -->
    <link href="requestor/css/style.css" rel="stylesheet">

    <style type="text/css">
        .abcRioButtonBlue {
            margin: 0 auto;
        }
    </style>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/oauthpopup.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
         $('button.login').oauthpopup({
                path: '<?php if(isset($authUrl)){echo $authUrl;}else{ echo '';}?>',
                width:650,
                height:350,
            });
    });
    </script>

</head>

<body class="app flex-row align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card-group mb-0">
                    <div class="card p-4">
                        <div class="card-block">
                            <img src="requestor/img/solar-logo.png" width="60%" style="display: block; margin: 0 auto;"><br><br>
                            <?php
                              if(isset($authUrl)) {
                                print '<button class="loginBtn loginBtn--google login" style="display: block; margin: 0 auto;">
                                      Login with Google
                                    </button>';
                              }
                            ?>
                        </div>
                    </div>
                    <div class="card card-inverse card-primary py-5 d-md-down-none" style="width:44%">
                        <div class="card-block text-center">
                            <div>
                                <h2>IT Service Desk</h2>
                                <p>Welcome to IT Service Desk!</p>
                                <p>Please sign in using your authorized Solar Philippines Google account.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Bootstrap and necessary plugins -->
    
    <script src="requestor/bower_components/tether/dist/js/tether.min.js"></script>
    <script src="requestor/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- <script src="https://apis.google.com/js/platform.js" async defer></script> -->

    <!-- <script type="text/javascript">
        function Google_signIn(googleUser) {
          var profile = googleUser.getBasicProfile();
          console.log(profile);

         //update_user_data(profile);
        }

        function update_user_date(response){
            $.ajax({
                type: "POST",
                dataType: 'json',
                data: response,
                url: 'check_user.php',
                success: function(data) {
                   if(data.error == 1)
                   {
                    alert('Something Went Wrong!');
                   }
                },
                error: function(xhr, status, thrown){
                    console.log("ERROR: " + status + " THROW: " + thrown + " XHR: " + xhr.responseText);
                }

            });
        }
    </script> -->

</body>

</html>
