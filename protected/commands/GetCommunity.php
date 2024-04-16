<?php
class TestCommand extends CConsoleCommand
{
    public function run($args)
    {
					$connection = Yii::app()->db;
			$connection->createCommand()->truncateTable(Community::model()->tableName()); 
			$connection->createCommand()->truncateTable(Source::model()->tableName()); 
			$community_data = get_all_community();
			print_r($community_data);
			exit;
    }
	public function all_community()
	{
		
		$html_brand ="http://58.65.163.154:8080/api/auth/login/admin/infinite_default@ikanow.com/zBtTVQaqI%2BWr8nrAX%2FSX%2FsqOqX0CA5DTrRqogdxmEhg%3D";

		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);
		$options = array(
			CURLOPT_URL            => $html_brand,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_HEADER         => false,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_ENCODING       => "",
			CURLOPT_AUTOREFERER    => true,
			CURLOPT_CONNECTTIMEOUT => 120,
			CURLOPT_TIMEOUT        => 120,
			CURLOPT_MAXREDIRS      => 10,
			CURLOPT_COOKIESESSION  =>TRUE
			 
		);
		curl_setopt_array( $ch, $options );
		$response = curl_exec($ch); 
		$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if ( $httpCode != 200 ){
			echo "Return code is {$httpCode} \n".curl_error($ch);
			exit;
		} else {
			 $loginarray = $response;
			 $login=(json_decode($loginarray));
			 if($login->response->success==1)
			 {
				 // $post_data = array("raw"=>array("match_all"=>true));
				 //$htmlpost = 		"http://58.65.163.154:8080/api/social/community/getall";
				 $htmlpost = 		"http://58.65.163.154:8080/api/social/community/getall";
				
				$options = array(
				CURLOPT_URL            => $htmlpost,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_HEADER         => false,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_ENCODING       => "",
				CURLOPT_AUTOREFERER    => true,
				CURLOPT_CONNECTTIMEOUT => 120,
				CURLOPT_TIMEOUT        => 120,
				CURLOPT_MAXREDIRS      => 10,
				CURLOPT_COOKIESESSION  =>TRUE
				 
			);
				curl_setopt_array( $ch, $options );
				$response1 = curl_exec($ch); 
				$dataset = array();	  
				$arr=(json_decode($response1));
				$dataset = $arr->data;
				return $dataset;
			 		}
				}
				
				curl_close($ch);
	}
}

?>