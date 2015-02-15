<?php include_once('BaseObject.php'); ?>
<?php include_once('Exceptions.php'); ?>
<?php
class FieldsOfStudy extends BaseObject{
   const TABLENAME = 'FieldsOfStudy';
   public function __construct($mySQLi){
       parent::__contruct($mySQLi);
   }
    public $Code;
    public $IndonesianName;
    public $Name;

   public function get_SaveQuery(){
       $mySQLi = $this->get_mySQLi();
       return "INSERT INTO ".self::TABLENAME."(Code,IndonesianName,Name,LockField) VALUES('".$mySQLi->real_escape_string($this->Code)."','".$mySQLi->real_escape_string($this->IndonesianName)."','".$mySQLi->real_escape_string($this->Name)."','".$mySQLi->real_escape_string($this->LockField)."')";}
   public function get_UpdateQuery(){
       $mySQLi = $this->get_mySQLi();
       return "UPDATE ".self::TABLENAME." SET Code = '".$mySQLi->real_escape_string($this->Code)."', IndonesianName = '".$mySQLi->real_escape_string($this->IndonesianName)."', Name = '".$mySQLi->real_escape_string($this->Name)."', LockField = '".$mySQLi->real_escape_string($this->LockField)."' WHERE Id = '".$mySQLi->real_escape_string($this->Id)."'";}
   protected function get_TableName(){
       return self::TABLENAME;
   }
   public function get_Student($page=0,$totalitem=0){
       return Student::LoadCollection($this->get_mySQLi(),"FieldsOfStudy = ".$this->Id,'Id DESC',$page,$totalitem);
   }
   public function get_Subject($page=0,$totalitem=0){
       return Subject::LoadCollection($this->get_mySQLi(),"FieldsOfStudy = ".$this->Id,'Id DESC',$page,$totalitem);
   }

   public static function GetObjectByKey($mySQLi, $Id){
       if($result = $mySQLi->query("SELECT * FROM ".self::TABLENAME." WHERE Id = ".$mySQLi->real_escape_string($Id)." LIMIT 1")){
           if($row = $result->fetch_array()){
               $tmpFieldsOfStudy = new FieldsOfStudy($mySQLi);
               $tmpFieldsOfStudy->Id = $row['Id'];
               $tmpFieldsOfStudy->Code = $row['Code'];
               $tmpFieldsOfStudy->IndonesianName = $row['IndonesianName'];
               $tmpFieldsOfStudy->Name = $row['Name'];

               $tmpFieldsOfStudy->LockField = $row['LockField'];
               return $tmpFieldsOfStudy;
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
           $FieldsOfStudys = array();
           while ($row = $result->fetch_array()){
               $tmpFieldsOfStudy = new FieldsOfStudy($mySQLi);
               $tmpFieldsOfStudy->Id = $row['Id'];
               $tmpFieldsOfStudy->LockField = $row['LockField'];
               $tmpFieldsOfStudy->Code = $row['Code'];
               $tmpFieldsOfStudy->IndonesianName = $row['IndonesianName'];
               $tmpFieldsOfStudy->Name = $row['Name'];

               $FieldsOfStudys[] = $tmpFieldsOfStudy;
           }
           return $FieldsOfStudys;
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