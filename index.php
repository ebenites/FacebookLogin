<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        
        <script src="//code.jquery.com/jquery-3.1.1.min.js"></script>
        
        <!-- https://developers.facebook.com/docs/facebook-login/web -->
        <script>(function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.8&appId=613254335543514";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
        
        <script>
            function checkLoginState(){
                FB.getLoginStatus(function(response) {
                    console.log(response);
                    $('#message').empty();
                    if (response.status === 'connected') {
                        var id_token = response.authResponse.accessToken;
                        console.log('ID Token: ' + id_token);
                        
                        // Send to backend
                        $.get('signin.php', {'id_token': id_token}, function(data){
                            $('#message').html(data);
                            // window.location.href  = 'profile.php';
                        });
                        
                        // Or Call API Javascript
                        FB.api('/me?fields=id,name,picture,gender,email', function(response) {
                            console.log(response);
                            // document.getElementById('message').innerHTML = 'Bienvenido ' + response.name;
                        });
                    }
                });
            }
            
            window.fbAsyncInit = function() {
                checkLoginState();
            };
        </script>
        
    </head>
    <body>
        
        <!-- https://developers.facebook.com/docs/facebook-login/web/login-button -->
        <div class="fb-login-button" data-max-rows="1" data-size="xlarge" data-scope="public_profile,email" onlogin="checkLoginState()" data-auto-logout-link="true"></div>
        <div id="fb-root"></div>
        
        <div id="message"></div>
        
    </body>
</html>
