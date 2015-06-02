
<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

$this->title = 'Food Truck Space';
/*
echo 'welcome to dashboard'.'<br/>';
echo 'Email:   '.\Yii::$app->session->get('user.email').'<br/>';
echo 'Last_access:   '.\Yii::$app->session->get('user.last_access');
	

echo '<p>&nbsp;</p>';
echo '<p>&nbsp;</p>';
echo '<p>&nbsp;</p>';
echo '<li><a href="'.Url::toRoute(['/landowner/profile/']).'">profile</a></li>';*/

?>

<div class="container-fluid">
    <div class="row">
        <div class="main_banner_bg_home">
            <div class="container">
                <div class="row">
                    
                    <div class="col-md-12 home_caption">
                    	<p>
                    		FIND A SPACE TO OPERATE YOUR FOOD TRUCK ON<br/>
							OR UPLOAD SPACES YOU WANT TO RENT TO FOOD TRUCKS
                    	</p>
                    </div>

                    <div class="col-md-12">
                    	<div class="row">
 							<?php $form = ActiveForm::begin(['id' => 'search-form']); ?>
                    		<div class="home_search_box">

                    			<div class="col-md-5">
                    				<div class="row">

                    					<div class="col-md-4 home_search_rate">
                    						<div class="row">
                    							<?= $form->field($model, 'rate')
                                                            ->dropDownList(
                                                                [
                                                                    '01'=>'January',
                                                                    '02'=>'February',
                                                                    '03'=>'March',
                                                                    '04'=>'April',
                                                                ],
                                                                ['prompt'=>'Hourly Rate']
                                                            )->label(false);?>
                    						</div>
                    					</div>

                    					<div class="col-md-4">
                    						<div class="row">
                    							<?= $form->field($model, 'date')
                                                            ->dropDownList(
                                                                [
                                                                    '01'=>'January',
                                                                    '02'=>'February',
                                                                    '03'=>'March',
                                                                    '04'=>'April',
                                                                ],
                                                                ['prompt'=>'Date']
                                                            )->label(false);?>
                    						</div>
                    					</div>

                    					<div class="col-md-4">
                    						<div class="row">
                    							<?= $form->field($model, 'time')
                                                            ->dropDownList(
                                                                [
                                                                    '01'=>'January',
                                                                    '02'=>'February',
                                                                    '03'=>'March',
                                                                    '04'=>'April',
                                                                ],
                                                                ['prompt'=>'During']
                                                            )->label(false);?>
                    						</div>
                    					</div>

                    				</div>
                    			</div>

                    			<div class="col-md-7">
                    				<div class="row">

                    					<div class="col-md-9">
                    						<div class="row">
												<?= $form->field($model, 'keyword')->textInput(['placeholder'=>'SEARCH WITH YOUR KEYWORDS  ex. areas of town, zip codes'])->label(false); ?>
                    						</div>
                    					</div>

                    					<div class="col-md-3 home_search_submit">
                    						<div class="row">
                    							<input type="submit" name="submit" value="FIND A PLACE">
                    						</div>
                    					</div>
                    				</div>
                    			</div>


                    		</div>
                    		<?php ActiveForm::end(); ?>

                    	</div>
                    </div>

                    <div class="col-md-12">
                    	<div class="row">
                    		<p class="search_result_count">VIEW ALL 342 SPACES IN DHAKA</p>
                    	</div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

<div class="container-fluid footer_find footer_find_home">
    <div class="row">
        <p><a href="#">FIND OUT HOT SPACES AROUND YOU</a></p>
    </div>
</div>


