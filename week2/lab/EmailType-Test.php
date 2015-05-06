<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php include './bootstrap.php'; ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // put your code here
        $dbConfig = array(
            "DB_DNS"=>'mysql:host=localhost;port=3306;dbname=PHPadvClassSpring2015',
            "DB_USER"=>'root',
            "DB_PASSWORD"=>''
        );
        
        $pdo = new DB($dbConfig);
        $db = $pdo->getDB();
        
        $emailType = filter_input(INPUT_POST, 'emailtype');
        $emailTypeId = filter_input(INPUT_POST, 'emailtypeid');
        $active = filter_input(INPUT_POST, 'active');
        
        
        $emailTypeDAO = new EmailTypeDAO($db);
        $emailTypes = $emailTypeDAO->getAllRows();
        
        
        $util = new Util();
        
        if($util->isPostRequest())
        {
            $validator = new Validator(); 
            $errors = array();
                if( !$validator->emailIsValid($emailType) ) {
                    $errors[] = 'Email type is invalid';
                } 
                if ( !$validator->activeIsValid($active) ) {
                     $errors[] = 'Active is invalid';
                }
                if ( count($errors) > 0 ) {
                    foreach ($errors as $value) {
                        echo '<p>',$value,'</p>';
                }
                }else{
            
                    $emailTypeModel = new EmailTypeModel();
                    
                    $emailModel->map(filter_input_array(INPUT_POST));
                    
                    // var_dump($emailtypeModel);
                    if ( $emailTypeDAO->save($emailTypeModel) ) {
                        echo 'Email Type Added';
                    } else {
                        echo 'Email Type not added';
                    }
            
            
        
                } 
        }       
        
        ?>
        <h3>Add Email Type</h3>
        <form action="#" method="post">
            <label>Email Type:</label>            
            <input type="text" name="emailtype" value="<?php echo $emailType; ?>" placeholder="" />
            <br /><br />
            <label>Active:</label>
            <input type="number" max="1" min="0" name="active" value="<?php echo $active; ?>" />
            
            <br /><br />
            
             <br /><br />
            <input type="submit" value="Submit" />
        </form>
         
            <table border="1" cellpadding="5">
                <tr>
                    <th>Email Type</th>
                    <th>Active</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
         <?php 
            $emailTypes = $emailTypeDAO->getAllRows(); 
            foreach ($emailTypes as $value) {
                echo '<tr><td>',$value->getEmailtype(),'</td>';
                echo  '<td>', ( $value->getActive() == 1 ? 'Yes' : 'No') ,'</td><td><a href="DeleteEmailType.php?id=',$value->getEmailTypeid(),'">Delete</a></td> <td><a href="UpdateEmailType.php?id=',$value->getEmailTypeid(),'">Update</a></td> </tr>';
            }

         ?>
    </body>
</html>
