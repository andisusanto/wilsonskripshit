<?php include_once('BaseObject.php'); ?>
<?php include_once('Exceptions.php'); ?>
<?php
class SeminarCompetency extends BaseObject{
   const TABLENAME = 'SeminarCompetency';
   public function __construct($mySQLi){
       parent::__contruct($mySQLi);
   }
    public $Seminar;
    public $Competency;

   public function get_SaveQuery(){
       $mySQLi = $this->get_mySQLi();
       return "INSERT INTO ".self::TABLENAME."(Seminar,Competency,LockField) VALUES('".$mySQLi->real_escape_string($this->Seminar)."','".$mySQLi->real_escape_string($this->Competency)."','".$mySQLi->real_escape_string($this->LockField)."')";}
   public function get_UpdateQuery(){
       $mySQLi = $this->get_mySQLi();
       return "UPDATE ".self::TABLENAME." SET Seminar = '".$mySQLi->real_escape_string($this->Seminar)."', Competency = '".$mySQLi->real_escape_string($this->Competency)."', LockField = '".$mySQLi->real_escape_string($this->LockField)."' WHERE Id = '".$mySQLi->real_escape_string($this->Id)."'";}
   protected function get_TableName(){
       return self::TABLENAME;
   }

   public static function GetObjectByKey($mySQLi, $Id){
       if($result = $mySQLi->query("SELECT * FROM ".self::TABLENAME." WHERE Id = ".$mySQLi->real_escape_string($Id)." LIMIT 1")){
           if($row = $result->fetch_array()){
               $tmpSeminarCompetency = new SeminarCompetency($mySQLi);
               $tmpSeminarCompetency->Id = $row['Id'];
               $tmpSeminarCompetency->Seminar = $row['Seminar'];
               $tmpSeminarCompetency->Competency = $row['Competency'];

               $tmpSeminarCompetency->LockField = $row['LockField'];
               return $tmpSeminarCompetency;
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
           $SeminarCompetencys = array();
           while ($row = $result->fetch_array()){
               $tmpSeminarCompetency = new SeminarCompetency($mySQLi);
               $tmpSeminarCompetency->Id = $row['Id'];
               $tmpSeminarCompetency->LockField = $row['LockField'];
               $tmpSeminarCompetency->Seminar = $row['Seminar'];
               $tmpSeminarCompetency->Competency = $row['Competency'];

               $SeminarCompetencys[] = $tmpSeminarCompetency;
           }
           return $SeminarCompetencys;
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