<div class="container-fluid">
    <div class="row">
        <div class="container">
        	<div class="row">
        		
        		<div class="col-md-8 product_box_container">
		    		<div class="row">

			    		<div class="product_wrapper">
				    		<div class="col-md-6 product_box_cont">
				    			<div class="product_box">
				    				<div class="product_img">
				    					<img src="<?= $this->theme->baseUrl; ?>/assets/img/test.png" alt="">
				    				</div>
				    				<div class="product_details">
				    					<h4>
				    						HOUSE 5, ROAD 3, BANANI
				    					</h4>
				    					<p>
				    						<img src="<?= $this->theme->baseUrl; ?>/assets/img/rating.png">
				    						<span>$100 / Hour</span>
				    					</p>
				    					<a href="#">View owner</a>
				    				</div>
				    			</div>
				    		</div>

				    		<div class="col-md-6 product_box_cont">
				    			<div class="product_box">
				    				<div class="product_img">
				    					<img src="<?= $this->theme->baseUrl; ?>/assets/img/test.png" alt="">
				    				</div>
				    				<div class="product_details">
				    					<h4>
				    						HOUSE 5, ROAD 3, BANANI
				    					</h4>
				    					<p>
				    						<img src="<?= $this->theme->baseUrl; ?>/assets/img/rating.png">
				    						<span>$100 / Hour</span>
				    					</p>
				    					<a href="#">View owner</a>
				    				</div>
				    			</div>
				    		</div>

				    		<div class="col-md-6 product_box_cont">
				    			<div class="product_box">
				    				<div class="product_img">
				    					<img src="<?= $this->theme->baseUrl; ?>/assets/img/test.png" alt="">
				    				</div>
				    				<div class="product_details">
				    					<h4>
				    						HOUSE 5, ROAD 3, BANANI
				    					</h4>
				    					<p>
				    						<img src="<?= $this->theme->baseUrl; ?>/assets/img/rating.png">
				    						<span>$100 / Hour</span>
				    					</p>
				    					<a href="#">View owner</a>
				    				</div>
				    			</div>
				    		</div>

				    		<div class="col-md-6 product_box_cont">
				    			<div class="product_box">
				    				<div class="product_img">
				    					<img src="<?= $this->theme->baseUrl; ?>/assets/img/test.png" alt="">
				    				</div>
				    				<div class="product_details">
				    					<h4>
				    						HOUSE 5, ROAD 3, BANANI
				    					</h4>
				    					<p>
				    						<img src="<?= $this->theme->baseUrl; ?>/assets/img/rating.png">
				    						<span>$100 / Hour</span>
				    					</p>
				    					<a href="#">View owner</a>
				    				</div>
				    			</div>
				    		</div>

				    		<div class="col-md-6 product_box_cont">
				    			<div class="product_box">
				    				<div class="product_img">
				    					<img src="<?= $this->theme->baseUrl; ?>/assets/img/test.png" alt="">
				    				</div>
				    				<div class="product_details">
				    					<h4>
				    						HOUSE 5, ROAD 3, BANANI
				    					</h4>
				    					<p>
				    						<img src="<?= $this->theme->baseUrl; ?>/assets/img/rating.png">
				    						<span>$100 / Hour</span>
				    					</p>
				    					<a href="#">View owner</a>
				    				</div>
				    			</div>
				    		</div>

				    		<div class="col-md-6 product_box_cont">
				    			<div class="product_box">
				    				<div class="product_img">
				    					<img src="<?= $this->theme->baseUrl; ?>/assets/img/test.png" alt="">
				    				</div>
				    				<div class="product_details">
				    					<h4>
				    						HOUSE 5, ROAD 3, BANANI
				    					</h4>
				    					<p>
				    						<img src="<?= $this->theme->baseUrl; ?>/assets/img/rating.png">
				    						<span>$100 / Hour</span>
				    					</p>
				    					<a href="#">View owner</a>
				    				</div>
				    			</div>
				    		</div>

				    		<div class="col-md-6 product_box_cont">
				    			<div class="product_box">
				    				<div class="product_img">
				    					<img src="<?= $this->theme->baseUrl; ?>/assets/img/test.png" alt="">
				    				</div>
				    				<div class="product_details">
				    					<h4>
				    						HOUSE 5, ROAD 3, BANANI
				    					</h4>
				    					<p>
				    						<img src="<?= $this->theme->baseUrl; ?>/assets/img/rating.png">
				    						<span>$100 / Hour</span>
				    					</p>
				    					<a href="#">View owner</a>
				    				</div>
				    			</div>
				    		</div>

				    		<div class="col-md-6 product_box_cont">
				    			<div class="product_box">
				    				<div class="product_img">
				    					<img src="<?= $this->theme->baseUrl; ?>/assets/img/test.png" alt="">
				    				</div>
				    				<div class="product_details">
				    					<h4>
				    						HOUSE 5, ROAD 3, BANANI
				    					</h4>
				    					<p>
				    						<img src="<?= $this->theme->baseUrl; ?>/assets/img/rating.png">
				    						<span>$100 / Hour</span>
				    					</p>
				    					<a href="#">View owner</a>
				    				</div>
				    			</div>
				    		</div>
				    	</div>

		    		</div>
		    	</div>
		    	<div class="col-md-4 pull-right home_sidebar">
		    		<div class="col-md-12">

		    			<img src="<?= $this->theme->baseUrl; ?>/assets/img/map.png">

		    		</div>
		    	</div>

        	</div>
        </div>
    	

    </div>
