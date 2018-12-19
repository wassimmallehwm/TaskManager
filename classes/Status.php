<?php
/**
 * Created by PhpStorm.
 * User: wassim
 * Date: 13/09/2018
 * Time: 19:23
 */

class Status
{

    public function __construct()
    {
        $this->db = DB::getInstance();
    }


    public function findAll(){
        try
        {
            $AllStatus=$this->db->get('status', array('id', '>', 0));
            $list= array();
            for($i=0;$i<$AllStatus->counte();$i++){
                $StatusRow = $AllStatus->results()[$i];
                $status['id'] = $StatusRow->id;
                $status['designation'] = $StatusRow->designation;
                $list[] =  $status;
            }
            return $list;

        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }

    }

    public function getStatus($id){
        $des = "";
        try
        {
            $statusRow=$this->db->get('status',array('id' ,'=' ,$id));
            if($statusRow->counte())
            {
                $statusRow = $statusRow->results()[0];
                $des = $statusRow->designation;
            }
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
        return $des;
    }
}