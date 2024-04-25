<!DOCTYPE HTML> <html> <head> <title>WIFI SCANNER - DIREKTORAT PENGENDALIAN 
SDPPI</title> <link href="tab/dist/css/tabulator.min.css" rel="stylesheet"> <script 
type="text/javascript" src="tab/dist/js/tabulator.min.js"></script> </head> <body onload="sort_default()"> 

<img src="sdppi.png" alt="SDPPI">
<?php include('topmenu.php'); ?>
<br>
<div>
    <button id="download-csv">Download CSV</button>
</div>

<br>
<?php $row = 1; 
	// RUBAH PATH DISINI UNTUK RASPBERRY

	if (($handle = fopen("/home/pi/monsfer/wifi_scanner/wifi.iw.csv", "r")) !== FALSE) {
		echo '<table border="1" id="example-table">'; 
		while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
        		$num = count($data); 
			if ($row == 1) { echo '<thead><tr>';
		        }else{
           		 echo '<tr>';
        		}
        for ($c=0; $c < $num; $c++) {
            //echo $data[$c] . "<br />\n";
            if(empty($data[$c])) { $value = "&nbsp;";
            }else{
               $value = $data[$c];
            }
            if ($row == 1) { echo '<th>'.$value.'</th>';
            }else{
                echo '<td>'.$value.'</td>';
            }
        }

        if ($row == 1) { echo '</tr></thead><tbody>';
        }else{
            echo '</tr>';
        }
        $row++;
    }
    echo '</tbody></table>'; fclose($handle);
}
?> <SCRIPT language=JavaScript> var table = new Tabulator("#example-table", { 
		groupBy:["tanggal", "frekuensi", "ssid"],
		groupStartOpen:false,
		layout:"fitDataStretch",
		initialSort:[
			{column:"tanggal", dir:"desc"},
			{column:"frekuensi", dir:"asc"},
//			{column:"waktu", dir:"desc"},
//			{column:"ssid", dir:"asc"},
		],
		columns:[
			{title:"tanggal", field:"tanggal", headerFilter:"input"}, 
			{title:"waktu", field:"waktu", headerFilter:"input"}, 
			{title:"mac address", field:"mac address", headerFilter:"input"}, 
			{title:"frekuensi", field:"frekuensi", headerFilter:"input"}, 
			{title:"level", field:"level", headerFilter:"input"}, 
			{title:"ssid", field:"ssid", headerFilter:"input"},
			{title:"perangkat", field:"perangkat", headerFilter:"input"},
		],
	
});

//trigger download of data.csv file
document.getElementById("download-csv").addEventListener("click", function(){
    table.download("csv", "wifi-scanner.csv");
});

function sort_default() {
	//table.setSort("tanggal","desc");
	//table.setSort("frekuensi","desc");
	//table.setSort("waktu","desc");
};

</script>

<br><br>  
<footer>
      &copy; <em id="date">2024</em>|     PSMS    |    Direktorat Pengendalian SDPPI    |
    </footer>


 </body> </html>
