<?php
$path = `count.txt`;
$file = fopen($path, `r`);
$count = fgets($file, 1000);
fclose($file);
$count = abs(intval($count)) + 1;
echo "You are visitor No. $count!";
$file = fopen($path, `w`);
fwrite($file, $count);
fclose($file);

$file = fopen(`mytext.txt`, `r`);
$mystr = fgets($file);
echo "<p>My text: $mystr</p>";
fclose($file);

$contents = file('mytext.txt');
var_dump($contents);
foreach ($contents as $line) {
    echo $line . "<br>";
}