<?php 
$config   = $_SERVER['DOCUMENT_ROOT'].'/hb/hybridauth/config.php';
$hybrid_auth = $_SERVER['DOCUMENT_ROOT']."/hb/hybridauth/Hybrid/Auth.php";


require_once( $hybrid_auth );
try{ 
		$hybridauth = new Hybrid_Auth( $config );
	} 
	// if sometin bad happen
	catch( Exception $e ){
		$message = ""; 
		
		switch( $e->getCode() ){ 
			case 0 : $message = "Unspecified error."; break;
			case 1 : $message = "Hybriauth configuration error."; break;
			case 2 : $message = "Provider not properly configured."; break;
			case 3 : $message = "Unknown or disabled provider."; break;
			case 4 : $message = "Missing provider application credentials."; break;
			case 5 : $message = "Authentication failed. The user has canceled the authentication or the provider refused the connection."; break;

			default: $message = "Unspecified error!";
		}
		
?>
<?php 
		// diplay error and RIP
		die();
	}

	$provider  = @ $_GET["provider"];
	$return_to = @ $_GET["return_to"];
	
	
	if( isset( $_GET["connected_with"] ) && $hybridauth->isConnectedWith( $_GET["connected_with"] ) ){
		$provider = $_GET["connected_with"];
		
		$adapter = $hybridauth->getAdapter( $provider );
		
		$user_data = $adapter->getUserProfile();
		$user_array= array('user_id'=>$user_data->identifier,'webSiteURL'=>$user_data->webSiteURL,'profileURL'=>$user_data->profileURL,'photoURL'=>$user_data->photoURL,'displayName'=>$user_data->displayName,'description'=>$user_data->description,'firstName'=>$user_data->firstName,'lastName'=>$user_data->lastName,'gender'=>$user_data->gender,'language'=>$user_data->language,'age'=>$user_data->age,'birthDay'=>$user_data->birthDay,'birthMonth'=>$user_data->birthMonth,'birthYear'=>$user_data->birthYear,'email'=>$user_data->email,'emailVerified'=>$user_data->emailVerified,'phone'=>$user_data->phone,'address'=>$user_data->address,'country'=>$user_data->country,'login_status'=>0);
		Yii::app()->session['user_array'] = $user_array;
		$this->redirect(array('user/datasource'));
		exit;
	}
	
		if( ! empty( $provider ) && $hybridauth->isConnectedWith( $provider ) )
	{
		$return_to = $return_to . ( strpos( $return_to, '?' ) ? '&' : '?' ) . "connected_with=" . $provider ;
		
		
?>
<script language="javascript"> 
	if(  window.opener ){
		try { window.opener.parent.$.colorbox.close(); } catch(err) {} 
		window.opener.parent.location.href = "<?php echo $return_to; ?>";
	}

	window.self.close();
</script>
<?php
		die();
	}

	if( ! empty( $provider ) )
	{
		$params = array();

		if( $provider == "OpenID" ){
			$params["openid_identifier"] = @ $_REQUEST["openid_identifier"];
		}

		if( isset( $_REQUEST["redirect_to_idp"] ) ){
			$adapter = $hybridauth->authenticate( $provider, $params );
		}
		else{
			// here we display a "loading view" while tryin to redirect the user to the provider
?>

<table width="100%" border="0">
  <tr>
    <td align="center" height="190px" valign="middle"><img src="../members/images/loading.gif" /></td>
  </tr>
  <tr>
    <td align="center"><br /><h3>Loading...</h3><br /></td> 
  </tr>
  <tr>
    <td align="center">Contacting <b><?php echo ucfirst( strtolower( strip_tags( $provider ) ) ) ; ?></b>. Please wait.</td> 
  </tr> 
</table>
<script>
	window.location.href = window.location.href + "&redirect_to_idp=1";
</script>
<?php
		}

		die();
	}
?>
 
<div class="span4 main-icons">
                    	<a href="#">
                       <p class="float-left margin-left-100">frontend <a href="<?php echo $this->createAbsoluteUrl('web/index')?>" class="link-2" title="Projects">Frontend</p></a>
                        	<img src="../members/images/icon-01.png" />
                        	<h4>User</h4>
                            <p>Add / Remove / Edit Users</p>
                        </a>
                    </div>
                    
                    <div class="span4 main-icons">
                    	<a href="<?php echo $this->createAbsoluteUrl('projects/projects')?>">
                        	<img src="../members/images/icon-02.png" />
                        	<h4>Projects</h4>
                            <p>Veiw / Edit Projects</p>
                        </a>
                    </div>
                    
                    <div class="span4 main-icons">
                    	<a href="#">
                        	<img src="../members/images/icon-03.png" />
                        	<h4>Members</h4>
                            <p>Veiw / Edit Members</p>
                        </a>
                    </div>
                    
                    <div class="span4 main-icons">
                    	<a href="#">
                        	<img src="../members/images/icon-04.png" />
                        	<h4>Forms</h4>
                            <p>Add Remove or Edit Forms</p>
                        </a>
                    </div>
                    
                    <div class="span4 main-icons">
                    	<a href="#">
                        	<img src="../members/images/icon-05.png" />
                        	<h4>Pages</h4>
                            <p>Add Remove or Edit Pages</p>
                        </a>
                    </div>
                    
                    <div class="span4 main-icons">
                    	<a href="<?php echo $this->createAbsoluteUrl('plots/plots')?>">
                        	<img src="../members/images/icon-06.png" />
                        	<h4>Transfer a Plot</h4>
                            <p>Transfer Plots / Edit Owners</p>
                        </a>
                    </div>
<hr noshade="noshade" class="hr-5 float-left">

<!-- section 3 -->

