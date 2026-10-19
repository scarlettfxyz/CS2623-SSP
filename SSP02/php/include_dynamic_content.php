<?php
// Start the weekly planner table.
?>
<table id="weekly-planner">
	<caption>CS2623 Weekly Planner — Scarlett Fountain</caption>
	<thead>
		<!-- Identify the three columns in the planner. -->
		<tr>
			<th scope="col">Day of Week</th>
			<th scope="col">Task</th>
			<th scope="col">Time (hrs.)</th>
		</tr>
	</thead>
	<tbody>
		<?php
		// Generate planner rows for days 1 through 7.
		for ($counter = 1; $counter < 8; $counter += 1) {
			echo '<tr>';
			echo '<td>' . htmlspecialchars((string) $counter, ENT_QUOTES, 'UTF-8') . '</td>';
			echo '<td>' . htmlspecialchars('Study for CS2623', ENT_QUOTES, 'UTF-8') . '</td>';
			echo '<td>' . htmlspecialchars(number_format($counter / 2, 1), ENT_QUOTES, 'UTF-8') . '</td>';
			echo '</tr>';
		}
		?>
	</tbody>
</table>
