<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>

<body>
<? date_default_timezone_set("Asia/Bangkok");?>
      <form action="billtranslt.php" method="post">
      VN :<input  type="text" name="vn"  required="required"/><br />
      Visitdate : <input  type="date" name="visitdate" required="required"/><br />
      <div class="form-group"><div class="col-sm-2" align="right"> A/E : </div><div class="col-sm-5" align="left">
                  <select name="AE" class="form-control" required>
                    <option selected="selected">A</option>
                  <option>E</option>
                  </select>
                </div>
              </div>
      SESSNO:<input  type="text" name="sessno" required="required" /><br />
      PRESNO:<input  type="text" name="pres" required="required" /><br />
      <input type="hidden" name ="d1"  value="<?=date('Y-m-d')?>" />
      <input type="hidden" name ="d2"  value="<?=date('H:i')?>" />

<input type="submit" />

</form>
</body>
</html>
