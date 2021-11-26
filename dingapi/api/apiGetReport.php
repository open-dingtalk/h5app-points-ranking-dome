<?php

class apiGetReport
{

    private $config;     //配置

    private $userList;

    public function __construct($obj, $userList)
    {
        $this->config = $obj;
        $this->userList = $userList;
    }

    public function getReportCode($accessToken)
    {
        $users = implode(',',$this->userList);
        $now = strtotime(date('Y-m-d',strtotime('-1 day')));
        $request = [
            'start_time' => $now.'000',
            'end_time' => time().'000',
            'userid' => $users,
            'cursor' => '0',
            'size' => '20',
        ];
        $list = $this->config->post("topapi/report/simplelist", ['access_token'=>$accessToken], json_encode($request));
        if ($list->errcode=='0') {
            return $report = $list->result;
        } else {
            return [];
        }

    }

}