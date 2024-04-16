<?php

class PlotsController extends Controller

{   
    
     public function actionAjaxBlock($val1)
    {
        $connection = Yii::app()->db;
        $sql_blocks = "SELECT * from blocks where project_id='" . $val1 . "'";
        $result_blocks = $connection->createCommand($sql_blocks)->query();
        $blocks = array();
        foreach ($result_blocks as $blk) {
            $blocks[] = $blk;
        }
        echo json_encode($blocks);
        exit();
    }
	public function actionAjaxBlock1($val1)
    {
        $connection = Yii::app()->db;
        $sql_blocks = "SELECT * from blocks where project_id='" . $val1 . "'";
        $result_blocks = $connection->createCommand($sql_blocks)->query();
        $blocks = array();
        foreach ($result_blocks as $blk) {
            $blocks[] = $blk;
        }
        echo json_encode($blocks);
        exit();
    }
    
    ///////////////////////START:RESIDENTIAL ALLOCATION PLOTS SUMMARY//////
 public function actionNos_plots_detail()
	 { 
	   		 if((Yii::app()->session['user_array']['per3']=='1')  || (Yii::app()->session['user_array']['per34'] == '1')) {
		 	 $connection = Yii::app()->db;	
		     $this->render('nos_plots_detail');
			  }
			  else{
					$this->redirect(array('user/dashboard'));
					}		 
	 }
 public function actionPending_files_detail()
	 { 
	   		 if((Yii::app()->session['user_array']['per3']=='1')  || (Yii::app()->session['user_array']['per34'] == '1')) {
		 	 $connection = Yii::app()->db;	
		     $this->render('pending_files_detail');
			  }
			  else{
					$this->redirect(array('user/dashboard'));
					}		 
	 }
public function actionTotal_rsvd_plots_detail()
	 { 
	   		 if((Yii::app()->session['user_array']['per3']=='1')  || (Yii::app()->session['user_array']['per34'] == '1')) {
		 	 $connection = Yii::app()->db;	
		     $this->render('total_rsvd_plots_detail');
			  }
			  else{
					$this->redirect(array('user/dashboard'));
					}		 
	 }
	 public function actionTotal_sold_plots_detail()
	 { 
	   		 if((Yii::app()->session['user_array']['per3']=='1')  || (Yii::app()->session['user_array']['per34'] == '1')) {
		 	 $connection = Yii::app()->db;	
		     $this->render('total_sold_plots_detail');
			  }
			  else{
					$this->redirect(array('user/dashboard'));
					}		 
	 }
	  public function actionOther_rsvd_plots_detail()
	 { 
	   		 if((Yii::app()->session['user_array']['per3']=='1')  || (Yii::app()->session['user_array']['per34'] == '1')) {
		 	 $connection = Yii::app()->db;	
		     $this->render('other_rsvd_plots_detail');
			  }
			  else{
					$this->redirect(array('user/dashboard'));
					}		 
	 }
	 public function actionAgainstland_rsvd_plots_detail()
	 { 
	   		 if((Yii::app()->session['user_array']['per3']=='1')  || (Yii::app()->session['user_array']['per34'] == '1')) {
		 	 $connection = Yii::app()->db;	
		     $this->render('againstland_rsvd_plots_detail');
			  }
			  else{
					$this->redirect(array('user/dashboard'));
					}		 
	 }
	 public function actionAgainstland_plots_detail()
	 { 
	   		 if((Yii::app()->session['user_array']['per3']=='1')  || (Yii::app()->session['user_array']['per34'] == '1')) {
		 	 $connection = Yii::app()->db;	
		     $this->render('againstland_plots_detail');
			  }
			  else{
					$this->redirect(array('user/dashboard'));
					}		 
	 }
	 public function actionTotal_villas_detail()
	 { 
	   		 if((Yii::app()->session['user_array']['per3']=='1')  || (Yii::app()->session['user_array']['per34'] == '1')) {
		 	 $connection = Yii::app()->db;	
		     $this->render('total_villas_detail');
			  }
			  else{
					$this->redirect(array('user/dashboard'));
					}		 
	 }

