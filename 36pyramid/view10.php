<pre style="font-family:'courier new';font-size:20px;">
<body background ="back.jpg" topmargin="200px">
<table border="10"  align="center" background ="back.jpg">
	<tr>
	<td>
	<fieldset><legend><font size=5><font color="#FFFFFF">พีระมิดที่ 11</legend>
<?php
for($row=1;$row<=5;$row++) {
	for($col=1;$col<=5-$row;$col++) {
	echo("&nbsp");
	}
	for($col=1;$col<=$row;$col++){
		echo($col);
	}
	for($col=$row;$col<=$row;$col++){
		echo(6-$row);
	}
	for($col=$row;$col>=1;$col--){
		echo($col);
	}
	echo "<br/>";
}
?>
	</font></fieldset>
	</td>
	</tr>
</body>