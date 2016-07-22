{% extends 'templates/default.php'%}
{% block title %}
tracks
{% endblock%}
{% block content %}
<div class="container">
  <div class="col-xs-12">
    <div class="chat-panel panel panel-default">
      <div class="panel-heading">
          <i class="fa fa-music fa-fw"></i>
          Explore
      </div>
      <div class="panel-body">
          
          <ul class="chat">
            {% for track in tracks %}
{% if track.streamable %}
            <li class="left clearfix">
                <span class="chat-img">
                    <img src="{{ track.artwork_url}}" alt="Art Work" />
                </span>
                <div class="chat-body clearfix">
                    <div class="header">
                        <strong class="primary-font">{{ track.title}}</strong>
                        <small class="pull-right text-muted">
                            <i class="fa fa-clock-o fa-fw"></i> {{ track.created_at|date("d/M/Y") }}
                        </small>
                    </div>
                    <p>
                        {{track.description}}
                    </p>
                    <div class="chat-footer">
                      <a href="/fasttube/download?title={{track.title|url_encode}}&url={{ track.uri}}" target="_blank" class="btn btn-primary">Download</a>
                      <a href="{{ track.permalink_url}}" target="_blank" class="btn btn-primary">Play on Soundcloud</a>
                    </div>
                </div>

            </li>
 {% endif %}
            {% endfor %}
        </ul>
    </div>
    <!-- /.panel-body -->
  </div>
<!-- /.panel .chat-panel -->
  </div>
</div>

{% endblock%}
