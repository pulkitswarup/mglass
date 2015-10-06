<?php
        $connect=mysql_connect("mysql","mglass","mglass") or die("Unable to Connect");
        mysql_select_db("mglass") or die("Could not open the db");
        $showtablequery="SHOW TABLES FROM mglass";
        $query_result=mysql_query($showtablequery);
        while($showtablerow = mysql_fetch_array($query_result))
        {
          echo $showtablerow[0]." ";
        }
?>