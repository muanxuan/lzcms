<?php

    class WeixinAction extends Action{
        public function test(){
            import('ORG.Weixin.Wechat');
            function logdebug($text){
                file_put_contents('../data/log.txt',$text."\n",FILE_APPEND);
            };
            $options = array(
                'token'=>'cmtifz', //填写你设定的key
                'debug'=>true,
                'logcallback'=>'logdebug'
            );
            $weObj = new Wechat($options);
            $weObj->valid();
            $type = $weObj->getRev()->getRevType();
            switch($type) {
                case Wechat::MSGTYPE_TEXT:
                    $weObj->text("成功啦")->reply();
                    exit;
                    break;
                case Wechat::MSGTYPE_EVENT:
                    break;
                case Wechat::MSGTYPE_IMAGE:
                    break;
                default:
                    $weObj->text("help info")->reply();
            }
        }

        public function doCreateMenu(){
            import('ORG.Weixin.Wechat');
            $data = array(
                'button'=>array(
                    array('type'=>'view','name'=>'云动官网','url'=>'http://app.cmti-fj.com/')
                )
            );
            function logdebug($text){
                file_put_contents('../data/log.txt',$text."\n",FILE_APPEND);
            };
            $options = array(
                'token'=>'cmtifz', //填写你设定的key
                'debug'=>true,
                'logcallback'=>'logdebug'
            );
            $weObj = new Wechat($options);
//            $weObj->valid();
//            var_dump($data);
            $isadd = $weObj->createMenu($data);
            var_dump($isadd);
        }

        public function weixinSet(){
            $weixinConfig = $this->getWeixinConfig();
            $this->assign('weixinConfig',$weixinConfig);
            $this->display();
        }
        public function getWeixinConfig(){
            $Weixin = M('weixin');
            $data = $Weixin->where("id = 1")->select();
            return $data;
        }

        public function doConfigModify($id){
            $Weixin = M('weixin');
            $data['id']=$id;
            $data['url'] = $_GET['url'];
            $data['token'] = $_GET['token'];
            $data['AppId'] = $_GET['AppId'];
            $data['AppSecret'] = $_GET['AppSecret'];
            $isModify = $Weixin->save($data);
            if($isModify>0){
                $success['success']=true;
            }else{
                $success['success']=false;
            }
            echo json_encode($success);
        }
    }

?>