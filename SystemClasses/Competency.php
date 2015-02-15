<?php include_once('BaseObject.php'); ?>
<?php include_once('Exceptions.php'); ?>
<?php
class Competency extends BaseObject{
   const TABLENAME = 'Competency';
   public function __construct($mySQLi){
       parent::__contruct($mySQLi);
   }
    public $Description;
    public $Name;
    public $Code;

   public function get_SaveQuery(){
       $mySQLi = $this->get_mySQLi();
       return "INSERT INTO ".self::TABLENAME."(Description,Name,Code,LockField) VALUES('".$mySQLi->real_escape_string($this->Description)."','".$mySQLi->real_escape_string($this->Name)."','".$mySQLi->real_escape_string($this->Code)."','".$mySQLi->real_escape_string($this->LockField)."')";}
   public function get_UpdateQuery(){
       $mySQLi = $this->get_mySQLi();
       return "UPDATE ".self::TABLENAME." SET Description = '".$mySQLi->real_escape_string($this->Description)."', Name = '".$mySQLi->real_escape_string($this->Name)."', Code = '".$mySQLi->real_escape_string($this->Code)."', LockField = '".$mySQLi->real_escape_string($this->LockField)."' WHERE Id = '".$mySQLi->real_escape_string($this->Id)."'";}
   protected function get_TableName(){
       return self::TABLENAME;
   }
   public function get_CompetitionStudentCompetency($page=0,$totalitem=0){
       return CompetitionStudentCompetency::LoadCollection($this->get_mySQLi(),"Competency = ".$this->Id,'Id DESC',$page,$totalitem);
   }
   public function get_SeminarCompetency($page=0,$totalitem=0){
       return SeminarCompetency::LoadCollection($this->get_mySQLi(),"Competency = ".$this->Id,'Id DESC',$page,$totalitem);
   }
   public function get_CompetencyPoint($page=0,$totalitem=0){
       return CompetencyPoint::LoadCollection($this->get_mySQLi(),"Competency = ".$this->Id,'Id DESC',$page,$totalitem);
   }

   public static function GetObjectByKey($mySQLi, $Id){
       if($result = $mySQLi->query("SELECT * FROM ".self::TABLENAME." WHERE Id = ".$mySQLi->real_escape_string($Id)." LIMIT 1")){
           if($row = $result->fetch_array()){
               $tmpCompetency = new Competency($mySQLi);
               $tmpCompetency->Id = $row['Id'];
               $tmpCompetency->Description = $row['Description'];
               $tmpCompetency->Name = $row['Name'];
               $tmpCompetency->Code = $row['Code'];

               $tmpCompetency->LockField = $row['LockField'];
               return $tmpCompetency;
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
           $Competencys = array();
           while ($row = $result->fetch_array()){
               $tmpCompetency = new Competency($mySQLi);
               $tmpCompetency->Id = $row['Id'];
               $tmpCompetency->LockField = $row['LockField'];
               $tmpCompetency->Description = $row['Description'];
               $tmpCompetency->Name = $row['Name'];
               $tmpCompetency->Code = $row['Code'];

               $Competencys[] = $tmpCompetency;
           }
           return $Competencys;
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