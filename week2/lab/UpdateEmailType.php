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


        $DAO = new EmailTypeDAO($db);
        
        
        $id = filter_input(INPUT_GET, 'id'); 
        $values = $DAO->getById($id);


        //repopulates fields with updated information instead of resetting the values
        $getActive = $values->getActive();
        $getEmailType = $values->getEmailtype();
        $getEmailTypeId = $values->getEmailtypeid();


        
        
       //builds model to be mapped
        $arr = filter_input_array(INPUT_POST);

        if($util->isPostRequest())
        {
                
            $model = new EmailTypeModel();
            $model->map($arr);

            if ( NULL !== $id ) {
                
                if ( $DAO->save($model) ) {
                    echo 'Email Type was Updated';
                    header('Location: EmailType-Test.php');
                }
                else{
                    echo 'Email Type was NOT Updated';
                    echo '<p><a href="EmailType-Test.php">Go back</a></p>'; 
                }
            }
        }



?>

<h3>Update Email Type</h3>
        <form action="#" method="post">
            <label>Email Type:</label>            
            <input type="text" name="emailtype" value="<?php echo $getEmailType; ?>" placeholder="" />
            <br /><br />
            <label>Active:</label>
            <input type="number" max="1" min="0" name="active" value="<?php echo $getActive; ?>" />
            <input type="hidden" name="emailtypeid" value = "<?php echo $id; ?>">
          
            
             <br /><br />
            <input type="submit" value="Update" />
        </form>