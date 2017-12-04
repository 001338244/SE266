<?php
/**
 * Created by PhpStorm.
 * User: 001338244
 * Date: 10/16/2017
 * Time: 1:15 PM
 */
?>
<form method="post" action="#">
    Name: <input type="text" name="name" value="<?php echo $dog['name']; ?>" /><br />
    Gender: M <input type="radio" name="gender" value="M" checked='checked' />
    F <input type="radio" name="gender" value="M" /><br />
    Fixed: <input type="checkbox" name="fixed" value="true" /><br />
    <input type="submit" name="action" value="<?php echo $button; ?>" />
</form>
