<?php include_once('BaseObject.php'); ?>
<?php include_once('Exceptions.php'); ?>
<?php
class CompetitionStudentCompetency extends BaseObject{
   const TABLENAME = 'CompetitionStudentCompetency';
   public function __construct($mySQLi){
       parent::__contruct($mySQLi);
   }
    public $Competency;
    public $CompetitionStudent;
    public $Point;

   public function get_SaveQuery(){
       $mySQLi = $this->get_mySQLi();
       return "INSERT INTO ".self::TABLENAME."(Competency,CompetitionStudent,Point,LockField) VALUES('".$mySQLi->real_escape_string($this->Competency)."','".$mySQLi->real_escape_string($this->CompetitionStudent)."','".$mySQLi->real_escape_string($this->Point)."','".$mySQLi->real_escape_string($this->LockField)."')";}
   public function get_UpdateQuery(){
       $mySQLi = $this->get_mySQLi();
       return "UPDATE ".self::TABLENAME." SET Competency = '".$mySQLi->real_escape_string($this->Competency)."', CompetitionStudent = '".$mySQLi->real_escape_string($this->CompetitionStudent)."', Point = '".$mySQLi->real_escape_string($this->Point)."', LockField = '".$mySQLi->real_escape_string($this->LockField)."' WHERE Id = '".$mySQLi->real_escape_string($this->Id)."'";}
   protected function get_TableName(){
       return self::TABLENAME;
   }

   public static function GetObjectByKey($mySQLi, $Id){
       if($result = $mySQLi->query("SELECT * FROM ".self::TABLENAME." WHERE Id = ".$mySQLi->real_escape_string($Id)." LIMIT 1")){
           if($row = $result->fetch_array()){
               $tmpCompetitionStudentCompetency = new CompetitionStudentCompetency($mySQLi);
               $tmpCompetitionStudentCompetency->Id = $row['Id'];
               $tmpCompetitionStudentCompetency->Competency = $row['Competency'];
               $tmpCompetitionStudentCompetency->CompetitionStudent = $row['CompetitionStudent'];
               $tmpCompetitionStudentCompetency->Point = $row['Point'];

               $tmpCompetitionStudentCompetency->LockField = $row['LockField'];
               return $tmpCompetitionStudentCompetency;
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
           $CompetitionStudentCompetencys = array();
           while ($row = $result->fetch_array()){
               $tmpCompetitionStudentCompetency = new CompetitionStudentCompetency($mySQLi);
               $tmpCompetitionStudentCompetency->Id = $row['Id'];
               $tmpCompetitionStudentCompetency->LockField = $row['LockField'];
               $tmpCompetitionStudentCompetency->Competency = $row['Competency'];
               $tmpCompetitionStudentCompetency->CompetitionStudent = $row['CompetitionStudent'];
               $tmpCompetitionStudentCompetency->Point = $row['Point'];

               $CompetitionStudentCompetencys[] = $tmpCompetitionStudentCompetency;
           }
           return $CompetitionStudentCompetencys;
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