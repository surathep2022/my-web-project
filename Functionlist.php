<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?

function cutfirstchar($str) {
	return (substr($str,1));	
};

function getthaidate($datetime) {
	//echo $datetime;
	if($datetime == '')
	{
	return ("");
	}
	$datetime = explode(' ',$datetime);
	$date = $datetime[0];
	$time = $datetime[1];
//	echo "<br>date = $date<br>time = $time<br>";
	$date = explode('-',$date);
	$day = $date[2];
	$month = $date[1];
	$year = $date[0];
//	echo "day = $day / month = $month  / year = $year<br";
	return ($day." ".getmonth($month)." ".getthaiyear($year));	
//	return (" ".$day." ".($month)." ".getthaiyear($year));	
};



function getthaidate2($datetime) {
	//echo $datetime;
	if($datetime == '')
	{
	return ("");
	}
	$datetime = explode(' ',$datetime);
	$date = $datetime[0];
	$time = $datetime[1];
//	echo "<br>date = $date<br>time = $time<br>";
	$date = explode('-',$date);
	$day = $date[2];
	$month = $date[1];
	$year = $date[0];
//	echo "day = $day / month = $month  / year = $year<br";
	return (getdayofweek($day)." ".getmonth($month)." ".($year));	
//	return (" ".$day." ".($month)." ".getthaiyear($year));	
};

function getthdate($datetime) {
	//echo $datetime;
	$datetime = explode(' ',$datetime);
	$date = $datetime[0];
	$time = $datetime[1];
//	echo "<br>date = $date<br>time = $time<br>";
	$date = explode('-',$date);
	$day = $date[2];
	$month = $date[1];
	$year = $date[0];
//	echo "day = $day / month = $month  / year = $year<br";
	return ($day."/".($month)."/".getthaiyear($year));	
//	return (" ".$day." ".($month)." ".getthaiyear($year));	
};

function getthdatei($datetime) {
	//echo $datetime;
	$datetime = explode(' ',$datetime);
	$date = $datetime[0];
	$time = $datetime[1];
//	echo "<br>date = $date<br>time = $time<br>";
	$date = explode('-',$date);
	$day = $date[2];
	$month = $date[1];
	$year = $date[0];
//	echo "day = $day / month = $month  / year = $year<br";
	return ($day."/".($month)."/".getthaiyear($year).'</br>'.$time.'X' );	
//	return (" ".$day." ".($month)." ".getthaiyear($year));	
};


function getage_thaidate($datetime) {
	echo"datetime = $datetime<br>";
	$nowdatetime = getdate();
	$datetime_cal = strtotime($datetime);
	echo"<br> date_cal = $datetime_cal<br>";
	echo "nowdatetime = $nowdatetime<br>";
	print_r($nowdatetime);
	$age_timestamp =  ($nowdatetime[0] - $datetime_cal);
	echo "age_timestamp = $age_timestamp<br>";
	$age = date('Y n j',$age_timestamp);
	echo "age = $age<br>";	
	$age_date = explode(' ',$age);	
	$day = $age_date[2];
	$month = $age_date[1];
	$year = $age_date[0];
	$year_age = $year -1970;
	echo "day = $day / month = $month  / year_age = $year_age<br>";
	//return ($year_age.' Y '.$month.' M '.$day.' D');	
	echo($year_age.' Y '.$month.' M '.$day.' D');	
};

function getdayofweek($day) {
	//echo $day;
	switch(date('N',$day)) {
	case 1 : return("จันทร์");
	case 2 : return("อังคาร");
	case 3 : return("พุธ");
	case 4 : return("พฤหัส");
	case 5 : return("ศุกร์");
	case 6 : return("เสาร์");
	case 7 : return("อาทิตย์");	
	}
};
function getmonth($month) {
	//echo $month;
	if  ($month == '08') return("สิงหาคม");
	if  ($month == '09') return("กันยายน");
	switch($month) {
	case 01 : return("มกราคม");
	case 02 : return("กุมภาพันธ์");
	case 03 : return("มีนาคม");
	case 04 : return("เมษายน");
	case 05 : return("พฤษภาคม");
	case 06 : return("มิถุนายน");
	case 07 : return("กรกฎาคม");	
	case 08 : return("สิงหาคม");	
	case 09 : return("กันยายน");	
	case 10 : return("ตุลาคม");
	case 11 : return("พฤศจิกายน");	
	case 12 : return("ธันวาคม");
		}
	
};
function getthaiyear($year) {
	return ($year+543);	
};



function stockname($stockcode,$con_stock){
//echo "stockcode = $stockcode";
$sql_getstockname = "select * from STOCKMASTER where stockcode = '$stockcode'";
//echo "<br>sql = $sql_getstockname";
$row_stockname = odbc_exec($con_stock, $sql_getstockname);
//echo "<br>$row_maincate = odbc_exec($con_hos, $sql_getmaincate);<br>";
//echo "<br>row_maincate = $row_maincate";
$ROWS_stockname = ODBC_FETCH_ARRAY($row_stockname);
if ($ROWS_stockname['ENGLISHNAME'] == NULL)
{//echo $ROWS_stockname['EnglishName'];
return(cutfirstchar(iconv('TIS-620','utf-8',$ROWS_stockname['EnglishName'])));
}else{
//	echo $ROWS_stockname['LocalName'];
//return(cutfirstchar(iconv('UTF-8','TIS-620',$ROWS_stockname['LocalName'])));
//return(cutfirstchar(iconv_substr($ROWS_stockname['LocalName'], 0,100, "UTF-8")));
return(cutfirstchar(iconv('TIS-620','utf-8',$ROWS_stockname['LocalName'])));

}}

function stockname1($stockcode,$con_stock){
//echo "stockcode = $stockcode";
$sql_getstockname = "select * from STOCKMASTER where stockcode = '$stockcode'";
//echo "<br>sql = $sql_getstockname";
$row_stockname = odbc_exec($con_stock, $sql_getstockname);
//echo "<br>$row_maincate = odbc_exec($con_hos, $sql_getmaincate);<br>";
//echo "<br>row_maincate = $row_maincate";
$ROWS_stockname = ODBC_FETCH_ARRAY($row_stockname);
if ($ROWS_stockname['StockCode'] == '2030TAMP0618061C'){return 'Blood Lining 6 X 18 Sterile with Tail (charge/piece)';}
if ($ROWS_stockname['StockCode'] == '2030TAMP0818065C'){return 'Blood Lining 18 X 18 Sterile with Tail (charge/piece)';}
if ($ROWS_stockname['ENGLISHNAME'] == NULL)
{//echo $ROWS_stockname['EnglishName'];
return(cutfirstchar(iconv('TIS-620','utf-8',$ROWS_stockname['EnglishName'])));
}else{
//	echo $ROWS_stockname['LocalName'];
//return(cutfirstchar(iconv('UTF-8','TIS-620',$ROWS_stockname['LocalName'])));
//return(cutfirstchar(iconv_substr($ROWS_stockname['LocalName'], 0,100, "UTF-8")));
return(cutfirstchar(iconv('TIS-620','utf-8',$ROWS_stockname['LocalName'])));

}}
//($text, 0,100, "UTF-8");

function hnname($vn,$ydate,$mdate,$dday,$con_hos){
$sql_gethnname = "select firstname+' '+lastname as Name from HNName
 where HNName.hn = (select HNOPD_MASTER.hn from HNOPD_MASTER 
 where year(VisitDate) = '$ydate' and month(VisitDate) = '$mdate' and day(VisitDate) = '$dday' and vn='$vn')";
/*$sql_gethnname = "select STUFF(firstname, 1, 1, '') +' '+STUFF(lastname, 1, 1, '') as Name from HNPAT_NAME where HNPAT_NAME.hn = (select HNOPD_MASTER.hn from HNOPD_MASTER where year(VisitDate) = '$ydate' and month(VisitDate) = '$mdate' and day(VisitDate) = '$dday' and vn='$vn' and dbo.HNPAT_NAME.SuffixSmall = 0)";*/
//echo "<br>sql = $sql_gethnname";
$row_hnname = odbc_exec($con_hos, $sql_gethnname);
//echo "<br>$row_maincate = odbc_exec($con_hos, $sql_getmaincate);<br>";
//echo "<br>row_maincate = $row_maincate";
$ROWS_hnname = ODBC_FETCH_ARRAY($row_hnname);
return(iconv('TIS-620','utf-8',$ROWS_hnname['Name']));
}

function hnname2($vn,$ydate,$mdate,$dday,$con_hos){
$sql_gethnname = "select STUFF(firstname, 1, 1, '') +' '+STUFF(lastname, 1, 1, '') as Name from HNPAT_NAME where HNPAT_NAME.hn = (select HNOPD_MASTER.hn from HNOPD_MASTER where year(VisitDate) = '$ydate' and month(VisitDate) = '$mdate' and day(VisitDate) = '$dday' and vn='$vn' and dbo.HNPAT_NAME.SuffixSmall = 0)";
//echo "<br>sql = $sql_gethnname";
$row_hnname = odbc_exec($con_hos, $sql_gethnname);
//echo "<br>$row_maincate = odbc_exec($con_hos, $sql_getmaincate);<br>";
//echo "<br>row_maincate = $row_maincate";
$ROWS_hnname = ODBC_FETCH_ARRAY($row_hnname);
return $ROWS_hnname['Name'];
}


function hnname1($hn,$con_hos){
$sql_gethnname = "select STUFF(firstname, 1, 1, '') +' '+STUFF(lastname, 1, 1, '') as Name from HNPAT_NAME where HNPAT_NAME.hn = '$hn'";
//echo "<br>sql = $sql_gethnname";
$row_hnname = odbc_exec($con_hos, $sql_gethnname);
//echo "<br>$row_maincate = odbc_exec($con_hos, $sql_getmaincate);<br>";
//echo "<br>row_maincate = $row_maincate";
$ROWS_hnname = ODBC_FETCH_ARRAY($row_hnname);
return(iconv('TIS-620','utf-8',$ROWS_hnname['Name']));
}

function hnname3($hn,$con_hos){
$sql_gethnname = "select InitialName+' '+FirstName+' '+LastName as Name from HNName where hn = '$hn'";
//echo "<br>sql = $sql_gethnname";
$row_hnname = odbc_exec($con_hos, $sql_gethnname);
//echo "<br>$row_maincate = odbc_exec($con_hos, $sql_getmaincate);<br>";
//echo "<br>row_maincate = $row_maincate";
$ROWS_hnname = ODBC_FETCH_ARRAY($row_hnname);
return(iconv('TIS-620','utf-8',$ROWS_hnname['Name']));
}

function hnname4($hn,$con_hos){
$sql_gethnname = "select InitialName as Name from HNName where hn = '$hn'";
//echo "<br>sql = $sql_gethnname";
$row_hnname = odbc_exec($con_hos, $sql_gethnname);
//echo "<br>$row_maincate = odbc_exec($con_hos, $sql_getmaincate);<br>";
//echo "<br>row_maincate = $row_maincate";
$ROWS_hnname = ODBC_FETCH_ARRAY($row_hnname);
return(iconv('TIS-620','utf-8',$ROWS_hnname['Name']));
}
function hnname5($hn,$con_hos){
$sql_gethnname = "select FirstName as Name from HNName where hn = '$hn'";
//echo "<br>sql = $sql_gethnname";
$row_hnname = odbc_exec($con_hos, $sql_gethnname);
//echo "<br>$row_maincate = odbc_exec($con_hos, $sql_getmaincate);<br>";
//echo "<br>row_maincate = $row_maincate";
$ROWS_hnname = ODBC_FETCH_ARRAY($row_hnname);
return(iconv('TIS-620','utf-8',$ROWS_hnname['Name']));
}
function hnname6($hn,$con_hos){
$sql_gethnname = "select LastName as Name from HNName where hn = '$hn'";
//echo "<br>sql = $sql_gethnname";
$row_hnname = odbc_exec($con_hos, $sql_gethnname);
//echo "<br>$row_maincate = odbc_exec($con_hos, $sql_getmaincate);<br>";
//echo "<br>row_maincate = $row_maincate";
$ROWS_hnname = ODBC_FETCH_ARRAY($row_hnname);
return(iconv('TIS-620','utf-8',$ROWS_hnname['Name']));
}
function hnname7($hn,$con_hos){
$sql_gethnname = "select InitialName+'  '+FirstName+'  '+LastName as Name from HNName where hn = '$hn'";
//echo "<br>sql = $sql_gethnname";
$row_hnname = odbc_exec($con_hos, $sql_gethnname);
//echo "<br>$row_maincate = odbc_exec($con_hos, $sql_getmaincate);<br>";
//echo "<br>row_maincate = $row_maincate";
$ROWS_hnname = ODBC_FETCH_ARRAY($row_hnname);
return(iconv('TIS-620','utf-8',$ROWS_hnname['Name']));
}


function syscon($ctrlcode,$code,$con_hos){
$sql_getname = "select STUFF(EnglishName, 1, 1, '') as EnglishName,
 STUFF(LocalName, 1, 1, '') as LocalName
  from DNSYSCONFIG where ctrlcode = '$ctrlcode' and code = '$code'";
//echo "<br>sql = $sql_gethnname";
$row_name = odbc_exec($con_hos, $sql_getname);
//echo "<br>$row_maincate = odbc_exec($con_hos, $sql_getmaincate);<br>";
//echo "<br>row_maincate = $row_maincate";
$ROWS_name = ODBC_FETCH_ARRAY($row_name);
if ($ROWS_name['LocalName'] == NULL)
{
return(iconv('TIS-620','utf-8',$ROWS_name['EnglishName']));
}else{
//return(cutfirstchar(iconv('UTF-8','TIS-620',$ROWS_stockname['LocalName'])));
//return(cutfirstchar(iconv_substr($ROWS_stockname['LocalName'], 0,100, "UTF-8")));
return(iconv('TIS-620','utf-8',$ROWS_name['LocalName']));

}
}

function getGp($userid){
$hostname = "10.6.200.150";
$user = "root";
$password = "Admin@2018";
$dbname = "irreport";
$db_handle = mysql_connect($hostname,$user,$password)or die("Cannot connect to Database");
$db_found = mysql_select_db($dbname)or die("Cannot connect to Database");

$sql = "select * from userlist where userid ='$userid'";
mysql_query("SET NAMES UTF8");
$result = mysql_query($sql);
while ($dn = mysql_fetch_array($result)){
$group =  $dn['groupid'];
return $group;
}
}

function getDepartment($department){
$hostname = "10.6.200.150";
$user = "root";
$password = "Admin@2018";
$dbname = "irreport";
$db_handle = mysql_connect($hostname,$user,$password)or die("Cannot connect to Database");
$db_found = mysql_select_db($dbname)or die("Cannot connect to Database");

$sql = "select * from organization where org_id ='$department'";
mysql_query("SET NAMES UTF8");
$result = mysql_query($sql);
while ($dn = mysql_fetch_array($result)){
$group =  $dn['org_title'];
return $group;
}
}

function hospital($hn,$con_hos)
{
$sql = "select MainHospital from HNPAT_RIGHT where RightCode in ('2100','21002','21003','21004') and HNPAT_RIGHT.HN  = '$hn' and MainHospital is not null";
$row_age = odbc_exec($con_hos, $sql);
$ROWS_age = ODBC_FETCH_ARRAY($row_age);
//echo  $sql.$ROWS_age['MainHospital'];
if ($ROWS_age['MainHospital'] == '' ){return '41556';}
else
{return $ROWS_age['MainHospital'];}
}

function age($hn,$con_hos)
{
$sql = "select DATEDIFF(year, BirthDateTime , DATEADD(year, 0, SYSDATETIME())) AS Age 
from HNPAT_INFO where HNPAT_INFO.HN  = '$hn'";
$row_age = odbc_exec($con_hos, $sql);
$ROWS_age = ODBC_FETCH_ARRAY($row_age);
return $ROWS_age['Age'];
}

function birth($hn,$con_hos)
{
$sql = "select BirthDateTime
from HNPAT_INFO where HNPAT_INFO.HN  = '$hn'";
$row_age = odbc_exec($con_hos, $sql);
$ROWS_age = ODBC_FETCH_ARRAY($row_age);
return $ROWS_age['BirthDateTime'];
}


function ssodoctor($doctor,$con_hos)
{
$sql = "select * from HNDOCTOR_MASTER where doctor = '$doctor'";
$row = odbc_exec($con_hos, $sql);
//echo $sql;
$ROWS = ODBC_FETCH_ARRAY($row);
return iconv('TIS-620','utf-8',$ROWS['SSOID']);
}

function doctor($doctor,$con_hos)
{
$sql = "select * from HNDOCTOR_MASTER where doctor = '$doctor'";
$row = odbc_exec($con_hos, $sql);
//echo $sql;
$ROWS = ODBC_FETCH_ARRAY($row);
//echo $ROWS;
return iconv('TIS-620','utf-8',cutfirstchar($ROWS['LocalName']));
}
function doctore($doctor,$con_hos)
{
$sql = "select * from HNDOCTOR_MASTER where doctor = '$doctor' ";
$row = odbc_exec($con_hos, $sql);
//echo $sql;
$ROWS = ODBC_FETCH_ARRAY($row);
return iconv('TIS-620','utf-8',cutfirstchar($ROWS['EnglishName']));
}

function icd($icd,$con_hos)
{
$sql = "select * from HNICD_MASTER where icdcode = '$icd' ";
$row = odbc_exec($con_hos, $sql);
//echo $sql;
$ROWS = ODBC_FETCH_ARRAY($row);
return iconv('TIS-620','utf-8',cutfirstchar($ROWS['EnglishName']));
}


function icdcm($icd,$con_hos)
{
$sql = "select * from HNICDCM_MASTER where icdcmcode = '$icd' ";
$row = odbc_exec($con_hos, $sql);
//echo $sql;
$ROWS = ODBC_FETCH_ARRAY($row);
return iconv('TIS-620','utf-8',cutfirstchar($ROWS['EnglishName']));
}


function icd2($icd,$con_hos)
{
$sql = "select * from HNICD_MASTER where icdcode = '$icd' ";
$row = odbc_exec($con_hos, $sql);
//echo $sql;
$ROWS = ODBC_FETCH_ARRAY($row);
return iconv('TIS-620','utf-8',cutfirstchar($ROWS['RemarksMemo']));
}

