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

                $(document).on('click', '.modifier', function() {
                    $.post (
                      "../Controlleurs/c_modifierMaterielOperationnel.php",
                      {
                        id:$(this).parent().parent().attr("data-idMateriel"),
                        nom:$(this).parent().parent().find("td").find(".nom").val(),
                        nom_rnmsc:$(this).parent().parent().find("td").find(".nom_rnmsc").val(),
                        lot:$(this).parent().parent().find("td").find(".lot").val(),
                        quantite:$(this).parent().parent().find("td").find(".quantite").val(),
                        localisation:$(this).parent().parent().find("td").find(".localisation").val(),
                        peremption:$(this).parent().parent().find("td").find(".peremption").val(),
                        stock_minimum:$(this).parent().parent().find("td").find(".stock_minimum").val()
                      }, function(data) {
                        var idAntenne = $("#listeAntennes").val();
                        if (idAntenne == "null") {
                            idAntenne = null;
                        }
                        actualiserTableau(idAntenne);
                      }
                    );
                });

                $(document).on('click', '.supprimer', function() {
                    $.post (
                      "../Controlleurs/c_supprimerMaterielOperationnel.php",
                      {
                        id:$(this).parent().parent().attr("data-idMateriel")
                      }, function() {
                        var idAntenne = $("#listeAntennes").val();
                        if (idAntenne == "null") {
                            idAntenne = null;
                        }
                        actualiserTableau(idAntenne);
                      }
                    );
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
                            $("#tableMateriel").find("tbody").append('<tr data-idMateriel="'+materiel['id']+'"><td><input type="text" class="nom" value="'+materiel['nom']+'"/></td><td><input type="text" class="nom_rnmsc" value="'+materiel['nom_rnmsc']+'"/></td><td>'+tinyIntToBoolean(materiel['Consommable'])+'</td><td><input type="text" class="quantite" value="'+materiel['quantite']+'"/></td><td>'+tinyIntToBoolean(materiel['packaging'])+'</td><td><input type="text" class="lot" value="'+materiel['lot']+'"/></td><td><input type="text" class="localisation" value="'+materiel['localisation']+'"/></td><td><input type="text" class="peremption" value="'+materiel['date_de_peremption']+'"/></td><td><input type="text" class="stock_minimum" value="'+materiel['stock_minimum']+'"/></td><td>'+materiel['nomAntenne']+'</td><td><input type="button" class="btn btn-primary modifier" value="Modifier"/></td><td><input type="button" class="btn btn-danger supprimer" value="Supprimer"/></td></tr>');
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
            <h1 class="text-center">Gérer le stock opérationnel</h1>
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
                        <th scope="col"></th>
                        <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($materielOperationnel as $materiel)
                            {
                                echo '<tr data-idMateriel="'.$materiel['id'].'">
                                        <td><input type="text" class="nom" value="'.$materiel['nom'].'"/></td>
                                        <td><input type="text" class="nom_rnmsc" value="'.$materiel['nom_rnmsc'].'"/></td>
                                        <td>'.tinyIntToBoolean($materiel['Consommable']).'</td>
                                        <td><input type="text" class="quantite" value="'.$materiel['quantite'].'"/></td>
                                        <td>'.tinyIntToBoolean($materiel['packaging']).'</td>
                                        <td><input type="text" class="lot" value="'.$materiel['lot'].'"/></td>
                                        <td><input type="text" class="localisation" value="'.$materiel['localisation'].'"/></td>
                                        <td><input type="text" class="peremption" value="'.$materiel['date_de_peremption'].'"/></td>
                                        <td><input type="text" class="stock_minimum" value="'.$materiel['stock_minimum'].'"/></td>
                                        <td>'.$materiel['nomAntenne'].'</td>
                                        <td><input type="button" class="btn btn-primary modifier" value="Modifier"/></td>
                                        <td><input type="button" class="btn btn-danger supprimer" value="Supprimer"/></td>
                                    </tr>';
                            }
                        ?>
                    </tbody>
                </table>
            </span>
        </div>
    </body>
</html>