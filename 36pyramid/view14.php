<pre style="font-family:'courier new';font-size:20px;">
<body background ="back.jpg" topmargin="200px">
<table border="10"  align="center" background ="back.jpg">
	<tr>
	<td>
	<fieldset><legend><font size=5><font color="#FFFFFF">พีระมิดที่ 14</legend>
<?php
for($row=1;$row<=5;$row++) {
	for($col=2;$col<=0+$row;$col++) {
		echo("&nbsp");
	}
	
	for($col=$row;$col<=$row;$col++) {
		echo($row);
	}
	
	echo($row+1);

	for($col=1;$col<=5-$row;$col++){
		echo("&nbsp&nbsp");
	}
	
	for($col=$row;$col<=$row;$col++) {
		echo($row+1);
	}
	
	echo($row);
	
	echo "<br/>";
}
?>
	</fieldset>
	</td>
	</tr>
</body>