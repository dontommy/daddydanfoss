<?php include('config.php'); ?>
<?php include('functions.php'); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css" />
        <title>Danfoss Solcelle Inverter Log Webinterface</title>
    
    </head>
    <body>
        
        <div id="container">
            
            
            
            
            <div id="menu">
                <h1>Danfoss Solcelle Inverter Log Webinterface</h1>
                
                <?php include('menu.php'); ?>
            </div>
            <div id="main">
          <?php
                    $thedate = $objconn->real_escape_string($_GET['date']);
                    ?><center>
                    
                <h3>Data for <?php echo $thedate; ?></h3>
                <br /><br />

                <table width='700'><tr><td valign='top' align='center'>
                <table width='200'><tr><th>Tid</th><th>Produktion</th></tr><tr>
                <?php
                $sql = "SELECT data,thetime FROM today WHERE thetime LIKE '$thedate%' ORDER BY thetime DESC";
                $result = $objconn->query($sql);
                while($row = $result->fetch_assoc()) {
                    $data = $row['data'];
                    $klok = date('H:i',strtotime($row['thetime']));
                    echo "<td align=center>$klok</td><td align=center>$data</td></tr>";
                }
                
                ?>
                
                    </tr>
                </table></td><td valign='top' align='center'>
                <table width='200'><tr><th>Tid</th><th>Output</th></tr><tr>
                <?php
                $sql = "SELECT data,thetime FROM output WHERE thetime LIKE '$thedate%' ORDER BY thetime DESC";
                $result = $objconn->query($sql);
                while($row = $result->fetch_assoc()) {
                    $data = $row['data'];
                    $klok = date('H:i',strtotime($row['thetime']));
                    echo "<td align=center>$klok</td><td align=center>$data</td></tr>";
                }
                
                ?>
                
                    </tr>
                </table>
                </td></tr></table>
            </div>
        </div>
        <?php
        $sql = "SELECT data,thetime FROM today WHERE thetime LIKE '$thedate%:00:%' AND data != '0' ORDER BY thetime";
        $result = $objconn->query($sql);
        while($row = $result->fetch_assoc()) {

            $dataarray[] = $row['data'];


            $thetime2 = date('H',strtotime($row['thetime']));
		$thetime2 = ltrim($thetime2,'0');
	$newtime = $thetime2-1;
		$datime = $newtime."-".$thetime2;
            $timearray[] = "'$datime'";
           
        }

	$b = 0;
	foreach($dataarray as $a) {
		$c = $a-$b;
		$b = $a;
		$newdata[] = $c;
	}

        $timearr = join(",",$timearray);
        $dataarr = join(",",$newdata);
        ?>
    </body>
</html>
