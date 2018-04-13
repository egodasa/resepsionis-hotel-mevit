<style>
body{
	font-family: Arial;
}
table {
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
}
th {
	background-color: #f0f0f0;
	padding: 13px 5px;
}
td{
	padding: 3px;
}
h1{
	text-align: center;
}
</style>
<h1>HOTEL MEVIT</h1>
<table>
	<tr>
		<th>No</th>
		<?php
		foreach($fields as $r){
			echo "<th>".$r['title']."</th>";
		}
		?>
	</tr>
	<?php
	$x=1;
	$total = 0;
	foreach($data as $d){
		echo "<tr>";
		echo "<td>$x</td>";
				foreach($fields as $r){
					echo "<td> ".$d->{$r['name']}."</td>";
				}
		echo "</tr>";
		$x++;
		$total += $d->total_harga;
	}
	?>
	<tr>
		<td colspan="<?php echo count($fields); ?>">Total</td>
		<td><?php echo $total; ?></td>
	</tr>
</table>
