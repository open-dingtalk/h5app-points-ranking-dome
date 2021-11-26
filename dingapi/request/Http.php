<?php

//授权登录api
class Http
{
    public $url;
    public $header;
    public $openApi;

    public function __construct($obj, $url = "https://oapi.dingtalk.com/", $openApi = "")
    {
        $this->obj = $obj;
        $this->url = $url;
        $this->openApi = $openApi;
    }

    public function setHeader($header)
    {
        $this->header = $header;
    }

    /**
     * GET 请求
     * @param string $url
     * @param string $params
     */
    public function get($url, $params)
    {
        $oCurl = curl_init();
        $url = self::joinParams($url, $params);
        if (stripos($url, "https://") !== false) {
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($oCurl, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1);
        }
        curl_setopt($oCurl, CURLOPT_URL, $url);
        curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($oCurl, CURLOPT_VERBOSE, 1);
        curl_setopt($oCurl, CURLOPT_HEADER, false);
        curl_setopt($oCurl, CURLINFO_HEADER_OUT, false);
        $sContent = self::execCURL($oCurl);

        return $sContent;
    }

    /**
     * POST 请求
     *
     * @param string $url
     * @param array $param
     * @param boolean $post_file 是否文件上传
     *
     * @return string content
     */
    public function post($url, $params, $data, $post_file = false)
    {
        $oCurl = curl_init();
        $url = self::joinParams($url, $params);
        if (stripos($url, "https://") !== false) {
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($oCurl, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1);
        }
        if (PHP_VERSION_ID >= 50500 && class_exists('\CURLFile')) {
            $is_curlFile = true;
        } else {
            $is_curlFile = false;
            if (defined('CURLOPT_SAFE_UPLOAD')) {
                curl_setopt($oCurl, CURLOPT_SAFE_UPLOAD, false);
            }
        }

        if ($post_file) {
            if ($is_curlFile) {
                foreach ($data as $key => $val) {
                    if (isset($val["tmp_name"])) {
                        $data[$key] = new \CURLFile(realpath($val["tmp_name"]), $val["type"], $val["name"]);
                    } elseif (substr($val, 0, 1) == '@') {
                        $data[$key] = new \CURLFile(realpath(substr($val, 1)));
                    }
                }
            }
        }

        curl_setopt($oCurl, CURLOPT_URL, $url);
        curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($oCurl, CURLOPT_POST, true);
        curl_setopt($oCurl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($oCurl, CURLOPT_VERBOSE, 1);
        curl_setopt($oCurl, CURLOPT_HEADER, false);
        curl_setopt($oCurl, CURLINFO_HEADER_OUT, false);

        if ($post_file) {
            curl_setopt($oCurl, CURLOPT_HTTPHEADER, [
                'Content-Type: multipart/form-data',
            ]);
        } else {
            $header = [
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            ];
            if ($this->openApi) {
                array_push($header, $this->header);
            }
            curl_setopt($oCurl, CURLOPT_HTTPHEADER, $header);
        }

        $sContent = self::execCURL($oCurl);
        curl_close($oCurl);

        return $sContent;
    }

    /**
     * 执行CURL请求，并封装返回对象
     */
    private function execCURL($ch)
    {
        $response = curl_exec($ch);
        if ($this->openApi) {
            return json_decode($response);
        }
        if (curl_getinfo($ch, CURLINFO_HTTP_CODE) == '200') {
            return json_decode($response);
        }

        return null;
    }

    private function joinParams($path, $params)
    {

        $url = $this->url . $path;
        if (count($params) > 0) {

            $url = $url . "?";
            foreach ($params as $key => $value) {
                $url = $url . $key . "=" . $value . "&";
            }
            $length = strlen($url);
            if ($url[$length - 1] == '&') {
                $url = substr($url, 0, $length - 1);
            }
        }
        return $url;
    }
}