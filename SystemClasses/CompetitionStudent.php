<?php include_once('BaseObject.php'); ?>
<?php include_once('Exceptions.php'); ?>
<?php
class CompetitionStudent extends BaseObject{
   const TABLENAME = 'CompetitionStudent';
   public function __construct($mySQLi){
       parent::__contruct($mySQLi);
   }
    public $FormResponse;
    public $ParticipantType;
    public $Student;
    public $Rank;
    public $Atteded;
    public $Approved;
    public $Competition;
    public $Note;

   public function get_SaveQuery(){
       $mySQLi = $this->get_mySQLi();
       return "INSERT INTO ".self::TABLENAME."(FormResponse,ParticipantType,Student,Rank,Atteded,Approved,Competition,Note,LockField) VALUES('".$mySQLi->real_escape_string($this->FormResponse)."','".$mySQLi->real_escape_string($this->ParticipantType)."','".$mySQLi->real_escape_string($this->Student)."','".$mySQLi->real_escape_string($this->Rank)."','".$mySQLi->real_escape_string($this->Atteded)."','".$mySQLi->real_escape_string($this->Approved)."','".$mySQLi->real_escape_string($this->Competition)."','".$mySQLi->real_escape_string($this->Note)."','".$mySQLi->real_escape_string($this->LockField)."')";}
   public function get_UpdateQuery(){
       $mySQLi = $this->get_mySQLi();
       return "UPDATE ".self::TABLENAME." SET FormResponse = '".$mySQLi->real_escape_string($this->FormResponse)."', ParticipantType = '".$mySQLi->real_escape_string($this->ParticipantType)."', Student = '".$mySQLi->real_escape_string($this->Student)."', Rank = '".$mySQLi->real_escape_string($this->Rank)."', Atteded = '".$mySQLi->real_escape_string($this->Atteded)."', Approved = '".$mySQLi->real_escape_string($this->Approved)."', Competition = '".$mySQLi->real_escape_string($this->Competition)."', Note = '".$mySQLi->real_escape_string($this->Note)."', LockField = '".$mySQLi->real_escape_string($this->LockField)."' WHERE Id = '".$mySQLi->real_escape_string($this->Id)."'";}
   protected function get_TableName(){
       return self::TABLENAME;
   }
   public function get_CompetitionStudentCompetency($page=0,$totalitem=0){
       return CompetitionStudentCompetency::LoadCollection($this->get_mySQLi(),"CompetitionStudent = ".$this->Id,'Id DESC',$page,$totalitem);
   }

   public static function GetObjectByKey($mySQLi, $Id){
       if($result = $mySQLi->query("SELECT * FROM ".self::TABLENAME." WHERE Id = ".$mySQLi->real_escape_string($Id)." LIMIT 1")){
           if($row = $result->fetch_array()){
               $tmpCompetitionStudent = new CompetitionStudent($mySQLi);
               $tmpCompetitionStudent->Id = $row['Id'];
               $tmpCompetitionStudent->FormResponse = $row['FormResponse'];
               $tmpCompetitionStudent->ParticipantType = $row['ParticipantType'];
               $tmpCompetitionStudent->Student = $row['Student'];
               $tmpCompetitionStudent->Rank = $row['Rank'];
               $tmpCompetitionStudent->Atteded = $row['Atteded'];
               $tmpCompetitionStudent->Approved = $row['Approved'];
               $tmpCompetitionStudent->Competition = $row['Competition'];
               $tmpCompetitionStudent->Note = $row['Note'];

               $tmpCompetitionStudent->LockField = $row['LockField'];
               return $tmpCompetitionStudent;
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
           $CompetitionStudents = array();
           while ($row = $result->fetch_array()){
               $tmpCompetitionStudent = new CompetitionStudent($mySQLi);
               $tmpCompetitionStudent->Id = $row['Id'];
               $tmpCompetitionStudent->LockField = $row['LockField'];
               $tmpCompetitionStudent->FormResponse = $row['FormResponse'];
               $tmpCompetitionStudent->ParticipantType = $row['ParticipantType'];
               $tmpCompetitionStudent->Student = $row['Student'];
               $tmpCompetitionStudent->Rank = $row['Rank'];
               $tmpCompetitionStudent->Atteded = $row['Atteded'];
               $tmpCompetitionStudent->Approved = $row['Approved'];
               $tmpCompetitionStudent->Competition = $row['Competition'];
               $tmpCompetitionStudent->Note = $row['Note'];

               $CompetitionStudents[] = $tmpCompetitionStudent;
           }
           return $CompetitionStudents;
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