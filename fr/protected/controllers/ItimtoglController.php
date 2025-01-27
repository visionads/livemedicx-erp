<?php

class ItimtoglController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','admin','delete', 'GetIM','ImToGlAdmin', 'DataExists'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Itimtogl;

				$model->inserttime = date("Y-m-d H:i");
                $model->insertuser = Yii::app()->user->name;

        $imtogl = $this->actionImToGlAdmin();

		if(isset($_POST['Itimtogl']))
		{
			$model->attributes=$_POST['Itimtogl'];
            try{
                if($model->save()){
                    Yii::app()->user->setFlash('success','Success Message : Success Message: IM to GL Created Successfully  !');
                }else{
                    Yii::app()->user->setFlash('error',' Warning Message: Invalid request !');
                }
            }catch(CDbException $e){
                Yii::app()->user->setFlash('error',' Warning Message: Invalid request !');
            }
				$this->redirect(array('create'));
		}

		$this->render('create',array(
			'model'=>$model, 'imtogl'=>$imtogl,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

				$model->inserttime = date("Y-m-d H:i");
                $model->insertuser = Yii::app()->user->name;

        $imtogl = $this->actionImToGlAdmin();

		if(isset($_POST['Itimtogl']))
		{
			$model->attributes=$_POST['Itimtogl'];

			try{
                if($model->save(false)){
                    Yii::app()->user->setFlash('success', Yii::t('imtogl', 'Success Message: IM to GL Created Successfully !'));
                }else{
                     Yii::app()->user->setFlash('error', Yii::t('transaction', 'Warning Message: Invalid request !'));
                }
            }catch(CDbException $e){
                 Yii::app()->user->setFlash('error', Yii::t('transaction', 'Warning Message: Already Exists !'));
            }
				$this->redirect(array('create'));
		}

		$this->render('create',array(
			'model'=>$model, 'imtogl'=>$imtogl,
		));
	}

    private function actionImToGlAdmin()
    {
        $model=new Itimtogl('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Itimtogl']))
            $model->attributes=$_GET['Itimtogl'];
        return $model;
    }
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Itimtogl');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Itimtogl('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Itimtogl']))
			$model->attributes=$_GET['Itimtogl'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Itimtogl the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Itimtogl::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Itimtogl $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='itimtogl-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	
	//search account debit or credit
	public function actionGetIM() 
		{
			
		  if (!empty($_GET['term'])) {
			
			$sql = 'SELECT am_accountcode as value, am_description as label FROM  am_chartofaccounts WHERE am_description LIKE :qterm ';

			$command = Yii::app()->db->createCommand($sql);
			$qterm = '%'.$_GET['term'].'%';
			$command->bindParam(":qterm", $qterm, PDO::PARAM_STR);
			$result = $command->queryAll();
					
			echo CJSON::encode($result); exit;
		  } else {
			return false;
		  }
		  
		}

    private function actionDataExists($c_branch,$c_trncode, $c_group){
        $model = new Itimtogl;
        return $model->exists('c_branch=:c_branch', 'c_trncode=:c_trncode', 'c_group=:c_group', array(':c_branch'=>$c_branch, ':c_trncode'=>$c_trncode, ':c_group'=>$c_group));

    }
}
