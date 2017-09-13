<pre style="font-family:'courier new';font-size:20px;">
<body background ="back.jpg" topmargin="200px">
<table border="10"  align="center" background ="back.jpg">
	<tr>
	<td>
	<fieldset><legend><font size=5><font color="#FFFFFF">พีระมิดที่ 33</legend>
<?php
for($row=1;$row<=3;$row++) {
	for($col=-1;$col<=3-$row;$col++) {
		
		echo("&nbsp");
	}

	for($col=1;$col<=$row;$col++){

		echo("*");
	}

	for($col=2;$col<=$row;$col++){

		echo("*");
	}

	for($col=1;$col<=3-$row;$col++) {
		
		echo("&nbsp");
	}

	echo "<br/>";
}

for($row=2;$row>=1;$row--) {
	for($col=-1;$col<=3-$row;$col++) {
		echo("&nbsp");
	}
	
	for($col=1;$col<=$row;$col++){
		echo("*");
	}
	
	for($col=2;$col<=$row;$col++){
		echo("*");
	}

	for($col=1;$col<=3-$row;$col++) {
		echo("&nbsp");
	}

	echo "<br/>";
}

?>
	</fieldset>
	</td>
	</tr>
</body>