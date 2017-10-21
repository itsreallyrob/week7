<?php

echo "<table style='border: solid 1px black;'>";
echo "<tr><th>Id</th><th>Firstname</th><th>Lastname</th></tr>";

class TableRows extends RecursiveIteratorIterator {
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







$hostname = "sql2.njit.edu";
$username = "rjc43";
$password = "pxNGdj5c";
try {
	    $conn = new PDO("mysql:host=$hostname;dbname=rjc43", $username, $password);
	    echo "Connected successfully </br>"; 




	    $result1 = $conn->prepare("SELECT count(*) id, fname, lname FROM accounts WHERE id<6"); 
		$result1->bindParam(':p', $q, PDO::PARAM_INT);
		$result1->execute();
		$rowCount = $result1->fetchColumn(0);
		echo $rowCount . "</br>";











		
        $stmt = $conn->prepare("SELECT id, fname, lname FROM accounts WHERE id<6");

	    $stmt->execute();



	    // set the resulting array to associative
	    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
	    	$count++;
	        echo $v;
	    }

    }
catch(PDOException $e)
    {
    	echo "Connection failed: " . $e->getMessage() + "</br>";
    }




echo "</table>";

$conn = null;
?>