function labrs1($hn,$labcode,$dateA,$dateB,$con_hos){
$sql = "select HNLABREQ_RESULT.LabCode ,HNLABREQ_RESULT.ResultValue from dbo.HNLABREQ_HEADER  left join HNLABREQ_RESULT on dbo.HNLABREQ_HEADER.RequestNo = dbo.HNLABREQ_RESULT.RequestNo
where Clinic in ('150041','14008','15004','14001','15003') and
 HNLABREQ_HEADER.Entrydatetime between convert(datetime,'$dateA',103) and convert(datetime,'$dateB',103)
and HNLABREQ_HEADER.hn in ('$hn')
and labcode = '$labcode'
";
$row_hnname = odbc_exec($con_hos, $sql);
//echo "<br>$row_maincate = odbc_exec($con_hos, $sql_getmaincate);<br>";
//echo $sql;
$ROWS_hnname = ODBC_FETCH_ARRAY($row_hnname);
return(iconv('TIS-620','utf-8',$ROWS_hnname['ResultValue']));
}

function labrs($hn,$labcode,$dateA,$dateB,$con_hos){
$sql = "select HNLABREQ_RESULT.LabCode ,HNLABREQ_RESULT.ResultValue from dbo.HNLABREQ_HEADER  left join HNLABREQ_RESULT on dbo.HNLABREQ_HEADER.RequestNo = dbo.HNLABREQ_RESULT.RequestNo
where
 HNLABREQ_HEADER.Entrydatetime between convert(datetime,'$dateA',103) and convert(datetime,'$dateB',103)
and HNLABREQ_HEADER.hn in ('$hn')
and labcode = '$labcode'
";
$row_hnname = odbc_exec($con_hos, $sql);
//echo "<br>$row_maincate = odbc_exec($con_hos, $sql_getmaincate);<br>";
//echo $sql;
$ROWS_hnname = ODBC_FETCH_ARRAY($row_hnname);
return(iconv('TIS-620','utf-8',$ROWS_hnname['ResultValue']));
}


function get_initialname ($suffix,$con_hos){
	$sql_sel = "
	select LocalName FROM DNSYSCONFIG
	WHERE CTRLCODE = '10241' AND CODE = '$suffix'
	";
	//echo "<br>sql_sel = $sql_sel <br>";
	$row_sel = odbc_exec($con_hos , $sql_sel);
	$ROWS_sel = ODBC_FETCH_ARRAY($row_sel);
	//print_r($ROWS_sel);
	return(cutfirstchar($ROWS_sel['LocalName']));
}



function labtop3($hn,$labcode,$year,$con_hos,$num){
$sql = "
 select * from
 (
select top 3 HNLABREQ_RESULT.LabCode ,HNLABREQ_RESULT.ResultValue ,HNLABREQ_RESULT.LabResultClassifiedType,HNLABREQ_HEADER.EntryDatetime 
,row_number() over (partition by LabCode order by EntryDatetime asc) as rowno
from dbo.HNLABREQ_HEADER left join HNLABREQ_RESULT on dbo.HNLABREQ_HEADER.RequestNo = dbo.HNLABREQ_RESULT.RequestNo
where year(HNLABREQ_HEADER.Entrydatetime) = '$year' and HNLABREQ_HEADER.hn in ('$hn') and labcode = '$labcode' and CxlReasonCode is null
order by HNLABREQ_HEADER.Entrydatetime asc 
  ) q
where rowno = '$num'";
$row_hnname = odbc_exec($con_hos, $sql);

//echo $row_hnname;
$num = odbc_num_rows($row_hnname);
if ($num == 0)
{echo '<td>&nbsp;'.'</td>'.'<td>&nbsp;'.'</td>'; }

//echo  $sql;
 while($ROWS_hnname = ODBC_FETCH_ARRAY($row_hnname)){ 
//echo "<br>$row_maincate = odbc_exec($con_hos, $sql_getmaincate);<br>";
$td =  '<td>';
if($ROWS_hnname['LabResultClassifiedType'] == '1')
{$td =  '<td bgcolor="#FFFF00">';}
if($ROWS_hnname['LabResultClassifiedType'] == '3')
{$td =  '<td bgcolor="#FF0000">';}

if(($ROWS_hnname['LabCode'] == 'C1001' and $ROWS_hnname['ResultValue'] >= 126)
or ($ROWS_hnname['LabCode'] == 'DTX' and $ROWS_hnname['ResultValue'] >= 200)
or ($ROWS_hnname['LabCode'] == 'C1032' and $ROWS_hnname['ResultValue'] >= 6.5)
or ($ROWS_hnname['LabCode'] == 'CR01' and $ROWS_hnname['ResultValue'] < 60)
or ($ROWS_hnname['LabCode'] == 'C1057' and $ROWS_hnname['ResultValue'] > 100)
)
{$td =  '<td bgcolor="#FF0000">';}
else if($ROWS_hnname['LabCode'] == 'C1001' or 
$ROWS_hnname['LabCode'] == 'DTX' or
$ROWS_hnname['LabCode'] == 'C1032' or
$ROWS_hnname['LabCode'] == 'CR01' or 
$ROWS_hnname['LabCode'] == 'C1057' 
)
{$td =  '<td>';}


echo $td.(iconv('TIS-620','utf-8',$ROWS_hnname['ResultValue'])).' </td>';
echo '<td>'.getthdate($ROWS_hnname['EntryDatetime']).'</td>';
//$ROWS_hnname = ODBC_FETCH_ARRAY($row_hnname);
//return(iconv('TIS-620','utf-8',$ROWS_hnname['ResultValue']));
 }
}

function labck($hn,$labcode,$year,$con_hos,$num){
$sql = "
 select * from
 (
select top 3 HNLABREQ_RESULT.LabCode ,HNLABREQ_RESULT.ResultValue ,HNLABREQ_HEADER.EntryDatetime 
,row_number() over (partition by LabCode order by EntryDatetime asc) as rowno
from dbo.HNLABREQ_HEADER left join HNLABREQ_RESULT on dbo.HNLABREQ_HEADER.RequestNo = dbo.HNLABREQ_RESULT.RequestNo
where year(HNLABREQ_HEADER.Entrydatetime) = '$year' and HNLABREQ_HEADER.hn in ('$hn') and labcode = '$labcode' and CxlReasonCode is null
order by HNLABREQ_HEADER.Entrydatetime asc 
  ) q
where rowno = '$num'";
$row_hnname = odbc_exec($con_hos, $sql);

//echo $row_hnname;
$num = odbc_num_rows($row_hnname);
if ($num == 0)
{return 0; }
else  {return 1; }

//echo  $sql;
 while($ROWS_hnname = ODBC_FETCH_ARRAY($row_hnname)){ 
//echo "<br>$row_maincate = odbc_exec($con_hos, $sql_getmaincate);<br>";
//echo '<td>'.(iconv('TIS-620','utf-8',$ROWS_hnname['ResultValue'])).' </td>';
//echo '<td>'.getthdate($ROWS_hnname['EntryDatetime']).' </td>';
//$ROWS_hnname = ODBC_FETCH_ARRAY($row_hnname);
//return(iconv('TIS-620','utf-8',$ROWS_hnname['ResultValue']));
 }
}

function labckd($hn,$labcode,$year,$month,$day,$con_hos,$num){
$sql = "
 select * from
 (
select top 3 HNLABREQ_RESULT.LabCode ,HNLABREQ_RESULT.ResultValue ,HNLABREQ_HEADER.EntryDatetime 
,row_number() over (partition by LabCode order by EntryDatetime asc) as rowno
from dbo.HNLABREQ_HEADER left join HNLABREQ_RESULT on dbo.HNLABREQ_HEADER.RequestNo = dbo.HNLABREQ_RESULT.RequestNo
where year(HNLABREQ_HEADER.Entrydatetime) = '$year'
and month(HNLABREQ_HEADER.Entrydatetime) = '$month'
and day(HNLABREQ_HEADER.Entrydatetime) = '$day'
 and HNLABREQ_HEADER.hn in ('$hn') and labcode = '$labcode' 
 and CxlReasonCode is null
order by HNLABREQ_HEADER.Entrydatetime asc 
  ) q
where rowno = '$num'";
$row_hnname = odbc_exec($con_hos, $sql);

//echo $row_hnname;
$num = odbc_num_rows($row_hnname);
if ($num == 0)
{return 0; }
else  {return 1; }

//echo  $sql;
 while($ROWS_hnname = ODBC_FETCH_ARRAY($row_hnname)){ 
//echo "<br>$row_maincate = odbc_exec($con_hos, $sql_getmaincate);<br>";
//echo '<td>'.(iconv('TIS-620','utf-8',$ROWS_hnname['ResultValue'])).' </td>';
//echo '<td>'.getthdate($ROWS_hnname['EntryDatetime']).' </td>';
//$ROWS_hnname = ODBC_FETCH_ARRAY($row_hnname);
//return(iconv('TIS-620','utf-8',$ROWS_hnname['ResultValue']));
 }
}


function xraytop3($hn,$xraycode,$year,$con_hos,$num){
$sql = "
 select * from
 (
select top 3 row_number() over (partition by XrayCodeCollection order by HNXRAYREQ_HEADER.EntryDatetime asc)as rowno,hn,ImpressionMemo,HNXRAYREQ_HEADER.Entrydatetime from HNXRAYREQ_HEADER 
left join dbo.HNXRAYREQ_RESULT ON dbo.HNXRAYREQ_RESULT.FacilityRmsNo = dbo.HNXRAYREQ_HEADER.FacilityRmsNo AND dbo.HNXRAYREQ_RESULT.RequestNo = dbo.HNXRAYREQ_HEADER.RequestNo
where year(HNXRAYREQ_HEADER.Entrydatetime) = '$year' 
and HNXRAYREQ_HEADER.hn in ('$hn')
and XrayCodeCollection like ('$xraycode')
) q
where rowno = '$num'";
$row_hnname = odbc_exec($con_hos, $sql);

//echo $row_hnname;
$num = odbc_num_rows($row_hnname);
if ($num == 0)
{echo '<td>&nbsp;'.'</td>'.'<td>&nbsp;'.'</td>'; }

//echo  $sql;
 while($ROWS_hnname = ODBC_FETCH_ARRAY($row_hnname)){ 
//echo "<br>$row_maincate = odbc_exec($con_hos, $sql_getmaincate);<br>";
echo '<td>'.(iconv('TIS-620','utf-8',$ROWS_hnname['ImpressionMemo'])).' </td>';
echo '<td>'.getthdate($ROWS_hnname['Entrydatetime']).' </td>';
//$ROWS_hnname = ODBC_FETCH_ARRAY($row_hnname);
//return(iconv('TIS-620','utf-8',$ROWS_hnname['ResultValue']));
 }
}

function medtop3($hn,$stockcode,$year,$con_hos,$num,$con_stock){
$sql = "
   select * from
 (
select top 3 row_number() over (partition by stockcode order by HNOPD_PRESCRIP_MEDICINE.MakeDatetime asc)as rowno
,HNOPD_MASTER.hn,HNOPD_PRESCRIP_MEDICINE.MakeDatetime,stockcode,qty  from HNOPD_MASTER 
 left join HNOPD_Prescrip on dbo.HNOPD_PRESCRIP.VisitDate = dbo.HNOPD_MASTER.VisitDate AND dbo.HNOPD_PRESCRIP.VN = dbo.HNOPD_MASTER.VN
 left join dbo.HNOPD_PRESCRIP_MEDICINE ON dbo.HNOPD_PRESCRIP_MEDICINE.VisitDate = dbo.HNOPD_PRESCRIP.VisitDate AND dbo.HNOPD_PRESCRIP_MEDICINE.VN = dbo.HNOPD_PRESCRIP.VN AND dbo.HNOPD_PRESCRIP_MEDICINE.PrescriptionNo = dbo.HNOPD_PRESCRIP.PrescriptionNo
 where year(HNOPD_PRESCRIP_MEDICINE.MakeDatetime) = '$year' 
 and stockcode = '$stockcode'
and HNOPD_MASTER.hn in ('$hn')
) q
where rowno = '$num'";
$row_hnname = odbc_exec($con_hos, $sql);

//echo $row_hnname;
$num = odbc_num_rows($row_hnname);
if ($num == 0)
{echo '<td>&nbsp;'.'</td>'.'<td>&nbsp;'.'</td>'; }

//echo  $sql;
 while($ROWS_hnname = ODBC_FETCH_ARRAY($row_hnname)){ 
//echo "<br>$row_maincate = odbc_exec($con_hos, $sql_getmaincate);<br>";


echo '<td>'.$ROWS_hnname['qty'].' </td>';
echo '<td>'.getthdate($ROWS_hnname['MakeDatetime']).' </td>';
//$ROWS_hnname = ODBC_FETCH_ARRAY($row_hnname);
//return(iconv('TIS-620','utf-8',$ROWS_hnname['ResultValue']));
 }
}

///////////////////////////////////////////////////////////////////////////////


function labtop3m($hn,$labcode,$year,$month,$con_hos,$num){
$sql = "
 select * from
 (
select top 3 HNLABREQ_RESULT.LabCode ,HNLABREQ_RESULT.ResultValue ,HNLABREQ_RESULT.LabResultClassifiedType,HNLABREQ_HEADER.EntryDatetime 
,row_number() over (partition by LabCode order by EntryDatetime asc) as rowno
from dbo.HNLABREQ_HEADER left join HNLABREQ_RESULT on dbo.HNLABREQ_HEADER.RequestNo = dbo.HNLABREQ_RESULT.RequestNo
where year(HNLABREQ_HEADER.Entrydatetime) = '$year' and 
month(HNLABREQ_HEADER.Entrydatetime) = '$month' and HNLABREQ_HEADER.hn in ('$hn') and labcode = '$labcode' and CxlReasonCode is null
order by HNLABREQ_HEADER.Entrydatetime asc 
  ) q
where rowno = '$num'";
//echo $sql;
$row_hnname = odbc_exec($con_hos, $sql);

//echo $row_hnname;
$num = odbc_num_rows($row_hnname);
if ($num == 0)
{echo '<td>&nbsp;'.'</td>'.'<td>&nbsp;'.'</td>'; }

//echo  $sql;
 while($ROWS_hnname = ODBC_FETCH_ARRAY($row_hnname)){ 
//echo "<br>$row_maincate = odbc_exec($con_hos, $sql_getmaincate);<br>";
$td =  '<td>';
if($ROWS_hnname['LabResultClassifiedType'] == '1')
{$td =  '<td bgcolor="#FFFF00">';}
if($ROWS_hnname['LabResultClassifiedType'] == '3')
{$td =  '<td bgcolor="#FF0000">';}
if(($ROWS_hnname['LabCode'] == 'C1001' and $ROWS_hnname['ResultValue'] >= 126)
or ($ROWS_hnname['LabCode'] == 'DTX' and $ROWS_hnname['ResultValue'] >= 200)
or ($ROWS_hnname['LabCode'] == 'C1032' and $ROWS_hnname['ResultValue'] >= 6.5)
or ($ROWS_hnname['LabCode'] == 'CR01' and $ROWS_hnname['ResultValue'] < 60)
or ($ROWS_hnname['LabCode'] == 'C1057' and $ROWS_hnname['ResultValue'] > 100)
)

{$td =  '<td bgcolor="#FF0000">';}
else if($ROWS_hnname['LabCode'] == 'C1001' or 
$ROWS_hnname['LabCode'] == 'DTX' or
$ROWS_hnname['LabCode'] == 'C1032' or
$ROWS_hnname['LabCode'] == 'CR01' or 
$ROWS_hnname['LabCode'] == 'C1057' 
)

{$td =  '<td>';}

echo $td.(iconv('TIS-620','utf-8',$ROWS_hnname['ResultValue'])).' </td>';
echo '<td>'.getthdate($ROWS_hnname['EntryDatetime']).'</td>';
//$ROWS_hnname = ODBC_FETCH_ARRAY($row_hnname);
//return(iconv('TIS-620','utf-8',$ROWS_hnname['ResultValue']));
 }
}

function labtop3d($hn,$labcode,$year,$month,$day,$con_hos,$num){
$sql = "
 select * from
 (
select top 3 HNLABREQ_RESULT.LabCode ,HNLABREQ_RESULT.ResultValue ,HNLABREQ_RESULT.LabResultClassifiedType,HNLABREQ_HEADER.EntryDatetime 
,row_number() over (partition by LabCode order by EntryDatetime asc) as rowno
from dbo.HNLABREQ_HEADER left join HNLABREQ_RESULT on dbo.HNLABREQ_HEADER.RequestNo = dbo.HNLABREQ_RESULT.RequestNo
where year(HNLABREQ_HEADER.Entrydatetime) = '$year' and 
month(HNLABREQ_HEADER.Entrydatetime) = '$month'
and day(HNLABREQ_HEADER.Entrydatetime) = '$day'
 and HNLABREQ_HEADER.hn in ('$hn') and labcode = '$labcode' and CxlReasonCode is null
order by HNLABREQ_HEADER.Entrydatetime asc 
  ) q
where rowno = '$num'";
//echo $sql;
$row_hnname = odbc_exec($con_hos, $sql);

//echo $row_hnname;
$num = odbc_num_rows($row_hnname);
if ($num == 0)
{echo '<td>&nbsp;'.'</td>'.'<td>&nbsp;'.'</td>'; }

//echo  $sql;
 while($ROWS_hnname = ODBC_FETCH_ARRAY($row_hnname)){ 
//echo "<br>$row_maincate = odbc_exec($con_hos, $sql_getmaincate);<br>";
$td =  '<td>';
if($ROWS_hnname['LabResultClassifiedType'] == '1')
{$td =  '<td bgcolor="#FFFF00">';}
if($ROWS_hnname['LabResultClassifiedType'] == '3')
{$td =  '<td bgcolor="#FF0000">';}
if(($ROWS_hnname['LabCode'] == 'C1001' and $ROWS_hnname['ResultValue'] >= 126)
or ($ROWS_hnname['LabCode'] == 'DTX' and $ROWS_hnname['ResultValue'] >= 200)
or ($ROWS_hnname['LabCode'] == 'C1032' and $ROWS_hnname['ResultValue'] >= 6.5)
or ($ROWS_hnname['LabCode'] == 'CR01' and $ROWS_hnname['ResultValue'] < 60)
or ($ROWS_hnname['LabCode'] == 'C1057' and $ROWS_hnname['ResultValue'] > 100)
)

{$td =  '<td bgcolor="#FF0000">';}
else if($ROWS_hnname['LabCode'] == 'C1001' or 
$ROWS_hnname['LabCode'] == 'DTX' or
$ROWS_hnname['LabCode'] == 'C1032' or
$ROWS_hnname['LabCode'] == 'CR01' or 
$ROWS_hnname['LabCode'] == 'C1057' 
)

{$td =  '<td>';}

echo $td.(iconv('TIS-620','utf-8',$ROWS_hnname['ResultValue'])).' </td>';
echo '<td>'.getthdate($ROWS_hnname['EntryDatetime']).'</td>';
//$ROWS_hnname = ODBC_FETCH_ARRAY($row_hnname);
//return(iconv('TIS-620','utf-8',$ROWS_hnname['ResultValue']));
 }
}


