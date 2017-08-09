<?php
	class DB{

	    private $dbHost     = "localhost";
	    private $dbUsername = "root";
	    private $dbPassword = "";
	    private $dbName     = "db_helpdesk";

	    public function __construct(){
	        if(!isset($this->db)){
	            // Connect to the database
	            try{
	                $conn = new PDO("mysql:host=".$this->dbHost.";dbname=".$this->dbName, $this->dbUsername, $this->dbPassword);
	                $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	                $this->db = $conn;
	            }catch(PDOException $e){
	                die("Failed to connect with MySQL: " . $e->getMessage());
	            }
	        }
	    }
	   
	    /**
	     * Returns rows from the database based on the conditions
         *
         * Example: $users = $db->getRows('tbl_users', array('order_by'=>'id DESC'));
	     * @param string $table name of the table
	     * @param array $conditions select, where, order_by, limit and return_type conditions
         * @return array
	     */
	    public function getRows($table, $conditions = array()){
	        $sql = 'SELECT ';
	        $sql .= array_key_exists("select",$conditions)?$conditions['select']:'*';
	        $sql .= ' FROM '.$table;
	        if(array_key_exists("where",$conditions)){
	            $sql .= ' WHERE ';
	            $i = 0;
	            foreach($conditions['where'] as $key => $value){
	                $pre = ($i > 0)?' AND ':'';
	                $sql .= $pre.$key." = :param" . $i;
	                $i++;
	            }
	        }
	        
	        if(array_key_exists("order_by",$conditions)){
	            $sql .= ' ORDER BY '.$conditions['order_by']; 
	        }
	        
	        if(array_key_exists("start",$conditions) && array_key_exists("limit",$conditions)){
	            $sql .= ' LIMIT '.$conditions['start'].','.$conditions['limit']; 
	        }elseif(!array_key_exists("start",$conditions) && array_key_exists("limit",$conditions)){
	            $sql .= ' LIMIT '.$conditions['limit']; 
	        }
	        
	        $query = $this->db->prepare($sql);
	        $i = 0;
	        if(array_key_exists("where", $conditions)){
                foreach($conditions['where'] as $key => $value){
                    $query->bindValue(':param'. $i, $value);
                    $i++;
                }
            }
	        $query->execute();
	        
	        if(array_key_exists("return_type",$conditions) && $conditions['return_type'] != 'all'){
	            switch($conditions['return_type']){
	                case 'count':
	                    $data = $query->rowCount();
	                    break;
	                case 'single':
	                    $data = $query->fetch(PDO::FETCH_ASSOC);
	                    break;
	                default:
	                    $data = '';
	            }
	        }else{
	            if($query->rowCount() > 0){
	                $data = $query->fetchAll();
	            }
	        }
	        return !empty($data)?$data:false;
	    }

	    /**
	     * Insert data into the database
         *
         *SAMPLE CODE:
         *$insert = $db->insert($tblName,$userData);
	     * @param string $table name of the table
	     * @param array $data the data for inserting into the table
	     */
	    public function insert($table,$data){
	        if(!empty($data) && is_array($data)){
	            $columns = '';
	            $valueString  = '';
	            $i = 0;
	            if(array_key_exists('created',$data)){
	                $data['created'] = date("Y-m-d H:i:s");
	            }
	            if(array_key_exists('modified',$data)){
	                $data['modified'] = date("Y-m-d H:i:s");
	            }
	            $columnString = implode(',', array_keys($data));

	            $i = 0;
	            foreach ($data as $key => $value) {
	            	$valueString .= ":param". $i . ", ";
	            	$i++;
	            }

	            $valueString = rtrim($valueString, ", ");

	            $sql = "INSERT INTO ".$table." (".$columnString.") VALUES (".$valueString.")";
	            $query = $this->db->prepare($sql);
	            $i = 0;
	            foreach($data as $key=>$val){
	                 $query->bindValue(':param' . $i, $val);
	                 $i++;
	            }
	            $insert = $query->execute();
	            return $insert?$this->db->lastInsertId():false;
	        }else{
	            return false;
	        }
	    }
	    
	    /*
	     * Update data into the database
	     * @param string name of the table
	     * @param array the data for updating into the table
	     * @param array where condition on updating data
	     *SAMPLE CODE:
	     *$userData = array(
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'phone' => $_POST['phone']
            );
            $condition = array('id' => $_POST['id']);
            $update = $db->update($tblName,$userData,$condition);
	     */
	    public function update($table,$data,$conditions){
	        if(!empty($data) && is_array($data)){
	            $colvalSet = '';
	            $whereSql = '';
	            $i = 0;
	            if(array_key_exists('modified',$data)){
	                $data['modified'] = date("Y-m-d H:i:s");
	            }
	            foreach($data as $key=>$val){
	                $pre = ($i > 0)?', ':'';
	                $colvalSet .= $pre.$key."=:param".$i."";
	                $i++;
	            }
	            if(!empty($conditions)&& is_array($conditions)){
	                $whereSql .= ' WHERE ';
	                $i = 0;
	                foreach($conditions as $key => $value){
                        $pre = ($i > 0)?' AND ':'';
                        $whereSql .= $pre.$key." = :cond".$i."";
                        $i++;
	                }
	            }
	            $sql = "UPDATE ".$table." SET ".$colvalSet.$whereSql;
	            $query = $this->db->prepare($sql);
	            $i = 0;
	            foreach($data as $key=>$val){
	                $query->bindValue(':param'. $i, $val);
	                $i++;
	            }

	            $i = 0;
	            foreach($conditions as $key => $value){
                    $query->bindValue(':cond'. $i, $value);
//	                if(is_nan($value)){
//                        $query->bindValue(':cond'. $i, $value);
//                    }else{
//                        $query->bindValue(':cond'. $i, $value, PDO::PARAM_INT);
//                    }

                    $i++;
	            }
	            $update = $query->execute();
	            return $update?$query->rowCount():false;
	        }else{
	            return false;
	        }
	    }
	    
	    /*
	     * Delete data from the database
	     * @param string name of the table
	     * @param array where condition on deleting data
	     *SAMPLE CODE:
	     *$condition = array('id' => $_GET['id']);
            $delete = $db->delete($tblName,$condition);
	     */
	    public function delete($table,$conditions){
	        $whereSql = '';
	        if(!empty($conditions)&& is_array($conditions)){
	            $whereSql .= ' WHERE ';
	            $i = 0;
	            foreach($conditions as $key => $value){
	                $pre = ($i > 0)?' AND ':'';
	                $whereSql .= $pre.$key." = '".$value."'";
	                $i++;
	            }
	        }
	        $sql = "DELETE FROM ".$table.$whereSql;
	        $delete = $this->db->exec($sql);
	        return $delete?$delete:false;
	    }
	}
?>
