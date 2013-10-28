<?php

$fields['name']='bzy';
$fields['date']='0710';
$url="http://222.199.184.28/bupt/curlget.php";

$ch=curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1 );
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//curl_setopt ($ch, CURLOPT_REFERER, $referurl);
//curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_jar);
curl_setopt($ch,CURLOPT_FOLLOWLOCATION,1);//get redirect content
curl_setopt($ch, CURLOPT_NOBODY, false);

$output=curl_exec($ch);

if($output===false){
   echo curl_error($ch);
}
curl_close($ch);
echo $output;





?>
