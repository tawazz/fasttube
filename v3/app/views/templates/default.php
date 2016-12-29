<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title></title>
        {% include "parts/css.php" %}
        {% block css %}{% endblock %}
    </head>
    <body>
        {% include "parts/nav.php" %}
		<div class="container is-fluid">
        {% block content %}{% endblock %}
		</div>
        {% include "parts/footer.php" %}
        {% include "parts/scripts.php" %}
        {% block js %}{% endblock %}
    </body>
</html>
