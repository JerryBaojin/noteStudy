<?php
date_default_timezone_set('PRC');
class mysql{
    private $mysql;
      function __construct()
    {
        $sql = new mysqli('localhost','root','102098hchab','spring');
        $sql->query("SET NAMES UTF8");
        $sql->query("set character set 'utf8'");//读库
        $sql->query("set names 'utf8'");//写库
        $sql->query("set names 'utf8'");
        $this-> mysql=$sql;
    }
    public function toresult($sql){
      $mysql= $this->mysql;
      $arrs=array();
     if (  $re=$mysql->query($sql))
     {
        while($arr=$re->fetch_array(MYSQLI_ASSOC))
        {
            $arrs[]=$arr;
        }
     }
        return $arrs;

    }

    public function insert($insert){
        $mysql= $this->mysql;
        $q=$mysql->query($insert);
        return $q;
    }

}

$mydb=new mysql();
if (!isset($_POST['act']) ) {
  echo json_encode(array(
      'status'=>0
    ));
}elseif($_POST['act']=='signup'){

$dates=$_POST;
$time=date('Y-m-d H-i-s',time());

$name=$dates['name'];
$phonenumber=$dates['phonenumber'];
$video=$dates['video'];
$siteUrl=$dates['siteUrl'];
 $pic=null;
$siteUrl==''?$siteUrl=0:'';


$base64_image_content = $_POST['pBase64'];
//匹配出图片的格式
if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_image_content, $result)){
$type = $result[2];
$new_file = "upload/active/img/".date('Ymd',time())."/";
if(!file_exists($new_file))
{
//检查是否有该文件夹，如果没有就创建，并给予最高权限
mkdir($new_file, 0700);
}
$new_file = $new_file.time().".{$type}";
if (file_put_contents($new_file, base64_decode(str_replace($result[1], '', $base64_image_content)))){
 $pic=$new_file;
}else{
  echo json_encode(array(
      'status'=>3
    ));
 exit();
}
}

$o="SELECT * FROM info WHERE phonenumber='$phonenumber'";
$e=$mydb->toresult($o);
if(!empty($e)){
  echo json_encode(array(
      'status'=>3
    ));
   exit();
}

$sql="INSERT INTO info (`name`,`phonenumber`,`video`,`time`,`pic`,`siteUrl`) VALUES ('$name','$phonenumber','$video','$time',' $pic','$siteUrl')";
if($mydb->insert($sql)){
  echo json_encode(array(
      'status'=>1
    ));
}else{
  echo json_encode(array(
      'status'=>0
    ));
}
}else{
  $pid=$_POST['act'];
  $sql="UPDATE info set `status`='1' WHERE (`id`='$pid')";
  if($mydb->insert($sql)){
    echo json_encode(array(
      'status'=>1
    ));
  }else{
    echo json_encode(array(
      'status'=>0
    ));
  }
}