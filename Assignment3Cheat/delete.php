<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Deleted</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    </head>
    <body>
        <?php
            
        include_once './dbconnect.php';
        
		// Get ID and Delete Row. ##
        $id = filter_input(INPUT_GET, 'id');
        
        $db = getDatabase();
           
        $stmt = $db->prepare("DELETE FROM corps where id = :id");
           
        $binds = array(
             ":id" => $id
        );
           
        $isDeleted = false;
        if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
            $isDeleted = true;
        }         
        
        ?>
        
		<!-- Back to view page -->
		<a href="<?php echo filter_input(INPUT_SERVER, 'HTTP_REFERER'); ?>" class="btn btn-danger"> Go back </a>
		
        <h1 class="bg-success"> Record <?php echo $id; ?>  
            <?php if ( !$isDeleted ): ?>Not<?php endif; ?> 
            Deleted
        </h1>
    </body>
</html>
