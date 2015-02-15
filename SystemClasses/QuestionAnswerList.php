<?php include_once('BaseObject.php'); ?>
<?php include_once('Exceptions.php'); ?>
<?php
class QuestionAnswerList extends BaseObject{
   const TABLENAME = 'QuestionAnswerList';
   public function __construct($mySQLi){
       parent::__contruct($mySQLi);
   }
    public $Question;
    public $Description;

   public function get_SaveQuery(){
       $mySQLi = $this->get_mySQLi();
       return "INSERT INTO ".self::TABLENAME."(Question,Description,LockField) VALUES('".$mySQLi->real_escape_string($this->Question)."','".$mySQLi->real_escape_string($this->Description)."','".$mySQLi->real_escape_string($this->LockField)."')";}
   public function get_UpdateQuery(){
       $mySQLi = $this->get_mySQLi();
       return "UPDATE ".self::TABLENAME." SET Question = '".$mySQLi->real_escape_string($this->Question)."', Description = '".$mySQLi->real_escape_string($this->Description)."', LockField = '".$mySQLi->real_escape_string($this->LockField)."' WHERE Id = '".$mySQLi->real_escape_string($this->Id)."'";}
   protected function get_TableName(){
       return self::TABLENAME;
   }

   public static function GetObjectByKey($mySQLi, $Id){
       if($result = $mySQLi->query("SELECT * FROM ".self::TABLENAME." WHERE Id = ".$mySQLi->real_escape_string($Id)." LIMIT 1")){
           if($row = $result->fetch_array()){
               $tmpQuestionAnswerList = new QuestionAnswerList($mySQLi);
               $tmpQuestionAnswerList->Id = $row['Id'];
               $tmpQuestionAnswerList->Question = $row['Question'];
               $tmpQuestionAnswerList->Description = $row['Description'];

               $tmpQuestionAnswerList->LockField = $row['LockField'];
               return $tmpQuestionAnswerList;
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
           $QuestionAnswerLists = array();
           while ($row = $result->fetch_array()){
               $tmpQuestionAnswerList = new QuestionAnswerList($mySQLi);
               $tmpQuestionAnswerList->Id = $row['Id'];
               $tmpQuestionAnswerList->LockField = $row['LockField'];
               $tmpQuestionAnswerList->Question = $row['Question'];
               $tmpQuestionAnswerList->Description = $row['Description'];

               $QuestionAnswerLists[] = $tmpQuestionAnswerList;
           }
           return $QuestionAnswerLists;
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