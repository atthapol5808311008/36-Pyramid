<?php
ini_set('max_execution_time', 86400); // 86400 = 60 * 60 * 24 seconds = 24 Hours
$start = microtime();
/*
Script_name : mysqlworking.php
Source_code : http://www.thaiall.com/perlphpasp/source.pl?9116
Version 6.2560-08-25
###########################
Update Description
- ปรับ properties เป็น style ทั้งหมด
- ตรวจสอบ phpversion() และ iconv() ทำเงื่อนไขรองรับ 5gbfree.com (php 7.1.8 mysql 5.0.12) ที่ไม่บริการ iconv() 
- ปรับเป็น mysqli แทน mysql เพื่อให้ใช้งานกับ 000webhosting.com (php 7.1.7 mysql 5.0.12)
- เพิ่มลักษณะข้อมูลเป็น ตัวอักษรภาษาไทย และภาษาอังกฤษ เมื่อ insert 1000 ผ่าน การแปลงตัวอักษรด้วย iconv();
- เพิ่มการควบคุมตัวอักษรพิเศษ เปิดปิดการป้องกัน SQL Injection ผ่านตัวแปร $protect_sql_injection สำหรับกการ search
- เพิ่มการตรวจสอบ keyword สำหรับ findname ต้อง > 1 ตัวอักษร 
- ตารางที่สร้างกำหนด COLLATION คือ การจัดเรียงและเปรียบเทียบเป็นแบบ ด้วย COLLATE utf8_unicode_ci
- ปรับให้ทำงานกับ UTF-8 ตั้งแต่สร้างตาราง ด้วย CHARSET=utf8
- ย้ายปุ่ม Delete Table ไปไว้ด้านหลัง และปรับสี
- ปรับให้ใช้กับ XAMPP บน Local host [xampp-win32-5.6.31-0-VC11-installer]
- ปรับให้ใช้กับ Palapa Web Server บน Smartphone
- ปรับให้ใช้กับ Thaiabc.ueuo.com บน Free web hosting
- เพิ่มปุ่มให้สร้าง Table ได้ทั้ง innodb และ myisam
- เปลี่ยนวิธีติดต่อ Database ตามข้อกำหนดใน php 5.4.4 บน xampp for windows 1.8.0
จาก $result = mysql_db_query($db,$query); เป็น mysql_select_db($db,$connect); และ $result = mysql_query($query,$connect);
- เริ่มพัฒนาในปี 2547 เพื่อใช้งานร่วมกับข้อมูลใน Microsoft Excel
- https://gist.github.com/thaiall/6a360c71ef95193864fcea2eb7f52e8b
########################### */

