<?php 


#### Socket  Response functions ####

// latest prices received
function fcs_data_received($data){
	echo "\n  -------------- NEW ------------  : ".$data['s']. " \n";
    print_r(($data));
}

// socket successfull connect  message
function fcs_successfully($data){
    echo "\n fcs_successfully : ";
    print_r($data);
}

// log message from server
function fcs_message($data){
	echo "\n fcs_message : ";
    print_r($data);
}

// message, when disconnect from server
function fcs_disconnect($data){
    echo "\n fcs_disconnect : ";
    print_r($data);
}
