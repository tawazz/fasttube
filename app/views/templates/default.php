<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>tazzy|{% block title%}{% endblock %}</title>
        <!-- Mobile viewport optimized -->
    		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
            <!-- Bootstrap CSS -->
    		<link href="/fasttube/css/bootstrap.css" rel="stylesheet">
    		<link href="/fasttube/css/bootstrap-glyphicons.css" rel="stylesheet">
    		<link href="/fasttube/css/bootstrap-datetimepicker.css" rel="stylesheet">
    		<link href="/fasttube/css/bootstrapValidator.css" rel="stylesheet">
    		<link href="/fasttube/css/bootstrap-slider.css" rel="stylesheet">
    		<link href="/fasttube/css/bootstrap-dialog.min.css" rel="stylesheet">
    		<link href="/fasttube/css/bootstrap-dialog.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="/fasttube/css/main.css"/>
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
         <!--javascript-->
        <script src="/fasttube/scripts/modernizr-2.6.2.min.js"></script>
        <script type="text/javascript" src="/fasttube/scripts/jquery.js"></script>
        <script src="search.js" type="text/javascript"></script>
        <meta name="description" content="ajay based youtube searching web app"/>
        <meta name="msapplication-navbutton-color" content="#e74944"/>
        <link rel="shortcut icon" href="/fasttube/images/icon.png"/>
    </head>
    <body>

      {% include 'parts/nav.php' %}
      {% include 'parts/search.php' %}
      {% include 'parts/flash.php' %}
      {% block content %}

      {% endblock %}

      <!-- Bootstrap JS -->
    <!--script src="/fasttube/scripts/bootstrap.min.js"></script--><!--Causing dropdown bug , needs more testing-->
    <script src="/fasttube/scripts/bootstrap.js"></script>
    <script src="/fasttube/scripts/moment.js"></script>
    <script src="/fasttube/scripts/bootstrap-datetimepicker.min.js"></script>
    <script src="/fasttube/scripts/bootstrap-datetimepicker.js"></script>
    <script src="/fasttube/scripts/bootstrapValidator.js"></script>
    <script src="/fasttube/scripts/bootstrap-slider.js"></script>
    <script src="/fasttube/scripts/bootstrap-filestyle.min.js"></script>
    <script src="/fasttube/scripts/bootstrap-dialog.min.js"></script>
    <script src="/fasttube/scripts/bootstrap-dialog.js"></script>
    </body>
</html>
