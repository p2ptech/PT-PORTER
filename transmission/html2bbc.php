<?php 

function html2bbc($html)
{
    $output=$html;
    $output=preg_replace('/\r/i',"",$output);
    $output=preg_replace('/\r/i',"",$output);
    $output=preg_replace('/on(load|click|dbclick|mouseover|mousedown|mouseup)="[^"]+"/i',"",$output);
    $output=preg_replace('/<script[^>]*?>([\w\W]*?)<\/script>/i',"",$output);

    $output=preg_replace('/<a[^>]+href="([^"]+)"[^>]*>(.*?)<\/a>/i',"\n$2\n",$output);

    $output=preg_replace('/<font[^>]+color=([^ >]+)[^>]*>(.*?)<\/font>/i',"[color=$1]$2",$output);

    $output=preg_replace('/<img[^>]+src="([^"]+)"[^>]*>/i',"\n\n",$output);

    $output=preg_replace('/<([\/]?)b>/i',"[$1b]",$output);
    $output=preg_replace('/<([\/]?)strong>/i',"[$1b]",$output);
    $output=preg_replace('/<([\/]?)u>/i',"[$1u]",$output);
    $output=preg_replace('/<([\/]?)i>/i',"[$1i]",$output);

    $output=preg_replace('/&nbsp;/i'," ",$output);
    $output=preg_replace('/&amp;/i',"&",$output);
    $output=preg_replace('/&quot;/i',"\"",$output);
    $output=preg_replace('/&lt;/i',"<",$output);
    $output=preg_replace('/&gt;/i',">",$output);

    $output=preg_replace('/<br>/i',"\n",$output);
    $output=preg_replace('/<[^>]*?>/i',"",$output);
    $output=preg_replace('/\[url=([^\]]+)\]\n(\[img\][^\[]+?\[\/img\])\n\[\/url\]/i',"$2",$output);
    $output=preg_replace('/\n+/i',"\n",$output);

    return $output;
}


?>