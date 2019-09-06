<?php
try{
    $db = new PDO("mysql:host=localhost;dbname=fb","root","");
    
    } catch(PDOException $e){
        echo $e->getMessage();
    }
$query1 = $db->prepare("SELECT * FROM `posts`");
$query1->execute();
if($query1->rowCount()>0){

 $i = 0;
    $row2 = $query1->fetchAll(PDO::FETCH_OBJ);
for($i = $query1->rowCount()-1;$i>=0;$i--)
{
    
$myJSON = json_encode($row2,JSON_PRETTY_PRINT);

}
}

echo $myJSON;


?>