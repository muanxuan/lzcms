<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action {
    public function index(){
        $reProduct = $this->showReProduct();
        $reArticle = $this->showReArticle();
        $productBanner = $this->getIndexBanner(1);
        $newsBanner = $this->getIndexBanner(2);
        $this->assign('reProduct',$reProduct);
        $this->assign('reArticle',$reArticle);
        $this->assign('newsBanner',$newsBanner);
        $this->assign('productBanner',$productBanner);
        $this->display();
    }

    public function showReProduct(){
        $Product =M('product');
        $Type =M('product_type');
        $data = $Product->where('isRecommend = 1')->select();
        for($i=0;$i<count($data);$i++){
           $where['id']= $data[$i]['type_id'];
           $data[$i]['type_name']= $Type->where($where)->getField('name');
        }
        return $data;
    }

    public function showReArticle(){
        $Product =M('article');
        $Type =M('article_type');
        $data = $Product->where('isRecommend = 1')->select();
        for($i=0;$i<count($data);$i++){
            $where['id']= $data[$i]['article_type'];
            $data[$i]['type_name']= $Type->where($where)->getField('name');
        }
        return $data;
    }

    public function getIndexBanner($type_id){
        $Banner =M('banner');
        $where[type_id]=$type_id;
        $data = $Banner->where($where)->select();
        return $data;
    }

}