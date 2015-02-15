<?php include_once('BaseObject.php'); ?>
<?php include_once('Exceptions.php'); ?>
<?php include_once('GlobalFunction.php'); ?>
<?php
class Activity extends BaseObject{
   const TABLENAME = 'Activity';
   public function __construct($mySQLi){
       parent::__contruct($mySQLi);
   }
    public $Admin;
    public $Closed;
    public $Code;
    public $Date;
    public $Description;
    public $End;
    public $LastUpdate;
    public $Location;
    public $Note;
    public $Period;
    public $Publish;
    public $Start;
    public $Title;
    public $Type;

   public function get_SaveQuery(){
       $mySQLi = $this->get_mySQLi();
       return "INSERT INTO ".self::TABLENAME."(Admin,Closed,Code,Date,Description,End,LastUpdate,Location,Note,Period,Publish,Start,Title,Type,LockField) VALUES('".$mySQLi->real_escape_string($this->Admin)."','".$mySQLi->real_escape_string($this->Closed)."','".$mySQLi->real_escape_string($this->Code)."','".$mySQLi->real_escape_string($this->Date)."','".$mySQLi->real_escape_string($this->Description)."','".$mySQLi->real_escape_string($this->End)."','".$mySQLi->real_escape_string($this->LastUpdate)."','".$mySQLi->real_escape_string($this->Location)."','".$mySQLi->real_escape_string($this->Note)."','".$mySQLi->real_escape_string($this->Period)."','".$mySQLi->real_escape_string($this->Publish)."','".$mySQLi->real_escape_string($this->Start)."','".$mySQLi->real_escape_string($this->Title)."','".$mySQLi->real_escape_string($this->Type)."','".$mySQLi->real_escape_string($this->LockField)."')";}
   public function get_UpdateQuery(){
       $mySQLi = $this->get_mySQLi();
       return "UPDATE ".self::TABLENAME." SET Admin = '".$mySQLi->real_escape_string($this->Admin)."', Closed = '".$mySQLi->real_escape_string($this->Closed)."', Code = '".$mySQLi->real_escape_string($this->Code)."', Date = '".$mySQLi->real_escape_string($this->Date)."', Description = '".$mySQLi->real_escape_string($this->Description)."', End = '".$mySQLi->real_escape_string($this->End)."', LastUpdate = '".$mySQLi->real_escape_string($this->LastUpdate)."', Location = '".$mySQLi->real_escape_string($this->Location)."', Note = '".$mySQLi->real_escape_string($this->Note)."', Period = '".$mySQLi->real_escape_string($this->Period)."', Publish = '".$mySQLi->real_escape_string($this->Publish)."', Start = '".$mySQLi->real_escape_string($this->Start)."', Title = '".$mySQLi->real_escape_string($this->Title)."', Type = '".$mySQLi->real_escape_string($this->Type)."', LockField = '".$mySQLi->real_escape_string($this->LockField)."' WHERE Id = '".$mySQLi->real_escape_string($this->Id)."'";}
   protected function get_TableName(){
       return self::TABLENAME;
   }
   public function get_ActivityParticipant($page=0,$totalitem=0){
       return ActivityParticipant::LoadCollection($this->get_mySQLi(),"Activity = ".$this->Id,'Id DESC',$page,$totalitem);
   }
   public function get_ActivityCompetency($page=0,$totalitem=0){
       return ActivityCompetency::LoadCollection($this->get_mySQLi(),"Activity = ".$this->Id,'Id DESC',$page,$totalitem);
   }

   public static function GetObjectByKey($mySQLi, $Id){
       if($result = $mySQLi->query("SELECT * FROM ".self::TABLENAME." WHERE Id = ".$mySQLi->real_escape_string($Id)." LIMIT 1")){
           if($row = $result->fetch_array()){
               $tmpActivity = new Activity($mySQLi);
               $tmpActivity->Id = $row['Id'];
               $tmpActivity->Admin = $row['Admin'];
               $tmpActivity->Closed = $row['Closed'];
               $tmpActivity->Code = $row['Code'];
               $tmpActivity->Date = $row['Date'];
               $tmpActivity->Description = $row['Description'];
               $tmpActivity->End = $row['End'];
               $tmpActivity->LastUpdate = $row['LastUpdate'];
               $tmpActivity->Location = $row['Location'];
               $tmpActivity->Note = $row['Note'];
               $tmpActivity->Period = $row['Period'];
               $tmpActivity->Publish = $row['Publish'];
               $tmpActivity->Start = $row['Start'];
               $tmpActivity->Title = $row['Title'];
               $tmpActivity->Type = $row['Type'];

               $tmpActivity->LockField = $row['LockField'];
               return $tmpActivity;
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
           $Activitys = array();
           while ($row = $result->fetch_array()){
               $tmpActivity = new Activity($mySQLi);
               $tmpActivity->Id = $row['Id'];
               $tmpActivity->LockField = $row['LockField'];
               $tmpActivity->Admin = $row['Admin'];
               $tmpActivity->Closed = $row['Closed'];
               $tmpActivity->Code = $row['Code'];
               $tmpActivity->Date = $row['Date'];
               $tmpActivity->Description = $row['Description'];
               $tmpActivity->End = $row['End'];
               $tmpActivity->LastUpdate = $row['LastUpdate'];
               $tmpActivity->Location = $row['Location'];
               $tmpActivity->Note = $row['Note'];
               $tmpActivity->Period = $row['Period'];
               $tmpActivity->Publish = $row['Publish'];
               $tmpActivity->Start = $row['Start'];
               $tmpActivity->Title = $row['Title'];
               $tmpActivity->Type = $row['Type'];

               $Activitys[] = $tmpActivity;
           }
           return $Activitys;
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