<?php
/**
 * Created by PhpStorm.
 * User: volunie
 * Date: 13-11-1
 * Time: 下午4:54
 */
    class ArticleAction extends CommonAction{
        public function  index(){
            $Type = M('article_type');
            $typeArr = $Type->select();
            $this->assign('article_type',$typeArr);
            $this->display();
        }

        public function doIndex(){
            $title =$_GET['title'];
            $isRecommend = $_GET['isRecommend'];
            $where['title'] = array('like','%'.$title.'%');
            if($_GET['id']!=""){
                $where['id']=$_GET['id'];
            }
            if($isRecommend!=""){
                $where['isRecommend']=$isRecommend;
            }
            if($_GET['startDate']!="" && $_GET['endDate']!=""){
                $where['update_time'] = array('between',array($_GET['startDate'],$_GET['endDate']));
            }
            if($_GET['author']!=""){
                $where['author']=$_GET['author'];
            }
            $Article  = M("article");
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

        public function add(){
            $Type = M('article_type');
            $typeArr = $Type->select();
            $this->assign('article_type',$typeArr);
            $this->display();
        }

        public function doAdd(){
            $Article  = M("article");
            $data['title']=$_GET['title'];
            $data['author']=$_GET['author'];
            $data['img']=$_GET['img'];
            $data['article_type']=$_GET['article_type'];
            $data['description']=$_GET['description'];
            $data['content']=$_GET['content'];
            $data['update_time']=date('Y-m-d',time());
            $isAdd = $Article ->data($data)->add();
            if($isAdd>0){
                $success['success']=true;
            }else{
                $success['success']=false;
            }
            echo json_encode($success);
        }
        public function modify($id){
            $where['id'] = $id;
            $Article  = M("article");
            $data = $Article->where($where)->select();
            $Type = M('article_type');
            $typeArr = $Type->select();
            $this->assign('article',$data);
            $this->assign('type',$typeArr);
            $this->display();
        }

        public function doModify($id){
            $Article  = M("article");
            $data['id']=$id;
            $data['title']=$_GET['title'];
            $data['author']=$_GET['author'];
            $data['img']=$_GET['img'];
            $data['article_type']=$_GET['article_type'];
            $data['description']=$_GET['description'];
            $data['content']=$_GET['content'];
            $data['update_time']=date('Y-m-d',time());
            $isModify = $Article->save($data);
            if($isModify>0){
                $success['success']=true;
            }else{
                $success['success']=false;
            }
            echo json_encode($success);
        }
        /*
        * 是否推荐
        * */
        public function isRe(){
            $Article  = M("article");
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
                $isModify = $Article->save($data);
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
            $Article = M('article');
            $condition['id']=array('in',$ids);
            $result=$Article->Where($condition)->delete();
            echo json_encode(array('success'=>$result));
        }
        /*
     * 文章类型列表
     */
        public function articleType(){
            $this->display();
        }

        public function getType(){
            $Type = M('article_type');
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
         * 添加文章类型
         */
        public function doAddType(){
            $name = $_GET['name'];
            if( $name != ''){
                $data['name'] = $_GET['name'];
                $Type = M('article_type');
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
         * 删除文章类型
         */
        public function doDelType($ids){
            $Type = M('article_type');
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
         * 修改文章类型页面
         */
        public function modifyType($id){
            $Type = M('article_type');
            $data['id']=$id;
            $typeArr = $Type ->where($data)->select();
            $this->assign('article_type',$typeArr);
            $this->display();
        }
        /*
         * 修改文章类型
         */
        public function doModifyType($id){
            $Type = M('article_type');
            $data['id']=$id;
            $data['name']=$_GET['name'];
            $data['img']=$_GET['img'];
            $result = $Type->save($data);
            if($result>0){
                $success['success']=true;
            }else{
                $success['success']=false;
            }
            echo json_encode($success);
        }

    }

?>