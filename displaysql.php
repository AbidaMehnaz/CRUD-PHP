<?php $results = mysqli_query($db, "SELECT * FROM students"); ?>
<table>
	<thead>
		<tr>
			<th>Matric</th>
			<th>First name</th>
      	<th>Last name</th>
        <th>Date of birth </th>
        <th>Faculty </th>
        <th>Department</th>
			<th colspan="2">Action</th>
		</tr>
	</thead>

	<?php while ($row = mysqli_fetch_array($results)) { ?>
		<tr>
			<td><?php echo $row['matric']; ?></td>
			<td><?php echo $row['fname']; ?></td>
      <td><?php echo $row['lname']; ?></td>
      <td><?php echo $row['dob']; ?></td>
      <td><?php echo $row['faculty']; ?></td>
      <td><?php echo $row['department']; ?></td>
     <td>
				<a href="index.php?edit=<?php echo $row['id']; ?>" class="edit_btn" >Edit</a>
			</td>
			<td>
				<a href="server.php?del=<?php echo $row['id']; ?>" class="del_btn">Delete</a>
			</td>
		</tr>
	<?php } ?>
</table>
