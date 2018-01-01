<?php
namespace App\Http\traits;

/**
 * ping百度相关操作
 * User: timeless
 * Date: 18-1-1
 * Time: 上午11:36
 */
trait pingbaidu
{
    /**
     * 程序主动推送
     */
    public function pingBaidu($urls)
    {
//        $urls = array(
//            'http://www.example.com/1.html',
//            'http://www.example.com/2.html',
//        );
        $api = 'http://data.zz.baidu.com/urls?site=dyxz2018.com&token=lS8Clzeqh2U9hPpa';
        $ch = curl_init();
        $options = array(
            CURLOPT_URL => $api,
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS => implode("\n", $urls),
            CURLOPT_HTTPHEADER => array('Content-Type: text/plain'),
        );
        curl_setopt_array($ch, $options);
        $result = curl_exec($ch);
        $result_str = print_r($result, true) . '_________________________________\r\n';
        file_put_contents('pingbaidu.txt', $result_str, FILE_APPEND);
    }
}