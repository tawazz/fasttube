<?php
namespace HTTP\Models;
    class SoundCloud{
        private $api_key, $service,$master_key,$app_version;

        public function __construct(){
            $this->service = "https://api.soundcloud.com/tracks.json?";
            $this->api_key="2t9loNQH90kzJcsFCODdigxfp325aq4z";
	    $this->master_key = "2t9loNQH90kzJcsFCODdigxfp325aq4z";
            $this->app_version = "1489155300";
        }

        public function request($query){
           $query = urlencode($query);
           $request = $this->service."q=".$query."&limit=50&client_id=".$this->api_key;
           $open =fopen($request, "rb");
           $result =stream_get_contents($open);
           fclose($open);
           $result = json_decode($result);
           foreach ($result as $track) {
               $track->artwork_url = str_replace("large","crop",$track->artwork_url);
           }
           return $result;
        }

		 public function requestUser($query){
           $query = urlencode($query);
           $request = "https://api.soundcloud.com/users.json?"."q=".$query."&limit=50&client_id=".$this->api_key;
           $open =fopen($request, "rb");
           $result =stream_get_contents($open);
           fclose($open);

           return json_decode($result);
        }

        public function resolve($url)
        {
          $request = "http://api.soundcloud.com/resolve?url=".$url."&client_id=".$this->master_key;
          $open =fopen($request, "rb");
          $result =stream_get_contents($open);
          fclose($open);
          $result = json_decode($result);

          return $result;
        }

        public function userTracks($id)
        {
          $request = "http://api.soundcloud.com/users/{$id}/favorites?client_id={$this->api_key}";
          $open =fopen($request, "rb");
          $result =stream_get_contents($open);
          fclose($open);
          return json_decode($result);
        }
        public function explore($cat=null)
        {
          if (isset($cat)) {
              $request = "https://api.soundcloud.com/explore/sounds/category/{$cat}?limit=50&offset=0&linked_partitioning=1&client_id={$this->api_key}";
          }else{

            //$request = "https://api-v2.soundcloud.com/explore/Popular+Music?tag=out-of-experiment&limit=50&offset=0&linked_partitioning=1&client_id={$this->api_key}";
            $request ="https://api-v2.soundcloud.com/charts?kind=top&genre=soundcloud%3Agenres%3Aall-music&client_id=".$this->master_key."&limit=50&offset=0&linked_partitioning=1&app_version=".$this->app_version;
          }
          $open =fopen($request, "rb");
          $result =stream_get_contents($open);
          fclose($open);
          return json_decode($result);
        }
        public function download($url){
            $request = $url."?client_id=".$this->master_key;
            $open =fopen($request, "rb");
            $result =stream_get_contents($open);
            fclose($open);
            return $result;
        }

    }
?>
