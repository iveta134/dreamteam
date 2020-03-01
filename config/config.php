<?php
//in real life we DO NOT commit sensitive config info to public git repo!
$config = [
    "server" => "localhost",
    "db" => "tenniscollection",
    "user" => "root",
    "pw" => "",
];
//could store also config in a class with properties
//could store as constants etc
//alternative for storing config would be .ini files