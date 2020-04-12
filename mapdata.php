<?php
// Write a JSON string with an address
$address = array (
    "address" => "4300 Steeles Ave E, Markham, ON L3R 0Y5"
);

// The line below prints:
// { "address": "4300 Steeles Ave E, Markham, ON L3R 0Y5"}
print json_encode($address);

// decode