</div>



<div class="container-fluid">
    <div class="row">
        <div class="container">
        	<div class="row">
        		
        		<div class="col-md-8 product_box_container">
		    		<div class="row">
		    			<div class="col-md-12">
		    				<div class="row">
		    					<div class="hot_deals_home">
		    						HOT DEALS
		    					</div>
		    				</div>
		    			</div>

		    			<div class="product_wrapper">
				    		<div class="col-md-6 product_box_cont">
				    			<div class="product_box">
				    				<div class="product_img">
				    					<img src="<?= $this->theme->baseUrl; ?>/assets/img/test.png" alt="">
				    				</div>
				    				<div class="product_details">
				    					<h4>
				    						HOUSE 5, ROAD 3, BANANI
				    					</h4>
				    					<p>
				    						<img src="<?= $this->theme->baseUrl; ?>/assets/img/rating.png">
				    						<span>$100 / Hour</span>
				    					</p>
				    					<a href="#">View owner</a>
				    				</div>
				    			</div>
				    		</div>

				    		<div class="col-md-6 product_box_cont">
				    			<div class="product_box">
				    				<div class="product_img">
				    					<img src="<?= $this->theme->baseUrl; ?>/assets/img/test.png" alt="">
				    				</div>
				    				<div class="product_details">
				    					<h4>
				    						HOUSE 5, ROAD 3, BANANI
				    					</h4>
				    					<p>
				    						<img src="<?= $this->theme->baseUrl; ?>/assets/img/rating.png">
				    						<span>$100 / Hour</span>
				    					</p>
				    					<a href="#">View owner</a>
				    				</div>
				    			</div>
				    		</div>

				    		<div class="col-md-6 product_box_cont">
				    			<div class="product_box">
				    				<div class="product_img">
				    					<img src="<?= $this->theme->baseUrl; ?>/assets/img/test.png" alt="">
				    				</div>
				    				<div class="product_details">
				    					<h4>
				    						HOUSE 5, ROAD 3, BANANI
				    					</h4>
				    					<p>
				    						<img src="<?= $this->theme->baseUrl; ?>/assets/img/rating.png">
				    						<span>$100 / Hour</span>
				    					</p>
				    					<a href="#">View owner</a>
				    				</div>
				    			</div>
				    		</div>

				    		<div class="col-md-6 product_box_cont">
				    			<div class="product_box">
				    				<div class="product_img">
				    					<img src="<?= $this->theme->baseUrl; ?>/assets/img/test.png" alt="">
				    				</div>
				    				<div class="product_details">
				    					<h4>
				    						HOUSE 5, ROAD 3, BANANI
				    					</h4>
				    					<p>
				    						<img src="<?= $this->theme->baseUrl; ?>/assets/img/rating.png">
				    						<span>$100 / Hour</span>
				    					</p>
				    					<a href="#">View owner</a>
				    				</div>
				    			</div>
				    		</div>
			    		</div>

		    		</div>
		    	</div>

		    	<div class="col-md-4 pull-right home_sidebar" style="margin-top:0;">
		    		<div class="col-md-12">

		    			<img src="<?= $this->theme->baseUrl; ?>/assets/img/add_space.png">

		    		</div>
		    	</div>

        	</div>
        </div>
    	

    </div>
</div>

<div class="container-fluid home_footer">
	<div class="row">
		<div class="container">
			<div class="row">
				<p>copyright information here</p>
			</div>
		</div>
	</div>
</div>