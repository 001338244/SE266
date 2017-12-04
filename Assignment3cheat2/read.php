<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Read</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    </head>
    <body>
        <?php
        
        include_once './dbconnect.php';
        include_once './functions.php';
        
        $db = getDatabase();
        
        $corp = '';
        $incorp_dt = '';
		$email = '';
		$zipcode = '';
		$owner = '';
		$phone = '';

		// Grab ID number from URL. ##
		$id = filter_input(INPUT_GET, 'id');
		
        $stmt = $db->prepare("SELECT * FROM corps where id = :id");

        $binds = array(
             ":id" => $id
        );
		
		// Grab data from the database. ##
        $result = array();
        if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $corp = $result['corp'];
            $incorp_dt = $result['incorp_dt'];
			$email = $result['email'];
			$zipcode = $result['zipcode'];
			$owner = $result['owner'];
			$phone = $result['phone'];
			
			// Convert date to (mm/dd/yyyy);
			$incorp_dt = date("m-d-Y", strtotime($incorp_dt));
        } else {
            header('Location: view.php');
            die('ID not found');
        }
        
        
        ?>
		
        <!-- Form and text fields display only data. Text Fields are disabled and connect make changes. Read only -->
        <form method="post" action="#">
			<h4>
            Corporation: <br /><input type="text" class="input-sm" name="n_corp" style="font-size:14pt;height:30px;width:500px;" value="<?php echo $corp ?>" disabled="disabled"/>
            <br /><br />
            Date: <br /><input type="text" class="input-sm" name="n_incorp_dt" style="font-size:14pt;height:30px;width:500px;" value="<?php echo $incorp_dt ?>" disabled="disabled"/>
            <br /><br />
			Email: <br /><input type="text" class="input-sm" name="n_email" style="font-size:14pt;height:30px;width:500px;" value="<?php echo $email ?>" disabled="disabled"/>
            <br /><br />
			Zip Code: <br /><input type="text" class="input-sm" name="n_zipcode" style="font-size:14pt;height:30px;width:500px;" value="<?php echo $zipcode ?>" disabled="disabled"/>
            <br /><br />
			Owner: <br /><input type="text" class="input-sm" name="n_owner" style="font-size:14pt;height:30px;width:500px;" value="<?php echo $owner ?>" disabled="disabled"/>
            <br /><br />
			Phone: <br /><input type="text" class="input-sm" name="n_phone" style="font-size:14pt;height:30px;width:500px;" value="<?php echo $phone ?>" disabled="disabled"/>
            <br /><br />
            <input type="hidden" name="i-d" value="<?php echo $id ?>" />
			</h4>
        </form>
		
		<!-- Back to view page -->
        <a href="view.php" class="btn btn-danger">Go back</a>
		
        <h3 class="bg-danger">
            <?php if ( isset($message) ) { echo $message; } ?>
        </h3>
    </body>
</html>
