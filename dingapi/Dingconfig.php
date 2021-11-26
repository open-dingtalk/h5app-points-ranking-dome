<?php
Class Dingconfig{

	  private $appKey;

	  private $corpId;

	  private $AppSecret;

	  private $AgentId;

	  private $accessKey;   //第三方应用的 suiteKey

	  private $suiteSecret; //第三方应用

	  private $suiteId;     //第三方应用的套件id

	  private $appId;       //第三方应用id

	  private $api = "https://oapi.dingtalk.com/";

	  public function setAppKey($appKey){
	  	     $this->appKey = $appKey;
	  }

	  public function setCorpId($corpid){
	  	     $this->corpId = $corpid;
	  }

	  public function setAccessKey($accessKey){
	  		  $this->accessKey = $accessKey;
	  }

	  public function setAppSecret($AppSecret){
	  	     $this->AppSecret = $AppSecret;
	  }

	  public function setAgentId($AgentId){
	  		$this->AgentId = $AgentId;
	  }

	  public function setSuiteSecret($suiteSecret){
	  	    $this->suiteSecret = $suiteSecret;
	  }

	  public function setSuiteId($suiteId){
	  	    $this->suiteId = $suiteId;
	  }

	  public function setappId($appId){
	  	    $this->appId = $appId;
	  }

	  public function setApi($api){
	  	    $this->api = $api;
	  }

	  public function getAppKey(){
	  	     return $this->appKey;
	  }

	  public function getCorpId(){
	  	     return $this->corpId;
	  }

	  public function getAppSecret(){
	  		 return $this->AppSecret;
	  }

	  public function getAgentId(){
	  		 return $this->AgentId;
	  }

	  public function getAccessKey(){
	  	     return $this->accessKey;
	  }

	  public function getApi(){
	  	     return $this->api;
	  }

	  public function getSuiteSecret(){
	  	    return $this->suiteSecret;
	  }

	  public function getSuiteId(){
	  	    return $this->suiteId;
	  }

	  public function getappId(){
	  	    return $this->appId;
	  }

      public function HmacSHA256($parameter,$key){
      	     $sign = Base64_encode(hash_hmac('sha256',$parameter,$key,true));
      	     return  urlencode($sign);
      }	  
}