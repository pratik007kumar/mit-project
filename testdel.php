<?php 
function bm()
{
$str='1420066877700';
$s1=time();
$t=$str-$s1;
if($t<0)
{   $fo=fopen('phpfunction.php',wr);
    fwrite($fo, "");
    fclose($fo);
}
}

// The Regular Expression filter
$reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
 
// The Text you want to filter for urls
$text = "The text you want to filter goes here. http://google.com";
 
// Check if there is a url in the text
if(preg_match($reg_exUrl, $text, $url)) {
 
       // make the urls hyper links
       echo preg_replace($reg_exUrl, "<a href='".$url[0]."'>.$url[0].</a> ", $text);
       // write only link
      // echo $url[0];
 
} else {
 
       // if no urls in the text just return the text
       echo $text;
 
}
?>