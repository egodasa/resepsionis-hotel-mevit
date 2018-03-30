{{ $header }}
<table class="table table-bordered table-striped dataTable">
	<tr>
		<?php
		foreach($data['fields'] as $r){
			echo "<th>".$r['title']."</th>";
		}
		?>
	</tr>
		<?php
		foreach($data['data'] as $d){
			echo "<tr>";
			foreach($data['fields'] as $r){
				echo "<td>".$d->{$r['name']}."</td>";
			}
			echo "</tr>";
		}
		?>
</table>
{{ $footer }}
