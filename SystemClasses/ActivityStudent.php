<?php include_once('BaseObject.php'); ?>
<?php include_once('Exceptions.php'); ?>
<?php
class ActivityStudent extends BaseObject{
   const TABLENAME = 'ActivityStudent';
   public function __construct($mySQLi){
       parent::__contruct($mySQLi);
   }
    public $Activity;
    public $Note;
    public $Student;
    public $Attended;
    public $ParticipantType;
    public $Status;

   public function get_SaveQuery(){
       $mySQLi = $this->get_mySQLi();
       return "INSERT INTO ".self::TABLENAME."(Activity,Note,Student,Attended,ParticipantType,Status,LockField) VALUES('".$mySQLi->real_escape_string($this->Activity)."','".$mySQLi->real_escape_string($this->Note)."','".$mySQLi->real_escape_string($this->Student)."','".$mySQLi->real_escape_string($this->Attended)."','".$mySQLi->real_escape_string($this->ParticipantType)."','".$mySQLi->real_escape_string($this->Status)."','".$mySQLi->real_escape_string($this->LockField)."')";}
   public function get_UpdateQuery(){
       $mySQLi = $this->get_mySQLi();
       return "UPDATE ".self::TABLENAME." SET Activity = '".$mySQLi->real_escape_string($this->Activity)."', Note = '".$mySQLi->real_escape_string($this->Note)."', Student = '".$mySQLi->real_escape_string($this->Student)."', Attended = '".$mySQLi->real_escape_string($this->Attended)."', ParticipantType = '".$mySQLi->real_escape_string($this->ParticipantType)."', Status = '".$mySQLi->real_escape_string($this->Status)."', LockField = '".$mySQLi->real_escape_string($this->LockField)."' WHERE Id = '".$mySQLi->real_escape_string($this->Id)."'";}
   protected function get_TableName(){
       return self::TABLENAME;
   }

   public static function GetObjectByKey($mySQLi, $Id){
       if($result = $mySQLi->query("SELECT * FROM ".self::TABLENAME." WHERE Id = ".$mySQLi->real_escape_string($Id)." LIMIT 1")){
           if($row = $result->fetch_array()){
               $tmpActivityStudent = new ActivityStudent($mySQLi);
               $tmpActivityStudent->Id = $row['Id'];
               $tmpActivityStudent->Activity = $row['Activity'];
               $tmpActivityStudent->Note = $row['Note'];
               $tmpActivityStudent->Student = $row['Student'];
               $tmpActivityStudent->Attended = $row['Attended'];
               $tmpActivityStudent->ParticipantType = $row['ParticipantType'];
               $tmpActivityStudent->Status = $row['Status'];

               $tmpActivityStudent->LockField = $row['LockField'];
               return $tmpActivityStudent;
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
           $ActivityStudents = array();
           while ($row = $result->fetch_array()){
               $tmpActivityStudent = new ActivityStudent($mySQLi);
               $tmpActivityStudent->Id = $row['Id'];
               $tmpActivityStudent->LockField = $row['LockField'];
               $tmpActivityStudent->Activity = $row['Activity'];
               $tmpActivityStudent->Note = $row['Note'];
               $tmpActivityStudent->Student = $row['Student'];
               $tmpActivityStudent->Attended = $row['Attended'];
               $tmpActivityStudent->ParticipantType = $row['ParticipantType'];
               $tmpActivityStudent->Status = $row['Status'];

               $ActivityStudents[] = $tmpActivityStudent;
           }
           return $ActivityStudents;
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
}
?>