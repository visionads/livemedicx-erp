<?php
$this->breadcrumbs=array(
    'Master Setup',
	'Settings'=>array('codesparam/masterSetup'),
	'Supplier Group',
);

$this->menu=array(
    array('label'=>'<< Back to Settings', 'url'=>array('codesparam/masterSetup')),
	array('label'=>'New Supplier Group', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}', 'url'=>array('codesparam/createSupplierGroup')),
    /*array('label'=>'Manage Supplier Group', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('suppliermaster/SupplierGroup')),
		array('label'=>'Settings', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/settings_a.png" /></span>{menu}', 'url'=>array(''), 'itemOptions'=>array('class'=>'productsubmenu'),
		'items'=>array(
				array('label'=>'Supplier Group Manage', 'url'=>array('suppliermaster/SupplierGroup')),
	),
	),*/
);
?>


<div id="statusMsg">
    <?php if(Yii::app()->user->hasFlash('success')):?>
        <div class="flash-success">
            <?php echo Yii::app()->user->getFlash('success'); ?>
            <?php

            Yii::app()->clientScript->registerScript(
                'myHideEffect',
                '$(".flash-success").animate({opacity: 1.0}, 9000).fadeOut("slow");',
                CClientScript::POS_READY
            );
            ?>
        </div>
    <?php endif; ?>

    <?php if(Yii::app()->user->hasFlash('error')):?>
        <div class="flash-error">
            <?php echo Yii::app()->user->getFlash('error'); ?>
            <?php

            Yii::app()->clientScript->registerScript(
                'myHideEffect',
                '$(".flash-error").animate({opacity: 1.0}, 9000).fadeOut("slow");',
                CClientScript::POS_READY
            );
            ?>
        </div>
    <?php endif; ?>

</div>


<div id="flag_desc">
    <div id="flag_desc_img"><img src="<?php echo Yii::app()->baseUrl.'/images/why.png'; ?>" /></div>
    <div id="flag_desc_text">
        <b>Supplier Group Setup</b>: In this screen, all of the required fields need to be filled before clicking the button <b>“Enter Supplier Group”</b>. Fields marked with (*) are mandatory. You can go back to your home screen to view all business setup tool(s) by clicking the menu tab <b>“Back to Settings”</b>.  By clicking the icons under <b>“Action”</b> column will allow you to update and delete the specific data.

    </div>
</div>


<div style="width: 98%; float: left;">
    <div style="width: 47%; float: left; margin-right: 3%;">
        <?php echo $this->renderPartial('_form_supplier_group', array('model'=>$model)); ?>
    </div>
    <div style="width: 50%; float: left;">
        <h1 style="background: #FFCCFF; padding: 7px; width: 97%; font-weight: bold; border-radius: 5px; text-align: center;">
            Supplier Group Details
        </h1>
        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'class-grid',
            'dataProvider'=>$data,

            'columns'=>array(
                'cm_type',
                'cm_code',
                'account_name',

                'cm_desc',

                'cm_acctax',

                array(
                    'class'=>'CButtonColumn',
                    'header'=>'Action',
                    'template'=>'{update}{delete}',

                    'afterDelete'=>'function(link,success,data){ if(success) $("#statusMsg").html(data); }',


                    'buttons'=>array
                    (
                        'update' => array
                        (
                            'url'=>
                            'Yii::app()->createUrl("codesparam/updatesm/",
                                                    array("cm_type"=>$data->cm_type, "cm_code"=>$data->cm_code
                                                    ))',
                        ),
                        'delete'=> array
                        (
                            'url'=>
                            'Yii::app()->createUrl("codesparam/delete/",
                                                    array("cm_type"=>$data->cm_type, "cm_code"=>$data->cm_code
                                                    ))',
                        ),
                    ),
                ),
            ),
        )); ?>
    </div>
</div>

