<?php
/**
 * Created by PhpStorm.
 * User: volunie
 * Date: 13-10-30
 * Time: 下午1:48
 */
class AdminModel extends Model{
    /*自动验证*/
    protected function checkVerify($verify){
        if(md5($verify)!=$_SESSION['verify']){
            return false;
        }else{
            return true;
        }
    }
    protected $_validate=array(
        array('verify','require','验证码必须填写!'),
        array('verify','checkVerify','验证码错误!',0,'callback',1),
        array('username','require','用户名必须填写!'),
        array('username','','用户已经存在',0,'unique',1),
        array('username','/^\w{4,}$/','用户名必须4个字母以上',0,'regex',1),
        array('password','require','密码必须填写!'),
        array('password2','password','确认密码不正确',0,'confirm'),
        array('email','require','用户必须填写!'),
        array('email','/^[_.0-9a-z-]+@([0-9a-z][0-9a-z-]+.)+[a-z]{2,3}$/','Email格式错误',0,'regex',2),
    );



}
?>