<?php include_once('BaseObject.php'); ?>
<?php include_once('Exceptions.php'); ?>
<?php
class Question extends BaseObject{
   const TABLENAME = 'Question';
   public function __construct($mySQLi){
       parent::__contruct($mySQLi);
   }
    public $Description;
    public $AnswerType;

   public function get_SaveQuery(){
       $mySQLi = $this->get_mySQLi();
       return "INSERT INTO ".self::TABLENAME."(Description,AnswerType,LockField) VALUES('".$mySQLi->real_escape_string($this->Description)."','".$mySQLi->real_escape_string($this->AnswerType)."','".$mySQLi->real_escape_string($this->LockField)."')";}
   public function get_UpdateQuery(){
       $mySQLi = $this->get_mySQLi();
       return "UPDATE ".self::TABLENAME." SET Description = '".$mySQLi->real_escape_string($this->Description)."', AnswerType = '".$mySQLi->real_escape_string($this->AnswerType)."', LockField = '".$mySQLi->real_escape_string($this->LockField)."' WHERE Id = '".$mySQLi->real_escape_string($this->Id)."'";}
   protected function get_TableName(){
       return self::TABLENAME;
   }
   public function get_QuestionAnswerList($page=0,$totalitem=0){
       return QuestionAnswerList::LoadCollection($this->get_mySQLi(),"Question = ".$this->Id,'Id DESC',$page,$totalitem);
   }
   public function get_FormQuestion($page=0,$totalitem=0){
       return FormQuestion::LoadCollection($this->get_mySQLi(),"Question = ".$this->Id,'Id DESC',$page,$totalitem);
   }
   public function get_FormResponse($page=0,$totalitem=0){
       return FormResponse::LoadCollection($this->get_mySQLi(),"Question = ".$this->Id,'Id DESC',$page,$totalitem);
   }

   public static function GetObjectByKey($mySQLi, $Id){
       if($result = $mySQLi->query("SELECT * FROM ".self::TABLENAME." WHERE Id = ".$mySQLi->real_escape_string($Id)." LIMIT 1")){
           if($row = $result->fetch_array()){
               $tmpQuestion = new Question($mySQLi);
               $tmpQuestion->Id = $row['Id'];
               $tmpQuestion->Description = $row['Description'];
               $tmpQuestion->AnswerType = $row['AnswerType'];

               $tmpQuestion->LockField = $row['LockField'];
               return $tmpQuestion;
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
           $Questions = array();
           while ($row = $result->fetch_array()){
               $tmpQuestion = new Question($mySQLi);
               $tmpQuestion->Id = $row['Id'];
               $tmpQuestion->LockField = $row['LockField'];
               $tmpQuestion->Description = $row['Description'];
               $tmpQuestion->AnswerType = $row['AnswerType'];

               $Questions[] = $tmpQuestion;
           }
           return $Questions;
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