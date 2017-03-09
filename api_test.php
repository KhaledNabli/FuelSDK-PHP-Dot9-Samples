<?php

@header('Content-type: application/json');

require('ET_Client.php');
$myclient = new ET_Client();

// Retrieve Response Data
$retrieveFields = array("SendID","SubscriberKey","EventDate","Client.ID","EventType","BatchID","TriggeredSendDefinitionObjectID","PartnerKey");

//$retrieveFilter = array('Property' => 'EventDate','SimpleOperator' => 'greaterThan','DateValue' => "2016-03-08T13:00:00.000");
$retrieveFilter = array('Property' => 'SendID','SimpleOperator' => 'equals','Value' => "414");


// Example for Clicks
/*
$clickevent = new ET_ClickEvent();
$clickevent->authStub = $myclient;
$clickevent->props = $retrieveFields;
$clickevent->filter = $retrieveFilter;
$clickevent->getSinceLastBatch = false;
$results = $clickevent->get();
*/

// Example for BounceEvent
/*
$getBounceEvent = new ET_BounceEvent();
$getBounceEvent->authStub = $myclient;
$getBounceEvent->props = $retrieveFields;
$getBounceEvent->filter = $retrieveFilter;
$getBounceEvent->getSinceLastBatch = false;
$results = $getBounceEvent->get();
*/

// Example for OpenEvent
/*
$openevent = new ET_OpenEvent();
$openevent->authStub = $myclient;
$openevent->props = $retrieveFields;
$openevent->filter = $retrieveFilter;
$openevent->getSinceLastBatch = false;
$results = $openevent->get();
*/

// Create a Data Extension
/*
$dataextension = new ET_DataExtension();
$dataextension->authStub = $myclient;
$dataextension->props = array("Name" => "SDKDataExtension", "Description" => "SDK Created Data Extension");
$dataextension->columns = array();
$dataextension->columns[] = array("Name" => "Key", "FieldType" => "Text", "IsPrimaryKey" => "true","MaxLength" => "100", "IsRequired" => "true");
$dataextension->columns[] = array("Name" => "Value", "FieldType" => "Text");
$results = $dataextension->post();
*/


$totalCount = count($results->results);
$results->resultSize = $totalCount;

echo json_encode($results);