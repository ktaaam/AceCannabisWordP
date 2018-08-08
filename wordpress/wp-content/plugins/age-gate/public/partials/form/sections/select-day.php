<li class="age-gate-form-section">
  <label class="age-gate-label" for="dob-day"><?php _e('Day', 'age-gate'); ?></label>
  <select class="age-gate-input" type="text" id="dob-day" name="day" required>
    <option value=""><?php _e('DD', 'age-gate'); ?></option>
    <?php for ($i = 1; $i <= 31; $i++): ?>
    <option value="<?php echo str_pad($i, 2, 0, STR_PAD_LEFT); ?>"><?php echo str_pad($i, 2, 0, STR_PAD_LEFT); ?></option>
    <?php endfor; ?>
  </select>
</li>