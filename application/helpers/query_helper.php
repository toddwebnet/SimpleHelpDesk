<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');



// Query Helper should be only be used in Models with such syntax:
// class Examples_model extends CI_Model {
//     public function __construct() {
//         parent::__construct();
//         // Loading QueryHelper
//         get_instance()->load->helper('query');
//     }
// }

// This is a flag to prevent infinite loops of crashes.
$hasCrashed = false;

// Executes a query, checks if there's results and returns them or NULL
function GetResultsFromQuery($context, $sql) {
    $query = $context->db->query($sql);
	
    // if it's an object (SELECT)
    if (is_object($query)) {
        $results = $query->result();
		
        if (count($results) > 0) {
            return $results;
        } else {
            // if there's no result, return an empty array to prevent errors
            return array();
        }

    // if it's a bool (INSERT/UPDATE)
    } else if ($query) {
        return TRUE;

    // else it's a SQL error
    } else {
        // If the query is null, then there's something wrong with field names or something
        CatchSqlError($context, $sql);
        return FALSE;
    }
}

function GetResultsFromQueryCached($context, $sql) {
		$context->db->cache_on();
    $query = $context->db->query($sql);
	
    // if it's an object (SELECT)
    if (is_object($query)) {
        $results = $query->result();
		
        if (count($results) > 0) {
            return $results;
        } else {
            // if there's no result, return an empty array to prevent errors
            return array();
        }

    // if it's a bool (INSERT/UPDATE)
    } else if ($query) {
        return TRUE;

    // else it's a SQL error
    } else {
        // If the query is null, then there's something wrong with field names or something
        CatchSqlError($context, $sql);
        return FALSE;
    }
}

// Executes a query, checks if there's results and returns the one of them or NULL
function GetFirstResultFromQuery($context, $sql) {
    $results = GetResultsFromQuery($context, $sql);

    if (count($results) > 0) {
        return $results[0];
    } else {
        return NULL;
    }
}

function GetFirstResultFromQueryCached($context, $sql) {
    $results = GetResultsFromQueryCached($context, $sql);

    if (count($results) > 0) {
        return $results[0];
    } else {
        return NULL;
    }
}

// Uses GetResultsFromQuery to check if the query returns data, returns TRUE or FALSE
function QueryReturnsData($context, $sql) {
    $results = GetResultsFromQuery($context, $sql);

     if (count($results) > 0) {
        return TRUE;
    } else {
        return FALSE;
    }
}

// Catches SQL Error, and logs them
function CatchSqlError($context, $sql, $e = null) {
    global $hasCrashed;

    if ((defined('ENVIRONMENT')) && (ENVIRONMENT == 'development')) {

        $dumpContainer = "<div style='border:1px solid black;padding:10px;height:200px;overflow:auto;'><pre>";

        echo "<h1 style='color:red'>Catched SQL Error!</h1>";
        echo "<h2>" . $context->db->_error_message() . "</h2>";

        if ($context->db->dbdriver == 'sqlsrv') {
            echo "<h3>sqlsrv_errors Dump:</h3>";
            echo $dumpContainer;
			echo 'SQL Statement: ' . $sql . '<hr />';
            var_dump(sqlsrv_errors());
            echo "</pre></div>";
        }

        echo "<h3>DB Context Dump:</h3>";
        echo $dumpContainer;
		echo 'SQL Statement: ' . $sql . '<hr />';
        var_dump($context->db);
        echo "</pre></div>";

    } else {
        $userSession = $context->session->userdata('logged_in');

        $errorLog = new ErrorLog($context);
        $errorLog->UserID = $userSession['UserID'];

        $errorLog->ErrorMessage = $context->db->_error_message();

        if ($context->db->dbdriver == 'sqlsrv') {
            $sqlsrv_errors = sqlsrv_errors();
            $errorLog->SQLState = $sqlsrv_errors[0]['SQLSTATE'];
            $errorLog->Code = $sqlsrv_errors[0]['code'];
            $errorLog->SQLSrvErrorsDump = var_export($sqlsrv_errors, true);
        }

        $errorLog->UserAgent = $_SERVER['HTTP_USER_AGENT'];

        $errorLog->RemoteAddr = $_SERVER['REMOTE_ADDR'];
        $errorLog->CreateDate = date('c');

        $errorLog->SessionDump = var_export($context->session->userdata('logged_in'), true);
        $errorLog->DBContextDump = var_export($context->db, true);
        $errorLog->ServerDump = var_export($_SERVER, true);

        if ($hasCrashed) {
            return false;
        } else {
            $hasCrashed = true;
            $errorLog->Save();
        }

        $errorNumber = $errorLog->GetLastInsertId();

        die('<h1>An error occured.</h1>
            <p>Please contact support and make sure to include a reference to "Error #'. $errorNumber . '".</p>
            <p>Sorry for the inconvenience.</p>');
    }
}

function GetOneField($field, $table="", $where="", $value="",$cached=false) {
	if ($value!="null")
	{$value = "'" . $value . "'";}
	if($table!="")
	{
		$sql = "SELECT " . $field . " Field FROM " . $table . " ";
		if ($where != '') {
			$sql .= " WHERE " . $where . " = " . $value . "";
		}
	}
	else
	{
		$sql = $field;
	}
	$CI = get_instance();
	$CI->load->model('options');
	if($cached)
	{$return = GetFirstResultFromQueryCached($CI->options, $sql);	}
	else
	{$return = GetFirstResultFromQuery($CI->options, $sql);}

	return (isset($return->Field) ? $return->Field : "wrod");	
}

function dbText($text)
{
	return "'" . dbQuote($text) . "'";
}
function dbQuote($text)
{
	return str_replace("'", "''", $text);
}