<?php
    class Database{

        private $servername = 'localhost';
        private $username = 'root';
        private $password = '';
        private $dbname = 'company';
        private $conn;


        public function __construct(){
            $this->conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname);
            if(!$this->conn):
                die("Error :" . mysqli_connect_error());
            else:
                //echo "Done";
            endif;       
        }

        public function create($q){
            if(mysqli_query($this->conn,$q)){
                return "Added Success";
            }else{
                die("Error :" . mysqli_error($this->conn));
            }
        }



        public function enc_password($password){
            return sha1($password);
        }
    

        public function show($table){

            $q = "SELECT * from $table";
            $result = mysqli_query($this->conn,$q);
            $data = [];
            if($result){
                if(mysqli_num_rows($result)){
                    while($i = mysqli_fetch_assoc($result)){
                        $data[] = $i; 
                    }
                }
                return $data;
            }else{
                die('Error:' . mysqli_error($this->conn));
            }
        }



        public function find($table, $id){
                $q = "SELECT * from $table WHERE `id` = '$id'";
                $result = mysqli_query($this->conn,$q);
        
                if($result){

                    if(mysqli_num_rows($result)){
                        return mysqli_fetch_assoc($result);
                    }

                    return false;

                }else{
                    die('Error:' . mysqli_error($this->conn));
                }
            }

        
        public function update($q){
            if(mysqli_query($this->conn,$q)){
                return "Updated Success";
            }else{
                die("Error :" . mysqli_error($this->conn));
            }
        }


      public function destroy($table, $id){
        $q = "DELETE FROM $table WHERE `id` = '$id'";
        if(mysqli_query($this->conn,$q)){
            return "Row Deleted !";
        }else{
            die("Error :" . mysqli_error($this->conn));
        }
      }
    
    }



