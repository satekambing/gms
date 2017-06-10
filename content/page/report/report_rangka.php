<?php
include ('header_report.php');
//Query data part_kode dari estimasipart 
$es = mysql_query("SELECT part_kode FROM estimasipart WHERE es_kode = '$es_kode'");
$jmlpart = mysql_num_rows($es);

// Buat Table dahulu
  echo "<table width='100%' id='border' align='center' cellpadding='3' cellspacing='1'>
        <tr><td colspan=6 class=noborder><div class=judul><strong>GESEK NOMOR RANGKA & MESIN</strong></div></td>
            
        </tr>    
        <tr>
        <td>&nbsp</td>
        </tr>
        
         <tr>
        <td>&nbsp</td>
        </tr>
        </table>
        <table align=center width=70% > 
        <tr>
        <td colspan=6 class=norangka>GESEK RANGKA</td></tr>
        
        <tr>
        <td>&nbsp</td>
        </tr>
        
        <tr>
        <td>&nbsp</td>
        </tr>
        
        <tr>
        <td colspan=6 class=norangka>GESEK MESIN</td>
        </tr>"; 
?>
</table> 
</div>
</body>
</html>