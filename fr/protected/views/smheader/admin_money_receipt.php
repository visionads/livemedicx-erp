<?php
/* @var $this SmheaderController */
/* @var $model Smheader */

$this->breadcrumbs=array(
    'Sales',
	'Money Receipt'=>array('smheader/adminmoneyreceipt'),
	'Create Money Receipt',
);

$this->menu=array(
	array('label'=>'Manage Money Receipt', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('smheader/manageMoneyReceipt')),
	/*array('label'=>'Post to GL', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/post_gl_a.png" /></span>{menu}', 'url'=>array('smheader/mrPostToGl')),
	array('label'=>'Settings', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/settings_a.png" /></span>{menu}', 'url'=>array(''), 'itemOptions'=>array('class'=>'productsubmenu'),
		'items'=>array(
				array('label'=>'Money Receipt No', 'url'=>array('transaction/managemoneyreceiptno')),
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
        <b>Réception d'argent:</b>
        Cet écran vous permettra de visualiser l'historique  des factures reçues par les clients.  Pour le réçu de l'argent cliquer sur le lien dans la colonne <b>" Code du client" </b>. Le lien vous redirigera vers un nouvel écran d'entrée pour la réception de l'argent. Pour afficher les détails pour le client cliquer sur le bouton sous la colonne <b>"Visualiser  la a réception  d'argent"</b>. Pour annuler ou Confirmer, aller à  l'écran de gestion en cliquant sur l'onglet du menu <b>"Gérer la a réception  d'argent"</b> .

    </div>
</div>




<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'sm-header-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'cm_code',	
		array(
				'class'=>'CLinkColumn',
                'header'=>'Code du client',
                'labelExpression'=>'$data->cm_code',
                'urlExpression'=>'array("smheader/createmoneyreceipt",
                                            "cm_code"=>$data->cm_code, "cm_name"=>$data->cm_name, "sm_branch"=>$data->cm_branch,
                                        )',
                ),
		'cm_name',	
		'cm_group',
        'cm_branch',
		'cm_address',	
		'cm_cellnumber',	
		'sm_receivable',
        array(
            'class'=>'CButtonColumn',
            'header'=>"Visualiser la réception d'argent ",
            'template'=>'{view}',
            'buttons'=>array(
                'view'=>array(
                    'url'=>'Yii::app()->createUrl("smheader/viewMrAlc", array("cm_cuscode"=>$data->cm_code,"asDialog"=>1))',
                    'options'=>array(
                        'ajax'=>array(
                            'type'=>'POST',
                            // ajax post will use 'url' specified above
                            'url'=>"js:$(this).attr('href')",
                            'update'=>'#id_view',
                        ),
                    ),
                ),
            ),
        ),
	),
)); ?>



<?php $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id'=>'money_receipt',
    'options'=>array(
        'title'=>'Money Receipt List',
        'width'=> 'auto',
        'height'=>'auto',
        'autoOpen'=>false,
        'resizable'=>true,
        'modal'=>true,
        'closeOnEscape' => true,
        'show'=>array('effect'=>'blur', 'duration'=>500,),
        'hide'=>array('effect'=>'blind', 'duration'=>500,),
    ),
    'htmlOptions' => array(
        'style' => 'font-size: 12px; line-height: 30px;',
    ),

)); ?>


    <div id="id_view"></div>

<?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>