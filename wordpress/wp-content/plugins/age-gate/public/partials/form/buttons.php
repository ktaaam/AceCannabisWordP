<?php if(isset($settings["wp_age_gate_yes_no_message"]) && !empty($settings['wp_age_gate_yes_no_message'])): ?>
<p class="age-gate-confirm-message"><?php printf(__($settings['wp_age_gate_yes_no_message'], 'age-gate'), $settings['wp_age_gate_min_age']); ?></p>
<?php endif; ?>

<button type="submit" value="yes" name="confirm" class="age-gate-submit-yes"><?php _e('Yes', 'age-gate'); ?></button>
<button type="submit" value="no" name="confirm" class="age-gate-submit-no"><?php _e('No', 'age-gate'); ?></button>

