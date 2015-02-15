<?php include_once('BaseObject.php'); ?>
<?php include_once('Exceptions.php'); ?>
<?php
class StudentCompetency extends BaseObject{
   const TABLENAME = 'StudentCompetency';
   public function __construct($mySQLi){
       parent::__contruct($mySQLi);
   }
    public $Point;
    public $Student;
    public $Competency;
    public $Activity;

   public function get_SaveQuery(){
       $mySQLi = $this->get_mySQLi();
       return "INSERT INTO ".self::TABLENAME."(Point,Student,Competency,Activity,LockField) VALUES('".$mySQLi->real_escape_string($this->Point)."','".$mySQLi->real_escape_string($this->Student)."','".$mySQLi->real_escape_string($this->Competency)."','".$mySQLi->real_escape_string($this->Activity)."','".$mySQLi->real_escape_string($this->LockField)."')";}
   public function get_UpdateQuery(){
       $mySQLi = $this->get_mySQLi();
       return "UPDATE ".self::TABLENAME." SET Point = '".$mySQLi->real_escape_string($this->Point)."', Student = '".$mySQLi->real_escape_string($this->Student)."', Competency = '".$mySQLi->real_escape_string($this->Competency)."', Activity = '".$mySQLi->real_escape_string($this->Activity)."', LockField = '".$mySQLi->real_escape_string($this->LockField)."' WHERE Id = '".$mySQLi->real_escape_string($this->Id)."'";}
   protected function get_TableName(){
       return self::TABLENAME;
   }

   public static function GetObjectByKey($mySQLi, $Id){
       if($result = $mySQLi->query("SELECT * FROM ".self::TABLENAME." WHERE Id = ".$mySQLi->real_escape_string($Id)." LIMIT 1")){
           if($row = $result->fetch_array()){
               $tmpStudentCompetency = new StudentCompetency($mySQLi);
               $tmpStudentCompetency->Id = $row['Id'];
               $tmpStudentCompetency->Point = $row['Point'];
               $tmpStudentCompetency->Student = $row['Student'];
               $tmpStudentCompetency->Competency = $row['Competency'];
               $tmpStudentCompetency->Activity = $row['Activity'];

               $tmpStudentCompetency->LockField = $row['LockField'];
               return $tmpStudentCompetency;
           }
           else
           {
               return false;
           }
       }
       else
       {
           throw new InvalidQueryException;
       }
   }
   public static function LoadCollection($mySQLi, $Criteria = '1 = 1',$sort='',$page=0,$totalitem=0){
       $tmpQuery = "SELECT  * FROM ".self::TABLENAME." WHERE ".$mySQLi->real_escape_string($Criteria);
       if ($sort != ''){ $tmpQuery .= " "."ORDER BY ".$sort; }
       if ($page > 0 && $totalitem > 0){
           $start = ($page-1) * $totalitem;
           $tmpQuery .= " LIMIT ".$start.",".$totalitem;
       }
       if ($result = $mySQLi->query($tmpQuery)){
           $StudentCompetencys = array();
           while ($row = $result->fetch_array()){
               $tmpStudentCompetency = new StudentCompetency($mySQLi);
               $tmpStudentCompetency->Id = $row['Id'];
               $tmpStudentCompetency->LockField = $row['LockField'];
               $tmpStudentCompetency->Point = $row['Point'];
               $tmpStudentCompetency->Student = $row['Student'];
               $tmpStudentCompetency->Competency = $row['Competency'];
               $tmpStudentCompetency->Activity = $row['Activity'];

               $StudentCompetencys[] = $tmpStudentCompetency;
           }
           return $StudentCompetencys;
       }
       else
       {
           throw new InvalidQueryException;
       }
   }
   public static function Delete($mySQLi,$Id){
       if ($result = $mySQLi->query("DELETE FROM ".self::TABLENAME." WHERE Id=".$mySQLi->real_escape_string($Id))){
           if ($mySQLi->affected_rows == 0){
               throw new ObjectNotFoundException;
           }
       }
       else
       {
           throw new InvalidQueryException;
       }
   }
   public static function DeleteByActivity($mySQLi,$Id){
       if ($result = $mySQLi->query("DELETE FROM ".self::TABLENAME." WHERE Activity=".$mySQLi->real_escape_string($Id))){
           if ($mySQLi->affected_rows == 0){
               throw new ObjectNotFoundException;
           }
       }
       else
       {
           throw new InvalidQueryException;
       }
   }
}
?>