{% extends 'templates/default.php'%}
{% block title %}
tracks
{% endblock%}
{% block content %}
<div class="columns is-multiline is-mobile">
{% for track in tracks %}
    {% if track.streamable %}
    <div class="column">
        <div class="card">
          <div class="card-image">
            <figure class="image is-4by3">
              <img src="{{track.artwork_url}}" alt="">
            </figure>
          </div>
          <div class="card-content">
            <div class="media">
              <div class="media-left">
                <figure class="image is-32x32">
                  <img src="{{track.user.avatar_url}}" alt="Image">
                </figure>
              </div>
              <div class="media-content">
                <p class="title is-5">{{track.title|truncate(35, false,'...')}}</p>
                <p class="subtitle is-6">@{{track.user.full_name}}</p>
              </div>
            </div>

            <div class="content">
              {{track.description |truncate(50, true,'...')}}
              <br>
              <small>{{ track.created_at|date("d/M/Y") }}</small>
            </div>
            <div class="content">
                <a class="button is-light" href="{{ track.permalink_url}}">
                    <span>Preview</span>
                    <span class="icon">
                    <i class="fa fa-play"></i>
                    </span>
                </a>
                <a class="button is-primary is-inverted" href="/fasttube/download?title={{track.title|url_encode}}&url={{ track.uri}}" target="_blank">
                    <span>Download</span>
                    <span class="icon">
                    <i class="fa fa-download"></i>
                    </span>
                </a>
            </div>
          </div>
        </div>
    </div>
{% endif %}
{% endfor %}
</div>

{% endblock%}