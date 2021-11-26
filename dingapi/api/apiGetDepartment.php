<?php

class apiGetDepartment
{

    private $config;     //配置

    private $userList;

    public function __construct($obj, $userList = [])
    {
        $this->config = $obj;
        $this->userList = $userList;
    }

    public function getDepartmentList($accessToken)
    {

        $list = $this->config->post("topapi/v2/department/listsub", ['access_token'=>$accessToken], '');
        if ($list->errcode=='0') {
            return $department = $list->result;
        } else {
            return [];
        }

    }

    public function getDeptUser($accessToken, $dept_id)
    {

        $list = $this->config->post("topapi/user/listsimple", ['access_token'=>$accessToken], json_encode(['dept_id'=>$dept_id,'cursor'=>'0','size'=>'50']));
        if ($list->errcode=='0') {
            return $department = $list->result;
        } else {
            return [];
        }

    }

}