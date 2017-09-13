<pre style="font-family:'courier new';font-size:20px;">
<body background ="back.jpg" topmargin="200px">
<table border="10"  align="center" background ="back.jpg">
	<tr>
	<td>
	<fieldset><legend><font size=5><font color="#FFFFFF">พีระมิดที่ 13</legend>
<?php
for($row=1;$row<=5;$row++) {
	for($col=2;$col<=$row;$col++) {
	echo("&nbsp&nbsp");
	}
	for($col=11;$col>=11;$col--){
		echo($col-$row-$row);
	}
	for($col=10;$col>=6+$row;$col--){
		echo($col-$row-$row);
	}

	for($col=5;$col>=1+$row;$col--){
		echo($col-$row);
	}

	echo "<br/>";
}
?>
	</fieldset>
	</td>
	</tr>
</body>