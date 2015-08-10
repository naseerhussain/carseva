<?php
	session_start();
	echo "hi this is index.php file";
	echo $_SESSION['mobile'];
	if(isset($_SESSION['mobile']) && isset($_SESSION['pwd']))
	{
		header('Location: home.php');
	}
?>
<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">

	<link href="css/bootstrap.min.css" rel="stylesheet">

	<link href="css/smoothState.css" rel="stylesheet">


    <script type="text/javascript" charset="utf-8" src="lib/jquery.min.js"></script>

	<script type="text/javascript" src="lib/bootstrap.min.js"></script>

	<script type="text/javascript" src="lib/masonry.pkgd.min.js"></script>


	<title>CarSeva</title>
	<style type="text/css">
		.white{
			color: white;
		}

		.join-btn{
			  	font-weight: bold;
  				border-width: 1px;
  				border-style: solid;
  				cursor: pointer;
  				margin: 0;
  				overflow: visible;
  				text-decoration: none !important;
  				text-align: center;
  				text-shadow: 0 1px 1px rgba(255,255,255,0.75);
  				border-radius: 3px;
  				padding: 0 15px;
  				height: 34px;
  				line-height: 32px;
  				-webkit-box-sizing: border-box;
  				-moz-box-sizing: border-box;
  				-box-sizing: border-box;
  				font-size: 16px;
  				color: #333;
  				background-color: #f6e312;
  				border-color: #e9ac1a;
  				zoom: 1;
  				vertical-align: middle;
  				width: 100%;
 				margin-top: 15px;
  				margin-bottom: 0;
		}
	</style>
	<script type="text/javascript">
		$(document).ready(function(){

			$("#join").click(function(){
				var valid = validate();

				var name = $("#signupName").val();
				var email = $("#signupEmail").val();
				var mobile = $("#signupMobile").val();
				var password = $("#signupPwd").val();

				if(valid){
					if (window.XMLHttpRequest) {
                        // code for IE7+, Firefox, Chrome, Opera, Safari
                        xmlhttp = new XMLHttpRequest();
	                } else {
                       // code for IE6, IE5
                       xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    	            }
        	        xmlhttp.onreadystatechange = function() {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                                //document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
                                console.log(xmlhttp.responseText);
                        }
            	    }
                	xmlhttp.open("GET","saveDetails.php?name="+name+"&email="+email+"&mobile="+mobile+"&password="+password, true);
                	xmlhttp.send();

				}
			});

			$("#signIn").click(function(){
				var mobile = $("#mobile").val();
				var pwd = $("#password").val();

				if(mobile == ""){
					alert("Enter Mobile Number");
					return false;
				}
				if(pwd == ""){
					alert("Enter Password");
					return false;
				}

				if (window.XMLHttpRequest) {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
	            } else {
                    // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    	        }
        	    xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        //document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
                        //console.log(xmlhttp.responseText);
                        var details = xmlhttp.responseText;
                        details = JSON.parse(details);
                        
                        if(details.length > 0){
                        	console.log(details[0].mobile);
                        	if(mobile == details[0].mobile){
                        		if(pwd == details[0].password){

                        			jQuery.ajax({
        								url: 'storesession.php',
        								type: 'POST',
        								data: {
            								mobile: details[0].mobile,
            								pwd: details[0].password
        								},
        								dataType : 'json',
        								success: function(data, textStatus, xhr) {
            								console.log(data); // do with data e.g success message
        								},
        								error: function(xhr, textStatus, errorThrown) {
            								console.log(textStatus.reponseText);
        								}
    								});
    								window.location.href = "home.php";
                        		}else{
                        			alert("Invalid Password");
                        		}
                        	}else{
                        		alert("Invalid Mobile");
                        	}
                        }else{
                        	alert("Invalid Mobile Number or Password");
                        }
                    }
            	}
                xmlhttp.open("GET","getDetails.php?mobile="+mobile, true);
                xmlhttp.send();


			});
		});

		function validate(){
			var name = $("#signupName").val();
			var email = $("#signupEmail").val();
			var mobile = $("#signupMobile").val();
			var password = $("#signupPwd").val();
			var Confirm = $("#signupConfpwd").val();

			if(name == ""){
				alert("Enter Name");
				return false;
			}
			if(email == ""){
				alert("Enter Email");
				return false;
			}
			if(mobile == ""){
				alert("Enter Mobile Number");
				return false;
			}
			if(password == ""){
				alert("Enter Password");
				return false;
			}
			if(Confirm == ""){
				alert("Enter Password again");
				return false;
			}
			if(password != Confirm){
				alert("Password and Confirm Password is not same");
				return false;
			}
			return true;
		}
	</script>
</head>
<body>
	<div class="page-header" style="background-color:#333;margin-top:-20px">
		<button class="btn btn-sm default pull-right" style="margin-top:3%;margin-left:1%;margin-right:2%;background-color:#a9a9a9" id="signIn">Sign In</button>
		<input type="password" class="pull-right" placeholder="  Password" id="password" style="margin-top:3%;margin-left:1%;">
		<input type="text" class="pull-right" placeholder="  Mobile Number" id="mobile" style="margin-top:3%;">
		<br><br>
  		<h1><span style="margin-left:5%;color:white;margin-top:2%;">Car</span><span style="color:#cc0033;">Seva</span></h1>

	</div>
	<div class="container">
		<div class="row">
            <div class="col-sm-6 col-md-4 col-md-offset-4" style="background-color:#686868;margin-top:2%;">
                <h1 class="text-center login-title white">Sign Up</h1>
                <div class="account-wall">
                    <form class="form-signin">
                        <input type="text" placeholder="Name" id="signupName" class="form-control"></input><br/>
                        <input type="text" placeholder="Email Id" id="signupEmail" class="form-control"></input><br/>
                        <input type="text" placeholder="Mobile Number" id="signupMobile" class="form-control"></input><br>
                        <input type="password" placeholder="Password" id="signupPwd" class="form-control"></input><br/>
                        <input type="password" placeholder="Confirm Password" id="signupConfpwd" class="form-control"></input><br/>
                        
                        <button id="join" class="btn btn-lg btn-primary join-btn">Join now</button>
                        <br><br>

                    </form>
                </div>
            </div>
        </div>

	</div><!--Container div ends here-->
    
    <br><br>
	<!--Footer starts from here-->
	<nav class="navbar navbar-default navbar-bottom" style="margin-bottom:0px !important;">
  		<div class="container" style="width:100%;">
   			<ul class="nav navbar-nav" style="width:100%;">
   				<li><br>About Us</li>
   				<li style="margin-left:30%;">
   					<ul>
   						<li>Contact Us</li>
   						<li>E-mail Us</li>
   						<li>Download App</li>
   					</ul>
   				</li>
   				<li style="margin-left:30%;"><div><br>Feedback : <input type="text" id="feedInput"><button id="feedback">Submit</button></div></li>
   			</ul>
  		</div>
	</nav>

	
</body>
</html>