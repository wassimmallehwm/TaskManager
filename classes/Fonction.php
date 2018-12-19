<?php
/**
 * Created by PhpStorm.
 * User: wassim
 * Date: 14/11/2018
 * Time: 12:35
 */

class Fonction
{
    public function __construct()
    {
        $this->db = DB::getInstance();
    }

    public function getAllFunctions(){
        try
        {
            $functions=$this->db->get('functions', array('id', '>', 0));
            $functions_list= array();
            for($i=0;$i<$functions->counte();$i++){
                $list = $functions->results()[$i];
                $function['id'] = $list->id;
                $function['name'] = $list->name;
                $function['hoursPerDay'] = $list->hoursPerDay;
                $functions_list[] =  $function;
            }
            return $functions_list;

        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }

    }

    public function getFunction($id){
        try
        {
            $funRow=$this->db->get('functions',array('id' ,'=' ,$id));
            if($funRow->counte())
            {
                $funRow = $funRow->results()[0];
                return $funRow->name;
            }
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }
}