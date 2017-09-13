<pre style="font-family:'courier new';font-size:20px;">
<body background ="back.jpg" topmargin="200px">
<table border="10"  align="center" background ="back.jpg">
	<tr>
	<td>
	<fieldset><legend><font size=5><font color="#FFFFFF">พีระมิดที่ 8</legend>
<?php
for($i=1;$i<=7;$i++)
{
	for($j=2;$j<=$i;$j++)
	{
	echo"&nbsp";
	}
	for($j=$i;$j<=$i;$j++)
	{
	echo $i;
	echo $i+1;
	echo $i+2;
	}
	for($j=1;$j<=($i+1);$j++)
	{
	echo "*";
	}
	echo "<br>";
}
?>
	</fieldset>
	</td>
	</tr>
</body>