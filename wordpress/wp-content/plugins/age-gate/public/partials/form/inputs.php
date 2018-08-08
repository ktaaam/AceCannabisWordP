<ul class="age-gate-form-elements">
  <?php if ($settings['wp_age_gate_date_format'] == 'mmddyyyy'){
    include 'sections/input-month.php';
    echo "\r\n";
    include 'sections/input-day.php';

  } else {
    include 'sections/input-day.php';
    echo "\r\n";
    include 'sections/input-month.php';
    
  }
  ?>
  <li class="age-gate-form-section">
    <label class="age-gate-label" for="dob-year"><?php _e('Year', 'age-gate'); ?></label>
    <input class="age-gate-input" type="text" id="dob-year" name="year" placeholder="<?php _e('YYYY', 'age-gate'); ?>" required minlength="4" maxlength="4" pattern="\d+" autocomplete="off">
  </li>
</ul>

