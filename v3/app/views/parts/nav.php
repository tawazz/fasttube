<div class="hero-head">
    <nav class="nav has-shadow">
        <div class="container">
            <div class="nav-left">
              <a class="nav-item is-brand" href="#">
                <h1>{{brand}}</h1>
              </a>
            </div>

            <span class="nav-toggle">
              <span></span>
              <span></span>
              <span></span>
            </span>

            <div class="nav-right nav-menu">
                <a href="{{urlFor('home')}}" class="nav-item">Explore</a>
                <form class="nav-item" action="#" method="get">
                  <p class="control has-addons">
                      <input class="input" type="text" placeholder="Find a song" v-model="search" @submit.prevent="searchTracks()">
                      <a class="button is-primary" @click.prevent="searchTracks()">
                        Search
                      </a>
                  </p>
                </form>
            </div>
        </div>
    </nav>
</div>
<section class="hero is-danger is-medium">
  <div class="hero-body">
    <div class="container">
      <h1 class="title">
        SoundDown
      </h1>
      <h2 class="subtitle">
          download soundcloud songs for offline listening experience.
      </h2>
    </div>
  </div>
</section>