	 public function actionSelected_balloted_detail()
	 { 
	   		 if((Yii::app()->session['user_array']['per3']=='1')  || (Yii::app()->session['user_array']['per34'] == '1')) {
		 	 $connection = Yii::app()->db;	
		     $this->render('selected_balloted_detail');
			  }
			  else{
					$this->redirect(array('user/dashboard'));
					}		 
	 }	 
	 public function actionSold_villas_detail()
	 { 
	   		 if((Yii::app()->session['user_array']['per3']=='1')  || (Yii::app()->session['user_array']['per34'] == '1')) {
		 	 $connection = Yii::app()->db;	
		     $this->render('sold_villas_detail');
			  }
			  else{
					$this->redirect(array('user/dashboard'));
					}		 
	 }
	 public function actionSearchallocsum()
	{
		if ((Yii::app()->session['user_array']['per3'] == '1')  || (Yii::app()->session['user_array']['per34'] == '1') || (Yii::app()->session['user_array']['id'] == '68')) 
	

			//for Pagination end
			$connection = Yii::app()->db;

			$sql_project = "SELECT * from projects where id=" . $_POST['project'] . "";
			$result_project = $connection->createCommand($sql_project)->queryRow();
			$count = 0;
			$home = Yii::app()->request->baseUrl;
			$check = 1;
			$res = array();
			$count++;
			echo $count . ' result found';
			$home = "";
			$home = Yii::app()->request->baseUrl;
			$gtp = 0;
			$gtsv = 0;
			$gtusv = 0;
			$gtv = 0;
			$gtselected = 0;
			$gtal = 0;
			$gtps = 0;
			$gtalrsvd = 0;
			$gtothrrsvd = 0;
			$gtrsvd = 0;
			$gtbo = 0;
			$gtpf = 0;
			$gtfnb = 0;
			$g = 0;
			$F = '';
			$M = '';
			$inc = 0;
			$open = 0;
			$plotsallocated = 0;
			$hrlreserved = 0;
			$againstland = 0;
			$topen = 0;
			$thrlreserved = 0;
			$tagainstland = 0;
			$tvillas = 0;
			$total = 0;
			$gtotal = 0;
			$tselected = 0;
			$op = 0;
			$against_landress = '';
			$talresvdres = 0;
			$com_res = '';
			$tp = 0;
			$tv = 0;
			$tor = 0;
			
			$talr = 0;
			$tbo = 0;
			$ts = 0;
			$block = '';
			$where='';
			$and='';
			$block = $_POST['block'];
			if (!empty($_POST['block'])) {
				if ($and == true) {
					$where .= " and block_id LIKE '%" . $_POST['block'] . "%'";
				} else {
					$where .= " and block_id LIKE '%" . $_POST['block'] . "%'";
				}
				$and = true;
			}
			
			if ($_POST['com_res'] == 'Residential') {
    		$com_res = 'R';
			}
			if ($_POST['com_res'] == 'Commercial') {
				$com_res = 'C';
			}
		
			  $sql_plots  = "SELECT * from size_cat where typee='" . $com_res . "' Order by size_cat.size_sorting";
		    $result_plots = $connection->createCommand($sql_plots)->queryAll();
			foreach ($result_plots as $row1) {
				 $sql_total  = "SELECT count(size2) as tsize from plots
				where size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "'  and type !='file'".$where."";

			   
	           $tsiz = $connection->createCommand($sql_total)->queryRow();
				
				$inc++;
				if($tsiz['tsize']>0){
				echo '<tr><td>' . $inc . '</td><td>' . $row1['size'];
				if ($_POST['com_res'] == 'Residential') {
					echo '&nbsp; (Residential)';
				}
				if ($_POST['com_res'] == 'Commercial') {
					echo '&nbsp; (Commercial)';
				}
				echo '</td>';
				if(!empty($block)){
				   $totalplots  = "SELECT * from plots
	 where size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "' and block_id='" . $block . "' and type !='file'";
				}
				if(empty($block))
				{
				  $totalplots  = "SELECT * from plots
	 where size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "'  and type !='file'";   
				}
				$totalplotsres = $connection->createCommand($totalplots)->query();
				echo '<td style="text-align:right"><a target="_blank" href="total_plots_detail?com_res=' . $com_res . '&size=' . $row1['id'] . '&&project_id=' . $_POST['project'] . '&&block_id='.$_POST['block'].'">';
				if(count($totalplotsres)==0){ echo'';} else{ echo count($totalplotsres);}   echo'</a></td>';
				$tp = count($totalplotsres);
                	if(!empty($block)){
				$soldvillas  = "SELECT * from plots
	 where size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "' and block_id='" . $block . "'  and status !='' and type='Villa'";
                	}else{
                	    	$soldvillas  = "SELECT * from plots
	 where size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "'   and status !='' and type='Villa'";
                	}
				$ressoldvillas = $connection->createCommand($soldvillas)->query();
				echo '<td style="text-align:right"><a target="_blank" href="sold_villas_detail?com_res=' . $com_res . '&size=' . $row1['id'] . '&&project_id=' . $_POST['project'] . '&&block_id='.$_POST['block'].'"">
				';
				if(count($ressoldvillas)==0){ echo'';} else{ echo count($ressoldvillas);} echo '</a></td>';
				$gtsv = $gtsv + count($ressoldvillas);
					if(!empty($block)){
				$unsoldvillas  = "SELECT * from plots
	 where size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "' and block_id='" . $block . "' and type='Villa' and status='' and  `ctag` LIKE '%Villas%' ";
				}else{
				 	$unsoldvillas  = "SELECT * from plots
	 where size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "'  and type='Villa' and status='' and  `ctag` LIKE '%Villas%' ";
   
				}
				$unsoldvillasres = $connection->createCommand($unsoldvillas)->query();
				$gtusv = $gtusv + count($unsoldvillasres);
				echo '<td style="text-align:right"><a target="_blank" href="reserved_villas_detail?com_res=' . $com_res . '&size=' . $row1['id'] . '&&project_id=' . $_POST['project'] . '&&block_id='.$_POST['block'].'">';
				if(count($unsoldvillasres)==0){ echo'';} else{ echo count($unsoldvillasres);} echo '</a></td>';
					if(!empty($block)){
				 $villassql  = "
SELECT * FROM plots where size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "' and block_id='" . $block . "' AND plots.type = 'Villa'  AND plots.status != ''
 UNION ALL
SELECT * FROM plots WHERE  size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "' and block_id='" . $block . "' and `type`='Villa' and status='' and `ctag` LIKE '%Villas%'";
					}else{
					  $villassql  = "
SELECT * FROM plots where size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "'  AND plots.type = 'Villa'  AND plots.status != ''
 UNION ALL
SELECT * FROM plots WHERE  size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "' and `type`='Villa' and status='' and `ctag` LIKE '%Villas%'";
   
					}
				$villasres = $connection->createCommand($villassql)->query();
				$gtv = $gtv + count($villasres);
				echo '<td style="text-align:right"><a target="_blank" href="total_villas_detail?com_res=' . $com_res . '&size=' . $row1['id'] . '&&project_id=' . $_POST['project'] . '&&block_id='.$_POST['block'].'">';
				if(count($villasres)==0){ echo'';} else{ echo count($villasres);} echo '</a></td>';
				$tv = count($villasres);
				if(!empty($block))
				{
				$selected  = "SELECT * from plots
	 where size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "' and block_id='" . $block . "'  and  isvilla !=1 and atype NOT LIKE'%Against Land%' and type='Plot' and status !=''";
				}else
				{
				 	$selected  = "SELECT * from plots
	 where size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "'  and  isvilla !=1 and atype NOT LIKE'%Against Land%' and type='Plot' and status !=''";
   
				}
				$selectedres = $connection->createCommand($selected)->query();
				///$tselected=$count($selectedres);
				$tselected = $tselected + count($selectedres);
				$gtselected = $gtselected + count($selectedres);
				echo '<td style="text-align:right"><a target="_blank" href="selected_balloted_detail?com_res=' . $com_res . '&size=' . $row1['id'] . '&&project_id=' . $_POST['project'] . '&&block_id='.$_POST['block'].'">';
				if(count($selectedres)==0){ echo'';} else{ echo count($selectedres);} echo '</a></td>';
				if(!empty($block))
				{
				$against_land  = "SELECT * from plots
	 where size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "' and block_id='" . $block . "'   and  atype  LIKE '%Against Land%' and plots.status !='' and plots.type='Plot'";
				}else{
				  	$against_land  = "SELECT * from plots
	 where size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "'    and  atype  LIKE '%Against Land%' and plots.status !='' and plots.type='Plot'";
  
				}
				$against_landres = $connection->createCommand($against_land)->query();
				$tagainstland = $tagainstland + count($against_landres);
				$gtal = $gtal + count($against_landres);
				echo '<td style="text-align:right"><a target="_blank" href="againstland_plots_detail?com_res=' . $com_res . '&size=' . $row1['id'] . '&&project_id=' . $_POST['project'] . '&&block_id='.$_POST['block'].'">';
				if(count($against_landres)==0){ echo'';} else{ echo count($against_landres);} echo '</a></td>';

				$tal = 0;
				$ts = count($selectedres);
				$tal = ($tagainstland);
				$totheresvdres = 0;
				$talresvdres = 0;
				$gtps = $gtps + (count($against_landres) + $ts);
				$g = $ts + count($against_landres);
				echo '<td style="text-align:right"><a target="_blank" href="total_sold_plots_detail?com_res=' . $com_res . '&size=' . $row1['id'] . '&&project_id=' . $_POST['project'] . '&&block_id='.$_POST['block'].'">';
				if(($g)==0){ echo'';} else{ echo ($g);} echo '</a></td>';

                if(!empty($block))
				{
				$alresvd  = "
SELECT * from plots
	 where size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "' and block_id='" . $block . "'  and  `ctag` LIKE '%Against Land%' and status='' and type !='file'";
				}else
				{
				  $alresvd  = "
SELECT * from plots
	 where size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "'  and  `ctag` LIKE '%Against Land%' and status='' and type !='file'";  
				}
				$alresvdres = $connection->createCommand($alresvd)->query();
				$talresvdres = $talresvdres + count($alresvdres);
				//	$totheresvdres=$totheresvdres+count($otheresvdres);
				$gtalrsvd = $gtalrsvd + count($alresvdres);
				echo '<td style="text-align:right"><a target="_blank" href="againstland_rsvd_plots_detail?com_res=' . $com_res . '&size=' . $row1['id'] . '&&project_id=' . $_POST['project'] . '&&block_id='.$_POST['block'].'">';
				if(count($alresvdres)==0){ echo'';} else{ echo count($alresvdres);} echo'</a></td>';
				 if(!empty($block))
				{
				$otheresvd  = "SELECT * from plots
	 where size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "' and block_id='" . $block . "' AND plots.status = '' AND plots.ctag LIKE '%HRL Reserved%' and type !='file' ";
				}else
				{
				 	$otheresvd  = "SELECT * from plots
	 where size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "' AND plots.status = '' AND plots.ctag LIKE '%HRL Reserved%' and type !='file' ";   
				}
				$otheresvdres = $connection->createCommand($otheresvd)->query();
				$totheresvdres = $totheresvdres + count($otheresvdres);
				$gtothrrsvd = $gtothrrsvd + count($otheresvdres);
				 if(!empty($block))
				{
				$tr  = "SELECT COUNT(*) AS total
                FROM
            (
		SELECT * from plots
		where plots.type != 'file' AND size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "' and block_id='" . $block . "' and  plots.`ctag` LIKE '%Against Land%' AND plots.status = ''
	 UNION ALL
	 SELECT * from plots
	    where plots.type !='file' AND size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "' and block_id='" . $block . "' and    plots.ctag = 'HRL Reserved' AND plots.status = '' ) t";
				}else{
				    	$tr  = "SELECT COUNT(*) AS total
                FROM
            (
		SELECT * from plots
		where plots.type != 'file' AND size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "'  and  plots.`ctag` LIKE '%Against Land%' AND plots.status = ''
	 UNION ALL
	 SELECT * from plots
	    where plots.type !='file' AND size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "'  and    plots.ctag = 'HRL Reserved' AND plots.status = '' ) t";
				}
				$trres = $connection->createCommand($tr)->queryRow();
				$tr = count($villasres);

				echo '<td style="text-align:right"><a target="_blank" href="other_rsvd_plots_detail?com_res=' . $com_res . '&size=' . $row1['id'] . '&&project_id=' . $_POST['project'] . '&&block_id='.$_POST['block'].'">';
				
				if(floatval($totheresvdres)==0){ echo'';}else{ echo floatval($totheresvdres);}
				echo '</a></td>';
				$talrsvd = 0;
				$tothrresvd = 0;
				$tpendingfileres = 0;
				$talrsvd = ($talresvdres);
				$tothrresvd = ($totheresvdres);
				$tor = $tothrresvd;
				$talr = $talrsvd;
				echo '<td style="text-align:right"><a target="_blank" href="total_rsvd_plots_detail?com_res=' . $com_res . '&size=' . $row1['id'] . '&&project_id=' . $_POST['project'] . '&&block_id='.$_POST['block'].'">';
				if(floatval(($trres['total']))==0){ echo'';}else{ echo ($trres['total']);}
				 echo'</a></td>';
				$tbo = ($tp - ($g) - ($tv) - ($tor + $talr));
				///$tbo=$talr;
				$nosfile = 0;
				$gtrsvd = $gtothrrsvd + $gtalrsvd;
				echo '<td style="text-align:right"><a target="_blank" href="nos_plots_detail?com_res=' . $com_res . '&size=' . $row1['id'] . '&&project_id=' . $_POST['project'] . '&&block_id='.$_POST['block'].'">';
				if(floatval($tbo)==0){ echo'';} else{ echo floatval($tbo);} echo'</a></td>';

				///$total=count($openres)-(count($resvres)+count($alres)+count($villasres));


				echo '<td style="text-align:right">';
				if (!empty($tbo) && !empty($tp) && ($tp != 0)) {

					echo round(($tbo / $tp * 100), 2) . '%';
				}
				echo '</td>';
                if(!empty($block)){
				$pendingfile  = "SELECT * FROM memberplot mp
left join plots p on mp.plot_id=p.id
where size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "' and block_id='" . $block . "'  and p.type='file'";
                }else{
                    	$pendingfile  = "SELECT * FROM memberplot mp
left join plots p on mp.plot_id=p.id
where size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "'  and p.type='file'";
                }
				$pendingfileres = $connection->createCommand($pendingfile)->query();
				$tpendingfileres = $tpendingfileres + count($pendingfileres);
				echo '<td style="text-align:right"><a target="_blank" href="pending_files_detail?com_res=' . $com_res . '&size=' . $row1['id'] . '&&project_id=' . $_POST['project'] . '&&block_id='.$block.'">';
				if(floatval($tpendingfileres)==0){ echo'';} else{ echo floatval($tpendingfileres);}echo '</a></td>';
				$nosfile = $tbo - floatval($tpendingfileres);
				echo '<td style="text-align:right">';		if(($nosfile)==0){ echo'';} else{ echo ($nosfile);} echo'</td>
<td style="text-align:right">';
				if (!empty($tp) && ($tp != 0)) {
					echo round(($nosfile / $tp * 100), 2);
				}
				echo '%</td>

<td></td>
</tr>';
				$gtp = $tp + $gtp;
				$gtbo = $gtbo + $tbo;
				$gtpf = $tpendingfileres + $gtpf;
				$gtfnb = $gtfnb + $nosfile;
			}}
			echo '<tr>
<td><strong>Total</strong></td>
<td></td>
<td style="text-align:right"><strong>' . $gtp . '</srong></td>
<td style="text-align:right"><strong>' . $gtsv . '</srong></td>
<td style="text-align:right"><strong>' . $gtusv . '</srong></td>
<td style="text-align:right"><strong>' . $gtv . '</srong></td>
<td style="text-align:right"><strong>' . $gtselected . '</srong></td>
<td style="text-align:right"><strong>' . $gtal . '</srong></td>
<td style="text-align:right"><strong>' . $gtps . '</srong></td>
<td style="text-align:right"><strong>' . $gtalrsvd . '</srong></td>
<td style="text-align:right"><strong>' . $gtothrrsvd . '</srong></td>
<td style="text-align:right"><strong>' . $gtrsvd . '</srong></td>
<td style="text-align:right"><strong>' . $gtbo . '</srong></td>
<td style="text-align:right"><strong>';
			if (!empty($tp) && ($tp != 0)) {
				echo (ROUND($gtbo / $gtp * 100, 2)) . '%';
			}
			echo '</srong></td>
<td style="text-align:right"><strong>' . $gtpf . '</srong></td>
<td style="text-align:right"><strong>' . $gtfnb . '</srong></td>
<td style="text-align:right"><strong>';
			if (!empty($tp) && ($tp != 0)) {
				echo (ROUND($gtfnb / $gtp * 100, 2)) . '%';
			}
			echo '</srong></td>
<td style="text-align:right"><strong></srong></td>
</tr>';?>
<tr><td colspan="18">
<form id="form" action="<?php echo Yii::app()->baseUrl; ?>/dompdf/www/pdfgenerator.php" method="post">
					<input type="hidden" name="paper" value="a4">
					<input type="hidden" name="orientation" value="landscape">
					</p>
					<textarea name="html1" style="display:none;" cols="80" rows="20">
<meta charset="utf-8">
<title></title>
<link rel="stylesheet" type="text/css" href="../views/recovery/report.css">
<style>
td{  }
.table-bordered{ border:1px solid #000; border-bottom:1px solid #000;}
table{ border:1px solid;}

</style>
	<table  width="100%" border="0" cellspacing="0px" cellpadding="0px">
    <tr>
      <td style="padding:0px 0px 0px 0 px;">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td bgcolor="#FFFFFF">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="100" class="BoledText" style="border-left:thin; border-left-style:solid; border-top:thin; border-top-style:solid; border-right:thin; border-right-style:solid">
                  <?php echo '<img style="height:40px;"  src="' . Yii::getPathOfAlias('webroot') . '/images/logo1.png"/>'; ?>
                  </td>
                  <td colspan="10" align="center" valign="middle" style="border-top:thin; border-top-style:solid; border-right:thin; border-right-style:solid; font-size:14px;  font-weight:bold"><span class="style6">Residential Plots Allocation Summary
</span></td>
                  <td width="80" valign="top" style="border-top:thin; border-top-style:solid; border-right:thin; border-right-style:solid">
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td height="10" style="border-bottom:inset; font-size:10px"><span class="style6">&nbsp;Doc #: RDL/</span></td>
                    </tr>
                    <tr>
                      <td height="10" style="border-bottom:inset; font-size:10px"><span class="style6">&nbsp;Rev: 00</span></td>
                    </tr>
                  </table></td>
                </tr>
<table style="font-size:12px; border:1px solid;">
<thead style="background:#666; border-color:#ccc; color:#fff;">
<tr>
<td rowspan="2" width="5%" style="text-align:center">S.No</td>
<td rowspan="2" width="10%" style="text-align:center">Plot Categories</td>
<td rowspan="2" style="text-align:center">Total Plots</td>
<td colspan="3" style="text-align:center">Villas (Homes) </td>
<td colspan="3" style="text-align:center">Plots Allocated </td>
<td colspan="3" style="text-align:center">Reserved/Hold </td>
<td colspan="2" style="text-align:center">Balance(Open)</td>
<td rowspan="2" style="text-align:center">Pending Files</td>
<td colspan="2" style="text-align:center">Final Net Balance</td>
<td rowspan="2" style="text-align:center">Remarks</td>

</tr>
<tr>
<td style="text-align:center">Sold (Allotted)</td>
<td style="text-align:center">Reserved (Unsold)</td>
<td style="text-align:center">Total Villas</td>
<td style="text-align:center">Selected+Balloted</td>
<td style="text-align:center">Against Land</td>
<td style="text-align:center">Total Sold</td>
<td style="text-align:center">Against Land Rsvd</td>
<td style="text-align:center">HRL Rsvd</td>
<td style="text-align:center">Total Rsvd</td>
<td style="text-align:center">Nos</td>
<td style="text-align:center">% age</td>
<td style="text-align:center">Nos</td>
<td style="text-align:center">% age</td>
</tr>
<!---<tr>
<th style="text-align:center">Selected+Balloted</th>
<th style="text-align:center">Against Land</th>
<th style="text-align:center">Total Sold</th>
</tr>--->
</thead>
<tbody >
    <?php  
        	$gtsv = 0;
        	$gtusv1 = 0;
        	$gtv1 = 0;
    		$gtselected1 = 0;
			$gtal1 = 0;
			$gtps1 = 0;
			$gtalrsvd1 = 0;
			$gtothrrsvd1 = 0;
			$gtrsvd1 = 0;
			$gtbo1 = 0;
    $sql_plots1  = "SELECT * from size_cat where typee='" . $com_res . "' Order by size_cat.id";
			$result_plots1 = $connection->createCommand($sql_plots1)->queryAll();
		
		foreach ($result_plots as $row3) {
                 $sql_total  = "SELECT count(size2) as tsize from plots
	 where size2='" . $row3['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "' and block_id='" . $block . "' and type !='file'";
	           $tsiz = $connection->createCommand($sql_total)->queryRow();
				
			
				if($tsiz['tsize']>0){
				$inc++;
				echo '<tr><td>' . $inc . '</td>
				<td>' . $row3['size'];
				if ($_POST['com_res'] == 'Residential') {
					echo '&nbsp; (Residential)';
				}
				if ($_POST['com_res'] == 'Commercial') {
					echo '&nbsp; (Commercial)';
				}
				
				$totalplots  = "SELECT * from plots
	 where size2='" . $row3['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "' and block_id='" . $block . "' and type !='file'";
				$totalplotsres = $connection->createCommand($totalplots)->query();
				echo '<td style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">' ; 
				if(count($totalplotsres)==0){ echo'';}else{ echo count($totalplotsres);}
				 echo '</td>';
				$tp = count($totalplotsres);
				
				$soldvillas  = "SELECT * from plots
	 where size2='" . $row3['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "' and block_id='" . $block . "'  and status !='' and type='Villa'";
				$ressoldvillas = $connection->createCommand($soldvillas)->query();
				echo '<td style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">'; 
					if(count($ressoldvillas)==0){ echo'';}else{ echo count($ressoldvillas);}
			 echo '</a></td>';
				$gtsv1 = $gtsv1 + count($ressoldvillas);
				$unsoldvillas  = "SELECT * from plots
	 where size2='" . $row3['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "' and block_id='" . $block . "' and type='Villa' and status='' and  `ctag` LIKE '%Villas%' ";
				$unsoldvillasres = $connection->createCommand($unsoldvillas)->query();
				$gtusv1 = $gtusv1 + count($unsoldvillasres);
				echo '<td style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">' ;
					if(count($unsoldvillasres)==0){ echo'';}else{ echo count($unsoldvillasres);}
				 echo'</td>';
				 $villassql  = "
SELECT * FROM plots where size2='" . $row3['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "' and block_id='" . $block . "' AND plots.type = 'Villa'  AND plots.status != ''
 UNION ALL
SELECT * FROM plots WHERE  size2='" . $row3['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "' and block_id='" . $block . "' and `type`='Villa' and status='' and `ctag` LIKE '%Villas%'";
				$villasres = $connection->createCommand($villassql)->query();
				$gtv1 = $gtv1 + count($villasres);
				echo '<td style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">';
					if(count($villasres)==0){ echo'';}else{ echo count($villasres);}echo'</td>';
				
					$tv = count($villasres);
				$selected  = "SELECT * from plots
	 where size2='" . $row3['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "' and block_id='" . $block . "'  and  isvilla !=1 and atype NOT LIKE'%Against Land%' and type='Plot' and status !=''";
				$selectedres = $connection->createCommand($selected)->query();
				///$tselected=$count($selectedres);
				$tselected = $tselected + count($selectedres);
				$gtselected1 = $gtselected1 + count($selectedres);
				echo '<td style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">'; 	if(count($selectedres)==0){ echo'';}else{ echo count($selectedres);}echo'</a></td>';
				$against_land  = "SELECT * from plots
	 where size2='" . $row3['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "' and block_id='" . $block . "'   and  atype  LIKE '%Against Land%' and plots.status !='' and plots.type='Plot'";
				$against_landres = $connection->createCommand($against_land)->query();
				$tagainstland = $tagainstland + count($against_landres);
				$gtal1 = $gtal1 + count($against_landres);
				echo '<td style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">'; 
				if(count($against_landres)==0){ echo'';}else{ echo count($against_landres);}
				 echo'</a></td>';

				$tal = 0;
				$ts = count($selectedres);
				$tal = ($tagainstland);
				$totheresvdres = 0;
				$talresvdres = 0;
				$gtps1 = $gtps1 + (count($against_landres) + $ts);
				$g = $ts + count($against_landres);
				echo '<td style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">';if(($g)==0){ echo'';}else{ echo ($g);}  echo'</td>';
                
                
                $alresvd  = "
SELECT * from plots
	 where size2='" . $row3['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "' and block_id='" . $block . "'  and  `ctag` LIKE '%Against Land%' and status='' and type !='file'";
				$alresvdres = $connection->createCommand($alresvd)->query();
				$talresvdres = $talresvdres + count($alresvdres);
				//	$totheresvdres=$totheresvdres+count($otheresvdres);
				$gtalrsvd1 = $gtalrsvd1 + count($alresvdres);
				echo '<td style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">';if((count($alresvdres))==0){ echo'';}else{ echo count($alresvdres);}echo'</td>';
				$otheresvd  = "SELECT * from plots
	 where size2='" . $row3['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "' and block_id='" . $block . "' AND plots.status = '' AND plots.ctag LIKE '%HRL Reserved%' and type !='file' ";
				$otheresvdres = $connection->createCommand($otheresvd)->query();
				$totheresvdres = $totheresvdres + count($otheresvdres);
				$gtothrrsvd1 = $gtothrrsvd1 + count($otheresvdres);
				$tr  = "SELECT COUNT(*) AS total
                FROM
            (
		SELECT * from plots
		where plots.type != 'file' AND size2='" . $row3['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "' and block_id='" . $block . "' and  plots.`ctag` LIKE '%Against Land%' AND plots.status = ''
	 UNION ALL
	 SELECT * from plots
	    where plots.type !='file' AND size2='" . $row3['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "' and block_id='" . $block . "' and    plots.ctag = 'HRL Reserved' AND plots.status = '' ) t";
				$trres = $connection->createCommand($tr)->queryRow();
				$tr = count($villasres);

				echo '<td style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">';
				if(floatval($totheresvdres)==0){ echo'';}else{ echo floatval($totheresvdres);}echo'</a></td>';
				
				$talrsvd = 0;
				$tothrresvd = 0;
				$tpendingfileres = 0;
				$talrsvd = ($talresvdres);
				$tothrresvd = ($totheresvdres);
				$tor = $tothrresvd;
				$talr = $talrsvd;
				echo '<td style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">';if(($trres['total'])==0){ echo'';}else{ echo ($trres['total']);} echo'</a></td>';
				
					$tbo = ($tp - ($g) - ($tv) - ($tor + $talr));
				///$tbo=$talr;
				$nosfile = 0;
				$gtrsvd1 = $gtothrrsvd1 + $gtalrsvd1;
				echo '<td style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">'; if($tbo==0){ echo'';}else{ echo $tbo;} echo'</a></td>';
				
				echo '<td style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">';
				if (!empty($tbo) && !empty($tp) && ($tp != 0)) {
					echo round(($tbo / $tp * 100), 2) . '%';
				}
				echo '</td>';
				$pendingfile  = "
SELECT * FROM memberplot mp
left join plots p on mp.plot_id=p.id
where size2='" . $row3['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "' and block_id='" . $block . "'  and p.type='file'";
				$pendingfileres = $connection->createCommand($pendingfile)->query();
				$tpendingfileres = $tpendingfileres + count($pendingfileres);
				echo '<td style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">';if(floatval($tpendingfileres==0)){ echo'';} else{ echo floatval($tpendingfileres);} echo'</td>';
				$nosfile = $tbo - floatval($tpendingfileres);
				echo '<td style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">';if($nosfile==0){ echo'';} else{ echo ($nosfile);} echo '</td>
<td style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">';
				if (!empty($tp) && ($tp != 0)) {
					echo round(($nosfile / $tp * 100), 2);
				}
				echo '%</td>

<td></td>';
				echo '</tr>';
				$gtp1 = $tp + $gtp1;
				$gtbo1 = $gtbo1 + $tbo;
				$gtpf1 = $tpendingfileres + $gtpf1;
				$gtfnb1 = $gtfnb1 + $nosfile;
		}}
		echo '<tr>
<td><strong>Total</strong></td>
<td></td>
<td style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;"><strong>' . $gtp1 . '</srong></td>
<td style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;"><strong>' . $gtsv1 . '</srong></td>
<td style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;"><strong>' . $gtusv1 . '</srong></td>
<td style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;"><strong>' . $gtv1 . '</srong></td>
<td style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;"><strong>' . $gtselected1 . '</srong></td>
<td style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;"><strong>' . $gtal1 . '</srong></td>
<td style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;"><strong>' . $gtps1 . '</srong></td>
<td style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;"><strong>' . $gtalrsvd1 . '</srong></td>
<td style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;"><strong>' . $gtothrrsvd1 . '</srong></td>
<td style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;"><strong>' . $gtrsvd1 . '</srong></td>
<td style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;"><strong>' . $gtbo1 . '</srong></td>
<td style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;"><strong>';
			if (!empty($tp) && ($tp != 0)) {
				echo (ROUND($gtbo1 / $gtp * 100, 2)) . '%';
			}
			echo '</srong></td>
<td style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;"><strong>' . $gtpf . '</srong></td>
<td style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;"><strong>' . $gtfnb . '</srong></td>
<td style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;"><strong>';
			if (!empty($tp) && ($tp != 0)) {
				echo (ROUND($gtfnb1 / $gtp1 * 100, 2)) . '%';
			}
			echo '</srong></td>

</tr>';
			?>
</tbody>
</table>
</textarea>
					<div style="text-align: left; margin-top: 1em;">
						<button type="submit">Print Report</button>
					</div>
				</form></td></tr>
		<?php 
	}
	////////////////////START:FILES Allocation ///////////////////
	public function actionFiles_Allocation_Summary(){
	
		if((Yii::app()->session['user_array']['id']=='1') || (Yii::app()->session['user_array']['id']=='68'))
 	
{

$connection = Yii::app()->db;
$temp_projects_array = Yii::app()->session['projects_array'];
$num_of_projects_counter = count($temp_projects_array);
$num_of_projects_counter2 = $num_of_projects_counter;
$sql1 =   "select * from projects where";
$num_of_projects_counter--;
while($num_of_projects_counter>-1)
{
$sql2[$num_of_projects_counter] = " id=".Yii::app()->session['projects_array'][$num_of_projects_counter]['project_id'];
$num_of_projects_counter--;
}

$sql_project = $sql1;
$sql_project = $sql_project.implode(' or',$sql2);


$result_projects = $connection->createCommand($sql_project)->query() or mysql_error();


//$sql_project = "SELECT * from projects";
//$result_project = $connection->createCommand($sql_project)->query();


$sql_categories  = "SELECT * from categories";
$categories = $connection->createCommand($sql_categories)->query();
$sql_size  = "SELECT * from size_cat";
$sizes = $connection->createCommand($sql_size)->query();
$sql_sector ="SELECT * FROM sectors";
$result_sector = $connection->createCommand($sql_sector)->query();

$sql_com_res ="SELECT DISTINCT com_res FROM plots";
$result_com_res = $connection->createCommand($sql_com_res)->query();

$home=Yii::app()->request->baseUrl;

$this->render('files_allocation_summary',array('projects'=>$result_projects,'sectors'=>$result_sector,'categories'=>$categories,'sizes'=>$sizes,'com_res'=>$result_com_res));
}else{
$this->redirect(array('user/dashboard'));
}
	
	}
	public function actionSearchallocsumf()
	{
		if ((Yii::app()->session['user_array']['per3'] == '1')  || (Yii::app()->session['user_array']['per34'] == '1') || (Yii::app()->session['user_array']['id'] == '68')) 
	

			//for Pagination end
			$connection = Yii::app()->db;

			$sql_project = "SELECT * from projects where id=" . $_POST['project'] . "";
			$result_project = $connection->createCommand($sql_project)->queryRow();
			$count = 0;
			$home = Yii::app()->request->baseUrl;
			$check = 1;
			$res = array();
			$count++;
			echo $count . ' result found';
			$home = "";
			$home = Yii::app()->request->baseUrl;
			$gtp = 0;
			$gtsv = 0;
			$gtusv = 0;
			$gtv = 0;
			$gtselected = 0;
			$gtal = 0;
			$gtps = 0;
			$gtalrsvd = 0;
			$gtothrrsvd = 0;
			$gtrsvd = 0;
			$gtbo = 0;
			$gtpf = 0;
			$gtfnb = 0;
			$g = 0;
			$F = '';
			$M = '';
			$inc = 0;
			$open = 0;
			$plotsallocated = 0;
			$hrlreserved = 0;
			$againstland = 0;
			$topen = 0;
			$thrlreserved = 0;
			$tagainstland = 0;
			$tvillas = 0;
			$total = 0;
			$gtotal = 0;
			$tselected = 0;
			$op = 0;
			$against_landress = '';
			$talresvdres = 0;
			$com_res = '';
			$tp = 0;
			$tv = 0;
			$tor = 0;
			
			$talr = 0;
			$tbo = 0;
			$ts = 0;
			$block = '';
			$where='';
			$and='';
			$block = $_POST['block'];
			if (!empty($_POST['block'])) {
				if ($and == true) {
					$where .= " and block_id LIKE '%" . $_POST['block'] . "%'";
				} else {
					$where .= " and block_id LIKE '%" . $_POST['block'] . "%'";
				}
				$and = true;
			}
			
			if ($_POST['com_res'] == 'Residential') {
    		$com_res = 'R';
			}
			if ($_POST['com_res'] == 'Commercial') {
				$com_res = 'C';
			}
		
			  $sql_plots  = "SELECT * from size_cat where typee='" . $com_res . "' Order by size_cat.size_sorting";
		    $result_plots = $connection->createCommand($sql_plots)->queryAll();
			foreach ($result_plots as $row1) {
				 $sql_total  = "SELECT count(size2) as tsize from plots
				where size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "'  and type ='file'".$where."";

			   
	           $tsiz = $connection->createCommand($sql_total)->queryRow();
				
				$inc++;
				if($tsiz['tsize']>0){
				echo '<tr><td>' . $inc . '</td><td>' . $row1['size'];
				if ($_POST['com_res'] == 'Residential') {
					echo '&nbsp; (Residential)';
				}
				if ($_POST['com_res'] == 'Commercial') {
					echo '&nbsp; (Commercial)';
				}
				echo '</td>';
				if(!empty($block)){
				   $totalplots  = "SELECT * from plots
	 where size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "' and block_id='" . $block . "' and type ='file'";
				}
				if(empty($block))
				{
				  $totalplots  = "SELECT * from plots
	 where size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "'  and type ='file'";   
				}
				$totalplotsres = $connection->createCommand($totalplots)->query();
				echo '<td style="text-align:right"><a target="_blank" href="total_plots_detail?com_res=' . $com_res . '&size=' . $row1['id'] . '&&project_id=' . $_POST['project'] . '&&block_id='.$_POST['block'].'">';
				if(count($totalplotsres)==0){ echo'';} else{ echo count($totalplotsres);}   echo'</a></td>';

				$tp = count($totalplotsres);
                	
				
				echo '<td style="text-align:right"><a target="_blank" href="sold_villas_detail?com_res=' . $com_res . '&size=' . $row1['id'] . '&&project_id=' . $_POST['project'] . '&&block_id='.$_POST['block'].'"">
				';
				 echo '</a></td>';

					
				echo '<td style="text-align:right"><a target="_blank" href="reserved_villas_detail?com_res=' . $com_res . '&size=' . $row1['id'] . '&&project_id=' . $_POST['project'] . '&&block_id='.$_POST['block'].'">';
				echo '</a></td>';
				
				echo '<td style="text-align:right"><a target="_blank" href="total_villas_detail?com_res=' . $com_res . '&size=' . $row1['id'] . '&&project_id=' . $_POST['project'] . '&&block_id='.$_POST['block'].'">';
				 echo '</a></td>';
				//$tv = count($villasres);
				if(!empty($block))
				{
				$selected  = "SELECT * from plots
	 where size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "' and block_id='" . $block . "'  and  isvilla !=1 and atype NOT LIKE'%Against Land%' and type='file' and status !=''";
				}else
				{
				 	$selected  = "SELECT * from plots
	 where size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "'  and  isvilla !=1 and atype NOT LIKE'%Against Land%' and type='file' and status !=''";
   
				}
				$selectedres = $connection->createCommand($selected)->query();
				///$tselected=$count($selectedres);
				$tselected = $tselected + count($selectedres);
				$gtselected = $gtselected + count($selectedres);
				echo '<td style="text-align:right"><a target="_blank" href="selected_balloted_detail?com_res=' . $com_res . '&size=' . $row1['id'] . '&&project_id=' . $_POST['project'] . '&&block_id='.$_POST['block'].'">';
				if(count($selectedres)==0){ echo'';} else{ echo count($selectedres);} echo '</a></td>';
				if(!empty($block))
				{
				$against_land  = "SELECT * from plots
	 where size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "' and block_id='" . $block . "'   and  atype  LIKE '%Against Land%' and plots.status !='' and plots.type='file'";
				}else{
				  	$against_land  = "SELECT * from plots
	 where size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "'    and  atype  LIKE '%Against Land%' and plots.status !='' and plots.type='file'";
  
				}
				$against_landres = $connection->createCommand($against_land)->query();
				$tagainstland = $tagainstland + count($against_landres);
				$gtal = $gtal + count($against_landres);
				echo '<td style="text-align:right"><a target="_blank" href="againstland_plots_detail?com_res=' . $com_res . '&size=' . $row1['id'] . '&&project_id=' . $_POST['project'] . '&&block_id='.$_POST['block'].'">';
				if(count($against_landres)==0){ echo'';} else{ echo count($against_landres);} echo '</a></td>';

				$tal = 0;
				$ts = count($selectedres);
				$tal = ($tagainstland);
				$totheresvdres = 0;
				$talresvdres = 0;
				$gtps = $gtps + (count($against_landres) + $ts);
				$g = $ts + count($against_landres);
				echo '<td style="text-align:right"><a target="_blank" href="total_sold_plots_detail?com_res=' . $com_res . '&size=' . $row1['id'] . '&&project_id=' . $_POST['project'] . '&&block_id='.$_POST['block'].'">';
				if(($g)==0){ echo'';} else{ echo ($g);} echo '</a></td>';

                if(!empty($block))
				{
				$alresvd  = "
SELECT * from plots
	 where size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "' and block_id='" . $block . "'  and  `ctag` LIKE '%Against Land%' and status='' and type ='file'";
				}else
				{
				  $alresvd  = "
SELECT * from plots
	 where size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "'  and  `ctag` LIKE '%Against Land%' and status='' and type ='file'";  
				}
				$alresvdres = $connection->createCommand($alresvd)->query();
				$talresvdres = $talresvdres + count($alresvdres);
				//	$totheresvdres=$totheresvdres+count($otheresvdres);
				$gtalrsvd = $gtalrsvd + count($alresvdres);
				echo '<td style="text-align:right"><a target="_blank" href="againstland_rsvd_plots_detail?com_res=' . $com_res . '&size=' . $row1['id'] . '&&project_id=' . $_POST['project'] . '&&block_id='.$_POST['block'].'">';
				if(count($alresvdres)==0){ echo'';} else{ echo count($alresvdres);} echo'</a></td>';
				 if(!empty($block))
				{
				$otheresvd  = "SELECT * from plots
	 where size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "' and block_id='" . $block . "' AND plots.status = '' AND plots.ctag LIKE '%HRL Reserved%' and type ='file' ";
				}else
				{
				 	$otheresvd  = "SELECT * from plots
	 where size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "' AND plots.status = '' AND plots.ctag LIKE '%HRL Reserved%' and type ='file' ";   
				}
				$otheresvdres = $connection->createCommand($otheresvd)->query();
				$totheresvdres = $totheresvdres + count($otheresvdres);
				$gtothrrsvd = $gtothrrsvd + count($otheresvdres);
				 if(!empty($block))
				{
				$tr  = "SELECT COUNT(*) AS total
                FROM
            (
		SELECT * from plots
		where plots.type != 'file' AND size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "' and block_id='" . $block . "' and  plots.`ctag` LIKE '%Against Land%' AND plots.status = ''
	 UNION ALL
	 SELECT * from plots
	    where plots.type !='file' AND size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "' and block_id='" . $block . "' and    plots.ctag = 'HRL Reserved' AND plots.status = '' ) t";
				}else{
				    	$tr  = "SELECT COUNT(*) AS total
                FROM
            (
		SELECT * from plots
		where plots.type != 'file' AND size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "'  and  plots.`ctag` LIKE '%Against Land%' AND plots.status = ''
	 UNION ALL
	 SELECT * from plots
	    where plots.type !='file' AND size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "'  and    plots.ctag = 'HRL Reserved' AND plots.status = '' ) t";
				}
				$trres = $connection->createCommand($tr)->queryRow();
				//$tr = count($villasres);

				echo '<td style="text-align:right"><a target="_blank" href="other_rsvd_plots_detail?com_res=' . $com_res . '&size=' . $row1['id'] . '&&project_id=' . $_POST['project'] . '&&block_id='.$_POST['block'].'">';
				
				if(floatval($totheresvdres)==0){ echo'';}else{ echo floatval($totheresvdres);}
				echo '</a></td>';
				$talrsvd = 0;
				$tothrresvd = 0;
				$tpendingfileres = 0;
				$talrsvd = ($talresvdres);
				$tothrresvd = ($totheresvdres);
				$tor = $tothrresvd;
				$talr = $talrsvd;
				echo '<td style="text-align:right"><a target="_blank" href="total_rsvd_plots_detail?com_res=' . $com_res . '&size=' . $row1['id'] . '&&project_id=' . $_POST['project'] . '&&block_id='.$_POST['block'].'">';
				if(floatval(($trres['total']))==0){ echo'';}else{ echo ($trres['total']);}
				 echo'</a></td>';
				$tbo = ($tp - ($g) - ($tv) - ($tor + $talr));
				///$tbo=$talr;
				$nosfile = 0;
				$gtrsvd = $gtothrrsvd + $gtalrsvd;
				echo '<td style="text-align:right"><a target="_blank" href="nos_plots_detail?com_res=' . $com_res . '&size=' . $row1['id'] . '&&project_id=' . $_POST['project'] . '&&block_id='.$_POST['block'].'">';
				if(floatval($tbo)==0){ echo'';} else{ echo floatval($tbo);} echo'</a></td>';

				///$total=count($openres)-(count($resvres)+count($alres)+count($villasres));


				echo '<td style="text-align:right">';
				if (!empty($tbo) && !empty($tp) && ($tp != 0)) {

					echo round(($tbo / $tp * 100), 2) . '%';
				}
				echo '</td>';
                if(!empty($block)){
				$pendingfile  = "SELECT * FROM memberplot mp
left join plots p on mp.plot_id=p.id
where size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "' and block_id='" . $block . "'  and p.type='file'";
                }else{
                    	$pendingfile  = "SELECT * FROM memberplot mp
left join plots p on mp.plot_id=p.id
where size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "'  and p.type='file'";
                }
				$pendingfileres = $connection->createCommand($pendingfile)->query();
				$tpendingfileres = $tpendingfileres + count($pendingfileres);
				echo '<td style="text-align:right"><a target="_blank" href="pending_files_detail?com_res=' . $com_res . '&size=' . $row1['id'] . '&&project_id=' . $_POST['project'] . '&&block_id='.$block.'">';
				if(floatval($tpendingfileres)==0){ echo'';} else{ echo floatval($tpendingfileres);}echo '</a></td>';
				$nosfile = $tbo - floatval($tpendingfileres);
				echo '<td style="text-align:right">';		if(($nosfile)==0){ echo'';} else{ echo ($nosfile);} echo'</td>
<td style="text-align:right">';
				if (!empty($tp) && ($tp != 0)) {
					echo round(($nosfile / $tp * 100), 2);
				}
				echo '%</td>

<td></td>
</tr>';
				$gtp = $tp + $gtp;
				$gtbo = $gtbo + $tbo;
				$gtpf = $tpendingfileres + $gtpf;
				$gtfnb = $gtfnb + $nosfile;
			}}
			echo '<tr>
<td><strong>Total</strong></td>
<td></td>
<td style="text-align:right"><strong>' . $gtp . '</srong></td>
<td style="text-align:right"><strong>' . $gtsv . '</srong></td>
<td style="text-align:right"><strong>' . $gtusv . '</srong></td>
<td style="text-align:right"><strong>' . $gtv . '</srong></td>
<td style="text-align:right"><strong>' . $gtselected . '</srong></td>
<td style="text-align:right"><strong>' . $gtal . '</srong></td>
<td style="text-align:right"><strong>' . $gtps . '</srong></td>
<td style="text-align:right"><strong>' . $gtalrsvd . '</srong></td>
<td style="text-align:right"><strong>' . $gtothrrsvd . '</srong></td>
<td style="text-align:right"><strong>' . $gtrsvd . '</srong></td>
<td style="text-align:right"><strong>' . $gtbo . '</srong></td>
<td style="text-align:right"><strong>';
			if (!empty($tp) && ($tp != 0)) {
				echo (ROUND($gtbo / $gtp * 100, 2)) . '%';
			}
			echo '</srong></td>
<td style="text-align:right"><strong>' . $gtpf . '</srong></td>
<td style="text-align:right"><strong>' . $gtfnb . '</srong></td>
<td style="text-align:right"><strong>';
			if (!empty($tp) && ($tp != 0)) {
				echo (ROUND($gtfnb / $gtp * 100, 2)) . '%';
			}
			echo '</srong></td>
<td style="text-align:right"><strong></srong></td>
</tr>';?>
<tr><td colspan="18">
<form id="form" action="<?php echo Yii::app()->baseUrl; ?>/dompdf/www/pdfgenerator.php" method="post">
					<input type="hidden" name="paper" value="a4">
					<input type="hidden" name="orientation" value="landscape">
					</p>
					<textarea name="html1" style="display:none;" cols="80" rows="20">
<meta charset="utf-8">
<title></title>
<link rel="stylesheet" type="text/css" href="../views/recovery/report.css">
<style>
td{  }
.table-bordered{ border:1px solid #000; border-bottom:1px solid #000;}
table{ border:1px solid;}

</style>
	<table  width="100%" border="0" cellspacing="0px" cellpadding="0px">
    <tr>
      <td style="padding:0px 0px 0px 0 px;">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td bgcolor="#FFFFFF">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="100" class="BoledText" style="border-left:thin; border-left-style:solid; border-top:thin; border-top-style:solid; border-right:thin; border-right-style:solid">
                  <?php echo '<img style="height:40px;"  src="' . Yii::getPathOfAlias('webroot') . '/images/logo1.png"/>'; ?>
                  </td>
                  <td colspan="10" align="center" valign="middle" style="border-top:thin; border-top-style:solid; border-right:thin; border-right-style:solid; font-size:14px;  font-weight:bold"><span class="style6">Residential Plots Allocation Summary
</span></td>
                  <td width="80" valign="top" style="border-top:thin; border-top-style:solid; border-right:thin; border-right-style:solid">
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td height="10" style="border-bottom:inset; font-size:10px"><span class="style6">&nbsp;Doc #: RDL/</span></td>
                    </tr>
                    <tr>
                      <td height="10" style="border-bottom:inset; font-size:10px"><span class="style6">&nbsp;Rev: 00</span></td>
                    </tr>
                  </table></td>
                </tr>
<table style="font-size:12px; border:1px solid;">
<thead style="background:#666; border-color:#ccc; color:#fff;">
<tr>
<td rowspan="2" width="5%" style="text-align:center">S.No</td>
<td rowspan="2" width="10%" style="text-align:center">Plot Categories</td>
<td rowspan="2" style="text-align:center">Total Plots</td>
<td colspan="3" style="text-align:center">Villas (Homes) </td>
<td colspan="3" style="text-align:center">Plots Allocated </td>
<td colspan="3" style="text-align:center">Reserved/Hold </td>
<td colspan="2" style="text-align:center">Balance(Open)</td>
<td rowspan="2" style="text-align:center">Pending Files</td>
<td colspan="2" style="text-align:center">Final Net Balance</td>
<td rowspan="2" style="text-align:center">Remarks</td>

</tr>
<tr>
<td style="text-align:center">Sold (Allotted)</td>
<td style="text-align:center">Reserved (Unsold)</td>
<td style="text-align:center">Total Villas</td>
<td style="text-align:center">Selected+Balloted</td>
<td style="text-align:center">Against Land</td>
<td style="text-align:center">Total Sold</td>
<td style="text-align:center">Against Land Rsvd</td>
<td style="text-align:center">HRL Rsvd</td>
<td style="text-align:center">Total Rsvd</td>
<td style="text-align:center">Nos</td>
<td style="text-align:center">% age</td>
<td style="text-align:center">Nos</td>
<td style="text-align:center">% age</td>
</tr>
<!---<tr>
<th style="text-align:center">Selected+Balloted</th>
<th style="text-align:center">Against Land</th>
<th style="text-align:center">Total Sold</th>
</tr>--->
</thead>
<tbody >
    <?php  
        	$gtsv = 0;
        	$gtusv1 = 0;
        	$gtv1 = 0;
    		$gtselected1 = 0;
			$gtal1 = 0;
			$gtps1 = 0;
			$gtalrsvd1 = 0;
			$gtothrrsvd1 = 0;
			$gtrsvd1 = 0;
			$gtbo1 = 0;
    $sql_plots1  = "SELECT * from size_cat where typee='" . $com_res . "' Order by size_cat.id";
			$result_plots1 = $connection->createCommand($sql_plots1)->queryAll();
		
		foreach ($result_plots as $row3) {
                 $sql_total  = "SELECT count(size2) as tsize from plots
	 where size2='" . $row3['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "' and block_id='" . $block . "' and type !='file'";
	           $tsiz = $connection->createCommand($sql_total)->queryRow();
				
			
				if($tsiz['tsize']>0){
				$inc++;
				echo '<tr><td>' . $inc . '</td>
				<td>' . $row3['size'];
				if ($_POST['com_res'] == 'Residential') {
					echo '&nbsp; (Residential)';
				}
				if ($_POST['com_res'] == 'Commercial') {
					echo '&nbsp; (Commercial)';
				}
				
				$totalplots  = "SELECT * from plots
	 where size2='" . $row3['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "' and block_id='" . $block . "' and type !='file'";
				$totalplotsres = $connection->createCommand($totalplots)->query();
				echo '<td style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">' ; 
				if(count($totalplotsres)==0){ echo'';}else{ echo count($totalplotsres);}
				 echo '</td>';
				$tp = count($totalplotsres);
				
				$soldvillas  = "SELECT * from plots
	 where size2='" . $row3['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "' and block_id='" . $block . "'  and status !='' and type='Villa'";
				$ressoldvillas = $connection->createCommand($soldvillas)->query();
				echo '<td style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">'; 
					if(count($ressoldvillas)==0){ echo'';}else{ echo count($ressoldvillas);}
			 echo '</a></td>';
				$gtsv1 = $gtsv1 + count($ressoldvillas);
				$unsoldvillas  = "SELECT * from plots
	 where size2='" . $row3['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "' and block_id='" . $block . "' and type='Villa' and status='' and  `ctag` LIKE '%Villas%' ";
				$unsoldvillasres = $connection->createCommand($unsoldvillas)->query();
				$gtusv1 = $gtusv1 + count($unsoldvillasres);
				echo '<td style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">' ;
					if(count($unsoldvillasres)==0){ echo'';}else{ echo count($unsoldvillasres);}
				 echo'</td>';
				 $villassql  = "
SELECT * FROM plots where size2='" . $row3['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "' and block_id='" . $block . "' AND plots.type = 'Villa'  AND plots.status != ''
 UNION ALL
SELECT * FROM plots WHERE  size2='" . $row3['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "' and block_id='" . $block . "' and `type`='Villa' and status='' and `ctag` LIKE '%Villas%'";
				$villasres = $connection->createCommand($villassql)->query();
				$gtv1 = $gtv1 + count($villasres);
				echo '<td style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">';
					if(count($villasres)==0){ echo'';}else{ echo count($villasres);}echo'</td>';
				
					$tv = count($villasres);
				$selected  = "SELECT * from plots
	 where size2='" . $row3['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "' and block_id='" . $block . "'  and  isvilla !=1 and atype NOT LIKE'%Against Land%' and type='Plot' and status !=''";
				$selectedres = $connection->createCommand($selected)->query();
				///$tselected=$count($selectedres);
				$tselected = $tselected + count($selectedres);
				$gtselected1 = $gtselected1 + count($selectedres);
				echo '<td style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">'; 	if(count($selectedres)==0){ echo'';}else{ echo count($selectedres);}echo'</a></td>';
				$against_land  = "SELECT * from plots
	 where size2='" . $row3['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "' and block_id='" . $block . "'   and  atype  LIKE '%Against Land%' and plots.status !='' and plots.type='Plot'";
				$against_landres = $connection->createCommand($against_land)->query();
				$tagainstland = $tagainstland + count($against_landres);
				$gtal1 = $gtal1 + count($against_landres);
				echo '<td style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">'; 
				if(count($against_landres)==0){ echo'';}else{ echo count($against_landres);}
				 echo'</a></td>';

				$tal = 0;
				$ts = count($selectedres);
				$tal = ($tagainstland);
				$totheresvdres = 0;
				$talresvdres = 0;
				$gtps1 = $gtps1 + (count($against_landres) + $ts);
				$g = $ts + count($against_landres);
				echo '<td style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">';if(($g)==0){ echo'';}else{ echo ($g);}  echo'</td>';
                
                
                $alresvd  = "
SELECT * from plots
	 where size2='" . $row3['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "' and block_id='" . $block . "'  and  `ctag` LIKE '%Against Land%' and status='' and type !='file'";
				$alresvdres = $connection->createCommand($alresvd)->query();
				$talresvdres = $talresvdres + count($alresvdres);
				//	$totheresvdres=$totheresvdres+count($otheresvdres);
				$gtalrsvd1 = $gtalrsvd1 + count($alresvdres);
				echo '<td style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">';if((count($alresvdres))==0){ echo'';}else{ echo count($alresvdres);}echo'</td>';
				$otheresvd  = "SELECT * from plots
	 where size2='" . $row3['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "' and block_id='" . $block . "' AND plots.status = '' AND plots.ctag LIKE '%HRL Reserved%' and type !='file' ";
				$otheresvdres = $connection->createCommand($otheresvd)->query();
				$totheresvdres = $totheresvdres + count($otheresvdres);
				$gtothrrsvd1 = $gtothrrsvd1 + count($otheresvdres);
				$tr  = "SELECT COUNT(*) AS total
                FROM
            (
		SELECT * from plots
		where plots.type != 'file' AND size2='" . $row3['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "' and block_id='" . $block . "' and  plots.`ctag` LIKE '%Against Land%' AND plots.status = ''
	 UNION ALL
	 SELECT * from plots
	    where plots.type !='file' AND size2='" . $row3['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "' and block_id='" . $block . "' and    plots.ctag = 'HRL Reserved' AND plots.status = '' ) t";
				$trres = $connection->createCommand($tr)->queryRow();
				$tr = count($villasres);

				echo '<td style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">';
				if(floatval($totheresvdres)==0){ echo'';}else{ echo floatval($totheresvdres);}echo'</a></td>';
				
				$talrsvd = 0;
				$tothrresvd = 0;
				$tpendingfileres = 0;
				$talrsvd = ($talresvdres);
				$tothrresvd = ($totheresvdres);
				$tor = $tothrresvd;
				$talr = $talrsvd;
				echo '<td style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">';if(($trres['total'])==0){ echo'';}else{ echo ($trres['total']);} echo'</a></td>';
				
					$tbo = ($tp - ($g) - ($tv) - ($tor + $talr));
				///$tbo=$talr;
				$nosfile = 0;
				$gtrsvd1 = $gtothrrsvd1 + $gtalrsvd1;
				echo '<td style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">'; if($tbo==0){ echo'';}else{ echo $tbo;} echo'</a></td>';
				
				echo '<td style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">';
				if (!empty($tbo) && !empty($tp) && ($tp != 0)) {
					echo round(($tbo / $tp * 100), 2) . '%';
				}
				echo '</td>';
				$pendingfile  = "
SELECT * FROM memberplot mp
left join plots p on mp.plot_id=p.id
where size2='" . $row3['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "' and block_id='" . $block . "'  and p.type='file'";
				$pendingfileres = $connection->createCommand($pendingfile)->query();
				$tpendingfileres = $tpendingfileres + count($pendingfileres);
				echo '<td style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">';if(floatval($tpendingfileres==0)){ echo'';} else{ echo floatval($tpendingfileres);} echo'</td>';
				$nosfile = $tbo - floatval($tpendingfileres);
				echo '<td style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">';if($nosfile==0){ echo'';} else{ echo ($nosfile);} echo '</td>
<td style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">';
				if (!empty($tp) && ($tp != 0)) {
					echo round(($nosfile / $tp * 100), 2);
				}
				echo '%</td>

<td></td>';
				echo '</tr>';
				$gtp1 = $tp + $gtp1;
				$gtbo1 = $gtbo1 + $tbo;
				$gtpf1 = $tpendingfileres + $gtpf1;
				$gtfnb1 = $gtfnb1 + $nosfile;
		}}
		echo '<tr>
<td><strong>Total</strong></td>
<td></td>
<td style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;"><strong>' . $gtp1 . '</srong></td>
<td style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;"><strong>' . $gtsv1 . '</srong></td>
<td style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;"><strong>' . $gtusv1 . '</srong></td>
<td style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;"><strong>' . $gtv1 . '</srong></td>
<td style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;"><strong>' . $gtselected1 . '</srong></td>
<td style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;"><strong>' . $gtal1 . '</srong></td>
<td style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;"><strong>' . $gtps1 . '</srong></td>
<td style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;"><strong>' . $gtalrsvd1 . '</srong></td>
<td style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;"><strong>' . $gtothrrsvd1 . '</srong></td>
<td style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;"><strong>' . $gtrsvd1 . '</srong></td>
<td style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;"><strong>' . $gtbo1 . '</srong></td>
<td style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;"><strong>';
			if (!empty($tp) && ($tp != 0)) {
				echo (ROUND($gtbo1 / $gtp * 100, 2)) . '%';
			}
			echo '</srong></td>
<td style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;"><strong>' . $gtpf . '</srong></td>
<td style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;"><strong>' . $gtfnb . '</srong></td>
<td style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;"><strong>';
			if (!empty($tp) && ($tp != 0)) {
				echo (ROUND($gtfnb1 / $gtp1 * 100, 2)) . '%';
			}
			echo '</srong></td>

</tr>';
			?>
</tbody>
</table>
</textarea>
					<div style="text-align: left; margin-top: 1em;">
						<button type="submit">Print Report</button>
					</div>
				</form></td></tr>
		<?php 
	}
	 
	////////////////////END: FILES Allocation////////////////////////
public function actionSearchallocsum123()
		{		
if((Yii::app()->session['user_array']['per3']=='1')  || (Yii::app()->session['user_array']['per34'] == '1') || (Yii::app()->session['user_array']['id']=='68'))
 	{
	 	
						//for Pagination end
			$connection = Yii::app()->db;

       $sql_project = "SELECT * from projects where id=".$_POST['project']."";
		$result_project = $connection->createCommand($sql_project)->queryRow();
		
		
	
	$count=0;

		$home=Yii::app()->request->baseUrl;
$check=1;
$res=array();

$count++;
echo $count.' result found';
$home="";
$home=Yii::app()->request->baseUrl;
$gtp=0;
$gtsv=0;
$gtusv=0;
$gtv=0;
$gtselected=0;
$gtal=0;
$gtps=0;
$gtalrsvd=0;
$gtothrrsvd=0;
$gtrsvd=0;
$gtbo=0;
$gtpf=0;
$gtfnb=0;
$g=0;
$F='';
$M='';
$inc=0;
$open=0;
$plotsallocated=0;
$hrlreserved=0;
$againstland=0;
$topen=0;
$thrlreserved=0;
$tagainstland=0;
$tvillas=0;
$total=0;
$gtotal=0;
$tselected=0;
$op=0;
$against_landress='';
$talresvdres=0;
$com_res='';
$tp=0;
$tv=0;
$tor=0;
$talr=0;
$tbo=0;
$ts=0;
$block='';
$block=$_POST['block'];
if($_POST['com_res']=='Residential'){ $com_res='R';}
if($_POST['com_res']=='Commercial'){  $com_res='C';}
  $sql_plots  = "SELECT * from size_cat where typee='".$com_res."' Order by size_cat.id";
$result_plots = $connection->createCommand($sql_plots)->queryAll();	
foreach($result_plots as $row1)
{
	 
	$inc++;
echo '<tr><td>'.$inc.'</td><td>'.$row1['size'];
if($_POST['com_res']=='Residential'){ echo'&nbsp; (Residential)';}
if($_POST['com_res']=='Commercial'){ echo'&nbsp; (Commercial)';}
echo'</td>';
  $totalplots  = "SELECT * from plots
	 where size2='".$row1['id']."' AND com_res='".$_POST['com_res']."' and project_id='".$_POST['project']."' and block_id='".$block."' and type='Plot'";
	 	$totalplotsres = $connection->createCommand($totalplots)->query();
echo'<td style="text-align:right"><a href="total_plots_detail?com_res='.$com_res.'&size='.$row1['id'].'&&project_id='.$_POST['project'].'&&block_id='.$_POST['block_id'].'">'.count($totalplotsres).'</a></td>';
$tp=count($totalplotsres);

 $soldvillas  = "SELECT * from plots
	 where size2='".$row1['id']."' AND com_res='".$_POST['com_res']."' and project_id='".$_POST['project']."' and block_id='".$block."' and  `isvilla`=1 and status !='' and type='Plot'";
	 	$ressoldvillas = $connection->createCommand($soldvillas)->query();
echo'<td style="text-align:right"><a href="sold_villas_detail?com_res='.$com_res.'&size='.$row1['id'].'&&project_id='.$_POST['project'].'">'.count($ressoldvillas).'</a></td>';
$gtsv=$gtsv+count($ressoldvillas);
$unsoldvillas  = "SELECT * from plots
	 where size2='".$row1['id']."' AND com_res='".$_POST['com_res']."' and project_id='".$_POST['project']."' and block_id='".$block."' and  `isvilla`=1 and status='' and  `ctag` LIKE '%Villas%' and type='Plot'";
	 	$unsoldvillasres = $connection->createCommand($unsoldvillas)->query();
		$gtusv=$gtusv+count($unsoldvillasres);
echo '<td style="text-align:right"><a href="reserved_villas_detail?com_res='.$com_res.'&size='.$row1['id'].'&&project_id='.$_POST['project'].'">'.count($unsoldvillasres).'</a></td>';
$villassql  = "
SELECT * FROM plots where size2='".$row1['id']."' AND com_res='".$_POST['com_res']."' and project_id='".$_POST['project']."' and block_id='".$block."' AND plots.type = 'Plot' AND plots.isvilla = '1' AND plots.status != ''
 UNION ALL 
SELECT * FROM plots WHERE plots.type = 'Plot' and size2='".$row1['id']."' AND com_res='".$_POST['com_res']."' and project_id='".$_POST['project']."' and block_id='".$block."' and `isvilla`=1 and status='' and `ctag` LIKE '%Villas%'";
	 	$villasres = $connection->createCommand($villassql)->query();
		$gtv=$gtv+count($villasres);
echo '<td style="text-align:right"><a href="total_villas_detail?com_res='.$com_res.'&size='.$row1['id'].'&&project_id='.$_POST['project'].'">'.count($villasres).'</a></td>';
$tv=count($villasres);
 $selected  = "SELECT * from plots
	 where size2='".$row1['id']."' AND com_res='".$_POST['com_res']."' and project_id='".$_POST['project']."' and block_id='".$block."'  and  isvilla !=1 and atype NOT LIKE'%Against Land%' and type='Plot' and status !=''";
	 	$selectedres = $connection->createCommand($selected)->query();
	 	///$tselected=$count($selectedres);
		$tselected=$tselected+count($selectedres);
		$gtselected=$gtselected+count($selectedres);
echo '<td style="text-align:right"><a href="selected_balloted_detail?com_res='.$com_res.'&size='.$row1['id'].'&&project_id='.$_POST['project'].'">'.count($selectedres).'</a></td>';
 $against_land  = "SELECT * from plots
	 where size2='".$row1['id']."' AND com_res='".$_POST['com_res']."' and project_id='".$_POST['project']."' and block_id='".$block."'   and  atype  LIKE '%Against Land%' and plots.status !='' and plots.type='Plot'";
	 	$against_landres = $connection->createCommand($against_land)->query();
	 	$tagainstland=$tagainstland+count($against_landres);
		$gtal=$gtal+count($against_landres);
echo '<td style="text-align:right"><a href="againstland_plots_detail?com_res='.$com_res.'&size='.$row1['id'].'&&project_id='.$_POST['project'].'">'.count($against_landres).'</a></td>';

$tal=0;
$ts=count($selectedres);
$tal=($tagainstland);
$totheresvdres=0;
$talresvdres=0;
$gtps=$gtps+(count($against_landres)+$ts);
$g=$ts+count($against_landres);
echo'<td style="text-align:right"><a href="total_sold_plots_detail?com_res='.$com_res.'&size='.$row1['id'].'&&project_id='.$_POST['project'].'">'.($g).'</a></td>';


 $alresvd  = "
SELECT * from plots
	 where size2='".$row1['id']."' AND com_res='".$_POST['com_res']."' and project_id='".$_POST['project']."' and block_id='".$block."'  and  `ctag` LIKE '%Against Land%' and status='' and type='Plot'";
	 	$alresvdres = $connection->createCommand($alresvd)->query();
	 	$talresvdres=$talresvdres+count($alresvdres);
	 //	$totheresvdres=$totheresvdres+count($otheresvdres);
		$gtalrsvd=$gtalrsvd+count($alresvdres);
echo '<td style="text-align:right"><a href="againstland_rsvd_plots_detail?com_res='.$com_res.'&size='.$row1['id'].'&&project_id='.$_POST['project'].'">'.count($alresvdres).'</a></td>';
 $otheresvd  = "SELECT * from plots
	 where
 
	 plots.type='Plot' AND size2='".$row1['id']."' AND com_res='".$_POST['com_res']."' and project_id='".$_POST['project']."' and block_id='".$block."' AND plots.status = '' AND plots.ctag LIKE '%HRL Reserved%' and type='Plot' ";
	 	$otheresvdres = $connection->createCommand($otheresvd)->query();
	 	$totheresvdres=$totheresvdres+count($otheresvdres);
		$gtothrrsvd=$gtothrrsvd+count($otheresvdres);
		$tr  = "SELECT COUNT(*) AS total
                FROM
            (
		SELECT * from plots
		where plots.type = 'Plot'AND size2='".$row1['id']."' AND com_res='".$_POST['com_res']."' and project_id='".$_POST['project']."' and block_id='".$block."' and  plots.`ctag` LIKE '%Against Land%' AND plots.status = '' 
	 UNION ALL
	 SELECT * from plots
	    where plots.type='Plot' AND size2='".$row1['id']."' AND com_res='".$_POST['com_res']."' and project_id='".$_POST['project']."' and block_id='".$block."' and    plots.ctag = 'HRL Reserved' AND plots.status = '' ) t";
	 $trres = $connection->createCommand($tr)->queryRow();
	 $tr=count($villasres);
	 
echo '<td style="text-align:right"><a href="other_rsvd_plots_detail?com_res='.$com_res.'&size='.$row1['id'].'&& project_id='.$_POST['project'].'">'.floatval($totheresvdres).'</a></td>';
$talrsvd=0;
$tothrresvd=0;
$tpendingfileres=0;
$talrsvd=($talresvdres);
$tothrresvd=($totheresvdres);
$tor=$tothrresvd;
$talr=$talrsvd;
echo'<td style="text-align:right"><a href="total_rsvd_plots_detail?com_res='.$com_res.'&size='.$row1['id'].'&&project_id='.$_POST['project'].'">'.($trres['total']).'</a></td>';
$tbo=($tp-($g)-($tv)-($tor+$talr));
///$tbo=$talr;
$nosfile=0;
$gtrsvd=$gtothrrsvd+$gtalrsvd;
echo'<td style="text-align:right"><a href="nos_plots_detail?com_res='.$com_res.'&size='.$row1['id'].'&&project_id='.$_POST['project'].'">'.$tbo.'</a></td>';

///$total=count($openres)-(count($resvres)+count($alres)+count($villasres));


echo'<td style="text-align:right">';
if(!empty($tbo) && !empty($tp) && ($tp!=0)){
	
echo round(($tbo/$tp*100),2).'%';
}
echo'</td>';

$pendingfile  = "

SELECT * FROM memberplot mp
left join plots p on mp.plot_id=p.id
where size2='".$row1['id']."' AND com_res='".$_POST['com_res']."' and project_id='".$_POST['project']."' and block_id='".$block."'  and p.type='file'";
	 	$pendingfileres = $connection->createCommand($pendingfile)->query();
	 	$tpendingfileres=$tpendingfileres+count($pendingfileres);
echo '<td style="text-align:right"><a href="pending_files_detail?com_res='.$com_res.'&size='.$row1['id'].'&&project_id='.$_POST['project'].'">'.floatval($tpendingfileres).'</a></td>';
$nosfile=$tbo-floatval($tpendingfileres);
echo'<td style="text-align:right">'.($nosfile).'</td>
<td style="text-align:right">';
	if(!empty($tp) && ($tp!=0))
	{
		echo round(($nosfile/$tp*100),2);
	}
echo'%</td>

<td></td>
</tr>';
$gtp=$tp+$gtp;
$gtbo=$gtbo+$tbo;
$gtpf=$tpendingfileres+$gtpf;
$gtfnb=$gtfnb+$nosfile;

	}	
echo'<tr>
<td><strong>Total</strong></td>
<td></td>
<td style="text-align:right"><strong>'.$gtp.'</srong></td>
<td style="text-align:right"><strong>'.$gtsv.'</srong></td>
<td style="text-align:right"><strong>'.$gtusv.'</srong></td>
<td style="text-align:right"><strong>'.$gtv.'</srong></td>
<td style="text-align:right"><strong>'.$gtselected.'</srong></td>
<td style="text-align:right"><strong>'.$gtal.'</srong></td>
<td style="text-align:right"><strong>'.$gtps.'</srong></td>
<td style="text-align:right"><strong>'.$gtalrsvd.'</srong></td>
<td style="text-align:right"><strong>'.$gtothrrsvd.'</srong></td>
<td style="text-align:right"><strong>'.$gtrsvd.'</srong></td>
<td style="text-align:right"><strong>'.$gtbo.'</srong></td>
<td style="text-align:right"><strong>';	if(!empty($tp) && ($tp!=0)){echo (ROUND($gtbo/$gtp*100,2)).'%';}echo'</srong></td>
<td style="text-align:right"><strong>'.$gtpf.'</srong></td>
<td style="text-align:right"><strong>'.$gtfnb.'</srong></td>
<td style="text-align:right"><strong>';	if(!empty($tp) && ($tp!=0)){echo (ROUND($gtfnb/$gtp*100,2)).'%';}echo'</srong></td>
<td style="text-align:right"><strong></srong></td>
</tr>';
 
 	}
	}
	public function actionPlots_Allocation_Summary(){
	
		if((Yii::app()->session['user_array']['id']=='1') || (Yii::app()->session['user_array']['id']=='68'))
 	
{

$connection = Yii::app()->db;
$temp_projects_array = Yii::app()->session['projects_array'];
$num_of_projects_counter = count($temp_projects_array);
$num_of_projects_counter2 = $num_of_projects_counter;
$sql1 =   "select * from projects where";
$num_of_projects_counter--;
while($num_of_projects_counter>-1)
{
$sql2[$num_of_projects_counter] = " id=".Yii::app()->session['projects_array'][$num_of_projects_counter]['project_id'];
$num_of_projects_counter--;
}

$sql_project = $sql1;
$sql_project = $sql_project.implode(' or',$sql2);


$result_projects = $connection->createCommand($sql_project)->query() or mysql_error();


//$sql_project = "SELECT * from projects";
//$result_project = $connection->createCommand($sql_project)->query();


$sql_categories  = "SELECT * from categories";
$categories = $connection->createCommand($sql_categories)->query();
$sql_size  = "SELECT * from size_cat";
$sizes = $connection->createCommand($sql_size)->query();
$sql_sector ="SELECT * FROM sectors";
$result_sector = $connection->createCommand($sql_sector)->query();

$sql_com_res ="SELECT DISTINCT com_res FROM plots";
$result_com_res = $connection->createCommand($sql_com_res)->query();

$home=Yii::app()->request->baseUrl;

$this->render('plots_allocation_summary',array('projects'=>$result_projects,'sectors'=>$result_sector,'categories'=>$categories,'sizes'=>$sizes,'com_res'=>$result_com_res));
}else{
$this->redirect(array('user/dashboard'));
}
	
	}
    ////////////////////////END: RESIDENTIAL ALLOCATION PLOTS SUMMARY//////
     
      ////////////////////START:REPORTING MODULE//////////////////
	public function actionTotal_plots_detail()
		{
			if((Yii::app()->session['user_array']['per3']=='1')  || (Yii::app()->session['user_array']['per34'] == '1')) {
		 	$connection = Yii::app()->db;
			$this->render('total_plots_detail');
			}else
			{
			$this->redirect(array('user/dashboard'));
			}	
		}
	/////////////////////END:REPORTING MODULE//////////////////
    
  	///////////START:PLOTS STATUS//////////////
    	public function actionPlots_Status()
		{
		if((Yii::app()->session['user_array']['per2']=='1')&& isset(Yii::app()->session['user_array']['username']))
		{
		
				if((Yii::app()->session['user_array']['per2']=='1')&& isset(Yii::app()->session['user_array']['username'])||(Yii::app()->session['user_array']['per34']=='1'))
							{
							$plotno='';
							$st='';
							$pro='';
							$com_res='';
							$sector='';
							$size='';
							$cat='';
							$where='';
							$and = false;
							$where='';
				if (!empty($_POST['status'])){
									if($_POST['status']=='Alloted'){
							$where.="plots.status ='".$_POST['status']."'";
							$and = true;
									}
							}
						if (isset($_POST['rstatus'])){
							$where.="plots.rstatus LIKE '%".$_POST['rstatus']."%'";
							$and = true;
							}
								
							if (isset($_POST['sector']) && $_POST['sector']!=""){
								$where.="plots.sector LIKE '%".$_POST['sector']."%'";
								$and = true;
								$sector=$_POST['sector'];
							}
							
							if (isset($_POST['com_res']) && $_POST['com_res']!=""){
								$where.="plots.com_res LIKE '%".$_POST['com_res']."%'";
								$and = true;
								$sector=$_POST['com_res'];
							}
							if ($and==true)
								{
									$where.="  and type='plot' ";
								}
								else
								{
									$where.="type='plot' ";
								}
								$and=true;
							
							
							
							if (isset($_POST['plotno']) && $_POST['plotno']!=""){
								$plotno=$_POST['plotno'];
								if ($and==true)
								{
									$where.=" and plots.plot_detail_address LIKE '%".$_POST['plotno']."%'";
								}
								else
								{
									$where.=" plots.plot_detail_address LIKE '%".$_POST['plotno']."%'";
								}
								$and=true;
							}
								if (isset($_POST['size']) && $_POST['size']!=""){
								$size=$_POST['size'];
								if ($and==true)
								{
									$where.=" and plots.size2 LIKE '%".$_POST['size']."%'";
								}
								else
								{
									$where.=" plots.size2 LIKE '%".$_POST['size']."%'";
								}
								$and=true;
							}
											if ( isset($_POST['project_id']) &&  $_POST['project_id']!=""){
								$pro=$_POST['project_id'];
								if ($and==true)
								{
									$where.=" and plots.project_id LIKE '%".$_POST['project_id']."%'";
								}
								else
								{
									$where.=" plots.project_id LIKE '%".$_POST['project_id']."%'";
								}
								$and=true;
							}
							
							
							if (isset($_POST['street_id']) && $_POST['street_id']!=""){
								$st=$_POST['street_id'];
								if ($and==true)
								{
									$where.=" and plots.street_id LIKE '%".$_POST['street_id']."%'";
								}
								else
								{
									$where.=" plots.street_id LIKE '%".$_POST['street_id']."%'";
								}
								$and=true;
							}
							
							
							
							
						
					$connection = Yii::app()->db;
				$sql_member = "SELECT
				plots.id
				, plots.street_id
				, plots.project_id
				, plots.plot_size
				, plots.com_res
					, plots.size2
				, plots.rstatus
					, plots.sector
					, plots.category_id
					, plots.status
					, plots.plot_detail_address
					, memberplot.plotno
				, projects.project_name
					, streets.street
					
				FROM
				plots
				Left JOIN streets  ON (plots.street_id = streets.id)
					Left JOIN projects  ON (plots.project_id = projects.id)
					Left JOIN memberplot  ON (plots.id = memberplot.plot_id)
				where $where ORDER BY `plot_detail_address` ASC, `street` ASC, `sector` ASC";
						$result_members = $connection->createCommand($sql_member)->query();
				$connection = Yii::app()->db;
						$temp_projects_array = Yii::app()->session['projects_array'];
							$num_of_projects_counter = count($temp_projects_array);
						$num_of_projects_counter2 = $num_of_projects_counter;
						$sql1 =   "select * from projects where";
						$num_of_projects_counter--;
						while($num_of_projects_counter>-1)
						{
							$sql2[$num_of_projects_counter] = " id=".Yii::app()->session['projects_array'][$num_of_projects_counter]['project_id'];
							$num_of_projects_counter--;
						}
						
						$sql_project = $sql1;
						$sql_project = $sql_project.implode(' or',$sql2);
						
						
						$result_projects = $connection->createCommand($sql_project)->query() or mysql_error();
						
						
						//$sql_project = "SELECT * from projects";
						//$result_project = $connection->createCommand($sql_project)->query();
					
						
						$sql_categories  = "SELECT * from categories";
						$categories = $connection->createCommand($sql_categories)->query();
						$sql_size  = "SELECT * from size_cat";
						$sizes = $connection->createCommand($sql_size)->query();
					$sql_sector ="SELECT * FROM sectors";
						$result_sector = $connection->createCommand($sql_sector)->query();
						
					$sql_com_res ="SELECT DISTINCT com_res FROM plots";
						$result_com_res = $connection->createCommand($sql_com_res)->query();
						
						$home=Yii::app()->request->baseUrl;
							
					$this->render('plots_status',array('members'=>$result_members,'projects'=>$result_projects,'sectors'=>$result_sector,'pro'=>$pro,'st'=>$st,'sector'=>$sector,'plotno'=>$plotno,'categories'=>$categories,'sizes'=>$sizes,'com_res'=>$result_com_res));
					}else{
						$this->redirect(array('user/dashboard'));
						}
					
			
				
		}else{
		$this->redirect(array('user/dashboard'));
		}
		
		
		}

		public function actionSearch_Status()
		{
			
if((Yii::app()->session['user_array']['per3']=='1')  || (Yii::app()->session['user_array']['per34'] == '1')) {
		$where="plots.type='plot'";
$and=true;
if (!empty($_POST['project'])){
if($and==true)
{
$where.=" AND plots.project_id LIKE '%".$_POST['project']."%'";
}
else
{
$where.="  plots.project_id LIKE '%".$_POST['project']."%'";
}
$and=true;
}
if (isset($_POST['sector']) && $_POST['sector']!="")
{				
$where.=" and plots.sector ='".$_POST['sector']."'";
				$and = true;
				$sector=$_POST['sector'];
}
if (isset($_POST['com_res']) && $_POST['com_res']!=""){
$where.="and plots.com_res LIKE '%".$_POST['com_res']."%'";
$and = true;
$com_res=$_POST['com_res'];
}
			if (!empty($_POST['plotno'])){
if ($and==true)
{
$where.=" and plots.plot_detail_address ='".$_POST['plotno']."'";
}
else
{
$where.="plots.plot_detail_address='".$_POST['plotno']."'";
}
$and==true;
}
if (isset($_POST['plotno1']) && $_POST['plotno1']!=""){
				$plotno=$_POST['plotno1'];
				if ($and==true)
				{
					$where.=" and memberplot.plotno  Like '%".$_POST['plotno1']."%'";
				}
				else
				{
					$where.=" memberplot.plotno Like '%".$_POST['plotno1']."%'";
				}
				$and=true;
			}
			if (isset($_POST['size']) && $_POST['size']!=""){
				$plotno=$_POST['size'];
				if ($and==true)
				{
					$where.=" and plots.size2 LIKE '%".$_POST['size']."%'";
				}
				else
				{
					$where.=" plots.size2 LIKE '%".$_POST['size']."%'";
				}
				$and=true;
			}
if (isset($_POST['ctag']) && $_POST['ctag']!=""){
				
				if ($and==true)
				{
					$where.=" and plots.ctag LIKE '%".$_POST['ctag']."%'";
				}
				else
				{
					$where.=" plots.ctag LIKE '%".$_POST['ctag']."%'";
				}
				$and=true;
			}
			$catt='';
			$extra1='';
			if (isset($_POST['cat']) && $_POST['cat']!=""){
			$aa=0;
				$extra1="inner JOIN cat_plot  ON (plots.id = cat_plot.plot_id)";
				foreach($_POST['cat'] as $ass){if($aa==1){$catt.',';} $catt=$ass;$aa++; };
				if ($and==true)
				{
					$where.=" and cat_plot.cat_id IN (".$catt.")";
				}
				else
				{
					$where.=" cat_plot.cat_id IN (".$catt.")";
				}
				$and=true;
			}
			if (!empty($_POST['allotmentstatus'])){
if($_POST['allotmentstatus']==1){ $where.=" and mp.status='Approved'";}
if($_POST['allotmentstatus']==2){ $where.=" and mp.status!='Approved' and mp.fstatus!='Approved'";}
if($_POST['allotmentstatus']==4){if ($and==true)
{
$where.=" and mp.mstatus=2";
}
else
{
$where.=" mp.mstatus=0";
}

}
}
			if (!empty($_POST['stat'])){
			if($_POST['stat']==1){$where.="and plots.rstatus ='reallocated'";}
			if($_POST['stat']==2){$where.="and plots.status ='Alotted'";}
			if($_POST['stat']==3){$where.="and plots.status =''";}
			if($_POST['stat']==4){$where.="and plots.bstatus ='reserved'";}
							$and = true;
			}
			if (isset($_POST['street_id']) && $_POST['street_id']!=""){
				$st=$_POST['street_id'];
				if ($and==true)
				{
					$where.=" and plots.street_id='".$_POST['street_id']."'";
				}
				else
				{
					$where.=" plots.street_id='".$_POST['street_id']."'";
				}
				$and=true;
			}
//for Pagination
if(isset($_POST['limit']) && $_POST['limit']!==''){$limit = $_POST['limit'];}else{
$limit = 100;}
$adjacent = 100;
$page = $_REQUEST['page'];
if($page==1){
$start = 0;
}
else{
$start = ($page-1)*$limit;
}
$connection = Yii::app()->db;
 $sql_memberas = "SELECT * FROM plots
    inner JOIN streets  ON (plots.street_id = streets.id)
    ".$extra1."
    inner JOIN sectors  ON (plots.sector = sectors.id)
	inner JOIN projects  ON (plots.project_id = projects.id)
	inner JOIN memberplot  ON (plots.id = memberplot.plot_id)
	inner JOIN size_cat  ON (plots.size2 = size_cat.id)
	
	inner JOIN cat_plot  ON (cat_plot.plot_id = plots.id)
where $where ";
$co = $connection->createCommand($sql_memberas)->queryAll();
		$rows =count($co);
			//for Pagination end
			$connection = Yii::app()->db;
/* $sql_member = "SELECT
plots.id
, plots.street_id
, plots.plot_size
, plots.project_id
, plots.com_res
	, plots.size2
, plots.rstatus
	, plots.sector
	, plots.category_id
	, plots.status
, plots.ctag
	, memberplot.fstatus
	, plots.bstatus
	, plots.plot_detail_address
	, memberplot.plotno
, projects.project_name
	, streets.street
	,members.name
	,members.mtype
	, size_cat.size
	, size_cat.typee
	,size_cat.size_sorting
	,sector_name
	,streets.streets_sorting
	,sectors.sectors_sorting
	,categories.name as cname
FROM
plots
Left JOIN streets  ON (plots.street_id = streets.id)
	".$extra1."
	Left JOIN projects  ON (plots.project_id = projects.id)
	Left JOIN sectors  ON (plots.sector = sectors.id)
	Left JOIN memberplot  ON (plots.id = memberplot.plot_id)
	Left JOIN members  ON (members.id = memberplot.member_id)
	Left JOIN size_cat  ON (size_cat.id = plots.size2)
	LEFT JOIN cat_plot ON cat_plot.plot_id=plots.id
	LEFT JOIN categories on cat_plot.cat_id=categories.id
where $where  order by size_cat.size_sorting,streets_sorting,sectors_sorting limit $start,$limit ";*/
$sql_member="SELECT
plots.id
, plots.street_id
, plots.plot_size
, plots.project_id
, plots.com_res
, plots.size2
, plots.rstatus
, plots.sector
, plots.category_id
, plots.status
, plots.ctag
, memberplot.fstatus
, plots.bstatus
, plots.remarks
, plots.atype
, plots.plot_detail_address
, memberplot.plotno
, projects.project_name
, streets.street
,members.name
,members.mtype
, size_cat.size
, size_cat.typee
,size_cat.size_sorting
,sector_name
,streets.streets_sorting
,sectors.sectors_sorting  
FROM
plots
inner JOIN streets  ON (plots.street_id = streets.id)
	inner JOIN projects  ON (plots.project_id = projects.id)
	inner JOIN sectors  ON (plots.sector = sectors.id)
	inner JOIN memberplot  ON (plots.id = memberplot.plot_id)
	inner JOIN members  ON (members.id = memberplot.member_id)
	inner JOIN size_cat  ON (size_cat.id = plots.size2) where  $where  order by  sectors_sorting,streets_sorting,plots.plot_detail_address limit $start,$limit ";
$result_members = $connection->createCommand($sql_member)->queryAll();
$sql_project = "SELECT * from projects";
		$result_project = $connection->createCommand($sql_project)->query();
		
		
	
	$count=0;
	if ($result_members!=''){
	
		$home=Yii::app()->request->baseUrl;
$check=1;
$res=array();
foreach($result_members as $key){
	$sqlcat="SELECT categories.id,(SELECT name FROM categories inner JOIN cat_plot ON cat_plot.cat_id = categories.id WHERE cat_id = 6 and cat_plot.plot_id='".$key['id']."'
) AS corner,(SELECT name FROM categories LEFT JOIN cat_plot ON cat_plot.cat_id = categories.id WHERE cat_id = 7 and cat_plot.plot_id='".$key['id']."') AS fp,
(SELECT name FROM categories inner JOIN cat_plot ON cat_plot.cat_id = categories.id WHERE cat_id = 8 and cat_plot.plot_id='".$key['id']."') AS blvd,
(SELECT name FROM categories inner JOIN cat_plot ON cat_plot.cat_id = categories.id WHERE cat_id = 9 and cat_plot.plot_id='".$key['id']."') AS 80feet,
(SELECT name FROM categories inner JOIN cat_plot ON cat_plot.cat_id = categories.id WHERE cat_id = 10 and cat_plot.plot_id='".$key['id']."') AS 60feet

from categories
inner JOIN cat_plot ON cat_plot.cat_id=categories.id
 where cat_plot.plot_id='".$key['id']."'";
	$rescat = $connection->createCommand($sqlcat)->queryRow();
	
	
$count++;
// $count.' result found';
$home="";
$home=Yii::app()->request->baseUrl;
$F='';
$M='';
///foreach($rescat as $cat){
echo '<tr><td>'.$count.'</td><td>'.$key['plot_detail_address'].'</td>
<td>'.$key['size'].'&nbsp('.$key['plot_size'].')'.'</td>
<td>'.$key['street'].'</td>
<td>'.$key['sector_name'].'</td>';
		
echo'<td>';if($rescat['corner']=='Corner'){ echo'<img src="/images/tickmark.png" />';}else {echo'';} echo'</td>
<td>';if($rescat['fp']=='Facing Park'){ echo '<img src="/images/tickmark.png" />';}else {echo'';} echo'</td>
<td>';if($rescat['blvd']=='Boulevard'){ echo '<img src="/images/tickmark.png" />';}else {echo'';} echo'</td>
<td>';if($rescat['80feet']=='Boulevard (80 Feet)'){ echo '<img src="/images/tickmark.png" />';}else { echo'';}echo'</td>
<td>';if($rescat['60feet']=='Road (60 Feet)'){ echo '<img src="/images/tickmark.png" />';}else {echo'';} echo'</td>
<td>';
if(empty($rescat['corner'])&&empty($rescat['fp'])&&empty($rescat['blvd'])&&empty($rescat['80feet'])&&empty($rescat['60feet']))
{
echo'<img src="/images/tickmark.png" />';
}
echo'</td>';
		
echo'<td>Select</td>
<td>';if($key['ctag']=='Against Land'){ echo'<img src="/images/tickmark.png" />';}else{echo'';}echo'</td>
<td>';if($key['ctag']=='Villas'){ echo'<img src="/images/tickmark.png" />';}else{echo'';}echo'</td>
<td>';if($key['ctag']=='HRL Reserved'){ echo'<img src="/images/tickmark.png" />';}else{echo'';}echo'</td>
<td>'.$key['name'].'</td>
<td>'.$key['atype'].'</td>
<td>'.$key['plotno'].'</td>
<td>'.$key['plot_detail_address'].','.$key['street'].','.$key['sector_name'].'</td>
<td>'.$key['remarks'].'</td>
<td>'.$key['mtype'].'</td></tr>';
//}
}?>
				<tr><td colspan="21">
<form id="form" action="<?php echo Yii::app()->baseUrl; ?>/dompdf/www/pdfgenerator.php" method="post">
<input type="hidden" name="paper" value="a4">
  <input type="hidden" name="orientation" value="landscape">
</p>
<textarea style="visibility:hidden;" name="html" id="html">
<meta charset="utf-8">
<title></title>
<style>
td{  }
.table-bordered{ border:1px solid #000; border-bottom:1px solid;}
table{ border:0px solid;}

</style>
</style>
<html>
<body>
<table width="100%" cellspacing="0" cellpadding="0">
<tr><td colspan="4"><h3><?php echo $key['project_name'];?> Plots</h3></td></tr>
  <tr style="background:#666; border-color:#ccc; color:#fff; ">
       
<td>Sr #</td>         
<td>Plot #</td>
<td>Plot Size</td>
<td>Street/Lane</td>
<td>Block</td>
<td>Corner</td>
<td>Facing Park</td>
<td>Main Blvd</td>
<td>80' Road</td>
<td>60' Road</td>
<td>Normal</td>
<td>Selection</td>
<td>AL</td>
<td>Villas</td>
<td>HRL Resvd</td>
<td>Member Name</td>
<td>Allotment Type</td>
<td>MS #</td>
<td>Plot #/Street,Lane/Block</td>

<td>Delaer/Land Owner</td>
  </tr>
  
  
  <?php 
  		
$count1=0;
  foreach($result_members as $key){
	  $sqlcat="SELECT categories.id,(SELECT NAME FROM categories LEFT JOIN cat_plot ON cat_plot.cat_id = categories.id WHERE cat_id = 6 and cat_plot.plot_id='".$key['id']."'
) AS corner,(SELECT NAME FROM categories LEFT JOIN cat_plot ON cat_plot.cat_id = categories.id WHERE cat_id = 7 and cat_plot.plot_id='".$key['id']."') AS fp,
(SELECT NAME FROM categories LEFT JOIN cat_plot ON cat_plot.cat_id = categories.id WHERE cat_id = 8 and cat_plot.plot_id='".$key['id']."') AS blvd,
(SELECT NAME FROM categories LEFT JOIN cat_plot ON cat_plot.cat_id = categories.id WHERE cat_id = 9 and cat_plot.plot_id='".$key['id']."') AS 80feet,
(SELECT NAME FROM categories LEFT JOIN cat_plot ON cat_plot.cat_id = categories.id WHERE cat_id = 10 and cat_plot.plot_id='".$key['id']."') AS 60feet

from categories
LEFT JOIN cat_plot ON cat_plot.cat_id=categories.id
 where cat_plot.plot_id='".$key['id']."'";
	$rescat = $connection->createCommand($sqlcat)->queryRow();
$count1++;
$home="";
$home=Yii::app()->request->baseUrl;
$F='';
$M='';
echo '<tr><td>'.$count1.'</td><td style="width:15px;">'.$key['plot_detail_address'].'</td>
<td>'.$key['size'].'&nbsp('.$key['plot_size'].')'.'</td>

<td>'.$key['street'].'</td>
<td>'.$key['sector_name'].'</td>';
		

echo'<td>';if($rescat['corner']=='Corner'){?><img src="<?php echo Yii::getPathOfAlias('webroot')."/images/tickmark.png";?>"> <?php }else {echo'';} echo'</td>
<td>';if($rescat['fp']=='Facing Park'){?><img src="<?php echo Yii::getPathOfAlias('webroot')."/images/tickmark.png";?>"> <?php }else {echo'';} echo'</td>
<td>';if($rescat['blvd']=='Boulevard'){?><img src="<?php echo Yii::getPathOfAlias('webroot')."/images/tickmark.png";?>"> <?php }else {echo'';} echo'</td>
<td>';if($rescat['80feet']=='Boulevard (80 Feet)'){?><img src="<?php echo Yii::getPathOfAlias('webroot')."/images/tickmark.png";?>"> <?php }else { echo'';}echo'</td>
<td>';if($rescat['60feet']=='Road (60 Feet)'){?><img src="<?php echo Yii::getPathOfAlias('webroot')."/images/tickmark.png";?>"> <?php } else {echo'';} echo'</td>
<td>';
if(empty($rescat['corner']) && empty($rescat['fp']) && empty($rescat['blvd']) && empty($rescat['80feet']) && empty($rescat['60feet']))
{
	echo 'Normal';
}
echo'</td>';
		
echo'<td>Select</td>
<td>';if($key['ctag']=='Against Land'){?><img src="<?php echo Yii::getPathOfAlias('webroot')."/images/tickmark.png";?>"> <?php }else{echo'';}echo'</td>
<td>';if($key['ctag']=='Villas'){?><img src="<?php echo Yii::getPathOfAlias('webroot')."/images/tickmark.png";?>"> <?php }else{echo'';}echo'</td>
<td>';if($key['ctag']=='HRL Reserved'){?><img src="<?php echo Yii::getPathOfAlias('webroot')."/images/tickmark.png";?>"> <?php }else{echo'';}echo'</td>
<td>'.$key['name'].'</td>
<td>'.$key['atype'].'</td>
<td>'.$key['plotno'].'</td>
<td>'.$key['plot_detail_address'].','.$key['street'].','.$key['sector_name'].'</td>

<td>'.$key['mtype'].'</td>';
}
  
  ?>

</table>
</body>
</html>
    
</textarea>
<div style="text-align: left; margin-top: 1em;">
<button type="submit">Print Report</button>
</div>
</form>
<?php echo'</td></tr>';
				
				
		}?> 
<script>
		function deletethis(id,idd){
				var x = confirm("Are you sure you want to delete?");
		
		if(x == true){
		window.location="deleteplot?id=" + id + "&&did=" + idd + "";
		}
		if(x == false){return false;}
		}
		
		</script>
<?php
		// for pagination
		$pagination='';
	if ($page == 0) $page = 1;					//if no page var is given, default to 1.
	$prev = $page - 1;							//previous page is page - 1
		$next = $page + 1;							//next page is page + 1
			$prev_='';
			$first='';
				$lastpage = ceil($rows/$limit);
			$next_='';
			$last='';
			$adjacents=$adjacent;
			if($lastpage > 1)
					{	if ($page > 1)
					$prev_.= "<a class='page-numbers' href=\"?page=$prev\">previous</a>";
						else{	}
						if ($lastpage < 5 + ($adjacents * 2))	//not enough pages to bother breaking it up
					{
				$first='';
					for ($counter = 1; $counter <= $lastpage; $counter++)
					{
						if ($counter == $page)
							$pagination.= "<span class=\"current\">$counter</span>";
						else
												$pagination.= "<a class='page-numbers' href=\"?page=$counter\">$counter</a>";
					}
					$last='';
				}
						elseif($lastpage > 3 + ($adjacents * 2))	//enough pages to hide some
				{
					$first='';
							if($page < 1 + ($adjacents * 2))
					{
						for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
						{
							if ($counter == $page)
								$pagination.= "<span class=\"current\">$counter</span>";
							else
													$pagination.= "<a class='page-numbers' href=\"?page=$counter\">$counter</a>";
						}
								$last.= "<a class='page-numbers' href=\"?page=$lastpage\">Last</a>";
					}
					elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
					{
					$first.= "<a class='page-numbers' href=\"?page=1\">First</a>";
					for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
						{
							if ($counter == $page)
								$pagination.= "<span class=\"current\">$counter</span>";
							else
													$pagination.= "<a class='page-numbers' href=\"?page=$counter\">$counter</a>";
						}
									$last.= "<a class='page-numbers' href=\"?page=$lastpage\">Last</a>";
					}
					else
					{
						$first.= "<a class='page-numbers' href=\"?page=1\">First</a>";
						for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
						{
							if ($counter == $page)
								$pagination.= "<span class=\"current\">$counter</span>";
							else
													$pagination.= "<a class='page-numbers' href=\"?page=$counter\">$counter</a>";
						}
						$last='';
					}
			}
				if ($page < $counter - 1)
					$next_.= "<a class='page-numbers' href=\"?page=$next\">next</a>";
				else{
					}
				$pagination = "<div class=\"pagination\">".$first.$prev_.$pagination.$next_.$last;
						$pagination.= "</div>\n";
			}
		echo '<tr  ><td colspan="21"><b style="color:#08c">Total Records Found :&nbsp;&nbsp;'.$rows.'</b></td></tr>';
			echo '<tr><td colspan="21">'.$pagination.'</td></tr>'; exit;
			// for pagination END
			exit;
			echo $count.' result found' ;exit;
			if(isset($_POST['username']) && empty($_POST['username']))
					{
						$error = 'Please enter username<br>';
					}
					if(isset($_POST['password']) && empty($_POST['password']))
					{
						$error .= 'Please enter Password<br>';
					}
					if(empty($error))
					{
						$username = $_POST['username'];
						$password = md5($_POST['password']);
						$connection = Yii::app()->db;
						$sql = "SELECT * FROM user where username ='".$username."' AND  password='".$password."' AND status=1";
						$result_data = $connection->createCommand($sql)->queryRow();
						if($result_data)
						{
								Yii::app()->session['user_array'] = $result_data;
								echo 1;exit();
						}else
						{
							echo "Invalid Username and Password";
						}
					}else
					{
						echo $error;
					}
				exit;
			
					}
			}  
    
    
 /////////START:SUMMARY OF UNSOLD RESIDENTIAL PLOTS////////
/*
	public function actionSearchunsoldr()
		{
			
if((Yii::app()->session['user_array']['per3']=='1')  || (Yii::app()->session['user_array']['per34'] == '1')) {
	
			
			
			
			
			
			//for Pagination end
			$connection = Yii::app()->db;

       $sql_project = "SELECT * from projects where id=".$_POST['project']."";
		$result_project = $connection->createCommand($sql_project)->queryRow();
		
		
	
	$count=0;

		$home=Yii::app()->request->baseUrl;
$check=1;
$res=array();

$count++;
echo $count.' result found';
$home="";
$home=Yii::app()->request->baseUrl;
$F='';
$M='';
$inc=0;
$open=0;
$hrlreserved=0;
$againstland=0;
$topen=0;
$thrlreserved=0;
$tagainstland=0;
$tvillas=0;
$total=0;
$gtotal=0;
$op=0;
  $com_res='';
if($_POST['com_res']=='Residential'){ $com_res='R';}
if($_POST['com_res']=='Commercial'){  $com_res='C';}
  $sql_plots  = "SELECT * from size_cat where typee='".$com_res."' Order by size_cat.id";
$result_plots = $connection->createCommand($sql_plots)->queryAll();	
foreach($result_plots as $row1)
{
	 

	$inc++;
echo '<tr><td>'.$inc.'</td><td>'.$row1['size'];
if($_POST['com_res']=='Residential'){ echo'&nbsp; (Residential)';}
if($_POST['com_res']=='Commercial'){ echo'&nbsp; (Commercial)';}
echo'</td>';
 $opensql  = "SELECT * from plots
	 where size2='".$row1['id']."' AND com_res='".$_POST['com_res']."' and project_id='".$_POST['project']."' and status='' and ctag=''";
	 	$openres = $connection->createCommand($opensql)->query();
echo'<td style="text-align:right">'.count($openres).'</td>';
 $resvsql  = "SELECT * from plots
	 where size2='".$row1['id']."' AND com_res='".$_POST['com_res']."' and project_id='".$_POST['project']."'  and ctag='HRL Reserved' and status=''";
	 	$resvres = $connection->createCommand($resvsql)->query();
echo'<td style="text-align:right">'.count($resvres).' </td>';
$alsql  = "SELECT * from plots
	 where size2='".$row1['id']."' AND com_res='".$_POST['com_res']."' and project_id='".$_POST['project']."'  and  `ctag` LIKE '%Against Land%' and status=''";
	 	$alres = $connection->createCommand($alsql)->query();
echo '<td style="text-align:right">'.count($alres).' </td>';
$villassql  = "SELECT * from plots
	 where size2='".$row1['id']."' AND com_res='".$_POST['com_res']."' and project_id='".$_POST['project']."'  and  `ctag` LIKE '%Villas%' and status=''";
	 	$villasres = $connection->createCommand($villassql)->query();
echo '<td style="text-align:right">'.count($villasres).' </td>';
$total=count($openres)+count($resvres)+count($alres)+count($villasres);
echo'<td style="text-align:right">'.$total.'</td><td></td></tr>';
	$topen=$topen+count($openres);
	$thrlreserved=$thrlreserved+count($resvres);
	$tagainstland=$tagainstland+count($alres);
	$tvillas=$tvillas+count($villasres);
	$gtotal=$gtotal+$total;
}	
echo'<tr><td>Total</td><td></td><td style="text-align:right"><strong>'.$topen.'</srong></td><td style="text-align:right"><strong>'.$thrlreserved.'</srong></td><td style="text-align:right"><strong>'.$tagainstland.'</srong></td><td style="text-align:right"><strong>'.$tvillas.'</srong></td><td style="text-align:right"><strong>'.$gtotal.'</srong></td><td></td></tr><tr><td colspan="8">';
 }?>
 	<form id="form" action="<?php echo Yii::app()->baseUrl; ?>/dompdf/www/pdfgenerator.php" method="post">
<input type="hidden" name="paper" value="a4">
<input type="hidden" name="orientation" value="landscape">
</p>
<textarea name="html1" style="display:none;" cols="80" rows="20">
<meta charset="utf-8">
<title></title>
<link rel="stylesheet" type="text/css" href="../views/recovery/report.css">
<style>
td{  }
.table-bordered{ border:1px solid #000; border-bottom:1px solid #000;}
table{ border:0px solid;}

</style>

  	<table  width="100%" border="0" cellspacing="0px" cellpadding="0px">
    <tr>
      <td style="padding:0 0 0 0; ">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td bgcolor="#FFFFFF">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="100" class="BoledText" style="border-left:thin; border-left-style:solid; border-top:thin; border-top-style:solid; border-right:thin; border-right-style:solid">
                  <?php   echo'<img style="height:40px;"  src="'.Yii::getPathOfAlias('webroot').'/images/logo1.png"/>';?>
                  </td>
                  <td colspan="6" align="center" valign="middle" style="border-top:thin; border-top-style:solid; border-right:thin; border-right-style:solid; font-size:14px;  font-weight:bold"><span class="style6">Unsold Plots Summary</span></td>
                  <td width="80" valign="top" style="border-top:thin; border-top-style:solid; border-right:thin; border-right-style:solid">
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td height="10" style="border-bottom:inset; font-size:10px"><span class="style6">&nbsp;Doc #: RDL/</span></td>
                    </tr>
                    <tr>
                      <td height="10" style="border-bottom:inset; font-size:10px"><span class="style6">&nbsp;Rev: 00</span></td>
                    </tr>
                    
                  </table></td>
                </tr>
                <tr>
                  <td height="20" colspan="8" style="padding-left:5px; border-left:thin; border-left-style:solid; border-top:thin;  font-size:12px; border-top-style:solid; border-right:thin; border-right-style:solid"><span class="style6">Project:&nbsp;  <strong style="font-size:13px;"><?php  echo $result_project['project_name'];  ?></strong></span></td>
                </tr>
                <tr>
                  <td height="20" class="style6"  valign="middle" class="BoledText" style="color:#FFF; background-color:#666;text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
               Sr No.
                </td>
                 <td height="20" class="style6"  valign="middle" class="BoledText" style="color:#FFF; background-color:#666; text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
               Plots categories
                </td>
                 <td height="20" class="style6"  valign="middle" class="BoledText" style=" color:#FFF; background-color:#666; text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
                Open Plots
                </td>
                 <td colspan="3" height="20" class="style6"  valign="middle" class="BoledText" style="color:#FFF; background-color:#666; text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
               Reserved
                </td>
                <td height="20" class="style6"  valign="middle" class="BoledText" style="color:#FFF; background-color:#666; text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
              Total Unsold
                </td>
                <td height="20" class="style6"  valign="middle" class="BoledText" style="color:#FFF; background-color:#666; text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
               Remarks
                </td>
                </tr>
				<tr>
                <td height="20" class="style6"  valign="middle" class="BoledText" style="color:#FFF; background-color:#666; text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
             
                </td>
                  <td height="20" class="style6"  valign="middle" class="BoledText" style="color:#FFF; background-color:#666; text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
             
                </td>
                 <td height="20" class="style6"  valign="middle" class="BoledText" style="color:#FFF; background-color:#666; text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
             
                </td>
                 <td height="20" class="style6"  valign="middle" class="BoledText" style="color:#FFF; background-color:#666; text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
             HRL Reserved Plots
                </td>
                 <td height="20" class="style6"  valign="middle" class="BoledText" style="color:#FFF; background-color:#666; text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
             Against Land Plots
                </td>
                 <td height="20" class="style6"  valign="middle" class="BoledText" style="color:#FFF; background-color:#666; text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
            Villas
                </td>
                  <td height="20" class="style6"  valign="middle" class="BoledText" style="color:#FFF; background-color:#666; text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
            
                </td>
                <td height="20" class="style6"  valign="middle" class="BoledText" style="color:#FFF; background-color:#666; text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
            
                </td>
                </tr>
                
                
                
            <?php 
            $inc=0;
            	$topen1=0;
$thrlreserved1=0;
$tagainstland1=0;
$tvillas1=0;
$total1=0;
$gtotal1=0;
		  foreach($result_plots as $row1)
{ $inc++;?>
                <tr>
                  <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
            <?php echo $inc;?>
                </td>
                 <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
             <?php echo $row1['size']; if($_POST['com_res']=='Residential'){ echo'&nbsp; (Residential)';}
					if($_POST['com_res']=='Commercial'){ echo'&nbsp; (Commercial)';}
					?>
                </td><?php  $opensql  = "SELECT * from plots
	 where size2='".$row1['id']."' AND com_res='".$_POST['com_res']."' and project_id='".$_POST['project']."' and status='' and ctag=''";
	 	$openres = $connection->createCommand($opensql)->query();?>
                 <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
                <?php if(count($openres)==0){ echo'--';}else{echo count($openres);}?>
                </td><?php $resvsql  = "SELECT * from plots
	 where size2='".$row1['id']."' AND com_res='".$_POST['com_res']."' and project_id='".$_POST['project']."'  and ctag='HRL Reserved' and status=''";
	 	$resvres = $connection->createCommand($resvsql)->query();?>
                 <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
               <?php if(count($resvres)==0){echo'--';}else{echo count($resvres);}?>
                </td>
                <?php $alsql  = "SELECT * from plots
	 where size2='".$row1['id']."' AND com_res='".$_POST['com_res']."' and project_id='".$_POST['project']."'  and  `ctag` LIKE '%Against Land%' and status=''";
	 	$alres = $connection->createCommand($alsql)->query();
?>
                <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
                  <?php if(count($alres)==0){ echo'--';}else{echo count($alres);}?>
                </td><?php $villassql  = "SELECT * from plots
	 where size2='".$row1['id']."' AND com_res='".$_POST['com_res']."' and project_id='".$_POST['project']."'  and  `ctag` LIKE '%Villas%' and status=''";
	 	$villasres = $connection->createCommand($villassql)->query();?>
                <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
                <?php if(count($villasres)==0){echo'--';}else { echo count($villasres);}?>
                </td>
                <?php $total=count($openres)+count($resvres)+count($alres)+count($villasres);?>
                <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
              <?php if($total==0){echo'--';}else{echo $total;}?>
                </td>
                  <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">      
                </td>
                </tr>
                <?php 
	$topen1=$topen1+count($openres);
	$thrlreserved1=$thrlreserved1+count($resvres);
	$tagainstland1=$tagainstland1+count($alres);
	$tvillas1=$tvillas1+count($villasres);
	$gtotal1=$gtotal1+$total;
}?>
<tr>
<td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">      
       Total         </td>
       <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">      
                </td>
                <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">      
               <?php echo $topen1;?> </td>
                <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">      
                  <?php echo $thrlreserved1;?> </td>
                <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">      
                  <?php echo $tagainstland1;?> </td>
                <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">      
                 <?php echo $tvillas1;?>  </td>
                <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">      
                 <?php echo $gtotal1;?>  </td>
                <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">      
                </td>
</tr>
         </table></td>
          </tr>
      </table></td>
      </tr>
    
   
  </table>
</textarea>
<div style="text-align: left; margin-top: 1em;">
  <button type="submit">Print Report</button>
</div>
</form>
			<?php  echo'</td></tr>';}
	
*/	
	 public function actionTotal_unsold_detail()
	 { 
	 
	    if((Yii::app()->session['user_array']['per3']=='1')  || (Yii::app()->session['user_array']['per34'] == '1') || (Yii::app()->session['user_array']['id']=='68')) {
		 	  $connection = Yii::app()->db;
			
			$this->render('total_unsold_detail');
			}else{
				$this->redirect(array('user/dashboard'));
				}
			 
	 }
	  public function actionHrl_reserved_plots_detail()
	 { 
	 
	    if((Yii::app()->session['user_array']['per3']=='1')  || (Yii::app()->session['user_array']['per34'] == '1')|| (Yii::app()->session['user_array']['id']=='68')) {
		 	  $connection = Yii::app()->db;
			
			$this->render('hrl_reserved_plots_detail');
			}else{
				$this->redirect(array('user/dashboard'));
				}
			 
	 }
	  public function actionAgainst_land_plots_detail()
	 { 
	 
	    if((Yii::app()->session['user_array']['per3']=='1')  || (Yii::app()->session['user_array']['per34'] == '1')|| (Yii::app()->session['user_array']['id']=='68')) {
		 	  $connection = Yii::app()->db;
			
			$this->render('against_land_plots_detail');
			}else{
				$this->redirect(array('user/dashboard'));
				}
			 
	 }
	  public function actionReserved_villas_detail()
	 { 
	 
	    if((Yii::app()->session['user_array']['per3']=='1')  || (Yii::app()->session['user_array']['per34'] == '1')|| (Yii::app()->session['user_array']['id']=='68')) {
		 	  $connection = Yii::app()->db;
			
			$this->render('reserved_villas_detail');
			}else{
				$this->redirect(array('user/dashboard'));
				}
			 
	 }
	  public function actionNet_balance_plots_detail()
	 { 
	 
	    if((Yii::app()->session['user_array']['per3']=='1')  || (Yii::app()->session['user_array']['per34'] == '1')|| (Yii::app()->session['user_array']['id']=='68')) {
		 	  $connection = Yii::app()->db;
			
			$this->render('net_balance_plots_detail');
			}else{
				$this->redirect(array('user/dashboard'));
				}
			 
	 }
	 public function actionSearchunsoldr()
	 {
		 if ((Yii::app()->session['user_array']['per3'] == '1')  || (Yii::app()->session['user_array']['per34'] == '1') || (Yii::app()->session['user_array']['id'] == '68')) {
			 //for Pagination end
			 $connection = Yii::app()->db;

			 $sql_project = "SELECT * from projects where id=" . $_POST['project'] . "";
			 $result_project = $connection->createCommand($sql_project)->queryRow();
			 $count = 0;
			 $home = Yii::app()->request->baseUrl;
			 $check = 1;
			 $res = array();
			 $count++;
			 echo $count . ' result found';
			 $home = "";
			 $home = Yii::app()->request->baseUrl;
			 $F = '';
			 $M = '';
			 $inc = 0;
			 $open = 0;
			 $hrlreserved = 0;
			 $againstland = 0;
			 $topen = 0;
			 $thrlreserved = 0;
			 $tagainstland = 0;
			 $tvillas = 0;
			 $total = 0;
			 $gtotal = 0;
			 $op = 0;
			 $com_res = '';
			 $block = '';
			 $block = $_POST['block'];
			 if ($_POST['com_res'] == 'Residential') {
				 $com_res = 'R';
			 }
			 if ($_POST['com_res'] == 'Commercial') {
				 $com_res = 'C';
			 }
			 $sql_plots  = "SELECT * from size_cat where typee='" . $com_res . "' Order by size_cat.size_sorting";
			 $result_plots = $connection->createCommand($sql_plots)->queryAll();
			 foreach ($result_plots as $row1) {

				 $inc++;
				 echo '<tr><td>' . $inc . '</td><td>' . $row1['size'];
				 if ($_POST['com_res'] == 'Residential') {
					 echo '&nbsp; (Residential)';
				 }
				 if ($_POST['com_res'] == 'Commercial') {
					 echo '&nbsp; (Commercial)';
				 }
				 echo '</td>';
				 if(!empty($block)){
				 $opensql  = "SELECT * from plots
  where size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "' and block_id='" . $block . "' and status='' and type !='file'";
				 }else{
					$opensql  = "SELECT * from plots
  where size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "' and status='' and type !='file'";
				 }
				 $openres = $connection->createCommand($opensql)->query();
				 echo '<td style="text-align:right"><a target="_blank" href="total_unsold_detail?com_res=' . $com_res . '&size=' . $row1['id'] . '&&project_id=' . $_POST['project'] . '&&block_id=' . $_POST['block'] . '">' ;
				 if(count($openres)==0)
				 {
					 echo'';
				 }else
				 {
					 echo count($openres);
				 }
				 echo '</a></td>';
				 if(!empty($block)){
				 $resvsql  = "SELECT * from plots
  where size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "'and project_id='". $_POST['project']."'and block_id='" . $block . "'and ctag='HRL Reserved' and status='' and type !='file'";
				 }else{
					$resvsql  = "SELECT * from plots
					where size2='" . $row1['id'] ."' AND com_res='".$_POST['com_res'] ."' and project_id='" . $_POST['project'] . "'   and ctag='HRL Reserved' and status='' and type !='file'";
				 }
				 $resvres = $connection->createCommand($resvsql)->query();
				 echo '<td style="text-align:right"><a target="_blank" href="hrl_reserved_plots_detail?com_res=' . $com_res . '&size=' . $row1['id'] . '&&project_id=' . $_POST['project'] . '">';
				 if(count($resvres)==0){ echo'';}else{ echo count($resvres); }
				 echo'</a></td>';
				 if(!empty($block)){
				 $alsql  = "SELECT * from plots
  where size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "'and block_id='".$block ."' and  `ctag` LIKE '%Against Land%' and status='' and type !='file'";
				 }else{
					$alsql  = "SELECT * from plots
					where size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "'  and  `ctag` LIKE '%Against Land%' and status='' and type !='file'";
				 }
				$alres = $connection->createCommand($alsql)->query();
				 echo '<td style="text-align:right"><a target="_blank" href="against_land_plots_detail?com_res=' . $com_res . '&size=' . $row1['id'] . '&&project_id=' . $_POST['project'] . '">';
				 if(count($alres)==0){ echo'';}else{ echo count($alres); }
				 echo'</a></td>';
				 if(!empty($block)){
				$villassql  = "SELECT * from plots
  where size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='".$_POST['project']."'and block_id='".$block ."' and  `ctag` LIKE '%Villas%' and status='' and type='Villa'";
				 }else{
					$villassql  = "SELECT * from plots
  where size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "'  and  `ctag` LIKE '%Villas%' and status='' and type='Villa'";
				 }
				$villasres = $connection->createCommand($villassql)->query();
				 echo '<td style="text-align:right"><a target="_blank" href="reserved_villas_detail?com_res=' . $com_res . '&size=' . $row1['id'] . '&&project_id=' . $_POST['project'] . '">
				 ';
				 if(count($villasres)==0){ echo'';}else{ echo count($villasres); }
				 echo'</a></td>';
				 $total = count($openres) - (count($resvres) + count($alres) + count($villasres));
				 echo '<td style="text-align:right"><a target="_blank" href="net_balance_plots_detail?com_res=' . $com_res . '&size=' . $row1['id'] . '&&project_id=' . $_POST['project'] . '">';
				 if($total==0){ echo'';}else{ echo $total;}
				 echo '</a></td><td></td></tr>';
				 $topen = $topen + count($openres);
				 $thrlreserved = $thrlreserved + count($resvres);
				 $tagainstland = $tagainstland + count($alres);
				 $tvillas = $tvillas + count($villasres);
				 $gtotal = $gtotal + $total;
					 //$gtotal=($topen)-($thrlreserved)-($tagainstland)-($tvillas)
				 ;
			 }
			 echo '<tr><td>Total</td><td></td><td style="text-align:right"><strong>' . $topen . '</srong></td><td style="text-align:right"><strong>' . $thrlreserved . '</srong></td><td style="text-align:right"><strong>' . $tagainstland . '</srong></td><td style="text-align:right"><strong>' . $tvillas . '</srong></td><td style="text-align:right"><strong>' . $gtotal . '</srong></td><td></td></tr><tr><td colspan="8">';
		 } ?>
			 <form id="form" action="<?php echo Yii::app()->baseUrl; ?>/dompdf/www/pdfgenerator.php" method="post">
				 <input type="hidden" name="paper" value="a4">
				 <input type="hidden" name="orientation" value="landscape">
				 </p>
				 <textarea name="html1" style="display:none;" cols="80" rows="20">
<meta charset="utf-8">
<title></title>
<link rel="stylesheet" type="text/css" href="../views/recovery/report.css">
<style>
.table-bordered{ border:1px solid #000; border-bottom:1px solid #000;}
table{ border:0px solid;}

</style>

   <table  width="100%" border="0" cellspacing="0px" cellpadding="0px">
 <tr>
   <td style="padding:0 0 0 0; ">
	   <table width="100%" border="0" cellspacing="0" cellpadding="0">
	   <tr>
		 <td bgcolor="#FFFFFF">
			 <table width="100%" border="0" cellspacing="0" cellpadding="0">
			 <tr>
			   <td width="100" class="BoledText" style="border-left:thin; border-left-style:solid; border-top:thin; border-top-style:solid; border-right:thin; border-right-style:solid">
			   <?php echo '<img style="height:40px;"  src="' . Yii::getPathOfAlias('webroot') . '/images/logo1.png"/>'; ?>
			   </td>
			   <td colspan="6" align="center" valign="middle" style="border-top:thin; border-top-style:solid; border-right:thin; border-right-style:solid; font-size:14px;  font-weight:bold"><span class="style6">Unsold Plots Summary</span></td>
			   <td width="80" valign="top" style="border-top:thin; border-top-style:solid; border-right:thin; border-right-style:solid">
				   <table width="100%" border="0" cellspacing="0" cellpadding="0">
				 <tr>
				   <td height="10" style="border-bottom:inset; font-size:10px"><span class="style6">&nbsp;Doc #: RDL/</span></td>
				 </tr>
				 <tr>
				   <td height="10" style="border-bottom:inset; font-size:10px"><span class="style6">&nbsp;Rev: 00</span></td>
				 </tr>
			   </table></td>
			 </tr>
			 <tr>
			   <td height="20" colspan="8" style="padding-left:5px; border-left:thin; border-left-style:solid; border-top:thin;  font-size:12px; border-top-style:solid; border-right:thin; border-right-style:solid"><span class="style6">Project:&nbsp;  <strong style="font-size:13px;"><?php echo $result_project['project_name'];  ?></strong></span></td>
			 </tr>
			 <tr>
			   <td height="20" rowspan="2 class="style6"  valign="middle" class="BoledText" style="color:#FFF; background-color:#666;text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
			Sr No.
			 </td>
			  <td height="20" rowspan="2 class="style6"  valign="middle" class="BoledText" style="color:#FFF; background-color:#666; text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
			Plots categories
			 </td>
			  <td height="20" rowspan="2 class="style6"  valign="middle" class="BoledText" style=" color:#FFF; background-color:#666; text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
			 Open Plots
			 </td>
			  <td colspan="3" height="20" class="style6"  valign="middle" class="BoledText" style="color:#FFF; background-color:#666; text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
			Reserved
			 </td>
			 <td height="20" rowspan="2 class="style6"  valign="middle" class="BoledText" style="color:#FFF; background-color:#666; text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
		   Total Unsold
			 </td>
			 <td height="20" rowspan="2 class="style6"  valign="middle" class="BoledText" style="color:#FFF; background-color:#666; text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
			Remarks
			 </td>
			 </tr>
			 <tr>
			  <td height="20" class="style6"  valign="middle" class="BoledText" style="color:#FFF; background-color:#666; text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
		  HRL Reserved Plots
			 </td>
			  <td height="20" class="style6"  valign="middle" class="BoledText" style="color:#FFF; background-color:#666; text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
		  Against Land Plots
			 </td>
			  <td height="20" class="style6"  valign="middle" class="BoledText" style="color:#FFF; background-color:#666; text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
		 Villas
			 </td>
			 </tr>
		 <?php
		 $inc = 0;
		 $topen1 = 0;
		 $thrlreserved1 = 0;
		 $tagainstland1 = 0;
		 $tvillas1 = 0;
		 $total1 = 0;
		 $gtotal1 = 0;
		 foreach ($result_plots as $row1) {
			 $inc++; ?>
			 <tr>
			   <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
		 <?php echo $inc; ?>
			 </td>
			  <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
		  <?php echo $row1['size'];
			 if ($_POST['com_res'] == 'Residential') {
				 echo '&nbsp; (Residential)';
			 }
			 if ($_POST['com_res'] == 'Commercial') {
				 echo '&nbsp; (Commercial)';
			 }
			 ?>
			 </td><?php $opensql  = "SELECT * from plots
  where size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "' and status='' and type !='file'";
					 $openres = $connection->createCommand($opensql)->query(); ?>
			  <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
			 <?php if (count($openres) == 0) {
				 echo '';
			 } else {
				 echo count($openres);
			 } ?>
			 </td><?php $resvsql  = "SELECT * from plots
  where size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "'  and ctag='HRL Reserved' and status='' and type !='file'";
					 $resvres = $connection->createCommand($resvsql)->query(); ?>
			  <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
			<?php if (count($resvres) == 0) {
				 echo '';
			 } else {
				 echo count($resvres);
			 } ?>
			 </td>
			 <?php $alsql  = "SELECT * from plots
  where size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "'  and  `ctag` LIKE '%Against Land%' and status='' and type !='file'";
			 $alres = $connection->createCommand($alsql)->query();
			 ?>
			 <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
			   <?php if (count($alres) == 0) {
					 echo '';
				 } else {
					 echo count($alres);
				 } ?>
			 </td><?php $villassql  = "SELECT * from plots
  where size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "'  and  `ctag` LIKE '%Villas%' and status='' and type !='file'";
					 $villasres = $connection->createCommand($villassql)->query(); ?>
			 <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
			 <?php if (count($villasres) == 0) {
				 echo '';
			 } else {
				 echo count($villasres);
			 } ?>
			 </td>
			 <?php $total = count($openres) + count($resvres) + count($alres) + count($villasres); ?>
			 <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
		   <?php if ($total == 0) {
				 echo '';
			 } else {
				 echo $total;
			 } ?>
			 </td>
			   <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
			 </td>
			 </tr>
			 <?php
			 $topen1 = $topen1 + count($openres);
			 $thrlreserved1 = $thrlreserved1 + count($resvres);
			 $tagainstland1 = $tagainstland1 + count($alres);
			 $tvillas1 = $tvillas1 + count($villasres);
			 ///$gtotal1=$gtotal1+$total;
			 $gtotal1 = ($topen1) - ($thrlreserved1) - ($tagainstland1) - ($tvillas1);
		 } ?>
<tr>
<td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
	Total         </td>
	<td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
			 </td>
			 <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
			<?php echo $topen1; ?> </td>
			 <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
			   <?php echo $thrlreserved1; ?> </td>
			 <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
			   <?php echo $tagainstland1; ?> </td>
			 <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
			  <?php echo $tvillas1; ?>  </td>
			 <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
			  <?php echo $gtotal1; ?>  </td>
			 <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
			 </td>
</tr>
	  </table></td>
	   </tr>
   </table></td>
   </tr>


</table>
</textarea>
				 <div style="text-align: left; margin-top: 1em;">
					 <button type="submit">Print Report</button>
				 </div>
			 </form>
			 <?php echo '</td></tr>';
		 }
	 		public function actionSearchunsoldrold()
		{
			if ((Yii::app()->session['user_array']['per3'] == '1')  || (Yii::app()->session['user_array']['per34'] == '1') || (Yii::app()->session['user_array']['id'] == '68')) {
				//for Pagination end
				$connection = Yii::app()->db;

				$sql_project = "SELECT * from projects where id=" . $_POST['project'] . "";
				$result_project = $connection->createCommand($sql_project)->queryRow();



				$count = 0;

				$home = Yii::app()->request->baseUrl;
				$check = 1;
				$res = array();

				$count++;
				echo $count . ' result found';
				$home = "";
				$home = Yii::app()->request->baseUrl;
				$F = '';
				$M = '';
				$inc = 0;
				$open = 0;
				$hrlreserved = 0;
				$againstland = 0;
				$topen = 0;
				$thrlreserved = 0;
				$tagainstland = 0;
				$tvillas = 0;
				$total = 0;
				$gtotal = 0;
				$op = 0;
				$com_res = '';
				if ($_POST['com_res'] == 'Residential') {
					$com_res = 'R';
				}
				if ($_POST['com_res'] == 'Commercial') {
					$com_res = 'C';
				}
				$sql_plots  = "SELECT * from size_cat where typee='" . $com_res . "' Order by size_cat.id";
				$result_plots = $connection->createCommand($sql_plots)->queryAll();
				foreach ($result_plots as $row1) {

					$inc++;
					echo '<tr><td>' . $inc . '</td><td>' . $row1['size'];
					if ($_POST['com_res'] == 'Residential') {
						echo '&nbsp; (Residential)';
					}
					if ($_POST['com_res'] == 'Commercial') {
						echo '&nbsp; (Commercial)';
					}
					echo '</td>';
					$opensql  = "SELECT * from plots
	 where size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "' and status='' and type !='file'";
					$openres = $connection->createCommand($opensql)->query();
					echo '<td style="text-align:right"><a target="_blank" href="total_unsold_detail?com_res=' . $com_res . '&size=' . $row1['id'] . '&&project_id=' . $_POST['project'] . '">' ;
					if(count($openres)==0)
					{
					    echo'';
					}else
					{
					    echo count($openres);
					}
					echo '</a></td>';
					$resvsql  = "SELECT * from plots
	 where size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "'  and ctag='HRL Reserved' and status='' and type !='file'";
					$resvres = $connection->createCommand($resvsql)->query();
					echo '<td style="text-align:right"><a target="_blank" href="hrl_reserved_plots_detail?com_res=' . $com_res . '&size=' . $row1['id'] . '&&project_id=' . $_POST['project'] . '">';
					if(count($resvres)==0){ echo'';}else{ echo count($resvres); }
					echo'</a></td>';
					$alsql  = "SELECT * from plots
	 where size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "'  and  `ctag` LIKE '%Against Land%' and status='' and type !='file'";
					$alres = $connection->createCommand($alsql)->query();
					echo '<td style="text-align:right"><a target="_blank" href="against_land_plots_detail?com_res=' . $com_res . '&size=' . $row1['id'] . '&&project_id=' . $_POST['project'] . '">';
					if(count($alres)==0){ echo'';}else{ echo count($alres); }
					echo'</a></td>';
					$villassql  = "

SELECT * from plots
	 where size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "'  and  `ctag` LIKE '%Villas%' and status='' and type='Villa'";
					$villasres = $connection->createCommand($villassql)->query();
					echo '<td style="text-align:right"><a target="_blank" href="reserved_villas_detail?com_res=' . $com_res . '&size=' . $row1['id'] . '&&project_id=' . $_POST['project'] . '">
					';
					if(count($villasres)==0){ echo'';}else{ echo count($villasres); }
					echo'</a></td>';
					$total = count($openres) - (count($resvres) + count($alres) + count($villasres));
					echo '<td style="text-align:right"><a target="_blank" href="net_balance_plots_detail?com_res=' . $com_res . '&size=' . $row1['id'] . '&&project_id=' . $_POST['project'] . '">';
					if($total==0){ echo'';}else{ echo $total;}
					echo '</a></td><td></td></tr>';
					$topen = $topen + count($openres);
					$thrlreserved = $thrlreserved + count($resvres);
					$tagainstland = $tagainstland + count($alres);
					$tvillas = $tvillas + count($villasres);
					$gtotal = $gtotal + $total;
						//$gtotal=($topen)-($thrlreserved)-($tagainstland)-($tvillas)
					;
				}
				echo '<tr><td>Total</td><td></td><td style="text-align:right"><strong>' . $topen . '</srong></td><td style="text-align:right"><strong>' . $thrlreserved . '</srong></td><td style="text-align:right"><strong>' . $tagainstland . '</srong></td><td style="text-align:right"><strong>' . $tvillas . '</srong></td><td style="text-align:right"><strong>' . $gtotal . '</srong></td><td></td></tr><tr><td colspan="8">';
			} ?>
				<form id="form" action="<?php echo Yii::app()->baseUrl; ?>/dompdf/www/pdfgenerator.php" method="post">
					<input type="hidden" name="paper" value="a4">
					<input type="hidden" name="orientation" value="landscape">
					</p>
					<textarea name="html1" style="display:none;" cols="80" rows="20">
<meta charset="utf-8">
<title></title>
<link rel="stylesheet" type="text/css" href="../views/recovery/report.css">
<style>
.table-bordered{ border:1px solid #000; border-bottom:1px solid #000;}
table{ border:0px solid;}

</style>

  	<table  width="100%" border="0" cellspacing="0px" cellpadding="0px">
    <tr>
      <td style="padding:0 0 0 0; ">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td bgcolor="#FFFFFF">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="100" class="BoledText" style="border-left:thin; border-left-style:solid; border-top:thin; border-top-style:solid; border-right:thin; border-right-style:solid">
                  <?php echo '<img style="height:40px;"  src="' . Yii::getPathOfAlias('webroot') . '/images/logo1.png"/>'; ?>
                  </td>
                  <td colspan="6" align="center" valign="middle" style="border-top:thin; border-top-style:solid; border-right:thin; border-right-style:solid; font-size:14px;  font-weight:bold"><span class="style6">Unsold Plots Summary</span></td>
                  <td width="80" valign="top" style="border-top:thin; border-top-style:solid; border-right:thin; border-right-style:solid">
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td height="10" style="border-bottom:inset; font-size:10px"><span class="style6">&nbsp;Doc #: RDL/</span></td>
                    </tr>
                    <tr>
                      <td height="10" style="border-bottom:inset; font-size:10px"><span class="style6">&nbsp;Rev: 00</span></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td height="20" colspan="8" style="padding-left:5px; border-left:thin; border-left-style:solid; border-top:thin;  font-size:12px; border-top-style:solid; border-right:thin; border-right-style:solid"><span class="style6">Project:&nbsp;  <strong style="font-size:13px;"><?php echo $result_project['project_name'];  ?></strong></span></td>
                </tr>
                <tr>
                  <td height="20" rowspan="2 class="style6"  valign="middle" class="BoledText" style="color:#FFF; background-color:#666;text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
               Sr No.
                </td>
                 <td height="20" rowspan="2 class="style6"  valign="middle" class="BoledText" style="color:#FFF; background-color:#666; text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
               Plots categories
                </td>
                 <td height="20" rowspan="2 class="style6"  valign="middle" class="BoledText" style=" color:#FFF; background-color:#666; text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
                Open Plots
                </td>
                 <td colspan="3" height="20" class="style6"  valign="middle" class="BoledText" style="color:#FFF; background-color:#666; text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
               Reserved
                </td>
                <td height="20" rowspan="2 class="style6"  valign="middle" class="BoledText" style="color:#FFF; background-color:#666; text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
              Total Unsold
                </td>
                <td height="20" rowspan="2 class="style6"  valign="middle" class="BoledText" style="color:#FFF; background-color:#666; text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
               Remarks
                </td>
                </tr>
				<tr>
                 <td height="20" class="style6"  valign="middle" class="BoledText" style="color:#FFF; background-color:#666; text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
             HRL Reserved Plots
                </td>
                 <td height="20" class="style6"  valign="middle" class="BoledText" style="color:#FFF; background-color:#666; text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
             Against Land Plots
                </td>
                 <td height="20" class="style6"  valign="middle" class="BoledText" style="color:#FFF; background-color:#666; text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
            Villas
                </td>
                </tr>
            <?php
			$inc = 0;
			$topen1 = 0;
			$thrlreserved1 = 0;
			$tagainstland1 = 0;
			$tvillas1 = 0;
			$total1 = 0;
			$gtotal1 = 0;
			foreach ($result_plots as $row1) {
				$inc++; ?>
                <tr>
                  <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
            <?php echo $inc; ?>
                </td>
                 <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
             <?php echo $row1['size'];
				if ($_POST['com_res'] == 'Residential') {
					echo '&nbsp; (Residential)';
				}
				if ($_POST['com_res'] == 'Commercial') {
					echo '&nbsp; (Commercial)';
				}
				?>
                </td><?php $opensql  = "SELECT * from plots
	 where size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "' and status='' and type !='file'";
						$openres = $connection->createCommand($opensql)->query(); ?>
                 <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
                <?php if (count($openres) == 0) {
					echo '';
				} else {
					echo count($openres);
				} ?>
                </td><?php $resvsql  = "SELECT * from plots
	 where size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "'  and ctag='HRL Reserved' and status='' and type !='file'";
						$resvres = $connection->createCommand($resvsql)->query(); ?>
                 <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
               <?php if (count($resvres) == 0) {
					echo '';
				} else {
					echo count($resvres);
				} ?>
                </td>
                <?php $alsql  = "SELECT * from plots
	 where size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "'  and  `ctag` LIKE '%Against Land%' and status='' and type !='file'";
				$alres = $connection->createCommand($alsql)->query();
				?>
                <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
                  <?php if (count($alres) == 0) {
						echo '';
					} else {
						echo count($alres);
					} ?>
                </td><?php $villassql  = "SELECT * from plots
	 where size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "'  and  `ctag` LIKE '%Villas%' and status='' and type !='file'";
						$villasres = $connection->createCommand($villassql)->query(); ?>
                <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
                <?php if (count($villasres) == 0) {
					echo '';
				} else {
					echo count($villasres);
				} ?>
                </td>
                <?php $total = count($openres) + count($resvres) + count($alres) + count($villasres); ?>
                <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
              <?php if ($total == 0) {
					echo '';
				} else {
					echo $total;
				} ?>
                </td>
                  <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
                </td>
                </tr>
                <?php
				$topen1 = $topen1 + count($openres);
				$thrlreserved1 = $thrlreserved1 + count($resvres);
				$tagainstland1 = $tagainstland1 + count($alres);
				$tvillas1 = $tvillas1 + count($villasres);
				///$gtotal1=$gtotal1+$total;
				$gtotal1 = ($topen1) - ($thrlreserved1) - ($tagainstland1) - ($tvillas1);
			} ?>
<tr>
<td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
       Total         </td>
       <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
                </td>
                <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
               <?php echo $topen1; ?> </td>
                <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
                  <?php echo $thrlreserved1; ?> </td>
                <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
                  <?php echo $tagainstland1; ?> </td>
                <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
                 <?php echo $tvillas1; ?>  </td>
                <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
                 <?php echo $gtotal1; ?>  </td>
                <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
                </td>
</tr>
         </table></td>
          </tr>
      </table></td>
      </tr>


  </table>
</textarea>
					<div style="text-align: left; margin-top: 1em;">
						<button type="submit">Print Report</button>
					</div>
				</form>
				<?php echo '</td></tr>';
			}
			public function actionPlots_payment_insert()
			{ 
			 
					$connection = Yii::app()->db;
					$truncate="TRUNCATE TABLE plots_payment"; 
					$restruncate=$connection->createCommand($truncate);
					$restruncate->execute();
					$count=0;
					$due_percentage='';
					$received_percentage='';
					$due_amount='';
					$received_amount='';
					$discount='';
					$price='';
					$commprice='';
					$PLcharges='';				
					$sqlplots="SELECT
							plots.id,
							plots.price,
							plots.PLcharges,
							discnt.discount,
							plots.atype,
							payments.received_amount
						FROM
							plots
						INNER JOIN memberplot ON plots.id = memberplot.plot_id
						left JOIN discnt ON discnt.ms_id = memberplot.id
						INNER JOIN projects ON projects.id = plots.project_id
					
							INNER JOIN(
							SELECT
								SUM(installpayment.paidamount) AS received_amount,
								installpayment.plot_id
							FROM
								installpayment
							WHERE
								installpayment.fstatus != 'Cancelled' 
							GROUP BY
								installpayment.plot_id
						) payments
						ON
							payments.plot_id = memberplot.plot_id ";
							$result_plots = $connection->createCommand($sqlplots)->queryAll();
							//echo $sqlplots;exit;
							foreach($result_plots as $plots)
							{   								
								if(empty($plots['received_amount'])||($plots['received_amount'])==""||($plots['received_amount'])==0) { $received_amount=1; }else{ $received_amount=$plots['received_amount'];}
									if(empty($plots['price'])||($plots['price']=="") ||($plots['price']==0))
										{
											$price=1; 
										}
										else{
											$price=$plots['price']; 

											}

								if(empty($plots['discount']) || ($plots['discount']=="")||($plots['discount']==0)) { $discount=1; }else{ $discount=$plots['discount'];}
								if(empty($plots['PLcharges']) || ($plots['PLcharges']=="")||($plots['PLcharges']==0)) { $PLcharges=1; }else{ $PLcharges=$plots['PLcharges'];}
								
									$commprice=(floatval($price)-floatval($discount)+floatval($PLcharges));
									if($commprice==0){ $commprice=1;}
								

							
								
							    //$due_percentage=$plots['due_amount']/($plots['price']-$dicount)*100;
								//$due_percentage= round($plots['due_amount']*100/$commprice,2);

								 $received_percentage= round(($plots['received_amount'])*100/$commprice,2);
								
								$sqluodate="INSERT INTO plots_payment(plot_id,total_price,location_charges,discount,received_amount,received_percentage,atype,create_date) VALUES('".$plots['id']."',".$plots['price'].",'".$plots['PLcharges']."','".$plots['discount']."','".$plots['received_amount']."','".$received_percentage."','".$plots['atype']."','".date('Y-m-d h:i:s')."') "; 
								$sqlresult=$connection->createCommand($sqluodate);
								$sqlresult->execute();
								
								
							}
echo 'Successfully done';
	
				}

			public function actionPlots_payment_insert123()
			{ 
			
					$connection = Yii::app()->db;
					$truncate="TRUNCATE TABLE plots_payment"; 
					$restruncate=$connection->createCommand($truncate);
					$restruncate->execute();
					$count=0;
					$due_percentage='';
					$received_percentage='';
					$due_amount='';
					$received_amount='';
					$discount='';
					$sqlplots="SELECT
							plots.id,
							plots.price,
							plots.PLcharges,
							duepayments.due_amount,
							discnt.discount,
							payments.received_amount
						FROM
							plots
						INNER JOIN memberplot ON plots.id = memberplot.plot_id
						LEFT JOIN discnt ON memberplot.id = discnt.ms_id
						LEFT JOIN projects ON projects.id = plots.project_id
						LEFT JOIN(
							SELECT
								SUM(installpayment.dueamount) AS due_amount,
								installpayment.plot_id
							FROM
								installpayment
							WHERE
								installpayment.fstatus != 'Cancelled' AND(installpayment.due_date_temp) <=date('Y-m-d')
							GROUP BY
								installpayment.plot_id
						) duepayments
						ON
							duepayments.plot_id = memberplot.plot_id
						LEFT JOIN(
							SELECT
								SUM(installpayment.paidamount) AS received_amount,
								installpayment.plot_id
							FROM
								installpayment
							WHERE
								installpayment.fstatus != 'Cancelled' AND(installpayment.paid_date_temp) <=date('Y-m-d')
							GROUP BY
								installpayment.plot_id
						) payments
						ON
							payments.plot_id = memberplot.plot_id
						WHERE
							  plots.atype !='Against Land'
						ORDER BY
							memberplot.plotno ASC";
							$result_plots = $connection->createCommand($sqlplots)->queryAll();
							//echo $sqlplots;exit;
							
	
							foreach($result_plots as $plots)
							{   
								//$due_amount= 
								if(isset($plots['discount'])) { $dicount=$plots['discount']; }
								
								//$due_percentage=$plots['due_amount']/($plots['price']-$dicount)*100;
								$received_percentage=$plots['due_amount']/($plots['price']-$dicount)*100;
								echo $sqluodate="INSERT INTO plots_payment(plot_id,total_price,location_charges,discount,due_amount,received_amount,create_date) VALUES('".$plots['id']."',".$plots['price'].",'".$plots['PLcharges']."','".$plots['discount']."','".$plots['due_amount']."','".$plots['received_amount']."','".date('Y-m-d h:i:s')."') "; 
								//$sqlresult=$connection->createCommand($sqluodate);
								//$sqlresult->execute();
								
								
							}echo 'Successfully done';
	
				}
				public function actionSearchpaymentdue()
			{   
               
				if ((Yii::app()->session['user_array']['per3'] == '1')  || (Yii::app()->session['user_array']['per34'] == '1') || (Yii::app()->session['user_array']['id'] == '68')) {
					//for Pagination end
					$connection = Yii::app()->db;
					$project_id='';
					if(isset($_POST['project'])){ $project_id= $_POST['project']; }
					$sql_project = "SELECT * from projects where id=" . $project_id. "";
					$result_project = $connection->createCommand($sql_project)->queryRow();
					$count = 0;
					$home = Yii::app()->request->baseUrl;
					$check = 1;
					$res = array();
					$count++;
					echo $count . ' result found';
					$home = "";
					$home = Yii::app()->request->baseUrl;
					$F = '';
					$M = '';
					$inc = 0;
					$open = 0;
					$hrlreserved = 0;
					$againstland = 0;
					$grandtotal = 0;
					$thrlreserved = 0;
					$tagainstland = 0;
					$cut_date = 0;
					$total = 0;
					$total100 = 0;
					$total81to90 = 0;
					$total71to80 = 0;
					$total61to70 = 0;
					$total50to60 = 0;
					$total21to49 = 0;
					$total20 = 0;
					$totalless20 = 0;
					$op = 0;
					$com_res = '';
					$block = '';
					$and='';
					$where='';
					$and=true;
					if (!empty($_POST['create_date'])){
						$cut_date=$_POST['create_date'];
						}else{
							
							$cut_date=date('Y-m-d');
							}

					if (!empty($_POST['block'])) {
						if ($and == true) {
							$where .= " and block_id LIKE '%" . $_POST['block'] . "%'";
						} else {
							$where .= " and block_id LIKE '%" . $_POST['block'] . "%'";
						}
						$and = true;
					}
					
					
					//if(empty($_POST['block'])){$block = "1";}else{$block = $_POST['block'];}
					if ($_POST['com_res'] == 'Residential') {
						$com_res = 'R';
					}
					if ($_POST['com_res'] == 'Commercial') {
						$com_res = 'C';
					}
					$sql_plots  = "SELECT * from size_cat where typee='" . $com_res . "' Order by size_cat.size_sorting";
					$result_plots = $connection->createCommand($sql_plots)->queryAll();
					foreach ($result_plots as $row1) {
	   
						$inc++;
						echo '<tr><td>' . $inc . '</td><td>' . $row1['size'];
						if ($_POST['com_res'] == 'Residential') {
							echo '&nbsp; (Residential)';
						}
						if ($_POST['com_res'] == 'Commercial') {
							echo '&nbsp; (Commercial)';
						}
						echo '</td>';
						
						    $opensql  = "SELECT Count(plots.id) as total,plots.id as plotid from plots
		 where size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "'" . $where." and (plots.type='Plot'|| plots.type='Villa' || plots.type='file') and status !='' and( atype !='Against Land') and create_date <='".$cut_date."'";
				
						$openres = $connection->createCommand($opensql)->query();
						//print_r($openres);
						foreach($openres as $openres1){
							
							$grandtotal=$openres1['total']+$grandtotal;
						echo '<td style="text-align:right">';
					
						if(count($openres)==0){ echo'';}else{ echo $openres1['total']; }
						echo'</td>'; }
						
						$resvsql='';
						$and='';
						$res71to80='';
						
						
					     echo $resvsql  = "SELECT
						COUNT(plots.id) AS total,
						duepayments.Due_Amount
					FROM
						plots
					
					LEFT JOIN(
						SELECT
							SUM(installpayment.dueamount) AS Due_Amount,
							installpayment.plot_id
						FROM
							installpayment
						WHERE
							installpayment.fstatus != 'Cancelled' AND(installpayment.due_date_temp) <=('".$cut_date."')
						GROUP BY
							installpayment.plot_id
					) duepayments
					ON
						duepayments.plot_id = plots.id
					WHERE
					plot_id='".$openres1['plotid']."' and
					 (ROUND(Due_Amount * 100 / price, 2) >90 and ROUND(Due_Amount * 100 / price, 2) <=100)"; 
					
					    $resvres = $connection->createCommand($resvsql)->query();
					

						
						foreach($resvres as $sqldetail){
							
							$total100=$sqldetail['total']+($total100);
						echo '<td style="text-align:right">';
					
						if(count($resvres)==0){ echo'';}else{ echo $sqldetail['total']; }
						echo'</td>'; }
					//}
					
						$sql81to90  = "SELECT
						COUNT(plots.id) AS total,
						duepayments.Due_Amount
					FROM
						plots
					
					LEFT JOIN(
						SELECT
							SUM(installpayment.dueamount) AS Due_Amount,
							installpayment.plot_id
						FROM
							installpayment
						WHERE
							installpayment.fstatus != 'Cancelled' AND(installpayment.due_date_temp) <=('".$cut_date."')
						GROUP BY
							installpayment.plot_id
					) duepayments
					ON
						duepayments.plot_id = plots.id
					WHERE
					 size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "'" . $where." and (plots.type='Plot'|| plots.type='Villa' || plots.type='file') and status !='' and create_date <='".$cut_date."' and
					 (ROUND(Due_Amount * 100 / price, 2) >80 and ROUND(Due_Amount * 100 / price, 2) <=90)"; 
						
						  $res81to90 = $connection->createCommand($sql81to90)->query();
						  foreach($res81to90 as $res81to90){
							$total81to90=$res81to90['total']+$total81to90;
						  
						  echo '<td style="text-align:right">';
					  
						  if(count($res81to90)==0){ echo'';}else{ echo $res81to90['total']; } 
						  echo'</td>'; }
						
						
						
							$sql71to80  = "SELECT
							COUNT(plots.id) AS total,
							duepayments.Due_Amount
						FROM
							plots
						
						LEFT JOIN(
							SELECT
								SUM(installpayment.dueamount) AS Due_Amount,
								installpayment.plot_id
							FROM
								installpayment
							WHERE
								installpayment.fstatus != 'Cancelled' AND(installpayment.due_date_temp) <=('".$cut_date."')
							GROUP BY
								installpayment.plot_id
						) duepayments
						ON
							duepayments.plot_id = plots.id
							where size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "'" . $where." and (plots.type='Plot'|| plots.type='Villa' || plots.type='file') and status !='' and create_date <='".$cut_date."' and
						 (ROUND(Due_Amount * 100 / price, 2) >70 and ROUND(Due_Amount * 100 / price, 2) <=80)"; 
							 
							  $res71to80 = $connection->createCommand($sql71to80)->query();
							  foreach($res71to80 as $res71to80){
								$total71to80=$res71to80['total']+$total71to80;
							  
							  echo '<td style="text-align:right">';
						  
							  if(count($res71to80)==0){ echo'';}else{ echo $res71to80['total']; }
							  echo'</td>'; }
						
							
								$sql61to70  = "SELECT
								COUNT(plots.id) AS total,
								duepayments.Due_Amount
							FROM
								plots
							
							LEFT JOIN(
								SELECT
									SUM(installpayment.dueamount) AS Due_Amount,
									installpayment.plot_id
								FROM
									installpayment
								WHERE
									installpayment.fstatus != 'Cancelled' AND(installpayment.due_date_temp) <=('".$cut_date."')
								GROUP BY
									installpayment.plot_id
							) duepayments
							ON
								duepayments.plot_id = plots.id
								where size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "'" . $where." and (plots.type='Plot'|| plots.type='Villa' || plots.type='file') and status !='' and create_date <='".$cut_date."' and
							 (ROUND(Due_Amount * 100 / price, 2) >60 and ROUND(Due_Amount * 100 / price, 2) <=70)"; 
								 
								  $res61to70 = $connection->createCommand($sql61to70)->query();
								  foreach($res61to70 as $res61to70){
									  
									$total61to70=$res61to70['total']+$total61to70;
								  echo '<td style="text-align:right">';
							  
								  if(count($res61to70)==0){ echo'';}else{ echo $res61to70['total']; }
								  echo'</td>'; }
								 
									
										$sql50to60  = "SELECT
										COUNT(plots.id) AS total,
										duepayments.Due_Amount
									FROM
										plots
									
									LEFT JOIN(
										SELECT
											SUM(installpayment.dueamount) AS Due_Amount,
											installpayment.plot_id
										FROM
											installpayment
										WHERE
											installpayment.fstatus != 'Cancelled' AND(installpayment.due_date_temp) <=('".$cut_date."')
										GROUP BY
											installpayment.plot_id
									) duepayments
									ON
										duepayments.plot_id = plots.id
										where size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "'" . $where." and (plots.type='Plot'|| plots.type='Villa' || plots.type='file') and status !='' and create_date <='".$cut_date."' and
									 (ROUND(Due_Amount * 100 / price, 2) >=50 and ROUND(Due_Amount * 100 / price, 2) <=60)"; 
										
										  $res50to60 = $connection->createCommand($sql50to60)->query();
										  foreach($res50to60 as $res50to60){
											  
											$total50to60=$res50to60['total']+$total50to60;
										  echo '<td style="text-align:right">';
									  
										  if(count($res50to60)==0){ echo'';}else{ echo $res50to60['total']; }
										  echo'</td>'; }
										
											$sql21to49  = "SELECT
											COUNT(plots.id) AS total,
											duepayments.Due_Amount
										FROM
											plots
										
										LEFT JOIN(
											SELECT
												SUM(installpayment.dueamount) AS Due_Amount,
												installpayment.plot_id
											FROM
												installpayment
											WHERE
												installpayment.fstatus != 'Cancelled' AND(installpayment.due_date_temp) <=('".$cut_date."')
											GROUP BY
												installpayment.plot_id
										) duepayments
										ON
											duepayments.plot_id = plots.id
											where size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "'" . $where." and (plots.type='Plot'|| plots.type='Villa' || plots.type='file') and status !='' and create_date <='".$cut_date."' and
										 (ROUND(Due_Amount * 100 / price, 2) >20 and ROUND(Due_Amount * 100 / price, 2) <=49)"; 
											
											  $res21to49 = $connection->createCommand($sql21to49)->query();
											  foreach($res21to49 as $res21to49){
												$total21to49=$res21to49['total']+$total21to49;
											  
											  echo '<td style="text-align:right">';
										  
											  if(count($res21to49)==0){ echo'';}else{ echo $res21to49['total']; }
											  echo'</td>'; }
											
												$sql20  =" SELECT
												COUNT(plots.id) AS total,
												duepayments.Due_Amount
											FROM
												plots
											
											LEFT JOIN(
												SELECT
													SUM(installpayment.dueamount) AS Due_Amount,
													installpayment.plot_id
												FROM
													installpayment
												WHERE
													installpayment.fstatus != 'Cancelled' AND(installpayment.due_date_temp) <=('".$cut_date."')
												GROUP BY
													installpayment.plot_id
											) duepayments
											ON
												duepayments.plot_id = plots.id
											WHERE
											plot_id='".$openres1['plotid']."' and
											 (ROUND(Due_Amount * 100 / price, 2)=20)"; 
												
												  $res20 = $connection->createCommand($sql20)->query();
												  foreach($res20 as $res20){
													  
													$total20=$res20['total']+$total20;
												  echo '<td style="text-align:right">';
											  
												  if(count($res20)==0){ echo'';}else{ echo $res20['total']; }
												  echo'</td>'; }
												
													 $sqlless20  = "SELECT
											COUNT(plots.id) AS total,
											duepayments.Due_Amount
										FROM
											plots
										
										LEFT JOIN(
											SELECT
												SUM(installpayment.dueamount) AS Due_Amount,
												installpayment.plot_id
											FROM
												installpayment
											WHERE
												installpayment.fstatus != 'Cancelled' AND(installpayment.due_date_temp) <=('".$cut_date."')
											GROUP BY
												installpayment.plot_id
										) duepayments
										ON
											duepayments.plot_id = plots.id
										WHERE
										plot_id='".$openres1['plotid']."' and( ROUND(Due_Amount * 100 / price, 2) <20) AND(plots.atype != 'Against Land') AND(plots.atype != 'FOC')"; 
													 
													  $resless20 = $connection->createCommand($sqlless20)->query();
													  foreach($resless20 as $resless20){
														$totalless20=$resless20['total']+$totalless20;
													  
													  echo '<td style="text-align:right">';
												  
													  if(count($resless20)==0){ echo'';}else{ echo $resless20['total']; }
													  echo'</td>'; }
													  //$grandtotal=count($openres);
						
					}
					echo '<tr><td></td><td><strong>Total</strong></td><td style="text-align:right"><strong>'.($grandtotal).'</srong></td><td style="text-align:right"><strong>'.$total100.'</srong></td><td style="text-align:right"><strong>'.$total81to90.'</srong></td><td style="text-align:right"><strong>'.$total71to80.'</srong></td><td style="text-align:right"><strong>'.$total61to70.'</srong></td><td style="text-align:right"><strong>'.$total50to60.'</srong></td><td style="text-align:right"><strong>'.$total21to49.'</srong></td><td style="text-align:right"><strong>'.$total20.'</srong></td><td style="text-align:right"><strong>'.$totalless20.'</srong></td></tr><tr><td colspan="8">';
				}
			}
			public function actionSearchpayment()
			{   
               
				if ((Yii::app()->session['user_array']['per3'] == '1')  || (Yii::app()->session['user_array']['per34'] == '1') || (Yii::app()->session['user_array']['id'] == '68')) {
					//for Pagination end
					$connection = Yii::app()->db;
					$project_id='';
					if(isset($_POST['project'])){ $project_id= $_POST['project']; }
					$sql_project = "SELECT * from projects where id=" . $project_id. "";
					$result_project = $connection->createCommand($sql_project)->queryRow();
					$count = 0;
					$home = Yii::app()->request->baseUrl;
					$check = 1;
					$res = array();
					$count++;
					echo $count . ' result found';
					$home = "";
					$home = Yii::app()->request->baseUrl;
					$F = '';
					$M = '';
					$inc = 0;
					$open = 0;
					$hrlreserved = 0;
					$againstland = 0;
					$grandtotal = 0;
					$grandtotal1 = 0;
					$thrlreserved = 0;
					$tagainstland = 0;
					$cut_date = 0;
					$total = 0;
					$total100 = 0;
					$total81to90 = 0;
					$total71to80 = 0;
					$total61to70 = 0;
					$total50to60 = 0;
					$total21to49 = 0;
					$total20 = 0;
					$totalless20 = 0;
					$total1001 = 0;
					$total81to901 = 0;
					$total71to801 = 0;
					$total61to701 = 0;
					$total50to601 = 0;
					$total21to491 = 0;
					$total201 = 0;
					$totalless201 = 0;
					$op = 0;
					$com_res = '';
					$block = '';
					$and='';
					$where='';
					$and=true;
					if (!empty($_POST['create_date'])){
						$cut_date=$_POST['create_date'];
						}else{
							
							$cut_date=date('Y-m-d');
							}

					if (!empty($_POST['block'])) {
						if ($and == true) {
							$where .= " and block_id LIKE '%" . $_POST['block'] . "%'";
						} else {
							$where .= " and block_id LIKE '%" . $_POST['block'] . "%'";
						}
						$and = true;
					}
					
					 if (!empty($_POST['atype'])) {
						$atype = '';
						if ($_POST['atype'] == "AL") {
							if ($and == true) {
								$where .= " and plots.atype NOT LIKE '%Against Land%'";
							} else {
								$where .= "plots.atype NOT LIKE '%Against Land%'";
							}
						}
						if ($_POST['atype'] == "FOC") {
							if ($and == true) {
								$where .= " and plots.atype NOT LIKE '%FOC%'";
							} else {
								$where .= " plots.atype NOT LIKE '%FOC%'";
							}
						}
						if ($_POST['atype'] == "All") {
							if ($and == true) {
								$where .= " and plots.id !=''";
							} else {
								$where .= " plots.id !=''";
							}
						}
			
						$and = true;
					}
					//if(empty($_POST['block'])){$block = "1";}else{$block = $_POST['block'];}
					if ($_POST['com_res'] == 'Residential') {
						$com_res = 'R';
					}
					if ($_POST['com_res'] == 'Commercial') {
						$com_res = 'C';
					}
					$sql_plots  = "SELECT * from size_cat where typee='" . $com_res . "' Order by size_cat.size_sorting";
					$result_plots = $connection->createCommand($sql_plots)->queryAll();
					foreach ($result_plots as $row1) {
	   
						$inc++;
						echo '<tr><td>' . $inc . '</td><td>' . $row1['size'];
						if ($_POST['com_res'] == 'Residential') {
							echo '&nbsp; (Residential)';
						}
						if ($_POST['com_res'] == 'Commercial') {
							echo '&nbsp; (Commercial)';
						}
						echo '</td>';
						
						    $opensql  = "SELECT Count(plots.id) as total from plots
		 where size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "'" . $where." and (plots.type='Plot'|| plots.type='Villa' || plots.type='file') and status !=''";
				
						$openres = $connection->createCommand($opensql)->queryAll();
						foreach($openres as $openres1){
							
							$grandtotal=$openres1['total']+$grandtotal;
						echo '<td style="text-align:right">';
					
						if(count($openres)==0){ echo'';}else{ echo $openres1['total']; }
						echo'</td>'; }
						
						$resvsql='';
						$and='';
						$res71to80='';
						
						
					     $resvsql  = "SELECT count(plots.id) as total,received_percentage,plots_payment.atype  FROM `plots_payment` 
					  left JOIN plots on plots.id=plots_payment.plot_id where   size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "'" . $where." and (plots.type='Plot'|| plots.type='Villa' || plots.type='file') and (received_percentage> 90 AND received_percentage
							 <= 150)"; 					
					   $resvres = $connection->createCommand($resvsql)->query();
						 $focsql  = "SELECT count(plots_payment.id) as foc,plots_payment.atype  FROM `plots_payment` 
						left JOIN plots on plots.id=plots_payment.plot_id where   size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "'" . $where." and (plots.type='Plot'|| plots.type='Villa' || plots.type='file') and plots_payment.atype='FOC'"; 
						 $resfoc = $connection->createCommand($focsql)->queryRow();

						  $alsql  = "SELECT count(plots_payment.id) as al,plots_payment.atype  FROM `plots_payment` 
						  left JOIN plots on plots.id=plots_payment.plot_id where   size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "'" . $where." and (plots.type='Plot'|| plots.type='Villa' || plots.type='file') and plots_payment.atype='Against Land'"; 
							 
							 $resal = $connection->createCommand($alsql)->queryRow();
						foreach($resvres as $sqldetail){
							
						//	$total100=$sqldetail['total']+($total100+$resfoc['foc']+$resal['al']);
						$total100=$sqldetail['total']+($total100);
						echo '<td style="text-align:right">';
					
						if(count($resvres)==0){ echo'';}else{ echo $sqldetail['total']+$resal['al']; }
						echo'</td>'; }
					//}
					
						  $sql81to90  = "SELECT count(plots.id) as total,received_percentage,plots_payment.atype,plots.price  FROM `plots_payment` 
						left JOIN plots on plots.id=plots_payment.plot_id where   size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "'" . $where." and (plots.type='Plot'|| plots.type='Villa' || plots.type='file') and (received_percentage> 80 AND received_percentage
							   <= 90)"; 
						
						  $res81to90 = $connection->createCommand($sql81to90)->query();
						  foreach($res81to90 as $res81to90){
							$total81to90=$res81to90['total']+$total81to90;
						  
						  echo '<td style="text-align:right">';
					  
						  if(count($res81to90)==0){ echo'';}else{ echo $res81to90['total']; }
						  echo'</td>'; }
						
						
						
							 $sql71to80  = "SELECT count(plots.id) as total,received_percentage,plots_payment.atype,plots.price  FROM `plots_payment` 
							left JOIN plots on plots.id=plots_payment.plot_id where   size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "'" . $where." and (plots.type='Plot'|| plots.type='Villa' || plots.type='file') and (received_percentage> 70 AND received_percentage
								   <= 80)"; 
							 
							  $res71to80 = $connection->createCommand($sql71to80)->query();
							  foreach($res71to80 as $res71to80){
								$total71to80=$res71to80['total']+$total71to80;
							  
							  echo '<td style="text-align:right">';
						  
							  if(count($res71to80)==0){ echo'';}else{ echo $res71to80['total']; }
							  echo'</td>'; }
						
							
								$sql61to70  = "SELECT count(plots.id) as total,received_percentage,plots_payment.atype,plots.price  FROM `plots_payment` 
								left JOIN plots on plots.id=plots_payment.plot_id where   size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "'" . $where." and (plots.type='Plot'|| plots.type='Villa' || plots.type='file') and (received_percentage> 60 AND received_percentage
									   <= 70)"; 
								 
								  $res61to70 = $connection->createCommand($sql61to70)->query();
								  foreach($res61to70 as $res61to70){
									  
									$total61to70=$res61to70['total']+$total61to70;
								  echo '<td style="text-align:right">';
							  
								  if(count($res61to70)==0){ echo'';}else{ echo $res61to70['total']; }
								  echo'</td>'; }
								 
									
										$sql50to60  = "SELECT count(plots.id) as total,received_percentage,plots_payment.atype,plots.price  FROM `plots_payment`
										left JOIN plots on plots.id=plots_payment.plot_id where   size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "'" . $where." and (plots.type='Plot'|| plots.type='Villa' || plots.type='file') and received_percentage>= 50 AND received_percentage
											   <= 60"; 
										
										  $res50to60 = $connection->createCommand($sql50to60)->query();
										  foreach($res50to60 as $res50to60){
											  
											$total50to60=$res50to60['total']+$total50to60;
										  echo '<td style="text-align:right">';
									  
										  if(count($res50to60)==0){ echo'';}else{ echo $res50to60['total']; }
										  echo'</td>'; }
										
											$sql21to49  = "SELECT count(plots.id) as total,received_percentage,plots_payment.atype,plots.price  FROM `plots_payment` 
											left JOIN plots on plots.id=plots_payment.plot_id where   size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "'" . $where." and (plots.type='Plot'|| plots.type='Villa' || plots.type='file') and received_percentage>= 21 AND received_percentage
												   <= 49"; 
											
											  $res21to49 = $connection->createCommand($sql21to49)->query();
											  foreach($res21to49 as $res21to49){
												$total21to49=$res21to49['total']+$total21to49;
											  
											  echo '<td style="text-align:right">';
										  
											  if(count($res21to49)==0){ echo'';}else{ echo $res21to49['total']; }
											  echo'</td>'; }
											
												$sql20  = "SELECT count(plots.id) as total,received_percentage,plots_payment.atype,plots.price  FROM `plots_payment` 
												left JOIN plots on plots.id=plots_payment.plot_id where   size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "'" . $where." and (plots.type='Plot'|| plots.type='Villa' || plots.type='file') and received_percentage= 20"; 
												
												  $res20 = $connection->createCommand($sql20)->query();
												  foreach($res20 as $res20){
													  
													$total20=$res20['total']+$total20;
												  echo '<td style="text-align:right">';
											  
												  if(count($res20)==0){ echo'';}else{ echo $res20['total']; }
												  echo'</td>'; }
												
													 $sqlless20  = "SELECT count(plots.id) as total,plots.atype,received_percentage,plots.price  FROM `plots_payment` 
													left JOIN plots on plots.id=plots_payment.plot_id where   size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "'" . $where." and (plots.type='Plot'|| plots.type='Villa' || plots.type='file') and received_percentage < 20 AND(
        plots.atype != 'Against Land') AND (plots.atype != 'FOC')"; 
													 
													  $resless20 = $connection->createCommand($sqlless20)->query();
													  foreach($resless20 as $resless20){
														$totalless20=$resless20['total']+$totalless20;
													  
													  echo '<td style="text-align:right">';
												  
													  if(count($resless20)==0){ echo'';}else{ echo $resless20['total']; }
													  echo'</td>'; }
													  //$grandtotal=count($openres);
						
					}
					echo '<tr><td></td><td><strong>Total</strong></td><td style="text-align:right"><strong>'.($grandtotal).'</srong></td><td style="text-align:right"><strong>'.$total100.'</srong></td><td style="text-align:right"><strong>'.$total81to90.'</srong></td><td style="text-align:right"><strong>'.$total71to80.'</srong></td><td style="text-align:right"><strong>'.$total61to70.'</srong></td><td style="text-align:right"><strong>'.$total50to60.'</srong></td><td style="text-align:right"><strong>'.$total21to49.'</srong></td><td style="text-align:right"><strong>'.$total20.'</srong></td><td style="text-align:right"><strong>'.$totalless20.'</srong></td></tr>
					<tr><td colspan="11">';?>
					     <form id="form" action="<?php echo Yii::app()->baseUrl; ?>/dompdf/www/pdfgenerator.php" method="post">
				 <input type="hidden" name="paper" value="a4">
				 <input type="hidden" name="orientation" value="landscape">
				 </p>
         <textarea name="html1" style="display:none;" cols="80" rows="20">
<meta charset="utf-8">

<style>
table{ border:1px solid;border-collapse: collapse;}
.td{border:1px solid;}
</style>
<table width="100%" height="700px" class="table">
     <tr style="height:150px">
       <td class="td" width="20%"  align="left"><?php echo '<img style="height:40px;"  src="'.Yii::getPathOfAlias('webroot').'/images/ro.png"/>'; ?>
       </td>
        <td class="td" width="60%"   align="center">Percentage Wise Payment
       </td>
        <td class="td" width="20%"  align="right"><?php echo '<img style="height:40px;"  src="'.Yii::getPathOfAlias('webroot').'/images/logo.png"/>'; ?>
       </td>
     </tr>
    
      <tr style="height:180px;">
     <td  colspan="1" class="td">Project Name</td>
      <td colspan="2" class="td"><?php echo $result_project['project_name'];?></td>
     </tr>
       
    
</table>
     
<table width="100%" height="700px" class="table">

<tr>

<td class="td"  rowspan="2" width="5%" style="text-align:center">S.No</td>
<td class="td" rowspan="2" width="15%" style="text-align:center">Plot Categories</td>
<td class="td" rowspan="2" style="text-align:center">Total</td>
<td class="td" colspan="8" style="text-align:center">Booking by Paid %age </td>
</tr>
<tr>
<td class="td" style="text-align:center">(91-100%)</td>
<td class="td" style="text-align:center">(81-90%)</td>
<td class="td" style="text-align:center">(71-80%)</td>
<td class="td" style="text-align:center">(61-70%)</td>
<td class="td" style="text-align:center">(50-60%)</td>
<td class="td" style="text-align:center">(21-49%)</td>
<td class="td" style="text-align:center">(20%)</td>
<td class="td" style="text-align:center">(Less 20%)</td>
</tr>
<?php 
					$sql_plots  = "SELECT * from size_cat where typee='" . $com_res . "' Order by size_cat.size_sorting";
					$result_plots = $connection->createCommand($sql_plots)->queryAll();
					foreach ($result_plots as $row1) {
	   
						$inc++;
						echo '<tr><td class="td">' . $inc . '</td><td class="td">' . $row1['size'];
						if ($_POST['com_res'] == 'Residential') {
							echo '&nbsp; (Residential)';
						}
						if ($_POST['com_res'] == 'Commercial') {
							echo '&nbsp; (Commercial)';
						}
						echo '</td>';
						$open  = "SELECT Count(plots.id) as total from plots
		 where size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and (plots.type='Plot'|| plots.type='Villa' || plots.type='file') and status !='' and project_id='" . $_POST['project'] . "'" . $where."";
				
						$res = $connection->createCommand($open)->query();
						  
						foreach($res as $res){
							
							$grandtotal1=$res['total']+$grandtotal1;
						echo '<td class="td" style="text-align:right">';
					
						if(count($res)==0){ echo'';}else{ echo $res['total']; }
						echo'</td>'; }
						
						$resvsql='';
						$and='';
						$res71to80='';
						
						
					     $resvsql  = "SELECT count(plots.id) as total,received_percentage,plots_payment.atype  FROM `plots_payment` 
					  left JOIN plots on plots.id=plots_payment.plot_id where   size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "'" . $where." and (plots.type='Plot'|| plots.type='Villa' || plots.type='file') and (received_percentage> 90 AND received_percentage
							 <= 150)"; 					
					   $resvres = $connection->createCommand($resvsql)->query();
						 $focsql  = "SELECT count(plots_payment.id) as foc,plots_payment.atype  FROM `plots_payment` 
						left JOIN plots on plots.id=plots_payment.plot_id where   size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "'" . $where." and (plots.type='Plot'|| plots.type='Villa' || plots.type='file') and plots_payment.atype='FOC'"; 
						 $resfoc = $connection->createCommand($focsql)->queryRow();

						  $alsql  = "SELECT count(plots_payment.id) as al,plots_payment.atype  FROM `plots_payment` 
						  left JOIN plots on plots.id=plots_payment.plot_id where   size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "'" . $where." and (plots.type='Plot'|| plots.type='Villa' || plots.type='file') and plots_payment.atype='Against Land'"; 
							 
							 $resal = $connection->createCommand($alsql)->queryRow();
						foreach($resvres as $sqldetail){
							
						//	$total100=$sqldetail['total']+($total100+$resfoc['foc']+$resal['al']);
						$total1001=$sqldetail['total']+($total1001);
						echo '<td class="td" style="text-align:right">';
					
						if(count($resvres)==0){ echo'';}else{ echo $sqldetail['total']+$resal['al']; }
						echo'</td>'; }
					//}
					
						  $sql81to90  = "SELECT count(plots.id) as total,received_percentage,plots_payment.atype,plots.price  FROM `plots_payment` 
						left JOIN plots on plots.id=plots_payment.plot_id where   size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "'" . $where." and (plots.type='Plot'|| plots.type='Villa' || plots.type='file') and (received_percentage> 80 AND received_percentage
							   <= 90)"; 
						
						  $res81to90 = $connection->createCommand($sql81to90)->query();
						  foreach($res81to90 as $res81to90){
							$total81to901=$res81to90['total']+$total81to901;
						  
						  echo '<td class="td" style="text-align:right">';
					  
						  if(count($res81to90)==0){ echo'';}else{ echo $res81to90['total']; }
						  echo'</td>'; }
						
						
						
							 $sql71to80  = "SELECT count(plots.id) as total,received_percentage,plots_payment.atype,plots.price  FROM `plots_payment` 
							left JOIN plots on plots.id=plots_payment.plot_id where   size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "'" . $where." and (plots.type='Plot'|| plots.type='Villa' || plots.type='file') and (received_percentage> 70 AND received_percentage
								   <= 80)"; 
							 
							  $res71to80 = $connection->createCommand($sql71to80)->query();
							  foreach($res71to80 as $res71to80){
								$total71to801=$res71to80['total']+$total71to801;
							  
							  echo '<td class="td" style="text-align:right">';
						  
							  if(count($res71to80)==0){ echo'';}else{ echo $res71to80['total']; }
							  echo'</td>'; }
						
							
								$sql61to70  = "SELECT count(plots.id) as total,received_percentage,plots_payment.atype,plots.price  FROM `plots_payment` 
								left JOIN plots on plots.id=plots_payment.plot_id where   size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "'" . $where." and (plots.type='Plot'|| plots.type='Villa' || plots.type='file') and (received_percentage> 60 AND received_percentage
									   <= 70)"; 
								 
								  $res61to70 = $connection->createCommand($sql61to70)->query();
								  foreach($res61to70 as $res61to70){
									  
									$total61to701=$res61to70['total']+$total61to701;
								  echo '<td class="td" style="text-align:right">';
							  
								  if(count($res61to70)==0){ echo'';}else{ echo $res61to70['total']; }
								  echo'</td>'; }
								 
									
										$sql50to60  = "SELECT count(plots.id) as total,received_percentage,plots_payment.atype,plots.price  FROM `plots_payment`
										left JOIN plots on plots.id=plots_payment.plot_id where   size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "'" . $where." and (plots.type='Plot'|| plots.type='Villa' || plots.type='file') and received_percentage>= 50 AND received_percentage
											   <= 60"; 
										
										  $res50to60 = $connection->createCommand($sql50to60)->query();
										  foreach($res50to60 as $res50to60){
											  
											$total50to601=$res50to60['total']+$total50to601;
										  echo '<td class="td" style="text-align:right">';
									  
										  if(count($res50to60)==0){ echo'';}else{ echo $res50to60['total']; }
										  echo'</td>'; }
										
											$sql21to49  = "SELECT count(plots.id) as total,received_percentage,plots_payment.atype,plots.price  FROM `plots_payment` 
											left JOIN plots on plots.id=plots_payment.plot_id where   size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "'" . $where." and (plots.type='Plot'|| plots.type='Villa' || plots.type='file') and received_percentage>= 21 AND received_percentage
												   <= 49"; 
											
											  $res21to49 = $connection->createCommand($sql21to49)->query();
											  foreach($res21to49 as $res21to49){
												$total21to491=$res21to49['total']+$total21to491;
											  
											  echo '<td class="td" style="text-align:right">';
										  
											  if(count($res21to49)==0){ echo'';}else{ echo $res21to49['total']; }
											  echo'</td>'; }
											
												$sql20  = "SELECT count(plots.id) as total,received_percentage,plots_payment.atype,plots.price  FROM `plots_payment` 
												left JOIN plots on plots.id=plots_payment.plot_id where   size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "'" . $where." and (plots.type='Plot'|| plots.type='Villa' || plots.type='file') and received_percentage= 20"; 
												
												  $res20 = $connection->createCommand($sql20)->query();
												  foreach($res20 as $res20){
													  
													$total201=$res20['total']+$total201;
												  echo '<td class="td" style="text-align:right">';
											  
												  if(count($res20)==0){ echo'';}else{ echo $res20['total']; }
												  echo'</td>'; }
												
													 $sqlless20  = "SELECT count(plots.id) as total,plots.atype,received_percentage,plots.price  FROM `plots_payment` 
													left JOIN plots on plots.id=plots_payment.plot_id where   size2='" . $row1['id'] . "' AND com_res='" . $_POST['com_res'] . "' and project_id='" . $_POST['project'] . "'" . $where." and (plots.type='Plot'|| plots.type='Villa' || plots.type='file') and received_percentage < 20 AND(
        plots.atype != 'Against Land') AND (plots.atype != 'FOC')"; 
													 
													  $resless20 = $connection->createCommand($sqlless20)->query();
													  foreach($resless20 as $resless20){
														$totalless201=$resless20['total']+$totalless201;
													  
													  echo '<td class="td" style="text-align:right">';
												  
													  if(count($resless20)==0){ echo'';}else{ echo $resless20['total']; }
													  echo'</td>'; }
													  //$grandtotal=count($openres);
						
					}
					echo '<tr><td class="td"></td><td class="td"><strong>Total</strong></td><td class="td" style="text-align:right"><strong>'.($grandtotal1).'</srong></td><td class="td" style="text-align:right"><strong>'.$total1001.'</srong></td><td class="td" style="text-align:right"><strong>'.$total81to901.'</srong></td><td class="td" style="text-align:right"><strong>'.$total71to801.'</srong></td><td class="td" style="text-align:right"><strong>'.$total61to701.'</srong></td><td class="td" style="text-align:right"><strong>'.$total50to601.'</srong></td><td class="td" style="text-align:right"><strong>'.$total21to491.'</srong></td><td class="td" style="text-align:right"><strong>'.$total201.'</srong></td><td class="td" style="text-align:right"><strong>'.$totalless201.'</srong></td></tr>';?>


    
     </table>
<?php ?>
<table width="100%" height="700px" class="table">

</textarea>
				 <div style="text-align: left; margin-top: 1em;">
					 <button type="submit">Print Report</button>
				 </div>
			 </form>
					
					<?php echo'</td>';
				}
			}
			public function actionPercentage_payment(){
				if(isset(Yii::app()->session['user_array']['username']))
		{	
		$connection = Yii::app()->db;
		$temp_projects_array = Yii::app()->session['projects_array'];
		$num_of_projects_counter = count($temp_projects_array);
		$num_of_projects_counter2 = $num_of_projects_counter;
		$sql1 =   "select * from projects where";
		$num_of_projects_counter--;
		while($num_of_projects_counter>-1)
		{
		$sql2[$num_of_projects_counter] = " id=".Yii::app()->session['projects_array'][$num_of_projects_counter]['project_id'];
		$num_of_projects_counter--;
		}
		$sql_project = $sql1;
		$sql_project = $sql_project.implode(' or',$sql2);
		$result_projects = $connection->createCommand($sql_project)->queryAll() or mysql_error();
		//$sql_project = "SELECT * from projects";
		//$result_project = $connection->createCommand($sql_project)->query();
		$sql_categories  = "SELECT * from categories";
		$categories = $connection->createCommand($sql_categories)->query();
		$sql_size  = "SELECT * from size_cat";
		$sizes = $connection->createCommand($sql_size)->query();
		$sql_sector ="SELECT * FROM sectors";
		$result_sector = $connection->createCommand($sql_sector)->query();
		$sql_com_res ="SELECT DISTINCT com_res FROM plots";
		$result_com_res = $connection->createCommand($sql_com_res)->query();
		$home=Yii::app()->request->baseUrl;
		$this->render('percentage_payment',array('projects'=>$result_projects,'sectors'=>$result_sector,'categories'=>$categories,'sizes'=>$sizes,'com_res'=>$result_com_res));
		}else{
		$this->redirect(array('user/dashboard'));
		}
			
			}
			public function actionUnsold_Residential(){
		if(isset(Yii::app()->session['user_array']['username']))
{

$connection = Yii::app()->db;
$temp_projects_array = Yii::app()->session['projects_array'];
$num_of_projects_counter = count($temp_projects_array);
$num_of_projects_counter2 = $num_of_projects_counter;
$sql1 =   "select * from projects where";
$num_of_projects_counter--;
while($num_of_projects_counter>-1)
{
$sql2[$num_of_projects_counter] = " id=".Yii::app()->session['projects_array'][$num_of_projects_counter]['project_id'];
$num_of_projects_counter--;
}

$sql_project = $sql1;
$sql_project = $sql_project.implode(' or',$sql2);


$result_projects = $connection->createCommand($sql_project)->query() or mysql_error();


//$sql_project = "SELECT * from projects";
//$result_project = $connection->createCommand($sql_project)->query();


$sql_categories  = "SELECT * from categories";
$categories = $connection->createCommand($sql_categories)->query();
$sql_size  = "SELECT * from size_cat";
$sizes = $connection->createCommand($sql_size)->query();
$sql_sector ="SELECT * FROM sectors";
$result_sector = $connection->createCommand($sql_sector)->query();

$sql_com_res ="SELECT DISTINCT com_res FROM plots";
$result_com_res = $connection->createCommand($sql_com_res)->query();

$home=Yii::app()->request->baseUrl;

$this->render('unsold_residential',array('projects'=>$result_projects,'sectors'=>$result_sector,'categories'=>$categories,'sizes'=>$sizes,'com_res'=>$result_com_res));
}else{
$this->redirect(array('user/dashboard'));
}
	
	}


/////////END:SUMMARY OF UNSOLD RESIDENTIAL PLOTS////////   
    
    
    
    
    	public function actionPlots_report()
{
if((Yii::app()->session['user_array']['per2']=='1')&& isset(Yii::app()->session['user_array']['username']))
{

		if((Yii::app()->session['user_array']['per2']=='1')&& isset(Yii::app()->session['user_array']['username'])||(Yii::app()->session['user_array']['per34']=='1'))
					{
					$plotno='';
					$st='';
					$pro='';
					$com_res='';
					$sector='';
					$size='';
					$cat='';
					$where='';
					$and = false;
					$where='';
		if (!empty($_POST['status'])){
							if($_POST['status']=='Alloted'){
					$where.="plots.status ='".$_POST['status']."'";
					$and = true;
							}
					}
				if (isset($_POST['rstatus'])){
					$where.="plots.rstatus LIKE '%".$_POST['rstatus']."%'";
					$and = true;
					}
						
					if (isset($_POST['sector']) && $_POST['sector']!=""){
						$where.="plots.sector LIKE '%".$_POST['sector']."%'";
						$and = true;
						$sector=$_POST['sector'];
					}
					
					if (isset($_POST['com_res']) && $_POST['com_res']!=""){
						$where.="plots.com_res LIKE '%".$_POST['com_res']."%'";
						$and = true;
						$sector=$_POST['com_res'];
					}
					if ($and==true)
						{
							$where.="  and type='plot' ";
						}
						else
						{
							$where.="type='plot' ";
						}
						$and=true;
					
					
					
					if (isset($_POST['plotno']) && $_POST['plotno']!=""){
						$plotno=$_POST['plotno'];
						if ($and==true)
						{
							$where.=" and plots.plot_detail_address LIKE '%".$_POST['plotno']."%'";
						}
						else
						{
							$where.=" plots.plot_detail_address LIKE '%".$_POST['plotno']."%'";
						}
						$and=true;
					}
						if (isset($_POST['size']) && $_POST['size']!=""){
						$size=$_POST['size'];
						if ($and==true)
						{
							$where.=" and plots.size2 LIKE '%".$_POST['size']."%'";
						}
						else
						{
							$where.=" plots.size2 LIKE '%".$_POST['size']."%'";
						}
						$and=true;
					}
									if ( isset($_POST['project_id']) &&  $_POST['project_id']!=""){
						$pro=$_POST['project_id'];
						if ($and==true)
						{
							$where.=" and plots.project_id LIKE '%".$_POST['project_id']."%'";
						}
						else
						{
							$where.=" plots.project_id LIKE '%".$_POST['project_id']."%'";
						}
						$and=true;
					}
					
					
					if (isset($_POST['street_id']) && $_POST['street_id']!=""){
						$st=$_POST['street_id'];
						if ($and==true)
						{
							$where.=" and plots.street_id LIKE '%".$_POST['street_id']."%'";
						}
						else
						{
							$where.=" plots.street_id LIKE '%".$_POST['street_id']."%'";
						}
						$and=true;
					}
					
					
					
					
				
			$connection = Yii::app()->db;
		$sql_member = "SELECT
		plots.id
		, plots.street_id
		, plots.project_id
		, plots.plot_size
		, plots.com_res
			, plots.size2
		, plots.rstatus
			, plots.sector
			, plots.category_id
			, plots.status
			, plots.plot_detail_address
			, memberplot.plotno
		, projects.project_name
			, streets.street
			
		FROM
		plots
		Left JOIN streets  ON (plots.street_id = streets.id)
			Left JOIN projects  ON (plots.project_id = projects.id)
			Left JOIN memberplot  ON (plots.id = memberplot.plot_id)
		where $where ORDER BY `plot_detail_address` ASC, `street` ASC, `sector` ASC";
				$result_members = $connection->createCommand($sql_member)->query();
		$connection = Yii::app()->db;
				$temp_projects_array = Yii::app()->session['projects_array'];
					$num_of_projects_counter = count($temp_projects_array);
				$num_of_projects_counter2 = $num_of_projects_counter;
				$sql1 =   "select * from projects where";
				$num_of_projects_counter--;
				while($num_of_projects_counter>-1)
				{
					$sql2[$num_of_projects_counter] = " id=".Yii::app()->session['projects_array'][$num_of_projects_counter]['project_id'];
					$num_of_projects_counter--;
				}
				
				$sql_project = $sql1;
				$sql_project = $sql_project.implode(' or',$sql2);
				
				
				$result_projects = $connection->createCommand($sql_project)->query() or mysql_error();
				
				
				//$sql_project = "SELECT * from projects";
				//$result_project = $connection->createCommand($sql_project)->query();
			
				
				$sql_categories  = "SELECT * from categories";
				$categories = $connection->createCommand($sql_categories)->query();
				$sql_size  = "SELECT * from size_cat";
				$sizes = $connection->createCommand($sql_size)->query();
			$sql_sector ="SELECT * FROM sectors";
				$result_sector = $connection->createCommand($sql_sector)->query();
				
			$sql_com_res ="SELECT DISTINCT com_res FROM plots";
				$result_com_res = $connection->createCommand($sql_com_res)->query();
				
				$home=Yii::app()->request->baseUrl;
					
			$this->render('plots_report',array('members'=>$result_members,'projects'=>$result_projects,'sectors'=>$result_sector,'pro'=>$pro,'st'=>$st,'sector'=>$sector,'plotno'=>$plotno,'categories'=>$categories,'sizes'=>$sizes,'com_res'=>$result_com_res));
			}else{
				$this->redirect(array('user/dashboard'));
				}
			
	
		
}else{
$this->redirect(array('user/dashboard'));
}


}
		public function actionSearchreport()
		{
			
if((Yii::app()->session['user_array']['per3']=='1')  || (Yii::app()->session['user_array']['per34'] == '1')) {
		$where="plots.type='plot'";
$and=true;
if (!empty($_POST['project'])){
if($and==true)
{
$where.=" AND plots.project_id LIKE '%".$_POST['project']."%'";
}
else
{
$where.="  plots.project_id LIKE '%".$_POST['project']."%'";
}
$and=true;
}
if (isset($_POST['sector']) && $_POST['sector']!="")
{				
$where.=" and plots.sector ='".$_POST['sector']."'";
				$and = true;
				$sector=$_POST['sector'];
}
if (isset($_POST['com_res']) && $_POST['com_res']!=""){
$where.="and plots.com_res LIKE '%".$_POST['com_res']."%'";
$and = true;
$com_res=$_POST['com_res'];
}
			if (!empty($_POST['plotno'])){
if ($and==true)
{
$where.=" and plots.plot_detail_address ='".$_POST['plotno']."'";
}
else
{
$where.="plots.plot_detail_address='".$_POST['plotno']."'";
}
$and==true;
}
if (isset($_POST['plotno1']) && $_POST['plotno1']!=""){
				$plotno=$_POST['plotno1'];
				if ($and==true)
				{
					$where.=" and memberplot.plotno  Like '%".$_POST['plotno1']."%'";
				}
				else
				{
					$where.=" memberplot.plotno Like '%".$_POST['plotno1']."%'";
				}
				$and=true;
			}
			if (isset($_POST['size']) && $_POST['size']!=""){
				$plotno=$_POST['size'];
				if ($and==true)
				{
					$where.=" and plots.size2 LIKE '%".$_POST['size']."%'";
				}
				else
				{
					$where.=" plots.size2 LIKE '%".$_POST['size']."%'";
				}
				$and=true;
			}
if (isset($_POST['ctag']) && $_POST['ctag']!=""){
				
				if ($and==true)
				{
					$where.=" and plots.ctag LIKE '%".$_POST['ctag']."%'";
				}
				else
				{
					$where.=" plots.ctag LIKE '%".$_POST['ctag']."%'";
				}
				$and=true;
			}
			$catt='';
			$extra1='';
			if (isset($_POST['cat']) && $_POST['cat']!=""){
			$aa=0;
				$extra1="Left JOIN cat_plot  ON (plots.id = cat_plot.plot_id)";
				foreach($_POST['cat'] as $ass){if($aa==1){$catt.',';} $catt=$ass;$aa++; };
				if ($and==true)
				{
					$where.=" and cat_plot.cat_id IN (".$catt.")";
				}
				else
				{
					$where.=" cat_plot.cat_id IN (".$catt.")";
				}
				$and=true;
			}
			if (!empty($_POST['allotmentstatus'])){
if($_POST['allotmentstatus']==1){ $where.=" and mp.status='Approved'";}
if($_POST['allotmentstatus']==2){ $where.=" and mp.status!='Approved' and mp.fstatus!='Approved'";}
if($_POST['allotmentstatus']==4){if ($and==true)
{
$where.=" and mp.mstatus=2";
}
else
{
$where.=" mp.mstatus=0";
}

}
}
			if (!empty($_POST['stat'])){
			if($_POST['stat']==1){$where.="and plots.rstatus ='reallocated'";}
			if($_POST['stat']==2){$where.="and plots.status ='Alotted'";}
			if($_POST['stat']==3){$where.="and plots.status =''";}
			if($_POST['stat']==4){$where.="and plots.bstatus ='reserved'";}
							$and = true;
			}
			if (isset($_POST['street_id']) && $_POST['street_id']!=""){
				$st=$_POST['street_id'];
				if ($and==true)
				{
					$where.=" and plots.street_id='".$_POST['street_id']."'";
				}
				else
				{
					$where.=" plots.street_id='".$_POST['street_id']."'";
				}
				$and=true;
			}

			$connection = Yii::app()->db;
$sql_member = "SELECT
plots.id
, plots.street_id
, plots.plot_size
, plots.project_id
, plots.com_res
	, plots.size2
, plots.rstatus
	, plots.sector
	, plots.category_id
	, plots.status
, plots.ctag
	, memberplot.fstatus
	, plots.bstatus
	, plots.plot_detail_address
	, memberplot.plotno
, projects.project_name
	, streets.street

	, size_cat.size
	, size_cat.typee
	,sector_name
FROM
plots
Left JOIN streets  ON (plots.street_id = streets.id)
	".$extra1."
	Left JOIN projects  ON (plots.project_id = projects.id)
	Left JOIN sectors  ON (plots.sector = sectors.id)
	Left JOIN memberplot  ON (plots.id = memberplot.plot_id)
	Left JOIN size_cat  ON (size_cat.id = plots.size2)
where $where ";
$result_members = $connection->createCommand($sql_member)->queryAll();
$sql_project = "SELECT * from projects";
		$result_project = $connection->createCommand($sql_project)->query();		
		$count=0;
	if ($result_members!=''){
		$home=Yii::app()->request->baseUrl;
$check=1;
$res=array();
foreach($result_members as $key){
$count++;
echo $count.' result found';
$home="";
$home=Yii::app()->request->baseUrl;
$F='';
$M='';
echo '<tr><td>'.$key['plotno'].'</td><td>'.$key['project_name'].'</td><td>'.$key['size'].'</td><td>'.$key['plot_size'].'</td><td>'.$key['com_res'].'</td><td><a href="'.$home.'/index.php/user/plothistory?id='.$key['id'].'">'.$key['plot_detail_address'].'</a></td><td>'.$key['street'].'</td><td>'.$key['sector_name'].'</td>
<td>';
	
		if($key['status']=='Alotted'){echo'Alotted';}
		if($key['status']==''){echo'Not Alotted';}
			if($key['bstatus']=='reserved'){echo'Reserved';}
			
			if($key['ctag']!='')
			{
				echo ' &nbsp;('.$key['ctag'].')';
			}
echo'</td>';
echo '<td>';
		if($key['status']==''){
		echo'<a href="'.$home.'/index.php/memberplot/allotplot?id='.$key['id'].'&&pro='.$key['project_id'].'">' ."Allot".'</a>';
		}elseif($key['status']=='Requested'){if(!empty($key['fstatus'])){$M='M';}else{$F='F'; } echo'<a href="'.$home.'/index.php/memberplot/requested_detail?id='.$key['id'].'">' ."Requested".'('.$M.$F.')'.'</a>';
}else{ echo $key['status'];}echo '</td>
<td>'.$key['bstatus'].'</td>';
if((Yii::app()->session['user_array']['per1']=='1')||(Yii::app()->session['user_array']['per34']!='1'))
{
echo '<td><div class="dropdown">
		<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
		Dropdown
		<span class="caret"></span>
		</button>
		<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
				<li role="presentation"><a href="updateplot?id='.$key['id'].'&&project_id='.$key['project_id'].'">Edit</a></li>
				<li role="presentation"><a href="reallocate?id='.$key['id'].'">Reallocate</a></li>';
				if($key['status']=='')
				{
				echo '<li role="presentation">
						<a href="#" onclick="deletethis('.$key['id'].','.$key['project_id'].')">Delete</a></li>';}
						echo '<li role="presentation"><a target="_blank" href="'.$home.'/fileupload/index.php?id='.$key['id'].'">Upload Docs</a></li></td>';}else echo'<td></td>';
				'</tr>';
				}
				echo'<tr><td>';?>
	
				<form id="form" action="<?php echo Yii::app()->baseUrl; ?>/dompdf/www/pdfgenerator.php" method="post">
<input type="hidden" name="paper" value="a4">
<input type="hidden" name="orientation" value="landscape">
</p>
<textarea name="html1" style="display:none;" cols="60" rows="20">

<title></title>
<style>
	td{ padding:0px;  border-top:1px solid #000; border-left:1px solid #000;}
.table-bordered{ border-right:1px solid #000; border-bottom:1px solid #000;}
</style>
<html>
<body>
<table  class="table table-striped table-new table-bordered">
<tr>  <th><img src="<?php echo Yii::getPathOfAlias('webroot')."/images/royal_orchard.jpg";  ?>"  width="270px">
   </th></tr><tr><th><?php echo $key['project_name'];?> Plots</th></tr>
  <tr style="background:#666; border-color:#ccc; color:#fff; ">
           
            <th><b>Plot Size </b></th> 
              <th><b>Type </b></th>
                <th><b>Plot No </b></th>
             <th><b>Street</b></th>
              <th><b>Sector</b></th>
              <th><b>Status </b></th>
                <th><b>MS No. </b></th>
  </tr>
  <?php 
  		$srn=0;

  foreach($result_members as $key){ 
$srn++;
$home="";
$home=Yii::app()->request->baseUrl;
$F='';
$M='';
echo '<tr><td>'.$key['size'].'</td><td  >'.$key['com_res'].'</td>
<td><a href="'.$home.'/index.php/user/plothistory?id='.$key['id'].'">'.$key['plot_detail_address'].'</a></td>
<td >'.$key['street'].'</td>
<td>'.$key['sector_name'].'</td>
<td>';	
		if($key['status']=='Alotted'){echo'Alotted';}
		if($key['status']==''){echo'Not Alotted';}
			if($key['bstatus']=='reserved'){echo'Reserved';} 
			if($key['ctag']!='')
			{
				echo  '('.$key['ctag'].')';
			}
echo'</td><td  >'.$key['plotno'].'</td>';
				'</tr>';
				}
  
  ?>

</table>
</body>
</html>
    
</textarea>
<div style="text-align: left; margin-top: 1em;">
  <button type="submit">Print Report</button>
</div>
</form>
				<?php echo'</td></tr>';
				
				
		}?>
		
		
		<?php
		
			
			
					}
			}
    
    
    
    
    public function actionTrans_det_rptc(){
	$this->render('trans_det_rptc');
	}
public function actionTrans_det_rpt(){
	
	$this->render('trans_det_rpt');
	}
 public function actionAjaxRequest123($val1)
	{	
		$connection = Yii::app()->db;  
		$connection = Yii::app()->db;  
		if($val1=='C'||$val1=='R')
		  $sql_city  = "SELECT * from size_cat where typee='".$val1."'";
		else 
		  $sql_city  = "SELECT * from size_cat";
		 $result_city = $connection->createCommand($sql_city)->query();
		$city=array();
		foreach($result_city as $cit){
			$city[]=$cit;
	
		    
		} 
	echo json_encode($city); exit();
	}
	
function actionGenpdf()

	{ if (!empty($_POST['submit'])){

exit;

    //require_once();

    include Yii::app()->baseUrl."/dompdf/dompdf_config.inc.php";

	$stream=TRUE;

    $dompdf = new DOMPDF();

	$html=$_POST['html'];

	//echo $html;exit;

	$filename='PDF File';

    $dompdf->set_paper('letter','landscape');

	$dompdf->load_html($html);

    $dompdf->render();

	$dompdf->set_base_path(realpath(APPLICATION_PATH . 'styles.css'));

    if ($stream) {

        $dompdf->stream($filename.".pdf");

    } else {

        return $dompdf->output();

    }

}}

	



	/**



	 * Creates a new model.



	 * If creation is successful, the browser will be redirected to the 'view' page.



	 */

public function actionSearchreq()
		{
			
if((Yii::app()->session['user_array']['per3']=='1')  || (Yii::app()->session['user_array']['per34'] == '1')) {
		//$where="plots.type='plot'";
        //  $and=true;
        $where='';
        $and=''; 
        if (!empty($_POST['type']))
			{
				$where .= "plots.type LIKE '%" . $_POST['type'] . "%'";
				$and = true;
			}
		else
			{
				$where .= "plots.type !='file'";
				$and = true;
			}
        if (!empty($_POST['project'])){
        if($and==true)
        {
        $where.="AND plots.project_id =".$_POST['project']."";
        }
        else
        {
        $where.="plots.project_id=".$_POST['project']."";
        }
        $and=true;
        }
if (isset($_POST['sector']) && $_POST['sector']!="")
{				
$where.=" and plots.sector ='".$_POST['sector']."'";
				$and = true;
				$sector=$_POST['sector'];
}
if (isset($_POST['com_res']) && $_POST['com_res']!=""){

if($_POST['com_res']=='R'){
	$comres="Residential";
}
if($_POST['com_res']=='C'){
	$comres="Commercial";
}
$where.=" and plots.com_res LIKE '%".$comres."%'";
$and = true;
$com_res=$_POST['com_res'];


}

                if (!empty($_POST['plotno'])){
				if ($and==true)
				{
					$where.=" and memberplot.plotno Like '%".$_POST['procode']."-".$_POST['plotno']."%'";
				}
				else
				{
					$where.="memberplot.plotno Like '%".$_POST['procode']."-".$_POST['plotno']."%'";
				}
				$and==true;
			    }
 
		    	if (isset($_POST['plot_detail_address']) && $_POST['plot_detail_address']!=""){
				$plot_detail_address=$_POST['plot_detail_address'];
				if ($and==true)
				{
					  $where.=" and plots.plot_detail_address ='".$_POST['plot_detail_address']."'";
				}
				else
				{

					$where.=" plots.plot_detail_address ='".$_POST['plot_detail_address']."'";
				}
				$and=true;
				}
			if (isset($_POST['size']) && $_POST['size']!=""){
				$plotno=$_POST['size'];
				if ($and==true)
				{
					$where.=" and plots.size2=".$_POST['size']."";
				}
				else
				{
					$where.=" plots.size2 =".$_POST['size']."";
				}
				$and=true;
			}
if (isset($_POST['ctag']) && $_POST['ctag']!=""){
				
				if ($and==true)
				{
					$where.=" and plots.ctag ='".$_POST['ctag']."'";
				}
				else
				{
					$where.=" plots.ctag ='".$_POST['ctag']."'";
				}
				$and=true;
			}
			$catt='';
			$extra1='';
			if (isset($_POST['cat']) && $_POST['cat']!=""){
			$aa=0;
				$extra1="Left JOIN cat_plot  ON (plots.id = cat_plot.plot_id)";
				foreach($_POST['cat'] as $ass){if($aa==1){$catt.',';} $catt=$ass;$aa++; };
				if ($and==true)
				{
					$where.=" and cat_plot.cat_id IN (".$catt.")";
				}
				else
				{
					$where.=" cat_plot.cat_id IN (".$catt.")";
				}
				$and=true;
			}
			if (!empty($_POST['allotmentstatus'])){
if($_POST['allotmentstatus']==1){ $where.=" and mp.status='Approved'";}
if($_POST['allotmentstatus']==2){ $where.=" and mp.status!='Approved' and mp.fstatus!='Approved'";}
if($_POST['allotmentstatus']==4){if ($and==true)
{
$where.=" and mp.mstatus=2";
}
else
{
$where.=" mp.mstatus=0";
}

}
}
			if (!empty($_POST['stat'])){
			if($_POST['stat']==1){$where.=" and plots.rstatus ='reallocated'";}
			if($_POST['stat']==2){$where.=" and plots.status ='Alotted'";}
			if($_POST['stat']==3){$where.=" and plots.status ='' and plots.ctag=''";}
			if($_POST['stat']==4){$where.=" and plots.status ='' and plots.ctag !=''";}
			if($_POST['stat']==5){$where.=" and plots.status ='' and plots.ctag =''";}
			if($_POST['stat']==6){$where.=" and plots.status ='Requested(T)'";}
			if($_POST['stat']==7){$where.=" and plots.status ='Requested'";}
							$and = true;
			}
			if (isset($_POST['onpayments']) && isset($_POST['al']) && isset($_POST['foc']))
			{ 
				$where.=" AND (plots.atype='On Payment'|| plots.atype='Against Land' || plots.atype='FOC')";
			}
			elseif (isset($_POST['onpayments']) && isset($_POST['al']))
			{ 
				$where.=" AND (plots.atype='On Payment'|| plots.atype='Against Land')";
			}
			
			elseif (isset($_POST['onpayments'])  && isset($_POST['foc']))
			{ 
				$where.=" AND (plots.atype='On Payment'|| plots.atype='FOC')";
			}
			elseif (isset($_POST['al'])  && isset($_POST['foc']))
			{ 
				$where.=" AND (plots.atype='Against Land'|| plots.atype='FOC')";
			}
			elseif (isset($_POST['al']) && empty($_POST['foc']) && empty($_POST['onpayments']))
			{ 
				$where.=" AND (plots.atype='Against Land')";
			}
			elseif (isset($_POST['foc']) && empty($_POST['al']) && empty($_POST['onpayments']))
			{ 
				$where.=" AND (plots.atype='FOC')";
			}
			elseif (isset($_POST['onpayments']) && empty($_POST['foc']) && empty($_POST['al']))
			{ 
				$where.=" AND (plots.atype='On Payment')";
			}
			
			if (isset($_POST['street_id']) && $_POST['street_id']!=""){
				$st=$_POST['street_id'];
				if ($and==true)
				{
					$where.=" and plots.street_id='".$_POST['street_id']."'";
				}
				else
				{
					$where.=" plots.street_id='".$_POST['street_id']."'";
				}
				$and=true;
			}
//for Pagination
if(isset($_POST['limit']) && $_POST['limit']!==''){$limit = $_POST['limit'];}else{
$limit = 15;}
$adjacent = 15;
$page = $_REQUEST['page'];
if($page==1){
$start = 0;
}
else{
$start = ($page-1)*$limit;
}
$connection = Yii::app()->db;
  $sql_memberas = "SELECT * FROM plots
Left JOIN streets  ON (plots.street_id = streets.id)
".$extra1."
Left JOIN sectors  ON (plots.sector = sectors.id)
	Left JOIN projects  ON (plots.project_id = projects.id)
	Left JOIN memberplot  ON (plots.id = memberplot.plot_id)
	Left JOIN size_cat  ON (plots.size2 = size_cat.id)
where $where ";
$co = $connection->createCommand($sql_memberas)->queryAll();
		$rows =count($co);
			//for Pagination end
			$connection = Yii::app()->db;
   $sql_member = "SELECT
plots.id
,plots.atype
, plots.street_id
, plots.plot_size
, plots.project_id
, plots.com_res
	, plots.size2
, plots.rstatus
	, plots.sector
	, plots.category_id
	, plots.status
, plots.ctag
	, memberplot.fstatus
	, plots.bstatus
	, plots.plot_detail_address
	, memberplot.plotno
, projects.project_name
	, streets.street
	, size_cat.size
	, size_cat.typee
	,sector_name
FROM
plots
Left JOIN streets  ON (plots.street_id = streets.id)
	".$extra1."
	Left JOIN projects  ON (plots.project_id = projects.id)
	Left JOIN sectors  ON (plots.sector = sectors.id)
	Left JOIN memberplot  ON (plots.id = memberplot.plot_id)
	Left JOIN size_cat  ON (size_cat.id = plots.size2)
where $where ORDER BY plots.plot_detail_address ASC limit $start,$limit";
//echo $sql_member;exit;
$result_members = $connection->createCommand($sql_member)->queryAll();
$sql_project = "SELECT * from projects";
		$result_project = $connection->createCommand($sql_project)->query();
		
		
	
	$count=0;
	if ($result_members!=''){
		$home=Yii::app()->request->baseUrl;
$check=1;
$res=array();
foreach($result_members as $key){
$count++;

echo $count.' result found';
$home="";
$home=Yii::app()->request->baseUrl;
$F='';
$M='';
echo '<tr><td>'.$key['plotno'].'</td><td>'.$key['project_name'].'</td><td>'.$key['size'].'</td><td>'.$key['plot_size'].'</td><td>'.$key['com_res'].'</td><td><a href="'.$home.'/index.php/user/plothistory?id='.$key['id'].'">'.$key['plot_detail_address'].'</a></td><td>'.$key['street'].'</td><td>'.$key['sector_name'].'</td>

<td>';
	
		if($key['status']=='Alotted'){echo'Alotted';}
		if($key['status']==''){echo'Not Alotted';}
			if($key['bstatus']=='reserved'){echo'Reserved';}
			
echo'('.$key['ctag'].')</td>';
echo '<td>';
		if($key['status']==''){
		echo'<a href="'.$home.'/index.php/memberplot/allotplot?id='.$key['id'].'&&pro='.$key['project_id'].'">' ."Allot".'</a>';
		}elseif($key['status']=='Requested'){if(!empty($key['fstatus'])){$M='M';}else{$F='F'; } echo'<a href="'.$home.'/index.php/memberplot/requested_detail?id='.$key['id'].'">' ."Requested".'('.$M.$F.')'.'</a>';
}else{ echo $key['status'];}echo '</td>
<td>'.$key['bstatus'].'</td><td>'.$key['atype'].'</td>';
if((Yii::app()->session['user_array']['per1']=='1')||(Yii::app()->session['user_array']['per34']!='1'))
{
echo '<td><div class="dropdown">
		<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
		Dropdown
		<span class="caret"></span>
		</button>
		<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
				<li role="presentation"><a href="updateplot?id='.$key['id'].'&&project_id='.$key['project_id'].'">Edit</a></li>
				<li role="presentation"><a href="reallocate?id='.$key['id'].'">Reallocate</a></li>';
				if($key['status']=='')
				{
				echo '<li role="presentation">
						<a href="#" onclick="deletethis('.$key['id'].','.$key['project_id'].')">Delete</a></li>';}
						echo '<li role="presentation"><a target="_blank" href="'.$home.'/fileupload/index.php?id='.$key['id'].'">Upload Docs</a></li></td>';}else echo'<td></td>';
				'</tr>';
				}
				
				
				
		}
			echo'<tr><td>';?>
	
				<form id="form" action="<?php echo Yii::app()->baseUrl; ?>/dompdf/www/pdfgenerator.php" method="post">
<input type="hidden" name="paper" value="a4">
<input type="hidden" name="orientation" value="landscape">
</p>
<textarea name="html1" style="display:none;" cols="60" rows="20">

<title></title>
<style>
	td{ padding:0px;  border-top:1px solid #000; border-left:1px solid #000;}
.table-bordered{ border-right:1px solid #000; border-bottom:1px solid #000;}
</style>
<html>
<body>
<table  class="table table-striped table-new table-bordered">
<tr>  <th><img src="<?php echo Yii::getPathOfAlias('webroot')."/images/royal_orchard.jpg";  ?>"  width="270px">
   </th></tr><tr><th><?php  echo $key['project_name'];?> Plots</th></tr>
  <tr style="background:#666; border-color:#ccc; color:#fff; ">
       
         
            <th style="width:100px"><b>Plot Size </b></th> 
              <th style="width:100px"><b>Type </b></th>
                <th style="width:100px"><b>Plot No </b></th>
             <th style="width:100px"><b>Street</b></th>
              <th style="width:100px"><b>Sector</b></th>
              <th style="width:100px"><b>Status </b></th>
               <th style="width:100px"><b>MS No. </b></th>
  </tr>
  <?php 
  		

  foreach($result_members as $key){
$count++;
$home="";
$home=Yii::app()->request->baseUrl;
$F='';
$M='';
echo '<tr><td>'.$key['size'].'</td><td>'.$key['com_res'].'</td>
<td><a href="'.$home.'/index.php/user/plothistory?id='.$key['id'].'">'.$key['plot_detail_address'].'</a></td>
<td>'.$key['street'].'</td>
<td>'.$key['sector_name'].'</td>
<td>';	
		if($key['status']=='Alotted'){echo'Alotted';}
		if($key['status']==''){echo'Not Alotted';}
			if($key['bstatus']=='reserved'){echo'Reserved';} 
			if($key['ctag']!='')
			{
				echo  '('.$key['ctag'].')';
			}
echo'</td><td>'.$key['plotno'].'</td>';
				'</tr>';
				}
  
  ?>

</table>
</body>
</html>
    
</textarea>
<div style="text-align: left; margin-top: 1em;">
  <button type="submit">Print Report</button>
</div>
</form>
				<?php echo'</td></tr>';
		
		
		?>
		
		<script>
		function deletethis(id,idd){
				var x = confirm("Are you sure you want to delete?");
		
		if(x == true){
		window.location="deleteplot?id=" + id + "&&did=" + idd + "";
		}
		if(x == false){return false;}
		}
		
		</script>
		<?php
		// for pagination
		$pagination='';
	if ($page == 0) $page = 1;					//if no page var is given, default to 1.
	$prev = $page - 1;							//previous page is page - 1
		$next = $page + 1;							//next page is page + 1
			$prev_='';
			$first='';
				$lastpage = ceil($rows/$limit);
			$next_='';
			$last='';
			$adjacents=$adjacent;
			if($lastpage > 1)
					{	if ($page > 1)
					$prev_.= "<a class='page-numbers' href=\"?page=$prev\">previous</a>";
						else{	}
						if ($lastpage < 5 + ($adjacents * 2))	//not enough pages to bother breaking it up
					{
				$first='';
					for ($counter = 1; $counter <= $lastpage; $counter++)
					{
						if ($counter == $page)
							$pagination.= "<span class=\"current\">$counter</span>";
						else
												$pagination.= "<a class='page-numbers' href=\"?page=$counter\">$counter</a>";
					}
					$last='';
				}
						elseif($lastpage > 3 + ($adjacents * 2))	//enough pages to hide some
				{
					$first='';
							if($page < 1 + ($adjacents * 2))
					{
						for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
						{
							if ($counter == $page)
								$pagination.= "<span class=\"current\">$counter</span>";
							else
													$pagination.= "<a class='page-numbers' href=\"?page=$counter\">$counter</a>";
						}
								$last.= "<a class='page-numbers' href=\"?page=$lastpage\">Last</a>";
					}
					elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
					{
					$first.= "<a class='page-numbers' href=\"?page=1\">First</a>";
					for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
						{
							if ($counter == $page)
								$pagination.= "<span class=\"current\">$counter</span>";
							else
													$pagination.= "<a class='page-numbers' href=\"?page=$counter\">$counter</a>";
						}
									$last.= "<a class='page-numbers' href=\"?page=$lastpage\">Last</a>";
					}
					else
					{
						$first.= "<a class='page-numbers' href=\"?page=1\">First</a>";
						for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
						{
							if ($counter == $page)
								$pagination.= "<span class=\"current\">$counter</span>";
							else
													$pagination.= "<a class='page-numbers' href=\"?page=$counter\">$counter</a>";
						}
						$last='';
					}
			}
				if ($page < $counter - 1)
					$next_.= "<a class='page-numbers' href=\"?page=$next\">next</a>";
				else{
					}
				$pagination = "<div class=\"pagination\">".$first.$prev_.$pagination.$next_.$last;
						$pagination.= "</div>\n";
			}
		echo '<tr  ><td colspan="12"><b style="color:#08c">Total Records Found :&nbsp;&nbsp;'.$rows.'</b></td></tr>';
			echo '<tr><td colspan="12">'.$pagination.'</td></tr>'; exit;
			// for pagination END
			exit;
			echo $count.' result found' ;exit;
			if(isset($_POST['username']) && empty($_POST['username']))
					{
						$error = 'Please enter username<br>';
					}
					if(isset($_POST['password']) && empty($_POST['password']))
					{
						$error .= 'Please enter Password<br>';
					}
					if(empty($error))
					{
						$username = $_POST['username'];
						$password = md5($_POST['password']);
						$connection = Yii::app()->db;
						$sql = "SELECT * FROM user where username ='".$username."' AND  password='".$password."' AND status=1";
						$result_data = $connection->createCommand($sql)->queryRow();
						if($result_data)
						{
								Yii::app()->session['user_array'] = $result_data;
								echo 1;exit();
						}else
						{
							echo "Invalid Username and Password";
						}
					}else
					{
						echo $error;
					}
				exit;
			
					}
			}
public function actionCreate()



	{ 

	      $connection = Yii::app()->db;  
	         $error =array();
	         $ctag='';
			if(isset($_POST['project_id']) && empty($_POST['project_id']))

			{

         	$error = 'Please Select Plot Project<br>';

			}
            if (isset($_POST['type']) && empty($_POST['type'])) {
					$error .= 'Please Select Property Type<br>';
				}
			if(isset($_POST['street_id']) && empty($_POST['street_id']))
			{
				$error .= 'Please Select Plot Street<br>';
			}
			if(isset($_POST['price']) && empty($_POST['price']))

			{

				$error .= 'Please Enter Plot Price<br>';

			}
             if(isset($_POST['size2']) && empty($_POST['size2']))
			{
				$error .= 'Please Enter Plot Size<br>';

			}
			if(isset($_POST['plot_detail_address']) && empty($_POST['plot_detail_address']))

			{
				$error .= 'Please Enter Plot No<br>';


			}

			if(isset($_POST['com_res']) && empty($_POST['com_res']))

			{
				$error .= 'Please Select Type<br>';

			}

				if(isset($_POST['sector']) && empty($_POST['sector']))

			{

				$error .= 'Please Select Sector<br>';

			}

				if(isset($_POST['noi']) && empty($_POST['noi']))

			{
				$error .= 'Please Enter No.Of Installment<br>';

			}

				if(isset($_POST['plot_size']) && empty($_POST['plot_size']))

			{
				$error .= 'Please Enter Plot Diemension<br>';

			}

				if(isset($_POST['cstatus']) && empty($_POST['cstatus']))

			{

				$error .= 'Please Select Status<br>';

			}
            if(!empty($_POST['type']) && $_POST['type']=='Villa'){ $ctag='Villas';}else{ $ctag='';}
			 $sq  = "SELECT * from plots where project_id='".$_POST['project_id']."' AND sector='".$_POST['sector']."' AND street_id='".$_POST['street_id']."' AND com_res='".$_POST['com_res']."' AND plot_detail_address='".$_POST['plot_detail_address']."'";
			 $result_sq = $connection->createCommand($sq)->queryAll();
			 $count=0;
			 $re=array();
			 foreach($result_sq as $key1){$count=$count+1;}
			if($count!=0)
			 { $error="A Plot/Villa Is Already Added On This Address Please Enter Another Plot Address  ";}
			  if(empty($error))
			{

$corg1='';
$corg2='';
if(isset($_POST['corg'])){$corg1=',"'.$_POST['corg'].'"';$corg2=',shap_id';}

         $sql  = 'INSERT INTO plots 
(type,project_id,street_id, plot_detail_address, plot_size, size2,price,create_date, com_res,sector,cstatus,bstatus '.$corg2.',ctag)
               	    	  VALUES ( "'.$_POST['type'].'","'.$_POST['project_id'].'", "'.$_POST['street_id'].'", "'.$_POST['plot_detail_address'].'", "'.$_POST['plot_size'].'", "'.$_POST['size2'].'", "'.$_POST['price'].'", "'.date('Y-m-d h:i:s').'" ,"'.$_POST['com_res'].'","'.$_POST['sector'].'"
,"'.$_POST['cstatus'].'","open" '.$corg1.',"'.$ctag.'")';	

               $command = $connection -> createCommand($sql);
			   $command -> execute();
			   $last_insert_id = Yii::app()->db->getLastInsertID();
			   //Adding  to Database
		 $num_of_category = 'SELECT count(id) as num_of_category from categories';
		 $num_of_category = $connection->createCommand($num_of_category)->queryAll();
		$res=array();
		foreach($num_of_category as $num_of_category)
		{
			$num_of_category = 	$num_of_category['num_of_category'];

		}
		while ($num_of_category>0)
		{
			if (isset($_POST[$num_of_category]))
				{			 
					$cat_id = $_POST[$num_of_category]; 
					$connection = Yii::app()->db;
					$add_project_per_query = "insert into cat_plot 
												set plot_id='".$last_insert_id."',cat_id='".$cat_id."' ";
					$command = $connection -> createCommand($add_project_per_query);
					$command -> execute();
				}
			$num_of_category--;
		}

	          	echo $note="New Record Inserted Successfully";
				echo '<a target="_blank" href="upload_image?id='.$last_insert_id.'"><input type="button" class="btn-info" value="Add Image">';

	}


	else{

		echo $error;
		}



		



		}

		public function actionUpload_image()



	{



		if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))



		{ 



		$this->layout='//layouts/back';



		$this->render('upload_image');



		}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/user"); }

	}

public function actionPlotimage()



{		$connection = Yii::app()->db;  

		if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))

				{ 

				 $id= $_POST['id'];

				

           

				$time_rand = time();



				$target_path="images/plots/";



				$target_path = $target_path.$time_rand.$_FILES['image']['name'];



				$ad=explode('.',$_FILES['image']['name']); 



				$rnd=sizeof($ad);



				$ads=$rnd-1;



			     move_uploaded_file($_FILES['image']['tmp_name'], $target_path);

				 $sql="UPDATE plots SET image='".$time_rand.$_FILES['image']['name']."' WHERE id=$id ";

				$command = $connection -> createCommand($sql);

			    $command -> execute();



			    $this->redirect('plots_lis'); 

 		}	



	



}





public function actionUpdateplot()
	{
		if(Yii::app()->session['user_array']['per3']=='1')
			{
			$connection = Yii::app()->db;

			 $sql_plots = "SELECT 
    plots.id,
	plots.street_id,
	plots.shap_id,
	plots.plot_size,
	plots.com_res,
	plots.isvilla,
	plots.price
	, plots.cstatus
	 , plots.size2
    , plots.create_date
	, plots.sector
	, plots.category_id
	, plots.status
	,plots.location
	,plots.sketch
,plots.image
, plots.ctag, plots.project_id, plots.own
, plots.PLcharges
, plots.remarks
, plots.street_id
, plots.plot_detail_address
, memberplot.plotno
,projects.project_name
,streets.street
,sectors.sector_name
, size_cat.size

FROM



    plots



    Left JOIN streets  ON (plots.street_id = streets.id)
Left JOIN projects  ON (plots.project_id = projects.id)
	Left JOIN memberplot  ON (plots.id = memberplot.plot_id)
   Left JOIN size_cat  ON (plots.size2 = size_cat.id)
 Left JOIN sectors ON (plots.sector= sectors.id)



	



where plots.id='".$_REQUEST['id']."'"; 



			$result_plots = $connection->createCommand($sql_plots)->query();



		//	$sql_plots  = "SELECT * from plots where id='".$_REQUEST['id']."'";



			//$result_plots = $connection->createCommand($sql_plots)->query();

			 Yii::app()->session['projects_array'];

			

			$connection = Yii::app()->db; 

		$temp_projects_array = Yii::app()->session['projects_array'];

		$num_of_projects_counter = count($temp_projects_array);	

		$num_of_projects_counter2 = $num_of_projects_counter;

		$sql1 =   "select * from projects where";

		$num_of_projects_counter--;

		while($num_of_projects_counter>-1)

		{

			$sql2[$num_of_projects_counter] = " id=".Yii::app()->session['projects_array'][$num_of_projects_counter]['project_id'];

			$num_of_projects_counter--;

		}

		$sql_project = $sql1;

		$sql_project = $sql_project.implode(' or',$sql2);

		$result_projects = $connection->createCommand($sql_project)->query() or mysql_error();



			$num_of_category = 'SELECT count(id) as num_of_category from categories';



		 $num_of_category = $connection->createCommand($num_of_category)->queryAll();



		



	        $sql_categories  = "SELECT * from categories";



		    $categories = $connection->createCommand($sql_categories)->query();	



			$sql_size  = "SELECT * from size_cat";



		    $result_size = $connection->createCommand($sql_size)->query();



			$sql12  = "SELECT categories.name,cat_plot.id from cat_plot



			Left JOIN categories  ON (cat_plot.cat_id = categories.id)



			 where plot_id='".$_REQUEST['id']."'";



		    $result12 = $connection->createCommand($sql12)->queryAll();



		



			$this->render('updateplot',array('plots'=>$result_plots,'projects'=>$result_projects,'categories'=>$categories,'size'=>$result_size,'cat'=>$result12));



			   



			}



			else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }



	}



	public function actionUpdate()



	{        $public='';
			 if(empty($_POST['public'])){  $public=0;}else{  $public=1;}

	             $connection = Yii::app()->db;  

				 $s = "SELECT * FROM plots where id=".$_POST['id'];

			     $res = $connection->createCommand($s)->queryRow();

				 if ($_FILES['image']["name"]==''){

				 $image=$res['image'];

					}else{ 

                $image=$_FILES['image']["name"];			

				$newfilename = $_FILES["image"]["name"];

				move_uploaded_file($_FILES["image"]["tmp_name"],

				'images/plots/'.$newfilename);

				}
				if ($_FILES['location']["name"]==''){
							$location=$res['location'];
							}else{
						$location=$_FILES['location']["name"];
						$newfilename = $_FILES["location"]["name"];
						move_uploaded_file($_FILES["location"]["tmp_name"],
						'images/plots/'.$newfilename);
						}
							if ($_FILES['sketch']["name"]==''){
							$sketch=$res['sketch'];
							}else{
						$sketch=$_FILES['sketch']["name"];
						$newfilename = $_FILES["sketch"]["name"];
						move_uploaded_file($_FILES["sketch"]["tmp_name"],
						'images/plots/'.$newfilename);
						}
				$villa='';
				if(empty($_POST['isvilla'])){
					$villa=0;
					$type='Plot';
					$ctag=$_POST['ctag'];
					}else{
						$villa=$_POST['isvilla'];
						$ctag=$_POST['ctag'];
							$type='Villa';
						}
                    if($public==0)
                    {
                        
                        $sql="UPDATE plots set type='".$type."', public='".$public."',project_id='".$_POST['project_id']."',street_id='".$_POST['street_id']."',shap_id='".$_POST['map']."',plot_detail_address='".$_POST['plot_detail_address']."',plot_size='".$_POST['plot_size']."',size2='".$_POST['size2']."',price='".$_POST['price']."',
own='".$_POST['own']."',PLcharges='".$_POST['PLcharges']."',remarks='".$_POST['remarks']."',
create_date='".date('Y-m-d h:i:s')."',com_res='".$_POST['com_res']."',isvilla='".$villa."',sector='".$_POST['sector']."',image='".$image."',location='".$location."',sketch='".$sketch."',cstatus='".$_POST['cstatus']."',ctag='".$ctag."' where id='".$_POST['id']."' ";  
          $command = $connection -> createCommand($sql);
            $command -> execute();
                    }
                    if($public==1)
                    {
                        
						 $sql="UPDATE plots set  type='".$type."', public='".$public."',project_id='".$_POST['project_id']."',street_id='".$_POST['street_id']."',shap_id='".$_POST['map']."',plot_detail_address='".$_POST['plot_detail_address']."',plot_size='".$_POST['plot_size']."',size2='".$_POST['size2']."',price='".$_POST['price']."',
own='".$_POST['own']."',PLcharges='".$_POST['PLcharges']."',remarks='".$_POST['remarks']."',
create_date='".date('Y-m-d h:i:s')."',com_res='".$_POST['com_res']."',isvilla='".$villa."',sector='".$_POST['sector']."',image='".$image."',location='".$location."',sketch='".$sketch."',cstatus='".$_POST['cstatus']."',ctag='".$ctag."' ,status='Public' where id='".$_POST['id']."' ";  
         $command = $connection -> createCommand($sql);
            $command -> execute();
                    }
               
			 



			   $last_insert_id = Yii::app()->db->getLastInsertID();

			   //Adding  to Database

		$num_of_category = 'SELECT count(id) as num_of_category from categories';

		 $num_of_category = $connection->createCommand($num_of_category)->queryAll();

		$res=array();

		foreach($num_of_category as $num_of_category)



		{

			$num_of_category = 	$num_of_category['num_of_category'];

		}

		if($num_of_category>0)

		{$query  = 'DELETE from  cat_plot 



			   where plot_id='.$_REQUEST['id'].' ';



		        $command = $connection -> createCommand($query);



               $command -> execute();}



		while ($num_of_category>0)



		{

			if (isset($_POST[$num_of_category]))



				{

					$cat_id = $_POST[$num_of_category]; 

					$connection = Yii::app()->db;

					//$add_project_per_query = "insert into cat_plot	set plot_id='".$last_insert_id."',cat_id='".$cat_id."' ";

					$add_project_per_query = "INSERT into cat_plot	set cat_id='".$cat_id."', plot_id='".$_REQUEST['id']."' ";

					$command = $connection -> createCommand($add_project_per_query);

					$command -> execute();

				}

			$num_of_category--;

		}

			  // $this->redirect('plots/plots_list');



			   $this->redirect(Yii::app()->baseUrl."/index.php/plots/plots_lis"); 

	}



	public function actionDeleteplot()

	{          
                $connection = Yii::app()->db;  
		 
			 $sql ="SELECT * from memberplot where plot_id='".$_REQUEST['id']."'"; 
			$result_data = $connection->createCommand($sql)->queryRow();
			
		$res=array();

	if ((empty($result_data))){

			
			$query  = "DELETE from  plots where id='".$_REQUEST['did']."' AND status='' ";
		        $command = $connection -> createCommand($query);
                      $command -> execute();
                        $query1  = "DELETE from  cat_plot where plot_id='".$_REQUEST['id']."' ";
		        $command = $connection -> createCommand($query1);
                        $command -> execute();
		 $this->redirect(Yii::app()->baseUrl."/index.php/plots/plots_lis");
		} else{
		 $this->redirect(Yii::app()->baseUrl."/index.php/plots/plots_lis");
			}

			  
			  

			  



	} 	



		







	/**



	 * Updates a particular model.



	 * If update is successful, the browser will be redirected to the 'view' page.



	 * @param integer $id the ID of the model to be updated



	 */



	 



	 



	public function actionReallocate()



	



	{



		if(Yii::app()->session['user_array']['per1']=='1')



			{



			$connection = Yii::app()->db;



					 $sql_plots = "SELECT



    plots.id



    , plots.street_id



    , plots.plot_size



    , plots.com_res



	, plots.price



	, plots.cstatus



	 , plots.size2



    , plots.create_date



	, plots.sector



	, plots.category_id



	, plots.status



	, plots.image



	, plots.plot_detail_address



	, memberplot.plotno



    , projects.project_name



	, categories.name



	, streets.street

	, plots.project_id

	, size_cat.size



	



	



FROM



    plots



    Left JOIN streets  ON (plots.street_id = streets.id)



	Left JOIN projects  ON (plots.project_id = projects.id)



	Left JOIN memberplot  ON (plots.id = memberplot.plot_id)



	Left JOIN categories  ON (plots.category_id = categories.id)

	Left JOIN size_cat  ON (plots.size2 = size_cat.id)



where plots.id='".$_REQUEST['id']."'";



		//	$sql_plots  = "SELECT * from plots where id='".$_REQUEST['id']."'";



			$result_plots = $connection->createCommand($sql_plots)->query();



			$sql  = "SELECT * from projects";



			$result = $connection->createCommand($sql)->query();



	



			$this->render('reallocate',array('plots'=>$result_plots,'projects'=>$result));



			   



			}



			else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }



	}



	



	 



