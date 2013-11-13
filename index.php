<?php include('config.php'); ?>
<?php include('functions.php'); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css" />
        <title>Danfoss Solcelle Inverter Log Webinterface</title>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load('visualization', '1.0', {'packages':['corechart']});
      google.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Dato');
        data.addColumn('number', 'Produktion');
        data.addRows([

<?php
include('config.php');
$sql = "SELECT thetime,thedata FROM finaldata WHERE thetype = 'day' ORDER BY thetime DESC LIMIT 15";
$result = $objconn->query($sql);
$numre = $result->num_rows;
$count = 0;
while($row = $result->fetch_assoc()) {
$count++;
$thetime = $row['thetime'];
$tid1 = date('Y-m-d',strtotime($thetime));
$tid2 = date('d/m',strtotime($thetime));

$thedata = $row['thedata'];

echo "['$tid2',$thedata]";
if($count == $numre) { echo ""; } else { echo ","; }

}


?>
       ]);
        var options = { 
                       'width':1200,
                       'height':300,
                        legend: 'none',
fontSize: 12 
};
        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
    
    </head>
    <body>
        
        <div id="container">
            
            
            
            
            <div id="menu">
                <h1>Danfoss Solcelle Inverter Log Webinterface</h1>
                
                <?php include('menu.php'); ?>
            </div>
            <div id="main">
                  <?php echo OverAllData(); ?><br /><br />
                
                      
                  
                  <h3>Sidste 15 Dage</h3>
                  
<div id="chart_div"></div>                <br /><br />
                <table width='400'><tr><th>Dato</th><th>Produktion</th></tr>

<?php
$sql = "SELECT thetime,thedata FROM finaldata WHERE thetype = 'day' ORDER BY thetime DESC LIMIT 15";
$result = $objconn->query($sql);
while($row = $result->fetch_assoc()) {
	$thetime = $row['thetime'];
	$tid1 = date('Y-m-d',strtotime($thetime));
	$thedata = $row['thedata'];
	echo "<tr><td align=center><a href='datesog.php?date=$tid1'>$tid1</a></td><td align=center>$thedata</td></tr>";
}


?>

</table>
            </div>
        
            
        </div>
        
        <?php
        $timearr = join(",",$timearray);
        $dataarr = join(",",$dataarray);
        ?>
    </body>
</html>
