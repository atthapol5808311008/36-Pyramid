<pre style="font-family:'courier new';font-size:20px;">
<body background ="back.jpg" topmargin="200px">
<table border="10"  align="center" background ="back.jpg">
	<tr>
	<td>
	<fieldset><legend><font size=5><font color="#FFFFFF">พีระมิดที่ 6</legend>
<?php
for ($row=0;$row<=6 ;$row++ )
{
	for ($col=1;$col<=$row;$col++ ){
		echo "&nbsp";
	}
		for ($col=1;$col<15-($row*2)-1 ;$col++ ) {
			echo $col%2;
		}
			echo"<br>";
}
?>
	</fieldset>
	</td>
	</tr>
</body>