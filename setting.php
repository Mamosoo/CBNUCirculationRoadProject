<?php
	error_reporting(E_ALL & ~E_NOTICE);
    $user_id=$_GET[user_id];
    $con=mysqli_connect("127.0.0.1","root","1234","db1");

	$query="SELECT name FROM `USER` WHERE id=$user_id";

    $cur=mysqli_query($con,$query);

    $result=array();
    $result[name]=mysqli_fetch_array($cur, MYSQLI_ASSOC)[name];

    $query="SELECT * FROM LOCATION WHERE user_id=$user_id";

    $cur=mysqli_query($con,$query);

    $result[data]=array();
    while($row=mysqli_fetch_array($cur,MYSQLI_ASSOC)){

    	$result[data][]=$row;
    }

    
    echo json_encode($result);

?>