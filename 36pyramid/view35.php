<pre style="font-family:'courier new';font-size:20px;">
<body background ="back.jpg" topmargin="200px">
<table border="10"  align="center" background ="back.jpg">
	<tr>
	<td>
	<fieldset><legend><font size=5><font color="#FFFFFF">พีระมิดที่ 35</legend>
<?php
   $n=1; $m=2;
   for($i=1; $i<=5; $i++) {
   		echo "&nbsp&nbsp&nbsp".$i."*";
   		for($j=1; $j<=1; $j++) {
   			echo $n."*".$m;
   		}

   		$n=$n+2;
   		$m=$m+2;
   		echo "<br>";
   }
?>
	</fieldset>
	</td>
	</tr>
</body>