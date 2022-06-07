<?php
class store
{
    private $id;
    private $storeName;
    private $storeAddress;
    private $studentId;

    public function __construct($id, $sname, $sadd, $sid)
    {
        $this->id=$id;
        $this->storeName=$sname;
        $this->storeAddress=$sadd;
        $this->studentId=$sid;
    }
    public function getid()
    {
        return $this->id;
    }
    public function getsname()
    {
        return $this->storeName;
    }
    public function getsadd()
    {
        return $this->storeAddress;
    }
    public function getsid()
    {
        return $this->studentId;
    }
    function __destruct()
    {
        
    }

}

?>
