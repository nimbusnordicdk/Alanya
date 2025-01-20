		
		<ul class="to-form-field-list">
			<li>
				<div class="to-notice-small to-notice-small-info">
					<?php echo sprintf(__('If you purchased the standalone "Chauffeur Booking System for WordPress" plugin version from the <a href="%s" target="_blank">CodeCanyon</a>, you need to enter purchase code from the plugin license file. If you purchased this plugin together with the "AutoRide - Chauffeur Limousine Booking WordPress Theme" theme from the <a href="%s" target="_blank">ThemeForest</a>, you need to enter purchase code from theme license file.','chauffeur-booking-system'),'https://1.envato.market/chauffeur-booking-system-for-wordpress','https://1.envato.market/autoride-chauffeur-booking-wordpress-theme'); ?>
				</div>
				<h5><?php esc_html_e('License details','chauffeur-booking-system'); ?></h5>
				<span class="to-legend">
					<?php echo sprintf(__('Enter the license details. You can find all required information in the <a href="%s" target="_blank">License Certificate</a> PDF document.','chauffeur-booking-system'),'https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code'); ?><br/>
				</span>
				<div class="to-clear-fix">
					<span class="to-legend-field"><?php esc_html_e('Purchase code.','chauffeur-booking-system'); ?></span>
					<input type="text" name="<?php CHBSHelper::getFormName('license_purchase_code'); ?>" id="<?php CHBSHelper::getFormName('license_purchase_code'); ?>" value="<?php echo esc_attr($this->data['option']['license_purchase_code']); ?>"/>
				</div>
				<div class="to-clear-fix">
					<span class="to-legend-field"><?php esc_html_e('Buyer\'s Envato username.','chauffeur-booking-system'); ?></span>
					<input type="text" name="<?php CHBSHelper::getFormName('license_username'); ?>" id="<?php CHBSHelper::getFormName('license_username'); ?>" value="<?php echo esc_attr($this->data['option']['license_username']); ?>"/>
				</div>
			</li> 
		</ul>
