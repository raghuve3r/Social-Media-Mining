<?php
if(!mysql_connect("localhost","test","shata"))
{
     die('oops connection problem ! --> '.mysql_error());
}
if(!mysql_select_db("smm"))
{
     die('oops database selection problem ! --> '.mysql_error());
}
?>