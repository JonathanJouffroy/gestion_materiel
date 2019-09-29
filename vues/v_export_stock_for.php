<?php

include '../include/bdd.php'; 
$pdo = PdoBdd::getPdoBdd();
$date = date("d/m/y");
$jour = substr($date, 0,2);
$mois = substr($date, 2,4);
$annee = substr($date, 5,6);
$afficherFOR = $pdo->AfficherMaterielFROMA();
ob_start();
?>
<page backleft="10mm">
    <link href="../css/style.css" rel="stylesheet" type="text/css"/>
		<link rel="stylesheet" type="text/css" media="print" href="../css/pdf.css" />
	        <img align='left'src="../images/logo.png" style="width: 10%;"/>
                <h1 align='center'><i>Export des stocks des matériels de formation</i></h1>
                <br>
       <h4 align='left'>Edité le : <?php echo $date?> </h4>

                <br><br>
 <table align='center'>
     
   
     <tr class='trRole'>
        <th class="thRole">NOM</th>
        <th class="thRole">NOM RNMSC </th>
        <th class="thRole">LOT</th>
        <th class="thRole">QUANTITÉ</th>
        <th class="thRole">DATE DE PÉREMPTION</th>
        <th class="thRole">STOCK MINIMUM</th>
        <th class="thRoleRight">Antenne</th>
      </tr>                       
                        
    

<?php

foreach($afficherFOR as $affFor)
{
    if($affFor['id_Antennes'] == 1)
    {
        $antenne = 'Ain';
    }
    else if($affFor['id_Antennes'] == 2)
    {
        $antenne =  'Balan';
    }
    else if($affFor['id_Antennes'] == 3)
    {
         $antenne =  'Bellegarde';
    }
    else if($affFor['id_Antennes'] == 4)
    {
         $antenne = 'Frans';
    }
    else if($affFor['id_Antennes'] == 5)
    {
         $antenne =  'Gex';
    }
    else if($affFor['id_Antennes'] == 6)
    {
         $antenne = 'Leyment';
    }
    else if($affFor['id_Antennes'] == 7)
    {
        $antenne = 'Oyonnax';
    }
    else if($affFor['id_Antennes'] == 8)
    {
       $antenne = 'Péronnas';
    }
    else if($affFor['id_Antennes'] == 9)
    {
        $antenne =  'Saint Etienne du Bois';
    }
    else if($affFor['id_Antennes'] == 10)
    {
         $antenne =  'Saint Genis';
    }
?>
   <tr>
      <td class="tdRole" style='text-align: center;'><?php echo $affFor['nom'];?></td>
      <td class="tdRole" style='text-align: center;'><?php echo $affFor['nom_rnmsc']; ?></td>
      <td class="tdRole" style='text-align: center;'><?php echo $affFor['type_formation']; ?></td>
      <td class="tdRole" style='text-align: center;'><?php echo $affFor['quantite']; ?></td>
      <td class="tdRole" style='text-align: center;'><?php echo $affFor['date_de_peremption']; ?></td>
      <td class="tdRole" style='text-align: center;'><?php echo $affFor['stock_minimum']; ?></td>
      <td class='tdRoleRight' style='text-align: center;'><?php echo $antenne ?></td>
    </tr>
  <?php
}
  ?>
  </table>

    
</page>
<?php
$content = ob_get_clean();
require('../html2pdf/html2pdf.class.php');
try
{
    $pdf = new HTML2PDF('P','A4','fr');
    $pdf->pdf->SetDisplayMode('fullpage');
    $pdf->writeHTML($content);
    $pdf->Output( 'Export.pdf');
} catch (HTML2PDF_exception $e) {
    die($e);
}
?>