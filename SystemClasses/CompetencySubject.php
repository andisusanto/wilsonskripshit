<?php include_once('BaseObject.php'); ?>
<?php include_once('Exceptions.php'); ?>
<?php
class CompetencySubject extends BaseObject{
   const TABLENAME = 'CompetencySubject';
   public function __construct($mySQLi){
       parent::__contruct($mySQLi);
   }
    public $Competency;
    public $Subject;

   public function get_SaveQuery(){
       $mySQLi = $this->get_mySQLi();
       return "INSERT INTO ".self::TABLENAME."(Competency,Subject,LockField) VALUES('".$mySQLi->real_escape_string($this->Competency)."','".$mySQLi->real_escape_string($this->Subject)."','".$mySQLi->real_escape_string($this->LockField)."')";}
   public function get_UpdateQuery(){
       $mySQLi = $this->get_mySQLi();
       return "UPDATE ".self::TABLENAME." SET Competency = '".$mySQLi->real_escape_string($this->Competency)."', Subject = '".$mySQLi->real_escape_string($this->Subject)."', LockField = '".$mySQLi->real_escape_string($this->LockField)."' WHERE Id = '".$mySQLi->real_escape_string($this->Id)."'";}
   protected function get_TableName(){
       return self::TABLENAME;
   }

   public static function GetObjectByKey($mySQLi, $Id){
       if($result = $mySQLi->query("SELECT * FROM ".self::TABLENAME." WHERE Id = ".$mySQLi->real_escape_string($Id)." LIMIT 1")){
           if($row = $result->fetch_array()){
               $tmpCompetencySubject = new CompetencySubject($mySQLi);
               $tmpCompetencySubject->Id = $row['Id'];
               $tmpCompetencySubject->Competency = $row['Competency'];
               $tmpCompetencySubject->Subject = $row['Subject'];

               $tmpCompetencySubject->LockField = $row['LockField'];
               return $tmpCompetencySubject;
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
           $CompetencySubjects = array();
           while ($row = $result->fetch_array()){
               $tmpCompetencySubject = new CompetencySubject($mySQLi);
               $tmpCompetencySubject->Id = $row['Id'];
               $tmpCompetencySubject->LockField = $row['LockField'];
               $tmpCompetencySubject->Competency = $row['Competency'];
               $tmpCompetencySubject->Subject = $row['Subject'];

               $CompetencySubjects[] = $tmpCompetencySubject;
           }
           return $CompetencySubjects;
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