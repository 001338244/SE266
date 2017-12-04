<?php
/**
 * Function to establish a database connection
 * 
 * @return PDO Object
 */  
function getDatabase() {
    $dbname="se266_morgan"; 
    $username="se266_morgan";
    $pwd="1386564"; // your student id WITHOUT the zeroes
    
    if (isset($_SERVER['SERVER_NAME']) && $_SERVER['SERVER_NAME'] == 'ict.neit.edu') {
        $config = array(
        'DB_DNS' => "mysql:host=localhost;port=5500;dbname=$dbname;",
        'DB_USER' => $username,
        'DB_PASSWORD' => $pwd
    );
    } else { //local
        $config = array(
            'DB_DNS' => "mysql:host=localhost;port=3306;dbname=$dbname;",
            'DB_USER' => $username,
            'DB_PASSWORD' => $pwd
        );
    }
    

    try {
        /* Create a Database connection and 
         * save it into the variable */
        $db = new PDO($config['DB_DNS'], $config['DB_USER'], $config['DB_PASSWORD']);
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    } catch (Exception $ex) {
        /* If the connection fails we will close the 
         * connection by setting the variable to null */
        $db = null;
    }

    return $db;
}




