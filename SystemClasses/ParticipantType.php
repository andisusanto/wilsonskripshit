<?php include_once('BaseObject.php'); ?>
<?php include_once('Exceptions.php'); ?>
<?php
class ParticipantType extends BaseObject{
   const TABLENAME = 'ParticipantType';
   public function __construct($mySQLi){
       parent::__contruct($mySQLi);
   }
    public $Name;
    public $Code;

   public function get_SaveQuery(){
       $mySQLi = $this->get_mySQLi();
       return "INSERT INTO ".self::TABLENAME."(Name,Code,LockField) VALUES('".$mySQLi->real_escape_string($this->Name)."','".$mySQLi->real_escape_string($this->Code)."','".$mySQLi->real_escape_string($this->LockField)."')";}
   public function get_UpdateQuery(){
       $mySQLi = $this->get_mySQLi();
       return "UPDATE ".self::TABLENAME." SET Name = '".$mySQLi->real_escape_string($this->Name)."', Code = '".$mySQLi->real_escape_string($this->Code)."', LockField = '".$mySQLi->real_escape_string($this->LockField)."' WHERE Id = '".$mySQLi->real_escape_string($this->Id)."'";}
   protected function get_TableName(){
       return self::TABLENAME;
   }
   public function get_CompetitionStudent($page=0,$totalitem=0){
       return CompetitionStudent::LoadCollection($this->get_mySQLi(),"ParticipantType = ".$this->Id,'Id DESC',$page,$totalitem);
   }
   public function get_SeminarStudent($page=0,$totalitem=0){
       return SeminarStudent::LoadCollection($this->get_mySQLi(),"ParticipantType = ".$this->Id,'Id DESC',$page,$totalitem);
   }
   public function get_CompetencyPoint($page=0,$totalitem=0){
       return CompetencyPoint::LoadCollection($this->get_mySQLi(),"ParticipantType = ".$this->Id,'Id DESC',$page,$totalitem);
   }
   public function get_SeminarParticipant($page=0,$totalitem=0){
       return SeminarParticipant::LoadCollection($this->get_mySQLi(),"ParticipantType = ".$this->Id,'Id DESC',$page,$totalitem);
   }
   public function get_CompetitionParticipant($page=0,$totalitem=0){
       return CompetitionParticipant::LoadCollection($this->get_mySQLi(),"ParticipantType = ".$this->Id,'Id DESC',$page,$totalitem);
   }

   public static function GetObjectByKey($mySQLi, $Id){
       if($result = $mySQLi->query("SELECT * FROM ".self::TABLENAME." WHERE Id = ".$mySQLi->real_escape_string($Id)." LIMIT 1")){
           if($row = $result->fetch_array()){
               $tmpParticipantType = new ParticipantType($mySQLi);
               $tmpParticipantType->Id = $row['Id'];
               $tmpParticipantType->Name = $row['Name'];
               $tmpParticipantType->Code = $row['Code'];

               $tmpParticipantType->LockField = $row['LockField'];
               return $tmpParticipantType;
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
           $ParticipantTypes = array();
           while ($row = $result->fetch_array()){
               $tmpParticipantType = new ParticipantType($mySQLi);
               $tmpParticipantType->Id = $row['Id'];
               $tmpParticipantType->LockField = $row['LockField'];
               $tmpParticipantType->Name = $row['Name'];
               $tmpParticipantType->Code = $row['Code'];

               $ParticipantTypes[] = $tmpParticipantType;
           }
           return $ParticipantTypes;
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