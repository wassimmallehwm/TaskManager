<?php
class User{


    private $db;

    public function __construct()
    {
        $this->db = DB::getInstance();
    }



    /*public function create($fields = array()){
        if(!$this->db->insert('users', $fields)){
            throw new Exception('There was a problem creating an account !');
        }
    }*/

    public function login($username,$password)
    {
        $test=false;
        try
        {
            $userRow=$this->db->get('users',array('username' ,'=' ,$username));
            if($userRow->counte())
            {
                $userRow = $userRow->results()[0];
                if(password_verify($password, $userRow->password))
                {
                    Session::put('id',$userRow->id);
                    $test = true;
                }
            }
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
        return $test;
    }

    public function findById($id){
        try
        {
            $userRow=$this->db->get('users',array('id' ,'=' ,$id));
            if($userRow->counte())
            {
                    $userRow = $userRow->results()[0];
                    Session::put('username',$userRow->username);
                    Session::put('fullName',$userRow->fullName);
                    Session::put('pic',$userRow->pic);
            }
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }

   /* public function findAll(){
        try
        {
            $userRows=$this->db->get('users', array('id', '>', 0));
            $users= array();
            for($i=0;$i<$userRows->counte();$i++){
                $userRow = $userRows->results()[$i];
                $user['id'] = $userRow->id;
                $user['username'] = $userRow->username;
                $user['fullName'] = $userRow->fullName;
                $user['pic'] = $userRow->pic;
                $users[] =  $user;
            }
            return $users;
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }*/



    /*public function findByUser($username){
        $test = false;
        try
        {
            $userRow=$this->db->get('users',array('username' ,'=' ,$username));
            if($userRow->counte())
            {
                $userRow = $userRow->results()[0];
                Session::put('id',$userRow->id);
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
            $userRow=$this->db->get('users',array('id' ,'=' ,$id));
            if($userRow->counte())
            {
                $userRow = $userRow->results()[0];
                return $userRow->fullName;
            }
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }*/


    public function isLoggedIn()
    {
        if(Session::exists('id'))
            //if(isset($_SESSION['user_session']))
        {
            return true;
        }
    }

    public function redirect($url)
    {
        header("Location: $url");
    }

    public function logout()
    {
        session_destroy();
        //unset($_SESSION['user_session']);
        Session::delete('id');
        return true;
    }







}