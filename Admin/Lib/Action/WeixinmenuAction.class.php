<?php
/**
 * Created by PhpStorm.
 * User: volunie
 * Date: 13-12-17
 * Time: 下午9:37
 */
  class WeixinmenuAction extends Action {
        public function index(){
            $this->display();
        }
        public function menuJson(){
            $weixinJson = M("weixin_menu");
            //获取顶级菜单 superior = 0
            $data = $weixinJson->where("superior = 0") ->select();
            for($i=0;$i < count($data);$i++){
               $children =  $weixinJson->where("superior = ".$data[$i]["id"]) ->select();
               if($children>0){
                   $data[$i]["children"]=$children;
               }
            }
            echo json_encode($data);
        }

        public function addNext($superiorId){

        }

  }
?>