function labckm($hn,$labcode,$year,$month,$con_hos,$num){
$sql = "
 select * from
 (
select top 3 HNLABREQ_RESULT.LabCode ,HNLABREQ_RESULT.ResultValue ,HNLABREQ_HEADER.EntryDatetime 
,row_number() over (partition by LabCode order by EntryDatetime asc) as rowno
from dbo.HNLABREQ_HEADER left join HNLABREQ_RESULT on dbo.HNLABREQ_HEADER.RequestNo = dbo.HNLABREQ_RESULT.RequestNo
where year(HNLABREQ_HEADER.Entrydatetime) = '$year' and
month(HNLABREQ_HEADER.Entrydatetime) = '$month' and 
HNLABREQ_HEADER.hn in ('$hn') and labcode = '$labcode' and CxlReasonCode is null
order by HNLABREQ_HEADER.Entrydatetime asc 
  ) q
where rowno = '$num'";
$row_hnname = odbc_exec($con_hos, $sql);

//echo $row_hnname;
$num = odbc_num_rows($row_hnname);
if ($num == 0)
{return 0; }
else  {return 1; }

//echo  $sql;
 while($ROWS_hnname = ODBC_FETCH_ARRAY($row_hnname)){ 
//echo "<br>$row_maincate = odbc_exec($con_hos, $sql_getmaincate);<br>";
//echo '<td>'.(iconv('TIS-620','utf-8',$ROWS_hnname['ResultValue'])).' </td>';
//echo '<td>'.getthdate($ROWS_hnname['EntryDatetime']).' </td>';
//$ROWS_hnname = ODBC_FETCH_ARRAY($row_hnname);
//return(iconv('TIS-620','utf-8',$ROWS_hnname['ResultValue']));
 }
}


function xraytop3m($hn,$xraycode,$year,$month,$con_hos,$num){
$sql = "
 select * from
 (
select top 3 row_number() over (partition by XrayCodeCollection order by HNXRAYREQ_HEADER.EntryDatetime asc)as rowno,hn,ImpressionMemo,HNXRAYREQ_HEADER.Entrydatetime from HNXRAYREQ_HEADER 
left join dbo.HNXRAYREQ_RESULT ON dbo.HNXRAYREQ_RESULT.FacilityRmsNo = dbo.HNXRAYREQ_HEADER.FacilityRmsNo AND dbo.HNXRAYREQ_RESULT.RequestNo = dbo.HNXRAYREQ_HEADER.RequestNo
where year(HNXRAYREQ_HEADER.Entrydatetime) = '$year' 
and  month(HNXRAYREQ_HEADER.Entrydatetime) = '$month' 
and HNXRAYREQ_HEADER.hn in ('$hn')
and XrayCodeCollection like ('$xraycode')
) q
where rowno = '$num'";
$row_hnname = odbc_exec($con_hos, $sql);

//echo $row_hnname;
$num = odbc_num_rows($row_hnname);
if ($num == 0)
{echo '<td>&nbsp;'.'</td>'.'<td>&nbsp;'.'</td>'; }

//echo  $sql;
 while($ROWS_hnname = ODBC_FETCH_ARRAY($row_hnname)){ 
//echo "<br>$row_maincate = odbc_exec($con_hos, $sql_getmaincate);<br>";
echo '<td>'.(iconv('TIS-620','utf-8',$ROWS_hnname['ImpressionMemo'])).' </td>';
echo '<td>'.getthdate($ROWS_hnname['Entrydatetime']).' </td>';
//$ROWS_hnname = ODBC_FETCH_ARRAY($row_hnname);
//return(iconv('TIS-620','utf-8',$ROWS_hnname['ResultValue']));
 }
}

function medtop3m($hn,$stockcode,$year,$month,$con_hos,$num,$con_stock){
$sql = "
   select * from
 (
select top 3 row_number() over (partition by stockcode order by HNOPD_PRESCRIP_MEDICINE.MakeDatetime asc)as rowno
,HNOPD_MASTER.hn,HNOPD_PRESCRIP_MEDICINE.MakeDatetime,stockcode,qty  from HNOPD_MASTER 
 left join HNOPD_Prescrip on dbo.HNOPD_PRESCRIP.VisitDate = dbo.HNOPD_MASTER.VisitDate AND dbo.HNOPD_PRESCRIP.VN = dbo.HNOPD_MASTER.VN
 left join dbo.HNOPD_PRESCRIP_MEDICINE ON dbo.HNOPD_PRESCRIP_MEDICINE.VisitDate = dbo.HNOPD_PRESCRIP.VisitDate AND dbo.HNOPD_PRESCRIP_MEDICINE.VN = dbo.HNOPD_PRESCRIP.VN AND dbo.HNOPD_PRESCRIP_MEDICINE.PrescriptionNo = dbo.HNOPD_PRESCRIP.PrescriptionNo
 where year(HNOPD_PRESCRIP_MEDICINE.MakeDatetime) = '$year' 
  and month(HNOPD_PRESCRIP_MEDICINE.MakeDatetime) = '$month' 
 and stockcode = '$stockcode'
and HNOPD_MASTER.hn in ('$hn')
) q
where rowno = '$num'";
$row_hnname = odbc_exec($con_hos, $sql);

//echo $row_hnname;
$num = odbc_num_rows($row_hnname);
//if ($num == 0)
//{echo '<td>&nbsp;'.'</td>'.'<td>&nbsp;'.'</td>'; }

//echo  $sql;
 while($ROWS_hnname = ODBC_FETCH_ARRAY($row_hnname)){ 
//echo "<br>$row_maincate = odbc_exec($con_hos, $sql_getmaincate);<br>";
echo '<td>'.stockname($ROWS_hnname['stockcode']).' </td>';
echo '<td>'.getthdate($ROWS_hnname['MakeDatetime']).' </td>';
//$ROWS_hnname = ODBC_FETCH_ARRAY($row_hnname);
//return(iconv('TIS-620','utf-8',$ROWS_hnname['ResultValue']));
 }
}

function medtop3mec($hn,$stockcode,$year,$month,$con_hos,$num,$con_stock){

if ($stockcode == '1')
{
	$stockset = "'0110B11G0100O01','0110B05B0002O01','0110B19O0055O01','0110B16T0005O01',
'0110B14J0100O01','0110B06G0005L03','0110B08G0080L03','0110B08D0060O03','0110B02A0003L05','0110B02A0002O02','0110B02A0001O01','0110B10G0005L01','0110B10M0005O02','0110B14J0025O01','0110B14J0010O02','0110B12M0500L03','0110B12M0850L04','0110B12G0500O01','0110B11G0050O02','0110B01A0030L01','0210H05V0006O01','0110B15N0001O01','0110B15N0002O02',
'0210A08G0000L01','0210A08G0000L02','0210A08G7030L03','0210A02H0000O05','0210A03N0003O07'";
}
if ($stockcode == '2')
{$stockset = "
	'0102E01A0005L03',
'0102E01A0010L02',
'0102E01N0005O05',
'0102F13N0025O03',
'0102E09V0040L01',
'0102E06I0240O05',
'0102D04C0005O02',
'0102D04C0025O01',
'0102D05L0875O01',
'0102D05L1125O02',
'0102D01A0025L02',
'0102D01A0050L03',
'0102D01A0100L01',
'0102D03C0025L04',
'0102D03C0625L05',
'0102D03C0125L03',
'0202D02E0100L01',
'0102D02M0100L02',
'0102D02B0100O02',
'0102D07P0010L01',
'0102D07P0040L03',
'0102E04D0030L02',
'0102E04D0060L03',
'0102E04H0090O07',
'0102E04D0120L01',
'0102E03C0120O01',
'0102G03D0002L04',
'0102G03C0002O02',
'0102G03C0004O03',
'0102C02C0025L04',
'0102C04E0005L01',
'0102C04E0020L02',
'0102E06F0005L03',
'0102E06F0010L01',
'0102E08P0005O03',
'0102E08P0010O01',
'0102G02A0010L01',
'0102G02A0025L02',
'0102H03D0050L01',
'0102F10I0300L01',
'0102F10I0150L02',
'0102F04C3125O01',
'0102F01A0150O02',
'0102E10Z0010O01',
'0102C05L0010L01',
'0102F04L0050L02',
'0102F04L0100L03',
'0102E07M0020L01',
'0102E07M0020O02',
'0102E07M0010O01',
'0102G01A0250L02',
'0102G01A0125L01',
'0102A08N0005L03',
'0102A08N0020L02',
'0102A08N0010L01',
'0102A01A0030O01',
'0102F09O0020L02',
'0102F09O0040L01',
'0102C03C0005O03',
'0102G08M0001L01',
'0102G08M0002L02',
'0102C08T0025O06',
'0102F05D0080O04',
'0102F05D0160O03',
'0102F02B0008O03',
'0102F02B0016O01'
	";
}
if ($stockcode == '3a')
{$stockset = "
	'0217B06B0003O01',
'0108F07L0150L02',
'0108F11H0010O01',
'0108F26B0001O02',
'0108F22V0300L01'
	";
}
if ($stockcode == '3b')
{$stockset = "
	'0102H05F0040L01',
'0102H05F0500L02',
'0102H01A0025L02',
'0102H01A0100L03',
'0301E04L0100L02',
'0102D07P0010L01',
'0102D07P0040L03',
'0102D01A0025L02',
'0102D01A0050L03',
'0102D01A0100L01',
'0102B01I0020O01',
'0102B01I0020L02'
	";
}
if ($stockcode == '4')
{$stockset = "
'0102H05F0040L01',
'0102H05F0500L02',
'0102H01A0025L02',
'0102H01A0100L03',
'0102H03D0050L01',
'0102G02A0010L01',
'0102G02A0025L02',
'0102B03I0005L07',
'0102B03I0010L04',
'0102B03I0010O01',
'0102B01I0020L02',
'0102B01I0020O01',
'0102A07L0250O02',
'0102A07L0625O03',
'0102D03C0025L04',
'0102D03C0625L05',
'0102D03C0125L03',
'0102D02M0100L02',
'0102D02B0100O02',
'0102D04C0005O02',
'0102D04C0025O01',
'0102D05L0875O01',
'0102D05L1125O02',
'0102D01A0025L02',
'0102D01A0050L03',
'0102D01A0100L01',
'0102F04L0050L02',
'0102F04L0100L03',
'0102F02B0008O03',
'0102F02B0016O01',
'0102F04C3125O01',
'0102F10I0150L02',
'0102F10I0300L01',
'0102F01A0150O02',
'0102F05D0080O04',
'0102F05D0160O03',
'0102C04E0005L01',
'0102C04E0020L02',
'0102C05L0010L01',
'0102C08T0025O06'
	";
}
if ($stockcode == '5')
{$stockset = "
	'0102E01A0005L03',
'0102E01A0010L02',
'0102E01N0005O05',
'0102F13N0025O03',
'0102E09V0040L01',
'0102E06I0240O05',
'0102D04C0005O02',
'0102D04C0025O01',
'0102D05L0875O01',
'0102D05L1125O02',
'0102D01A0025L02',
'0102D01A0050L03',
'0102D01A0100L01',
'0102D03C0025L04',
'0102D03C0625L05',
'0102D03C0125L03',
'0202D02E0100L01',
'0102D02M0100L02',
'0102D02B0100O02',
'0102D07P0010L01',
'0102D07P0040L03',
'0102E04D0030L02',
'0102E04D0060L03',
'0102E04H0090O07',
'0102E04D0120L01',
'0102E03C0120O01',
'0102G03D0002L04',
'0102G03C0002O02',
'0102G03C0004O03',
'0102C02C0025L04',
'0102C04E0005L01',
'0102C04E0020L02',
'0102E06F0005L03',
'0102E06F0010L01',
'0102E08P0005O03',
'0102E08P0010O01',
'0102G02A0010L01',
'0102G02A0025L02',
'0102H03D0050L01',
'0102F10I0300L01',
'0102F10I0150L02',
'0102F04C3125O01',
'0102F01A0150O02',
'0102E10Z0010O01',
'0102C05L0010L01',
'0102F04L0050L02',
'0102F04L0100L03',
'0102E07M0020L01',
'0102E07M0020O02',
'0102E07M0010O01',
'0102G01A0250L02',
'0102G01A0125L01',
'0102A08N0005L03',
'0102A08N0020L02',
'0102A08N0010L01',
'0102A01A0030O01',
'0102F09O0020L02',
'0102F09O0040L01',
'0102C03C0005O03',
'0102G08M0001L01',
'0102G08M0002L02',
'0102C08T0025O06',
'0102F05D0080O04',
'0102F05D0160O03',
'0102F02B0008O03',
'0102F02B0016O01',
'0102N02A0081L01',
'0104C03A0300L01',
'0104C03A0325L01',
'0102N03O0003L03',
'0102N03O0005L05',
'0102N08X0010O01',
'0102N08X0015O03',
'0102N09E0005O01',
'0102N01P0110O01',
'0102J11C0050L01',
'0102N01D0025L01',
'0102N04P0075L01',
'0102N04P0075L02',
'0102N04P0075O01',
'0110E08L00100L04',
'0110E08L0010O01',
'0110E08L00200L05',
'0110E08L00400L06',
'0310E01Q0000L01',
'0110E04E0010L01',
'0110E04E0010O01',
'0110E05F0100L01',
'0110E05F0160L02',
'0110E05F0300L03',
'0110E05T0135O08',
'0110E09M0040O02',
'0110E06G0300L01',
'0110E06G0600L02',
'0110E03C0010O01',
'0110E03R0020L02',
'0110E12S0010L01',
'0110E12S0020L02',
'0110E12S0040L03',
'0110E10N0050L03'
	";
}
if ($stockcode == '6')
{$stockset = "
	'0108G06E0050L02',
'0108G14M0025L01'";
}
if ($stockcode == '7')
{$stockset = "
	'0108F07L0150F02',
'0108F07L0150L02',
'0108F22V0300F01',
'0108F22V0300L01',
'0108F04C0300F02',
'0108F10Z0100F04',
'0108F10Z0100L04',
'0108F19S0600O02',
'0108F25E0600F03',
'0108F13N0200F01',
'0108F09G0030F01',
'0108F09G0030L01',
'0108F10G0250F01',
'0108F10G0250L01',
'0108F13N0200L01',
'0108F12K0166O01',
'0108F03A0125F01',
'0108F14N0100F01',
'0108F25I0100O01',
'0108F07E0025O01',
'0108F07E0025F01',
'0108F17A0300F01',
'0108F17A0300O01',
'0108F28P0300O01',
'0108F28P0600O02F',
'0108F27I0400O01',
'0108F18S0030F01',
'0108F18S0030L01',
'0108F20T1100F01',
'0108F20T1100L01'
";
}
if ($stockcode == '8')
{$stockset = "
	'0103B06S0002L01',
'0303B08S0060L01',
'0503B09S0020L04',
'0503B09V0200O05',
'0503B09S0100L02',
'0103B08T0025L01',
'0503B12S0025O01',
'0103B09T0200L01',
'0103B12D0500O01',
'0503B10S0025O04',
'0503B10S0050O03',
'0503B10S0025L01'
	";
}
if ($stockcode == '9')
{$stockset = "
	'0110F03C0002L01',
'0110F07R0025L02',
'0110F02A0025L01',
'0111E15F0200L01',
'0111E04F0000L01',
'0202R01E0004L05P',
'0202R01E0004L11',
'0202R01E0004L08',
'0119A01S0300L01',
'0111D07C0600L05',
'0111D07C0835L06',
'0111D07C1000L03',
'0101A02A0500L01'	";
}
if ($stockcode == '10')
{$stockset = "
	'0104N02B0025L01',
'0104N07T0050O02',
'0404N03N0002O01',
'0104N04J0005L01',
'0104N05M0250L01'
	";
}
if ($stockcode == '11')
{$stockset = "
	'0117C02I0050L02',
'0117C01C0025L03',
'0117C01C0100L02',
'0117C03M0250L01',
'0117C03M0360O01',
'0105D03P0005L02',
'0104P01P0060L01'
	";
}
if ($stockcode == '12')
{$stockset = "
	'0104H01C0200L01',
'0104F02C0100L01',
'0102H03D0050L01',
'0104C14I0200L01',
'0104C14I0400L02',
'0104C14S0400O03',
'0104C15I0025L01'
	";
}
if ($stockcode == '13')
{$stockset = "
	'0117C02I0050L02',
'0108G06E0050L02',
'0217B06B0003O01',
'0108G14M0025L01'
	";
}
if ($stockcode == '14')
{$stockset = "
	'0110E08L00400L06',
'0110E08L00200L05',
'0110E08L0010O01',
'0110E08L00100L04',
'0110E15X0020O02',
'0110E15X0010O01',
'0110E15X0040O03',
'0310E01Q0000L01',
'0110E04E0010O01',
'0110E04E0010L01',
'0110E05F0100L01',
'0110E05F0160L02',
'0110E05F0300L03',
'0110E05T0135O08',
'0110E09M0040O02',
'0110E06G0300L01',
'0110E06G0600L02',
'0110E03C0010O01',
'0110E03R0020L02',
'0110E12S0010L01',
'0110E12S0020L02',
'0110E12S0040L03',
'0110E10N0050L03'
	";
}
if ($stockcode == '15')
{$stockset = "
	'0117A11H0200L01',
'0108G14M0025L01',
'0105D03P0005L02',
'0104C24S0500L02',
'0108H02C0250L01'
	";
}
if ($stockcode == '16')
{$stockset = "
	'0102H02D0250O03',
'0513F06L0000O01',
'0513F01A0000O02',
'0513F10C0000O01',
'0513F03A0000O01',
'0513F08T0002O01',
'0513F06L0000L01',
'0513F09X0000O01',
'0513F08T0025O01',
'0513F08T0003O01',
'0513F05G0000L01',
'0513F08T0005O01',
'0513F08T0000O01'
	";
}
if ($stockcode == '17')
{$stockset = "
	'0117C01C0025L03',
'0117C01C0100L02',
'0108G06E0050L02',
'0117C03M0250L01',
'0117C03M0360O01',
'0105D03P0005L02',
'0204C05M0500O01'
	";
}
if ($stockcode == '18')
{$stockset = "
	'0117A11H0200L01',
'0108G14M0025L01',
'0105D03P0005L02',
'0104C24S0500L02',
'0108H02C0250L01',
'0108G06E0050L02',
'0117C01C0025L03',
'0117C01C0100L02',
'0117C03M0250L01',
'0117C03M0360O01',
'0117C02I0050L02'
	";
}
if ($stockcode == '19')
{$stockset = "
	'0117C01C0025L03',
'0117C01C0100L02',
'0108G06E0050L02',
'0105F01A0050L01'
	";
}
if ($stockcode == '20')
{$stockset = "
	'0118A03D0500L03',
'0218A04D0500O01',
'0111I01F0005L02'
	";
}
if ($stockcode == '21')
{$stockset = "
	
	";
}
if ($stockcode == '22')
{$stockset = "
	'0114H01N0025O01',
'0414B01B0450L01',
'0414C04B0500L02',
'0414C04B0000O03',
'0414C05C0500L02',
'0414H02C0450L01',
'0117C01C0025L03',
'0117C01C0100L02',
'0108G14M0025L01',
'0414C15T0500L01',
'0414C16T0500L02',
'0414C16T0060L03'
	";
}
if ($stockcode == '23a')
{$stockset = "
	'0117C02I0050L02',
'0108G06E0050L02',
'0117C01C0025L03',
'0117C01C0100L02',
'0108E02D0100L01',
'0117C03M0250L01',
'0117C03M0360O01',
'0105D03P0005L02'
	";
}
if ($stockcode == '23b')
{$stockset = "
	'0117C02I0050L02',
'0414B01B0450L01',
'0414C04B0500L02',
'0414C04B0000O03',
'0414C05C0500L02',
'0108G06E0050L02',
'0108E02D0100L01',
'0105D01D0004L02',
'0105D01D0005L01',
'0107H06D0100L01',
'0107D05E0250L01',
'0205D04S0100L02',
'0205D05S1000L01',
'0107H08M0500L01',
'0117C03M0250L01',
'0117C03M0360O01',
'0105D03P0005L02',
'0107H07T0250L01',
'0414C15T0500L01',
'0414C16T0500L02',
'0414C16T0060L03'
	";
}
if ($stockcode == '23c')
{$stockset = "
	'0108E02D0100L01',
'0104C24S0500L02',
'0414B01B0450L01',
'0414C04B0500L02',
'0414C05C0500L02',
'0414C15T0500L01',
'0414C16T0500L02'
	";
}
if ($stockcode == '23d')
{$stockset = "
	'0104C08C0006L01',
'0108G06E0050L02',
'0117C01C0025L03',
'0117C01C0100L02',
'0108E02D0100L01',
'0107E05D0250L01',
'0107E05D0500L02',
'0107D05E0250L01',
'0117C03M0250L01',
'0117C03M0360O01',
'0105D03P0005L02',
'0107H07T0250L01',
'0107J01B0480L01'
	";
}
if ($stockcode == '23e')
{$stockset = "
	'0117C02I0050L02',
'0104C08C0006L01',
'0108G06E0050L02',
'0117C01C0025L03',
'0117C01C0100L02',
'0108E02D0100L01',
'0108G14M0025L01'
	";
}
if ($stockcode == '24')
{$stockset = "
	'0117C02I0050L02',
'0105D01D0004L02',
'0105D01D0005L01',
'0117C03M0250L01',
'0117C03M0360O01',
'0105D03P0005L02',
'0108H06Q0300L01',
'0108G06E0050L02',
'0105E02L0100L01',
'0117C01C0025L03',
'0117C01C0100L02'
	";
}

if ($stockcode == '25')
{$stockset = "
	'0110D01M0005L01',
'0110D02P0050L01'
	";
}

if ($stockcode == '26')
{$stockset = "
	'0104F02C0025L03',
'0104F02C0050L04',
'0104F03C0025L02',
'0104F03C0100L01',
'0204F05F0025L01',
'0104F04H0002L03',
'0104F04H0005L02',
'0104F04H0005L04',
'0104F05O0005L02',
'0104F05O0010L03',
'0104F06P0002L02',
'0104F06P0004L03',
'0104F06P0008L04',
'0104F16Q0025L02',
'0104F16Q0050L03',
'0104F16Q0200L01',
'0104F08R0002L01',
'0104F11T0010L01',
'0104F11T0025L02',
'0104F11T0050L03',
'0104F11T0100L04'
	";
}


	
$sql = "
   select * from
 (
select top 3 row_number() over (partition by stockcode order by HNOPD_PRESCRIP_MEDICINE.MakeDatetime asc)as rowno
,HNOPD_MASTER.hn,HNOPD_PRESCRIP_MEDICINE.MakeDatetime,stockcode,qty  from HNOPD_MASTER 
 left join HNOPD_Prescrip on dbo.HNOPD_PRESCRIP.VisitDate = dbo.HNOPD_MASTER.VisitDate AND dbo.HNOPD_PRESCRIP.VN = dbo.HNOPD_MASTER.VN
 left join dbo.HNOPD_PRESCRIP_MEDICINE ON dbo.HNOPD_PRESCRIP_MEDICINE.VisitDate = dbo.HNOPD_PRESCRIP.VisitDate AND dbo.HNOPD_PRESCRIP_MEDICINE.VN = dbo.HNOPD_PRESCRIP.VN AND dbo.HNOPD_PRESCRIP_MEDICINE.PrescriptionNo = dbo.HNOPD_PRESCRIP.PrescriptionNo
 where year(HNOPD_PRESCRIP_MEDICINE.MakeDatetime) = '$year' 
  and month(HNOPD_PRESCRIP_MEDICINE.MakeDatetime) = '$month' 
 and stockcode in ($stockset)
and HNOPD_MASTER.hn in ('$hn') 
) q
where rowno = '$num'";
//echo $sql;
$row_hnname = odbc_exec($con_hos, $sql);

//echo $row_hnname;
$num = odbc_num_rows($row_hnname);
//if ($num == 0)
//{echo '<td>&nbsp;'.'</td>'.'<td>&nbsp;'.'</td>'; }

//echo  $sql;
 while($ROWS_hnname = ODBC_FETCH_ARRAY($row_hnname)){ 
//echo "<br>$row_maincate = odbc_exec($con_hos, $sql_getmaincate);<br>";
echo '<td>'.stockname($ROWS_hnname['stockcode'],$con_stock).' </td>';
echo '<td>'.getthdate($ROWS_hnname['MakeDatetime']).' </td>';
//$ROWS_hnname = ODBC_FETCH_ARRAY($row_hnname);
//return(iconv('TIS-620','utf-8',$ROWS_hnname['ResultValue']));
 }
}


