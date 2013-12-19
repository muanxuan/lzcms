<?php
/**
 * Created by PhpStorm.
 * User: volunie
 * Date: 13-11-2
 * Time: 下午8:48
 */
    class ProductAction extends Action{
        public function index(){
            $ProdType= M('product_type');
            $type = $ProdType->select();
            $productList = array();
            $Product  = M("product");

            for($i=0;$i<count($type);$i++){
                $productList[$i]['type_name']=$type[$i]['name'];
                $productList[$i]['img']=$type[$i]['img'];
                $where['type_id']=$type[$i]['id'];

                $productGet=$Product->where($where)->select();
                $productList[$i]["size"]=count($productGet);
                if($productGet != null){
                    $productList[$i]["lower"]=$productGet;
                }

            }
            $Banner = $this->getBanner(3);
            $this->assign('banner',$Banner);
            $this->assign('productList',$productList);
            $this->display();

        }

        public function detail($id){
            $where['id']=$id;
            $Product = M('product');

            $data = $Product->where($where)->select();

            $TypeId = M('product_type');
            $getType['id'] = $data[0]['type_id'];
            $type =$TypeId->where($getType)->select();
            $data[0]['typeName']=$type[0]['name'];
            $data[0]['typeId']=$type[0]['id'];
            $this->assign('detail',$data);
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