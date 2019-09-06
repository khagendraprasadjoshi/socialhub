<?php
class base_class extends db
{
private $Query;
public function query($query,$params=NULL)
{
    if(is_null($params))
    {
        $this->$Query = $this->$dbconn->prepare($query);
        return $this->$Query->execute();
        if($this->$Query)
        {
            echo "Success";
        }
        else{
            echo "Fail";
        }
    }
    else{
        $this->$Query = $this->$dbconn->prepare($query);
        return $this->$Query->execute(array($params));
        if($this->$Query)
        {
            echo "Success";
        }
        else{
            echo "Fail";
        }
    }
}
public function rowCount()
{

   return $this->$Query->rowCount();
}

}



?>