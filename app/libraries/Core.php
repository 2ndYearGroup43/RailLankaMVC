<?php
    //Core app class
    class Core{
        protected $currentController= 'Pages';
        protected $currentMethod = 'index';
        protected $params = [];

        public function __construct()
        {
            $url =$this->getUrl();

            if($url==[]){//added to cope with the empty index problem change if further errors occur
                $url=array(0);
            }
            
            if(file_exists('../app/controllers/'.ucwords($url[0]).'.php')){ //ucwords will capitalize first letter
                $this->currentController = ucwords($url[0]);
                unset($url[0]);

            }
            //require the controller
            require_once '../app/controllers/'.$this->currentController.'.php';
            $this->currentController = new $this->currentController;
            
            if(isset($url[1])){
                if(method_exists($this->currentController, $url[1])){
                    $this->currentMethod = $url[1];
                    unset($url[1]);
                }
            }
            //get parameters
            $this->params = $url ? array_values($url) : [];

            //call a callback with array of parameters
            call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
            
        }



        public function getUrl(){
            if(isset($_GET['url'])){
                $url = rtrim($_GET['url'], '/'); 
                $url = filter_var($url, FILTER_SANITIZE_URL);//filter variable as string/number
                $url = explode('/', $url);//breaking it into an array 
                return $url;
            }
        }
    }