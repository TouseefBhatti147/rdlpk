<?php

class PaymentController extends Controller
{
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */

	 
	public function actionCreate()
	{
		if(Yii::app()->session['user_array']['per2']=='1')
			{
		
		$error = '';
		if((isset($_POST['plot_id']) && empty($_POST['plot_id'])) || (isset($_POST['payment_type']) && empty($_POST['payment_type'])) || (isset($_POST['amount']) && empty($_POST['amount'])) || (isset($_POST['by_mem_id']) && empty($_POST['by_mem_id'])))
		{
			$error = 'Please complete all required fields <br />';
		}
			if($error==''){
					  // Insert in to member a new member
                                        $connection = Yii::app()->db;  
                                        $sql  = 'INSERT INTO payment 
                                                (plot_id,payment_type, amount, by_mem_id, create_date)
                                                VALUES ( "'.$_POST['plot_id'].'", "'.$_POST['payment_type'].'", "'.$_POST['amount'].'", "'.$_POST[		'by_mem_id'].'", "'.date('Y-m-d h:i:s').'")';		
                        		$command = $connection -> createCommand($sql);
                                        $command -> execute();
                                        $transferto_memberid=Yii::app()->db->getLastInsertID();						 
					  // $transferto_memberid = 
                                    }else{
										$this->redirect(array('transferplot'=>$error)); 
                                        exit();
					 
                                    }
			}
		
		
	}
        

	public function actionPayment()
	{
		if(Yii::app()->session['user_array']['per2']=='1')
			{
			$layout='//layouts/column1';
			
			$this->render('Payment');
			}
	}
	
	
}