	 ///////////////////REALLOCATE THE PLOT////////////////



	  



		public function actionReallocation()

	{          $error='';
			    $connection = Yii::app()->db;  
			if(isset($_POST['street_id']) && empty($_POST['street_id']))
			{
				$error .= 'Please Select Plot Street<br>';
			}
			if(isset($_POST['price']) && empty($_POST['price']))
			{
				$error .= 'Please Enter Plot Price<br>';
			}
          
			if(isset($_POST['plot_detail_address']) && empty($_POST['plot_detail_address']))
			{
				$error .= 'Please Enter Plot No<br>';
			}
		
				if(isset($_POST['sector']) && empty($_POST['sector']))
			{
				$error .= 'Please Select Sector<br>';
			}

				if(isset($_POST['plot_size']) && empty($_POST['plot_size']))

			{
				$error .= 'Please Enter Plot Diemension<br>';
			}

				
		 

			 $sq  = "SELECT * from plots where project_id='".$_POST['project_id']."' AND street_id='".$_POST['street_id']."' AND plot_detail_address='".$_POST['plot_detail_address']."' ";
			 $result_sq = $connection->createCommand($sq)->queryAll();
			 $count=0;
			 $re=array();
			 foreach($result_sq as $key1){$count=$count+1;}
			if($count!=0)
			 {
				  $error.="A Plot Is Already Added On This Address Please Enter Another Plot Address  ";

			}	
			 

			  if(empty($error))



			{  
			   $plots="SELECT * FROM plots where id=".$_POST['id']."";
			   $plo = $connection->createCommand($plots)->query();
			   foreach($plo as $key){
			   $sql  = 'INSERT INTO reallocation_history (type,plot_id,project_id,street_id, plot_detail_address, plot_size, size2,price,create_date, com_res,sector,cstatus )
               VALUES ( "'.$key['type'].'","'.$_POST['id'].'","'.$key['project_id'].'", "'.$key['street_id'].'", "'.$key['plot_detail_address'].'",
			   "'.$key['plot_size'].'", "'.$key['size2'].'", "'.$key['price'].'", "'.$key['create_date'].'" ,"'.$key['com_res'].'","'.$key['sector'].'","'.$key['cstatus'].'")';
			   $command = $connection -> createCommand($sql);
        	   $command -> execute();
			   }
			   
			  
	   $update  = "UPDATE  plots set type='Plot',plot_detail_address='".$_POST['plot_detail_address']."',street_id='".$_POST['street_id']."',plot_size='".$_POST['plot_size']."',price='".$_POST['price']."',create_date='".date('Y-m-d h:i:s')."',sector='".$_POST['sector']."', rstatus='reallocated' 
			   where id='".$_POST['id']."'"; 
		      $command = $connection -> createCommand($update);
              $command -> execute();
			  $sql_email  = "SELECT
    plots.id
    , plots.street_id
    , plots.plot_size
    , plots.com_res
	 , plots.size2

    , plots.rstatus
	, plots.sector
	, plots.category_id
	, plots.status
	, memberplot.fstatus
	, plots.bstatus
	, plots.price
	, plots.plot_detail_address
	, memberplot.plotno
    , projects.project_name
	, streets.street
	, size_cat.size
	, members.name
	, members.email
FROM
   plots
    Left JOIN streets  ON (plots.street_id = streets.id)
	Left JOIN projects  ON (plots.project_id = projects.id)
	Left JOIN memberplot  ON (plots.id = memberplot.plot_id)
	Left JOIN members  ON (members.id = memberplot.member_id)
	Left JOIN size_cat  ON (size_cat.id = plots.size2)

where  plots.id ='".$_POST['id']."'";
$result_email = $connection->createCommand($sql_email)->queryRow();
//print_r($result_email);exit;
#####################################
# Include PHP Mailer Class
#####################################
require("email/class.phpmailer.php");
#####################################
# Function to send email
#####################################
function sendEmail ($fromName, $fromEmail, $toEmail, $subject, $emailBody) {
	$mail = new PHPMailer();
	$mail->FromName = $fromName;
	$mail->From = $fromEmail;
	$mail->AddAddress("$toEmail");
		
	$mail->Subject = $subject;
	$mail->Body = $emailBody;
	$mail->isHTML(true);
	$mail->WordWrap = 150;
		
	if(!$mail->Send()) {
		return false;
	} else {
		return true;
	}
}

#####################################
# Function to Read a file 
# and store all data into a variable
#####################################
function readTemplateFile($FileName) {
		$fp = fopen($FileName,"r") or exit("Unable to open File ".$FileName);
		$str = "";
		while(!feof($fp)) {
			$str .= fread($fp,1024);
		}	
		return $str;
}
#####################################
# Finally send email
#####################################

	//Data to be sent (Ideally fetched from Database)
	$name = $result_email['name'];
	$plot_detail_address = $result_email['plot_detail_address'];
	$street = $result_email['street'];
	$project_name = $result_email['project_name'];
	$plot_size = $result_email['plot_size'];
	$size = $result_email['size'];
	$com_res = $result_email['com_res'];
	$price = $result_email['price'];
	
	//Send email to user containing username and password
	//Read Template File 
	$emailBody = readTemplateFile("email/reallocatedmail.html");
		$UserEmail=$result_email['email'];	
	//Replace all the variables in template file
	$emailBody = str_replace("#name#",$name,$emailBody);
	$emailBody = str_replace("#plot_detail_address#",$plot_detail_address,$emailBody);
	$emailBody = str_replace("#street#",$street,$emailBody);
	$emailBody = str_replace("#plot_size#",$plot_size,$emailBody);
	$emailBody = str_replace("#size#",$size,$emailBody);
	$emailBody = str_replace("#com_res#",$com_res,$emailBody);
	$emailBody = str_replace("#price#",$price,$emailBody);
				
	//Send email
	$emailStatus = sendEmail ("RDLPK", "admin@rdlpk.com", $UserEmail, "Re-allocated Plot", $emailBody);
	echo"Plot Reallocated Successfully";
	//If email function return false
		   
			}
			 else{
				 
				 echo $error;
				 }
	}


	 



	



	 



