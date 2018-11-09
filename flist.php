<?php


include("config/config.php");
include("config/$FU_LANGFILE");
include("$FU_HEADER");
include("$FU_CSS2");
include("$FU_JS_BEGIN");




$loggedin=FALSE;
$passw="";

if (isset($_POST['submit'])){
	if (isset($_POST["password"])){
		$passw=md5($_POST["password"]);
		if ($passw==$FU_PASS){
			$loggedin=TRUE;
		}
	}
	if (isset($_POST["passwordh"])){
		$passw=$_POST["passwordh"];
		if ($passw==$FU_PASS){
			$loggedin=TRUE;
		}
	}
	if (($loggedin)and($_POST["function"]<>"")){
		$funct=$_POST["submit"];
		if ($funct==$LANG[7]){
			$file=$_POST["function"];
			$file="./$DIR_FILES/$file";
			if (file_exists($file)){
				unlink($file); #echo($file);
			}
		}
	}
}else{
}

	echo("<div class=spaceline50></div>");


if ($loggedin){
	$result=array();
	$cdir=scandir($DIR_FILES);
	foreach ($cdir as $key => $value){
		if (!in_array($value,array(".",".."))and(substr($value,0,1)<>'.')){
			$result[]=$value;
		}
	}
	echo("<table id=tasktable class=mt-table-all>");
	echo("<thead><tr class=mt-red>");
	echo("<td>$LANG[6]</td>");
	echo("<td>$LANG[8]</td>");
	echo("<td>$LANG[7]</td>");
	echo("</tr></thead>");
	$db=count($result);
	for ($i=0;$i<$db;$i++){
		if ($result[$i]<>""){
			echo("<tr>");
			echo("<td>$result[$i]</td>");

			echo("<td>");
			#echo("<form  method='post' enctype='multipart/form-data'>");
			#echo("    <input type='hidden' name='passwordh' id='passwordh' value='$passw'>");
			#echo("    <input type='hidden' name='function' id='function' value='$LANG[7]'>");
			#echo("    <input type='submit' value='$LANG[8]' name='submit'>");
			#echo("</form>");
			echo("<a href=\"./$DIR_FILES/$result[$i]\" download>");
			echo("<button class=inputbutton>$LANG[8]</button>");
			echo("</a>");
			echo("</td>");

			echo("<td>");
			echo("<form  method='post' enctype='multipart/form-data'>");
			echo("    <input type='hidden' name='passwordh' id='passwordh' value='$passw'>");
			echo("    <input type='hidden' name='function' id='function' value=\"$result[$i]\">");
			echo("    <input type='submit' value=\"$LANG[7]\" name='submit'>");
			echo("</form>");
			echo("</td>");
			echo("</tr>");
		}
	}
	echo("</table>");



}else{

	echo("<div class=spaceline></div>");
	echo("<form  method='post' enctype='multipart/form-data'>");
	echo("    $LANG[4]:");
	echo("    <input type='password' name='password' id='password'>");
	echo("<div class=spaceline></div>");
	echo("    <input type='submit' value='$LANG[5]' name='submit'>");
	echo("</form>");
	echo("<div class=spaceline></div>");
}





function mess_error($m){
	echo('
	<div class="message">
  		<div onclick="this.parentElement.style.display=\'none\'" class="toprightclose"></div>
  		<p style="padding-left:40px;">'.$m.'</p>
	</div>
	');
}




function mess_ok($m){
	echo('
		<div class="card">
  			<div onclick="this.parentElement.style.display=\'none\'" class="toprightclose"></div>
  			<div class=card-header>
  				<span onclick="var x=document.getElementById(\'cardbody\');if (x.style.display==\'none\'){x.style.display=\'block\'}else{x.style.display=\'none\'}"
  				class="topleftmenu1"></span></div>
  			<div class="cardbody" id="cardbody">
  				<p style="padding-left:40px;padding-bottom:20px;">'.$m.'</p>
  			</div>
		</div>
	');
}











include("$FU_JS_END");
include("$FU_FOOTER");


?>