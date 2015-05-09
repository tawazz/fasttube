<?php
    class SCservice{
        private $api_key, $service;

        public function __construct(){
            $this->service = "https://api.soundcloud.com/tracks.json?";
            $this->api_key="0120297111908d39612578eb181ed3c7";
        }

        public function request($query){
            $query = urlencode($query);
           $request = $this->service."q=".$query."&limit=15&client_id=".$this->api_key;
           $open =fopen($request, "rb");
           $result =stream_get_contents($open);
           fclose($open);

           return json_decode($result);
        }

        public function download($url){
            $request = $url."?client_id=".$this->api_key;
            $open =fopen($request, "rb");
            $result =stream_get_contents($open);
            fclose($open);

            return $result;
        }
    }
?>