	 function actionEdit()



	 {



		 if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))



		{



			$this->layout='column3';



			$this->render('edit_register');



		}



		 



	}



	 



public function actionPlots_list()



	{	



	if(Yii::app()->session['user_array']['per2']=='1')



			{



	$connection = Yii::app()->db; 



	



//	$sql_member = "SELECT * from plots where type='plot'";



	$sql_member = "SELECT



    plots.id



    , plots.street_id



    , plots.plot_size



	, plots.size2



    , plots.com_res



    , plots.create_date



	, plots.sector



	, plots.status



	, plots.plot_detail_address



	, memberplot.plotno



    , projects.project_name



	, streets.street



FROM



    plots



    Left JOIN streets  ON (plots.street_id = streets.id)



	Left JOIN projects  ON (plots.project_id = projects.id)



	Left JOIN memberplot  ON (plots.id = memberplot.plot_id)



where type='plot' ";



		$result_members = $connection->createCommand($sql_member)->query();



	



	    $sql_project = "SELECT * from projects";



		$result_project = $connection->createCommand($sql_project)->query();



	   



	    $sql_sector ="SELECT DISTINCT sector FROM plots";



		$result_sector = $connection->createCommand($sql_sector)->query();



	



	 



	



			$this->render('plots_list',array('members'=>$result_members,'projects'=>$result_project,'sectors'=>$result_sector));



			}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }



	}



	public function actionReallocated()



	{	



	if(Yii::app()->session['user_array']['per2']=='1')



			{



	$connection = Yii::app()->db; 



	



//	$sql_member = "SELECT * from plots where type='plot'";



	$sql_member = "SELECT



    plots.id



    , plots.street_id



    , plots.plot_size



	, plots.size2



    , plots.com_res



    , plots.create_date



	, plots.sector



	, plots.status



	, plots.plot_detail_address



	, memberplot.plotno



    , projects.project_name



	, streets.street



FROM



    plots



    Left JOIN streets  ON (plots.street_id = streets.id)



	Left JOIN projects  ON (plots.project_id = projects.id)



	Left JOIN memberplot  ON (plots.id = memberplot.plot_id)



where type='plot' AND plots.rstatus='reallocated' ";



		$result_members = $connection->createCommand($sql_member)->query();



	



	    $sql_project = "SELECT * from projects";



		$result_project = $connection->createCommand($sql_project)->query();



	   



	    $sql_sector ="SELECT DISTINCT sector FROM plots";



		$result_sector = $connection->createCommand($sql_sector)->query();



	



	 



	



			$this->render('plots_list',array('members'=>$result_members,'projects'=>$result_project,'sectors'=>$result_sector));



			}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }



	}



	



	public function actionHistory()



	{	



	if(Yii::app()->session['user_array']['per2']=='1')



			{



	$connection = Yii::app()->db;



			$sql_projects  = "SELECT * from plothistory where plot_id='".$_REQUEST['id']."'";



			$result_projects = $connection->createCommand($sql_projects)->query();



			



			$sql_page  = "SELECT * from memberplot where plot_id='".$_REQUEST['id']."'";



			$result_pages = $connection->createCommand($sql_page)->query();



			



			$this->render('history',array('projects'=>$result_projects,'pages'=>$result_pages));



			}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }



	}



	

