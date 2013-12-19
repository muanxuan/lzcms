<?php
/**
 * Created by PhpStorm.
 * User: volunie
 * Date: 13-10-30
 * Time: 下午3:48
 */

class CommonAction extends Action{
    Public function _initialize(){
        // 初始化的时候检查用户权限
        if(!isset($_SESSION['username']) || $_SESSION['username']==''){
            $this->redirect('Admin/index');
        }

        $name = 'ThinkPHP';
        $this->assign('name',$name);

    }
}
?>