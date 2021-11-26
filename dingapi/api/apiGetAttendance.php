<?php

class apiGetAttendance
{

    private $config;     //配置

    private $userList;

    public function __construct($obj, $userList)
    {
        $this->config = $obj;
        $this->userList = $userList;
    }

    public function getAttendanceCode($accessToken)
    {
        $now = date('Y-m-d',time());
        $request = [
            'workDateFrom' => $now.' 00:00:00',
            'workDateTo' => $now.' 23:59:59',
            'userIdList' => $this->userList,
            'offset' => '0',
            'limit' => '50',
        ];
        $list = $this->config->post("attendance/list", ['access_token'=>$accessToken], json_encode($request));
        if ($list->errcode=='0') {
            return $attendance = $list->recordresult;
        } else {
            return [];
        }

    }

}