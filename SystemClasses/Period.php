<?php include_once('BaseObject.php'); ?>
<?php include_once('Exceptions.php'); ?>
<?php
class Period extends BaseObject{
   const TABLENAME = 'Period';
   public function __construct($mySQLi){
       parent::__contruct($mySQLi);
   }
    public $Active;
    public $Code;
    public $Name;
    public $Note;

   public function get_SaveQuery(){
       $mySQLi = $this->get_mySQLi();
       return "INSERT INTO ".self::TABLENAME."(Active,Code,Name,Note,LockField) VALUES('".$mySQLi->real_escape_string($this->Active)."','".$mySQLi->real_escape_string($this->Code)."','".$mySQLi->real_escape_string($this->Name)."','".$mySQLi->real_escape_string($this->Note)."','".$mySQLi->real_escape_string($this->LockField)."')";}
   public function get_UpdateQuery(){
       $mySQLi = $this->get_mySQLi();
       return "UPDATE ".self::TABLENAME." SET Active = '".$mySQLi->real_escape_string($this->Active)."', Code = '".$mySQLi->real_escape_string($this->Code)."', Name = '".$mySQLi->real_escape_string($this->Name)."', Note = '".$mySQLi->real_escape_string($this->Note)."', LockField = '".$mySQLi->real_escape_string($this->LockField)."' WHERE Id = '".$mySQLi->real_escape_string($this->Id)."'";}
   protected function get_TableName(){
       return self::TABLENAME;
   }
   public function get_CompetencyPoint($page=0,$totalitem=0){
       return CompetencyPoint::LoadCollection($this->get_mySQLi(),"Period = ".$this->Id,'Id DESC',$page,$totalitem);
   }

   public static function GetObjectByKey($mySQLi, $Id){
       if($result = $mySQLi->query("SELECT * FROM ".self::TABLENAME." WHERE Id = ".$mySQLi->real_escape_string($Id)." LIMIT 1")){
           if($row = $result->fetch_array()){
               $tmpPeriod = new Period($mySQLi);
               $tmpPeriod->Id = $row['Id'];
               $tmpPeriod->Active = $row['Active'];
               $tmpPeriod->Code = $row['Code'];
               $tmpPeriod->Name = $row['Name'];
               $tmpPeriod->Note = $row['Note'];

               $tmpPeriod->LockField = $row['LockField'];
               return $tmpPeriod;
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
           $Periods = array();
           while ($row = $result->fetch_array()){
               $tmpPeriod = new Period($mySQLi);
               $tmpPeriod->Id = $row['Id'];
               $tmpPeriod->LockField = $row['LockField'];
               $tmpPeriod->Active = $row['Active'];
               $tmpPeriod->Code = $row['Code'];
               $tmpPeriod->Name = $row['Name'];
               $tmpPeriod->Note = $row['Note'];

               $Periods[] = $tmpPeriod;
           }
           return $Periods;
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