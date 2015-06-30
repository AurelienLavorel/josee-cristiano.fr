<?php
    $config = array(
        'title' => 'Josée Cristiano',
        'description' => 'CV de Josée Cristiano',
        'currentPage' => 'photo',
	'page' => '/photo.php',
    );
    $imgPath = '/img/photo/';
    $files = scandir(dirname(__FILE__) . $imgPath);
?>
<?php include 'include/header.php'; ?>

            <div class="inner content">
                <div class="row">
                    <?php foreach ($files as $img) :
                        $webPath = $imgPath . $img;
                        if (!strpos($img, '.txt') && $img != '.' && $img != '..') :
                            ?>
                    <div class="col-lg-6 col-lg-3">
                        <a href="<?php echo $webPath; ?>" class="fancybox thumbnail" title="<?php echo utf8_encode(str_replace('"', '\"', file_get_contents('.' . $webPath . '.txt'))); ?>">
                            <img data-src="holder.js/100%x170" alt="100%x180" src="<?php echo $webPath; ?>" data-holder-rendered="true" style="height: 170px; width: 100%; display: block;">
                        </a>
                    </div>
                    <?php endif;
                    endforeach; ?>
                </div>
            </div>

 <?php include 'include/footer.php'; ?>
