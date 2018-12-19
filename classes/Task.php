<?php

class Task{

    private $db;

    public function __construct()
    {
        $this->db = DB::getInstance();
    }

    public function create($fields = array()){
        if(!$this->db->insert('tasks', $fields)){
            throw new Exception('There was a problem creating a task !');
        }
    }


    public function findAll(){
        try
        {
            $allTasks0=$this->db->get('tasks', array('id', '>', 0));
            $tasks= array();
            for($i=0;$i<$allTasks0->counte();$i++){
                $allTasks = $allTasks0->results()[$i];
                    $task['id'] = $allTasks->id;
                    $task['name'] = $allTasks->name;
                    $task['Date'] = $allTasks->Date;
                    $task['deadline'] = $allTasks->deadline;
                    $task['status'] = $allTasks->status;
                    $task['picture'] = $allTasks->picture;
                    $task['employee_id'] = $allTasks->employee_id;
                    $task['client_id'] = $allTasks->client_id;
                $tasks[] =  $task;
            }
            return $tasks;

        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }

    }
    
    
   /* public function findAll_By_Client($id){
        try
        {
            $allTasks0=$this->db->get('tasks', array('client_id', '=', $id));
            $tasks= array();
            for($i=0;$i<$allTasks0->counte();$i++){
                $allTasks = $allTasks0->results()[$i];
                $task['id'] = $allTasks->id;
                $task['name'] = $allTasks->name;
                $task['Date'] = $allTasks->Date;
                $task['deadline'] = $allTasks->deadline;
                $task['status'] = $allTasks->status;
                $task['picture'] = $allTasks->picture;
                $task['employee_id'] = $allTasks->employee_id;
                $task['client_id'] = $allTasks->client_id;
                $tasks[] =  $task;
            }
            return $tasks;

        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }

    }

    public function findAll_By_Employee($id){
        try
        {
            $allTasks0=$this->db->get('tasks', array('employee_id', '=', $id));
            $tasks= array();
            for($i=0;$i<$allTasks0->counte();$i++){
                $allTasks = $allTasks0->results()[$i];
                $task['id'] = $allTasks->id;
                $task['name'] = $allTasks->name;
                $task['Date'] = $allTasks->Date;
                $task['deadline'] = $allTasks->deadline;
                $task['status'] = $allTasks->status;
                $task['picture'] = $allTasks->picture;
                $task['employee_id'] = $allTasks->employee_id;
                $task['client_id'] = $allTasks->client_id;
                $tasks[] =  $task;
            }
            return $tasks;

        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }

    }*/


    public function findById($id){
        try
        {
            $taskRow=$this->db->get('tasks',array('id' ,'=' ,$id));
            if($taskRow->counte())
            {
                $taskRow = $taskRow->results()[0];
                $task['id'] = $taskRow->id;
                $task['name'] = $taskRow->name;
                $task['Date'] = $taskRow->Date;
                $task['deadline'] = $taskRow->deadline;
                $task['status'] = $taskRow->status;
                $task['picture'] = $taskRow->picture;
                $task['employee_id'] = $taskRow->employee_id;
                $task['client_id'] = $taskRow->client_id;
                return $task;
            }
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    public function findInProgress(){
        try
        {
            $allTasks0=$this->db->get('tasks', array('status', '=', 2));
            $tasks= array();
            for($i=0;$i<$allTasks0->counte();$i++){
                $allTasks = $allTasks0->results()[$i];
                $task['id'] = $allTasks->id;
                $task['name'] = $allTasks->name;
                $task['Date'] = $allTasks->Date;
                $task['deadline'] = $allTasks->deadline;
                $task['status'] = $allTasks->status;
                $task['picture'] = $allTasks->picture;
                $task['employee_id'] = $allTasks->employee_id;
                $task['client_id'] = $allTasks->client_id;
                $tasks[] =  $task;
            }
            return $tasks;

        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    public function update($id,$fields = array()){
        if(!$this->db->update('tasks', $id, $fields))
            throw new Exception('There was a problem updating a task !');
    }

    public function delete($id){
        try{
            $this->db->delete('tasks', array('id', '=', $id));
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }

}


?>