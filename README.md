# Examination 3 1DV610
Repository for assignment 3 in 1DV610 at Linnaeus University
Built in PHP 7.1.16

## Login 
A build on dntolls login https://github.com/dntoll/1dv610/tree/master/assignments/A2_resources
A login system built with SQL database that registers new-, authenticates- and logs out- users.

### Usage
Requires an SQL-database.
Inside app/model/DatabaseConnection.php the constants can be changed to correct values:

$server = SERVER_ADRESS;
$database = DATABASE;
$username = DB_USERNAME;
$password = DB_PASSWORD;

## Encryption
Encryption is a small application that is meant to hold many crypto systems. 
Right now there is only Caesar Cipher.

### Usage
The module encrypt is uable by instantiation of Start class,
then call its render() method and show its return in an echo or similar inside a html-document.

$enc = new \encrypt\Start();
echo $enc->render();

## Use Cases and tests
Available on the github wiki:
https://github.com/joelcarlss/1DV610L3/wiki