function ID($HN,$con_hos)
{
$sql = "select * from HNPAT_REF where RefNoType = 'ID' and hn = '$HN'";
$row = odbc_exec($con_hos, $sql);
//echo $sql;
$ROWS = ODBC_FETCH_ARRAY($row);
return $ROWS['RefNo'];
}

function Tel($HN,$con_hos)
{
$sql = "select mobilephone from HNPAT_ADDRESS where SuffixTiny = '1' and hn = '$HN'";
$row = odbc_exec($con_hos, $sql);
//echo $sql;
$ROWS = ODBC_FETCH_ARRAY($row);
return $ROWS['mobilephone'];
}

function Province($HN,$con_hos)
{
$sql = "select LEFT(ProvinceComposeCode, 2) as Province from HNPAT_ADDRESS where SuffixTiny = '1' and  hn = '$HN'";
$row = odbc_exec($con_hos, $sql);
//echo $sql;
$ROWS = ODBC_FETCH_ARRAY($row);
return $ROWS['Province'];
}

function dist($HN,$con_hos)
{
$sql = "select LEFT(ProvinceComposeCode, 5) as dist from HNPAT_ADDRESS where SuffixTiny = '1' and  hn = '$HN'";
$row = odbc_exec($con_hos, $sql);
//echo $sql;
$ROWS = ODBC_FETCH_ARRAY($row);
return $ROWS['dist'];
}
function tambon($HN,$con_hos)
{
$sql = "select ProvinceComposeCode as tambon from HNPAT_ADDRESS where SuffixTiny = '1' and  hn = '$HN'";
$row = odbc_exec($con_hos, $sql);
//echo $sql;
$ROWS = ODBC_FETCH_ARRAY($row);
return $ROWS['tambon'];
}



function countvisit($HN,$year,$inf,$con_hos)
{
$sql = "select count(HNOPD_MASTER.hn) as numhn from HNOPD_MASTER 
left join HNOPD_Prescrip on dbo.HNOPD_PRESCRIP.VisitDate = dbo.HNOPD_MASTER.VisitDate AND dbo.HNOPD_PRESCRIP.VN = dbo.HNOPD_MASTER.VN
left join dbo.HNOPD_PRESCRIP_DIAG ON dbo.HNOPD_PRESCRIP_DIAG.VisitDate = dbo.HNOPD_PRESCRIP.VisitDate AND dbo.HNOPD_PRESCRIP_DIAG.VN = dbo.HNOPD_PRESCRIP.VN AND dbo.HNOPD_PRESCRIP_DIAG.PrescriptionNo = dbo.HNOPD_PRESCRIP.PrescriptionNo
where  HNOPD_PRESCRIP.DefaultRightCode in ('2100','2105',
'2106','2108','SC02','SC03','SC04','SC05',
'SC031','SC06') and
 year(HNOPD_Prescrip.VisitDate)= '$year' and HNOPD_MASTER.hn = '$HN'";
 if($inf == '1'){$sql = $sql." and dbo.HNOPD_PRESCRIP_DIAG.ICDCode between 'E100' and 'E149'";}
if($inf == '2'){$sql = $sql." and dbo.HNOPD_PRESCRIP_DIAG.ICDCode between 'I10' and 'I15'";}
if($inf == '3a'){$sql = $sql." and dbo.HNOPD_PRESCRIP_DIAG.ICDCode between 'B180' and 'B189'";}
if($inf == '3b'){$sql = $sql." and dbo.HNOPD_PRESCRIP_DIAG.ICDCode between 'K740' and 'K746'";}
if($inf == '4'){$sql = $sql." and dbo.HNOPD_PRESCRIP_DIAG.ICDCode between 'I500' and 'I509'";}
if($inf == '5'){$sql = $sql." and dbo.HNOPD_PRESCRIP_DIAG.ICDCode between 'I690' and 'I698'";}
if($inf == '6'){$sql = $sql." and dbo.HNOPD_PRESCRIP_DIAG.ICDCode between 'C000' and 'C97'";}
if($inf == '7'){$sql = $sql." and dbo.HNOPD_PRESCRIP_DIAG.ICDCode between 'B200' and 'B24'";}
if($inf == '8'){$sql = $sql." and dbo.HNOPD_PRESCRIP_DIAG.ICDCode between 'J430' and 'J439'";}
if($inf == '9'){$sql = $sql." and dbo.HNOPD_PRESCRIP_DIAG.ICDCode between 'N183' and 'N189'";}

if($inf == '10'){$sql = $sql." and dbo.HNOPD_PRESCRIP_DIAG.ICDCode between 'G20' and 'G22'";}
if($inf == '11'){$sql = $sql." and dbo.HNOPD_PRESCRIP_DIAG.ICDCode between 'G700' and 'G709'";}
if($inf == '12'){$sql = $sql." and dbo.HNOPD_PRESCRIP_DIAG.ICDCode in ('E232','N251')";}

if($inf == '13'){$sql = $sql." and dbo.HNOPD_PRESCRIP_DIAG.ICDCode in ('G35')";}

if($inf == '14'){$sql = $sql." and dbo.HNOPD_PRESCRIP_DIAG.ICDCode between 'E780' and 'E789'";}

if($inf == '15'){$sql = $sql." and dbo.HNOPD_PRESCRIP_DIAG.ICDCode between 'M050' and 'M069'";}

if($inf == '16'){$sql = $sql." and (dbo.HNOPD_PRESCRIP_DIAG.ICDCode between 'H400' and 'H409' or dbo.HNOPD_PRESCRIP_DIAG.ICDCode between 'H420' and 'H428')";}

if($inf == '17'){$sql = $sql." and dbo.HNOPD_PRESCRIP_DIAG.ICDCode between 'N040' and 'N049'";}

if($inf == '18'){$sql = $sql." and dbo.HNOPD_PRESCRIP_DIAG.ICDCode between 'M320' and 'M329'";}

if($inf == '19'){$sql = $sql." and dbo.HNOPD_PRESCRIP_DIAG.ICDCode between 'D610' and 'D619'";}

if($inf == '20'){$sql = $sql." and (dbo.HNOPD_PRESCRIP_DIAG.ICDCode between 'D560' and 'D562' or dbo.HNOPD_PRESCRIP_DIAG.ICDCode between 'D564' and 'D569')";}

if($inf == '21'){$sql = $sql." and dbo.HNOPD_PRESCRIP_DIAG.ICDCode in ('D66')";}

if($inf == '22'){$sql = $sql." and dbo.HNOPD_PRESCRIP_DIAG.ICDCode between 'L400' and '409'";}

if($inf == '23a'){$sql = $sql." and dbo.HNOPD_PRESCRIP_DIAG.ICDCode between 'L100' and 'L109'";}
if($inf == '23b'){$sql = $sql." and dbo.HNOPD_PRESCRIP_DIAG.ICDCode between 'L120' and 'L129'";}
if($inf == '23c'){$sql = $sql." and dbo.HNOPD_PRESCRIP_DIAG.ICDCode between 'L130' and 'L139'";}
if($inf == '23d'){$sql = $sql." and dbo.HNOPD_PRESCRIP_DIAG.ICDCode in ('L123')";}
if($inf == '23e'){$sql = $sql." and dbo.HNOPD_PRESCRIP_DIAG.ICDCode in ('L138')";}

if($inf == '24'){$sql = $sql." and dbo.HNOPD_PRESCRIP_DIAG.ICDCode in ('D693')";}
if($inf == '25'){$sql = $sql." and dbo.HNOPD_PRESCRIP_DIAG.ICDCode between 'E050' and 'E059'";}
if($inf == '26'){$sql = $sql." and dbo.HNOPD_PRESCRIP_DIAG.ICDCode between 'F200' and 'F29'";}
 
$row = odbc_exec($con_hos, $sql);
//echo $sql;
$ROWS = ODBC_FETCH_ARRAY($row);
return $ROWS['numhn'];
}


function dptop3y($hn,$year,$con_hos,$num){
$sql = "
 select * from
 (
select top 3 row_number() over (partition by HNOPD_MASTER.HN order by HNOPD_VITALSIGN.EntryDatetime asc)as rowno,HNOPD_MASTER.hn,HNOPD_VITALSIGN.BpSystolic , HNOPD_VITALSIGN.BpDiastolic,HNOPD_VITALSIGN.EntryDatetime
from HNOPD_MASTER 
left join HNOPD_Prescrip on dbo.HNOPD_PRESCRIP.VisitDate = dbo.HNOPD_MASTER.VisitDate AND dbo.HNOPD_PRESCRIP.VN = dbo.HNOPD_MASTER.VN
left join dbo.HNOPD_VITALSIGN ON dbo.HNOPD_VITALSIGN.VisitDate = dbo.HNOPD_MASTER.VisitDate AND dbo.HNOPD_VITALSIGN.VN = dbo.HNOPD_MASTER.VN AND dbo.HNOPD_PRESCRIP.PrescriptionNo = dbo.HNOPD_VITALSIGN.SuffixTiny
where Clinic in ('15001','15002','15005','15006','15007','15010','15011','15012',
'15013','15014','15015','15016','15017','15018','15019','15020','15021','15023',
'15024','15025','15026','15027','15028','15029','15030','15031','15032','15033',
'15035','15003','15004','15008','15009','15022','150041') and
 year(HNOPD_VITALSIGN.EntryDatetime)= '$year'  and HNOPD_MASTER.hn = '$hn'
) q
where rowno = '$num'";

//echo $sql;
$row_hnname = odbc_exec($con_hos, $sql);

//echo $row_hnname;
$num = odbc_num_rows($row_hnname);
if ($num == 0)
{echo '<td>&nbsp;'.'</td>'.'<td>&nbsp;'.'</td>'; }

//echo  $sql;
 while($ROWS_hnname = ODBC_FETCH_ARRAY($row_hnname))
 { 
 
$td =  '<td>';
if ($ROWS_hnname['BpSystolic'] >= 140 or $ROWS_hnname['BpDiastolic'] >= 90)
{$td =  '<td bgcolor="#FF0000">';}

//echo "<br>$row_maincate = odbc_exec($con_hos, $sql_getmaincate);<br>";
echo $td.$ROWS_hnname['BpSystolic'].' / '.$ROWS_hnname['BpDiastolic'].'</td>';
echo '<td>'.getthdate($ROWS_hnname['EntryDatetime']).' </td>';
//$ROWS_hnname = ODBC_FETCH_ARRAY($row_hnname);
//return(iconv('TIS-620','utf-8',$ROWS_hnname['ResultValue']));
 }
}

