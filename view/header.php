<!DOCTYPE html>
<html lang = "en">
<meta charset="utf-8">
<meta name = "viewport" content="width=device-width, initial-scale = 1.0">
<head>
	<link rel="stylesheet" type="text/css" href="public/css/bootstrap.min.css">
	<script type="text/javascript" src = "public/js/jquery.min.js"></script>
	<script type="text/javascript" src = "public/js/bootstrap.min.js"></script>

	<style>
	html, body {
                background-color: #1f1f1f;
                color: white;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

	</style>
	<?php 
    if (isset($this->js)) 
    {
        foreach ($this->js as $js)
        {
            echo '<script type="text/javascript" src="'.URL.'view/'.$js.'"></script>';
        }
    }
    ?>

	<title>Myelination</title>

</head>
<body>
	<nav class="navbar navbar-default justify-content-center" style = "font-family: 'Nunito', sans-serif; background-color: rgba(0,0,0,.5);border-color: rgba(0,0,0,.5);">
		<div class="container-fluid">
			<div class="navbar-header">
				<a href="#" class="navbar-brand">myelination</a>
				<!--<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>-->
			</div>

			<!--<div class="navbar-collapse" id = "menu">-->
				<!--<ul class="nav navbar-nav navbar-right">-->
					<!--<li><a href="home" style = "color:white;">Home</a></li>-->
					<!--<li><a href="#"  style = "color:white;">Contact</a></li> -->
					<!--<li><a href="#"  style = "color:white;">About</a></li> -->
				<!--</ul>-->
			<!--</div>-->
			
		</div>
	</nav>
