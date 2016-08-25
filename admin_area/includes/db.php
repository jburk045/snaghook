<?php
	
	// upload
	 $con = mysqli_connect("snaghookcom.domaincommysql.com","fishawk","STONEcrabs469$","snaghook");
	
	// Local
	//$con = mysqli_connect("localhost","root","","snaghook");
	
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL".mysqli_connect_error();
	}
?>