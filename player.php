<?php
    $videoId;
    $query;
    $returnURL;

    if(isset($_GET['v'])&& isset($_GET['q'])){
        $videoId = $_GET['v'];
        $query= $_GET['q'];
        $returnURL = "index.php?q={$query}";
    }else{
        header('location:index.html');
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
        <meta name="msapplication-navbutton-color" content="#ec5959"/>
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
                <!-- /.navbar-collapse -->
              </div><!-- /.container-fluid -->
            </nav><!--end navbar-->
            <div class="row">
                <div class="col-xs-4 col-md-2">
                    <a href="<?php echo $returnURL;?>" class="btn btn-sm btn-primary" ><span class="glyphicon glyphicon-chevron-left"></span>back</a>
                </div>
            </div>
        <div class="row">
             <div class="col-xs-12">
                 <section class="row">
                      <div class="span6">
                        <div class="flex-video widescreen">
                            <iframe id="ytplayer"
                              src="http://www.youtube.com/embed/<?php echo $videoId?>?autoplay=0&origin=http://tawazz.net"
                              frameborder="0">
                            </iframe>
                        </div>
                      </div>
                      <div class="span6">
                      </div>
                  </section>
                
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