function dptop3($hn,$year,$month,$con_hos,$num){
$sql = "
 select * from
 (
select top 3 row_number() over (partition by HNOPD_MASTER.HN order by HNOPD_VITALSIGN.EntryDatetime asc)as rowno,HNOPD_MASTER.hn,HNOPD_VITALSIGN.BpSystolic , HNOPD_VITALSIGN.BpDiastolic,HNOPD_VITALSIGN.EntryDatetime
from HNOPD_MASTER 
left join HNOPD_Prescrip on dbo.HNOPD_PRESCRIP.VisitDate = dbo.HNOPD_MASTER.VisitDate AND dbo.HNOPD_PRESCRIP.VN = dbo.HNOPD_MASTER.VN
left join dbo.HNOPD_VITALSIGN ON dbo.HNOPD_VITALSIGN.VisitDate = dbo.HNOPD_MASTER.VisitDate AND dbo.HNOPD_VITALSIGN.VN = dbo.HNOPD_MASTER.VN AND dbo.HNOPD_PRESCRIP.PrescriptionNo = dbo.HNOPD_VITALSIGN.SuffixTiny
where Clinic in ('15001','15002','15005','15006','15007','15010','15011','15012',
'15013','15014','15015','15016','15017','15018','15019','15020','15021','15023',
'15024','15025','15026','15027','15028','15029','15030','15031','15032','15033',
'15035','15003','15004','15008','15009','15022','150041') and
 year(HNOPD_VITALSIGN.EntryDatetime)= '$year' and
 month(HNOPD_VITALSIGN.EntryDatetime)= '$month' and HNOPD_MASTER.hn = '$hn'
) q
where rowno = '$num'";
$row_hnname = odbc_exec($con_hos, $sql);

//echo $row_hnname;
$num = odbc_num_rows($row_hnname);
if ($num == 0)
{echo '<td>&nbsp;'.'</td>'.'<td>&nbsp;'.'</td>'; }

//echo  $sql;
 while($ROWS_hnname = ODBC_FETCH_ARRAY($row_hnname))
 { 
 $td =  '<td>';
if ($ROWS_hnname['BpSystolic'] >= 140 or $ROWS_hnname['BpDiastolic'] >= 90)
{$td =  '<td bgcolor="#FF0000">';}
//echo "<br>$row_maincate = odbc_exec($con_hos, $sql_getmaincate);<br>";
echo $td.$ROWS_hnname['BpSystolic'].' / '.$ROWS_hnname['BpDiastolic'].'</td>';
echo '<td>'.getthdate($ROWS_hnname['EntryDatetime']).' </td>';
//$ROWS_hnname = ODBC_FETCH_ARRAY($row_hnname);
//return(iconv('TIS-620','utf-8',$ROWS_hnname['ResultValue']));
 }
}

function dptop3d($hn,$year,$month,$day,$con_hos,$num){
$sql = "
 select * from
 (
select top 3 row_number() over (partition by HNOPD_MASTER.HN order by HNOPD_VITALSIGN.EntryDatetime asc)as rowno,HNOPD_MASTER.hn,HNOPD_VITALSIGN.BpSystolic , HNOPD_VITALSIGN.BpDiastolic,HNOPD_VITALSIGN.EntryDatetime
from HNOPD_MASTER 
left join HNOPD_Prescrip on dbo.HNOPD_PRESCRIP.VisitDate = dbo.HNOPD_MASTER.VisitDate AND dbo.HNOPD_PRESCRIP.VN = dbo.HNOPD_MASTER.VN
left join dbo.HNOPD_VITALSIGN ON dbo.HNOPD_VITALSIGN.VisitDate = dbo.HNOPD_MASTER.VisitDate AND dbo.HNOPD_VITALSIGN.VN = dbo.HNOPD_MASTER.VN AND dbo.HNOPD_PRESCRIP.PrescriptionNo = dbo.HNOPD_VITALSIGN.SuffixTiny
where Clinic in ('15001','15002','15005','15006','15007','15010','15011','15012',
'15013','15014','15015','15016','15017','15018','15019','15020','15021','15023',
'15024','15025','15026','15027','15028','15029','15030','15031','15032','15033',
'15035','15003','15004','15008','15009','15022','150041') and
 year(HNOPD_VITALSIGN.EntryDatetime)= '$year' and
 month(HNOPD_VITALSIGN.EntryDatetime)= '$month' and 
 day(HNOPD_VITALSIGN.EntryDatetime)= '$day' and
 HNOPD_MASTER.hn = '$hn'
) q
where rowno = '$num'";
$row_hnname = odbc_exec($con_hos, $sql);

//echo $row_hnname;
$num = odbc_num_rows($row_hnname);
if ($num == 0)
{echo '<td>&nbsp;'.'</td>'.'<td>&nbsp;'.'</td>'; }

//echo  $sql;
 while($ROWS_hnname = ODBC_FETCH_ARRAY($row_hnname))
 { 
 $td =  '<td>';
if ($ROWS_hnname['BpSystolic'] >= 140 or $ROWS_hnname['BpDiastolic'] >= 90)
{$td =  '<td bgcolor="#FF0000">';}
//echo "<br>$row_maincate = odbc_exec($con_hos, $sql_getmaincate);<br>";
echo $td.$ROWS_hnname['BpSystolic'].' / '.$ROWS_hnname['BpDiastolic'].'</td>';
echo '<td>'.getthdate($ROWS_hnname['EntryDatetime']).' </td>';
//$ROWS_hnname = ODBC_FETCH_ARRAY($row_hnname);
//return(iconv('TIS-620','utf-8',$ROWS_hnname['ResultValue']));
 }
}

function dptop3m($hn,$year,$month,$con_hos,$num){
$sql = "
 select * from
 (
select top 3 row_number() over (partition by HNOPD_MASTER.HN order by HNOPD_VITALSIGN.EntryDatetime asc)as rowno,HNOPD_MASTER.hn,HNOPD_VITALSIGN.BpSystolic , HNOPD_VITALSIGN.BpDiastolic,HNOPD_VITALSIGN.EntryDatetime
from HNOPD_MASTER 
left join HNOPD_Prescrip on dbo.HNOPD_PRESCRIP.VisitDate = dbo.HNOPD_MASTER.VisitDate AND dbo.HNOPD_PRESCRIP.VN = dbo.HNOPD_MASTER.VN
left join dbo.HNOPD_VITALSIGN ON dbo.HNOPD_VITALSIGN.VisitDate = dbo.HNOPD_MASTER.VisitDate AND dbo.HNOPD_VITALSIGN.VN = dbo.HNOPD_MASTER.VN AND dbo.HNOPD_PRESCRIP.PrescriptionNo = dbo.HNOPD_VITALSIGN.SuffixTiny
where Clinic in ('15001','15002','15005','15006','15007','15010','15011','15012',
'15013','15014','15015','15016','15017','15018','15019','15020','15021','15023',
'15024','15025','15026','15027','15028','15029','15030','15031','15032','15033',
'15035','15003','15004','15008','15009','15022','150041') and
 year(HNOPD_VITALSIGN.EntryDatetime)= '$year' and
 month(HNOPD_VITALSIGN.EntryDatetime)= '$month' and 
 
 HNOPD_MASTER.hn = '$hn'
) q
where rowno = '$num'";
$row_hnname = odbc_exec($con_hos, $sql);

//echo $row_hnname;
$num = odbc_num_rows($row_hnname);
if ($num == 0)
{echo '<td>&nbsp;'.'</td>'.'<td>&nbsp;'.'</td>'; }

//echo  $sql;
 while($ROWS_hnname = ODBC_FETCH_ARRAY($row_hnname))
 { 
 $td =  '<td>';
if ($ROWS_hnname['BpSystolic'] >= 140 or $ROWS_hnname['BpDiastolic'] >= 90)
{$td =  '<td bgcolor="#FF0000">';}
//echo "<br>$row_maincate = odbc_exec($con_hos, $sql_getmaincate);<br>";
echo $td.$ROWS_hnname['BpSystolic'].' / '.$ROWS_hnname['BpDiastolic'].'</td>';
echo '<td>'.getthdate($ROWS_hnname['EntryDatetime']).' </td>';
//$ROWS_hnname = ODBC_FETCH_ARRAY($row_hnname);
//return(iconv('TIS-620','utf-8',$ROWS_hnname['ResultValue']));
 }
}

