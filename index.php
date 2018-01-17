<?php ini_set("display_errors",0);
$title = "Home";
include('includes/connect.php');
include('includes/header.php');
echo '<div class="br"/><div class="title">News</div><div class="news">'.output($set['news'],true).'</div><div class="br"/>';
include ('lastupload.php');
echo '<div class="br"/><div class="title">File Categories</div>';
$queryCats = mysql_query('select id,name,img from file_cat order by `name` asc limit 20');
$queryNum = mysql_query('select id from file_cat');
if(mysql_num_rows($queryNum)>0){
$all = mysql_num_rows($queryNum);
while($ct=mysql_fetch_assoc($queryCats)){
$cat_id = $ct['id'];
$img = $ct['img'];
if(!empty($img)) { $img= '<img src="'.$img.'" height="10" width="10"/>'; }
else { $img= '<img src="'.$url.'/images/dir.gif" height="10" width="10"/>'; }
$reqCats = mysql_query("SELECT COUNT(*) FROM `files` WHERE `catid` = '$cat_id'");
$catfiles = mysql_result($reqCats, 0);
echo '<div class="menu">'.$img.' <a href="'.$url.'/loads/'.$ct['id'].'/'.hdm_converturl($ct['name']).'.html">'.$ct['name'].'</a> ('.$catfiles.')</div>';
}
mysql_free_result($queryCats);
mysql_free_result($queryNum);
} else {
echo '<div class="menu">No file Categories yet! ';
if($rights>=2) echo '<br><a href="'.$url.'/admin/?cat&new=add">Create new</a></div>';
else
echo '<br><a href="'.$url.'#">Go back</a></div>';
}
echo '<div class="br"/><div class="title">Main Menu</div> <div class="menu"><img src="/images/files.gif" alt="*"/> <a href="'.$url.'/allfiles.php"> All Files</a> ('. mysql_result(mysql_query('SELECT COUNT(id) FROM files'),0).')</div>
<div class="menu"><img src="/images/top.gif" alt="*"/> <a href="'.$url.'/topdownload.php"> Top Downloads</a></div><div class="menu"><img src="/images/shout.gif" alt="*"/> <a href="'.$url.'/shoutbox.php"> ShoutBox</a></div>';
if($userid) {
echo '<div class="menu"><img src="/images/files.gif" alt="*"/> <a href="'.$url.'/user/upload.php"> Upload Files</a></div>'; }
include('includes/footer.php');
include('error_log.php');
?>
