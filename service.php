<?php
    class Service{
        
        private $api_key, $service;

        public function __construct(){
            $this->service = "https://www.googleapis.com/youtube/v3/search?part=+snippet&videoDefinition=any&type=video";
            $this->api_key="AIzaSyAO6etk23XszDz_pnVyB0OPJXfS4O1cgF8";
        }

        public function request($search){
           $request = $this->service."&q=".urlencode($search)."&maxResults=10&key=".$this->api_key;
           $result=$this->req($request);

           return json_decode($result);
        }
        private function req($Url){
            if (!function_exists('curl_init')){ 
                die('CURL is not installed!');
            }
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $Url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $output = curl_exec($ch);
            curl_close($ch);
            return $output;
        
        }
    }
?>
