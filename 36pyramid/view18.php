<pre style="font-family:'courier new';font-size:20px;">
<body background ="back.jpg" topmargin="200px">
<table border="10"  align="center" background ="back.jpg">
	<tr>
	<td>
	<fieldset><legend><font size=5><font color="#FFFFFF">พีระมิดที่ 18</legend>
<?php
	for($i=1; $i<=5; $i++) {
		echo $i;
		for($j=1; $j<=$i; $j++) {
			echo "*";
		}
		echo $i;
		for($k=5; $k>=$i; $k--) {
				echo "*";
		}
		for($l=1; $l<=1; $l++) {
			echo 10-$i;
		}
		echo "<br>";
	}
?>
	</fieldset>
	</td>
	</tr>
</body>