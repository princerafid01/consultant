<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Expense Geeks : Connecting the Payments Industry</title>

    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <script type="text/css" src="js/bootstrap.min.js"></script>
</head>
<body>

<!----------Start Top Header---------->
<section class="header-area">
    <div class="col-md-2 col-sm-2 col-xs-12">
        <div class="logo">
            <img src="img/interface/logo.png" alt="1">
        </div>
    </div>
    <div class="col-md-4 col-sm-4 col-xs-12">
        <div class="search-container">
            <form action="index.php">
                <input type="text" placeholder="Search.." name="search">
                <button type="submit"><i class="fa fa-search"></i></button>
            </form>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-12">
        <ul>
            <li><a href="index.php">Sign Up</a></li>
            <li><a class="login.php" href="">Log In</a></li>
        </ul>
    </div>
</section>

<div class="sign-area">
    <div class="container">
        <div class="col-md-5 col-sm-6 col-xs-12">
            <div class="sign-box">
                <img src="img/interface/logo.png" alt="1">
                <h2>Sign Up With</h2>
                <ul>
                    <li><a href=""><img src="img/interface/facebook.png">Facebook</a></li>/
                    <li><a href=""><img src="img/interface/google.png">google</a></li>
                </ul>
                <div class="line"><p>or</p></div>
                <div class="form-area-full">
                    <div class="input-line">
                        <input class="form-control" placeholder="Display Name" type="Name">
                        <i class="fa fa-user"></i>
                    </div>
                    <div class="input-line">
                        <input class="form-control" placeholder="Enter Email" type="Name">
                        <i class="fa fa-envelope"></i>
                    </div>
                    <div class="input-line">
                        <input class="form-control" placeholder="Enter Phone" type="Name">
                        <i class="fa fa-phone"></i>
                    </div>
                    <div class="input-line">
                        <input class="form-control" placeholder="Enter Password" type="Password">
                        <i class="fa fa-key"></i>
                    </div>
                    <div class="input-line">
                        <input class="form-control" placeholder="Confirm Password" type="Password">
                        <i class="fa fa-key"></i>
                    </div>
                    <div class="input-check">
                        <input type="checkbox">
                        <p>Accept <a href="#">Terms and Conditions</a> and <a href="#">Privacy Policy</a></p>
                    </div>
                    <a class="btn btn-form" href="geeks.php">Sign Up</a>
                    <h5>Already have an account?<a class="btn btn-login">Login</a></h5>
                </div>
            </div>
        </div>
        <div class="col-md-7 col-sm-6 col-xs-12">
            <div class="img-box">
                <img src="img/interface/sign-img.png">
            </div>
        </div>
    </div>
</div>

<section class="footer-first">
    <div class="container">
        <p>2020 Expense Geeks LLC</p>
        <ul>
            <li><a target="blank" href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
            <li><a target="blank" href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
            <li><a target="blank" href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
            <li><a target="blank" href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
        </ul>
    </div>
</section>

<!--------------Begin: Javascript---------------->
<script src="js/jquery-2.1.1.js"></script>
<script src="js/bootstrap.min.js"></script>

<!------For Active Menu------>
<script>
$(document).ready(function() {
 var url = window.location.href;
 url = url.substring(0, (url.indexOf("#") == -1) ? url.length : url.indexOf("#"));
 url = url.substring(0, (url.indexOf("?") == -1) ? url.length : url.indexOf("?"));
 url = url.substr(url.lastIndexOf("/") + 1);
 if(url == ''){
 url = 'index.php';
 }
 $('.navbar-area li').each(function(){
  var href = $(this).find('a').attr('href');
  if(url == href){
   $(this).addClass('active');
  }
 });
});
</script>

</body>
</html>