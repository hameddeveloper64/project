<?php


if(file_exists("config.php"))
	require_once('config.php');


require_once(DIR_SYSTEM . "/bootstarp.php");



//echo "----- ".DIR_TEMPLATE." ------ <br>";



/*
$data =[];
if (!$cache->has("customers")){
	$query = $db->query("SELECT * FROM `users`");
		$customers = $query->rows;
			$data["customers_count"] = $query->num_rows;
				foreach ($customers as $customer){
					$data["customers_list"][] =  
					[
						"id" => $customer["id"],
						"name" => $customer["name"]
					];
				}
					$cache->set("customers",$data,3);	
}
else
	$data = $cache->get("customers");
*/


$data =[];
$query = $db->query("SELECT * FROM `users`");
	$customers = $query->rows;
		$data["customers_count"] = $query->num_rows;
			foreach ($customers as $customer){
				$data["customers_list"][] =  
				[
					"id" => $customer["id"],
					"name" => $customer["name"]
				];
			}
			
			
$insert = $db->query("INSERT INTO users set name='new user 1'");
echo $db->affectedRows() ." row insert <br />";

$table = $db->superQuery("select * from users");
echo $db->numFields($table);


function backupDb(){
	global $db;
	$return="";
	$tables = array();
	$result = $db->superQuery('SHOW TABLES');
	while($row = $db->fetchRow($result))
		$tables[] = $row[0];
	foreach($tables as $table)
		{
			$result = $db->superQuery('SELECT * FROM '.$table);
				$num_fields = $db->numFields($result);
				$row2 = $db->fetchRow($db->superQuery('SHOW CREATE TABLE '.$table));
				$return.= "\n\n ".$row2[1]."; \n\n";
				
				for ($i = 0; $i < $num_fields; $i++) 
				{
					while($row = $db->fetchRow($result))
					{
						$return.= 'INSERT INTO '.$table.' VALUES(';
						for($j=0; $j<$num_fields; $j++) 
						{
							$row[$j] = addslashes($row[$j]);
							$row[$j] = str_replace("\n","\\n",$row[$j]);
							if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
							if ($j<($num_fields-1)) { $return.= ','; }
						}
						$return.= ");\n";
					}
				}
				$return.="\n\n\n";
		}
		$fileBackup = "backup_db__".date("y-m-d")."__".time().".sql";
			$handle = fopen($fileBackup,'w+');
				fwrite($handle,$return);
					fclose($handle);
}

function backupDbTable($table){
	global $db;
	$return="";
	$result = $db->superQuery('SELECT * FROM '.$table);
		$num_fields = $db->numFields($result);
		$row2 = $db->fetchRow($db->superQuery('SHOW CREATE TABLE '.$table));
		$return.= "\n\n ".$row2[1]."; \n\n";
		
		for ($i = 0; $i < $num_fields; $i++) 
		{
			while($row = $db->fetchRow($result))
			{
				$return.= 'INSERT INTO '.$table.' VALUES(';
				for($j=0; $j<$num_fields; $j++) 
				{
					$row[$j] = addslashes($row[$j]);
					$row[$j] = str_replace("\n","\\n",$row[$j]);
					if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
					if ($j<($num_fields-1)) { $return.= ','; }
				}
				$return.= ");\n";
			}
		}
		$return.="\n\n\n";
		
		$fileBackup = DIR_BACKUP."backup_db_table_".date("y-m-d")."__".time().".sql";
			$handle = fopen($fileBackup,'w+');
				fwrite($handle,$return);
					fclose($handle);
}

//backupDb();
//backupDbTable("users");

$smarty->assign("data",$data);
$smarty->display("customers/list.html");

echo "<br>----------------<br>";

// Check Version
if (version_compare(phpversion(), '8.0.1', '<') == true) {
	exit('PHP5.4+ Required');
}




/*
echo "DOCUMENT_ROOT : " . $_SERVER['DOCUMENT_ROOT'] . "<br/>";
echo "SCRIPT_FILENAME : " . $_SERVER['SCRIPT_FILENAME'] . "<br/>";
echo "PHP_SELF : " . $_SERVER['PHP_SELF'] . "<br/>";
echo "REQUEST_URI : " . $_SERVER['QUERY_STRING'] . "<br/>";
echo "HTTP_HOST : " . $_SERVER['HTTP_HOST'] . "<br/>";
echo "SERVER_PORT : " . $_SERVER['SERVER_PORT'] . "<br/>";
echo "HTTPS : " . $_SERVER['HTTPS'] . "<br/>";
*/


 //$cache->set("names",array(1,2,3),40);
//print_r($cache->get("names"));



