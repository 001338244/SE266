<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Add A Record</title>
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
        
		// When Submit is pressed the text fields are inserted in to the database. ##
        if ( isPostRequest() ) {
            $corp = filter_input(INPUT_POST, 'n_corp');
            $incorp_dt = date("Y-m-d H:i:s");
			$email = filter_input(INPUT_POST, 'n_email');
			$zipcode = filter_input(INPUT_POST, 'n_zipcode');
			$owner = filter_input(INPUT_POST, 'n_owner');
			$phone = filter_input(INPUT_POST, 'n_phone');
                                   
            $stmt = $db->prepare("INSERT INTO corps SET corp = :corp, incorp_dt = :incorp_dt, email = :email, zipcode = :zipcode, owner = :owner, phone = :phone");
            
            $binds = array(
                ":corp" => $corp,
                ":incorp_dt" => $incorp_dt,
				":email" => $email,
				":zipcode" => $zipcode,
				":owner" => $owner,
				":phone" => $phone
            );
            
            $message = 'Record failed';
            if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
               $message = 'Added A Record!';
            }
        }
        ?>
        
		<!-- Form and text fields -->
        <form method="post" action="#">
			<h4>
            Corporation: <br /><input type="text" class="input-sm" name="n_corp" style="font-size:14pt;height:30px;width:500px;" value="<?php echo $corp ?>" />
            <br /><br />
            Email: <br /><input type="text" class="input-sm" name="n_email" style="font-size:14pt;height:30px;width:500px;" value="<?php echo $email ?>" />
            <br /><br />
			Zip Code: <br /><input type="text" class="input-sm" name="n_zipcode" style="font-size:14pt;height:30px;width:500px;" value="<?php echo $zipcode ?>" />
            <br /><br />
			Owner: <br /><input type="text" class="input-sm" name="n_owner" style="font-size:14pt;height:30px;width:500px;" value="<?php echo $owner ?>" />
            <br /><br />
			Phone: <br /><input type="text" class="input-sm" name="n_phone" style="font-size:14pt;height:30px;width:500px;" value="<?php echo $phone ?>" />
            <br /><br />
            <input type="hidden" name="i-d" value="<?php echo $id ?>" />
            <input type="submit" class="btn btn-success" value="Add" />
			</h4>
        </form>

		<!-- Back to view page -->
        <a href="view.php" class="btn btn-danger"> Go back </a>
        
        <h3 class="bg-success">
            <?php if ( isset($message) ) { echo $message; } ?>
        </h3>
    </body>
</html>
