<?php

/******************************************************************************/
/******************************************************************************/

class CHBSLicense
{
	/**************************************************************************/
	
	function __construct($envatoItemId=PLUGIN_CHBS_ENVATO_ITEM_ID,$extensionPrefix=PLUGIN_CHBS_PREFIX)
	{
		$this->clientId='purchase-code-verification-pqu74c9s';
		
		$this->code='243ec103764bf24d24983927f49ce55bd2e5732afe04fa5d6a920de192276dd3';
		
		$this->clientSecret='zIEoqw33vWqDli16JM47ESkURT3RpVBp';
		
		$this->accessToken='FknEVJDxASN3dSXMS9NlNnazHX7QwZqA';
		$this->refreshToken='krN07zvi2VUO9xPfTqKLyj9ZDt0ROhlo';	
		
		$this->printResponse=false;
		
		$this->envatoItemId=$envatoItemId;
		
		$this->extensionPrefix=$extensionPrefix;
		
		$this->licenseUsername=null;
		$this->licensePurchaseCode=null;
		
		$this->licenseUsernamePrevious=null;
		$this->licensePurchaseCodePrevious=null;
		
		$this->timestampCurrent=0;
		$this->timestampPrevious=0;
	}
	
	/**************************************************************************/
	
	private function setCurlUserAgent(&$ch)
	{
		curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:20.0) Gecko/20100101 Firefox/20.0'); 
	}
	
	/**************************************************************************/
	
	private function refreshAccessToken()
	{
		$url='https://api.envato.com/token';
		$data='grant_type=refresh_token&refresh_token='.$this->refreshToken.'&client_id='.$this->clientId.'&client_secret='.$this->clientSecret;
		
		$ch=curl_init($url);
		
		curl_setopt($ch,CURLOPT_POST,1);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
		
		$response=json_decode(curl_exec($ch));
		
		curl_close($ch);		 
		
		$this->printResponse($response);
		
		return($response->access_token);
	}
	
	/**************************************************************************/
	
	function verify($licenseUsername,$licensePurchaseCode,$ignoreTimestamp=false)
	{
		$Date=new CHBSDate();
		$Validation=new CHBSValidation();
		$LogManager=new CHBSLogManager();
				
		/***/
		
		$this->licenseUsername=$licenseUsername;
		$this->licensePurchaseCode=$licensePurchaseCode;
		
		/***/
		
		if(($Validation->isNotEmpty($this->licenseUsername)) && ($Validation->isNotEmpty($this->licensePurchaseCode)))
		{
			return(true);
		}
		else return(false);
		
		/***/
		
		$this->timestampCurrent=$Date->getNow();
		
		if(!$ignoreTimestamp)
		{
			if($this->extensionPrefix==PLUGIN_CHBS_PREFIX)
			{
				$this->timestampPrevious=CHBSOption::getOption('license_verify_timestamp');
				
				$this->licenseUsernamePrevious=CHBSOption::getOption('license_username');
				$this->licensePurchaseCodePrevious=CHBSOption::getOption('license_purchase_code');
			}
			else 
			{
				$ExtensionOption=new CHBSExtensionOption($this->extensionPrefix);
				$this->timestampPrevious=$ExtensionOption->getOption('license_verify_timestamp');
				
				$this->licenseUsernamePrevious=$ExtensionOption->getOption('license_username');
				$this->licensePurchaseCodePrevious=$ExtensionOption->getOption('license_purchase_code');
			}
			
			if(($this->licenseUsernamePrevious==$this->licenseUsername) & ($this->licensePurchaseCodePrevious==$this->licensePurchaseCode))
			{
				$b=array(false,false);

				$b[0]=$this->isVerified();		
				$b[1]=((int)$this->timestampCurrent-(int)$this->timestampPrevious)>(60*60*24*1) ? false : true; 

				if(!in_array(false,$b,true))
				{
					$LogManager->add('envato_api',3,print_r(array('timestamp_current'=>date_i18n('d-m-Y H:i',$this->timestampCurrent).' ('.$this->timestampCurrent.')','timestamp_previous'=>date_i18n('d-m-Y H:i',$this->timestampPrevious).' ('.$this->timestampPrevious.')'),true));	
					return(true);
				}
			}
		}
		
		/****/
		
		$accessToken=$this->refreshAccessToken();
		
		$url='https://api.envato.com/v3/market/author/sale?code='.trim($this->licensePurchaseCode);
		
		$ch=curl_init($url);
		
		$this->setCurlUserAgent($ch);
		
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch,CURLOPT_HTTPHEADER,array('Content-Type: application/x-www-form-urlencoded','Authorization: Bearer '.$accessToken));
		
		$response=json_decode(curl_exec($ch));
		
		curl_close($ch);
		
		$this->printResponse($response);
		
		if(isset($response->item->name))
		{
			if((isset($response->buyer)) && ($response->buyer==$this->licenseUsername) && (in_array((int)$response->item->id,$this->envatoItemId)))
			{
				$LogManager->add('envato_api',1,print_r($response,true));	
				return(true);
			}
			else 
			{
				$LogManager->add('envato_api',2,print_r(array('error_message'=>__('Username or product ID don\'t match','chauffeur-booking-system')),true));		
			}
		}
		else
		{
			$LogManager->add('envato_api',2,print_r($response,true));	
		}
		
		return(false);
	}
	
	/**************************************************************************/
	
	private function printResponse($response)
	{
		if($this->printResponse)
		{
			echo '<pre>';
			var_dump($response);
			echo '</pre>';	
		}
	}
	
	/**************************************************************************/
	
	function generateVerificationCode($licenseUsername=null,$licensePurchaseCode=null)
	{
		$Validation=new CHBSValidation();
		
		if($Validation->isEmpty($licenseUsername))
			$licenseUsername=$this->licenseUsername;
		if($Validation->isEmpty($licensePurchaseCode))
			$licensePurchaseCode=$this->licensePurchaseCode;		
		
		$code=strtoupper(md5($licenseUsername.'_'.$licensePurchaseCode.'_'.CHBSOption::getOption('run_code')));
		return($code);
	}
	
	/**************************************************************************/
	
	function setAsVerified()
	{
		$code=$this->generateVerificationCode();
		
		$option=array('product_verificaton_code'=>$code,'license_purchase_code'=>$this->licensePurchaseCode,'license_username'=>$this->licenseUsername,'license_verify_timestamp'=>$this->timestampCurrent);
		
		if($this->extensionPrefix==PLUGIN_CHBS_PREFIX)
			CHBSOption::updateOption($option);
		else
		{
			$ExtensionOption=new CHBSExtensionOption($this->extensionPrefix);
			$ExtensionOption->updateOption($option);
		}
	}
	
	/**************************************************************************/
	
	function setAsUnVerified()
	{
		$option=array('product_verificaton_code'=>'','license_purchase_code'=>'','license_username'=>'','license_verify_timestamp'=>0);
		
		if($this->extensionPrefix==PLUGIN_CHBS_PREFIX)
			CHBSOption::updateOption($option);
		else 
		{
			$ExtensionOption=new CHBSExtensionOption($this->extensionPrefix);
			$ExtensionOption->updateOption($option);			
		}
	}
	
	/**************************************************************************/
	
	function isVerified($licenseUsername=null,$licensePurchaseCode=null)
	{
		$code=$this->generateVerificationCode($licenseUsername,$licensePurchaseCode);
		
		if($this->extensionPrefix==PLUGIN_CHBS_PREFIX)
		{
			if(CHBSOption::getOption('product_verificaton_code')==$code) return(true);
		}
		else
		{
			$ExtensionOption=new CHBSExtensionOption($this->extensionPrefix);
			if($ExtensionOption->getOption('product_verificaton_code')==$code) return(true);
		}
			
		return(false);
	}

	/**************************************************************************/
}

/******************************************************************************/
/******************************************************************************/




