<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
include './bootstrap.php';


    $util = new Util();

        $dbConfig = array(
        "DB_DNS"=>'mysql:host=localhost;port=3306;dbname=PHPadvClassSpring2015',
        "DB_USER"=>'root',
        "DB_PASSWORD"=>''
        );
        $pdo = new DB($dbConfig);
        $db = $pdo->getDB();


        $DAO = new EmailDAO($db);

        // get values from URL
        $emailID = filter_input(INPUT_GET, 'id');

        $values = $DAO->getById($emailID);
       
        $email = filter_input(INPUT_POST, 'email');
        $active = filter_input(INPUT_POST, 'active');
        $emailTypeId = filter_input(INPUT_POST, 'emailtypeid');
        $emailtypeactive = $values->getEmailtypeactive();
        $emailType = $values->getEmailtype();
        $logged = $values->getLogged();
        $lastUpdated = $values->getLastupdated();
     
        //repopulates fields with updated information instead of resetting the values
        $getEmail = $values->getEmail();
        $getActive = $values->getActive();
        $getEmailType = $values->getEmailtype();
        $getEmailTypeId = $values->getEmailtypeid();

        
        
       //builds model to be mapped
        $arr = array(
            'emailid' => $emailID,
            'email' => $email,
            'emailtypeid' => $emailTypeId,
            'emailtype' => $emailType,
            'emailtypeactive' => $emailtypeactive,
            'logged' => $logged,
            'lastupdated' => $lastUpdated,
            'active' => $active
        );
        
        $emailTypeDAO = new EmailTypeDAO($db);
        $emailTypes = $emailTypeDAO->getAllRows();// retrieves all email types
        

        if($util->isPostRequest())
        {
                
            $model = new EmailModel();
            $model->map($arr);

            if ( NULL !== $emailID ) {
                
                if ( $DAO->save($model) ) {
                    echo 'Email was Updated';
                    header('Location: Email-Test.php');
                }
                else{
                    echo 'Email was NOT Updated';
                    echo '<p><a href="Email-Test.php">Go back</a></p>'; 
                }
            }
        }



?>

<h3>Update Email</h3>
        <form action="#" method="post">
            <label>Email:</label>            
            <input type="text" name="email" value="<?php echo $getEmail; ?>" placeholder="" />
            <br /><br />
            <label>Active:</label>
            <input type="number" max="1" min="0" name="active" value="<?php echo $getActive; ?>" />
            
            <br /><br />
            <label>Email Type:</label>
            <select name="emailtypeid" text="<?php echo $getEmailType; ?>" value="<?php echo $getEmailType; ?>" >
            <?php //loops through and looks for the email type that the selected email has, and displays it as the defualt value
                foreach ($emailTypes as $value) {
                    if ( $value->getEmailtypeid() == $getEmailTypeId ) {
                        echo '<option value="',$value->getEmailtypeid(),'" selected="selected">',$value->getEmailtype(),'</option>';  
                    } else {
                        echo '<option value="',$value->getEmailtypeid(),'">',$value->getEmailtype(),'</option>';
                    }
                }
            ?>
            </select>
            
             <br /><br />
            <input type="submit" value="Update" />
        </form>