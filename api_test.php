<?php

set_time_limit(600);

require('ET_Client.php');
$myclient = new ET_Client();

// Retrieve Response Data
$retrieveFields = array("EventDate","SubscriberKey");
//$retrieveFields = array("SendID","SubscriberKey","EventDate","Client.ID","EventType","BatchID","TriggeredSendDefinitionObjectID","PartnerKey");

//$retrieveFilter = array('Property' => 'EventDate','SimpleOperator' => 'greaterThan','DateValue' => "2016-08-08T13:00:00.000");
$retrieveFilter = array('Property' => 'SendID','SimpleOperator' => 'equals','Value' => "19");


// Example for Different Events
$myResponseEvent = new ET_ClickEvent();
//$myResponseEvent = new ET_BounceEvent();
//$myResponseEvent = new ET_OpenEvent();
//$myResponseEvent = new ET_SentEvent();


// This is generic for all event types
$myResponseEvent->authStub = $myclient; 		// set auftentification
$myResponseEvent->props = $retrieveFields;		// set fields we want to retrieve
$myResponseEvent->filter = $retrieveFilter;		// set filters
$myResponseEvent->getSinceLastBatch = false;	
$getResponse = $myResponseEvent->get();			// first pull (max 2500 entries)


$index = 0;
$responseObj = array();
$responseObj["totalCount"] = count($getResponse->results);
$responseObj["totalDataFrames"] = 1;
$responseObj["results_0"] = $getResponse->results;
flush();

// if more than 2500 entries are available, we will get them in 2500 item slices 
while($getResponse->moreResults) {
	$getResponse = $myResponseEvent->getMoreResults();
	$index++;
	$responseObj["totalDataFrames"]++;
	$responseObj["totalCount"] += count($getResponse->results);
	$responseObj["results_" . $index] = $getResponse->results;
}

echo json_encode($responseObj);
