<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>View All</title>
        
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

        
        
    </head>
    <body>
        <?php
        
           include_once './dbconnect.php';
            
           $db = getDatabase();
           
           $stmt = $db->prepare("SELECT * FROM corps");
           
            $results = array();
            if ($stmt->execute() && $stmt->rowCount() > 0) {
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            
        ?>
		
        <table border="1" class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Corporation</th>
                    <th>incorp_dt</th>
                    <th>Email Address</th>
					<th>Zip Code</th>
					<th>Owner</th>
					<th>Phone Number</th>
					<th>Read</th>
                    <th>Update</th>
					<th>Delete</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($results as $row): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['corp']; ?></td>
                    <td><?php echo $row['incorp_dt']; ?></td>
					<td><?php echo $row['email']; ?></td>
					<td><?php echo $row['zipcode']; ?></td>
					<td><?php echo $row['owner']; ?></td>
					<td><?php echo $row['phone']; ?></td>
					<td><a class="btn btn-primary" href="read.php?id=<?php echo $row['id']; ?>">Read</a></td>
                    <td><a class="btn btn-warning" href="update.php?id=<?php echo $row['id']; ?>">Update</a></td>
                    <td><a class="btn btn-danger" href="delete.php?id=<?php echo $row['id']; ?>">Delete</a></td>
                </tr>
            <?php endforeach; ?>
			<tr>
				<td><a class="btn btn-success" href="add.php?id=<?php echo $row['id']; ?>">Add</a></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
            </tbody>
        </table>
           
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  
    </body>
</html>
