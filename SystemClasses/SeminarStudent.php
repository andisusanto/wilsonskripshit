<?php include_once('BaseObject.php'); ?>
<?php include_once('Exceptions.php'); ?>
<?php
class SeminarStudent extends BaseObject{
   const TABLENAME = 'SeminarStudent';
   public function __construct($mySQLi){
       parent::__contruct($mySQLi);
   }
    public $ParticipantType;
    public $Seminar;
    public $Attended;
    public $Approved;
    public $Student;
    public $FormResponse;
    public $Note;

   public function get_SaveQuery(){
       $mySQLi = $this->get_mySQLi();
       return "INSERT INTO ".self::TABLENAME."(ParticipantType,Seminar,Attended,Approved,Student,FormResponse,Note,LockField) VALUES('".$mySQLi->real_escape_string($this->ParticipantType)."','".$mySQLi->real_escape_string($this->Seminar)."','".$mySQLi->real_escape_string($this->Attended)."','".$mySQLi->real_escape_string($this->Approved)."','".$mySQLi->real_escape_string($this->Student)."','".$mySQLi->real_escape_string($this->FormResponse)."','".$mySQLi->real_escape_string($this->Note)."','".$mySQLi->real_escape_string($this->LockField)."')";}
   public function get_UpdateQuery(){
       $mySQLi = $this->get_mySQLi();
       return "UPDATE ".self::TABLENAME." SET ParticipantType = '".$mySQLi->real_escape_string($this->ParticipantType)."', Seminar = '".$mySQLi->real_escape_string($this->Seminar)."', Attended = '".$mySQLi->real_escape_string($this->Attended)."', Approved = '".$mySQLi->real_escape_string($this->Approved)."', Student = '".$mySQLi->real_escape_string($this->Student)."', FormResponse = '".$mySQLi->real_escape_string($this->FormResponse)."', Note = '".$mySQLi->real_escape_string($this->Note)."', LockField = '".$mySQLi->real_escape_string($this->LockField)."' WHERE Id = '".$mySQLi->real_escape_string($this->Id)."'";}
   protected function get_TableName(){
       return self::TABLENAME;
   }

   public static function GetObjectByKey($mySQLi, $Id){
       if($result = $mySQLi->query("SELECT * FROM ".self::TABLENAME." WHERE Id = ".$mySQLi->real_escape_string($Id)." LIMIT 1")){
           if($row = $result->fetch_array()){
               $tmpSeminarStudent = new SeminarStudent($mySQLi);
               $tmpSeminarStudent->Id = $row['Id'];
               $tmpSeminarStudent->ParticipantType = $row['ParticipantType'];
               $tmpSeminarStudent->Seminar = $row['Seminar'];
               $tmpSeminarStudent->Attended = $row['Attended'];
               $tmpSeminarStudent->Approved = $row['Approved'];
               $tmpSeminarStudent->Student = $row['Student'];
               $tmpSeminarStudent->FormResponse = $row['FormResponse'];
               $tmpSeminarStudent->Note = $row['Note'];

               $tmpSeminarStudent->LockField = $row['LockField'];
               return $tmpSeminarStudent;
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
           $SeminarStudents = array();
           while ($row = $result->fetch_array()){
               $tmpSeminarStudent = new SeminarStudent($mySQLi);
               $tmpSeminarStudent->Id = $row['Id'];
               $tmpSeminarStudent->LockField = $row['LockField'];
               $tmpSeminarStudent->ParticipantType = $row['ParticipantType'];
               $tmpSeminarStudent->Seminar = $row['Seminar'];
               $tmpSeminarStudent->Attended = $row['Attended'];
               $tmpSeminarStudent->Approved = $row['Approved'];
               $tmpSeminarStudent->Student = $row['Student'];
               $tmpSeminarStudent->FormResponse = $row['FormResponse'];
               $tmpSeminarStudent->Note = $row['Note'];

               $SeminarStudents[] = $tmpSeminarStudent;
           }
           return $SeminarStudents;
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