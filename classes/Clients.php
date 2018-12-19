<?php

class Clients{

    private $db;

    public function __construct()
    {
        $this->db = DB::getInstance();
    }

    public function create($fields = array()){
        if(!$this->db->insert('clients', $fields)){
            throw new Exception('There was a problem adding a client !');
        }
    }

    public function findAll(){
        try
        {
            $Clients=$this->db->get('clients', array('id', '>', 0));
            $Clients_list= array();
            for($i=0;$i<$Clients->counte();$i++){
                $list = $Clients->results()[$i];
                $client['id'] = $list->id;
                $client['fullName'] = $list->fullName;
                $client['company'] = $list->company;
                $client['phone1'] = $list->phone1;
                $client['phone2'] = $list->phone2;
                $client['phone3'] = $list->phone3;
                $client['adress'] = $list->adress;
                $client['latitude'] = $list->latitude;
                $client['longtitude'] = $list->longtitude;
                $client['activity_section'] = $list->activity_section;
                $Clients_list[] =  $client;
            }
            return $Clients_list;

        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }

    }

    public function findById($id){
        try
        {
            $Clients=$this->db->get('clients', array('id', '=', $id));
                $list = $Clients->results()[0];
                $client['id'] = $list->id;
                $client['fullName'] = $list->fullName;
                $client['company'] = $list->company;
                $client['phone1'] = $list->phone1;
                $client['phone2'] = $list->phone2;
                $client['phone3'] = $list->phone3;
                $client['adress'] = $list->adress;
                $client['latitude'] = $list->latitude;
                $client['longtitude'] = $list->longtitude;
                $client['activity_section'] = $list->activity_section;
            return $client;


        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }

    }


    public function get_name_By_Id($id){
        try
        {
            $clientRow=$this->db->get('clients',array('id' ,'=' ,$id));
            if($clientRow->counte())
            {
                $clientRow = $clientRow->results()[0];
                return $clientRow->fullName;
            }
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    public function exists($id){
        $test = false;
        try
        {
            $Clients=$this->db->get('clients', array('id', '=', $id));
            if($Clients->counte())
                $test = true;

        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
        return $test;

    }

    public function update($id,$fields = array()){
        if(!$this->db->update('clients', $id, $fields))
            throw new Exception('There was a problem updating a task !');
    }

    public function delete($id){
        try{
            $this->db->delete('clients', array('id', '=', $id));
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }

}