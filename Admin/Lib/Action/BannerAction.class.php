<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 13-11-7
 * Time: 下午5:08
 */
class BannerAction extends Action{
    public function index(){
        $data = $this->getBannerType();
        $this->assign('banner_type',$data);
        $this->display();
    }
    public function doIndex(){
        $title =$_GET['title'];
        $where['title'] = array('like','%'.$title.'%');
        if($_GET['id']!=""){
            $where['id']=$_GET['id'];
        }
        if($_GET['startDate']!="" && $_GET['endDate']!=""){
            $where['update_time'] = array('between',array($_GET['startDate'],$_GET['endDate']));
        }
        $Article  = M("banner");
        $rows = $Article->where($where)->limit($_GET['pageIndex'],$_GET['limit'])->select();

        if(count($rows)<1){
            $rows = [];
//                $data['hasError']=true;
//                $data['error']="所查询的没有数据！";
        }else{
//                $data['hasError']=false;
        }
        $data['rows'] = $rows;
        $data['results']= count($rows);
        echo json_encode($data);
    }
    public function add(){
        $data = $this->getBannerType();
        $this->assign('banner_type',$data);
        $this->display();
    }

    public function doAdd(){
        $data['title']=$_GET['title'];
        $data['img']=$_GET['img'];
        $data['url']=$_GET['url'];
        $data['type_id']=$_GET['type_id'];
        $data['update']=date('Y-m-d',time());
        $Banner = M('banner');
        $isAdd = $Banner ->data($data)->add();;
        if($isAdd>0){
            $success['success']=true;
        }else{
            $success['success']=false;
        }
        echo json_encode($success);
    }

    public function modify($id){
        $where['id'] = $id;
        $Banner = M('banner');
        $bannerdata = $Banner->where($where)->select();
        $this->assign('bannerdata',$bannerdata);

        $data = $this->getBannerType();
        $this->assign('banner_type',$data);
        $this->display();
    }

    public function doModify($id){
        $Banner = M('banner');
        $data['id']=$id;
        $data['title']=$_GET['title'];
        $data['img']=$_GET['img'];
        $data['url']=$_GET['url'];
        $data['type_id']=$_GET['type_id'];
        $data['update']=date('Y-m-d',time());
        $isModify = $Banner->save($data);
        if($isModify>0){
            $success['success']=true;
        }else{
            $success['success']=false;
        }
        echo json_encode($success);
    }

    /*
    * 删除文章
    */
    public function doDel($ids){
        $Article = M('banner');
        $condition['id']=array('in',$ids);
        $result=$Article->Where($condition)->delete();
        echo json_encode(array('success'=>$result));
    }

    public function getBannerType(){
        $Banner_type = M('banner_type');
        $data=$Banner_type->select();
        return $data;
    }
}
?>