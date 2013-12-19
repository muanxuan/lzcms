<?php
/**
 * Created by JetBrains PhpStorm.
 * User: volunie
 * Date: 13-10-29
 * Time: 下午4:40
 * To change this template use File | Settings | File Templates.
 */
    class AdminAction extends Action{
        public function index(){
            $this->display();
        }

        public function doLogin(){
            $username=$_POST['username'];
            $password=$_POST['password'];
            $code=$_POST['verify'];
            if(md5($code)!=$_SESSION['verify']){
                $this->error('验证码不正确');
            }
            $user=M('Admin');
            $where['username']=$username;
            $where['password']=$password;
            $arr=$user->field('id')->where($where)->find();
            if($arr){
                $_SESSION['username']=$username;
                $_SESSION['id']=$arr['id'];
                $this->success('用户登录成功',U('Index/index'));
            }else{
                $this->error('该用户不存在');
            }
        }

        public function addUser(){
            $this->display();
            $this->assign('action_name',ACTION_NAME);
        }

        public function  doAddUser(){
            $user=D('Admin');
            if(!$user->create()){
                $this->error($user->getError());
            }

            $lastId=$user->add();
            if($lastId){
                $this->redirect('Admin/index');
            }else{
                $this->error('用户注册失败');
            }
        }

    }

?>