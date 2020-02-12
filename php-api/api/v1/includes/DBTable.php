<?php
//Klasse zum Erstellen von Datenbanktabellen als Objekt in PHP
//allg. Methoden zur Objektgenerierung -> techn. 1 Datensatz
//allg. Methoden für INSERTS/UPDATES/DELETES auf gewisse Tabellen
include_once __DIR__.'/DBObject.php';

class DBTable extends DBObject {
	protected $table_name, $id_name, $last_id, $historic; 									//Tabellenname, eindeutiges Schlüsselatribut, letzte erfolgreiche ID von einem DS, historische Daten																		//Kommunikationsdaten(Kommentare, Chats)
	
	//Constructor
	function __construct( $table_name, $id_name, $tableData = array()) {												//Constructor - definiert Tabelleninformationen
		parent:: __construct();
		$this->table_name=$table_name;
		$this->id_name=$id_name;
		$this->tableData=$tableData; 															//Beinhaltet erweiterte Tabellenkonfigurationen zum erstellen eines SQL-Statements für Klassenerstellung
	}
	
	//
	//EINZELNE DATENSÄTZE
	//
	function getVar( $id, $hist = false) { 														//fügt dem aktuellen Tabellenobjekt alle Tabellenspalten als Variable hinzu 
		if ($id==""){$id=0;}
		$this->setid($id);
		$this->setHIST($hist);
		$result=$this->getDS( $this->id, $this->historic);
		if ($result->rowCount() == 1) {													//fügt jede Tabellenspalte dem Objekt als Variable hinzu
			while($row = $result->fetch(PDO::FETCH_ASSOC)) {
				$this->last_id=$row[key($row)];													//ID vom Datensatz muss immer ganz vorne in Tabelle stehen
				while (key($row)!="") {
					$varname=key($row);
					if ($varname!="id") {
						if (!mb_detect_encoding($row[key($row)], 'UTF-8, ISO-8859-1') === 'UTF-8') {
							$this->$varname=utf8_encode($row[key($row)]);
							//echo $varname." ".utf8_encode($row[key($row)])."<br>"; //gibt als Liste alle Informationen zu einem Select aus
						} else {
							$this->$varname=$row[key($row)];
						}
					}
					next($row);
				}
			} 
			return $this->result;
		} else {	
			//echo "keine Daten gefunden: ID:".$this->idtext." Anzahl-DS: ".$this->result->rowCount()." (table: '".$this->table_name."' ID-Name: '".$this->id_name."')<br>";
			$this->deleteVar();																	//Warnung: Keine Daten gefunden! ID: $this->id.
			return false;
		}
	}
	function deleteVar() {																		//Löscht alle Variablen aus Objekt
		$this->result=$this->execute( "SELECT * FROM ".$this->table_name." WHERE ".$this->id_name." = :id_value AND start_timestamp <= CURRENT_TIMESTAMP AND end_timestamp >= CURRENT_TIMESTAMP LIMIT 1" , array(":id_value" => $this->last_id));
		if ($this->result->rowCount() == 1) {
			while($row = $this->result->fetch(PDO::FETCH_ASSOC)) {
				while (key($row)!="") {
					$varname=key($row);
					unset($this->$varname);
					next($row);
				}
			}
			return true; 
		} else { 																							
			return false;																		//Löschen der Variablen im Objekt fehlgeschlagen
		}	
	}
	//
	//allg. Methoden für Tabellenoperationen
	//
	function getDS( $id=false) { 														//ermittelt genau 1 Datensatz
		if ($id!=false) {$this->setID($id);}
		$sql="SELECT * FROM ".$this->table_name;
		if (count($this->tableData)>0) {
			if (isset($this->tableData['join'])) {
				$sql=$sql." LEFT JOIN ".$this->tableData['join']['table']." ON ".$this->tableData['join']['table'].".".$this->tableData['join']['tablekey']." = ".$this->table_name.".".$this->tableData['join']['key'];
			}
			if (isset($this->tableData['joins'])) {
				foreach ($this->tableData['joins'] as $join) {
				$sql=$sql." LEFT JOIN ".$join['table']." ON ".$join['table'].".".$join['tablekey']." = ".$this->table_name.".".$join['key'];
				}
			}
		}
		//echo $hist;
		if (is_array($this->id_name) && is_array($this->id)) {
			$id_text="";
			$id_values=array();
			$I=0;
			foreach ($this->id_name as $row) {
				$id_text=$id_text.$this->table_name.".".$this->id_name." = :".$this->id_name." AND ";
				$id_values=array_merge($id_values, array($row => $this->id[$I]));
				$I++;
			}
		} elseif (!is_array($this->id_name) && !is_array($this->id)) {
			$id_text=$this->table_name.".".$this->id_name." = :".$this->id_name." AND ";
			$id_values=array($this->id_name => $this->id);
		} else {
			//cannot be accessed
			echo "ERROR: Class: DBTable needs id and id_name of the same type";
		}
		$sql=$sql." WHERE ".$id_text.$this->table_name.".start_timestamp <= CURRENT_TIMESTAMP AND ".$this->table_name.".end_timestamp >= CURRENT_TIMESTAMP";
		$this->result=$this->execute($sql, $id_values);
		return $this->result;
	}
	function updateColumn($columnname, $value) {
		if ($value==="CURRENT_TIMESTAMP") {$value=date('Y-m-d H:i:s'); echo "USE CTS for: $value"; }
		if (!intval($this->id)) {echo "wrong id givven! - updateColumn"; exit;}
		$arrayData=array(":value" => $value);
		$query="UPDATE ".$this->table_name." SET ".$columnname." = :value  WHERE ".$this->id_name." = ".$this->id." AND start_timestamp <= CURRENT_TIMESTAMP AND end_timestamp >= CURRENT_TIMESTAMP";
		return $this->execute($query, $arrayData);
	}
	/**
	 * @param integer $id (optional) id of ds
	 * @param bool $hist true-hist ds, who are valid right now, false-hist ds who are valid right now and in the future
	 */
	function histColumn($id=false, $hist=false) {
		if ($id!=false) {$this->setID($id);}
		if (is_array($this->id_name) && is_array($this->id)) {
			$id_text="";
			$id_values=array();
			$I=0;
			foreach ($this->id_name as $row) {
				$id_text=$id_text.$this->table_name.".".$this->id_name." = :".$this->id_name." AND ";
				$id_values=array_merge($id_values, array($row => $this->id[$I]));
				$I++;
			}
		} elseif (!is_array($this->id_name) && !is_array($this->id)) {
			$id_text=$this->table_name.".".$this->id_name." = :".$this->id_name." AND ";
			$id_values=array($this->id_name => $this->id);
		} else {
			//cannot be accessed
			echo "ERROR: Class: DBTable needs id and id_name of the same type";
		}
		if ($hist==false) {
			$query="UPDATE ".$this->table_name." SET ".$this->table_name.".end_timestamp = CURRENT_TIMESTAMP  WHERE ".$id_text."start_timestamp <= CURRENT_TIMESTAMP AND end_timestamp >= CURRENT_TIMESTAMP";
		} else if ($hist=="future") {
			$query="UPDATE ".$this->table_name." SET ".$this->table_name.".end_timestamp = CURRENT_TIMESTAMP  WHERE ".$id_text."end_timestamp >= CURRENT_TIMESTAMP";			
		}
		return $this->execute($query, $id_values);
	}
	/**
	 * @param integer $id (optional) id of ds
	 * @param bool $hist true-hist ds, who are valid right now, false-hist ds who are valid right now and in the future
	 */
	function delColumn($id=false, $hist=false) {
		if ($id!=false) {$this->setID($id);}
		if (is_array($this->id_name) && is_array($this->id)) {
			$id_text="";
			$id_values=array();
			$I=0;
			foreach ($this->id_name as $row) {
				$id_text=$id_text.$this->table_name.".".$this->id_name." = :".$this->id_name." AND ";
				$id_values=array_merge($id_values, array($row => $this->id[$I]));
				$I++;
			}
		} elseif (!is_array($this->id_name) && !is_array($this->id)) {
			$id_text=$this->table_name.".".$this->id_name." = :".$this->id_name." AND ";
			$id_values=array($this->id_name => $this->id);
		} else {
			//cannot be accessed
			echo "ERROR: Class: DBTable needs id and id_name of the same type";
		}
		if ($hist==false) {
			$query="DELETE FROM ".$this->table_name." WHERE ".$id_text."start_timestamp <= CURRENT_TIMESTAMP AND end_timestamp >= CURRENT_TIMESTAMP";
		} else if ($hist=="future") {
			$query="DELETE FROM ".$this->table_name." WHERE ".$id_text."end_timestamp >= CURRENT_TIMESTAMP";			
		}
		return $this->sqldelete($query, $id_values);
	}
	/**
	 * @return obj $result
	 */
	function insertColumn($arrayColumn) {
		// var_dump($arrayColumn);
		$array=array();
		$query="INSERT INTO ".$this->table_name." (";
		$keys=" ";
		foreach ($arrayColumn as $key => $value) {
			if ($value!=null) {
				if ($keys!=" ") {$keys=$keys.", ";}
				$keys=$keys.$key;
				//echo $key."=".$value."<br>";
				$array=array_merge($array,array(":".$key => $value));
			}
		}
		$query=$query.$keys.") VALUES(";
		$values=" ";
		foreach ($arrayColumn as $key => $value) {
			if ($value!=null) {
				if ($values!=" ") {$values=$values.", ";}
				$values=$values.":".$key;
			}
		}
		$query=$query.$values.")";
		return $this->execute( $query, $array);
	}
	function updateColumns($arrayColumns, $id = false) {												//ID -> zur selektion eines DS über die $this->id_name
		if ($id!=false) {$this->setID($id);}
		if ($this->updateDS($arrayColumns)) {															//Wenn Änderungen benötigt->dann wurde DS bereits hisorisiert und es kann etwas neues eingefügt werden
			foreach ($arrayColumns as $key => $value) {
				$this->updateColumn($key, $value);
			}
		} else {
			return false;
		}
		return true;
	}
	function updateColumnssameDS($arrayColumns, $id = false) {												//ID -> zur selektion eines DS über die $this->id_name
		if ($id!=false) {$this->setID($id);}												//Wenn Änderungen benötigt->dann wurde DS bereits hisorisiert und es kann etwas neues eingefügt werden
		foreach ($arrayColumns as $key => $value) {
			if (!$this->updateColumn($key, $value)) return false;
		}
		return true;
	}
	protected function updateDS($arrayColumnsnew) {																		//soll aktuellen Datensatz historisieren und neuen mit gleichen Daten anlegen
		$this->arrayColumns=array();
		$this->result=$this->getDS($this->id);
		if ($this->result->rowCount() == 1) {
			while($row = $this->result->fetch(PDO::FETCH_ASSOC)) {
				while (key($row)!="") {
					$this->arrayColumns= array_merge($this->arrayColumns,array(key($row) => $row[key($row)]));
					next($row);
				}
			}
			$änderungen=0;
			foreach ($this->arrayColumns as $key => $value) {
				if (isset($arrayColumnsnew[$key])) {
					if ($arrayColumnsnew[$key]!=$value) {
						$änderungen++;
					}
				}
			}
			if ($änderungen>=1) {
				$this->histColumn();
				sleep(1);
				$this->arrayColumns['id']=$this->id;
				$this->insertColumn($this->arrayColumns);
				return true;
			} else {
				return false;
			}
		}
	}	
	protected function setID($id) {
		if (is_array($id) && is_array($this->id_name)) {
			if (count($id)==count($this->id_name)) {
				$this->idtext="";
				$this->id=$id;
				foreach ($id as $row) {
					$this->idtext=$this->idtext.";";
				}
			} else {
				echo "ERROR: the Count of id and id_name have to match!";
			}				
		} elseif (!is_array($id) && !is_array($this->id_name) ) {
			$this->id=$id;
			$this->idtext=$id;			
		} else {
			echo "ERROR: id and id_name are not of the same type";
		}
	}
	function setHIST($hist) {
		$acceptHIST = ['none', 'future', 'paste', false]; 
		$this->historic = in_array($hist, $acceptHIST) ? $this->historic : false;
	}
	function isData($id) {
		$connection=new DBObject();
		$result=$connection->execute("SELECT ".$this->id_name." FROM ".$this->table_name." WHERE ".$this->id_name." = :value AND start_timestamp <= CURRENT_TIMESTAMP AND end_timestamp >= CURRENT_TIMESTAMP", array(":value" => $id));
		if ($result->rowCount() > 1) {erroremail("[TABLE][".$this->table_name."] To many active DS in Database for id: $id"); return false;}
		if ($result->rowCount() == 1) {return true;} else {return false;}
	}
	function createColumn($id) {
		$this->insertColumn(array($this->id_name => $id));
	}
}
?>