<?php include_once('BaseObject.php'); ?>
<?php include_once('Exceptions.php'); ?>
<?php
class SeminarParticipant extends BaseObject{
   const TABLENAME = 'SeminarParticipant';
   public function __construct($mySQLi){
       parent::__contruct($mySQLi);
   }
    public $Form;
    public $ParticipantType;
    public $Seminar;
    public $RegistrationLimit;
    public $AvailableSeat;

   public function get_SaveQuery(){
       $mySQLi = $this->get_mySQLi();
       return "INSERT INTO ".self::TABLENAME."(Form,ParticipantType,Seminar,RegistrationLimit,AvailableSeat,LockField) VALUES('".$mySQLi->real_escape_string($this->Form)."','".$mySQLi->real_escape_string($this->ParticipantType)."','".$mySQLi->real_escape_string($this->Seminar)."','".$mySQLi->real_escape_string($this->RegistrationLimit)."','".$mySQLi->real_escape_string($this->AvailableSeat)."','".$mySQLi->real_escape_string($this->LockField)."')";}
   public function get_UpdateQuery(){
       $mySQLi = $this->get_mySQLi();
       return "UPDATE ".self::TABLENAME." SET Form = '".$mySQLi->real_escape_string($this->Form)."', ParticipantType = '".$mySQLi->real_escape_string($this->ParticipantType)."', Seminar = '".$mySQLi->real_escape_string($this->Seminar)."', RegistrationLimit = '".$mySQLi->real_escape_string($this->RegistrationLimit)."', AvailableSeat = '".$mySQLi->real_escape_string($this->AvailableSeat)."', LockField = '".$mySQLi->real_escape_string($this->LockField)."' WHERE Id = '".$mySQLi->real_escape_string($this->Id)."'";}
   protected function get_TableName(){
       return self::TABLENAME;
   }

   public static function GetObjectByKey($mySQLi, $Id){
       if($result = $mySQLi->query("SELECT * FROM ".self::TABLENAME." WHERE Id = ".$mySQLi->real_escape_string($Id)." LIMIT 1")){
           if($row = $result->fetch_array()){
               $tmpSeminarParticipant = new SeminarParticipant($mySQLi);
               $tmpSeminarParticipant->Id = $row['Id'];
               $tmpSeminarParticipant->Form = $row['Form'];
               $tmpSeminarParticipant->ParticipantType = $row['ParticipantType'];
               $tmpSeminarParticipant->Seminar = $row['Seminar'];
               $tmpSeminarParticipant->RegistrationLimit = $row['RegistrationLimit'];
               $tmpSeminarParticipant->AvailableSeat = $row['AvailableSeat'];

               $tmpSeminarParticipant->LockField = $row['LockField'];
               return $tmpSeminarParticipant;
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
           $SeminarParticipants = array();
           while ($row = $result->fetch_array()){
               $tmpSeminarParticipant = new SeminarParticipant($mySQLi);
               $tmpSeminarParticipant->Id = $row['Id'];
               $tmpSeminarParticipant->LockField = $row['LockField'];
               $tmpSeminarParticipant->Form = $row['Form'];
               $tmpSeminarParticipant->ParticipantType = $row['ParticipantType'];
               $tmpSeminarParticipant->Seminar = $row['Seminar'];
               $tmpSeminarParticipant->RegistrationLimit = $row['RegistrationLimit'];
               $tmpSeminarParticipant->AvailableSeat = $row['AvailableSeat'];

               $SeminarParticipants[] = $tmpSeminarParticipant;
           }
           return $SeminarParticipants;
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