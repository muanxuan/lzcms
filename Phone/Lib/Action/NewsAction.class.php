<?php
/**
 * Created by PhpStorm.
 * User: volunie
 * Date: 13-11-3
 * Time: 下午7:34
 */
 class NewsAction extends Action{
     public function index(){
         $News = M('article');
         $data = $News->where("article_type = 1")->select();
         $Banner = $this->getBanner(4);
         $this->assign('banner',$Banner);
         $this->assign('news',$data);
        $this->display();
     }
     public function detail($id){
         $where['id']=$id;
         $News = M('article');
         $data = $News->where($where)->select();
         $this->assign('data',$data);
         $this->display();
     }

     public function getBanner($type_id){
         $Banner =M('banner');
         $where[type_id]=$type_id;
         $data = $Banner->where($where)->select();
         return $data;
     }
 }
?>