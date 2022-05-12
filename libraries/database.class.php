<?php
/**
 *------------------------------------------------------
 * Photon microframework
 *
 * @class database
 * @author Soliman Adel (Mr-simple)
 * @email {soliman.adelzx@gmail.com}
 * @version v1.0
 *------------------------------------------------------
 */

class database
{

    private $db_host = "";
    private $db_user = "";
    private $db_name = "";
    private $db_pass = "";

    private $mysqli = false;
    private $query = false;
    private $table = false;
    private $sql = false;
    private static $instance;

    private function __clone(){}

    function __construct()
    {
        $this->connect();
    }


    /**
    * getInstance
    * return only one instance of the class.
    *
    * @param NULL
    * @return Object
    */
    public static function &getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    /**
    * connect
    * opens a new connection to the MySQL server.
    *
    * @param NULL
    * @return Object
    */
    private function connect() {

      if (file_exists("config/database.php")) {

          $db = require('config/database.php');
          $this->db_host = $db['DB_HOST'];
          $this->db_user = $db['DB_USER'];
          $this->db_name = $db['DB_NAME'];
          $this->db_pass = $db['DB_PASS'];

      }

      if (
            !$this->mysqli = @mysqli_connect(
            $this->db_host,
            $this->db_user,
            $this->db_pass,
            $this->db_name)
        ) { exit('Error connection details !'); }


      mysqli_set_charset($this->mysqli, 'UTF8');
      mysqli_query($this->mysqli, "SET NAMES UTF8");
    }


    /**
     * change_database
     * change the default database for the connection.
     *
     * @param String
     * @return Void
     */
    function change_database($database)
    {
        $this->db_name = $database;
        $this->mysqli->select_db($database);
    }

    function cache($key)
    {
        if (!is_dir(self::cache_dir)) {
            mkdir(self::cache_dir, 0777);
        }
        file_put_contents(self::cache_dir."/$key.php", $this->get());
        return $this;
    }


    /**
     * version
     * return the current version of mysql driver.
     *
     * @param NULL
     * @return String
     */
    function version()
    {
        return mysqli_get_server_info($this->mysqli);
    }


    /**
     * select
     * select column data from a table.
     *
     *
     * @param Array|String
     * @return Object
     */
    function select($fields)
    {
        if ( is_array($fields) ) {
            $fields = implode(",", $fields);
        }
        $this->sql .= "SELECT $fields";
        return $this;
    }

    /**
     * UNION
     * combine the result-set of two or more SELECT statements.
     *
     * @param null
     * @return Object
     */
    function union()
    {
        $this->sql .= " UNION ";
        return $this;
    }

    /**
     * set
     * Adds field/value pairs to be passed later to query.
     *
     * @param Array
     * @return Object
     */
    function set(array $sets)
    {
        if( is_array($sets) ) {
            foreach ($sets as $key => $value) {
                mysqli_real_escape_string($this->mysqli, $value);
                $this->sql.= "$key='".$value."',";
            }
            $this->sql = rtrim($this->sql, ',');
        }
        return $this;
    }


    /**
     * select distinct
     * eliminate duplicate rows in a result set.
     *
     * @param String
     * @return Object
     */
    function select_distinct($fields)
    {
        if ( is_array($fields) ) {
            $fields = implode(",", $fields);
        }
        $this->sql .= "SELECT DISTINCT $fields";
        return $this;
    }

    /**
     * from
     * selected table to retrieve data from.
     *
     * @param String
     * @return Object
     */
    function from($table)
    {
        $this->table = $table;
        $this->sql .= " FROM $table";
        return $this;
    }

    /**
     * where
     * filter rows from the result set.
     *
     *
     * @param Array|String
     * @return Object
     */
    function where($where)
    {
        if ( is_array($where) ) {
            $sql = [];
            foreach ($where as $key => $value) {
                if ( empty($value) ) {
                    unset($where[$key]);
                }
                $sql[]= "$key".' = '."\"$value\" ";
            }
            $where = implode('and ', $sql);
        }
        $this->sql .= " WHERE $where ";
        return $this;
    }

