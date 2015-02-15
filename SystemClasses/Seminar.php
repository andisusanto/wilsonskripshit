<?php include_once('BaseObject.php'); ?>
<?php include_once('Exceptions.php'); ?>
<?php
class Seminar extends BaseObject{
   const TABLENAME = 'Seminar';
   public function __construct($mySQLi){
       parent::__contruct($mySQLi);
   }
    public $Note;
    public $LastUpdate;
    public $Admin;
    public $End;
    public $Closed;
    public $Status;
    public $Code;
    public $Title;
    public $Location;
    public $Description;
    public $Start;

   public function get_SaveQuery(){
       $mySQLi = $this->get_mySQLi();
       return "INSERT INTO ".self::TABLENAME."(Note,LastUpdate,Admin,End,Closed,Status,Code,Title,Location,Description,Start,LockField) VALUES('".$mySQLi->real_escape_string($this->Note)."','".$mySQLi->real_escape_string(GlobalFunction::getDateQuery($this->LastUpdate))."','".$mySQLi->real_escape_string($this->Admin)."','".$mySQLi->real_escape_string(GlobalFunction::getDateQuery($this->End))."','".$mySQLi->real_escape_string($this->Closed)."','".$mySQLi->real_escape_string($this->Status)."','".$mySQLi->real_escape_string($this->Code)."','".$mySQLi->real_escape_string($this->Title)."','".$mySQLi->real_escape_string($this->Location)."','".$mySQLi->real_escape_string($this->Description)."','".$mySQLi->real_escape_string(GlobalFunction::getDateQuery($this->Start))."','".$mySQLi->real_escape_string($this->LockField)."')";}
   public function get_UpdateQuery(){
       $mySQLi = $this->get_mySQLi();
       return "UPDATE ".self::TABLENAME." SET Note = '".$mySQLi->real_escape_string($this->Note)."', LastUpdate = '".$mySQLi->real_escape_string(GlobalFunction::getDateQuery($this->LastUpdate))."', Admin = '".$mySQLi->real_escape_string($this->Admin)."', End = '".$mySQLi->real_escape_string(GlobalFunction::getDateQuery($this->End))."', Closed = '".$mySQLi->real_escape_string($this->Closed)."', Status = '".$mySQLi->real_escape_string($this->Status)."', Code = '".$mySQLi->real_escape_string($this->Code)."', Title = '".$mySQLi->real_escape_string($this->Title)."', Location = '".$mySQLi->real_escape_string($this->Location)."', Description = '".$mySQLi->real_escape_string($this->Description)."', Start = '".$mySQLi->real_escape_string(GlobalFunction::getDateQuery($this->Start))."', LockField = '".$mySQLi->real_escape_string($this->LockField)."' WHERE Id = '".$mySQLi->real_escape_string($this->Id)."'";}
   protected function get_TableName(){
       return self::TABLENAME;
   }
   public function get_SeminarCompetency($page=0,$totalitem=0){
       return SeminarCompetency::LoadCollection($this->get_mySQLi(),"Seminar = ".$this->Id,'Id DESC',$page,$totalitem);
   }
   public function get_SeminarStudent($page=0,$totalitem=0){
       return SeminarStudent::LoadCollection($this->get_mySQLi(),"Seminar = ".$this->Id,'Id DESC',$page,$totalitem);
   }
   public function get_SeminarParticipant($page=0,$totalitem=0){
       return SeminarParticipant::LoadCollection($this->get_mySQLi(),"Seminar = ".$this->Id,'Id DESC',$page,$totalitem);
   }

   public static function GetObjectByKey($mySQLi, $Id){
       if($result = $mySQLi->query("SELECT * FROM ".self::TABLENAME." WHERE Id = ".$mySQLi->real_escape_string($Id)." LIMIT 1")){
           if($row = $result->fetch_array()){
               $tmpSeminar = new Seminar($mySQLi);
               $tmpSeminar->Id = $row['Id'];
               $tmpSeminar->Note = $row['Note'];
               $tmpSeminar->LastUpdate = strtotime($row['LastUpdate']);
               $tmpSeminar->Admin = $row['Admin'];
               $tmpSeminar->End = strtotime($row['End']);
               $tmpSeminar->Closed = $row['Closed'];
               $tmpSeminar->Status = $row['Status'];
               $tmpSeminar->Code = $row['Code'];
               $tmpSeminar->Title = $row['Title'];
               $tmpSeminar->Location = $row['Location'];
               $tmpSeminar->Description = $row['Description'];
               $tmpSeminar->Start = strtotime($row['Start']);

               $tmpSeminar->LockField = $row['LockField'];
               return $tmpSeminar;
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
           $Seminars = array();
           while ($row = $result->fetch_array()){
               $tmpSeminar = new Seminar($mySQLi);
               $tmpSeminar->Id = $row['Id'];
               $tmpSeminar->LockField = $row['LockField'];
               $tmpSeminar->Note = $row['Note'];
               $tmpSeminar->LastUpdate = strtotime($row['LastUpdate']);
               $tmpSeminar->Admin = $row['Admin'];
               $tmpSeminar->End = strtotime($row['End']);
               $tmpSeminar->Closed = $row['Closed'];
               $tmpSeminar->Status = $row['Status'];
               $tmpSeminar->Code = $row['Code'];
               $tmpSeminar->Title = $row['Title'];
               $tmpSeminar->Location = $row['Location'];
               $tmpSeminar->Description = $row['Description'];
               $tmpSeminar->Start = strtotime($row['Start']);

               $Seminars[] = $tmpSeminar;
           }
           return $Seminars;
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