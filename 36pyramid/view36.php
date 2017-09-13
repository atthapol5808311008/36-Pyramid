<pre style="font-family:'courier new';font-size:20px;">
<body background ="back.jpg" topmargin="200px">
<table border="10"  align="center" background ="back.jpg">
	<tr>
	<td>
	<fieldset><legend><font size=5><font color="#FFFFFF">พีระมิดที่ 36</legend>
<?php
	$a=1; $b=1; $c=1;
	for($i=1; $i<=3; $i++) {
		for($j=$a; $j<=3; $j++) {
			echo $j;
		}
		$a++;
		for($k=1; $k<=$b; $k++) {
			echo "*";
		}
		$b+=2;
		for($l=3; $l>=$c; $l--) {
			echo $l;
		}
		$c++;
		echo "</br>";
	}

	for ($u=2;$u<=3;$u++) {
		echo $u;
	}
	for ($s=1;$s<=3;$s++) {
		echo "*";
	}
	for ($w=3;$w>=2;$w--) {
		echo $w;
	}
	echo "<br>";
	for ($e=1;$e<=3;$e++) {
		echo $e;
	}
	for ($s=1;$s<=1;$s++) {
		echo "*";
	}
	for ($w=3;$w>=1;$w--) {
		echo $w;
	}
?>
	</fieldset>
	</td>
	</tr>
</body>