function medtop3mecyd($hn,$stockcode,$year,$month,$day,$con_hos,$num,$con_stock){

if ($stockcode == '1')
{
	$stockset = "'0110B11G0100O01','0110B05B0002O01','0110B19O0055O01','0110B16T0005O01',
'0110B14J0100O01','0110B06G0005L03','0110B08G0080L03','0110B08D0060O03','0110B02A0003L05','0110B02A0002O02','0110B02A0001O01','0110B10G0005L01','0110B10M0005O02','0110B14J0025O01','0110B14J0010O02','0110B12M0500L03','0110B12M0850L04','0110B12G0500O01','0110B11G0050O02','0110B01A0030L01','0210H05V0006O01','0110B15N0001O01','0110B15N0002O02',
'0210A08G0000L01','0210A08G0000L02','0210A08G7030L03','0210A02H0000O05','0210A03N0003O07'";
}
if ($stockcode == '2')
{$stockset = "
	'0102E01A0005L03',
'0102E01A0010L02',
'0102E01N0005O05',
'0102F13N0025O03',
'0102E09V0040L01',
'0102E06I0240O05',
'0102D04C0005O02',
'0102D04C0025O01',
'0102D05L0875O01',
'0102D05L1125O02',
'0102D01A0025L02',
'0102D01A0050L03',
'0102D01A0100L01',
'0102D03C0025L04',
'0102D03C0625L05',
'0102D03C0125L03',
'0202D02E0100L01',
'0102D02M0100L02',
'0102D02B0100O02',
'0102D07P0010L01',
'0102D07P0040L03',
'0102E04D0030L02',
'0102E04D0060L03',
'0102E04H0090O07',
'0102E04D0120L01',
'0102E03C0120O01',
'0102G03D0002L04',
'0102G03C0002O02',
'0102G03C0004O03',
'0102C02C0025L04',
'0102C04E0005L01',
'0102C04E0020L02',
'0102E06F0005L03',
'0102E06F0010L01',
'0102E08P0005O03',
'0102E08P0010O01',
'0102G02A0010L01',
'0102G02A0025L02',
'0102H03D0050L01',
'0102F10I0300L01',
'0102F10I0150L02',
'0102F04C3125O01',
'0102F01A0150O02',
'0102E10Z0010O01',
'0102C05L0010L01',
'0102F04L0050L02',
'0102F04L0100L03',
'0102E07M0020L01',
'0102E07M0020O02',
'0102E07M0010O01',
'0102G01A0250L02',
'0102G01A0125L01',
'0102A08N0005L03',
'0102A08N0020L02',
'0102A08N0010L01',
'0102A01A0030O01',
'0102F09O0020L02',
'0102F09O0040L01',
'0102C03C0005O03',
'0102G08M0001L01',
'0102G08M0002L02',
'0102C08T0025O06',
'0102F05D0080O04',
'0102F05D0160O03',
'0102F02B0008O03',
'0102F02B0016O01'
	";
}
if ($stockcode == '3a')
{$stockset = "
	'0217B06B0003O01',
'0108F07L0150L02',
'0108F11H0010O01',
'0108F26B0001O02',
'0108F22V0300L01'
	";
}
if ($stockcode == '3b')
{$stockset = "
	'0102H05F0040L01',
'0102H05F0500L02',
'0102H01A0025L02',
'0102H01A0100L03',
'0301E04L0100L02',
'0102D07P0010L01',
'0102D07P0040L03',
'0102D01A0025L02',
'0102D01A0050L03',
'0102D01A0100L01',
'0102B01I0020O01',
'0102B01I0020L02'
	";
}
if ($stockcode == '4')
{$stockset = "
'0102H05F0040L01',
'0102H05F0500L02',
'0102H01A0025L02',
'0102H01A0100L03',
'0102H03D0050L01',
'0102G02A0010L01',
'0102G02A0025L02',
'0102B03I0005L07',
'0102B03I0010L04',
'0102B03I0010O01',
'0102B01I0020L02',
'0102B01I0020O01',
'0102A07L0250O02',
'0102A07L0625O03',
'0102D03C0025L04',
'0102D03C0625L05',
'0102D03C0125L03',
'0102D02M0100L02',
'0102D02B0100O02',
'0102D04C0005O02',
'0102D04C0025O01',
'0102D05L0875O01',
'0102D05L1125O02',
'0102D01A0025L02',
'0102D01A0050L03',
'0102D01A0100L01',
'0102F04L0050L02',
'0102F04L0100L03',
'0102F02B0008O03',
'0102F02B0016O01',
'0102F04C3125O01',
'0102F10I0150L02',
'0102F10I0300L01',
'0102F01A0150O02',
'0102F05D0080O04',
'0102F05D0160O03',
'0102C04E0005L01',
'0102C04E0020L02',
'0102C05L0010L01',
'0102C08T0025O06'
	";
}
if ($stockcode == '5')
{$stockset = "
	'0102E01A0005L03',
'0102E01A0010L02',
'0102E01N0005O05',
'0102F13N0025O03',
'0102E09V0040L01',
'0102E06I0240O05',
'0102D04C0005O02',
'0102D04C0025O01',
'0102D05L0875O01',
'0102D05L1125O02',
'0102D01A0025L02',
'0102D01A0050L03',
'0102D01A0100L01',
'0102D03C0025L04',
'0102D03C0625L05',
'0102D03C0125L03',
'0202D02E0100L01',
'0102D02M0100L02',
'0102D02B0100O02',
'0102D07P0010L01',
'0102D07P0040L03',
'0102E04D0030L02',
'0102E04D0060L03',
'0102E04H0090O07',
'0102E04D0120L01',
'0102E03C0120O01',
'0102G03D0002L04',
'0102G03C0002O02',
'0102G03C0004O03',
'0102C02C0025L04',
'0102C04E0005L01',
'0102C04E0020L02',
'0102E06F0005L03',
'0102E06F0010L01',
'0102E08P0005O03',
'0102E08P0010O01',
'0102G02A0010L01',
'0102G02A0025L02',
'0102H03D0050L01',
'0102F10I0300L01',
'0102F10I0150L02',
'0102F04C3125O01',
'0102F01A0150O02',
'0102E10Z0010O01',
'0102C05L0010L01',
'0102F04L0050L02',
'0102F04L0100L03',
'0102E07M0020L01',
'0102E07M0020O02',
'0102E07M0010O01',
'0102G01A0250L02',
'0102G01A0125L01',
'0102A08N0005L03',
'0102A08N0020L02',
'0102A08N0010L01',
'0102A01A0030O01',
'0102F09O0020L02',
'0102F09O0040L01',
'0102C03C0005O03',
'0102G08M0001L01',
'0102G08M0002L02',
'0102C08T0025O06',
'0102F05D0080O04',
'0102F05D0160O03',
'0102F02B0008O03',
'0102F02B0016O01',
'0102N02A0081L01',
'0104C03A0300L01',
'0104C03A0325L01',
'0102N03O0003L03',
'0102N03O0005L05',
'0102N08X0010O01',
'0102N08X0015O03',
'0102N09E0005O01',
'0102N01P0110O01',
'0102J11C0050L01',
'0102N01D0025L01',
'0102N04P0075L01',
'0102N04P0075L02',
'0102N04P0075O01',
'0110E08L00100L04',
'0110E08L0010O01',
'0110E08L00200L05',
'0110E08L00400L06',
'0310E01Q0000L01',
'0110E04E0010L01',
'0110E04E0010O01',
'0110E05F0100L01',
'0110E05F0160L02',
'0110E05F0300L03',
'0110E05T0135O08',
'0110E09M0040O02',
'0110E06G0300L01',
'0110E06G0600L02',
'0110E03C0010O01',
'0110E03R0020L02',
'0110E12S0010L01',
'0110E12S0020L02',
'0110E12S0040L03',
'0110E10N0050L03'
	";
}
if ($stockcode == '6')
{$stockset = "
	'0108G06E0050L02',
'0108G14M0025L01'";
}
if ($stockcode == '7')
{$stockset = "
	'0108F07L0150F02',
'0108F07L0150L02',
'0108F22V0300F01',
'0108F22V0300L01',
'0108F04C0300F02',
'0108F10Z0100F04',
'0108F10Z0100L04',
'0108F19S0600O02',
'0108F25E0600F03',
'0108F13N0200F01',
'0108F09G0030F01',
'0108F09G0030L01',
'0108F10G0250F01',
'0108F10G0250L01',
'0108F13N0200L01',
'0108F12K0166O01',
'0108F03A0125F01',
'0108F14N0100F01',
'0108F25I0100O01',
'0108F07E0025O01',
'0108F07E0025F01',
'0108F17A0300F01',
'0108F17A0300O01',
'0108F28P0300O01',
'0108F28P0600O02F',
'0108F27I0400O01',
'0108F18S0030F01',
'0108F18S0030L01',
'0108F20T1100F01',
'0108F20T1100L01'
";
}
if ($stockcode == '8')
{$stockset = "
	'0103B06S0002L01',
'0303B08S0060L01',
'0503B09S0020L04',
'0503B09V0200O05',
'0503B09S0100L02',
'0103B08T0025L01',
'0503B12S0025O01',
'0103B09T0200L01',
'0103B12D0500O01',
'0503B10S0025O04',
'0503B10S0050O03',
'0503B10S0025L01'
	";
}
if ($stockcode == '9')
{$stockset = "
	'0110F03C0002L01',
'0110F07R0025L02',
'0110F02A0025L01',
'0111E15F0200L01',
'0111E04F0000L01',
'0202R01E0004L05P',
'0202R01E0004L11',
'0202R01E0004L08',
'0119A01S0300L01',
'0111D07C0600L05',
'0111D07C0835L06',
'0111D07C1000L03',
'0101A02A0500L01'	";
}
if ($stockcode == '10')
{$stockset = "
	'0104N02B0025L01',
'0104N07T0050O02',
'0404N03N0002O01',
'0104N04J0005L01',
'0104N05M0250L01'
	";
}
if ($stockcode == '11')
{$stockset = "
	'0117C02I0050L02',
'0117C01C0025L03',
'0117C01C0100L02',
'0117C03M0250L01',
'0117C03M0360O01',
'0105D03P0005L02',
'0104P01P0060L01'
	";
}
if ($stockcode == '12')
{$stockset = "
	'0104H01C0200L01',
'0104F02C0100L01',
'0102H03D0050L01',
'0104C14I0200L01',
'0104C14I0400L02',
'0104C14S0400O03',
'0104C15I0025L01'
	";
}
if ($stockcode == '13')
{$stockset = "
	'0117C02I0050L02',
'0108G06E0050L02',
'0217B06B0003O01',
'0108G14M0025L01'
	";
}
if ($stockcode == '14')
{$stockset = "
	'0110E08L00400L06',
'0110E08L00200L05',
'0110E08L0010O01',
'0110E08L00100L04',
'0110E15X0020O02',
'0110E15X0010O01',
'0110E15X0040O03',
'0310E01Q0000L01',
'0110E04E0010O01',
'0110E04E0010L01',
'0110E05F0100L01',
'0110E05F0160L02',
'0110E05F0300L03',
'0110E05T0135O08',
'0110E09M0040O02',
'0110E06G0300L01',
'0110E06G0600L02',
'0110E03C0010O01',
'0110E03R0020L02',
'0110E12S0010L01',
'0110E12S0020L02',
'0110E12S0040L03',
'0110E10N0050L03'
	";
}
if ($stockcode == '15')
{$stockset = "
	'0117A11H0200L01',
'0108G14M0025L01',
'0105D03P0005L02',
'0104C24S0500L02',
'0108H02C0250L01'
	";
}
if ($stockcode == '16')
{$stockset = "
	'0102H02D0250O03',
'0513F06L0000O01',
'0513F01A0000O02',
'0513F10C0000O01',
'0513F03A0000O01',
'0513F08T0002O01',
'0513F06L0000L01',
'0513F09X0000O01',
'0513F08T0025O01',
'0513F08T0003O01',
'0513F05G0000L01',
'0513F08T0005O01',
'0513F08T0000O01'
	";
}
if ($stockcode == '17')
{$stockset = "
	'0117C01C0025L03',
'0117C01C0100L02',
'0108G06E0050L02',
'0117C03M0250L01',
'0117C03M0360O01',
'0105D03P0005L02',
'0204C05M0500O01'
	";
}
if ($stockcode == '18')
{$stockset = "
	'0117A11H0200L01',
'0108G14M0025L01',
'0105D03P0005L02',
'0104C24S0500L02',
'0108H02C0250L01',
'0108G06E0050L02',
'0117C01C0025L03',
'0117C01C0100L02',
'0117C03M0250L01',
'0117C03M0360O01',
'0117C02I0050L02'
	";
}
if ($stockcode == '19')
{$stockset = "
	'0117C01C0025L03',
'0117C01C0100L02',
'0108G06E0050L02',
'0105F01A0050L01'
	";
}
if ($stockcode == '20')
{$stockset = "
	'0118A03D0500L03',
'0218A04D0500O01',
'0111I01F0005L02'
	";
}
if ($stockcode == '21')
{$stockset = "
	
	";
}
if ($stockcode == '22')
{$stockset = "
	'0114H01N0025O01',
'0414B01B0450L01',
'0414C04B0500L02',
'0414C04B0000O03',
'0414C05C0500L02',
'0414H02C0450L01',
'0117C01C0025L03',
'0117C01C0100L02',
'0108G14M0025L01',
'0414C15T0500L01',
'0414C16T0500L02',
'0414C16T0060L03'
	";
}
if ($stockcode == '23a')
{$stockset = "
	'0117C02I0050L02',
'0108G06E0050L02',
'0117C01C0025L03',
'0117C01C0100L02',
'0108E02D0100L01',
'0117C03M0250L01',
'0117C03M0360O01',
'0105D03P0005L02'
	";
}
if ($stockcode == '23b')
{$stockset = "
	'0117C02I0050L02',
'0414B01B0450L01',
'0414C04B0500L02',
'0414C04B0000O03',
'0414C05C0500L02',
'0108G06E0050L02',
'0108E02D0100L01',
'0105D01D0004L02',
'0105D01D0005L01',
'0107H06D0100L01',
'0107D05E0250L01',
'0205D04S0100L02',
'0205D05S1000L01',
'0107H08M0500L01',
'0117C03M0250L01',
'0117C03M0360O01',
'0105D03P0005L02',
'0107H07T0250L01',
'0414C15T0500L01',
'0414C16T0500L02',
'0414C16T0060L03'
	";
}
if ($stockcode == '23c')
{$stockset = "
	'0108E02D0100L01',
'0104C24S0500L02',
'0414B01B0450L01',
'0414C04B0500L02',
'0414C05C0500L02',
'0414C15T0500L01',
'0414C16T0500L02'
	";
}
if ($stockcode == '23d')
{$stockset = "
	'0104C08C0006L01',
'0108G06E0050L02',
'0117C01C0025L03',
'0117C01C0100L02',
'0108E02D0100L01',
'0107E05D0250L01',
'0107E05D0500L02',
'0107D05E0250L01',
'0117C03M0250L01',
'0117C03M0360O01',
'0105D03P0005L02',
'0107H07T0250L01',
'0107J01B0480L01'
	";
}
if ($stockcode == '23E')
{$stockset = "
	'0117C02I0050L02',
'0104C08C0006L01',
'0108G06E0050L02',
'0117C01C0025L03',
'0117C01C0100L02',
'0108E02D0100L01',
'0108G14M0025L01'
	";
}
if ($stockcode == '24')
{$stockset = "
	'0117C02I0050L02',
'0105D01D0004L02',
'0105D01D0005L01',
'0117C03M0250L01',
'0117C03M0360O01',
'0105D03P0005L02',
'0108H06Q0300L01',
'0108G06E0050L02',
'0105E02L0100L01',
'0117C01C0025L03',
'0117C01C0100L02'
	";
}

if ($stockcode == '25')
{$stockset = "
	'0110D01M0005L01',
'0110D02P0050L01'
	";
}

if ($stockcode == '26')
{$stockset = "
	'0104F02C0025L03',
'0104F02C0050L04',
'0104F03C0025L02',
'0104F03C0100L01',
'0204F05F0025L01',
'0104F04H0002L03',
'0104F04H0005L02',
'0104F04H0005L04',
'0104F05O0005L02',
'0104F05O0010L03',
'0104F06P0002L02',
'0104F06P0004L03',
'0104F06P0008L04',
'0104F16Q0025L02',
'0104F16Q0050L03',
'0104F16Q0200L01',
'0104F08R0002L01',
'0104F11T0010L01',
'0104F11T0025L02',
'0104F11T0050L03',
'0104F11T0100L04'
	";
}


	
$sql = "
   select * from
 (
select top 3 row_number() over (partition by stockcode order by HNOPD_PRESCRIP_MEDICINE.MakeDatetime asc)as rowno
,HNOPD_MASTER.hn,HNOPD_PRESCRIP_MEDICINE.MakeDatetime,stockcode,qty  from HNOPD_MASTER 
 left join HNOPD_Prescrip on dbo.HNOPD_PRESCRIP.VisitDate = dbo.HNOPD_MASTER.VisitDate AND dbo.HNOPD_PRESCRIP.VN = dbo.HNOPD_MASTER.VN
 left join dbo.HNOPD_PRESCRIP_MEDICINE ON dbo.HNOPD_PRESCRIP_MEDICINE.VisitDate = dbo.HNOPD_PRESCRIP.VisitDate AND dbo.HNOPD_PRESCRIP_MEDICINE.VN = dbo.HNOPD_PRESCRIP.VN AND dbo.HNOPD_PRESCRIP_MEDICINE.PrescriptionNo = dbo.HNOPD_PRESCRIP.PrescriptionNo
 where year(HNOPD_PRESCRIP_MEDICINE.MakeDatetime) = '$year' 
 and month(HNOPD_PRESCRIP_MEDICINE.MakeDatetime) = '$month'
 and day(HNOPD_PRESCRIP_MEDICINE.MakeDatetime) = '$day'
  and stockcode in ($stockset)
and HNOPD_MASTER.hn in ('$hn') 
) q
where rowno = '$num'";
//echo $sql;
$row_hnname = odbc_exec($con_hos, $sql);

//echo $row_hnname;
$num = odbc_num_rows($row_hnname);
//if ($num == 0)
//{echo '<td>&nbsp;'.'</td>'.'<td>&nbsp;'.'</td>'; }

//echo  $sql;
 while($ROWS_hnname = ODBC_FETCH_ARRAY($row_hnname)){ 
//echo "<br>$row_maincate = odbc_exec($con_hos, $sql_getmaincate);<br>";
echo '<td>'.stockname($ROWS_hnname['stockcode'],$con_stock).' </td>';
echo '<td>'.getthdate($ROWS_hnname['MakeDatetime']).' </td>';
//$ROWS_hnname = ODBC_FETCH_ARRAY($row_hnname);
//return(iconv('TIS-620','utf-8',$ROWS_hnname['ResultValue']));
 }
}
function medtop3mecym($hn,$stockcode,$year,$month,$con_hos,$num,$con_stock){

if ($stockcode == '1')
{
	$stockset = "'0110B11G0100O01','0110B05B0002O01','0110B19O0055O01','0110B16T0005O01',
'0110B14J0100O01','0110B06G0005L03','0110B08G0080L03','0110B08D0060O03','0110B02A0003L05','0110B02A0002O02','0110B02A0001O01','0110B10G0005L01','0110B10M0005O02','0110B14J0025O01','0110B14J0010O02','0110B12M0500L03','0110B12M0850L04','0110B12G0500O01','0110B11G0050O02','0110B01A0030L01','0210H05V0006O01','0110B15N0001O01','0110B15N0002O02',
'0210A08G0000L01','0210A08G0000L02','0210A08G7030L03','0210A02H0000O05','0210A03N0003O07'";
}
if ($stockcode == '2')
{$stockset = "
	'0102E01A0005L03',
'0102E01A0010L02',
'0102E01N0005O05',
'0102F13N0025O03',
'0102E09V0040L01',
'0102E06I0240O05',
'0102D04C0005O02',
'0102D04C0025O01',
'0102D05L0875O01',
'0102D05L1125O02',
'0102D01A0025L02',
'0102D01A0050L03',
'0102D01A0100L01',
'0102D03C0025L04',
'0102D03C0625L05',
'0102D03C0125L03',
'0202D02E0100L01',
'0102D02M0100L02',
'0102D02B0100O02',
'0102D07P0010L01',
'0102D07P0040L03',
'0102E04D0030L02',
'0102E04D0060L03',
'0102E04H0090O07',
'0102E04D0120L01',
'0102E03C0120O01',
'0102G03D0002L04',
'0102G03C0002O02',
'0102G03C0004O03',
'0102C02C0025L04',
'0102C04E0005L01',
'0102C04E0020L02',
'0102E06F0005L03',
'0102E06F0010L01',
'0102E08P0005O03',
'0102E08P0010O01',
'0102G02A0010L01',
'0102G02A0025L02',
'0102H03D0050L01',
'0102F10I0300L01',
'0102F10I0150L02',
'0102F04C3125O01',
'0102F01A0150O02',
'0102E10Z0010O01',
'0102C05L0010L01',
'0102F04L0050L02',
'0102F04L0100L03',
'0102E07M0020L01',
'0102E07M0020O02',
'0102E07M0010O01',
'0102G01A0250L02',
'0102G01A0125L01',
'0102A08N0005L03',
'0102A08N0020L02',
'0102A08N0010L01',
'0102A01A0030O01',
'0102F09O0020L02',
'0102F09O0040L01',
'0102C03C0005O03',
'0102G08M0001L01',
'0102G08M0002L02',
'0102C08T0025O06',
'0102F05D0080O04',
'0102F05D0160O03',
'0102F02B0008O03',
'0102F02B0016O01'
	";
}
if ($stockcode == '3a')
{$stockset = "
	'0217B06B0003O01',
'0108F07L0150L02',
'0108F11H0010O01',
'0108F26B0001O02',
'0108F22V0300L01'
	";
}
if ($stockcode == '3b')
{$stockset = "
	'0102H05F0040L01',
'0102H05F0500L02',
'0102H01A0025L02',
'0102H01A0100L03',
'0301E04L0100L02',
'0102D07P0010L01',
'0102D07P0040L03',
'0102D01A0025L02',
'0102D01A0050L03',
'0102D01A0100L01',
'0102B01I0020O01',
'0102B01I0020L02'
	";
}
if ($stockcode == '4')
{$stockset = "
'0102H05F0040L01',
'0102H05F0500L02',
'0102H01A0025L02',
'0102H01A0100L03',
'0102H03D0050L01',
'0102G02A0010L01',
'0102G02A0025L02',
'0102B03I0005L07',
'0102B03I0010L04',
'0102B03I0010O01',
'0102B01I0020L02',
'0102B01I0020O01',
'0102A07L0250O02',
'0102A07L0625O03',
'0102D03C0025L04',
'0102D03C0625L05',
'0102D03C0125L03',
'0102D02M0100L02',
'0102D02B0100O02',
'0102D04C0005O02',
'0102D04C0025O01',
'0102D05L0875O01',
'0102D05L1125O02',
'0102D01A0025L02',
'0102D01A0050L03',
'0102D01A0100L01',
'0102F04L0050L02',
'0102F04L0100L03',
'0102F02B0008O03',
'0102F02B0016O01',
'0102F04C3125O01',
'0102F10I0150L02',
'0102F10I0300L01',
'0102F01A0150O02',
'0102F05D0080O04',
'0102F05D0160O03',
'0102C04E0005L01',
'0102C04E0020L02',
'0102C05L0010L01',
'0102C08T0025O06'
	";
}
if ($stockcode == '5')
{$stockset = "
	'0102E01A0005L03',
'0102E01A0010L02',
'0102E01N0005O05',
'0102F13N0025O03',
'0102E09V0040L01',
'0102E06I0240O05',
'0102D04C0005O02',
'0102D04C0025O01',
'0102D05L0875O01',
'0102D05L1125O02',
'0102D01A0025L02',
'0102D01A0050L03',
'0102D01A0100L01',
'0102D03C0025L04',
'0102D03C0625L05',
'0102D03C0125L03',
'0202D02E0100L01',
'0102D02M0100L02',
'0102D02B0100O02',
'0102D07P0010L01',
'0102D07P0040L03',
'0102E04D0030L02',
'0102E04D0060L03',
'0102E04H0090O07',
'0102E04D0120L01',
'0102E03C0120O01',
'0102G03D0002L04',
'0102G03C0002O02',
'0102G03C0004O03',
'0102C02C0025L04',
'0102C04E0005L01',
'0102C04E0020L02',
'0102E06F0005L03',
'0102E06F0010L01',
'0102E08P0005O03',
'0102E08P0010O01',
'0102G02A0010L01',
'0102G02A0025L02',
'0102H03D0050L01',
'0102F10I0300L01',
'0102F10I0150L02',
'0102F04C3125O01',
'0102F01A0150O02',
'0102E10Z0010O01',
'0102C05L0010L01',
'0102F04L0050L02',
'0102F04L0100L03',
'0102E07M0020L01',
'0102E07M0020O02',
'0102E07M0010O01',
'0102G01A0250L02',
'0102G01A0125L01',
'0102A08N0005L03',
'0102A08N0020L02',
'0102A08N0010L01',
'0102A01A0030O01',
'0102F09O0020L02',
'0102F09O0040L01',
'0102C03C0005O03',
'0102G08M0001L01',
'0102G08M0002L02',
'0102C08T0025O06',
'0102F05D0080O04',
'0102F05D0160O03',
'0102F02B0008O03',
'0102F02B0016O01',
'0102N02A0081L01',
'0104C03A0300L01',
'0104C03A0325L01',
'0102N03O0003L03',
'0102N03O0005L05',
'0102N08X0010O01',
'0102N08X0015O03',
'0102N09E0005O01',
'0102N01P0110O01',
'0102J11C0050L01',
'0102N01D0025L01',
'0102N04P0075L01',
'0102N04P0075L02',
'0102N04P0075O01',
'0110E08L00100L04',
'0110E08L0010O01',
'0110E08L00200L05',
'0110E08L00400L06',
'0310E01Q0000L01',
'0110E04E0010L01',
'0110E04E0010O01',
'0110E05F0100L01',
'0110E05F0160L02',
'0110E05F0300L03',
'0110E05T0135O08',
'0110E09M0040O02',
'0110E06G0300L01',
'0110E06G0600L02',
'0110E03C0010O01',
'0110E03R0020L02',
'0110E12S0010L01',
'0110E12S0020L02',
'0110E12S0040L03',
'0110E10N0050L03'
	";
}
if ($stockcode == '6')
{$stockset = "
	'0108G06E0050L02',
'0108G14M0025L01'";
}
if ($stockcode == '7')
{$stockset = "
	'0108F07L0150F02',
'0108F07L0150L02',
'0108F22V0300F01',
'0108F22V0300L01',
'0108F04C0300F02',
'0108F10Z0100F04',
'0108F10Z0100L04',
'0108F19S0600O02',
'0108F25E0600F03',
'0108F13N0200F01',
'0108F09G0030F01',
'0108F09G0030L01',
'0108F10G0250F01',
'0108F10G0250L01',
'0108F13N0200L01',
'0108F12K0166O01',
'0108F03A0125F01',
'0108F14N0100F01',
'0108F25I0100O01',
'0108F07E0025O01',
'0108F07E0025F01',
'0108F17A0300F01',
'0108F17A0300O01',
'0108F28P0300O01',
'0108F28P0600O02F',
'0108F27I0400O01',
'0108F18S0030F01',
'0108F18S0030L01',
'0108F20T1100F01',
'0108F20T1100L01'
";
}
if ($stockcode == '8')
{$stockset = "
	'0103B06S0002L01',
'0303B08S0060L01',
'0503B09S0020L04',
'0503B09V0200O05',
'0503B09S0100L02',
'0103B08T0025L01',
'0503B12S0025O01',
'0103B09T0200L01',
'0103B12D0500O01',
'0503B10S0025O04',
'0503B10S0050O03',
'0503B10S0025L01'
	";
}
if ($stockcode == '9')
{$stockset = "
	'0110F03C0002L01',
'0110F07R0025L02',
'0110F02A0025L01',
'0111E15F0200L01',
'0111E04F0000L01',
'0202R01E0004L05P',
'0202R01E0004L11',
'0202R01E0004L08',
'0119A01S0300L01',
'0111D07C0600L05',
'0111D07C0835L06',
'0111D07C1000L03',
'0101A02A0500L01'	";
}
if ($stockcode == '10')
{$stockset = "
	'0104N02B0025L01',
'0104N07T0050O02',
'0404N03N0002O01',
'0104N04J0005L01',
'0104N05M0250L01'
	";
}
if ($stockcode == '11')
{$stockset = "
	'0117C02I0050L02',
'0117C01C0025L03',
'0117C01C0100L02',
'0117C03M0250L01',
'0117C03M0360O01',
'0105D03P0005L02',
'0104P01P0060L01'
	";
}
if ($stockcode == '12')
{$stockset = "
	'0104H01C0200L01',
'0104F02C0100L01',
'0102H03D0050L01',
'0104C14I0200L01',
'0104C14I0400L02',
'0104C14S0400O03',
'0104C15I0025L01'
	";
}
if ($stockcode == '13')
{$stockset = "
	'0117C02I0050L02',
'0108G06E0050L02',
'0217B06B0003O01',
'0108G14M0025L01'
	";
}
if ($stockcode == '14')
{$stockset = "
	'0110E08L00400L06',
'0110E08L00200L05',
'0110E08L0010O01',
'0110E08L00100L04',
'0110E15X0020O02',
'0110E15X0010O01',
'0110E15X0040O03',
'0310E01Q0000L01',
'0110E04E0010O01',
'0110E04E0010L01',
'0110E05F0100L01',
'0110E05F0160L02',
'0110E05F0300L03',
'0110E05T0135O08',
'0110E09M0040O02',
'0110E06G0300L01',
'0110E06G0600L02',
'0110E03C0010O01',
'0110E03R0020L02',
'0110E12S0010L01',
'0110E12S0020L02',
'0110E12S0040L03',
'0110E10N0050L03'
	";
}
if ($stockcode == '15')
{$stockset = "
	'0117A11H0200L01',
'0108G14M0025L01',
'0105D03P0005L02',
'0104C24S0500L02',
'0108H02C0250L01'
	";
}
if ($stockcode == '16')
{$stockset = "
	'0102H02D0250O03',
'0513F06L0000O01',
'0513F01A0000O02',
'0513F10C0000O01',
'0513F03A0000O01',
'0513F08T0002O01',
'0513F06L0000L01',
'0513F09X0000O01',
'0513F08T0025O01',
'0513F08T0003O01',
'0513F05G0000L01',
'0513F08T0005O01',
'0513F08T0000O01'
	";
}
if ($stockcode == '17')
{$stockset = "
	'0117C01C0025L03',
'0117C01C0100L02',
'0108G06E0050L02',
'0117C03M0250L01',
'0117C03M0360O01',
'0105D03P0005L02',
'0204C05M0500O01'
	";
}
if ($stockcode == '18')
{$stockset = "
	'0117A11H0200L01',
'0108G14M0025L01',
'0105D03P0005L02',
'0104C24S0500L02',
'0108H02C0250L01',
'0108G06E0050L02',
'0117C01C0025L03',
'0117C01C0100L02',
'0117C03M0250L01',
'0117C03M0360O01',
'0117C02I0050L02'
	";
}
if ($stockcode == '19')
{$stockset = "
	'0117C01C0025L03',
'0117C01C0100L02',
'0108G06E0050L02',
'0105F01A0050L01'
	";
}
if ($stockcode == '20')
{$stockset = "
	'0118A03D0500L03',
'0218A04D0500O01',
'0111I01F0005L02'
	";
}
if ($stockcode == '21')
{$stockset = "
	
	";
}
if ($stockcode == '22')
{$stockset = "
	'0114H01N0025O01',
'0414B01B0450L01',
'0414C04B0500L02',
'0414C04B0000O03',
'0414C05C0500L02',
'0414H02C0450L01',
'0117C01C0025L03',
'0117C01C0100L02',
'0108G14M0025L01',
'0414C15T0500L01',
'0414C16T0500L02',
'0414C16T0060L03'
	";
}
if ($stockcode == '23a')
{$stockset = "
	'0117C02I0050L02',
'0108G06E0050L02',
'0117C01C0025L03',
'0117C01C0100L02',
'0108E02D0100L01',
'0117C03M0250L01',
'0117C03M0360O01',
'0105D03P0005L02'
	";
}
if ($stockcode == '23b')
{$stockset = "
	'0117C02I0050L02',
'0414B01B0450L01',
'0414C04B0500L02',
'0414C04B0000O03',
'0414C05C0500L02',
'0108G06E0050L02',
'0108E02D0100L01',
'0105D01D0004L02',
'0105D01D0005L01',
'0107H06D0100L01',
'0107D05E0250L01',
'0205D04S0100L02',
'0205D05S1000L01',
'0107H08M0500L01',
'0117C03M0250L01',
'0117C03M0360O01',
'0105D03P0005L02',
'0107H07T0250L01',
'0414C15T0500L01',
'0414C16T0500L02',
'0414C16T0060L03'
	";
}
if ($stockcode == '23c')
{$stockset = "
	'0108E02D0100L01',
'0104C24S0500L02',
'0414B01B0450L01',
'0414C04B0500L02',
'0414C05C0500L02',
'0414C15T0500L01',
'0414C16T0500L02'
	";
}
if ($stockcode == '23d')
{$stockset = "
	'0104C08C0006L01',
'0108G06E0050L02',
'0117C01C0025L03',
'0117C01C0100L02',
'0108E02D0100L01',
'0107E05D0250L01',
'0107E05D0500L02',
'0107D05E0250L01',
'0117C03M0250L01',
'0117C03M0360O01',
'0105D03P0005L02',
'0107H07T0250L01',
'0107J01B0480L01'
	";
}
if ($stockcode == '23E')
{$stockset = "
	'0117C02I0050L02',
'0104C08C0006L01',
'0108G06E0050L02',
'0117C01C0025L03',
'0117C01C0100L02',
'0108E02D0100L01',
'0108G14M0025L01'
	";
}
if ($stockcode == '24')
{$stockset = "
	'0117C02I0050L02',
'0105D01D0004L02',
'0105D01D0005L01',
'0117C03M0250L01',
'0117C03M0360O01',
'0105D03P0005L02',
'0108H06Q0300L01',
'0108G06E0050L02',
'0105E02L0100L01',
'0117C01C0025L03',
'0117C01C0100L02'
	";
}

if ($stockcode == '25')
{$stockset = "
	'0110D01M0005L01',
'0110D02P0050L01'
	";
}

if ($stockcode == '26')
{$stockset = "
	'0104F02C0025L03',
'0104F02C0050L04',
'0104F03C0025L02',
'0104F03C0100L01',
'0204F05F0025L01',
'0104F04H0002L03',
'0104F04H0005L02',
'0104F04H0005L04',
'0104F05O0005L02',
'0104F05O0010L03',
'0104F06P0002L02',
'0104F06P0004L03',
'0104F06P0008L04',
'0104F16Q0025L02',
'0104F16Q0050L03',
'0104F16Q0200L01',
'0104F08R0002L01',
'0104F11T0010L01',
'0104F11T0025L02',
'0104F11T0050L03',
'0104F11T0100L04'
	";
}


	
$sql = "
   select * from
 (
select top 3 row_number() over (partition by stockcode order by HNOPD_PRESCRIP_MEDICINE.MakeDatetime asc)as rowno
,HNOPD_MASTER.hn,HNOPD_PRESCRIP_MEDICINE.MakeDatetime,stockcode,qty  from HNOPD_MASTER 
 left join HNOPD_Prescrip on dbo.HNOPD_PRESCRIP.VisitDate = dbo.HNOPD_MASTER.VisitDate AND dbo.HNOPD_PRESCRIP.VN = dbo.HNOPD_MASTER.VN
 left join dbo.HNOPD_PRESCRIP_MEDICINE ON dbo.HNOPD_PRESCRIP_MEDICINE.VisitDate = dbo.HNOPD_PRESCRIP.VisitDate AND dbo.HNOPD_PRESCRIP_MEDICINE.VN = dbo.HNOPD_PRESCRIP.VN AND dbo.HNOPD_PRESCRIP_MEDICINE.PrescriptionNo = dbo.HNOPD_PRESCRIP.PrescriptionNo
 where year(HNOPD_PRESCRIP_MEDICINE.MakeDatetime) = '$year' 
 and month(HNOPD_PRESCRIP_MEDICINE.MakeDatetime) = '$month'
 
  and stockcode in ($stockset)
and HNOPD_MASTER.hn in ('$hn') 
) q
where rowno = '$num'";
//echo $sql;
$row_hnname = odbc_exec($con_hos, $sql);

//echo $row_hnname;
$num = odbc_num_rows($row_hnname);
//if ($num == 0)
//{echo '<td>&nbsp;'.'</td>'.'<td>&nbsp;'.'</td>'; }

//echo  $sql;
 while($ROWS_hnname = ODBC_FETCH_ARRAY($row_hnname)){ 
//echo "<br>$row_maincate = odbc_exec($con_hos, $sql_getmaincate);<br>";
echo '<td>'.stockname($ROWS_hnname['stockcode'],$con_stock).' </td>';
echo '<td>'.getthdate($ROWS_hnname['MakeDatetime']).' </td>';
//$ROWS_hnname = ODBC_FETCH_ARRAY($row_hnname);
//return(iconv('TIS-620','utf-8',$ROWS_hnname['ResultValue']));
 }
}

