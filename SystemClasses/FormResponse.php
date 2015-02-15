<?php include_once('BaseObject.php'); ?>
<?php include_once('Exceptions.php'); ?>
<?php
class FormResponse extends BaseObject{
   const TABLENAME = 'FormResponse';
   public function __construct($mySQLi){
       parent::__contruct($mySQLi);
   }
    public $Answer;
    public $Sequence;
    public $Question;

   public function get_SaveQuery(){
       $mySQLi = $this->get_mySQLi();
       return "INSERT INTO ".self::TABLENAME."(Answer,Sequence,Question,LockField) VALUES('".$mySQLi->real_escape_string($this->Answer)."','".$mySQLi->real_escape_string($this->Sequence)."','".$mySQLi->real_escape_string($this->Question)."','".$mySQLi->real_escape_string($this->LockField)."')";}
   public function get_UpdateQuery(){
       $mySQLi = $this->get_mySQLi();
       return "UPDATE ".self::TABLENAME." SET Answer = '".$mySQLi->real_escape_string($this->Answer)."', Sequence = '".$mySQLi->real_escape_string($this->Sequence)."', Question = '".$mySQLi->real_escape_string($this->Question)."', LockField = '".$mySQLi->real_escape_string($this->LockField)."' WHERE Id = '".$mySQLi->real_escape_string($this->Id)."'";}
   protected function get_TableName(){
       return self::TABLENAME;
   }
   public function get_CompetitionStudent($page=0,$totalitem=0){
       return CompetitionStudent::LoadCollection($this->get_mySQLi(),"FormResponse = ".$this->Id,'Id DESC',$page,$totalitem);
   }
   public function get_SeminarStudent($page=0,$totalitem=0){
       return SeminarStudent::LoadCollection($this->get_mySQLi(),"FormResponse = ".$this->Id,'Id DESC',$page,$totalitem);
   }

   public static function GetObjectByKey($mySQLi, $Id){
       if($result = $mySQLi->query("SELECT * FROM ".self::TABLENAME." WHERE Id = ".$mySQLi->real_escape_string($Id)." LIMIT 1")){
           if($row = $result->fetch_array()){
               $tmpFormResponse = new FormResponse($mySQLi);
               $tmpFormResponse->Id = $row['Id'];
               $tmpFormResponse->Answer = $row['Answer'];
               $tmpFormResponse->Sequence = $row['Sequence'];
               $tmpFormResponse->Question = $row['Question'];

               $tmpFormResponse->LockField = $row['LockField'];
               return $tmpFormResponse;
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
           $FormResponses = array();
           while ($row = $result->fetch_array()){
               $tmpFormResponse = new FormResponse($mySQLi);
               $tmpFormResponse->Id = $row['Id'];
               $tmpFormResponse->LockField = $row['LockField'];
               $tmpFormResponse->Answer = $row['Answer'];
               $tmpFormResponse->Sequence = $row['Sequence'];
               $tmpFormResponse->Question = $row['Question'];

               $FormResponses[] = $tmpFormResponse;
           }
           return $FormResponses;
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