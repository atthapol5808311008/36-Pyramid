<pre style="font-family:'courier new';font-size:20px;">
<body background ="back.jpg" topmargin="200px">
<table border="10"  align="center" background ="back.jpg">
	<tr>
	<td>
	<fieldset><legend><font size=5><font color="#FFFFFF">พีระมิดที่ 7</legend>
<?php
		$totalRow = 7;
for($row=1; $row <= $totalRow; $row++) {
	for($col=1;$col <= $totalRow - $row + 1 ; $col++) {echo "&nbsp"; }
	for($col=1; $col <=$row ; $col++) {echo $col ; }
	echo$row ;
	for($col=$row; $col >= 1 ; $col--) { echo $col ; }
	echo "<br>";
}
?>
	</fieldset>
	</td>
	</tr>
</body>