function medtop3mecy($hn,$stockcode,$year,$con_hos,$num,$con_stock){

if ($stockcode == '1')
{
	$stockset = "'0110B11G0100O01','0110B05B0002O01','0110B19O0055O01','0110B16T0005O01',
'0110B14J0100O01','0110B06G0005L03','0110B08G0080L03','0110B08D0060O03','0110B02A0003L05','0110B02A0002O02','0110B02A0001O01','0110B10G0005L01','0110B10M0005O02','0110B14J0025O01','0110B14J0010O02','0110B12M0500L03','0110B12M0850L04','0110B12G0500O01','0110B11G0050O02','0110B01A0030L01','0210H05V0006O01','0110B15N0001O01','0110B15N0002O02',
'0210A08G0000L01','0210A08G0000L02','0210A08G7030L03','0210A02H0000O05','0210A03N0003O07'";
}
if ($stockcode == '2')
{$stockset = "
	'0102E01A0005L03',
'0102E01A0010L02',
'0102E01N0005O05',
'0102F13N0025O03',
'0102E09V0040L01',
'0102E06I0240O05',
'0102D04C0005O02',
'0102D04C0025O01',
'0102D05L0875O01',
'0102D05L1125O02',
'0102D01A0025L02',
'0102D01A0050L03',
'0102D01A0100L01',
'0102D03C0025L04',
'0102D03C0625L05',
'0102D03C0125L03',
'0202D02E0100L01',
'0102D02M0100L02',
'0102D02B0100O02',
'0102D07P0010L01',
'0102D07P0040L03',
'0102E04D0030L02',
'0102E04D0060L03',
'0102E04H0090O07',
'0102E04D0120L01',
'0102E03C0120O01',
'0102G03D0002L04',
'0102G03C0002O02',
'0102G03C0004O03',
'0102C02C0025L04',
'0102C04E0005L01',
'0102C04E0020L02',
'0102E06F0005L03',
'0102E06F0010L01',
'0102E08P0005O03',
'0102E08P0010O01',
'0102G02A0010L01',
'0102G02A0025L02',
'0102H03D0050L01',
'0102F10I0300L01',
'0102F10I0150L02',
'0102F04C3125O01',
'0102F01A0150O02',
'0102E10Z0010O01',
'0102C05L0010L01',
'0102F04L0050L02',
'0102F04L0100L03',
'0102E07M0020L01',
'0102E07M0020O02',
'0102E07M0010O01',
'0102G01A0250L02',
'0102G01A0125L01',
'0102A08N0005L03',
'0102A08N0020L02',
'0102A08N0010L01',
'0102A01A0030O01',
'0102F09O0020L02',
'0102F09O0040L01',
'0102C03C0005O03',
'0102G08M0001L01',
'0102G08M0002L02',
'0102C08T0025O06',
'0102F05D0080O04',
'0102F05D0160O03',
'0102F02B0008O03',
'0102F02B0016O01'
	";
}
if ($stockcode == '3a')
{$stockset = "
	'0217B06B0003O01',
'0108F07L0150L02',
'0108F11H0010O01',
'0108F26B0001O02',
'0108F22V0300L01'
	";
}
if ($stockcode == '3b')
{$stockset = "
	'0102H05F0040L01',
'0102H05F0500L02',
'0102H01A0025L02',
'0102H01A0100L03',
'0301E04L0100L02',
'0102D07P0010L01',
'0102D07P0040L03',
'0102D01A0025L02',
'0102D01A0050L03',
'0102D01A0100L01',
'0102B01I0020O01',
'0102B01I0020L02'
	";
}
if ($stockcode == '4')
{$stockset = "
'0102H05F0040L01',
'0102H05F0500L02',
'0102H01A0025L02',
'0102H01A0100L03',
'0102H03D0050L01',
'0102G02A0010L01',
'0102G02A0025L02',
'0102B03I0005L07',
'0102B03I0010L04',
'0102B03I0010O01',
'0102B01I0020L02',
'0102B01I0020O01',
'0102A07L0250O02',
'0102A07L0625O03',
'0102D03C0025L04',
'0102D03C0625L05',
'0102D03C0125L03',
'0102D02M0100L02',
'0102D02B0100O02',
'0102D04C0005O02',
'0102D04C0025O01',
'0102D05L0875O01',
'0102D05L1125O02',
'0102D01A0025L02',
'0102D01A0050L03',
'0102D01A0100L01',
'0102F04L0050L02',
'0102F04L0100L03',
'0102F02B0008O03',
'0102F02B0016O01',
'0102F04C3125O01',
'0102F10I0150L02',
'0102F10I0300L01',
'0102F01A0150O02',
'0102F05D0080O04',
'0102F05D0160O03',
'0102C04E0005L01',
'0102C04E0020L02',
'0102C05L0010L01',
'0102C08T0025O06'
	";
}
if ($stockcode == '5')
{$stockset = "
	'0102E01A0005L03',
'0102E01A0010L02',
'0102E01N0005O05',
'0102F13N0025O03',
'0102E09V0040L01',
'0102E06I0240O05',
'0102D04C0005O02',
'0102D04C0025O01',
'0102D05L0875O01',
'0102D05L1125O02',
'0102D01A0025L02',
'0102D01A0050L03',
'0102D01A0100L01',
'0102D03C0025L04',
'0102D03C0625L05',
'0102D03C0125L03',
'0202D02E0100L01',
'0102D02M0100L02',
'0102D02B0100O02',
'0102D07P0010L01',
'0102D07P0040L03',
'0102E04D0030L02',
'0102E04D0060L03',
'0102E04H0090O07',
'0102E04D0120L01',
'0102E03C0120O01',
'0102G03D0002L04',
'0102G03C0002O02',
'0102G03C0004O03',
'0102C02C0025L04',
'0102C04E0005L01',
'0102C04E0020L02',
'0102E06F0005L03',
'0102E06F0010L01',
'0102E08P0005O03',
'0102E08P0010O01',
'0102G02A0010L01',
'0102G02A0025L02',
'0102H03D0050L01',
'0102F10I0300L01',
'0102F10I0150L02',
'0102F04C3125O01',
'0102F01A0150O02',
'0102E10Z0010O01',
'0102C05L0010L01',
'0102F04L0050L02',
'0102F04L0100L03',
'0102E07M0020L01',
'0102E07M0020O02',
'0102E07M0010O01',
'0102G01A0250L02',
'0102G01A0125L01',
'0102A08N0005L03',
'0102A08N0020L02',
'0102A08N0010L01',
'0102A01A0030O01',
'0102F09O0020L02',
'0102F09O0040L01',
'0102C03C0005O03',
'0102G08M0001L01',
'0102G08M0002L02',
'0102C08T0025O06',
'0102F05D0080O04',
'0102F05D0160O03',
'0102F02B0008O03',
'0102F02B0016O01',
'0102N02A0081L01',
'0104C03A0300L01',
'0104C03A0325L01',
'0102N03O0003L03',
'0102N03O0005L05',
'0102N08X0010O01',
'0102N08X0015O03',
'0102N09E0005O01',
'0102N01P0110O01',
'0102J11C0050L01',
'0102N01D0025L01',
'0102N04P0075L01',
'0102N04P0075L02',
'0102N04P0075O01',
'0110E08L00100L04',
'0110E08L0010O01',
'0110E08L00200L05',
'0110E08L00400L06',
'0310E01Q0000L01',
'0110E04E0010L01',
'0110E04E0010O01',
'0110E05F0100L01',
'0110E05F0160L02',
'0110E05F0300L03',
'0110E05T0135O08',
'0110E09M0040O02',
'0110E06G0300L01',
'0110E06G0600L02',
'0110E03C0010O01',
'0110E03R0020L02',
'0110E12S0010L01',
'0110E12S0020L02',
'0110E12S0040L03',
'0110E10N0050L03'
	";
}
if ($stockcode == '6')
{$stockset = "
	'0108G06E0050L02',
'0108G14M0025L01'";
}
if ($stockcode == '7')
{$stockset = "
	'0108F07L0150F02',
'0108F07L0150L02',
'0108F22V0300F01',
'0108F22V0300L01',
'0108F04C0300F02',
'0108F10Z0100F04',
'0108F10Z0100L04',
'0108F19S0600O02',
'0108F25E0600F03',
'0108F13N0200F01',
'0108F09G0030F01',
'0108F09G0030L01',
'0108F10G0250F01',
'0108F10G0250L01',
'0108F13N0200L01',
'0108F12K0166O01',
'0108F03A0125F01',
'0108F14N0100F01',
'0108F25I0100O01',
'0108F07E0025O01',
'0108F07E0025F01',
'0108F17A0300F01',
'0108F17A0300O01',
'0108F28P0300O01',
'0108F28P0600O02F',
'0108F27I0400O01',
'0108F18S0030F01',
'0108F18S0030L01',
'0108F20T1100F01',
'0108F20T1100L01'
";
}
if ($stockcode == '8')
{$stockset = "
	'0103B06S0002L01',
'0303B08S0060L01',
'0503B09S0020L04',
'0503B09V0200O05',
'0503B09S0100L02',
'0103B08T0025L01',
'0503B12S0025O01',
'0103B09T0200L01',
'0103B12D0500O01',
'0503B10S0025O04',
'0503B10S0050O03',
'0503B10S0025L01'
	";
}
if ($stockcode == '9')
{$stockset = "
	'0110F03C0002L01',
'0110F07R0025L02',
'0110F02A0025L01',
'0111E15F0200L01',
'0111E04F0000L01',
'0202R01E0004L05P',
'0202R01E0004L11',
'0202R01E0004L08',
'0119A01S0300L01',
'0111D07C0600L05',
'0111D07C0835L06',
'0111D07C1000L03',
'0101A02A0500L01'	";
}
if ($stockcode == '10')
{$stockset = "
	'0104N02B0025L01',
'0104N07T0050O02',
'0404N03N0002O01',
'0104N04J0005L01',
'0104N05M0250L01'
	";
}
if ($stockcode == '11')
{$stockset = "
	'0117C02I0050L02',
'0117C01C0025L03',
'0117C01C0100L02',
'0117C03M0250L01',
'0117C03M0360O01',
'0105D03P0005L02',
'0104P01P0060L01'
	";
}
if ($stockcode == '12')
{$stockset = "
	'0104H01C0200L01',
'0104F02C0100L01',
'0102H03D0050L01',
'0104C14I0200L01',
'0104C14I0400L02',
'0104C14S0400O03',
'0104C15I0025L01'
	";
}
if ($stockcode == '13')
{$stockset = "
	'0117C02I0050L02',
'0108G06E0050L02',
'0217B06B0003O01',
'0108G14M0025L01'
	";
}
if ($stockcode == '14')
{$stockset = "
	'0110E08L00400L06',
'0110E08L00200L05',
'0110E08L0010O01',
'0110E08L00100L04',
'0110E15X0020O02',
'0110E15X0010O01',
'0110E15X0040O03',
'0310E01Q0000L01',
'0110E04E0010O01',
'0110E04E0010L01',
'0110E05F0100L01',
'0110E05F0160L02',
'0110E05F0300L03',
'0110E05T0135O08',
'0110E09M0040O02',
'0110E06G0300L01',
'0110E06G0600L02',
'0110E03C0010O01',
'0110E03R0020L02',
'0110E12S0010L01',
'0110E12S0020L02',
'0110E12S0040L03',
'0110E10N0050L03'
	";
}
if ($stockcode == '15')
{$stockset = "
	'0117A11H0200L01',
'0108G14M0025L01',
'0105D03P0005L02',
'0104C24S0500L02',
'0108H02C0250L01'
	";
}
if ($stockcode == '16')
{$stockset = "
	'0102H02D0250O03',
'0513F06L0000O01',
'0513F01A0000O02',
'0513F10C0000O01',
'0513F03A0000O01',
'0513F08T0002O01',
'0513F06L0000L01',
'0513F09X0000O01',
'0513F08T0025O01',
'0513F08T0003O01',
'0513F05G0000L01',
'0513F08T0005O01',
'0513F08T0000O01'
	";
}
if ($stockcode == '17')
{$stockset = "
	'0117C01C0025L03',
'0117C01C0100L02',
'0108G06E0050L02',
'0117C03M0250L01',
'0117C03M0360O01',
'0105D03P0005L02',
'0204C05M0500O01'
	";
}
if ($stockcode == '18')
{$stockset = "
	'0117A11H0200L01',
'0108G14M0025L01',
'0105D03P0005L02',
'0104C24S0500L02',
'0108H02C0250L01',
'0108G06E0050L02',
'0117C01C0025L03',
'0117C01C0100L02',
'0117C03M0250L01',
'0117C03M0360O01',
'0117C02I0050L02'
	";
}
if ($stockcode == '19')
{$stockset = "
	'0117C01C0025L03',
'0117C01C0100L02',
'0108G06E0050L02',
'0105F01A0050L01'
	";
}
if ($stockcode == '20')
{$stockset = "
	'0118A03D0500L03',
'0218A04D0500O01',
'0111I01F0005L02'
	";
}
if ($stockcode == '21')
{$stockset = "
	
	";
}
if ($stockcode == '22')
{$stockset = "
	'0114H01N0025O01',
'0414B01B0450L01',
'0414C04B0500L02',
'0414C04B0000O03',
'0414C05C0500L02',
'0414H02C0450L01',
'0117C01C0025L03',
'0117C01C0100L02',
'0108G14M0025L01',
'0414C15T0500L01',
'0414C16T0500L02',
'0414C16T0060L03'
	";
}
if ($stockcode == '23a')
{$stockset = "
	'0117C02I0050L02',
'0108G06E0050L02',
'0117C01C0025L03',
'0117C01C0100L02',
'0108E02D0100L01',
'0117C03M0250L01',
'0117C03M0360O01',
'0105D03P0005L02'
	";
}
if ($stockcode == '23b')
{$stockset = "
	'0117C02I0050L02',
'0414B01B0450L01',
'0414C04B0500L02',
'0414C04B0000O03',
'0414C05C0500L02',
'0108G06E0050L02',
'0108E02D0100L01',
'0105D01D0004L02',
'0105D01D0005L01',
'0107H06D0100L01',
'0107D05E0250L01',
'0205D04S0100L02',
'0205D05S1000L01',
'0107H08M0500L01',
'0117C03M0250L01',
'0117C03M0360O01',
'0105D03P0005L02',
'0107H07T0250L01',
'0414C15T0500L01',
'0414C16T0500L02',
'0414C16T0060L03'
	";
}
if ($stockcode == '23c')
{$stockset = "
	'0108E02D0100L01',
'0104C24S0500L02',
'0414B01B0450L01',
'0414C04B0500L02',
'0414C05C0500L02',
'0414C15T0500L01',
'0414C16T0500L02'
	";
}
if ($stockcode == '23d')
{$stockset = "
	'0104C08C0006L01',
'0108G06E0050L02',
'0117C01C0025L03',
'0117C01C0100L02',
'0108E02D0100L01',
'0107E05D0250L01',
'0107E05D0500L02',
'0107D05E0250L01',
'0117C03M0250L01',
'0117C03M0360O01',
'0105D03P0005L02',
'0107H07T0250L01',
'0107J01B0480L01'
	";
}
if ($stockcode == '23E')
{$stockset = "
	'0117C02I0050L02',
'0104C08C0006L01',
'0108G06E0050L02',
'0117C01C0025L03',
'0117C01C0100L02',
'0108E02D0100L01',
'0108G14M0025L01'
	";
}
if ($stockcode == '24')
{$stockset = "
	'0117C02I0050L02',
'0105D01D0004L02',
'0105D01D0005L01',
'0117C03M0250L01',
'0117C03M0360O01',
'0105D03P0005L02',
'0108H06Q0300L01',
'0108G06E0050L02',
'0105E02L0100L01',
'0117C01C0025L03',
'0117C01C0100L02'
	";
}

if ($stockcode == '25')
{$stockset = "
	'0110D01M0005L01',
'0110D02P0050L01'
	";
}

if ($stockcode == '26')
{$stockset = "
	'0104F02C0025L03',
'0104F02C0050L04',
'0104F03C0025L02',
'0104F03C0100L01',
'0204F05F0025L01',
'0104F04H0002L03',
'0104F04H0005L02',
'0104F04H0005L04',
'0104F05O0005L02',
'0104F05O0010L03',
'0104F06P0002L02',
'0104F06P0004L03',
'0104F06P0008L04',
'0104F16Q0025L02',
'0104F16Q0050L03',
'0104F16Q0200L01',
'0104F08R0002L01',
'0104F11T0010L01',
'0104F11T0025L02',
'0104F11T0050L03',
'0104F11T0100L04'
	";
}


	
$sql = "
   select * from
 (
select top 3 row_number() over (partition by stockcode order by HNOPD_PRESCRIP_MEDICINE.MakeDatetime asc)as rowno
,HNOPD_MASTER.hn,HNOPD_PRESCRIP_MEDICINE.MakeDatetime,stockcode,qty  from HNOPD_MASTER 
 left join HNOPD_Prescrip on dbo.HNOPD_PRESCRIP.VisitDate = dbo.HNOPD_MASTER.VisitDate AND dbo.HNOPD_PRESCRIP.VN = dbo.HNOPD_MASTER.VN
 left join dbo.HNOPD_PRESCRIP_MEDICINE ON dbo.HNOPD_PRESCRIP_MEDICINE.VisitDate = dbo.HNOPD_PRESCRIP.VisitDate AND dbo.HNOPD_PRESCRIP_MEDICINE.VN = dbo.HNOPD_PRESCRIP.VN AND dbo.HNOPD_PRESCRIP_MEDICINE.PrescriptionNo = dbo.HNOPD_PRESCRIP.PrescriptionNo
 where year(HNOPD_PRESCRIP_MEDICINE.MakeDatetime) = '$year' 
  and stockcode in ($stockset)
and HNOPD_MASTER.hn in ('$hn') 
) q
where rowno = '$num'";
//echo $sql;
$row_hnname = odbc_exec($con_hos, $sql);

//echo $row_hnname;
$num = odbc_num_rows($row_hnname);
//if ($num == 0)
//{echo '<td>&nbsp;'.'</td>'.'<td>&nbsp;'.'</td>'; }

//echo  $sql;
 while($ROWS_hnname = ODBC_FETCH_ARRAY($row_hnname)){ 
//echo "<br>$row_maincate = odbc_exec($con_hos, $sql_getmaincate);<br>";
echo '<td>'.stockname($ROWS_hnname['stockcode'],$con_stock).' </td>';
echo '<td>'.getthdate($ROWS_hnname['MakeDatetime']).' </td>';
//$ROWS_hnname = ODBC_FETCH_ARRAY($row_hnname);
//return(iconv('TIS-620','utf-8',$ROWS_hnname['ResultValue']));
 }
}


