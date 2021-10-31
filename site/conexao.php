<?php
$Oracle = oci_connect("system", "3301", "localhost/XE");
if($Oracle)
{
  /*echo*/ 'si';
}
else
{
  /*echo*/ "no";
}
	
?>