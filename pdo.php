<?php
echo "<table style='border: solid 1px black;'>";
echo "<tr><th>Id</th><th>Email</th><th>Fname</th><th>Lname</th><th>Phone</th><th>Birthday</th><th>Gender</th><th>Password</th></tr>";

class tableform extends RecursiveIteratorIterator { 
    function __construct($it) { 
        parent::__construct($it, self::LEAVES_ONLY); 
    }

    function current() {
        return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
    }

    function beginChildren() { 
        echo "<tr>"; 
    } 

    function endChildren() { 
        echo "</tr>" . "\n";
    } 
} 

$servername = "sql2.njit.edu";
$username = "hap56";
$password = "dApqjS3S";
$dbname = "hap56";

try {
    $connc = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $connc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connection Successful" . '<br>';
    $stmt = $connc->prepare("SELECT * FROM accounts WHERE id < 6 "); 
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    foreach(new tableform(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
        echo $v;
    }

}
catch(PDOException $e) {
     $error = $e -> getMessage();
    echo "Connection failed: $error" . '<br>' ;
}
$connc = null;
echo "</table>";
?>