public function actionPlots_lis()
{
if((Yii::app()->session['user_array']['per2']=='1')&& isset(Yii::app()->session['user_array']['username']))
{
	$result_members = '';
	$pro='';
	$st='';
	$sector='';
	$categories='';
	$sizes='';
	$result_com_res='';

	 
$connection = Yii::app()->db;
$temp_projects_array = Yii::app()->session['projects_array'];
$num_of_projects_counter = count($temp_projects_array);
$num_of_projects_counter2 = $num_of_projects_counter;
$sql1 =   "select * from projects where";
$num_of_projects_counter--;
while($num_of_projects_counter>-1)
{
$sql2[$num_of_projects_counter] = " id=".Yii::app()->session['projects_array'][$num_of_projects_counter]['project_id'];
$num_of_projects_counter--;
}

$sql_project = $sql1;
$sql_project = $sql_project.implode(' or',$sql2);


$result_projects = $connection->createCommand($sql_project)->query() or mysql_error();


//$sql_project = "SELECT * from projects";
//$result_project = $connection->createCommand($sql_project)->query();


$sql_categories  = "SELECT * from categories";
$categories = $connection->createCommand($sql_categories)->query();
$sql_size  = "SELECT * from size_cat";
$sizes = $connection->createCommand($sql_size)->query();
$sql_sector ="SELECT * FROM sectors";
$result_sector = $connection->createCommand($sql_sector)->query();

$sql_com_res ="SELECT DISTINCT com_res FROM plots";
$result_com_res = $connection->createCommand($sql_com_res)->query();

$home=Yii::app()->request->baseUrl;

$this->render('plots_lis',array('members'=>$result_members,'projects'=>$result_projects,'sectors'=>$result_sector,'pro'=>$pro,'st'=>$st,'sector'=>$sector,'categories'=>$categories,'sizes'=>$sizes,'com_res'=>$result_com_res));
}else{
$this->redirect(array('user/dashboard'));
}


}


	



	



	



	



	



	public function actionPlotsli()



