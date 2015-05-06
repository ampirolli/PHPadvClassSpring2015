<?php

/**
 * emailTypeDB Class
 * 
 * functions that will save to the database and display email types
 *
 * @author Ampirolli
 */

class emailTypeDb
{
    
    public function saveEmailType($emailType)
    {
        
        //save to the database
            $dbConfig = array(
            "DB_DNS"=>'mysql:host=localhost;port=3306;dbname=PHPadvClassSpring2015',
            "DB_USER"=>'root',
            "DB_PASSWORD"=>''
            );
            
            $pdo = new DB($dbConfig);
            $db = $pdo->getDB();
            $stmt = $db->prepare("INSERT INTO emailtype SET emailtype = :emailtype");
            
            $values = array(":emailtype"=>$emailType);
            
            if($stmt->execute($values) && $stmt->rowCount() >0)
            {
                echo 'Email Type Added';
            }       
    }
    
    public function displayEmailType()
    {
        
        //pulls data from db
        $dbConfig = array(
            "DB_DNS"=>'mysql:host=localhost;port=3306;dbname=PHPadvClassSpring2015',
            "DB_USER"=>'root',
            "DB_PASSWORD"=>''
            );
        
        $pdo = new DB($dbConfig);
        $db = $pdo->getDB();
        
        $stmt = $db->prepare("SELECT * FROM emailtype");
        
        if($stmt->execute() && $stmt->rowCount() >0)
        {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach($results as $value){
                if($value['active'] == 1)
                { 
                    echo '<strong>', $value['emailtype'], '</strong> <br />' ;
                            
                }else if($value['active'] == 0){
                    echo '<p>', $value['emailtype'], '</p> <br />' ;
                }
            }
        }else{
            echo '<p>No Data</p>';
        }
        
    }
    
}

