<pre style="font-family:'courier new';font-size:20px;">
<body background ="back.jpg" topmargin="200px">
<table border="10"  align="center" background ="back.jpg">
	<tr>
	<td>
	<fieldset><legend><font size=5><font color="#FFFFFF">พีระมิดที่ 5</legend>
<?php
for($row=1;$row<=4;$row++){
	for($col=1;$col<=4-$row;$col++){
	echo("&nbsp");
	}
	echo($row);
	for($col=2;$col<=$row;$col++){
	echo("**");
	}
    echo($row);
	echo "<br/>";
}
for($row=3;$row>=1;$row--){
	for($col=1;$col<=4-$row;$col++){
	echo("&nbsp");
	}
	echo($row);
	for($col=2;$col<=$row;$col++){
	echo("**");
	}
    echo($row);
	echo "<br/>";
}
?>
	</fieldset>
	</td>
	</tr>
</body>