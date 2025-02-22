<?php

/******************************************************************************/
/******************************************************************************/

class CHBSTemplate
{
	/**************************************************************************/
	
	function __construct($data,$path)
	{
		$this->data=$data;
		$this->path=$path;
	}

	/**************************************************************************/

	public function output()
	{
		ob_start();
 		include($this->path);
		$value=ob_get_clean();
		return($value);
	}
	
	/**************************************************************************/
    
	static function outputS($data,$path,$format=false)
	{
		$Template=new CHBSTemplate($data,$path);
		return($Template->output($format));
	}
	
    /**************************************************************************/
}

/******************************************************************************/
/******************************************************************************/