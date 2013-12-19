<?php
/**
 * Created by PhpStorm.
 * User: volunie
 * Date: 13-10-31
 * Time: 下午2:25
 */

class ProductAction extends CommonAction{

    public function  add(){
        $Type = M('product_type');
        $typeArr = $Type->select();
        $this->assign('product_type',$typeArr);
        $this->display();
    }

    public function doAdd(){
        $Product  = M("product");
        $data['name']=$_GET['name'];
        $data['number']=$_GET['number'];
        $data['img']=$_GET['img'];
        $data['type_id']=$_GET['type_id'];
        $data['content']=$_GET['content'];
        $data['update']=date('Y-m-d',time());
        $isAdd = $Product ->data($data)->add();;
        if($isAdd>0){
            $success['success']=true;
        }else{
            $success['success']=false;
        }
        echo json_encode($success);
    }

    public function modify($id){
        $where['id'] = $id;
        $Product  = M("product");
        $data = $Product->where($where)->select();
        $Type = M('product_type');
        $typeArr = $Type->select();
        $this->assign('product',$data);
        $this->assign('product_type',$typeArr);
        $this->display();
    }

    public function doModify($id){
        $Product  = M("product");
        $data['id']=$id;
        $data['name']=$_GET['name'];
        $data['number']=$_GET['number'];
        $data['img']=$_GET['img'];
        $data['type_id']=$_GET['type_id'];
        $data['content']=$_GET['content'];
        $data['update']=date('Y-m-d',time());
        $isModify = $Product->save($data);
        if($isModify>0){
            $success['success']=true;
        }else{
            $success['success']=false;
        }
        echo json_encode($success);

    }

    public function  index(){
        $Product  = M("product");
        $data = $Product->select();
        $Type = M('product_type');
        $typeArr = $Type->select();
        $this->assign('product',$data);
        $this->assign('product_type',$typeArr);
        $this->display();
    }

    public function doIndex(){
        $name =$_GET['name'];
        $isRecommend = $_GET['isRecommend'];
        $where['name'] = array('like','%'.$name.'%');
        if($_GET['number']!=""){
            $where['number']=array('like','%'.$_GET['number'].'%');;
        }
        if($isRecommend!=""){
            $where['isRecommend']=$isRecommend;
        }
        if($_GET['startDate']!="" && $_GET['endDate']!=""){
            $where['update'] = array('between',array($_GET['startDate'],$_GET['endDate']));
        }
        $Article  = M("product");
        $rows = $Article->where($where)->limit($_GET['pageIndex'],$_GET['limit'])->select();

        if(count($rows)<1){
            $rows = array();
//                $data['hasError']=true;
//                $data['error']="所查询的没有数据！";
        }else{
//                $data['hasError']=false;
        }
        $data['rows'] = $rows;
        $data['results']= count($rows);
        echo json_encode($data);
    }

    /*
        * 是否推荐
        * */
    public function isRe(){
        $Product  = M("product");
        $ids=$_GET['ids'];
        $isRecommends = $_GET['isRecommends'];
        $isRe=0;
        for($i=0;$i<count($ids);$i++){
            $data = array();
            $data['id']=$ids[$i];
            if($isRecommends[$i] == 1){
                $data['isRecommend']= 0;
            }else{
                $data['isRecommend']= 1;
            }
            $isModify = $Product->save($data);
            if($isModify > 0){
                $isRe = $isRe+1;
            }
        }


        if($isRe ==count($ids) ){
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
        $Product = M('product');
        $condition['id']=array('in',$ids);
        $result=$Product->Where($condition)->delete();
        echo json_encode(array('success'=>$result));
    }
    /*
     * 产品类型列表
     */
    public function type(){
        $this->display();
    }
    public function getType(){
        $Type = M('product_type');
        $typeArr = $Type->select();

        $data['rows'] = $typeArr;
        $data['results']= count($typeArr);
        if(count($typeArr)<1){
            $data['hasError']=true;
            $data['error']="所查询的没有数据！";
        }else{
            $data['hasError']=false;
        }
        echo json_encode($data);
    }
    /*
     * 添加产品类型
     */
    public function doAddType(){
        $name = $_GET['name'];
        if( $name != ''){
            $data['name'] = $_GET['name'];
            $Type = M('product_type');
            $isAdd = $Type->add($data);
            if($isAdd>0){
                $success['success']=true;
            }else{
                $success['success']=false;
            }
            echo json_encode($success);
        }else{
            $success['success']=false;
            echo json_encode($success);
        }

    }
    /*
     * 删除产品类型
     */
    public function doDelType($ids){
        $Type = M('product_type');
        $condition['id']=array('in',$ids);
        $result=$Type->Where($condition)->delete();
        if($result>0){
            $success['success']=true;
        }else{
            $success['success']=false;
        }
        echo json_encode($success);
    }
    /*
     * 修改产品类型页面
     */
    public function modifyType($id){
        $Type = M('product_type');
        $data['id']=$id;
        $typeArr = $Type ->where($data)->select();
        $this->assign('product_type',$typeArr);
        $this->display();
    }
    /*
     * 修改产品类型
     */
    public function doModifyType($id){
        $Type = M('product_type');
        $data['id']=$id;
        $data['name']=$_GET['name'];
        $data['img'] = $_GET['img'];
        $isModify = $Type->save($data);
        if($isModify>0){
            $success['success']=true;
        }else{
            $success['success']=false;
        }
        echo json_encode($success);
    }

}

?>