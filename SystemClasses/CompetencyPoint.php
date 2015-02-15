<?php include_once('BaseObject.php'); ?>
<?php include_once('Exceptions.php'); ?>
<?php include_once('GlobalFunction.php'); ?>
<?php
class CompetencyPoint extends BaseObject{
   const TABLENAME = 'CompetencyPoint';
   public function __construct($mySQLi){
       parent::__contruct($mySQLi);
   }
    public $ParticipantType;
    public $Admin;
    public $LastUpdate;
    public $Point;
    public $Period;
    public $Competency;

   public function get_SaveQuery(){
       $mySQLi = $this->get_mySQLi();
       return "INSERT INTO ".self::TABLENAME."(ParticipantType,Admin,LastUpdate,Point,Period,Competency,LockField) VALUES('".$mySQLi->real_escape_string($this->ParticipantType)."','".$mySQLi->real_escape_string($this->Admin)."','".$mySQLi->real_escape_string(GlobalFunction::getDateQuery($this->LastUpdate))."','".$mySQLi->real_escape_string($this->Point)."','".$mySQLi->real_escape_string($this->Period)."','".$mySQLi->real_escape_string($this->Competency)."','".$mySQLi->real_escape_string($this->LockField)."')";}
   public function get_UpdateQuery(){
       $mySQLi = $this->get_mySQLi();
       return "UPDATE ".self::TABLENAME." SET ParticipantType = '".$mySQLi->real_escape_string($this->ParticipantType)."', Admin = '".$mySQLi->real_escape_string($this->Admin)."', LastUpdate = '".$mySQLi->real_escape_string(GlobalFunction::getDateQuery($this->LastUpdate))."', Point = '".$mySQLi->real_escape_string($this->Point)."', Period = '".$mySQLi->real_escape_string($this->Period)."', Competency = '".$mySQLi->real_escape_string($this->Competency)."', LockField = '".$mySQLi->real_escape_string($this->LockField)."' WHERE Id = '".$mySQLi->real_escape_string($this->Id)."'";}
   protected function get_TableName(){
       return self::TABLENAME;
   }

   public static function GetObjectByKey($mySQLi, $Id){
       if($result = $mySQLi->query("SELECT * FROM ".self::TABLENAME." WHERE Id = ".$mySQLi->real_escape_string($Id)." LIMIT 1")){
           if($row = $result->fetch_array()){
               $tmpCompetencyPoint = new CompetencyPoint($mySQLi);
               $tmpCompetencyPoint->Id = $row['Id'];
               $tmpCompetencyPoint->ParticipantType = $row['ParticipantType'];
               $tmpCompetencyPoint->Admin = $row['Admin'];
               $tmpCompetencyPoint->LastUpdate = strtotime($row['LastUpdate']);
               $tmpCompetencyPoint->Point = $row['Point'];
               $tmpCompetencyPoint->Period = $row['Period'];
               $tmpCompetencyPoint->Competency = $row['Competency'];

               $tmpCompetencyPoint->LockField = $row['LockField'];
               return $tmpCompetencyPoint;
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
           $CompetencyPoints = array();
           while ($row = $result->fetch_array()){
               $tmpCompetencyPoint = new CompetencyPoint($mySQLi);
               $tmpCompetencyPoint->Id = $row['Id'];
               $tmpCompetencyPoint->LockField = $row['LockField'];
               $tmpCompetencyPoint->ParticipantType = $row['ParticipantType'];
               $tmpCompetencyPoint->Admin = $row['Admin'];
               $tmpCompetencyPoint->LastUpdate = strtotime($row['LastUpdate']);
               $tmpCompetencyPoint->Point = $row['Point'];
               $tmpCompetencyPoint->Period = $row['Period'];
               $tmpCompetencyPoint->Competency = $row['Competency'];

               $CompetencyPoints[] = $tmpCompetencyPoint;
           }
           return $CompetencyPoints;
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