    function orWhere($where)
    {
        if ( is_array($where) ) {
            $sql = [];
            foreach ($where as $key => $value) {
                if ( empty($value) ) {
                    unset($where[$key]);
                }
                $sql[]= "$key".' = '."\"$value\" ";
            }
            $where = implode('or ', $sql);
        }
        $this->sql .= " WHERE ( $where )";
        return $this;
    }

    function inWhere($column = NULL, $ids = NULL)
    {
        $this->sql.= " $column IN($ids) ";
        return $this;
    }

    function between($range1, $range2)
    {
        $this->sql.= " BETWEEN '".$range1."' AND '".$range2."' ";
        return $this;
    }

    function like($where)
    {
        if ( is_array($where) ) {
            $sql = [];
            foreach ($where as $key => $value) {
                if ( empty($value) ) {
                    unset($where[$key]);
                }
                $sql[]= "$key"." like "."'%" .$value. "%'";
            }
            $where = implode(' and ', $sql);
        }
        $this->sql .= " WHERE $where";
        return $this;
    }

    function orLike($where)
    {
        if ( is_array($where) ) {
            $sql = [];
            foreach ($where as $key => $value) {
                if ( empty($value) ) {
                    unset($where[$key]);
                }
                $sql[]= "$key"." like "."'%" .$value. "%'";
            }
            $where = implode(' or ', $sql);
        }
        $this->sql .= " WHERE $where";
        return $this;
    }


    function and($where)
    {
        if ( is_array($where) ) {
            $sql = [];
            foreach ($where as $key => $value) {
                if ( empty($value) ) {
                    unset($where[$key]);
                }
                $sql[]= "$key".' = '."\"$value\" ";
            }
            $where = implode('and ', $sql);
        }
        $this->sql .= " and $where";
        return $this;
    }

    /**
     * order by
     * sort a result set.
     *
     *
     * @param String
     * @return Object
     */
    function orderBy($orderby)
    {
        $this->sql .= " ORDER BY $orderby";
        return $this;
    }


    function max($column = NULL)
    {
        $this->sql .= " MAX (".$column.") ";
        return $this;
    }

    function min($column = NULL)
    {
        $this->sql .= " MIN (".$column.") ";
        return $this;
    }

    function as($alias = NULL)
    {
        $this->sql .= " AS ".$alias." ";
        return $this;
    }


    function table()
    {

    }

    /**
     * limit
     * constrain the number of rows returned by a query.
     *
     *
     * @param Null
     * @return Object
     */
    function limit()
    {
        $params = func_get_args();
        (count($params) == 2)
        ? $this->sql .= " LIMIT $params[0], $params[1]"
        : $this->sql .= " LIMIT $params[0]";
        return $this;
    }


    /**
     * join
     * query data from two tables.
     *
     *
     * @param String
     * @param String
     * @param String
     * @param String
     * @return Object
     */
    function join($table = NULL, $type = NULL)
    {
        $this->sql .= " $type JOIN $table ";
        return $this;
    }

    function on($left = NULL, $right = NULL)
    {
        $this->sql .= " ON $left = $right";
        return $this;
    }

    function using($column)
    {
        $this->sql .= "USING(".$column.")";
        return $this;
    }

    /**
     * group_by
     * group rows into subgroups based on
     * values of columns or expressions.
     *
     * @param String
     * @return Object
     */
    function groupBy($expr_or_colum)
    {
        $this->sql .= " GROUP BY $expr_or_colum";
        return $this;
    }

    /**
     * having
     * specify a filter condition for groups of rows or aggregates.
     *
     * @param String
     * @return Object
     */
    function having($condition)
    {
        $this->sql.= " HAVING $condition";
        return $this;
    }

    /**
     * getOne
     * fetch a result row as an object
     *
     * @param Null
     * @return Object
     */
    function getOne($type = 'object')
    {
        $type = 'fetch_'.$type;
        $query = self::query($this->sql.";")->{$type}();
        self::reset();
        return $query;
    }


    /**
     * get
     * fetch result rows as an object
     *
     * @param Null
     * @return Object Array
     */
    function get($table = NULL)
    {
        $result = array();
        if( empty($table) ) {
            $query = self::query($this->sql.";");
        } else {
            $query = self::query("SELECT * FROM ".$table);
        }
        while ($row = $query->fetch_object()) {
            $result[] = $row;
        }
        unset($row);
        self::reset();
        return $result;
    }


