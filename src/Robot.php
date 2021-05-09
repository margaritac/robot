<?php
/**
 * @CreateTime:   2021-05-08 14:00:00
 * @Author:       kk  <1228196390@qq.com>
 * @Copyright:    copyright(2020) Easyswoole all rights reserved
 * @Description:  编码工具
 */
namespace EasySwoole\Robot;

use EasySwoole\robot\Utility\NewWork;

class Robot
{

    public function start($arr,$url,$accessToken)
    {
        $vo = [
            'account_id'=>'123321',
            'currency'=>'bian',
            'type'=>'wangge',
            'param'=>'123321',
            'sub_type'=>'1',
        ];
        print_r($vo);
        $arr['vo'] = $vo;
        $arr['state'] = 1;
        return json_encode($arr);
        return $this->setWithArgs($vo,$state,$url,$accessToken);
    }

    public function setWithArgs($vo,$state,$url,$accessToken)
    {
        $times = $vo['sub_type']??$vo['times'] ;
        if($times<1) {
            $times =1 ;
        }//sub_type就是times，times返回值是已经补仓的次数
        $params = [
            'access_token'=>$url,
            'account_id'=>$vo['account_id'],
            'currency'=>$vo['currency'],
            'type'=>$vo['type'],
            'param'=>$vo['param'],
            'state'=>intval($state),
            'times'=>$times
        ];
        $ret = NewWork::jsonGet($url.'set_bot' ,$params);
        //$ret = RequestUtil::jsonGet($this->url.'set_bot' ,$params);
        //track_error("设置机器人返回:".json_encode($ret,JSON_UNESCAPED_UNICODE));

        if($ret['code'] == 200) {

            return true;
        } else {
            return false;
        }
    }


}
