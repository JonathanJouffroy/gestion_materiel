<!DOCTYPE html>
<?php
    include '../include/bdd.php';
    $pdo = PdoBdd::getPdoBdd();
    $listeAntennes = $pdo->AfficherAntenne();
    $idAntenne = null;
    $materielOperationnel = $pdo->AfficherMaterielOperationnel($idAntenne);

    include 'v_header.php';

    function tinyIntToBoolean($tinyInt) {
        if ($tinyInt == 0) {
            return "Non";
        } else {
            return "Oui";
        }
    }
?>
<html>
    <head>    
        <meta charset="UTF-8">
        <script>
            $(document).ready(function(){
                $(document).on('change', '#listeAntennes', function() {
                    var idAntenne = this.value;
                    if (this.value == "null") {
                        idAntenne = null;
                    }
                    actualiserTableau(idAntenne);
                });
            });

            function actualiserTableau(idAntenne) {
                $.post (
                      "../Controlleurs/c_trierStockOperationnel.php",
                      {
                        idAntenne:idAntenne
                      }, function(data) {
                        var tabMateriel = JSON.parse(data);
                        $("#tableMateriel").find("tbody").empty();

                        tabMateriel.forEach((materiel) => {
                            $("#tableMateriel").find("tbody").append('<tr data-idMateriel="'+materiel['id']+'"><td>'+materiel['nom']+'</td><td>'+materiel['nom_rnmsc']+'</td><td>'+tinyIntToBoolean(materiel['Consommable'])+'</td><td>'+materiel['quantite']+'</td><td>'+tinyIntToBoolean(materiel['packaging'])+'</td><td>'+materiel['lot']+'</td><td>'+materiel['localisation']+'</td><td>'+materiel['date_de_peremption']+'</td><td>'+materiel['stock_minimum']+'</td><td>'+materiel['nomAntenne']+'</td></tr>');
                        })
                      }
                );
            }

            function tinyIntToBoolean(tinyInt) {
                if (tinyInt == 0) {
                    return "Non";
                } else {
                    return "Oui";
                }
            }
        </script>
    </head>

    <body>
        <div class="col-sm-12 col-xs-12">
            <h1 class="text-center">Matériel opérationnel</h1>
            <div class="text-center">
                <span>Antenne :</span>
                <select id="listeAntennes">
                    <option value="null">Tous</option>
                    <?php
                        foreach ($listeAntennes as $antenne)
                        {
                            echo '<option value="'.$antenne['id'].'">'.$antenne['nom'].'</option>';
                        }
                    ?>
                </select>
            </div>
            <span>
                <table class="table" id="tableMateriel">
                    <thead>
                        <tr>
                        <th scope="col">Nom d'usage</th>
                        <th scope="col">RNMSC</th>
                        <th scope="col">Consommable</th>
                        <th scope="col">Quantité</th>
                        <th scope="col">Packaging</th>
                        <th scope="col">Lot</th>
                        <th scope="col">Localisation par local</th>
                        <th scope="col">Date de péremption</th>
                        <th scope="col">Stock minimum</th>
                        <th scope="col">Antenne</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($materielOperationnel as $materiel)
                            {
                                echo '<tr data-idMateriel="'.$materiel['id'].'">
                                        <td>'.$materiel['nom'].'</td>
                                        <td>'.$materiel['nom_rnmsc'].'</td>
                                        <td>'.tinyIntToBoolean($materiel['Consommable']).'</td>
                                        <td>'.$materiel['quantite'].'</td>
                                        <td>'.tinyIntToBoolean($materiel['packaging']).'</td>
                                        <td>'.$materiel['lot'].'</td>
                                        <td>'.$materiel['localisation'].'</td>
                                        <td>'.$materiel['date_de_peremption'].'</td>
                                        <td>'.$materiel['stock_minimum'].'</td>
                                        <td>'.$materiel['nomAntenne'].'</td>
                                    </tr>';
                            }
                        ?>
                    </tbody>
                </table>
            </span>
        </div>
    </body>
</html>