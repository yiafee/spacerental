<?php
	use yii\helpers\Html;
	use yii\helpers\Url;
?>

<?php
	if(isset($url)){
?>
	<div class="col-md-4" id="image_<?= $model->id; ?>">
		<div class="img">

			<div id="loader_<?= $model->id; ?>"></div> 
            <div class="del_image" data_id="<?= $model->id; ?>">x</div>


			<img src="<?= $url; ?>" alt="<?= $model->title; ?>">
		</div>
		<div class="img_title">
			
		</div>
		<div class="img_desc">
			
		</div>
	</div>

<?php
	}
?>