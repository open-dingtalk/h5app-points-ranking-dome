<?php 
Class apiGetToken{

	  private $config;
	  public $token;

	  public function __construct($obj){

	  		 $this->config = $obj;
	  		 $this->token = $this->getToken();
	  }

	  public function getToken(){


	  		$appkey = $this->config->obj->getAppKey();

	  		$AppSecret = $this->config->obj->getAppSecret();

	  		return $token = $this->config->get("gettoken",['appkey'=>$appkey,"appsecret"=>$AppSecret]);

	  }
}