{	



		



	   



	   		$plotno='';



			$st='';



			$pro='';



			$sector='';



			$cat='';



			$where='';



			$and = false;



			$where='';



			



				



			



			



			



		



		if (isset($_POST['search'])){ 



		}



			



			



	   



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







	public function actionIndex()



	{



		



		if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))



		{



			 $this->redirect(array('datasource'));



		}else



		{



			$error = '';



			$layout='//layouts/column1';



			



			$this->render('index');



		}



	}



	public function actionAjaxRequest6($val1)

	{	

		$connection = Yii::app()->db;  

		$sql_plots  = "SELECT * from plots where plot_detail_address='".$val1."'";

		$result_plots = $connection->createCommand($sql_plots)->query();

		$city=array();

		foreach($result_plots as $cit){

			$city[]=$cit;

			} 

	echo json_encode($city); exit();

	}



	public function actionAjaxRequest7($val1, $val2)

	{	

		$connection = Yii::app()->db;  

		$sql_city  = "SELECT * from plots where project_id='".$val2."' AND plot_detail_address='".$val1."' ";

		$result_city = $connection->createCommand($sql_city)->query();

		$city=array();

		foreach($result_city as $cit){

			$city[]=$cit;

			} 

	echo json_encode($city); exit();

	}





	public function actionAjaxRequest($val1)



	{



			$connection = Yii::app()->db;  



		$sql_street  = "SELECT * from sectors where project_id='".$val1."'";



		$result_streets = $connection->createCommand($sql_street)->query();



			



		$street=array();



		foreach($result_streets as $str){



			$street[]=$str;



			} 



		



	echo json_encode($street); exit();



	}

