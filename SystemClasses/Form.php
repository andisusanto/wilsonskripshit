<?php include_once('BaseObject.php'); ?>
<?php include_once('Exceptions.php'); ?>
<?php
class Form extends BaseObject{
   const TABLENAME = 'Form';
   public function __construct($mySQLi){
       parent::__contruct($mySQLi);
   }
    public $Code;
    public $Name;

   public function get_SaveQuery(){
       $mySQLi = $this->get_mySQLi();
       return "INSERT INTO ".self::TABLENAME."(Code,Name,LockField) VALUES('".$mySQLi->real_escape_string($this->Code)."','".$mySQLi->real_escape_string($this->Name)."','".$mySQLi->real_escape_string($this->LockField)."')";}
   public function get_UpdateQuery(){
       $mySQLi = $this->get_mySQLi();
       return "UPDATE ".self::TABLENAME." SET Code = '".$mySQLi->real_escape_string($this->Code)."', Name = '".$mySQLi->real_escape_string($this->Name)."', LockField = '".$mySQLi->real_escape_string($this->LockField)."' WHERE Id = '".$mySQLi->real_escape_string($this->Id)."'";}
   protected function get_TableName(){
       return self::TABLENAME;
   }
   public function get_SeminarParticipant($page=0,$totalitem=0){
       return SeminarParticipant::LoadCollection($this->get_mySQLi(),"Form = ".$this->Id,'Id DESC',$page,$totalitem);
   }
   public function get_CompetitionParticipant($page=0,$totalitem=0){
       return CompetitionParticipant::LoadCollection($this->get_mySQLi(),"Form = ".$this->Id,'Id DESC',$page,$totalitem);
   }
   public function get_FormQuestion($page=0,$totalitem=0){
       return FormQuestion::LoadCollection($this->get_mySQLi(),"Form = ".$this->Id,'Id DESC',$page,$totalitem);
   }

   public static function GetObjectByKey($mySQLi, $Id){
       if($result = $mySQLi->query("SELECT * FROM ".self::TABLENAME." WHERE Id = ".$mySQLi->real_escape_string($Id)." LIMIT 1")){
           if($row = $result->fetch_array()){
               $tmpForm = new Form($mySQLi);
               $tmpForm->Id = $row['Id'];
               $tmpForm->Code = $row['Code'];
               $tmpForm->Name = $row['Name'];

               $tmpForm->LockField = $row['LockField'];
               return $tmpForm;
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
           $Forms = array();
           while ($row = $result->fetch_array()){
               $tmpForm = new Form($mySQLi);
               $tmpForm->Id = $row['Id'];
               $tmpForm->LockField = $row['LockField'];
               $tmpForm->Code = $row['Code'];
               $tmpForm->Name = $row['Name'];

               $Forms[] = $tmpForm;
           }
           return $Forms;
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