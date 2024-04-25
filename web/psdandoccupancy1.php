
<?php
//Occupancy
$csvs = '/home/pi/monsfer/occupancy/'.$_GET["tanggal"].'*'.$_GET["idsubservice"].'.csv';
//$tanggal = '2021-09-01';
//$idsubservice = '06';
$startF = $_GET["startf"];//88000000;
$stopF = $_GET["stopf"];//108000000;//960000000;
//$csvs = 'home/pi/monsfer/occupancy/'.$tanggal.'*'.$idsubservice.'.csv';
//$csv = 'time,frequency,occupied'."\r\n"; 
$csv = ""; 
foreach (glob($csvs) as $filename) {
    $jam = substr(basename($filename),11,2);//"$filename size " . filesize($filename) . "\n";
	if (($handle = fopen($filename, "r")) !== FALSE) {
		while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
			//echo 'jam-> '.$jam.', frekuensi-> '.$data[0].', occupancy-> '.$data[1]."\n";
			if ($data[1]=='1') { 
				$csv = $csv.'{ y:'.$jam.', x:'.$data[0].'},';
				}
		}
	}
	
}
//echo $csv;
?>

<!DOCTYPE html>
<html>
<?Php
//Level PSD
// RUBAH PATH DISINI UNTUK RASPBERRY
$csvpsds = '/home/pi/monsfer/level/'.$_GET["link"].'.csv';
//echo $csvpsd;
$csvpsd ="";
        if (($handle = fopen($csvpsds, "r")) !== FALSE) {
                while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                        //echo 'jam-> '.$jam.', frekuensi-> '.$data[0].', occupancy-> '.$dat$
                        //if ($data[1]=='1') {
                                $csvpsd = $csvpsd.'{ y:'.$data[1].', x:'.$data[0].'},';
                        //        }
                }
        }
//echo $csvoccupancy;


$csv2 = '/home/pi/monsfer/occupancy/'.$_GET["link"].'.csv';
$tittle = 'PSD Subservice ' .$_GET["subservice"]. ' ,tanggal ' .$_GET["tanggal"] . ' ,jam ' .$_GET["jam"];
$tittleOccupancy = 'Occupancy Subservice ' .$_GET["subservice"]. ' ,tanggal ' .$_GET["tanggal"] ;
//echo $csv;

//$csv='test.csv';
?>
<head>
<title><?Php echo "'".$tittle."'";?></title>
<script type="text/javascript" src="chart/jquery-3.6.0.js"></script>
<script type="text/javascript" src="chart/canvasjs.min.js"></script>

<script type="text/javascript">
    window.onload = function() {
		var dataPoints = [];
		var chart = new CanvasJS.Chart("chartContainerPSD", {
		    title: {
		         text: <?Php echo "'".$tittle."'";?>,
		    },
			zoomEnabled:true,
			zoomType: "xy",
			rangeChanged: syncHandler,
			axisY:{
				minimum: -120,
				maximum: -40
			},
		    data: [{
		         type: "line",
		         dataPoints: [
                        <?php
                                echo $csvpsd;
                        ?>
                ]

		      }]
	     });
		 
		 
		 
		 var chart2 = new CanvasJS.Chart("chartContainerOCCUPANCY", {
			animationEnabled: true,
			zoomEnabled: true,
			zoomType: "x",
			rangeChanged: syncHandler,
			title:{
				text: <?Php echo "'".$tittleOccupancy."'";?>
			},
			axisY: {
				//title:"Area (in sq. ft)",
				minimum: -0.5,
				maximum: 24
			},
			axisX: {
				//title:"Area (in sq. ft)",
				gridThickness: 1,
				minimum: <?php	echo $startF;?>,
				maximum: <?php	echo $stopF;?>
			},
	
			data: [{
				type: "scatter",
				color: "red",
				markerType: "square",
				markerSize: 10,
				toolTipContent: "<b>frekuensi: </b>{x} <br/><b>Jam: </b>{y}",
				dataPoints: [ 
					<?php
						echo $csv;
					?>
				]
			}]
		});
		 
		chart.render();
		chart2.render();


		var charts = [chart1, chart2]; // add all charts (with axes) to be synced
 
function syncHandler(e) {
 
    for (var i = 0; i < charts.length; i++) {
        var chart = charts[i];
 
        if (!chart.options.axisX) 
	    chart.options.axisX = {};
        
        if (!chart.options.axisY) 
            chart.options.axisY = {};
 
        if (e.trigger === "reset") {
            
            chart.options.axisX.viewportMinimum = chart.options.axisX.viewportMaximum = null;
            chart.options.axisY.viewportMinimum = chart.options.axisY.viewportMaximum = null;
	    
            chart.render();
	
        } else if (chart !== e.chart) {
            
            chart.options.axisX.viewportMinimum = e.axisX[0].viewportMinimum;
            chart.options.axisX.viewportMaximum = e.axisX[0].viewportMaximum;
            
            chart.options.axisY.viewportMinimum = e.axisY[0].viewportMinimum;
            chart.options.axisY.viewportMaximum = e.axisY[0].viewportMaximum;
 
            chart.render();
 
        }
    }
}
	};
       
</script>
</head>
<body>
	<div id="chartContainerPSD" style="width:100%; height:300px;"></div>
	<div id="chartContainerOCCUPANCY" style="width:100%; height:300px;"></div>

</body>
</html>

