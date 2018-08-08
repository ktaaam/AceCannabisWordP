<?php include AGE_GATE_DIR . 'public/partials/head/js-template.php'; ?>
<script>

  var ag = {
    a: <?php echo $this->settings['wp_age_gate_min_age'] ?>,
    r: <?php echo ($this->_ageRestricted()) ? 1 : 0; ?>,
    t: '<?php echo $this->settings["wp_age_gate_input_type"] ?>',
    f: '<?php echo $this->settings["wp_age_gate_date_format"] ?>',
    instruction: "<?php echo __($this->settings['wp_age_gate_instruction']); ?>",
    messaging: "<?php echo __($this->settings['wp_age_gate_messaging']); ?>",
    remember: <?php echo (isset($this->settings['wp_age_gate_remember']) && !empty($this->settings['wp_age_gate_remember'])) ? 1 : 0; ?>,
    auto_remember: <?php echo (isset($this->settings['wp_age_gate_remember_auto_check']) && !empty($this->settings['wp_age_gate_remember_auto_check'])) ? 1 : 0; ?>,
    remember_days: <?php echo (isset($this->settings['wp_age_gate_remember_days']) && $this->settings['wp_age_gate_remember_days'] > 0) ? $this->settings['wp_age_gate_remember_days'] : 365; ?>,
    errors: {
      1: "<?php printf(__($this->settings['wp_age_gate_invalid_input_msg']), $this->settings['wp_age_gate_min_age']); ?>",
      2: "<?php printf(__($this->settings['wp_age_gate_under_age_msg']), $this->settings['wp_age_gate_min_age']); ?>",
      3: "<?php printf(__($this->settings['wp_age_gate_generic_error_msg']), $this->settings['wp_age_gate_min_age']); ?>"},
    nsc: <?php echo (isset($this->settings['wp_age_gate_no_second_chance']) && !empty($this->settings['wp_age_gate_no_second_chance'])) ? 1 : 0; ?>,
    update_title: <?php echo (isset($this->settings['wp_age_gate_switch_title']) && !empty($this->settings['wp_age_gate_switch_title']) ? 1 : 0); ?>
  }
</script>


