<?php

/**
 * PHP Server-Side Example for Fine Uploader (traditional endpoint handler).
 * Maintained by Widen Enterprises.
 *
 * This example:
 *  - handles chunked and non-chunked requests
 *  - supports the concurrent chunking feature
 *  - assumes all upload requests are multipart encoded
 *  - supports the delete file feature
 *
 * Follow these steps to get up and running with Fine Uploader in a PHP environment:
 *
 * 1. Setup your client-side code, as documented on http://docs.fineuploader.com.
 *
 * 2. Copy this file and handler.php to your server.
 *
 * 3. Ensure your php.ini file contains appropriate values for
 *    max_input_time, upload_max_filesize and post_max_size.
 *
 * 4. Ensure your "chunks" and "files" folders exist and are writable.
 *    "chunks" is only needed if you have enabled the chunking feature client-side.
 *
 * 5. If you have chunking enabled in Fine Uploader, you MUST set a value for the `chunking.success.endpoint` option.
 *    This will be called by Fine Uploader when all chunks for a file have been successfully uploaded, triggering the
 *    PHP server to combine all parts into one file. This is particularly useful for the concurrent chunking feature,
 *    but is now required in all cases if you are making use of this PHP example.
 */

// Include the upload handler class
require_once "handler.php";

function database_connect()
{
    $vars = mysql_connect('localhost','root','root');                
    if($vars)
    {
        mysql_select_db('wizcationc_wiz');
        mysql_query("set names tis620") or die('Invalid query: ' . mysql_error());
    } 
    else 
    {
        echo mysql_errno();
    }
   return $vars;
}

$uploader = new UploadHandler();
$uploader->allowedExtensions = array(); 
$uploader->sizeLimit = null;
$uploader->inputName = "qqfile";
$uploader->chunksFolder = "chunks";
$method = $_SERVER["REQUEST_METHOD"];

if ($method == "POST") {
    header("Content-Type: multipart/form-data");
    if (isset($_GET["done"])) 
    {
        $result = $uploader->combineChunks("files");
    }
    else 
    {
        $result = $uploader->handleUpload("files");
        $database = database_connect();
        if($database)
        {
            $sql = "INSERT INTO `item_image` (`property_code`, `ref_code`,`uuid`, `image`, `cover`, `datetime_update`)
            VALUES ('".$_GET['property_code']."', '".$_GET['ref_code']."', '".$uploader->getUID()."', '".$uploader->getUploadName()."', '', '".date('Y-m-d H:i:s')."');";
            mysql_query($sql);            
            
            if (mysql_affected_rows() > 0) 
            {
                $result['database'] = 200;
                $result["uploadName"] = $uploader->getUploadName();
                $result['uuid'] = $uploader->getUID();
            } else {
                $result['database'] = 400;
                $result["error"] =  mysql_error();
            }
        }
    }
    echo json_encode($result);
}

else if ($method == "DELETE") {
  
    $result = $uploader->handleDelete("files");
    $uuid = $result['uuid'];
    $database = database_connect();
    if($database)
    {
        $sql = "delete from `item_image` where `uuid` ='".$uuid."'";
        mysql_query($sql);            
        
       if (mysql_affected_rows() > 0) 
        {
         
        } else {
            $result['database'] = 400;
            $result["error"] =  mysql_error();
        }
    }
    echo json_encode($result);
}
else {
    header("HTTP/1.0 405 Method Not Allowed");
}

?>
