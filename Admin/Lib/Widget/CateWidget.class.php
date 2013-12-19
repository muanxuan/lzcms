<?php
/**
 * Created by PhpStorm.
 * User: volunie
 * Date: 13-10-31
 * Time: 上午10:00
 */

class CateWidget extends Action {
    public function menu(){
        $Menu = M('menu');
        $menu=array();
        $oldmenu = $Menu->select(); //获取全部的按钮
        for($i=1;$i<count($oldmenu)+1;$i++){
            if($oldmenu[$i-1]['superiors']== 0){
                $menu[$i-1] = $oldmenu[$i-1]; //如果上级id为0，就为顶级菜单
                $oldId = $oldmenu[$i-1]['id']; //获取这次的顶级菜单id
                $lower = $Menu->where("superiors=".$oldId )->select(); //获取
                $menu[$i-1]['lower']= $lower;
                if($lower == null){
                    $menu[$i-1]['iflower'] = 0;
                }else{
                    $menu[$i-1]['iflower']= 1;
                }
            }
        }
        $this->assign('menu',$menu);
        $this->assign('module_name',MODULE_NAME);
        $this->display('Cate:menu');
    }
}