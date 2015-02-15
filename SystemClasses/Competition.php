<?php include_once('BaseObject.php'); ?>
<?php include_once('Exceptions.php'); ?>
<?php
class Competition extends BaseObject{
   const TABLENAME = 'Competition';
   public function __construct($mySQLi){
       parent::__contruct($mySQLi);
   }
    public $Location;
    public $Title;
    public $Status;
    public $Closed;
    public $End;
    public $Code;
    public $Admin;
    public $Description;
    public $Start;
    public $LastUpdate;
    public $Note;

   public function get_SaveQuery(){
       $mySQLi = $this->get_mySQLi();
       return "INSERT INTO ".self::TABLENAME."(Location,Title,Status,Closed,End,Code,Admin,Description,Start,LastUpdate,Note,LockField) VALUES('".$mySQLi->real_escape_string($this->Location)."','".$mySQLi->real_escape_string($this->Title)."','".$mySQLi->real_escape_string($this->Status)."','".$mySQLi->real_escape_string($this->Closed)."','".$mySQLi->real_escape_string(GlobalFunction::getDateQuery($this->End))."','".$mySQLi->real_escape_string($this->Code)."','".$mySQLi->real_escape_string($this->Admin)."','".$mySQLi->real_escape_string($this->Description)."','".$mySQLi->real_escape_string(GlobalFunction::getDateQuery($this->Start))."','".$mySQLi->real_escape_string(GlobalFunction::getDateQuery($this->LastUpdate))."','".$mySQLi->real_escape_string($this->Note)."','".$mySQLi->real_escape_string($this->LockField)."')";}
   public function get_UpdateQuery(){
       $mySQLi = $this->get_mySQLi();
       return "UPDATE ".self::TABLENAME." SET Location = '".$mySQLi->real_escape_string($this->Location)."', Title = '".$mySQLi->real_escape_string($this->Title)."', Status = '".$mySQLi->real_escape_string($this->Status)."', Closed = '".$mySQLi->real_escape_string($this->Closed)."', End = '".$mySQLi->real_escape_string(GlobalFunction::getDateQuery($this->End))."', Code = '".$mySQLi->real_escape_string($this->Code)."', Admin = '".$mySQLi->real_escape_string($this->Admin)."', Description = '".$mySQLi->real_escape_string($this->Description)."', Start = '".$mySQLi->real_escape_string(GlobalFunction::getDateQuery($this->Start))."', LastUpdate = '".$mySQLi->real_escape_string(GlobalFunction::getDateQuery($this->LastUpdate))."', Note = '".$mySQLi->real_escape_string($this->Note)."', LockField = '".$mySQLi->real_escape_string($this->LockField)."' WHERE Id = '".$mySQLi->real_escape_string($this->Id)."'";}
   protected function get_TableName(){
       return self::TABLENAME;
   }
   public function get_CompetitionParticipant($page=0,$totalitem=0){
       return CompetitionParticipant::LoadCollection($this->get_mySQLi(),"Competition = ".$this->Id,'Id DESC',$page,$totalitem);
   }
   public function get_CompetitionStudent($page=0,$totalitem=0){
       return CompetitionStudent::LoadCollection($this->get_mySQLi(),"Competition = ".$this->Id,'Id DESC',$page,$totalitem);
   }

   public static function GetObjectByKey($mySQLi, $Id){
       if($result = $mySQLi->query("SELECT * FROM ".self::TABLENAME." WHERE Id = ".$mySQLi->real_escape_string($Id)." LIMIT 1")){
           if($row = $result->fetch_array()){
               $tmpCompetition = new Competition($mySQLi);
               $tmpCompetition->Id = $row['Id'];
               $tmpCompetition->Location = $row['Location'];
               $tmpCompetition->Title = $row['Title'];
               $tmpCompetition->Status = $row['Status'];
               $tmpCompetition->Closed = $row['Closed'];
               $tmpCompetition->End = strtotime($row['End']);
               $tmpCompetition->Code = $row['Code'];
               $tmpCompetition->Admin = $row['Admin'];
               $tmpCompetition->Description = $row['Description'];
               $tmpCompetition->Start = strtotime($row['Start']);
               $tmpCompetition->LastUpdate = strtotime($row['LastUpdate']);
               $tmpCompetition->Note = $row['Note'];

               $tmpCompetition->LockField = $row['LockField'];
               return $tmpCompetition;
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
           $Competitions = array();
           while ($row = $result->fetch_array()){
               $tmpCompetition = new Competition($mySQLi);
               $tmpCompetition->Id = $row['Id'];
               $tmpCompetition->LockField = $row['LockField'];
               $tmpCompetition->Location = $row['Location'];
               $tmpCompetition->Title = $row['Title'];
               $tmpCompetition->Status = $row['Status'];
               $tmpCompetition->Closed = $row['Closed'];
               $tmpCompetition->End = strtotime($row['End']);
               $tmpCompetition->Code = $row['Code'];
               $tmpCompetition->Admin = $row['Admin'];
               $tmpCompetition->Description = $row['Description'];
               $tmpCompetition->Start = strtotime($row['Start']);
               $tmpCompetition->LastUpdate = strtotime($row['LastUpdate']);
               $tmpCompetition->Note = $row['Note'];

               $Competitions[] = $tmpCompetition;
           }
           return $Competitions;
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