public function actionAjaxRequest2($pro,$sec)
	{



			$connection = Yii::app()->db;  



		$sql_street  = "SELECT * from streets where project_id='".$pro."' and sector_id='".$sec."'";



		$result_streets = $connection->createCommand($sql_street)->query();



			



		$street=array();



		foreach($result_streets as $str){



			$street[]=$str;



			} 



		



	echo json_encode($street); exit();



	}



	







	



	



	public function actionPlots()



	



	{



		if(Yii::app()->session['user_array']['per4']=='1')



			{



			$connection = Yii::app()->db;  

        $connection = Yii::app()->db; 

		$temp_projects_array = Yii::app()->session['projects_array'];

		$num_of_projects_counter = count($temp_projects_array);	

		$num_of_projects_counter2 = $num_of_projects_counter;

		$sql1 =   "select * from projects where";

		$num_of_projects_counter--;

		while($num_of_projects_counter>-1)

		{

			$sql2[$num_of_projects_counter] = " id=".Yii::app()->session['projects_array'][$num_of_projects_counter]['project_id'];

			$num_of_projects_counter--;

		}

		$sql_project = $sql1;

		$sql_project = $sql_project.implode(' or',$sql2);

		$result_projects = $connection->createCommand($sql_project)->query() or mysql_error();

		     $sql_size  = "SELECT * from size_cat";

		    $result_size = $connection->createCommand($sql_size)->query();

			$sql_categories  = "SELECT * from categories";

		    $categories = $connection->createCommand($sql_categories)->query();

			$this->render('plots',array('projects'=>$result_projects,'categories'=>$categories,'size'=>$result_size));

			}



			else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }



	}



	



	



	



	 



	  



	



	public function loadModel($id)



	{



		$model=User::model()->findByPk($id);



		if($model===null)



			throw new CHttpException(404,'The requested page does not exist.');



		return $model;



	}







	/**



	 * Performs the AJAX validation.



	 * @param User $model the model to be validated



	 */



	protected function performAjaxValidation($model)



	{



		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')



		{



			echo CActiveForm::validate($model);



			Yii::app()->end();



		}



	}

