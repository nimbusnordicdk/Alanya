<?php

/******************************************************************************/
/******************************************************************************/

class CHBSConstant
{
	/**************************************************************************/
	
	static function get($constantName,$returnValue=false,$prefix=false)
	{
		if($prefix!==false) $constantName='PLUGIN_'.$prefix.'_'.$constantName;
		
		$constantName=strtoupper($constantName);
		
		if(!defined($constantName)) return($returnValue);
		return(constant($constantName));
	}

	/**************************************************************************/
}

/******************************************************************************/
/******************************************************************************/