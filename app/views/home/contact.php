{% extends 'templates/default.php' %}

{% block content %}
<div class="container">
  <div class="row">
    <div class="box">
      <div class="intro-text text-center">
          <h1>Contact Me<br><small>Let Me Know What I Can Do For You.</small></h1>
      </div>
      <div class="col-xs-12 col-sm-8 col-sm-offset-2">
        <form class="form-horizontal" action="{{urlFor('post.contact')}}" method="post" onsubmit="return validate(this);">
             <div class="form-group">
               <label for="input Name">Name</label>
               <input type="text" class="form-control" style="width: 100%;" name="name">
             </div>
             <div class="form-group">
               <label for="inputEmail" class="control-label">Email</label>
               <input type="email" class="form-control" name="email">
             </div>
             <div class="form-group">
               <label for="inputPhone" class="control-label">Phone</label>
               <input type="text" class="form-control" style="width: 100%;background:#ff;" name="phone">
             </div>
             <div class="form-group">
               <label for="inputTextArea" class="control-label">Message</label>
               <textarea name="msg" class="form-control" style="width: 100%" rows="10" ></textarea>
             </div>
               <input type="hidden" name="{{csrf_key}}" value="{{csrf_token}}">
             <div class="form-group">
                   <button type="submit" class="btn btn-info" style="padding: 8px 50px">Send</span></button>
             </div>
             </div>
         </form>
      </div>
    </div>

  </div>
</div>

{% endblock %}
