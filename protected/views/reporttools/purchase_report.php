<?php
/* @var $this ItImtoapController */
/* @var $model ItImtoap */

include('header.php');
?>
<style type="text/css">
	#report_main_div{
		width: 96%; 
		float: left;
		color: orange;
		margin-left: 30px;
	}
	#report_button{
		width: 33%; 
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
	}
	#report_button a:hover {
		background: #2F6088;
	}

</style>

<div id="flag_desc">
    <div id="flag_desc_img"><img src="<?php echo Yii::app()->baseUrl.'/images/why.png'; ?>" /></div>
    <div id="flag_desc_text">
        <b>Report</b>: In this screen, you have the choice of viewing the Purchase Module Report(s).
         </div>
</div>



<div style="width: 98%; margin: 0 auto;">

	<div id="report_main_div"> 
		<div id="report_button">
			<?php echo CHtml::link('Purchase Order Report',array('reporttools/purchaseOrdRepo')); ?>
		</div>	
	</div>
	<!--
	<div id="report_main_div"> 
		<div id="report_button">
			<?php //echo CHtml::link('Trial Balance for ALL',array('reporttools/trialBlanceAll')); ?>
		</div>
	</div>

	<div id="report_main_div"> 
		<div id="report_button">
			<?php //echo CHtml::link('Chart of Account List',array('reporttools/chartOfAccount')); ?>
		</div>
	</div>
	
	<div id="report_main_div"> 
		<div id="report_button">
			<?php //echo CHtml::link('Journal Transaction',array('reporttools/journalTransaction')); ?>
		</div>
	</div>
	-->
</div>






<!-- 
 $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'it-imtoap-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'item_group',
		'sup_group',
		'debit_account',
		//'credit_account',
		'active',
		/*
		'inserttime',
		'updatetime',
		'insertuser',
		'updateuser',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
 -->
