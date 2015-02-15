<?php include_once('BaseObject.php'); ?>
<?php include_once('Exceptions.php'); ?>
<?php
class ActivityParticipant extends BaseObject{
   const TABLENAME = 'ActivityParticipant';
   public function __construct($mySQLi){
       parent::__contruct($mySQLi);
   }
    public $AvailableSeat;
    public $Activity;
    public $ParticipantType;
    public $RegistrationLimit;

   public function get_SaveQuery(){
       $mySQLi = $this->get_mySQLi();
       return "INSERT INTO ".self::TABLENAME."(AvailableSeat,Activity,ParticipantType,RegistrationLimit,LockField) VALUES('".$mySQLi->real_escape_string($this->AvailableSeat)."','".$mySQLi->real_escape_string($this->Activity)."','".$mySQLi->real_escape_string($this->ParticipantType)."','".$mySQLi->real_escape_string($this->RegistrationLimit)."','".$mySQLi->real_escape_string($this->LockField)."')";}
   public function get_UpdateQuery(){
       $mySQLi = $this->get_mySQLi();
       return "UPDATE ".self::TABLENAME." SET AvailableSeat = '".$mySQLi->real_escape_string($this->AvailableSeat)."', Activity = '".$mySQLi->real_escape_string($this->Activity)."', ParticipantType = '".$mySQLi->real_escape_string($this->ParticipantType)."', RegistrationLimit = '".$mySQLi->real_escape_string($this->RegistrationLimit)."', LockField = '".$mySQLi->real_escape_string($this->LockField)."' WHERE Id = '".$mySQLi->real_escape_string($this->Id)."'";}
   protected function get_TableName(){
       return self::TABLENAME;
   }

   public static function GetObjectByKey($mySQLi, $Id){
       if($result = $mySQLi->query("SELECT * FROM ".self::TABLENAME." WHERE Id = ".$mySQLi->real_escape_string($Id)." LIMIT 1")){
           if($row = $result->fetch_array()){
               $tmpActivityParticipant = new ActivityParticipant($mySQLi);
               $tmpActivityParticipant->Id = $row['Id'];
               $tmpActivityParticipant->AvailableSeat = $row['AvailableSeat'];
               $tmpActivityParticipant->Activity = $row['Activity'];
               $tmpActivityParticipant->ParticipantType = $row['ParticipantType'];
               $tmpActivityParticipant->RegistrationLimit = $row['RegistrationLimit'];

               $tmpActivityParticipant->LockField = $row['LockField'];
               return $tmpActivityParticipant;
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
           $ActivityParticipants = array();
           while ($row = $result->fetch_array()){
               $tmpActivityParticipant = new ActivityParticipant($mySQLi);
               $tmpActivityParticipant->Id = $row['Id'];
               $tmpActivityParticipant->LockField = $row['LockField'];
               $tmpActivityParticipant->AvailableSeat = $row['AvailableSeat'];
               $tmpActivityParticipant->Activity = $row['Activity'];
               $tmpActivityParticipant->ParticipantType = $row['ParticipantType'];
               $tmpActivityParticipant->RegistrationLimit = $row['RegistrationLimit'];

               $ActivityParticipants[] = $tmpActivityParticipant;
           }
           return $ActivityParticipants;
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