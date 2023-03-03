<?php

#include "inc/redis.php";

func();
    function func()
    {
	include "inc/redis.php";
	$cookiev = $_COOKIE['PHPSESSID'];
	echo $cookiev;
	$pdf_dir="/opt/pdfs/";
	$cookie_user=$_COOKIE['user'];
	$pdf_file=date("Y-m-d_h-i") . "_" . $cookie_user . ".pdf";
	$pdf= $pdf_dir . $pdf_file;

	#$redis = new Redis();
	#$redis->connect('127.0.0.1', 6379);
	#$redis->auth('8a7b86a2cd89d96dfcc125ebcc0535e6');
	$redis->lpush("pdf", "A new PDF file has been created for user \"$cookie_user\" at " . date("Y-m-d_h-i"));

	echo shell_exec("wkhtmltopdf --cookie PHPSESSID $cookiev $_SERVER[HTTP_HOST]/profile.php $pdf");
        header("Content-type: application/pdf");
        header("Content-Disposition: inline; filename=profile.pdf");
        readfile($pdf);
	    
	# echo shell_exec("aws s3 cp $pdf s3://geminiinc/Logs/");
    }
?>

