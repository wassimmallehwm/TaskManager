<?php
/**
 * Created by PhpStorm.
 * User: wassim
 * Date: 22/08/2018
 * Time: 20:04
 */

class Employee
{

    private $db;

    public function __construct()
    {
        $this->db = DB::getInstance();
    }

    public function create($fields = array()){
        if(!$this->db->insert('employees', $fields)){
            throw new Exception('There was a problem creating an account !');
        }
    }

    public function findAll(){
        try
        {
            $Employees=$this->db->get('employees', array('id', '>', 0));
            $Employees_list= array();
            for($i=0;$i<$Employees->counte();$i++){
                $list = $Employees->results()[$i];
                $employee['id'] = $list->id;
                $employee['fullName'] = $list->fullName;
                $employee['cin'] = $list->cin;
                $employee['dateNaissance'] = $list->dateNaissance;
                $employee['etatSocial'] = $list->etatSocial;
                $employee['mat'] = $list->mat;
                $employee['phone'] = $list->phone;
                $employee['phone2'] = $list->phone2;
                $employee['phone3'] = $list->phone3;
                $employee['adress'] = $list->adress;
                $employee['id_function'] = $list->id_function;
                $Employees_list[] =  $employee;
            }
            return $Employees_list;

        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }

    }

    public function findById($id){
        try
        {
            $Employees=$this->db->get('employees', array('id', '=', $id));
                $list = $Employees->results()[0];
            $employee['id'] = $list->id;
            $employee['fullName'] = $list->fullName;
            $employee['cin'] = $list->cin;
            $employee['dateNaissance'] = $list->dateNaissance;
            $employee['etatSocial'] = $list->etatSocial;
            $employee['mat'] = $list->mat;
            $employee['phone'] = $list->phone;
            $employee['phone2'] = $list->phone2;
            $employee['phone3'] = $list->phone3;
            $employee['adress'] = $list->adress;
            $employee['id_function'] = $list->id_function;
            return $employee;

        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }

    }

    public function exists($cin){
        $test = false;
        try
        {
            $Employees=$this->db->get('employees', array('cin', '=', $cin));

            if($Employees->counte()){
                $test = true;
            }

        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
        return $test;

    }

    public function get_name_By_Id($id){
        try
        {
            $empRow=$this->db->get('employees',array('id' ,'=' ,$id));
            if($empRow->counte())
            {
                $empRow = $empRow->results()[0];
                return $empRow->fullName;
            }
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }


    public function update($id,$fields = array()){
        if(!$this->db->update('employees', $id, $fields))
            throw new Exception('There was a problem updating a task !');
    }

    public function delete($id){
        try{
            $this->db->delete('employees', array('id', '=', $id));
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }
}