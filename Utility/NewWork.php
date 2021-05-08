<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2019-02-15
 * Time: 12:00
 */

namespace EasySwoole\robot\Utility;


use EasySwoole\HttpClient\HttpClient;

class NewWork
{
    public static $TIMEOUT = 15;

    public static function get($endpoint, $data, $options = [])
    {
        $client = new HttpClient($endpoint);
        if (!empty($options)) {
            foreach ($options as $key => $value) {
                $client->setClientSetting($key, $value);
            }
        }
        $client->setQuery($data);
        return $client->get();
    }

    public static function post($endpoint, $data, $options = [])
    {
        $client = new HttpClient($endpoint);
        if (!empty($options)) {
            foreach ($options as $key => $value) {
                $client->setClientSetting($key, $value);
            }
        }
        return $client->setTimeout(self::$TIMEOUT)->post($data);
    }

    public static function postJson(string $endpoint, string $data, $options = [])
    {
        $client = new HttpClient($endpoint);
        $client->setTimeout(self::$TIMEOUT);
        if (!empty($options)) {
            foreach ($options as $key => $value) {
                $client->setClientSetting($key, $value);
            }
        }
        return $client->postJson($data);
    }

    public static function postXML(string $endpoint, string $data, $options = [])
    {
        $client = new HttpClient($endpoint);
        $client->setTimeout(self::$TIMEOUT);
        if (!empty($options)) {
            foreach ($options as $key => $value) {
                $client->setClientSetting($key, $value);
            }
        }
        return $client->postXml($data);
    }


    public static function getRequest($url,$items=[],$headers =[]) {


//        if(strpos($url,"?") && !empty($items)) {
//            $url = $url."&".http_build_query($items);
//        } else if(!empty($items)) {
//            $url  = $url."?".http_build_query($items);
//        }
        $st = "";
        foreach ($items as $k=>$v) {
            $st .= "{$k}={$v}&";
        }
        $st = rtrim($st,"&");
        if(!empty($st)) {
            $url = $url."?".$st;
        }




        track_debug($url);
        $ch = curl_init($url);

//        echo $str;exit;
//        echo $url;exit;
//        $host = "127.0.0.1";
//        $port = "8888";
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

//        curl_setopt($ch, CURLOPT_PROXY, $host);
//        curl_setopt($ch, CURLOPT_PROXYPORT, $port);

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
//        curl_setopt($ch, CURLOPT_POSTFIELDS,$items);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            track_error(" getRequest($url,$items,$headers =[]) failed:".curl_error($ch));
        }
        curl_close($ch);
        return $result;
    }

    public static function jsonGet($url,$items=[],$headers =[]) {
        $ret = self::getRequest($url,$items,$headers );
        return json_decode($ret,true);
    }
}