<?php

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

$mysql=new mysql();
$sql="SELECT * FROM info";
$re=$mysql->toresult($sql);

 ?>
<!DOCTYPE html>
<html lang="zh-CN">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
 <meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="stylesheet" href="css/ui.css">
<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<body style="display:none;">
<div class="container" style="">
<table class="table table-hover table-bordered">
      <thead>
        <tr>
          <th>#</th>
          <th>姓名</th>
          <th>手机号</th>
		      <th>作品链接</th>
            <th>上传的时间</th>
			 <th>简介</th>
          <th>上传的视频</th>
         
            <th>状态</th>
        </tr>
      </thead>
      <tbody>
      <?PHP
foreach ($re as $key => $value) {
?>
        <tr>
          <th scope="row"><?php echo $key;?></th>
          <td><?php echo $value['name'];?></td>
          <td><?php echo $value['phonenumber'];?></td>

   <td> 
  <a href=" <?php 
   if($value['siteUrl']!=null || $value['siteUrl']!='' ){
      echo $value['siteUrl'];
   }
   ?>"   style="display:  <?php 
   if($value['siteUrl']!=null || $value['siteUrl']!='' ){
      echo "block";
   }else{
    echo "none";
   }
   ?>">
<?php
        echo $value['siteUrl'];
?>

   </a>
  </td>

		    <td><?php echo $value['time'];?></td>
              <td><?php echo $value['info'];?></td>
          <td> <a target="_Blank" href="play.php?target=<?php echo $value['video'];?>&name=<?php echo $value['name'];?>"> 播放</a></td>
      
          <td><button  data-pid="<?php echo $value['id'];?>" class="btn  <?php  if($value['status']==0){echo "btn-danger";}else{echo "btn-default";}?> "><?php  if($value['status']==0){echo "未看";}else{echo "已看";}?></button></td>
        </tr>
        <?php
}
      ?>
      </tbody>
    </table>
</div>

</body>
  <script src="js/jq.js"></script>
  <script type="text/javascript">
$(function(){
	if(prompt("请输入用户名","")=='admin'){
		if(prompt("请输入密码","")=='admin'){
		$('body').show();
		}
	}
	$('.btn').on('click',function(){
		if(this.innerHTML=='已看') return;
		$.ajax({
			type:'POST',
			url:'final.php',
			data:{act:$(this).data('pid')},
			success:function(rs){
				var res=eval('('+rs+')');
				if(res.status==1){
					window.location.href=location;
				}
			}
		})
	})
})
  </script>
  <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</html>