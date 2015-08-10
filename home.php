
<!DOCTYPE html>

<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">

	<link href="css/bootstrap.min.css" rel="stylesheet">

	<link href="css/smoothState.css" rel="stylesheet">

	<link href="css/jquery.tagsinput.css" rel="stylesheet">


    <script type="text/javascript" charset="utf-8" src="lib/jquery.min.js"></script>

	<script type="text/javascript" src="lib/bootstrap.min.js"></script>

	<script type="text/javascript" src="lib/masonry.pkgd.min.js"></script>

	<script type="text/javascript" src="lib/jquery.tagsinput.js"></script>


<title>CarSeva</title>

<style>
.thumbnails{
	float:left;
}
	
.thumbnail{
	width:30%;
	height:35%;
	margin-top:3%;
	margin-left:2%;
	float:left;
	
}

.well {
	width:100%;
	height:100%;
}

div.thumbnail {
    position: relative;
    /*width: 200px;
    height: 200px;*/
    background: #F8F8F8;
    color: #000;
    padding: 20px;    
}
 
div.thumbnail:hover {
    cursor: hand;
    cursor: pointer;
    opacity: .9;
}
 
a.divLink {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    text-decoration: none;
    z-index: 10;
    background-color: white;
    opacity: 0;
    filter: alpha(opacity=0);
}

</style>

<script>

$(document).ready(function(){

	for(var i=1;i<=6;i++){
        var div = '<div class="thumbnail"><div style="height:100%;width:100%;overflow:hidden;"><img src="images/'+i+'.jpg" height="100%" width="100%"></div><a class="divLink" id="'+i+'"></a></div>';
        $("#thumbnails").append(div);   
    }

	$(".thumbnail").click(function(){
        var clicked = $(this).find("a:first").attr("id");
        clearContainer();               
        detailsPage(clicked);
    });

    $("#carseva").click(function(){
    	location.reload();
    });

    $("#logout").click(function(){
    	jQuery.ajax({
        	url: 'logout.php',
        	type: 'GET',
        	
        	dataType : 'json',
        	success: function(data, textStatus, xhr) {
        		console.log(data); // do with data e.g success message
        	},
        	error: function(xhr, textStatus, errorThrown) {
            	console.log(textStatus.reponseText);
        	}
    	});
    	window.location.href = "index.php";
    });

});

function clearContainer(){
    $("div .thumbnail").remove();
}

function detailsPage(clicked){
	$("#thumbnails").append("<p>This is the details page</p>")
}


</script>
</head>
<body>
	<div class="page-header" style="background-color:#333;margin-top:-20px">
		<button id="logout" class="btn btn-sm default pull-right" style="margin-top:5%;margin-left:1%;margin-right:2%;background-color:#a9a9a9">Log Out</button>
		<br><br>
		<h1><a id="carseva"><span style="margin-left:5%;color:white;margin-top:2%;">Car</span><span style="color:#cc0033;">Seva</span></a	></h1>
	</div>

	<div class="container">
		<div class="col-lg-12">
    		<div class="input-group">
      			<input type="text" class="form-control" placeholder="Search for...">
      			<span class="input-group-btn">
        			<button class="btn btn-default" type="button">Search!</button>
      			</span>
    		</div><!-- /input-group -->
  		</div><!-- /.col-lg-6 -->
  		<br><br><br>
  		<!--Masonry Container starts here-->
  		<div class="row" style="margin-top:2%; background-color:#E0E0E0;">
            <div class = "tiles">
                <div class="masonry-container" id="thumbnails">
                </div>
            </div>
        </div>

    </div><!--Container div ends here-->

    <br><br>
    <!--Footer starts here-->
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

