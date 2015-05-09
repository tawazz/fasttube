<?php
    if(isset($_GET['q'])){
        $keyword = $_GET['q'];
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>T-Tube</title>
        <!-- Mobile viewport optimized -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <!-- Bootstrap CSS -->
		<link href="css/bootstrap.css" rel="stylesheet">
		<link href="css/bootstrap-glyphicons.css" rel="stylesheet">
		<link href="css/bootstrap-datetimepicker.css" rel="stylesheet">
		<link href="css/bootstrapValidator.css" rel="stylesheet">
		<link href="css/bootstrap-slider.css" rel="stylesheet">
		<link href="css/bootstrap-dialog.min.css" rel="stylesheet">
		<link href="css/bootstrap-dialog.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/main.css"/>
         <!--javascript-->
        <script src="scripts/modernizr-2.6.2.min.js"></script>
        <script type="text/javascript" src="scripts/jquery.js"></script>
        <script src="search.js" type="text/javascript"></script>
        <meta name="description" content="ajay based youtube searching web app"/>
        <meta name="msapplication-navbutton-color" content="#e74944"/>
        <link rel="shortcut icon" href="images/icon.png"/>
    </head>
    <body>
        <div class="container">
            <nav class="navbar navbar-default navbar-fixed-top" role="navigation" >
              <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                  <a class="navbar-brand" href="index.php"><img src="images/icon.png" alt="logo" style=" margin-top: -7px;"></a>
                </div>
              </div><!-- /.container-fluid -->
            </nav><!--end navbar-->
        <div class="row">
             <div class="col-xs-12">
                <form name="search" onsubmit="return request()">
                    <div class="col-lg-6 col-lg-offset-3">
                        <div class="input-group">
                          <input type="text" name="query" value="<?php echo $keyword;?>" autocomplete="off" onkeyup="request()" class="form-control" placeholder="Search">
                          <span class="input-group-btn">
                            <button class="btn btn-default" type="button" onclick="request()">Search</button>
                          </span>
                        </div><!-- /input-group -->
                        <label class="radio-inline">
                            <input type="radio" name="service" value="youtube" checked onchange="request()"> Youtube
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="service" value="soundcloud" onchange="request()"> SoundCloud
                        </label>
                    </div><!-- /.col-lg-6 -->
                </form>
            </div>
            <div class="col-xs-12">
                <div id="response">
                    <!--seach results shows up here-->
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
	<!--script src="scripts/bootstrap.min.js"></script--><!--Causing dropdown bug , needs more testing-->
    <script src="scripts/bootstrap.js"></script>
    <script src="scripts/moment.js"></script>
	<script src="scripts/bootstrap-datetimepicker.min.js"></script>
	<script src="scripts/bootstrap-datetimepicker.js"></script>
	<script src="scripts/bootstrapValidator.js"></script>
	<script src="scripts/bootstrap-slider.js"></script>
	<script src="scripts/bootstrap-filestyle.min.js"></script>
	<script src="scripts/bootstrap-dialog.min.js"></script>
	<script src="scripts/bootstrap-dialog.js"></script>
    </body>
</html>
