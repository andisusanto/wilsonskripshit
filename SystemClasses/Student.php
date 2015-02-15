<?php include_once('BaseObject.php'); ?>
<?php include_once('Exceptions.php'); ?>
<?php
class Student extends BaseObject{
   const TABLENAME = 'Student';
   public function __construct($mySQLi){
       parent::__contruct($mySQLi);
   }
    public $Address;
    public $ContactNo01;
    public $ContactNo02;
    public $Email;
    public $FieldsOfStudy;
    public $Gender;
    public $IDCardNo;
    public $Name;
    public $No;
    public $Password;
    public $Username;

   public function get_SaveQuery(){
       $mySQLi = $this->get_mySQLi();
       return "INSERT INTO ".self::TABLENAME."(Address,ContactNo01,ContactNo02,Email,FieldsOfStudy,Gender,IDCardNo,Name,No,Password,Username,LockField) VALUES('".$mySQLi->real_escape_string($this->Address)."','".$mySQLi->real_escape_string($this->ContactNo01)."','".$mySQLi->real_escape_string($this->ContactNo02)."','".$mySQLi->real_escape_string($this->Email)."','".$mySQLi->real_escape_string($this->FieldsOfStudy)."','".$mySQLi->real_escape_string($this->Gender)."','".$mySQLi->real_escape_string($this->IDCardNo)."','".$mySQLi->real_escape_string($this->Name)."','".$mySQLi->real_escape_string($this->No)."','".$mySQLi->real_escape_string($this->Password)."','".$mySQLi->real_escape_string($this->Username)."','".$mySQLi->real_escape_string($this->LockField)."')";}
   public function get_UpdateQuery(){
       $mySQLi = $this->get_mySQLi();
       return "UPDATE ".self::TABLENAME." SET Address = '".$mySQLi->real_escape_string($this->Address)."', ContactNo01 = '".$mySQLi->real_escape_string($this->ContactNo01)."', ContactNo02 = '".$mySQLi->real_escape_string($this->ContactNo02)."', Email = '".$mySQLi->real_escape_string($this->Email)."', FieldsOfStudy = '".$mySQLi->real_escape_string($this->FieldsOfStudy)."', Gender = '".$mySQLi->real_escape_string($this->Gender)."', IDCardNo = '".$mySQLi->real_escape_string($this->IDCardNo)."', Name = '".$mySQLi->real_escape_string($this->Name)."', No = '".$mySQLi->real_escape_string($this->No)."', Password = '".$mySQLi->real_escape_string($this->Password)."', Username = '".$mySQLi->real_escape_string($this->Username)."', LockField = '".$mySQLi->real_escape_string($this->LockField)."' WHERE Id = '".$mySQLi->real_escape_string($this->Id)."'";}
   protected function get_TableName(){
       return self::TABLENAME;
   }
   public function get_CompetitionStudent($page=0,$totalitem=0){
       return CompetitionStudent::LoadCollection($this->get_mySQLi(),"Student = ".$this->Id,'Id DESC',$page,$totalitem);
   }
   public function get_SeminarStudent($page=0,$totalitem=0){
       return SeminarStudent::LoadCollection($this->get_mySQLi(),"Student = ".$this->Id,'Id DESC',$page,$totalitem);
   }

   public static function GetObjectByKey($mySQLi, $Id){
       if($result = $mySQLi->query("SELECT * FROM ".self::TABLENAME." WHERE Id = ".$mySQLi->real_escape_string($Id)." LIMIT 1")){
           if($row = $result->fetch_array()){
               $tmpStudent = new Student($mySQLi);
               $tmpStudent->Id = $row['Id'];
               $tmpStudent->Address = $row['Address'];
               $tmpStudent->ContactNo01 = $row['ContactNo01'];
               $tmpStudent->ContactNo02 = $row['ContactNo02'];
               $tmpStudent->Email = $row['Email'];
               $tmpStudent->FieldsOfStudy = $row['FieldsOfStudy'];
               $tmpStudent->Gender = $row['Gender'];
               $tmpStudent->IDCardNo = $row['IDCardNo'];
               $tmpStudent->Name = $row['Name'];
               $tmpStudent->No = $row['No'];
               $tmpStudent->Password = $row['Password'];
               $tmpStudent->Username = $row['Username'];

               $tmpStudent->LockField = $row['LockField'];
               return $tmpStudent;
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
           $Students = array();
           while ($row = $result->fetch_array()){
               $tmpStudent = new Student($mySQLi);
               $tmpStudent->Id = $row['Id'];
               $tmpStudent->LockField = $row['LockField'];
               $tmpStudent->Address = $row['Address'];
               $tmpStudent->ContactNo01 = $row['ContactNo01'];
               $tmpStudent->ContactNo02 = $row['ContactNo02'];
               $tmpStudent->Email = $row['Email'];
               $tmpStudent->FieldsOfStudy = $row['FieldsOfStudy'];
               $tmpStudent->Gender = $row['Gender'];
               $tmpStudent->IDCardNo = $row['IDCardNo'];
               $tmpStudent->Name = $row['Name'];
               $tmpStudent->No = $row['No'];
               $tmpStudent->Password = $row['Password'];
               $tmpStudent->Username = $row['Username'];

               $Students[] = $tmpStudent;
           }
           return $Students;
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