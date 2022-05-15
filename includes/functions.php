<?php 
	function loggin(){
		if(isset($_SESSION['username'])|| isset($_COOKIE['username'])){
			return true;
		}
		else{
			return false;
		}
	}
	//VERIFY OUTLET
	function verifyOutlet($link,$outletName){
			$query=mysqli_query($link,"SELECT * FROM tbl_outlet WHERE nameOutlet='$outletName'");
			if(mysqli_num_rows($query)>0){
				return true;
			}
			else{
				return false;
			}
	}
	//Registered email Verified of user
	function email_exist($link,$email){
			$query=mysqli_query($link,"SELECT * FROM user_tbl WHERE email='$email'");
			if(mysqli_num_rows($query)==1){
				return true;
		}
		else{
			return false;
		}
	}
	
	
	
	//username exist in admin
	function username_exist($link,$username){
			$query=mysqli_query($link,"SELECT * FROM tbl_admin WHERE username='$username'");
			if(mysqli_num_rows($query)==1){
				return true;
			}
			else{
				return false;
			}
		}
	
	function Export_Database($host,$user,$pass,$name,$tables=false,$backup_name=false){
			$mysqli=new mysqli($host,$user,$pass,$name);
			$mysqli->select_db($name);
			$mysqli->query("SET NAMES 'utf8'");

			$queryTables=$mysqli->query('SHOW TABLES');
			while($row=$queryTables->fetch_row()){
				$target_tables[]=$row[0];
			}
			if($tables!==false){
				$target_tables=array_intersect($target_tables, $tables);
			}
			foreach ($target_tables as $table) {
				$result=$mysqli->query(' SELECT * FROM '.$table);
				$fields_amount=$result->field_count;
				$rows_num=$mysqli->affected_rows;
				$res=$mysqli->query(' SHOW CREATE TABLE '.$table);
				$TableMLine=$res->fetch_row();
				$content=(!isset($content)?'':$content)."\n\n".$TableMLine[1].";\n\n";
				
				for($i=0,$st_counter=0;$i<$fields_amount;$i++,$st_counter=0){
					while($row=$result->fetch_row()){
						if($st_counter%100==0|$st_counter==0){
							$content.="\n INSERT INTO ".$table." VALUES ";
						}
						$content.="\n(";
						for($j=0;$j<$fields_amount;$j++){
							$row[$j]=str_replace("\n", "\\n", addslashes($row[$j]));
							if(isset($row[$j])){
								$content.='"'.$row[$j].'"';
							}
							else{
								$content.='""';
							}
							if($j<($fields_amount-1)){
								$content.=',';
							}
						}//End forloop
						$content.=")";
						if(($st_counter+1)%100==0 && $st_counter!=0 | $st_counter+1==$rows_num){
							$content.=";";
						}
						else{
							$content.=",";
						}
						$st_counter=$st_counter+1;
					}//End while
				}//End ForLoop
				$content.="\n\n\n";
			}//End foreach

			$date=date("Y-m-d");
			/*$backup_name=$backup_name ? $backup_name : $name."_$date.sql";
			header("content-type: application/octet-stream");
			header('content-disposition: attachment; filename='.$backup_name.'');
			header("content-transfer-Encoding: Binary");*/
			//echo "$content";
			//exit;
			//SAVE FILE
			$handle=fopen("../warchild_backup_$date.sql", 'w+');
			//$handle=fopen("../kge_backup_$date.sql", 'w+');
			fwrite($handle, $content);
			fclose($handle);
		}//END FUNCTION
?>