<?php
    session_start();
    if(isset($_SESSION['user']) && isset($_SESSION['pass']) && isset($_SESSION['role']) ){
        header("location:index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LogIn</title>
    <link rel="icon" href="https://image.flaticon.com/icons/png/512/65/65155.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>


    <link rel="stylesheet" href="assets/css/LogIn-style.css">
</head>
<body>
    <div class="row" id="logIn-page">
        <h1><i class="fas fa-glass-cheers"></i> Live Orders</h1>
        <div id="page" class="col-lg-offset-4 col-lg-4 col-md-offset-4  col-md-4 col-sm-offset-3  col-sm-6 col-xs-offset-0 col-xs-12">
                <h3 id="logIn-header-label">LogIn Here</h3>
                <div id="fields">
                <form action="loginAuth.php" method="post">
                    <div class="form-group">
                        <div class="input-group">
                        <span class="input-group-addon" style="background:#eee;"> <i class="fa fa-user" style="font-size:14pt;"></i> </span>
                        <input type="text" name="username" placeholder="Username here..." required class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                        <span class="input-group-addon" style="background:#eee;"> <i class="fa fa-lock" style="font-size:14pt;"></i> </span>
                        <input type="password" name="password" placeholder="Password here..." required class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                    <center >
                        <a href='index.php' class="btn btn-danger" style="font-size:12pt; width:90px;border-radius:100px;" onclick="cancel()"><i class="fa fa-arrow-left"></i>Cancel</a>
                        <button type="submit" name="submit" class="btn btn-primary" style="font-size:12pt; width:90px;border-radius:100px;">Login <i class="fa fa-arrow-right"></i></button>
                    </center>
                </div>

                </form>
            </div>
        </div>
    </div>
</body>
</html>

<script>
    function cancel()
    {
        console.log("Hello");
        window.location = "../";
    }
	//removing watermark
	var obj = $("body").children("div").children("a");
	if(obj.attr("title") == "Hosted on free web hosting 000webhost.com. Host your own website for FREE.")
	{
		obj.parent().hide();
	}
</script>