function xraytop3d($hn,$xraycode,$year,$month,$day,$con_hos,$num){
$sql = "
 select * from
 (
select top 3 row_number() over (partition by XrayCodeCollection order by HNXRAYREQ_HEADER.EntryDatetime asc)as rowno,hn,ImpressionMemo,HNXRAYREQ_HEADER.Entrydatetime from HNXRAYREQ_HEADER 
left join dbo.HNXRAYREQ_RESULT ON dbo.HNXRAYREQ_RESULT.FacilityRmsNo = dbo.HNXRAYREQ_HEADER.FacilityRmsNo AND dbo.HNXRAYREQ_RESULT.RequestNo = dbo.HNXRAYREQ_HEADER.RequestNo
where year(HNXRAYREQ_HEADER.Entrydatetime) = '$year' 
and  month(HNXRAYREQ_HEADER.Entrydatetime) = '$month' 
and  month(HNXRAYREQ_HEADER.Entrydatetime) = '$day' 
and HNXRAYREQ_HEADER.hn in ('$hn')
and XrayCodeCollection like ('$xraycode')
) q
where rowno = '$num'";
$row_hnname = odbc_exec($con_hos, $sql);

//echo $row_hnname;
$num = odbc_num_rows($row_hnname);
if ($num == 0)
{echo '<td>&nbsp;'.'</td>'.'<td>&nbsp;'.'</td>'; }

//echo  $sql;
 while($ROWS_hnname = ODBC_FETCH_ARRAY($row_hnname)){ 
//echo "<br>$row_maincate = odbc_exec($con_hos, $sql_getmaincate);<br>";
echo '<td>'.(iconv('TIS-620','utf-8',$ROWS_hnname['ImpressionMemo'])).' </td>';
echo '<td>'.getthdate($ROWS_hnname['Entrydatetime']).' </td>';
//$ROWS_hnname = ODBC_FETCH_ARRAY($row_hnname);
//return(iconv('TIS-620','utf-8',$ROWS_hnname['ResultValue']));
 }
}


function MISmessage($HN,$con_hos)
{
$sql = "select * from HNPAT_MSG where HNPatientMsgType = '11'
 and HN = '$HN'
";
$row = odbc_exec($con_hos, $sql);
//echo $sql;
while($ROWS = ODBC_FETCH_ARRAY($row))
 { 
return 'Y';
}
}

function labxray($VN,$visitdate,$PrescriptionNo,$con_hos)
{
$sql = "select count(LabCode) as numcount from HNOPD_PRESCRIP_TREATMENT 
where
HNOPD_PRESCRIP_TREATMENT.VisitDate = '$visitdate' 
and  vn = '$VN'
and PrescriptionNo ='$PrescriptionNo'
group by VisitDate,vn,PrescriptionNo
";
$row = odbc_exec($con_hos, $sql);
//echo $sql;
$numcount = 0;

while($ROWS = ODBC_FETCH_ARRAY($row))
 { 
 $numcount += $ROWS['numcount'];
 }
 
$sql2 = "select count(XrayCode) as numcount from HNOPD_PRESCRIP_TREATMENT 
where
HNOPD_PRESCRIP_TREATMENT.VisitDate = '$visitdate' 
and  vn = '$VN'
and PrescriptionNo ='$PrescriptionNo'
group by VisitDate,vn,PrescriptionNo
";
$row2 = odbc_exec($con_hos, $sql2);
 while($ROWS2 = ODBC_FETCH_ARRAY($row2))
 { 
 $numcount += $ROWS2['numcount'];
 }
 
 if ( $numcount > 0 )
 {return 'Y';} else {return 'N';}
 
}


function contrastOPD($VN,$visitdate,$con_hos){
$sql = "select count(stockcode) as numcount from HNOPD_PRESCRIP_MEDICINE where stockcode in 
('1016A10U3005O02',
'1016A10U3701O03',
'1016A10U3705O04',
'1016A12X3501O02',
'1016A12X3505O03',
'1016A12O3501O01',
'1016A12O3501O02',
'1016A12O3501O50',
'1016A15V3201O01',
'1016A15V3201O02',
'1016A02D0010O01',
'1016A02D0015O02')and 
HNOPD_PRESCRIP_MEDICINE.VisitDate = '$visitdate' 
and  vn = '$VN'
group by VisitDate,vn
";
$row = odbc_exec($con_hos, $sql);
//echo $sql;
$numcount = 0;

while($ROWS = ODBC_FETCH_ARRAY($row))
 { 
 $numcount += $ROWS['numcount'];
 }
 if ( $numcount > 0 )
 {return 'Y';} else {return 'N';}
}

function contrastIPD($AN,$con_hos){
$sql = "select count(stockcode) as numcount from HNIPD_CHARGE_MEDICINE where stockcode in 
('1016A10U3005O02',
'1016A10U3701O03',
'1016A10U3705O04',
'1016A12X3501O02',
'1016A12X3505O03',
'1016A12O3501O01',
'1016A12O3501O02',
'1016A12O3501O50',
'1016A15V3201O01',
'1016A15V3201O02',
'1016A02D0010O01',
'1016A02D0015O02') 
and  AN = '$AN'
group by AN
";
$row = odbc_exec($con_hos, $sql);
//echo $sql;
$numcount = 0;

while($ROWS = ODBC_FETCH_ARRAY($row))
 { 
 $numcount += $ROWS['numcount'];
 }
 if ( $numcount > 0 )
 {return 'Y';} else {return 'N';}
}

function gender($sex)
{if($sex = 1){echo "Female";} else {echo "Male";}
}

function EANStockCode($stockcode,$con_stock){
//echo "stockcode = $stockcode";
$sql_getstockname = "select EANStockCode from STOCKMASTER where stockcode = '$stockcode'";
//echo "<br>sql = $sql_getstockname";
$row_stockname = odbc_exec($con_stock, $sql_getstockname);
//echo "<br>$row_maincate = odbc_exec($con_hos, $sql_getmaincate);<br>";
//echo "<br>row_maincate = $row_maincate";
$ROWS_stockname = ODBC_FETCH_ARRAY($row_stockname);
return($ROWS_stockname['EANStockCode']);
}


function ssoclinic($clinic)
{
$z1 = array('02011','05001','05002','05003','05004','05005','05006','05007','05008','05009','05010','05011','05012','07013','07014','12001','12002',
'12003','12004','15010','15011','15012','15013','15014','15015','15016','15017','15018','15019','15021','15034');//01
$z2 = array('02001','02002','02004','02005','02006','02007','02008','02009','02012','02013','07001','07002','07007','07008','07015','07016','07027',
'07028','07029','07030','14004','15002','15024','15025','15027','15028','15029','15030','15031','15032','15033','15035');//02
$z3  = array('01002','01004','07005','07006','13002','14003','14005','14006','14007');//03
$z4 = array('01001','01003','01005','01006','15006','15007');//04
$z5= array('02010','04001','04002','04003','04004','04005','04006','04007','04008','04009','04010','04011','04012','04013','04014','04016','07012');//05
$z6  = array('07018','07020','10005','11001','15001');//06
$z7= array('07017','07019','11002','11003','11004','11005','15005');//07
$z8 = array('02003','03001','03002','03003','03004','03005','07009','07010','15023','15026','18001','18002','18003','18004','18005','18006','18007',
'18008','18009');//08
$z9 = array('04015','05013','15020');//09
$z11 = array('10001','10002','10003','10004','10006','10007','10008','10009','10010');//11
$z12 = array('07021','07022','07023','07024','07025','07026');//12
$z99 = array('06001','06002','07003','07004','07031','07032','07033','07034','07035','07036','07037','07038','07039','07040','07041','07042','07043',
'07044','07045','07046','08001','08002','08003','08004','08005','08006','08007','08008','08009','08010','08011','08012','08013','08014','09001','09002',
'13001','13003','13004','13005','13006','14001','14002','14008','14009','15003','15004','150041','150042','150043','15008','15009','15022','15036','15037',
'15038','15039','20000','999910','999911','99994','99995','99996','99997','99998','99999');//99

if( in_array ($clinic , $z1))
{ $x =  '01';}
if( in_array ($clinic , $z2))
{ $x =  '02';}
if( in_array ($clinic , $z3))
{ $x =  '03';}
if( in_array ($clinic , $z4))
{ $x =  '04';}
if( in_array ($clinic , $z5))
{ $x =  '05';}
if( in_array ($clinic , $z6))
{ $x =  '06';}
if( in_array ($clinic , $z7))
{ $x =  '07';}
if( in_array ($clinic , $z8))
{ $x =  '08';}
if( in_array ($clinic , $z9))
{ $x =  '09';}
if( in_array ($clinic , $z11))
{ $x =  '11';}
if( in_array ($clinic , $z12))
{ $x =  '12';}
if( in_array ($clinic , $z99))
{ $x =  '99';}

return $x;
}
?>


