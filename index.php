<?php
$connectstr_dbhost = '';
$connectstr_dbname = '';
$connectstr_dbusername = '';
$connectstr_dbpassword = '';
foreach ($_SERVER as $key => $value) {
    if (strpos($key, "MYSQLCONNSTR_") !== 0) {
        continue;
    }
    
    $connectstr_dbhost = preg_replace("/^.*Data Source=(.+?);.*$/", "\\1", $value);
    $connectstr_dbname = preg_replace("/^.*Database=(.+?);.*$/", "\\1", $value);
    $connectstr_dbusername = preg_replace("/^.*User Id=(.+?);.*$/", "\\1", $value);
    $connectstr_dbpassword = preg_replace("/^.*Password=(.+?)$/", "\\1", $value);
}

$sql="SHOW DATABASES";

$link = mysqli_connect( $connectstr_dbhost, $connectstr_dbusername, $connectstr_dbpassword) ;
if ($link) {
echo "Database connection : <strong> Success</strong> <br/><br/>";
echo "Running query to display list all databases:<br/>";

if (!($result=mysqli_query($link,$sql))) {
        printf("Error: %s\n", mysqli_error($link));
    }

while( $row = mysqli_fetch_row( $result ) ){
        
        if (($row[0]!="information_schema") && ($row[0]!="mysql")) {
            echo $row[0]."<br/>";
        }
        
    }
}
else
{
    throw new Exception('Error connecting to database');
}
    
?>