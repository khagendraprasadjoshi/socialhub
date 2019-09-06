<?php
class db
{
    protected $dbconn;
    public function __construct()
    {
        
try{
  
$dbconn = new PDO("mysql:host=localhost;dbname=fb","root","");
}
catch(PDOException $e)
{
    echo $e->getMessage();
}

} 
    
}

?>