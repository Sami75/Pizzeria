<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../CSS/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">



</head>
<body>
    <?php
    include '../PHP/cnx.php';

    $clients = $bdd->prepare("select * from clients");
    $clients->execute();
    
    $livreurs = $bdd->prepare("select * from livreurs");
    $livreurs->execute();

    $numCommande = $bdd->prepare("select max(numCde) as numCde from commandes");
    $numCommande->execute();

    $pizzas = $bdd->prepare("select * from pizzas");
    $pizzas->execute();

    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row text-center">
                    <div class="col-md-4 border">
                        <p class="lead"> Numéros de Commande </p>
                    </div>
                    <div class="col-md-4 border">
                        <p class="lead"> Choix du livreur </p>
                    </div>
                    <div class="col-md-4 border">
                        <p class="lead"> Choix du clients </p>
                    </div>
                    <div class="col-md-4 verrouiller">
                        <?php
                            foreach($numCommande->fetchAll(PDO::FETCH_ASSOC) as $nc) {
                                echo "<input name='commande' type='hidden' id='numCde' value=".$nc['numCde'].">";
                                echo "<p class='lead'>".$nc['numCde']."</p>";
                            }
                        ?>
                    </div>
                    <div class="col-md-4 border">
                        <?php
                            echo "<select name='livreur' id='livreur'>";
                            foreach($livreurs->fetchAll(PDO::FETCH_ASSOC) as $livreur) {
                                echo "<option value='".$livreur['numLiv']."'>".$livreur['nomLiv']."</option>";
                            }
                            echo"</select>"
                        ?>
                    </div>
                    <div class="col-md-4 border">
                        <?php
                            echo "<select name='client' id='client'>";
                            foreach($clients->fetchAll(PDO::FETCH_ASSOC) as $client) {
                                echo "<option value='".$client['numCli']."'>".$client['nomCli']."</option>";
                            }
                            echo"</select>"
                        ?>
                    </div>
                    <div class="col-md-12 border text-center">
                        <p class="lead">Choix des pizzas</p>
                    </div>
                    <table class="table table-hover border">
                        <thead>
                            <tr>
                                <th>Nom pizza</th>
                                <th>Nombre de personnes</th>
                                <th>Prix</th>
                                <th>Quantité</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $compteur = 0;
                                foreach($pizzas->fetchAll(PDO::FETCH_ASSOC) as $pizza) {
                                    echo"<tr>";
                                        echo"<td>".$pizza['nomPiz']."</td>";
                                        echo"<td>".$pizza['nbPers']."</td>";
                                        echo"<td>".$pizza['prix']."</td>";
                                        echo"<td>
                                                <input type='range' id='range' min='0' max='10' value='0' onchange='quantite(this.value, ".$compteur.", ".$pizza['prix'].")'>
                                                <input type='text' id=".$compteur." value='0' disabled>
                                            </td>";
                                    echo"</tr>";
                                    $compteur++;
                                }
                            ?>
                        </tbody>
                    </table>
                    <div class="col-md-12 border text-center">
                        <input type='text' id='total' value='0' disabled>
                    </div> 
                    <input class="btn btn-primary btn-block" type="button" value="Commander" onclick="commander()">             
                </div>
            </div>
        </div>
    </div>
    
<script src="../JS/mesfonctions.js"></script>

</body>
</html>