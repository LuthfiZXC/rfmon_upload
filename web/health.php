
<!DOCTYPE HTML> <html> <head> <title>SCANNER - DIREKTORAT PENGENDALIAN SDPPI</title> <link href="tab/dist/css/tabulator.min.css" rel="stylesheet"> <script type="text/javascript" 
src="tab/dist/js/tabulator.min.js"></script> </head> <body"> <img src="sdppi.png" alt="SDPPI"> <?php include('topmenu.php'); ?>
 <br> <div>
    <button id="download-csv">Download CSV</button> </div> <br> 
<?php 

$row = 1; 
if (($handle = fopen("/home/pi/monsfer/health/health.csv", "r")) !== FALSE) { 
	echo '<table border="1"id="example-table">'; 
	echo '<thead><tr><th>tanggal</th><th>waktu</th><th>cpu utilitas</th><th>suhu cpu</th><th>free SD card</th><th>kapasitas SD card</th><th>free RAM</th><th>total RAM</th></tr></thead>'; 
	echo '<tbody>';
	while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
        	$num = count($data);
			
           	echo '<tr>';
        		
        	for ($c=0; $c < $num; $c++) {
            //echo $data[$c] . "<br />\n";
            		if(empty($data[$c])) { 
				$value = "&nbsp;";
            		}else{
               			$value = $data[$c];
            		}
            
                echo '<td>'.$value.'</td>';
            
        }
        
            echo '</tr>';
        
        $row++;
    }
    echo '</tbody></table>'; fclose($handle);
}
?> <SCRIPT language=JavaScript> 
	var table = new Tabulator("#example-table", { 
		groupBy:["tanggal"],
		groupStartOpen:false,
		layout:"fitDataStretch",
		columns:[ 	{title:"tanggal", field:"tanggal", headerFilter:"input"}, 
				{title:"waktu", field:"waktu", headerFilter:"input"}, 
				{title:"cpu utilitas", field:"cpu utilitas", headerFilter:"input"}, 
				{title:"suhu cpu", field:"suhu cpu", headerFilter:"input"}, 
				{title:"free SD card", field:"free SD card", headerFilter:"input"}, 
				{title:"kapasitas SD card", field:"kapasitas SD card", headerFilter:"input"}, 
				{title:"free RAM", field:"free RAM", headerFilter:"input"}, 
				{title:"total RAM", field:"total RAM", headerFilter:"input"},
		],
	
});
//trigger download of data.csv file
document.getElementById("download-csv").addEventListener("click", function(){ table.download("csv", "statistik-kondisi-alat.csv");
});
function sort_default() {
	//table.setSort("tanggal","desc"); table.setSort("frekuensi","desc"); table.setSort("waktu","desc");
};
</script> <br><br> <footer> &copy; <em id="date">2021</em>| PSMS | Direktorat Pengendalian SDPPI | </footer> </body> </html>
