<?php
include './bootstrap.php';



 $dbConfig = array(
    "DB_DNS"=>'mysql:host=localhost;port=3306;dbname=PHPadvClassSpring2015',
    "DB_USER"=>'root',
    "DB_PASSWORD"=>''
    );
    $pdo = new DB($dbConfig);
    $db = $pdo->getDB();
    
    $model = new EmailTypeModel();
    $DAO = new EmailTypeDAO($db);
    
    // get values from URL
    $emailTypeDAO = filter_input(INPUT_GET, 'id');
    
    $DAO->delete($model->getEmailTypeid());
    if ( NULL !== $emailTypeDAO ) {
        

        if ( $DAO->delete($emailTypeDAO) ) {
            echo 'Email Type was deleted';
        }
    }


echo '<p><a href="',filter_input(INPUT_SERVER, 'HTTP_REFERER'),'">Go back</a></p>';



