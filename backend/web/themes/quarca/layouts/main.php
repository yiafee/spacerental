<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
      <meta charset="<?= Yii::$app->charset ?>"/>
      <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/><![endif]-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
      <?= Html::csrfMetaTags(); ?>
      
      <title><?= Html::encode($this->title) ?></title>

      <?php $this->head() ?>

      <link href="<?php echo $this->theme->baseUrl; ?>/assets/css/style.css" rel="stylesheet">

      <?php
          $this->registerJsFile($this->theme->baseUrl."/assets/js/bootstrap.min.js", ['depends' => [\yii\web\JqueryAsset::className()]]);

      ?>

</head>
    
<body>
    <div class="container-fluid header_wrap">
      <div class="container main_header">
        <div class="row">


          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="row">

                <div class="logo">
                  <a href="<?= Url::base(''); ?>">
                    <img src="<?= $this->theme->baseUrl; ?>/assets/img/logo.png" alt="Logo">
                  </a>
                </div>

            </div>
          </div>

          <div class="col-md-8 col-sm-8 col-xs-12">
            <div class="row">

              <div class="right_nav">
                <ul>
                  <li><a href="<?= Url::toRoute(['/site/index']); ?>">Dashboard</a></li>
                  <li><a href="<?= Url::toRoute(['/user/index']); ?>">User</a></li>
                  <li>
                    <a href="<?= Url::toRoute(['/site/logout']); ?>" data-method="post">Logout</a>
                    <img src="<?= $this->theme->baseUrl; ?>/assets/img/three_dot.png">
                  </li>
                </ul>
              </div>

            </div>
          </div>



        </div>
      </div>
    </div>

    <!--header ends-->



    <div class="container-fluid">
      <div class="container">

          <div class="row">
            
            <?= $content ?>
          </div>
      </div>
    </div>


    <?php $this->endBody() ?>
</body>



<!-- Mirrored from cazylabs.com/themes-demo/quarca/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 02 Apr 2015 20:06:23 GMT -->
</html>
<?php $this->endPage() ?>