    /**
    * error
    * return the text of the error message
    *
    * @param NULL
    * @return String
    */
    function error()
    {
        die(mysqli_error($this->mysqli));
    }

    /**
    * fetch_object
    * fetch a result row as an object
    *
    * @param NULL
    * @return Object
    */
    function fetch_object()
    {
        $data = array();
        for($query = self::query($this->query);$data[] = $query->fetch_object(););
        array_pop($data);
        mysqli_free_result($this->query);
        return $data;
    }

    /**
    * fetch_assoc
    * fetch a result row as an associative array
    *
    * @param NULL
    * @return Array
    */
    function fetch_assoc()
    {
        $data = array();
        $query = self::query($this->query);
        while ($row = $query->fetch_assoc()) {
            $data[] = $row;
        }
        mysqli_free_result($this->query);
        return $data;

    }

    /**
    * fetch_row
    * get a result row as an enumerated array
    *
    * @param NULL
    * @return Int
    */
    function fetch_row()
    {
        $query = self::query($this->query);
        $result = mysqli_fetch_row($query);
        mysqli_free_result($this->query);
        return $result;
    }

    /**
    * insert
    * insert records into the database
    *
    * @param String $table
    * @param Array $sets
    * @return Int
    */
    function insert($table = NULL, $sets = NULL)
    {
        $args = count( func_get_args() );
        if( $args >= 2 ) {
            $sql = false;
            if ($sets) {
                foreach ($sets as $key => $value) {
                    mysqli_real_escape_string($this->mysqli, $value);
                    $sql.= "$key='".$value."',";
                }
            }
            $sql = rtrim($sql, ',');
            $sql = "INSERT INTO `".$table."` SET $sql";
            self::query($sql);
        } else {
            self::query("INSERT INTO `".$table."` SET ".$this->sql);
        }
        return mysqli_insert_id($this->mysqli);

    }

    /**
    * insert_id
    * get the last inserted id
    *
    * @param NULL
    * @return Int
    */
    function last_insert_id()
    {
        return mysqli_insert_id($this->mysqli);
    }

    /**
    * update
    * update records from the database
    *
    * @param String $table
    * @param Array $sets
    * @param String $where
    * @param Int $limit
    * @return Int (1|0)
    */
    function update($table = NULL, $sets = NULL, $where = NULL, $limit = NULL)
    {
        $args = count( func_get_args() );
        if( $args > 2 ) {
            if ( is_array($where) ) {
                $sql = [];
                foreach ($where as $key => $value) {
                    if ( empty($value) ) {
                        unset($where[$key]);
                    }
                    $sql[]= "$key".' = '."\"$value\" ";
                }
                $where = implode('and ', $sql);
            }
            $sql = false;
            if ($sets) {
                foreach ($sets as $key => $value) {
                    mysqli_real_escape_string($this->mysqli, $value);
                    $sql.= "$key='$value',";
                }
            }
            $sql = rtrim($sql, ',');
            $sql .= ($where != '') ? " WHERE ".$where : '';
            $sql .= (! $limit) ? '' : ' LIMIT '.$limit;
            $sql = "UPDATE `".$table."` SET $sql";
            self::query($sql);
        } else {
            self::query("UPDATE `".$table."` SET ".$this->sql);
        }
        return mysqli_affected_rows($this->mysqli);
    }

    /**
     * truncate
     * delete all data in a table.
     *
     * @param String
     * @return Int(0|1)
     */
    function truncate($table = NULL)
    {
        if( empty($table) ) return;
        $sql = "TRUNCATE TABLE ".$table;
        return self::query($sql);
    }

    /**
    * delete
    * delete records from the database
    *
    * @param String $table
    * @param String $where
    * @param Int $limit
    * @return Int (1|0)
    */
    function delete($table = NULL, $where = NULL, $limit = NULL)
    {
        $args = count( func_get_args() );
        if( $args > 2 ) {
            $query = "DELETE FROM `".$table."`";
            if ( is_array($where) ) {
                $sql = [];
                foreach ($where as $key => $value) {
                    if ( empty($value) ) {
                        unset($where[$key]);
                    }
                    $sql[]= "$key".' = '."\"$value\" ";
                }
                $where = implode('and ', $sql);
            }
            $query .= ($where != '') ? " WHERE ".$where : '';
            $query .= (! $limit) ? '' : ' LIMIT '.$limit;
            self::query($query);
        } else {
            self::query("DELETE FROM `".$table."`".$this->sql);
        }
        return mysqli_affected_rows($this->mysqli);
    }

