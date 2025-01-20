<?php

/******************************************************************************/
/******************************************************************************/

class CHBSPluginCPT
{
	/**************************************************************************/	
	
	function __construct()
	{
		$this->pluginCPT=array
		(
			1=>array
			(
				'name'=>CHBSBooking::getCPTName(),
				'label'=>__('Bookings','chauffeur-booking-system-extension-import-export')
			),
			2=>array
			(
				'name'=>CHBSBookingForm::getCPTName(),
				'label'=>__('Booking Forms','chauffeur-booking-system-extension-import-export')
			),
			3=>array
			(
				'name'=>CHBSBookingExtra::getCPTName(),
				'label'=>__('Booking Extras','chauffeur-booking-system-extension-import-export')
			),
			4=>array
			(
				'name'=>CHBSRoute::getCPTName(),
				'label'=>__('Routes','chauffeur-booking-system-extension-import-export')
			),
			5=>array
			(
				'name'=>CHBSVehicle::getCPTName(),
				'label'=>__('Vehicles','chauffeur-booking-system-extension-import-export')
			),
			6=>array
			(
				'name'=>CHBSVehicleAttribute::getCPTName(),
				'label'=>__('Vehicle Attributes','chauffeur-booking-system-extension-import-export')
			),
			7=>array
			(
				'name'=>CHBSVehicleCompany::getCPTName(),
				'label'=>__('Vehicle Companies','chauffeur-booking-system-extension-import-export')
			),
			8=>array
			(
				'name'=>CHBSLocation::getCPTName(),
				'label'=>__('Locations','chauffeur-booking-system-extension-import-export')
			),
			9=>array
			(
				'name'=>CHBSPriceRule::getCPTName(),
				'label'=>__('Pricing Rules','chauffeur-booking-system-extension-import-export')
			),
			10=>array
			(
				'name'=> CHBSAVRule::getCPTName(),
				'label'=>__('Availability Rules','chauffeur-booking-system-extension-import-export')
			),
			11=>array
			(
				'name'=>CHBSDriver::getCPTName(),
				'label'=>__('Drivers','chauffeur-booking-system-extension-import-export')
			),
			12=>array
			(
				'name'=> CHBSCoupon::getCPTName(),
				'label'=>__('Coupons','chauffeur-booking-system-extension-import-export')
			),
			13=>array
			(
				'name'=> CHBSGeofence::getCPTName(),
				'label'=>__('Geofence','chauffeur-booking-system-extension-import-export')
			),
			14=>array
			(
				'name'=> CHBSTaxRate::getCPTName(),
				'label'=>__('Tax Rates','chauffeur-booking-system-extension-import-export')
			),
			15=>array
			(
				'name'=>CHBSEmailAccount::getCPTName(),
				'label'=>__('E-mail Accounts','chauffeur-booking-system-extension-import-export')
			),
			16=>array
			(
				'name'=>CHBSCurrency::getCPTName(),
				'label'=>__('Currencies','chauffeur-booking-system-extension-import-export')
			)
		);
	}
	
	/**************************************************************************/	

	function getDictionary()
	{
		return($this->pluginCPT);
	}
	
	/**************************************************************************/
	
	function getCPTName($index)
	{
		if(!$this->isPluginCPTByIndex($index)) return(false);
		return($this->pluginCPT[$index]['name']);
	}
	
	/**************************************************************************/
	
	function isPluginCPTByIndex($index)
	{
		return(array_key_exists($index,$this->getDictionary()) ? true : false);
	}
	
	/**************************************************************************/	
}

/******************************************************************************/	
/******************************************************************************/	
	
	