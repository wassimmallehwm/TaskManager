<?php

class DB{
    
    private static $_instance = null;
    private $_pdo;
    private $_query;
    private $_error = false;
    private $_results;
    private $_count =0;
    
    private function __construct(){
        
        try{
            $this->_pdo = new PDO('mysql:host=' . Config::DB_HOST . ';dbname=' . Config::DB_NAME, Config::DB_USER,
            Config::DB_PASSWORD);
            $this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e){
            die($e->getMessage());
        }
    }
    
    public static function getInstance(){
        if(!isset(self::$_instance))
            self::$_instance = new DB();
        return self::$_instance;
    }
    
    public function query($sql,$params = array()){
        $this->_error = false;
        if($this->_query = $this->_pdo->prepare($sql)){
            $x=1;
            if(count($params)){
                foreach($params as $param){
                    $this->_query->bindValue($x,$param);
                $x++;
                }
            }
            
            if($this->_query->execute()){
                $type = substr ( trim ( strtoupper ( $sql ) ), 0, 6 );
                if ($type == "SELECT") {
                    $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
                    $this->_count = $this->_query->rowCount();
                }
            }else{
                $this->_error = true;
            }
            
        }
        return $this;
    }
    
    
    public function action($action, $table, $where=array()){
        if(count($where )=== 3){
            $operators = array('=', '>' , '<' , '>=' , '<=');
            $field = $where[0];
            $operator = $where[1];
            $value = $where[2];
            
            if(in_array($operator, $operators)){
                $sql ="$action FROM $table WHERE $field $operator ?";
                if(!$this->query($sql,array($value))->_error){
                    return $this;
                }
            }
        }
        return false;
    }
    
    public function get($table, $where=array()){
        return $this->action('SELECT * ',$table,$where);
    }
    
    public function delete($table, $where=array()){
        return $this->action('DELETE ',$table,$where);
    }
    
    public function insert($table, $fields = array()){
        if(count($fields)){
            $keys = array_keys($fields);
            $values = '';
            $x=1;
            
            foreach($fields as $field){
                $values .= '?';
                if($x< count(($fields))){
                    $values .= ', ';
                }
                $x++;
            }
            
            $sql = "INSERT INTO ".$table." (`". implode('`,`', $keys) ."`) VALUES (".$values.")";

            if(!$this->query($sql,$fields)->error()){
                return true;
            }
        }
        return false;
    }
    
    public function update($table, $id, $fields){
        $set ='';
        $x=1;
        
        foreach($fields as $name => $values){
            $set .= $name."= ?";
            if($x < count($fields)){
                $set .=', ';
            }
            $x++;
        }
       
        $sql="UPDATE ".$table." SET ".$set." WHERE id = '".$id."'";
        
         if(!$this->query($sql,$fields)->error()){
                return true;
            }
        
        return false;
        
        
    }
    
    public function first(){
        return $this->results()[0];   
    }

    public function counte(){
        return $this->_count;
    }
    
    public function error(){
        return $this->_error;
    }
    
    public function results(){
        return $this->_results;
    }
    
    
    
    
}