    /**
    * query
    * send a mysql query
    *
    * @param String $sql
    * @return resource
    */
    function query($sql = NULL)
    {
        $result = mysqli_query($this->mysqli, "/*qc=on*/ $sql");
        $this->query = $result;
        if (!$result) {
            $message  = '<pre style="color:#222;">Invalid query: ' . mysqli_error($this->mysqli) . "\n";
            $message .= 'Whole query: ' . $sql . '</pre>';
            die($message);
        }
        self::reset();
        return $result;
    }

    /**
    * num_fields
    * get numbers of fields
    *
    * @param NULL
    * @return Int
    */
    function num_fields()
    {
        return mysqli_num_fields($this->query);
    }

    /**
    * num_rows
    * get numbers of rows in result
    *
    * @param NULL
    * @return Int
    */
    function num_rows()
    {
        return mysqli_num_rows($this->query);
    }

    /**
     * count
     * Get total records count in specific table
     *
     * @param String $table
     * @return Int
     */
    function count($table = false)
    {
        $table = ($table) ? $table : $this->table;
        $result = self::query("SELECT COUNT(`id`) AS `total` FROM ".$table)
        ->fetch_object()
        ->total;
        return $result;
    }

    /**
    * backup
    * backup the database
    *
    * @param String $tables
    * @return File
    */
    function backup($tables = '*')
    {
        ini_set('max_execution_time', 300);
        if ($tables = '*') {
            $tables = array();
            $result = mysqli_query($this->mysqli, 'SHOW TABLES');
            while ($row = mysqli_fetch_row($result)) {
                $tables[] = $row[0];
            }
        }
        else {
            $tables = is_array($tables) ? $tables : explode(',', $tables);
        }
        $return = '';
        foreach ($tables as $table) {
            $result = mysqli_query($this->mysqli, 'SELECT * FROM '.$table);
            $num_fields = mysqli_num_fields($result);
            $return.= 'DROP TABLE IF EXISTS '.$table.';';
            $row2 = mysqli_fetch_row(mysqli_query($this->mysqli, 'SHOW CREATE TABLE '.$table));
            $return.= "\n\n".$row2[1].";\n\n";
            for ($i = 0; $i < $num_fields; $i++) {

              while($row = mysqli_fetch_row($result)) {
                  $return.= 'INSERT INTO '.$table.' VALUES(';
                  for($j=0; $j<$num_fields; $j++) {
                      $row[$j] = addslashes($row[$j]);
                      $row[$j] = preg_replace("#\n#","\\n",$row[$j]);
                      if (isset($row[$j])) {
                          $return.= '"'.$row[$j].'"' ;
                      }
                      else {
                          $return.= '""';
                      }
                      if ($j<($num_fields-1)) {
                          $return.= ',';
                      }

                  }
                  $return.= ");\n";
              }
            }
            $return.="\n\n\n";
        }
        $filename ='Database backup ('.strftime('%B %d, %Y at %I,%M %p',time()).').sql';
        header('Content-type: text/appdb');
        header('Content-Disposition: attachment; filename="' . $filename);
        echo $return;
    }

    /**
    * free
    * free result memory
    *
    * @param NULL
    * @return Boolean
    */
    function free()
    {
        return mysqli_free_result($this->query);
    }

    /**
     * reset
     * reset class variables to false
     *
     * @param Null
     * @return Void
     */
    function reset()
    {
        $this->sql = false;
    }

    /**
    * close
    * close the database connection
    *
    * @param NULL
    * @return Void
    */
    function close()
    {
        if (is_resource($this->mysqli)) {
            @mysqli_close($this->mysqli);
            $this->mysqli = NULL;
        }
        $this->query = false;
        $this->table = false;
    }

    function __destruct()
    {
        $this->close();
    }

}
?>