//new fuctions for plots reporting 

public function actionReporting()

	{
		if((Yii::app()->session['user_array']['per11']=='1')&& isset(Yii::app()->session['user_array']['username']))

			{

			$this->render('reporting');

	} 
	
	else{
		$this->redirect(array('user/dashboard'));
		}
}
public function actionReportmain()

	{
		if((Yii::app()->session['user_array']['per11']=='1')&& isset(Yii::app()->session['user_array']['username']))

			{

		if(isset($_POST['reporting'])){

			$this->render('reporting');

		}
		 if(isset($_POST['trnsferfiles'])){			
				$this->render('trnsferfiles');
				}
if(isset($_POST['memadrept'])){

			$this->render('memadrept');

	

	}
	if(isset($_POST['dreportr'])){

			$this->render('dreportr');

	

	}

	if(isset($_POST['dreportc'])){

			$this->render('dreportc');

	}



	if(isset($_POST['dreporta'])){

		

			$this->render('dreporta');

	}



	if(isset($_POST['dreportt'])){

			$this->render('dreportt');

	}



	if(isset($_POST['dreportre'])){

			$this->render('dreportre');

	}



	if(isset($_POST['report'])){	

			$this->render('report');

	}
if(isset($_POST['deulist'])){	
			
			$this->render('payment_lis');

	}
	} 
	
	else{
		$this->redirect(array('user/dashboard'));
		}
	}
public function actionSearchpay()
{
		$where='';

		$and=false;

		 if (isset($_POST['status']) && $_POST['status']!=""){

				if($_POST['status']=='new'){$where.="fstatus='' and paidamount!=''";}
				else if($_POST['status']=='due'){$where.="fstatus='' and paidamount=''";}else{
				$where.="fstatus LIKE '%".$_POST['status']."%'";
				}
				$and = true;
			}

		if (isset($_POST['plotno']) && $_POST['plotno']!=""){
	
					$plotno=$_POST['plotno'];
	
					if ($and==true)
	
					{
	
						  $where.=" and plots.plot_detail_address LIKE '%".$_POST['plotno']."%'";
	
					}
	
					else
	
					{
	
						$where.=" plots.plot_detail_address LIKE '%".$_POST['plotno']."%'";
	
					}
	
					$and=true;
	
				}
	if ( isset($_POST['project_id']) &&  $_POST['project_id']!=""){				
	
					$pro=$_POST['project_id'];
	
					if ($and==true)
	
					{
	
						$where.=" and plots.project_id LIKE '%".$_POST['project_id']."%'";
	
					}
	
					else
	
					{
	
						$where.=" plots.project_id LIKE '%".$_POST['project_id']."%'";
	
					}
	
					$and=true;
	
				}
					if (isset($_POST['size']) && $_POST['size']!=""){
	
					$size=$_POST['size'];
	
					if ($and==true)
	
					{
	
						  $where.=" and plots.size2 LIKE '%".$_POST['size']."%'";
	
					}
	
					else
	
					{
	
						$where.=" plots.size2 LIKE '%".$_POST['size']."%'";
	
					}
	
					$and=true;
	
				}
	
	
				
		
		if (isset($_POST['ms']) && $_POST['ms']!=""){

				

				if ($and==true)

				{

					  $where.=" and memberplot.plotno ='".$_POST['ms']."'";

				}

				else

				{

					$where.=" memberplot.plotno ='".$_POST['ms']."'";

				}
				

				$and=true;

			}

		$connection = Yii::app()->db; 

 $sql_payment  = "SELECT *,projects.code as pcode FROM installpayment 
 Left join plots ON (installpayment.plot_id=plots.id) 
 Left join memberplot ON (installpayment.plot_id=memberplot.plot_id)
 Left join projects ON (plots.project_id=projects.id) 
 Left join size_cat ON (plots.size2=size_cat.id)  
 Left join streets ON (plots.street_id=streets.id)  
 Left join sectors ON (plots.sector=sectors.id) 
 Left join members ON (memberplot.member_id=members.id)  
 where paidamount='' and $where ORDER BY members.cnic,memberplot.plotno ASC;
 
  ";
$sql_payments= $connection->createCommand($sql_payment)->query();

        $sql_project = "SELECT * from projects";

		$result_project = $connection->createCommand($sql_project)->query();
		$sql_categories  = "SELECT * from categories";

		    $categories = $connection->createCommand($sql_categories)->query();
	    $sql_sector ="SELECT DISTINCT sector FROM plots";

		$result_sector = $connection->createCommand($sql_sector)->query();

		
		
		$sql_size  = "SELECT * from size_cat";

		$sizes = $connection->createCommand($sql_size)->query();
		
	$count=0;

	if ($sql_payments!=''){

		$home=Yii::app()->request->baseUrl; 

    $res=array();
$i=0;
            foreach($sql_payments as $row){

          
        
 if(isset($_POST['dat']) && $_POST['dat']!==''){         
$now =  strtotime($_POST['dat']); }else{$now=time();}
$your_date = strtotime($row['due_date']);
$datediff = $now - $your_date;
$number=floor($datediff/(60*60*24));
if($number>=0){
		$i++;
  echo '<tr><td>' . $i . '</td>
 <td>' . $row['pcode'] . '</td>
 <td>' . $row['plot_detail_address'] . '</td>
 <td>' . $row['size'] . '</td>
 <td>' . $row['street'] . '</td>
 <td>' . $row['sector_name'] . '</td>
 <td>' . $row['plotno'] . '</td>
 <td>' . $row['name'] . '</td>
 <td>' . $row['cnic'] . '</td>
 <td>' . $row['lab'] . '</td>
 <td style="text-align:center;">' . $row['due_date']. '</td>
 <td style="text-align:right;">' . $row['dueamount'] . '</td>
 <td>'.floor($datediff/(60*60*24)).'-Days</td>
  <td></td>
</tr>  ';}
} 

			}else{}
exit;
}
public function actionDuepayment(){
	$this->render('payment_lis');
	}	

}