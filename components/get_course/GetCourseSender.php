<?php
namespace app\components\get_course;

use Yii;

/**
 * Class GetCourseSender
 * @package app
 */
class GetCourseSender
{
    public $accessToken;
    public $accountUrl;

    /**
     * @param $action
     * @param $params
     * @return bool
     * @throws \Exception
     */
    public function send($action, $params)
    {
        $url = $this->getFullUrl();

        if(empty($this->accessToken)) {
            throw new \Exception("Token not supplied");
        }
        if(empty($action)) {
            throw new \Exception("Action not supplied");
        }

        $curl = curl_init($url);

        $options = [];
        $options['key'] = $this->accessToken;
        $options['action'] = $action;
        $options['params'] = base64_encode(json_encode($params));

        curl_setopt ($curl, CURLOPT_USERAGENT, 'GetCourseAdapterTool');
        curl_setopt ($curl, CURLOPT_POST, 1);
        $query = http_build_query($options);
        curl_setopt ($curl, CURLOPT_POSTFIELDS, $query);
        curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        //curl_setopt($curl, CURLOPT_VERBOSE, 1);
        curl_setopt ($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt ($curl, CURLOPT_SSL_VERIFYHOST, 0);
        $body = curl_exec ($curl);

        $result = new \StdClass();
        $result->status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $result->body = $body;
        curl_close ($curl);

        if($result->status_code == 200){
            Yii::info("Successfully sent:\r\n".$result->body, 'get-course');
            return true;
        } else {
            Yii::error("Error while sending:\r\n".$result->body, 'get-course');
            return false;
        }
    }

    /**
     * @return string
     * @throws \Exception
     */
    private function getFullUrl() {
        if(empty($this->accountUrl)) {
            throw new \Exception("Account url not supplied");
        }
        return 'https://' . $this->accountUrl . '/pl/api/';
    }


}