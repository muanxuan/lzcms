<?php
/**
 * Created by PhpStorm.
 * User: volunie
 * Date: 13-11-2
 * Time: 下午5:16
 */

class ConfigAction extends CommonAction{
    public function index(){
        $Config = M('config');
        $data=$Config->where('id = 1')->select();
        $this->assign('config',$data);
        $this->display();

    }

    public function doModify($id){
        $data['id']=$id;
        $data['site_name']=$_GET['site_name'];
        $data['site_url']=$_GET['site_url'];
        $data['admin_email']=$_GET['admin_email'];
        $data['icp']=$_GET['icp'];
        $data['logo']=$_GET['logo'];
        $Config = M('config');
        $isModify = $Config->save($data);
        if($isModify>0){
            $success['success']=true;
        }else{
            $success['success']=false;
        }
        echo json_encode($success);
    }

}

?>