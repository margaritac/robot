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



    /*
    * 机器人设置判断
    */
    public function setrobot_judge($param,$type)
    {
        if($type=="wangge")
        {
            /**
            开仓金额开仓金额大于5，小于5000。 v1
            补仓次数？ v2
            止盈幅度必须大于0.8% v5
            止盈回调为0以上，但不能大于2% v6
            补仓幅度不能小于1%，小于1%提醒用户。同时不能大于90%。 v7
            连续下跌必须大于1%以上的百分比 v3

             * 开仓金额 v1
             * 补仓次数 v2
             * 止盈幅度 v3
             * 止盈回调 v4
             * 补仓幅度 v5
             * 补仓回调 v6
             * 是否平推 v7
             */
            if(empty($param['v1'])  && empty($param['v3']) && empty($param['v4']) && empty($param['v5']) && empty($param['v6']) && empty($param['v7']) )
            {
                $arr['code'] = 1;
                $arr['msg'] = '必填项不能为空';
                return $arr;
            }

            if(preg_match("/^[0-9]*$/",$param['v2'])) {
                $param['v2'] = intval($param['v2']);
            }elseif($param['v2']!=0){
                $msg = "补仓次数0--8之间的整数";
                $arr['code'] = 1;
                $arr['msg'] = $msg;
                return $arr;
            }
            //开仓金额开仓金额大于5，小于5000。
            if($param['v1']>=5 && $param['v1']<5000)
            {

            }else{
                $msg = "开仓金额开仓金额大于5 小于5000";
            }

            //补仓次数0-8之间的整数
            if($param['v2']>=0 && $param['v2']<9)
            {

            }else{
                $msg = "补仓次数0-8之间的整数";
            }

            //止盈幅度必须大于0.6%
            if($param['v3']>=0.6)
            {

            }else{
                $msg = "止盈幅度必须大于0.6%";
            }

            //止盈回调为0以上，但不能大于2%，且确保止盈幅度减去止盈回调大于0.6%，
            if($param['v4']>0 && $param['v4']<2 && ($param['v3']-$param['v4'])>0.6)
            {

            }else{
                $msg = "止盈回调为0以上，但不能大于2%，且确保止盈幅度减去止盈回调大于0.6%";
            }

            //补仓幅度不能小于1%，小于1%提醒用户。同时不能大于90%。
            if($param['v5']>1 && $param['v5']<90)
            {

            }else{
                $msg = "补仓幅度不能小于1%，小于1%提醒用户。同时不能大于90%。";
            }

            //补仓回调范围在大于0，小于2%，且必须小于补仓幅度
            if($param['v6']>0 && $param['v6']<2 && $param['v6']<$param['v5'])
            {

            }else{
                $msg = "补仓回调范围在大于0，小于2%，且必须小于补仓幅度";
            }

            //是否平推
            if($param['v7']==1 || $param['v8']==0)
            {

            }else{
                $msg = "平推参数只能为0，1";
            }
            if(!empty($msg))
            {
                $arr['code'] = 1;
                $arr['msg'] = $msg;
                return $arr;
            }

            $arr['code'] = 0;
            $arr['msg'] = $msg;
            return $arr;
        }
        if($type=="wangge2")
        {
            /**
             *
            周期必须选择，为空不能启动
             */
            if(empty($param['v1']) || empty($param['v2']) || empty($param['v3']) || empty($param['v5']) || empty($param['v6']) || empty($param['v7']) || empty($param['v8']))
            {
                $arr['code'] = 1;
                $arr['msg'] = '必填项不能为空';
                return $arr;
            }
            if(preg_match("/^[1-9][0-9]*$/",$param['v4'])) {
                $param['v4'] = intval($param['v4']);
            }elseif($param['v4']!=0){
                $msg = "补仓次数0--8之间的整数";
                $arr['code'] = 1;
                $arr['msg'] = $msg;
                return $arr;
            }
//            $param['v4'] = intval($param['v4']);
            //开仓金额开仓金额大于5，小于5000。
            if($param['v1']>=5 && $param['v1']<5000)
            {
//                $ret = $this->setRet(1,'');
//                $this->writeRet($ret);
            }else{
                $msg = "开仓金额开仓金额大于5 小于5000";
            }

            //连续下跌必须大于1%以上的百分比
            if($param['v3']>1)
            {

            }else{
                $msg = "连续下跌必须大于1%以上的百分比";
            }

            //补仓次数0-8之间的整数
            if($param['v4']>=0 && $param['v4']<9)
            {

            }else{
                $msg = "补仓次数0-8之间的整数";
            }

            //止盈幅度必须大于0.6%
            if($param['v5']>=0.6)
            {

            }else{
                $msg = "止盈幅度必须大于0.6%";
            }

            //止盈回调为0以上，但不能大于2%，且确保止盈幅度减去止盈回调大于0.6%，
            if($param['v6']>0 && $param['v6']<2 && ($param['v5']-$param['v6'])>0.6)
            {

            }else{
                $msg = "止盈回调为0以上，但不能大于2%，且确保止盈幅度减去止盈回调大于0.6%";
            }

            //补仓幅度不能小于1%，小于1%提醒用户。同时不能大于90%。
            if($param['v7']>1 && $param['v7']<90)
            {

            }else{
                $msg = "补仓幅度不能小于1%,大于90%";
            }

            //补仓回调范围在大于0，小于2%，且必须小于补仓幅度
            if($param['v8']>0 && $param['v8']<2 && $param['v8']<$param['v7'])
            {

            }else{
                $msg = "补仓回调范围在大于0，小于2%，且必须小于补仓幅度";
            }
            if(!empty($msg))
            {
                $arr['code'] = 1;
                $arr['msg'] = $msg;
                return $arr;
            }
            $arr['code'] = 0;
            $arr['msg'] = $msg;
            return $arr;
        }
    }

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
