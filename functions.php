<?php
function OverAllData() {
    include('config.php');
    $sql = "SELECT data FROM today ORDER BY thetime DESC LIMIT 1";
    $result = $objconn->query($sql);
    while($row = $result->fetch_assoc()) {
        $headtoday = $row['data'];
    }
    $sql = "SELECT data FROM output ORDER BY thetime DESC LIMIT 1";
    $result = $objconn->query($sql);
    while($row = $result->fetch_assoc()) {
        $headoutput = $row['data'];
    }
    $sql = "SELECT data FROM total ORDER BY thetime DESC LIMIT 1";
    $result = $objconn->query($sql);
    while($row = $result->fetch_assoc()) {
        $headtotal = $row['data']/1000;
    }

    $table = "<center>";
    $table .= "<table width='400'><tr>";
    $table .= "<td>Produktion Idag:</td>";
    $table .= "<td>$headtoday Wh</td>";
    $table .= "</tr>";
    $table .= "<tr>";
    $table .= "<td>Output Nu:</td>";
    $table .= "<td>$headoutput W</td>";
    $table .= "</tr><tr>";
    $table .= "<td>Total Produktion:</td>";
    $table .= "<td>$headtotal KWh</td>";
    $table .= "</tr></table>";  
    return $table;
}
        
?>        

                
