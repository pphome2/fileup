<?php


include("config/config.php");
include("config/$DM_LANGFILE");
include("$DM_HEADER");
include("$DM_CSS2");
include("$DM_JS_BEGIN");






if (isset($_POST['submit'])){
	echo("<div class=spaceline></div>");
	#if (fileup($DIR_FILES)){
	if (fileup2("fileupload",$DIR_FILES,TRUE)){
		mess_ok("$LANG[2]");
	}else{
		mess_error("$LANG[3]");
	}
	echo("<div class=spaceline></div>");
}else{
	echo("<div class=spaceline100></div>");
}



echo("<form  method='post' enctype='multipart/form-data'>");

echo("<div class='upload-btn-wrapper'>");
echo("  <input type=file name='fileupload' id='fileupload' />");
echo("  <button class='inputbutton'>$LANG[0]</button>");
echo("</div>");
echo("<div class=spaceline></div>");
echo("  <input type=submit name='submit' class='inputbutton' value='$LANG[1]' />");

echo("</form>");

#echo("    $LANG[0]:");
#echo("    <input type='file' name='fileupload' id='fileupload'>");
#echo("<div class=spaceline></div>");
#echo("    <input type='submit' value='$LANG[1]' name='submit'>");






function fileup($target_dir){;
	$ret=FALSE;
	$target_file=basename($_FILES["fileupload"]["name"]);
	if ($target_file<>""){
		#$target_file=toascii($target_file);
		if ($target_dir<>""){
			$target_file=$target_dir."/".$target_file;
		}
		$c=$_FILES["fileupload"]["tmp_name"];
		if (move_uploaded_file($_FILES["fileupload"]["tmp_name"],$target_file)) {
			$ret=TRUE;
		}
	}
	return($ret);
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




function fileup2($fname,$tdir='./',$delifexists=FALSE,$fsize=1000000,$onlyimg=FALSE){
	$target_dir=$tdir."/";
	$target_file=$target_dir.basename($_FILES[$fname]["name"]);
	$ok=TRUE;
	$imageFileType=strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	// Check if image file is a actual image or fake image
	// Check if file already exists
	if (file_exists($target_file)) {
		if ($delifexists){
			$ok=unlink($target_file);
		}else{
			$ok=FALSE;
		}
	}
	// Check file size
	if ($_FILES[$fname]["size"]>$fsize) {
		echo "Sorry, your file is too large.";
		$ok=FALSE;
	}
	// Allow image file formats
	if ($onlyimg){
		$ok=getimagesize($_FILES[$fname]["tmp_name"]);
	}
	// Check if $k is set to 0 by an error
	if ($ok) {
		if (move_uploaded_file($_FILES["$fname"]["tmp_name"], $target_file)) {
		}else{
			$ok=FALSE;
		}
	}
	return($ok);
}







include("$DM_JS_END");
include("$DM_FOOTER");


?>