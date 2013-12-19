<?php
/**
 * Created by PhpStorm.
 * User: volunie
 * Date: 13-10-30
 * Time: 上午8:59
 * 公共类
 */

class PublicAction extends Action{
    /*
     * 验证码
     */
    Public function verify(){
        import('ORG.Util.Image');
        Image::buildImageVerify(4,3,'png','',28,'verify');
    }
    /*图片*/
    public function uploadimg(){
        import('ORG.Net.UploadFile');
        $upload = new UploadFile();// 实例化上传类
        $upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->autoSub =true ;
        $upload->subType ='date' ;
        $upload->dateFormat ='ymd' ;
        $upload->savePath =  './Uploads/images/';// 设置附件上传目录
        if($upload->upload()){
            $info =  $upload->getUploadFileInfo();
            echo json_encode(array(
                'url'=>$info[0]['savename'],
                'title'=>htmlspecialchars($_POST['pictitle'], ENT_QUOTES),
                'original'=>$info[0]['name'],
                'state'=>'SUCCESS'
            ));
        }else{
            echo json_encode(array(
                'state'=>$upload->getErrorMsg()
            ));
        }
    }
}


?>
