<?php include_once('BaseObject.php'); ?>
<?php include_once('Exceptions.php'); ?>
<?php
class FormQuestion extends BaseObject{
   const TABLENAME = 'FormQuestion';
   public function __construct($mySQLi){
       parent::__contruct($mySQLi);
   }
    public $Form;
    public $Question;
    public $Sequence;

   public function get_SaveQuery(){
       $mySQLi = $this->get_mySQLi();
       return "INSERT INTO ".self::TABLENAME."(Form,Question,Sequence,LockField) VALUES('".$mySQLi->real_escape_string($this->Form)."','".$mySQLi->real_escape_string($this->Question)."','".$mySQLi->real_escape_string($this->Sequence)."','".$mySQLi->real_escape_string($this->LockField)."')";}
   public function get_UpdateQuery(){
       $mySQLi = $this->get_mySQLi();
       return "UPDATE ".self::TABLENAME." SET Form = '".$mySQLi->real_escape_string($this->Form)."', Question = '".$mySQLi->real_escape_string($this->Question)."', Sequence = '".$mySQLi->real_escape_string($this->Sequence)."', LockField = '".$mySQLi->real_escape_string($this->LockField)."' WHERE Id = '".$mySQLi->real_escape_string($this->Id)."'";}
   protected function get_TableName(){
       return self::TABLENAME;
   }

   public static function GetObjectByKey($mySQLi, $Id){
       if($result = $mySQLi->query("SELECT * FROM ".self::TABLENAME." WHERE Id = ".$mySQLi->real_escape_string($Id)." LIMIT 1")){
           if($row = $result->fetch_array()){
               $tmpFormQuestion = new FormQuestion($mySQLi);
               $tmpFormQuestion->Id = $row['Id'];
               $tmpFormQuestion->Form = $row['Form'];
               $tmpFormQuestion->Question = $row['Question'];
               $tmpFormQuestion->Sequence = $row['Sequence'];

               $tmpFormQuestion->LockField = $row['LockField'];
               return $tmpFormQuestion;
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
           $FormQuestions = array();
           while ($row = $result->fetch_array()){
               $tmpFormQuestion = new FormQuestion($mySQLi);
               $tmpFormQuestion->Id = $row['Id'];
               $tmpFormQuestion->LockField = $row['LockField'];
               $tmpFormQuestion->Form = $row['Form'];
               $tmpFormQuestion->Question = $row['Question'];
               $tmpFormQuestion->Sequence = $row['Sequence'];

               $FormQuestions[] = $tmpFormQuestion;
           }
           return $FormQuestions;
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