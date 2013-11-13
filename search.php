<?php include('config.php'); ?>
<?php include('functions.php'); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css" />
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
        <title>Danfoss Solcelle Inverter Log Webinterface</title>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
  <script>
  $(function() {
    $( "#fra" ).datepicker({dateFormat: 'yy-mm-dd'});
$( "#til" ).datepicker({dateFormat: 'yy-mm-dd'});
  });
  </script>    
    </head>
    <body>
        
        <div id="container">
            
            
            
            
            <div id="menu">
                <h1>Danfoss Solcelle Inverter Log Webinterface</h1>
                
                <?php include('menu.php'); ?>
            </div>
            <div id="main">
              
                  <center>
                  <h3>Søg</h3>
                  
                  <form action="" method="POST">
                      <label for="fra">Fra Dato:</label><input type="text" name="fradato" id="fra"><br /><br />
                      <label for="til">Til Dato:</label><input type="text" name="tildato" id="til"><br /><br />
                      <input type="submit" name="submit" value="Søg">
                      
                  </form>
<br /><br />                  
                  <?php if(isset($_POST['submit'])) { 
                      $fradato = $_POST['fradato'];
                      $tildato = $_POST['tildato'];
                      
                      ?>

<div id="chart_div"></div>                <br /><br />
                <table width='400'><tr><th>Dato</th><th>Produktion</th></tr>
<?php
$sql = "SELECT thetime,thedata FROM finaldata WHERE thetype = 'day' AND thetime BETWEEN '$fradato' AND '$tildato' ORDER BY thetime DESC";
$result = $objconn->query($sql);
while($row = $result->fetch_assoc()) {

$thetime = $row['thetime'];
$tid1 = date('Y-m-d',strtotime($thetime));
$tid2 = date('d/m',strtotime($thetime));

$thedata = $row['thedata'];


echo "<tr><td align=center><a href='datesog.php?date=$tid1'>$tid1</a></td><td align=center>$thedata</td></tr>";


$timearray[] = "'$tid1'";
$dataarray[] = $thedata;

}


?>




</table>                        
                  <?php } ?>  
            </div>
        
            
        </div>

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
$sql = "SELECT thetime,thedata FROM finaldata WHERE thetype = 'day' AND thetime BETWEEN '$fradato' AND '$tildato' ORDER BY thetime DESC";
#$sql = "SELECT thetime,thedata FROM finaldata WHERE thetype = 'day' ORDER BY thetime DESC";
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
</body></html>
