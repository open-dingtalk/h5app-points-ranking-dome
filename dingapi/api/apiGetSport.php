<?php

class apiGetSport
{

    private $config;     //配置

    private $userList;

    public function __construct($obj, $userList)
    {
        $this->config = $obj;
        $this->userList = $userList;
    }

    public function getSportCode($accessToken)
    {
        $user_list = implode(',',$this->userList);
        $list = $this->config->post("topapi/health/stepinfo/listbyuserid", ['access_token'=>$accessToken], json_encode(['userids' => $user_list, "stat_date" => date('Ymd',time())]));
        if ($list->errcode=='0') {
            return $sport = $list->stepinfo_list;
        } else {
            return [];
        }

    }

}