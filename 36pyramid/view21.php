<pre style="font-family:'courier new';font-size:20px;">
<body background ="back.jpg" topmargin="200px">
<table border="10"  align="center" background ="back.jpg">
	<tr>
	<td>
	<fieldset><legend><font size=5><font color="#FFFFFF">พีระมิดที่ 21</legend>
<?php
for($row=1;$row<=5;$row++) {
	for($col=$row;$col<=7;$col++){
		echo("*");
	}
	
	echo($row);

	for($col=1;$col<=$row;$col++){
		echo("*");
	}

	for($col=$row;$col<=$row;$col++){
		echo(8-$row);
	}

	echo "<br/>";
}
?>
	</fieldset>
	</td>
	</tr>
</body>