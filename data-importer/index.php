<?php
namespace silverorange\DevTest;

require __DIR__ . '/../vendor/autoload.php';

$config = new Config();
$db = (new Database($config->dsn))->getConnection();

//////////////////////////////////////////////////////////////////////////
// *****************NOTE*****************
//////////////////////////////////////////////////////////////////////////
//
// This file would not be accessible to front end users, would be run by a developer as a one off to import data
//
// If this was to be an ongoing process a more secure way of improting would be used and locked behind various permissions
//
//////////////////////////////////////////////////////////////////////////

// Define directory for importing
$dataDirectory = "/data";

// Prep select query to check if data exists
$selectQuery = "SELECT * FROM posts WHERE id=:id";
$selectRun = $db->prepare($selectQuery);

// Prep insert query
$insertQuery = "INSERT INTO posts(id,title,body,created_at,modified_at,author) VALUES(:id,:title,:body,:created_at,:modified_at,:author)";
$insertRun = $db->prepare($insertQuery);
$insertCount = 0;

// Put the files into an array for looping
$fileArray = scandir($_ENV['DOCUMENT_ROOT'].$dataDirectory);

// Loop around files
foreach ($fileArray as $key => $fileName) {

    $fullFileName = $_ENV['DOCUMENT_ROOT'].$dataDirectory."/".$fileName;

    // Ignore folders
    if (($fileName != "." && $fileName != "..")) {
        // Read contents into variable
        $fileContents = json_decode(file_get_contents($fullFileName));

        // Check if they're populated
        if (!empty($fileContents->id) 
            && !empty($fileContents->title) 
            && !empty($fileContents->body)
            && !empty($fileContents->created_at)
            && !empty($fileContents->modified_at)
            && !empty($fileContents->author)) {

            // Prep and run a select
            $selectRun->bindValue(':id', $fileContents->id);
            $selectRun->execute(); 
            $selectPost = $selectRun->fetch();

            if (!$selectPost) {
                // We are safe to insert, let's go ahead
                $insertRun->bindValue(':id', $fileContents->id);
                $insertRun->bindValue(':title', $fileContents->title);
                $insertRun->bindValue(':body', $fileContents->body);
                $insertRun->bindValue(':created_at', $fileContents->created_at);
                $insertRun->bindValue(':modified_at', $fileContents->modified_at);
                $insertRun->bindValue(':author', $fileContents->author);
                $insertRun->execute();

                $insertCount++;
            } 

        }

    } 

}

// Debug output to see what we're working with
echo "<pre>";
echo "<h2>Insert Count</h2>";
echo $insertCount;
echo "<hr>";
echo "<h2>File List</h2>";
print_r($fileArray);
echo "<hr>";
echo "<h2>File Name - Last Example</h2>";
echo $fileName;
echo "<hr>";
echo "<h2>File Contents - Last Example</h2>";
print_r($fileContents);
echo "</pre>";