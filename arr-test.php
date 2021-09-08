<div style="text-align:center" id="container">
<?php
if (isset($_GET['len']) && isset($_GET['list'])) {
    $len = $_GET['len'];
$list = explode('*',$_GET['list']);
echo "<div class='res'>
La liste par défaut: <br/>";

$c = 1;
foreach ($list as $value) {
    echo "$value  ";
    $c = $c + 1;
}
echo "</div>
<div class='res'>
La liste ordonnée: <br/>";
$b = 1;
sort($list);
$sorted_list = $list;
foreach ($sorted_list as $value) {
    echo "$value  ";
    $b = $b + 1;
}
"</div>";
}
if (isset($_GET['q']) && $_GET['q'] != '') {
    $q = $_GET['q'];
    $list = explode('*',$_GET['list']);
    $q = $q - 1;
    echo "<br/>
    valeur recherchée $q = $list[$q]";
   }
?>
<form action="" method="get">
    <label for="len">
        Saisissez la taille maximale de la liste
    </label>
    <br/>
    <input type="tel" name="len" id="len">
    <br/>
    <label for="list">
        Saisissez chaque valeur de la liste, séparée par une étoile ("*");
    </label>
    <br/>
    <input type="tel" name="list" id="tel">
    <br/>
    <input type="submit" value="Soumettre">
    <br/>
    <label for="q">
        Rechercher une valeur du tableau:
    </label>
    <br/>
    <input type="tel" name="q" id="q">
    <br/>
    <input type="submit" value="recherche">
</form>
</div>