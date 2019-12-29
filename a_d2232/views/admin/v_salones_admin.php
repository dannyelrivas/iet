<div class="row">
	<meta charset="UTF-8">
	<div class="col-md-6">
		<table>
			<thead>
				<tr>
					<th style="width:10%">Nombre </th>
					<th style="width:10%">Apellido Paterno </th>
					<th style="width:10%">Apellido Materno </th>
					<th style="width:10%">Nivel </th>
					<th style="width:10%">Grado </th>
					<th style="width:10%">Grupo </th>
					<th style="width:10%">Salon </th>
				</tr>
			</thead>
			<tbody id="ajuste">
			<?php
				$dbhost	= "localhost";	   // localhost or IP
				$dbuser	= "edufycom_iet";		  // database username
				$dbpass	= "iet2019";		     // database password
				$dbname	= "edufycom_iet";    // database name
				
				$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
				if (!$conn) {
					die("Connection failed: " . mysqli_connect_error());
				}
				$query = "SELECT * FROM alumnos";
				$result = mysqli_query($conn, $query);
				while($row = mysqli_fetch_assoc($result)){		
					echo "<tr>
							<td id=tablanumero value=$row[id]>$row[nombre]</td>
							<td>$row[apaterno]</td>
							<td>$row[amaterno]</td>
							<td>$row[nivel]</td>
							<td>$row[grado]</td>
							<td>$row[grupo]</td>
							<td>$row[salon]</td>
						</tr>";
					}
			?>
			</tbody>
		</table>
	</div>
</div>