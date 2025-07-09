<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=window-874" />
<meta http-equiv="refresh" content="10"/>
<!-- TemplateBeginEditable name="doctitle" -->
<title>Index</title>
<!-- TemplateEndEditable -->
<!-- TemplateBeginEditable name="head" -->
<!-- TemplateEndEditable -->
<style type="text/css">
      

    <style>
      /* ~~ Element/tag selectors ~~ */
      ul, ol, dl { /* Due to variations between browsers, it's best practices to zero padding and margin on lists. For consistency, you can either specify the amounts you want here, or on the list items (LI, DT, DD) they contain. Remember that what you do here will cascade to the .nav list unless you write a more specific selector. */
        padding: 0;
        margin: 0;
      }
      h1, h2, h3, h4, h5, h6, p {
        margin-top: 0;	 /* removing the top margin gets around an issue where margins can escape from their containing div. The remaining bottom margin will hold it away from any elements that follow. */
        padding-right: 15px;
        padding-left: 15px; /* adding the padding to the sides of the elements within the divs, instead of the divs themselves, gets rid of any box model math. A nested div with side padding can also be used as an alternate method. */
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
     
    </style>

</head>

<body>


<? 
    include("../Connect/ConnectSSB.php");
    include("../FunctionHos/Functionlist.php");
?>
  <? date_default_timezone_set("Asia/Bangkok");?>
  
  <?
    $hostname = "localhost";
    $user = "root";
    $password = "Admin@2018";
    $dbname = "qfinancial";
    $db_handle = mysql_connect($hostname,$user,$password)or die("Cannot connect to Database");
    $db_found = mysql_select_db($dbname)or die("Cannot connect to Database");

   $slot = $_GET['slot'];  
  ?>
  <font size="5">ช่องคิวที่เรียก <? if($slot=='4'){echo 'Refill';}else{echo $slot;}?>
  
  </font>
  <table width="100%" border="1">
  <tr>
  <td  align="center"><font size="+6">
<strong>  คิวรอเรียกชำระเงิน</strong></font>
  </td>
  <td  align="center" <? if ($slot == '1'){echo "bgcolor='#00CCCC'" ;}?>>
  <a href="menuRecMedAdd.php?slot=1"><font size="+6" >
 <strong> คิวการเงิน 1</strong></font></a>
  </td>
   <td  align="center" <? if ($slot == '2'){echo "bgcolor='#00CCCC'" ;}?>>
   <a href="menuRecMedAdd.php?slot=2"><font size="+6">
 <strong> คิวการเงิน 2</strong></font></a>
  </td>
   
  <td  align="center" <? if ($slot == '3'){echo "bgcolor='#00CCCC'" ;}?>>
  <a href="menuRecMedAdd.php?slot=3"><font size="+6" >
 <strong> คิวการเงิน 3</strong></font></a>
  </td>
  
  
   <td  align="center" <? if ($slot == '4'){echo "bgcolor='#00CCCC'" ;}?>>
   <a href="menuRecMedAdd.php?slot=4"><font size="+6">
 <strong> คิวการเงิน 4</strong></font></a>
  </td>
  <tr>
<td ><font size="5"><strong>

  <?
 $vn = $_POST['vn'];
 // echo $date = date("d/m/Y");
  $ydate = date("Y");
  $mdate = date("m");
  $ddate = date("d");

  //ดึงคิวที่นั่งรอชำระเงิน
 $sql = "SELECT 
              HNOPD_PRESCRIP.VN,
              HNOPD_MASTER.HN,
              SUBSTRING (dbo.HNPAT_NAME.FirstName, 2, 100) + ' ' + SUBSTRING (dbo.HNPAT_NAME.LastName, 2, 100) AS Name,
              HNOPD_PRESCRIP.PrescriptionNo,
              HNOPD_PRESCRIP.Clinic,
              (SELECT ISNULL(SUBSTRING(LocalName, 2, 1000), SUBSTRING(EnglishName, 2, 1000))
                  FROM DNSYSCONFIG
                  WHERE CtrlCode = '42203'
                  AND code = HNOPD_PRESCRIP.Clinic) AS ByClinic,
              CASE 
                  WHEN HNOPD_PRESCRIP.LastDiagOpdMasterLogType = '22' THEN 'Drug_Acknowledge'  
                  WHEN HNOPD_PRESCRIP.LastDiagOpdMasterLogType = '23' THEN 'Drug_Ready' 
                  WHEN HNOPD_PRESCRIP.LastDiagOpdMasterLogType = '17' THEN 'NurseCounter_Release' 
              END AS LastDiagOpdMasterLogType,
              HNOPD_PRESCRIP.DrugAcknowledge,
              HNOPD_PRESCRIP.DefaultRightCode,
              HNOPD_PRESCRIP.CloseVisitCode,
              HNOPD_PRESCRIP.DrugReady,
              HNOPD_PRESCRIP.ApprovedDateTime,
              HNOPD_PRESCRIP.ApprovedByUserCode,
              HNOPD_MASTER.OutDateTime
              FROM [dbo].[HNOPD_PRESCRIP]
              LEFT OUTER JOIN HNOPD_MASTER 
              ON HNOPD_PRESCRIP.VisitDate = HNOPD_MASTER.VisitDate 
              AND HNOPD_PRESCRIP.VN = HNOPD_MASTER.VN
              LEFT OUTER JOIN HNPAT_NAME 
              ON HNOPD_MASTER.HN = HNPAT_NAME.HN
              WHERE 
              CONVERT(date, HNOPD_PRESCRIP.VisitDate, 23) = CONVERT(date, GETDATE(), 23)
              AND HNOPD_PRESCRIP.DefaultRightCode NOT IN (
                  '2100', '2106', '2205', '2208', '2210', '2212', '2214', '4100', 
                  '2105', '2108', '2206', '2209', '2211', '2213', '2215', '21002')
              AND HNOPD_PRESCRIP.Clinic NOT IN (
                  '14009', '15001', '15002', '15005', '15006', '15007', '15010', 
                  '15011', '15012', '15013', '15014', '15015', '15016', '15017', 
                  '15018', '15019', '15020', '15021', '15023', '15024', '15025', 
                  '15026', '15027', '15028', '15029', '15030', '15031', '15032', 
                  '15033', '15035', '15008', '15009', '99994', '12001', '12004', 
                  '12003', '07024', '07014', 'WIKPS01', '15003')
              AND HNOPD_PRESCRIP.CloseVisitCode = 'D/C'
              AND HNOPD_MASTER.OutDateTime IS NULL
              ORDER BY HNOPD_PRESCRIP.NurseAckDateTime ASC";

//echo $sql;
  $row = odbc_exec($con_hos, $sql);

  
 while($ROWS = ODBC_FETCH_ARRAY($row)){ 
  ?>  
  <? 
      $VN = $ROWS['VN'] ;
      $pres = $ROWS['PrescriptionNo'];
      //echo $VN ;
     // echo $pres;
  ?>

  <?  
      $da = 0;
      $VN;
      $mcsql =" select count(vn) as ct from slotmed1 where vn = '$VN' and PRESCRIP = '$pres'";
      mysql_query("SET NAMES UTF8");
      $mresult = mysql_query($mcsql);

//$ad = mysql_fetch_row($mresult);
//echo $ad.'<br />' ;
//$da = mysql_num_rows($mresult);
//echo $da.'<br />' ;

while($ROWS1 = mysql_fetch_array($mresult))
{ 
$da =  $ROWS1['ct'];
}
  if ($da > 0)
  { }
  else{	  

if ($slot =='')
{?>
	 <?=$ROWS['VN'];?>/<?=$ROWS['PrescriptionNo']?> : 
	 <?=hnname($ROWS['VN'],$ydate,$mdate,$ddate,$con_hos);?><br />
     <?
    }else{
    ?>  
        <a href="soundAddmed.php?vn=<?=$ROWS['VN']?>&pres=<?=$ROWS['PrescriptionNo']?>&slot=<?=$slot?>"><?=$ROWS['VN'];?>/<?=$ROWS['PrescriptionNo']?></a>
        : <?=hnname($ROWS['VN'],$ydate,$mdate,$ddate,$con_hos);?>
        <br />


      <?
    }
  }
}

?>
</strong></font></td>
<td  align="center"><font size="+6"><strong>
<? 

    $msql ="select * from slotmed1 where slot = '2'";

    mysql_query("SET NAMES UTF8");
    $result = mysql_query($msql);
    while ($dn = mysql_fetch_array($result))
    {   $noslot = $dn['noslot'];
    //   $dn['vn'].'-'.$dn['PRESCRIP'].'<br>';
      ?>
      <a href="recMedDelete.php?&noslot=<?=$noslot?>&slot=2">
      <? echo $dn['vn'].'/'.$dn['PRESCRIP'].'<br>';?>
      </a>
      
      <? }?>
  
  </strong></font></td>
  <td  align="center"><font size="+6"><strong>
<? 

$msql ="select * from slotmed1  where slot = '3'";

mysql_query("SET NAMES UTF8");
$result = mysql_query($msql);
while ($dn = mysql_fetch_array($result))
{   $noslot = $dn['noslot'];
//   $dn['vn'].'-'.$dn['PRESCRIP'].'<br>';
  ?>
   <a href="recMedDelete.php?&noslot=<?=$noslot?>&slot=3">
  <? echo $dn['vn'].'/'.$dn['PRESCRIP'].'<br>';?>
  </a>
  
  <? }?>
  
 </strong></font> </td>
 
  <td  align="center"><font size="+6"><strong>
<? 

$msql ="select * from slotmed1  where slot = '4'";

mysql_query("SET NAMES UTF8");
$result = mysql_query($msql);
while ($dn = mysql_fetch_array($result))
{   $noslot = $dn['noslot'];
//   $dn['vn'].'-'.$dn['PRESCRIP'].'<br>';
  ?>
   <a href="recMedDelete.php?&noslot=<?=$noslot?>&slot=3">
  <? echo $dn['vn'].'/'.$dn['PRESCRIP'].'<br>';?>
  </a>
  
  <? }?>
  
 </strong></font> </td>
 
  <td  align="center"><font size="+6"><strong>
    <? 

$msql ="select * from slotmed1 where slot = '1'";

mysql_query("SET NAMES UTF8");
$result = mysql_query($msql);
while ($dn = mysql_fetch_array($result))
{   $noslot = $dn['noslot'];
//   $dn['vn'].'-'.$dn['PRESCRIP'].'<br>';
  ?>
    <a href="recMedDelete.php?&noslot=<?=$noslot?>&slot=1">
  <? echo $dn['vn'].'/'.$dn['PRESCRIP'].'<br>';?>
  </a>
  
  <? }?>
  
  </strong></font></td>
  
  
  </tr>  
  
  
  </table>

<?
$sqldel =
"select distinct VN , PrescriptionNo from [dbo].[HNOPD_PRESCRIP] where
VisitDate = '$ydate-$mdate-$ddate 00:00:00.000' 
and  DefaultRightCode in 
('2100','2106','2205','2208','2210','2212','2214','4100','2105','2108','2206','2209','2211','2213','2215')
and LASTDIAGOPDMASTERLOGTYPE in ('24','25','21','93') 
and DrugCheckOut = '1'
and ( vn in (select vn from [dbo].[HNOPD_PRESCRIP_MEDICINE]  where
VisitDate = '$ydate-$mdate-$ddate 00:00:00.000' and stockcode not in ('NODRUG') 
and HereUsage = '0'and DispendDrugReasonCode is null  and CxlByUserCode is null and StatDoseQtyCode is null
))";
  $resultdel = odbc_exec($con_hos, $sqldel);
 while($ROWSDEL = ODBC_FETCH_ARRAY($resultdel))
 { 
	 $vndel = $ROWSDEL['VN'];
	 $presdel = $ROWSDEL['PrescriptionNo'];
	 $msql ="delete from slotmed1 where vn = '$vndel' and PRESCRIP = '$presdel' ";
		mysql_query("SET NAMES UTF8");
		$result = mysql_query($msql);
		
		//echo  $msql.'</br>';
 }
?>

<!--<select name='slot'>
  <option <? if ($slot == '2'){?> selected="selected"<? }?>><font size="7">2</font></option>
    <option <? if ($slot == '3'){?> selected="selected"<? }?>>3</option>
      <option <? if ($slot == '4'){?> selected="selected"<? }?> value="4">Refill</option>
  </select>-->

</body>


</html>
