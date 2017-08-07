<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="CoreUI Bootstrap 4 Admin Template">
    <meta name="author" content="Lukasz Holeczek">
    <meta name="keyword" content="CoreUI Bootstrap 4 Admin Template">
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

</head>

<body class="app flex-row align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card-group mb-0">
                    <div class="card p-4">
                        <div class="card-block">
                            <img src="requestor/img/solar-logo.png" width="60%" style="display: block; margin: 0 auto;"><br><br>
                            <div class="g-signin2" data-longtitle="true" data-onsuccess="Google_signIn" data-theme="dark" data-width="200"></div>
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
    <script src="requestor/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="requestor/bower_components/tether/dist/js/tether.min.js"></script>
    <script src="requestor/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="https://apis.google.com/js/platform.js" async defer></script>

    <script type="text/javascript">
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
    </script>

</body>

</html>
