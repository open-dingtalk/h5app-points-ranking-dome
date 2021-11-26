<?php
define("PATH", dirname(__FILE__));
require("Autoloader.php");

$config = new Dingconfig;
$http   = new Http($config);
//应用appkey和appSecret
$config->setAppKey("dingfsmxe3tw84dkrlpn");
$config->setAppSecret("deNlF5xOeTN0bcVsYWvJrOV0YA_tbJfITQWb4dX4LcH_SQwhN5-ssawZ4QWvp4W-");
//获取提交参数
$dept_id = isset($_GET['dept_id'])?$_GET['dept_id']:'';
$data_type = isset($_GET['data_type'])?$_GET['data_type']:'';
//获取访问凭证
$apiGetToken  = new apiGetToken($http);
$CorpToken = $apiGetToken->getToken();
if ($CorpToken->errcode == '0') {
    $accessToken = $CorpToken->access_token;
} else {
    echo '获取授权凭证参数错误';
    die();
}
$res = [];
if ($data_type == 'code') {
    $userList = [];
    $apiGetDepartment = new apiGetDepartment($http, $userList);
    //此接口最多可获取50人
    $user = $apiGetDepartment->getDeptUser($accessToken,$dept_id);
    if (!empty($user)) {
        $users = $user->list;
        foreach ($users as $k => $v) {
            $res[$v->userid] = [
                'userid' => $v->userid,
                'name' => $v->name,
                'step_count' => '0',
                'sport_code' => '0',
                'attendance_code' => '0',
                'report_code' => '0'
            ];
            array_push($userList,$v->userid);
            $apiGetSport = new apiGetSport($http, $userList);
            $sport = $apiGetSport->getSportCode($accessToken);
            if (!empty($sport)) {
                foreach ($sport as $k => $v) {
                    if (isset($v->step_count)  && array_key_exists($v->userid, $res)) {
                        $res[$v->userid]['step_count'] = $v->step_count;
                        if ($v->step_count > 0) {
                            $res[$v->userid]['sport_code'] = '1';
                        }
                    }
                }
            }
            $apiGetReport = new apiGetReport($http, $userList);
            $report = $apiGetReport->getReportCode($accessToken);
            if (!empty($report->data_list)) {
                $report_list = $report->data_list;
                foreach ($report_list as $k => $v) {
                    if (array_key_exists($v->creator_id,$res)) {
                        $res[$v->creator_id]['report_code'] = '1';
                    }
                }
            }
            $apiGetAttendance = new apiGetAttendance($http, $userList);
            $attendance = $apiGetAttendance->getAttendanceCode($accessToken);
            if (!empty($attendance)) {
                foreach ($attendance as $k => $v) {
                    if (array_key_exists($v->userId,$res)) {
                        $res[$v->userId]['attendance_code'] = '1';
                    }
                }
            }
            $res = array_values($res);

        }
    }

} else {

    $apiGetDepartment = new apiGetDepartment($http);
    $department = $apiGetDepartment->getDepartmentList($accessToken);
    if (!empty($department)) {
        foreach ($department as $k => $v) {
            $temp = [
                'name'=>$v->name,
                'dept_id'=>$v->dept_id
            ];
            array_push($res,$temp);
        }
    }

}

echo json_encode($res,JSON_UNESCAPED_UNICODE);


