<?php
//========豆瓣id======
$con = mysql_connect("localhost","root","usst,VOD6");
if (!$con)
{
   die('Could not connect: ' . mysql_error());
}
mysql_query("set names utf8");
mysql_select_db("ekucms",$con);
$sql="select * from eku122x_bean where bean not in('0')";
$result=mysql_query($sql);
while($row=mysql_fetch_array($result))
{
   $id=$row['id'];
   $dbid=$row['bean'];
   echo $id."<br>".$dbid."<br>";
   ///-------------
   $sql1="select cid from eku122x_video where nexusphp='$id'";
   $result1=mysql_query($sql1);
   while($row1=mysql_fetch_array($result1))
   {
      $cid=$row1['cid'];
      echo $cid."<br>";
   }

   //--------------
   
   $str="http://api.douban.com/v2/movie/subject/".$dbid;
echo $str."<br>";

   $json=file_get_contents($str);
   $res=json_decode($json,true);
   //print_r($res);
   $casts=$res['casts'];
   //print_r($casts);
   $j=0;
   foreach($casts as $abc)
   {
   
        $casts1[$j]=$abc['name'];
        $j++;
       
   }
   print_r($casts1);
   echo "<br>";

   $casts= implode(" ", $casts1);
   $countries=$res['countries']['0'];
   $year=$res['year'];
   $summary=$res['summary'];
   $directors=$res['directors']['0']['name'];
   $picurl=$res['images']['medium'];
   $genres=$res['genres'];

   //---------如果是电影就分类------
   if($cid==9)
   {
      $channel=array("动作"=>8,"喜剧"=>9,"爱情"=>10,"奇幻"=>11,"故事"=>12,"战   争"=>13);
      $stype=array("警匪"=>19,"灾难"=>20,"动画"=>22,"冒险"=>17,"搞笑"=>18,"经典"=>21,"恐怖"=>17,"青春"=>23,"悬疑"=>24,"惊悚"=>25,"犯罪"=>26,"励志"=>27,"魔幻"=>28,"情色"=>29,"感人"=>30,"传记"=>31,"浪漫"=>32);
      $cid="12";
      $arr=array();
      $i=0;
      foreach($genres as $g)
      {
          foreach($channel as $k=>$c)
          {
             if($g==$k)  
             {
                $cid=$c;
             }          
          }
          foreach($stype as $v=>$s)
          { 
             if($g==$v)
             {
               $arr[$i]=$s;
               $i++;
              }
           }
      }

   $stype_mcid=implode(',',$arr);

   }

////----图片下载--------
$data=file_get_contents($picurl);
//$filetime=time();
$filepath="/var/www/nexusphp/ekucms/uploads/video/".$id."."."jpg";
//if(!is_dir($filepath))
//mkdir($filepath,0777,true);
$fp=@fopen($filepath,"w");
@fwrite($fp,$data);
fclose($fp);
$pic="/video/".$id.".jpg";

///-------------
$sql2="update eku122x_video set cid='$cid',stype_mcid='$stype_mcid',content='$summary',year='$year',area='$countries',actor='$casts',director='$directors',picurl='$pic' where nexusphp='$id'";
mysql_query($sql2);

$sql="delete from eku122x_bean where id='$id'";
mysql_query($sql);
}
//echo "aa<br>";

mysql_close($con);

?>

<head>
<title>bean</title>
</head>

</html>
