<?php
    $config = array(
        'title' => 'Josée Cristiano',
        'description' => 'CV de Josée Cristiano',
        'currentPage' => 'cv',
	'page' => '/cv.php',
    );
    $imgPath = '/img/design/';
    $files = scandir(dirname(__FILE__) . $imgPath);
    $star = '<span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span>';
    $starLess = '<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>';
?>
<?php include 'include/header.php'; ?>

            <div class="inner content">
                <div class="row-fluid">
                    <div class="span10">
                        <p>Bonjour, je suis Josée Cristiano. Bienvenue sur mon site.</p>
                        <p>Actuellement étudiante motivée par le graphisme et la photographie,</p>
                        <p>j'ai décidé de vous faire part de mes différents projets.</p>
                        <p>&nbsp;</p>
                        <table class="table borderless cv-table">
                            <tr>
                                <td class="col-md-2">&nbsp;</td>
                                <td><h3 class="blueleft">Suite Logicielle</h3></td>
                            </tr>
                            <tr>
                                <td class="col-md-4">Illustrator</td>
                                <td><img src="/img/comp/illustrator.png" /></td>
                            </tr>
                            <tr>
                                <td class="col-md-4">Photoshop CS3 - CS6</td>
                                <td><img src="/img/comp/illustrator.png" /></td>
                            </tr>
                            <tr>
                                <td class="col-md-4">In Design</td>
                                <td><img src="/img/comp/illustrator.png" /></td>
                            </tr>
                            <tr>
                                <td class="col-md-4">Premiere Pro</td>
                                <td><img src="/img/comp/premiere.png" /></td>
                            </tr>
                        </table>
                        <table class="table borderless cv-table">
                            <tr>
                                <td class="col-md-2">&nbsp;</td>
                                <td><h3 class="blue">Parcours de Formation</h3></td>
                            </tr>
                            <tr>
                                <td class="col-md-2">2013</td>
                                <td>Début du Bachelor<br />En même temps que le BTS</td>
                            </tr>
                            <tr>
                                <td class="col-md-2">&nbsp;</td>
                                <td>Début de formation en BTS Design Graphique<br />Ecole Presqu'île, Lyon (69)</td>
                            </tr>
                            <tr>
                                <td class="col-md-2">2012</td>
                                <td>MANAA : mise à niveau en arts appliqués<br />Ecole Presqu'île, Lyon (69)</td>
                            </tr>
                            <tr>
                                <td class="col-md-2">2011</td>
                                <td>Baccalauréat professionnel comptabilité, mention AB<br />Lycée Sainte Famille, La-Roche-sur-Foron (74)</td>
                            </tr>
                        </table>
                        <table class="table borderless cv-table">
                            <tr>
                                <td class="col-md-2">&nbsp;</td>
                                <td><h3 class="blue">Parcours Professionel</h3></td>
                            </tr>
                            <tr>
                                <td class="col-md-2">2014</td>
                                <td>Agence Kiwee Rouge, Lyon (69) - 1 mois<br />Stage de formation en graphisme</td>
                            </tr>
                            <tr>
                                <td class="col-md-2">2014</td>
                                <td>Agence C Commpub, Annemasse (74) - 1 semaine<br />Stage d'observation en imprimerie</td>
                            </tr>
                            <tr>
                                <td class="col-md-2">2014</td>
                                <td>Magasin Monoprix, Annemasse (74) - 1,5 mois<br />Travail en hôtesse de caisse</td>
                            </tr>
                            <tr>
                                <td class="col-md-2">2012</td>
                                <td>Société Cobham, Annemasse (74) - 1 mois<br />Stage de formation en comptabilité et administratif</td>
                            </tr>
                            <tr>
                                <td class="col-md-2">2011</td>
                                <td>Société Prosys SA, Fillinges (74) - 1 mois<br />Stage de formation en comptabilité et administratif</td>
                            </tr>
                            <tr>
                                <td class="col-md-2">2011</td>
                                <td>Société Alves Stores, Vetraz-Monthoux (74) - 1 mois<br />Stage de formation en comptabilité et administratif</td>
                            </tr>
                            <tr>
                                <td class="col-md-2">2010</td>
                                <td>Magasin Géant Casino, Annemasse (74) - 1 mois<br />Stage de formation en comptabilité, administratif et rayonnage</td>
                            </tr>
                        </table>

                        <?php /*
                        <h4>2013</h4>
                        <p>Début du Bachelor<br />En même temps que le BTS</p>
                        <p>Début de formation en BTS Design Graphique<br />Ecole Presqu'île<br />Lyon (69)</p>
                        <h4>2012</h4>
                        <p>MANAA : mise à niveau en arts appliqués<br />Ecole Presqu'île<br />Lyon (69)</p>
                        <h4>2011</h4>
                        <p>Baccalauréat professionnel comptabilité, mention AB<br />Lycée Sainte Famille, La-Roche-sur-Foron (74)</p>*/ ?>
                    </div>
                </div>
            </div>

 <?php include 'include/footer.php'; ?>
