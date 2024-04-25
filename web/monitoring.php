<!DOCTYPE HTML> <html> <head> <title>OKUPANSI - DIREKTORAT PENGENDALIAN SDPPI</title> 
<link href="tab/dist/css/tabulator.min.css" rel="stylesheet"> <script 
type="text/javascript" src="tab/dist/js/tabulator.min.js"></script> </head> <body> 
<img src="sdppi.png" alt="SDPPI"> <br> <br> <div> <?php include('topmenu.php'); ?> 
<?php $row = 1;
// RUBAH PATH DISINI UNTUK RASPBERRY
$handleSS = fopen("/home/pi/monsfer/config/subservice.csv", "r"); echo '<table 
border="1"id="example-table">'; echo 
'<thead><tr><th>tanggal</th><th>waktu</th><th>subservice</th><th>graph</th></tr></thead>'; 
echo '<tbody>'; while (($dataSS = fgetcsv($handleSS, 1000, ";")) !== FALSE) {
// RUBAH PATH DISINI UNTUK RASPBERRY
	if (($handle = fopen("/home/pi/monsfer/time/monitoring.csv", "r")) !== FALSE) 
	{
		while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) { $num = 
			count($data); echo '<tr>';
						
			for ($c=0; $c < $num; $c++) {
					//echo $data[$c] . "<br />\n";
				if(empty($data[$c])) { $value = "&nbsp;";
				}else{
					$value = $data[$c];
				}
				echo '<td>'.$value.'</td>';
				}								
			$row++; echo '<td>'.$dataSS[1].'</td>'; echo '	<td>';
			//echo ' <a 
			//href="psd.php?link='.$data[0].'_'.str_replace(":","-",$data[1]).'_'.$dataSS[0].'&startf='.$dataSS[2].'&stopf='.$dataSS[3].'&subservice='.$dataSS[1].'&idsubservice='.$dataSS[0].'&tanggal='.$data[0].'&jam='.$data[1].'" 
			//target="_blank"><button type="submit">PSD</button></a>'; 
			//echo ' <a 
			//href="occupancy.php?link='.$data[0].'_'.str_replace(":","-",$data[1]).'_'.$dataSS[0].'&startf='.$dataSS[2].'&stopf='.$dataSS[3].'&subservice='.$dataSS[1].'&idsubservice='.$dataSS[0].'&tanggal='.$data[0].'&jam='.$data[1].'" 
			//target="_blank"><button 
			//type="submit">Occupancy</button></a>';
			echo ' <a 
			href="psdandoccupancy1.php?link='.$data[0].'_'.str_replace(":","-",$data[1]).'_'.$dataSS[0].'&startf='.$dataSS[2].'&stopf='.$dataSS[3].'&subservice='.$dataSS[1].'&idsubservice='.$dataSS[0].'&tanggal='.$data[0].'&jam='.$data[1].'" 
			target="_blank"><button type="submit">PSD & 
			Occupancy</button></a>'; echo '<a href="download.php?filename='.$data[0].'_'.str_replace(":","-",$data[1]).'_'.$dataSS[0].'.csv"><button type="submit" style="margin-left: 10px;">Download</button></a>'; echo ' </td>'; echo '</tr>';
			}			
		}	
    
	fclose($handle);
}
echo '</tbody></table>'; fclose($handleSS); ?> <SCRIPT language=JavaScript> var table 
	= new Tabulator("#example-table", {
		groupBy:["tanggal","waktu"], groupStartOpen:false, 
		layout:"fitDataStretch", columns:[
				{title:"tanggal", field:"tanggal", 
				headerFilter:"input"}, {title:"waktu", field:"waktu", 
				headerFilter:"input"}, {title:"subservice", 
				field:"subservice", headerFilter:"input"}, 
				{title:"graph", field:"graph", formatter:"html"},
		],
	
});

</script> <br><br> <footer> &copy; <em id="date">2021</em>| PSMS | Direktorat 
Pengendalian SDPPI | </footer> </body> </html>
