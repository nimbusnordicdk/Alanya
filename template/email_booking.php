<?php
$Date = new CHBSDate();
$Length = new CHBSLength();
$Validation = new CHBSValidation();
$BookingFormElement = new CHBSBookingFormElement();

if ((int)$this->data['document_header_exclude'] !== 1) {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

    <head>
<?php
        if (is_rtl()) {
?>
        <style type="text/css">
            body {
                direction: rtl;
            }
        </style>
<?php
        }
?>
    </head>

    <body>
<?php
}
?>
        <table cellspacing="0" cellpadding="0" width="100%" bgcolor="#EEEEEE" <?php echo $this->data['style']['base']; ?>>
            <tr height="50px">
                <td <?php echo $this->data['style']['cell'][3]; ?>></td>
            </tr>

            <tr>
                <td <?php echo $this->data['style']['cell'][3]; ?>>

                    <table cellspacing="0" cellpadding="0" width="600px" border="0" align="center" bgcolor="#FFFFFF" style="border:solid 1px #E1E8ED;padding:50px">
<?php
if ((int)$this->data['document_header_exclude'] !== 1) {
    $logo = CHBSOption::getOption('logo');
    if ($Validation->isNotEmpty($logo)) {
?>
                        <tr>
                            <td <?php echo $this->data['style']['cell'][3]; ?>>
                                <img style="max-width:100%;height:auto;" src="<?php echo esc_attr($logo); ?>" alt=""/>
                                <br/><br/>
                            </td>
                        </tr>						   
<?php
    }
}
?>
                        <tr>
                            <td <?php echo $this->data['style']['header']; ?>><?php esc_html_e('General', 'chauffeur-booking-system'); ?></td>
                        </tr>
                        <tr><td <?php echo $this->data['style']['separator'][3]; ?>></td></tr>
                        <tr>
                            <td <?php echo $this->data['style']['cell'][3]; ?>>
                                <table cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td <?php echo $this->data['style']['cell'][1]; ?>><?php esc_html_e('Title', 'chauffeur-booking-system'); ?></td>
                                        <td <?php echo $this->data['style']['cell'][2]; ?>><?php echo $this->data['booking']['booking_title']; ?></td>
                                    </tr>
<?php
if (array_key_exists('booking_form_name', $this->data['booking'])) {
?>
                                    <tr>
                                        <td <?php echo $this->data['style']['cell'][1]; ?>><?php esc_html_e('Booking form name', 'chauffeur-booking-system'); ?></td>
                                        <td <?php echo $this->data['style']['cell'][2]; ?>><?php echo $this->data['booking']['booking_form_name']; ?></td>
                                    </tr>	 
<?php		  
}
?>
                                    <tr>
                                        <td <?php echo $this->data['style']['cell'][1]; ?>><?php esc_html_e('Status', 'chauffeur-booking-system'); ?></td>
                                        <td <?php echo $this->data['style']['cell'][2]; ?>><?php echo esc_html($this->data['booking']['booking_status_name']); ?></td>
                                    </tr>
                                    <tr>
                                        <td <?php echo $this->data['style']['cell'][1]; ?>><?php esc_html_e('Service type', 'chauffeur-booking-system'); ?></td>
                                        <td <?php echo $this->data['style']['cell'][2]; ?>><?php echo esc_html($this->data['booking']['service_type_name']); ?></td>
                                    </tr>	
                                    <tr>
                                        <td <?php echo $this->data['style']['cell'][1]; ?>><?php esc_html_e('Transfer type', 'chauffeur-booking-system'); ?></td>
                                        <td <?php echo $this->data['style']['cell'][2]; ?>><?php echo esc_html($this->data['booking']['transfer_type_name']); ?></td>
                                    </tr>
                                    <tr>
                                        <td <?php echo $this->data['style']['cell'][1]; ?>><?php esc_html_e('Pickup date and time', 'chauffeur-booking-system'); ?></td>
                                        <td <?php echo $this->data['style']['cell'][2]; ?>><?php echo esc_html($Date->formatDateToDisplay($this->data['booking']['meta']['pickup_date']) . ' ' . $Date->formatTimeToDisplay($this->data['booking']['meta']['pickup_time'])); ?></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr height="50px">
                <td <?php echo $this->data['style']['cell'][3]; ?>></td>
            </tr>
        </table> 
<?php
if ((int)$this->data['document_header_exclude'] !== 1) {
?>
    </body>
</html>
<?php
} else {
    echo '<br style="height:40px;">';
}
?>