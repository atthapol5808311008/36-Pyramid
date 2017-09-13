<pre style="font-family:'courier new';font-size:20px;">
<body background ="back.jpg" topmargin="200px">
<table border="10"  align="center" background ="back.jpg">
	<tr>
	<td>
	<fieldset><legend><font size=5><font color="#FFFFFF">พีระมิดที่ 29</legend>
<?php
for($row=1;$row<=5;$row++) {

	echo($row);

	echo("*");

	echo(2+$row);

	for($col=1;$col<=2+$row;$col++) {
		echo("*");
	}

	echo "<br/>";
}
?>
	</fieldset>
	</td>
	</tr>
</body>