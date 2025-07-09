<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=window-874" />
<meta http-equiv="refresh" content="5;URL=frame2.php">

<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
<!-- TemplateBeginEditable name="doctitle" -->
<title>Index</title>
<!-- TemplateEndEditable -->
<!-- TemplateBeginEditable name="head" -->
<!-- TemplateEndEditable -->
<style type="text/css">    



/* ~~ Element/tag selectors ~~ */
ul, ol, dl { /* Due to variations between browsers, it's best practices to zero padding and margin on lists. For consistency, you can either specify the amounts you want here, or on the list items (LI, DT, DD) they contain. Remember that what you do here will cascade to the .nav list unless you write a more specific selector. */
	padding: 0;
	margin: 0;
}
h1, h2, h3, h4, h5, h6, p {
	margin-top: 0;	 /* removing the top margin gets around an issue where margins can escape from their containing div. The remaining bottom margin will hold it away from any elements that follow. */
	padding-right: 15px;
	padding-left: 15px; /* adding the padding to the sides of the elements within the divs, instead of the divs themselves, gets rid of any box model math. A nested div with side padding can also be used as an alternate method. */
	text-align: center;
}
a img { /* this selector removes the default blue border displayed in some browsers around an image when it is surrounded by a link */
	border: none;
}
/* ~~ Styling for your site's links must remain in this order - including the group of selectors that create the hover effect. ~~ */
a:link {
	color: #42413C;
	text-decoration: underline; /* unless you style your links to look extremely unique, it's best to provide underlines for quick visual identification */
}
a:visited {
	color: #6E6C64;
	text-decoration: underline;
}
a:hover, a:active, a:focus { /* this group of selectors will give a keyboard navigator the same hover experience as the person using a mouse. */
	text-decoration: none;
}

/* ~~ this fixed width container surrounds the other divs ~~ */
.container {
	width: 1180px;
	height: 900px;

	margin: 0 auto; /* the auto value on the sides, coupled with the width, centers the layout */
}

/* ~~ the header is not given a width. It will extend the full width of your layout. It contains an image placeholder that should be replaced with your own linked logo ~~ */
.header {
	
	background-color: #9400D3;
}

/* ~~ This is the layout information. ~~ 

1) Padding is only placed on the top and/or bottom of the div. The elements within this div have padding on their sides. This saves you from any "box model math". Keep in mind, if you add any side padding or border to the div itself, it will be added to the width you define to create the *total* width. You may also choose to remove the padding on the element in the div and place a second div within it with no width and the padding necessary for your design.

*/

.content {
	padding-top: 1280;
	padding-right: px;
	padding-bottom: 800;
	height: 650px;
	
}

/* ~~ The footer ~~ */
.footer {
	padding: 10px 0;
	background-color: #CCC49F;

}

/* ~~ miscellaneous float/clear classes ~~ */
.fltrt {  /* this class can be used to float an element right in your page. The floated element must precede the element it should be next to on the page. */
	float: right;
	margin-left: 8px;
}
.fltlft { /* this class can be used to float an element left in your page. The floated element must precede the element it should be next to on the page. */
	float: left;
	margin-right: 8px;
}
.clearfloat { /* this class can be placed on a <br /> or empty div as the final element following the last floated div (within the #container) if the #footer is removed or taken out of the #container */
	clear:both;
	height:0;
	font-size: 1px;
	line-height: 0px;
}
.si1 {
	font-size: 120px;
	text-align: center;
}

body {
				font-family: 'Roboto', sans-serif; /* ใช้ฟอนต์ Roboto */
			}
			h1, h2, h3, h4, h5, h6, p {
				font-family: 'Roboto', sans-serif; /* ใช้ฟอนต์ Roboto ใน heading และ paragraph */
			}


</style>

<script language="JavaScript1.2">
var speed=1
var currentpos=0,alt=1,curpos1=0,curpos2=-1
function scrollwindow(){
if (document.all)
	temp=document.body.scrollTop
	else
	temp=window.pageYOffset

	if (alt==0)
	alt=1
	else
	alt=0
		if (alt==0)
		curpos1=temp
		else
		curpos2=temp
		if (curpos1!=curpos2){
			if (document.all)
			currentpos=document.body.scrollTop+speed
			else
			currentpos=window.pageYOffset+speed
	//		window.scroll(0,currentpos)
			window.scroll(0,currentpos)
			}
			else{
				
				//	clearInterval(Tm);
		}
	}
</script>

</head>

<body class="azq" onload="Tm=setInterval('scrollwindow()',10);">
<? 
include("../Connect/ConnectSSB.php");
include("../FunctionHos/Functionlist.php");
?>
<? date_default_timezone_set("Asia/Bangkok");?>

<?
	$vn = $_POST['vn'];
	// echo $date = date("d/m/Y");
	$ydate = date("Y");
	$mdate = date("m");
	$ddate = date("d");
	$i=1;

	$hostname = "localhost";
	$user = "root";
	$password = "Admin@2018";
	$dbname = "qssc";
	$db_handle = mysql_connect($hostname,$user,$password)or die("Cannot connect to Database");
	$db_found = mysql_select_db($dbname)or die("Cannot connect to Database");

	$msql ="select * from slotmed1 where slot = '5'";

	mysql_query("SET NAMES UTF8");
	$result = mysql_query($msql);
	while ($dn = mysql_fetch_array($result))
	{   $noslot = $dn['noslot'];
?>

<?
	echo '<span class="si1"><div align="center"><strong>'.$dn['vn'];
	if ($dn['PRESCRIP']=='1')
	{ }
	else {echo "/".$dn['PRESCRIP']."</div></span>";}

}
?>

<div align="center">
<?// echo 'คุณ '.hnname($vn,$ydate,$mdate,$ddate,$con_hos)?>



</body>


</html>
