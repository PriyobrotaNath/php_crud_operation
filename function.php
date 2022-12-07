<?php
    class crudApp{
        private $conn;

        public function __construct()
        {
            #database host
            #database user information
            #database password
            #database name
            $dbhost='localhost';
            $dbuser='root';
            $dbpass="";
            $dbname='crudapp';

            $this->conn=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
            if(!$this->conn){
                die("Database Connection Error!!!");
            }
        }
        
    

        public function add_data($data){
            $std_name=$data['std_name'];
            $std_roll=$data['std_roll'];
            $std_img=$_FILES['std_image']['name'];
            $tmp_name=$_FILES['std_image']['tmp_name'];
            
            $query="INSERT INTO students(Std_Name,Std_Roll,Std_Image) Value('$std_name',$std_roll,'$std_img')";

            if(mysqli_query($this->conn , $query)) #connection and query
            {
                move_uploaded_file($tmp_name,'upload/'.$std_img);
                return "Information Added Succesfully...";
            }

        }
        //  collect and display all data information 
        public function display_data(){
            $query=" SELECT * From students";
            if(mysqli_query($this->conn , $query)) #connection and query
            {
                $returndata=mysqli_query($this->conn , $query);
                return $returndata;
            }
        }
        // received individual data 
        public function display_data_by_id($id){
            $query=" SELECT * From students where Std_ID=$id";
            if(mysqli_query($this->conn , $query)) #connection and query
            {
                $returndata=mysqli_query($this->conn , $query);
                $studentData=mysqli_fetch_assoc($returndata);
                return $studentData;
            }
        }
        
        // received updated data
        public function update_data($data){
            $std_name=$data['u_std_name'];
            $std_roll=$data['u_std_roll'];
            $idNo=$data['u_std_id'];
            $std_img=$_FILES['u_std_image']['name'];
            $tmp_name=$_FILES['u_std_image']['tmp_name'];

            $query="UPDATE students SET Std_Name='$std_name',  Std_Roll='$std_roll',Std_Image='$std_img' WHERE Std_ID='$idNo'";
            if(mysqli_query($this->conn , $query)) #connection and query
            {
                move_uploaded_file($tmp_name,'upload/'.$std_img);
                return "Informtion Updated Successfully!";
            }
        }

        public function delete_data($id){
            $catch_img="SELECT * FROM students WHERE Std_ID=$id";//catch alldata
            $delete_std_info=mysqli_query($this->conn , $catch_img);// received all data by Std_ID
            $std_info_Del=mysqli_fetch_assoc($delete_std_info);// fetch all data[individual details]
            $delete_image_data=$std_info_Del['Std_Image'];//catch image data
            $query="DELETE FROM students WHERE Std_ID=$id";
            if(mysqli_query($this->conn , $query)){
                unlink('upload/'.$delete_image_data);//unlink or image delete from folder
                return "Deleted Succesfully!";
            }

        }



    }


?>