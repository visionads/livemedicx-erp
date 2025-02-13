<?php
/* @var $this ItImtoapController */
/* @var $model ItImtoap */

$this->breadcrumbs=array(
	'Inventory',
	'Reports'=>array('sareport/inventoryReports'),
	'Reporting',
);
?>
<style type="text/css">
	#report_main_div{
		width: 96%; 
		float: left;
		color: orange;
		margin-left: 30px;
	}
	#report_button{
		width: 95%; 
		float: left;
	}

	#report_button a {
		text-decoration: none;
		color: white;
		width: 55%;
		float: left;
		text-align: center;
		margin-top: 10px;
		padding: 17px 30px;
		background: #4085BB;
		border-radius: 2px;
		font-size: 16px;
        box-shadow: 10px 3px 5px #aaa;
	}
	#report_button a:hover {
		background: #2F6088;
	}

</style>

<div id="flag_desc">
    <div id="flag_desc_img"><img src="<?php echo Yii::app()->baseUrl.'/images/why.png'; ?>" /></div>
    <div id="flag_desc_text">Sur cet écran, vous avez la possibilité de visualiser les rapports de gestion des approvisionnements. </div>
</div>



<div style="width: 98%; margin: 0 auto;">
	<div style="width: 48%; float:left; margin-right: 2%">
		<div id="report_main_div"> 
			<div id="report_button">
				<?php echo CHtml::link("Inventaire d'articles",array('sareport/itemLedger')); ?>
			</div>	
		</div>

		<div id="report_main_div"> 
			<div id="report_button">
				<?php echo CHtml::link('Mouvements des approvisionnements',array('sareport/inventoryMovement')); ?>
			</div>
		</div>

		<div id="report_main_div"> 
			<div id="report_button">
				<?php echo CHtml::link(' Attribution des stock',array('sareport/stockDispatch')); ?>
			</div>
		</div>

		<div id="report_main_div">
			<div id="report_button">
				<?php echo CHtml::link(' Reste du stock',array('sareport/stockBalance')); ?>
			</div>
		</div>

		<div id="report_main_div">
			<div id="report_button">
				<?php echo CHtml::link('Reste du stock après ajustement',array('sareport/stockBalanceAfterAd')); ?>
			</div>
		</div>

	</div>
	<div style="width: 50%; float:left;">
		<div id="report_main_div">
			<div id="report_button">
				<?php echo CHtml::link('Liste des produits Expirés',array('sareport/expiredProductList')); ?>
			</div>
		</div>
	</div>
</div>