/* Section 1 : Configuration */
// 1.1 Main configuration
$host		= 'localhost';
$db			= 'mysql'; 			// please change for the implementation
$tb			= 'car';
$user		= 'atthapol'; 			// for xampp Web Server
$password	= 'Qwerty00--'; 				// for xampp Web Server
// $user	= 'root'; 			// for Palapa Web Server
// $password = 'adminadmin'; 	// for Palapa Web Server
// 1.2 Security option
$protect_sql_injection = false; // true = safe; false = unsafe
$phpinfo_function_allow = true; // true = can use phpinfo()
// 1.3 Database connection
$connect = new mysqli($host,$user,$password,$db);
if ($connect->connect_error) die("Connection Database :failed"); 
$result = $connect->query("show tables like '$tb'");
$tb_found = $result->num_rows;
// 1.4 phpinfo function
if (isset($_GET{'action'}) && ($_GET{'action'} == "phpinfo") && ($phpinfo_function_allow == true)) {
	phpinfo(); 
	exit;
}
// 1.5 start html
echo '<html><head><title>Mysql Working</title>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<style type="text/css">
textarea{font-size:10px;color:blue;scrollbar-base-color:red;scrollbar-arrow-color:white;background-color:#ffffdd;}
input{font-family:microsoft sans serif;font-size:16px;color:black;background:#ffffdd;}
</style>
</head><body>';
?>

<!-- Section 2 : Menu screen -->
<form action="" method="post">
<table style="background-color:blue;border-width:15px;border-style:solid;width:740px;margin-left:auto;margin-right:auto;text-align:center;">
<?php if ($tb_found == 0) { ?>
<tr><td style="background-color:white">
<input type="submit" value="Create table InnoDB" name="action" style="width:350px;height:50px;">
<input type="submit" value="Create table MyISAM" name="action" style="width:350px;height:50px;">
</td></tr>
<?php } else { ?>
<tr><td style="vertical-align:top;background-color:white;width:100;text-align:center;">
<input type="submit" value="post 1000" name="action" style="width:100px;background-color:yellow;">
<input type="submit" value="post_recs" name="action" style="width:100px;background-color:#dddddd;">
<input name="recs" value="1000" size="6">
</td>
<td style="background-color:#dddddd"><input type="submit" value="postmany" name="action" style="width:100px;background-color:#ddffdd;"> 
ข้อมูลข้างล่างนี้สามารถ copy จาก excel มา paste ได้<br/>
<textarea name="manyrecord" rows="4" cols="120" wrap="off">
1	2547		หจก.	กองเกตุเอ๊กซ์เปรส	20	11	2551	8/1 ม.2 แขวงทุ่งครุ 	ทุ่งครุ	กรุงเทพฯ			17		14			3						1		3
2	2547		หจก.	ดาวคะนองการท่องเที่ยว	5	1	2552	10/223 ม.4 แขวงดินแดง	ห้วยขวาง	กรุงเทพฯ			2		2											3
3	2547		บจ.	ธรรมนูญ โพธิ์ทอง	5	1	2552	1407/6 ซ.ตากสิน 7 ถ.สมเด็จพระเจ้าตากสิน แขวงบุคคโล	สายไหม	กรุงเทพฯ			4		2					2						3
4	2547		บจ.	นิติพงษ์ ไพบูลย์ทรานสปอร์ต	6	1	2552	15/20 ถ.นวลจันทร์ แขวงคลองกุ่ม	สายไหม	กรุงเทพฯ			1						1							3
5	2547		นาย	บางแคการท่องเที่ยว	6	1	2552	209/718 ม.ปรีชา 8 ถ.รามคำแหง แขวงหัวหมาก	สะพานสูง	กรุงเทพฯ			1											1		3
6	2547		นาย	ผาน  ตอลบรัมย์	6	1	2552	4/33 ม.6 แขวงสายไหม 	สวนหลวง	กรุงเทพฯ			1						1							3
7	2547		บจ.	วิจิตรประกอบ	7	1	2552	25 ซ.อ่อนนุช 10 ถ.อ่อนนุช แขวงสวนหลวง	ลาดพร้าว	กรุงเทพฯ		02-2743222-3	3		3											3
8	2547		หจก.	สตาร์แปซิฟิคทรานสปอร์ต	26	1	2552	41/9 ม.9 ถ.วิภาวดีรังสิต แขวงสีกัน 	บึงกุ่ม	กรุงเทพฯ			21		1					19	1					3
9	2547		นาย	สมนึก ผลดีนานา	12	1	2552	43 ซ.บรมราชชนนี 14 ถ.บรมราชชนนี แขวงบางบำหรุ 	บางพลัด	กรุงเทพฯ			1							1						3
10	2547		บจ.	สวัสดิภาพทัวร์	13	1	2552	44/73 ม.7 แขวงลาดพร้าว 	บางกะปิ	กรุงเทพฯ			2											2		3
11	2547		นาย	สุชาติ ภรมงคลธรรม	13	1	2552	52/4 ม.13 ถ.กรุงเทพกรีฑา แขวงสะพานสูง	บางกะปิ	กรุงเทพฯ			1											1		3
12	2547		นาย	เสวกทัวร์	13	1	2552	55 ม.9 ซ.ปรีชา แขวงฉิมพลี	ธนบุรี	กรุงเทพฯ			1							1						3
13	2547		หจก.	ไสว วรรณรังสี	24	1	2552	55/4 ม.3 ซ.ประชาอุทิศ 76 ถ.ประชาอุทิศ แขวงทุ่งครุ	กรุงเทพฯ			10							10						3
</textarea>
</td></tr></table>
<table style="background-color:black;border-spacing:5px;text-align:center;width:760px;margin-left:auto;margin-right:auto;"><tr>
<td bgcolor="white" align="center"><input type="submit" value="listall" name="action" style="width:60px;background-color:#ffdddd;">
เริ่ม <input name="begin" value="0" size="1">
จำนวน <input name="total" value="100" size="2">
</td>
<td style="background-color:white;text-align:center;">
<input type="submit" value="findname" name="action"><input name="name" value="หจก." size="3" style="width:60px;background-color:#ffddff;">
</td>
<td style="background-color:white;text-align:center;">
<input type="submit" value="deleterecord" name="action" style="width:100px;background-color:#ddddff;">
<input name="did" value="1" size="1"><input name="dyear" value="2547" size="4">
</td>
<td style="background-color:white;text-align:center;">
<input type="submit" value="deletetable" name="action" style="width:100px;background-color:red;color:white;">
</td></tr>
<?php } ?>
</table>
</form>

<!-- Section 3 : Activity -->
<table style="background-color:gray;width:760px;margin-left:auto;margin-right:auto;">
<tr><td style="background-color:white;">
<?php
### Start of 10 Activity ###
if (isset($_POST{'action'})) {
###########################
# 1 # create table InnoDB
###########################
if ($_POST{'action'} == "Create table InnoDB") {
	$query = "CREATE TABLE $tb (";
	for ($i=1;$i<=26;$i++) $query = $query . "f" . $i . " CHAR(100),";
	$query .= "f27 CHAR(100)";
	$query .= ") ENGINE = InnoDB DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci;";
	echo $query."<br/>";
	if ($connect->query($query) === TRUE) echo "process : completely<br/>"; else { echo "error to create table<br/>"; exit; }
	echo "<meta http-equiv='refresh' content=\"3;URL='mysqlworking.php'\" />";
	exit;
}
###########################
# 2 # create table MyISAM
###########################
if ($_POST{'action'} == "Create table MyISAM") {
	$query = "CREATE TABLE $tb (";
	for ($i=1;$i<=26;$i++) $query = $query . "f" . $i . " CHAR(100),";
	$query .= "f27 CHAR(100)";
	$query .= ")  ENGINE = MyISAM DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci;";
	echo $query."<br/>";
	if ($connect->query($query) === TRUE) echo "process : completely<br/>"; else { echo "error to create table<br/>"; exit; }
	echo "<meta http-equiv='refresh' content=\"3;URL='mysqlworking.php'\" />";
	exit;
}
###########################
# 3 # delete table
###########################
if ($_POST{'action'} == "deletetable") {
	$query = "drop table $tb;";
	if ($connect->query($query) === TRUE) echo "process : completely<br/>"; else { echo "table remove : error<br/>$query"; exit; }
	echo "<meta http-equiv='refresh' content=\"3;URL='mysqlworking.php'\" />";    
	exit;
}
###########################
# 4 # search from keyword
###########################
if ($_POST{'action'} == "findname") {
	if(strlen($_POST{'name'}) > 1) {
		# SQL Injection Protection
		$unsafe = $_POST['name'];
		$safe_step1 = $connect->real_escape_string($unsafe); // for ' or 1=1 or ' 		
		$unwanted_word = array("'", "or", ";","=","_"); 
		$removebyblank = '';
		$safe_step2 = str_replace($unwanted_word, $removebyblank, $safe_step1);		
		# ส่วนนี้มีความอ่อนแอ (vulnerability) ที่ยังไม่ได้รับการป้องกัน
		# ถูกโจมตีได้ด้วย SQL Injection for test ' or 1=1 or ' หรือ ___  
		# การค้นหานี้ใช้ % เพื่อใช้ค้นหาจากคำขึ้นต้น แล้วต่อท้ายด้วยอะไรก็ได้ คล้ายกับ * ใน DOS เช่น dir AN*.lnk จะพบ ANT.lnk และ AND.lnk
		# การค้นด้วย _ ใน like หมายถึงตัวอักษรอะไรก็ได้ คล้ายกับ ? ใน DOS เช่น dir AN?.lnk จะพบ ANT.lnk
		if(!$protect_sql_injection) {
			$query    = "select * from $tb where f4 like '". $_POST{'name'} ."%'"; 
		} else {
			$query    = "select * from $tb where f4 like '". $safe_step2 ."%'";
		}
		if(!$protect_sql_injection || $safe_step1 == $safe_step2) {
			$result = $connect->query($query); 
			if ($result === FALSE) { echo "Finding : error<br/>$query"; exit;}
			while ($object = $result->fetch_object()) {
				foreach ($object as $o) echo $o . " ";
				# sample : echo $object->f26 . "  " . $object->f27;
				echo '<hr color=gray />';
			} 
		} else {
			echo '<b>Error</b> : found unwanted character';
		}			
	} else {
		echo '<b>Error</b> : Keyword required > 1 character';
	}
}
###########################
# 5 # delete record
###########################
if ($_POST{'action'} == "deleterecord") {
	$query    = "delete from $tb where f1 = '". $_POST{'did'}."' and f2 = '". $_POST{'dyear'}."'";
	$result = $connect->query($query); 
	$cnt_result = $connect->affected_rows;
	if ($result === TRUE) echo "delete : ". $cnt_result ." records<br/>"; else { echo "delete : error<br/>$query"; }
}
###########################
# 6 # list all records
###########################
if ($_POST{'action'} == "listall") {
	$query    = "select * from $tb limit " . $_POST{'begin'}  . "," . $_POST{'total'} ;
	$result = $connect->query($query); 
	if ($result === FALSE) { echo "listing : error<br/>$query"; exit;}
	echo "<ol start=" . ($_POST{'begin'} + 1) . ">";
	while ($object = $result->fetch_object()) {
		echo "<li>";
		foreach ($object as $o) echo "$o ";
	}
	echo "</ol>";
}
###########################
# 7 # post records
###########################
if ($_POST{'action'} == "postmany") {
	$getline = explode("\r\n",$_POST{'manyrecord'});
	for ($j=0;$j<count($getline);$j++) {
		$l = $j + 1;
		$getfield = explode("\t",$getline[$j]);   
		# echo "$l $getfield[0] - $getfield[26]<br/>";
	}
	if ($connect) {
		echo "post from textarea : completely<br/>";
		for ($j=0;$j<count($getline);$j++) {
			if (strlen($getline[$j]) > 1) {
				$l = $j + 1;
				$getfield = explode("\t",$getline[$j]);      
				$query = "insert into $tb values(";
				for ($i=0;$i<=25;$i++) $query = $query . "'$getfield[$i]',";
				$query = $query . "'$getfield[26]'";
				$query = $query . ");";
				echo $query."<br/>";
				$result = $connect->query($query);
			}
		}  
	} else {
		echo "connect : fail"; 
	}
}
###########################
# 8 # post 1000
###########################
if ($_POST{'action'} == "post 1000") {
	if ($connect) {
		echo "Post 1000 : completely";
		for ($j=0;$j<1000;$j++) {
			if(!function_exists("iconv")) {
				$c1 = chr(rand(65,91));
				$c2 = chr(rand(65,91));
				$c3 = chr(rand(65,91));
			} else { //phpversion()
				$c1 = iconv("TIS-620","UTF-8",chr(rand(161,206))); // 196 = ฤ ทำให้มี 45 ตัว
				$c2 = iconv("TIS-620","UTF-8",chr(rand(161,206)));
				$c3 = iconv("TIS-620","UTF-8",chr(rand(161,206)));
			}
			// https://www.ireallyhost.com/kb/other/173
			$query = "insert into $tb (f1,f2,f4) values( $j , $j, '" . $c1.$c2.$c3 . "');";
			// insert into $tb (f4) values('" . chr(161) . "') ภาษาไทยมีปัญหา แบบนี้ใช้ไม่ได้ใน MySQL เพราะไม่เป็น UTF8
			$result = $connect->query($query);
		}
	} else {
		echo "connect : fail"; 
	}
}
// echo iconv("TIS-620","UTF-8",chr(161)); // output = ก
// echo ord(iconv("UTF-8","TIS-620","ก")); // output = 161
###########################
# 9 # post_recs
###########################
if ($_POST{'action'} == "post_recs") {
	if ($connect) {
		echo "Post " . $_POST{'recs'} ." : completely";
		// echo "iconv:" . function_exists("iconv"); // 000webhosting.com จะ return 1 กลับมา
		for ($j=0;$j<$_POST{'recs'};$j++) {
			if(!function_exists("iconv")) { // ป้องกันการเรียกใช้ iconv ที่ 5GBFree.com
				$c1 = chr(rand(65,91));
				$c2 = chr(rand(65,91));
				$c3 = chr(rand(65,91));
			} else {
				$c1 = iconv("TIS-620","UTF-8",chr(rand(65,91))); // ที่ 5GBFree.com หากเรียกใช้ iconv จะหยุดการทำงาน
				$c2 = iconv("TIS-620","UTF-8",chr(rand(65,91))); // ตรวจสอบการ support ของ iconv ด้วย phpinfo() ได้
				$c3 = iconv("TIS-620","UTF-8",chr(rand(65,91)));
			}
			$query = "insert into $tb (f1,f2, f4) values( $j , $j, '" . $c1.$c2.$c3 . "');";
			$result = $connect->query($query);
		}  
	} else {
		echo "connect : fail"; 
	}
}
###########################
# 10 # Total records
###########################
$query = "select * from $tb";
$result = $connect->query($query);
echo "<hr style='display:block;height:1px;border:0;border-top:1px solid#ccc;margin:1em0;padding:0;' />
Total records : ". $result->num_rows;
mysqli_free_result($result);
$connect->close();

### Stop of 10 Activity ###
} // end of isset : action from post
?>
</td></tr></table>

<!-- Section 4 : Introduction -->
<table style="margin-left:auto;margin-right:auto;width:760px;border-width:5px;border-style:solid;">
<tr><td style="background-color:#ddffdd;">
<fieldset><legend><b>Suggestion about this script</b></legend>
<ol>
<li>กำหนดชื่อฐานข้อมูลให้กับตัวแปร <font color="red">$db</font> ให้ตรงกับที่มีในระบบฐานข้อมูล MySQL หรือ MariaDB
<br/>ที่กำหนดไว้คือ [mysql] เพราะเป็น Default database  ถ้าใช้งานจริงก็ต้องสร้าง database ของตนเอง</li>
<li>เปลี่ยนค่าของตัวแปร <font color="red">$user และ $password</font> ให้ตรงกับรหัสผู้ใช้ที่เข้าใช้งาน MySQL ได้</li>
<li>กดปุ่ม Create table เพื่อสร้างตารางชื่อ car ในฐานข้อมูล [mysql]</li>
<li>หลังสร้างตารางแล้ว ก็กดปุ่ม postmany เพื่อสร้างข้อมูล จะได้มีข้อมูลไว้ใช้ทดสอบ</li>
<li>ถ้าทดสอบการใช้งานด้วยค่า default ได้แล้ว ก็ควรสร้าง database, table ขึ้นมาใช้งานเอง</li>
<li>ปกติจะกำหนด max time ที่ 30 seconds ใน code จะขยายเวลาเป็น 24 ชั่วโมง รองรับ insert 1000</li>
<li>ถ้ามีปัญหาภาษาไทยต้องใช้ Editor ปรับ file encoding = UTF-8</li>
<li>ถ้าไม่กำหนด Engine ให้ DB จะสร้างเป็น InnoDB ซึ่ง insert record จะตอบสนองช้าเมื่อเทียบกับ MyISAM</li>
<?php if($phpinfo_function_allow) { ?>
<li>เรียกใช้ <a href="?action=phpinfo">phpinfo()</a> เพื่อดูค่าต่าง ๆ ของ server เช่น version ของ php หรือ mysql
<?php } ?>
</ol>
</fieldset>
</td></tr>
<tr><td style="background-color:white;">
<?php
$demo = array("http://thaiabc.ueuo.com/",
"http://thaiabc.000webhostapp.com/mysqlworking.php",
"http://thaiabc.5gbfree.com/mysqlworking.php",
"http://thaiabc.byethost22.com/mysqlworking.php",
"http://thaiabc.atwebpages.com/mysqlworking.php");
for($demo_no=0;$demo_no<count($demo);$demo_no++) {
	echo "<b>Demo site</b> : <a href='$demo[$demo_no]'>$demo[$demo_no]</a><br/>";
}
list($u_start,$s_start) = explode(" ",$start);  
list($u_stop,$s_stop) = explode(" ",microtime());  
$tstart = $u_start + $s_start;
$tstop = $u_stop + $s_stop;
echo "Page loading in " . ($tstop - $tstart) . " seconds";
?>
</td></tr></table>
</body></html>
