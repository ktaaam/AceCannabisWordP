<script id="tmpl-wp-age-gate" type="text/twig">

<div class="age-gate">
  <form method="post" action="" class="age-gate-form"<?php echo (isset($this->settings['wp_age_gate_fail_link']) && !empty($this->settings['wp_age_gate_fail_link'])) ? ' data-redirect="' . $this->settings['wp_age_gate_fail_link'] . '"' : ''; ?>>
    <input type="hidden" name="age-submit" value="1" />
    <?php if (isset($this->settings['wp_age_gate_logo']) && $this->settings['wp_age_gate_logo']): ?>
    <h1 class="age-gate-heading age-gate-logo"><img src="<?php echo wp_get_attachment_url($this->settings['wp_age_gate_logo']); ?>" alt="<?php echo bloginfo('name'); ?>" /></h1>
    <?php else: ?>
    <h1 class="age-gate-heading"><?php echo __(bloginfo('name')); ?></h1>
    <?php endif ?>
    {% if not under and nsc or not nsc %}
      {% if instruction %}
        <h2 class="age-gate-subheading">{{ instruction }}</h2>
      {% endif %}
      {% if messaging %}
      <p class="age-gate-message">{{ messaging|format(a) }}</p>
      {% endif %}
    

      {% include "tmpl-wp-age-gate-form-" ~ t %}
    {% endif %}

    <div class="error{% if under and nsc %} under{% endif%}">
    {% if under and nsc %}
    <p class="age-gate-error"><?php _e('You are not old enough to view this content', 'age-gate'); ?></p>
    {% endif %}
    </div>

    {% if not under and nsc or not nsc %}
    {% if remember %}
    <p class="age-gate-remember-wrapper"><label class="remember"><input type="checkbox" value="1" name="remember"{% if auto_remember %} checked{% endif %}> <?php _e('Remember me', 'age-gate'); ?></label></p>
    {% endif %}

    {% if t != 'buttons' %}
    <button class="age-gate-submit" type="submit"><?php echo esc_html($this->settings['wp_age_gate_button_text']) ?></button>
    {% endif %}
    {% endif %}

    <?php if(isset($this->settings['wp_age_gate_additional'])): ?>
    <div class="age-gate-additional-information">
      <?php echo wpautop(wp_specialchars_decode(__($this->settings['wp_age_gate_additional']))) ?>
    </div>
    <?php endif; ?>
  </form>
</div>

</script>

<script id="tmpl-wp-age-gate-form-inputs" type="text/twig">
  <ul class="age-gate-form-elements">
    <?php if ($this->settings['wp_age_gate_date_format'] == 'mmddyyyy'){
      include AGE_GATE_DIR . 'public/partials/form/sections/input-month.php';
      echo "\r\n";
      include AGE_GATE_DIR . 'public/partials/form/sections/input-day.php';

    } else {
      include AGE_GATE_DIR . 'public/partials/form/sections/input-day.php';
      echo "\r\n";
      include AGE_GATE_DIR . 'public/partials/form/sections/input-month.php';
      
    }
    ?>
    <li class="age-gate-form-section">
      <label class="age-gate-label" for="dob-year"><?php _e('Year', 'age-gate'); ?></label>
      <input class="age-gate-input" type="text" id="dob-year" name="year" placeholder="<?php _e('YYYY', 'aget-gate'); ?>" required minlength="4" maxlength="4" pattern="\d+" autocomplete="off">
    </li>
  </ul>
</script>

<script id="tmpl-wp-age-gate-form-selects" type="text/twig">

<ul class="age-gate-form-elements">
  <?php if ($this->settings['wp_age_gate_date_format'] == 'mmddyyyy'){
    include AGE_GATE_DIR . 'public/partials/form/sections/select-month.php';
    echo "\r\n";
    include AGE_GATE_DIR . 'public/partials/form/sections/select-day.php';

  } else {
    include AGE_GATE_DIR . 'public/partials/form/sections/select-day.php';
    echo "\r\n";
    include AGE_GATE_DIR . 'public/partials/form/sections/select-month.php';
    
  }
  ?>

  <li class="age-gate-form-section">
    <label class="age-gate-label" for="dob-year"><?php _e('Year', 'age-gate'); ?></label>
    <select class="age-gate-input" type="text" id="dob-year" name="year" required>
      <option value=""><?php _e('YYYY', 'aget-gate'); ?></option>
      <?php for ($i = date('Y'); $i >= 1900; $i--): ?>
      <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
      <?php endfor; ?>
    </select>
    
  </li>
</ul>

</script>

<script id="tmpl-wp-age-gate-form-buttons" type="text/twig">
  
  <?php if(isset($this->settings["wp_age_gate_yes_no_message"]) && !empty($this->settings['wp_age_gate_yes_no_message'])): ?>
  <p class="age-gate-confirm-message"><?php printf(__($this->settings['wp_age_gate_yes_no_message'], 'age-gate'), $this->settings['wp_age_gate_min_age']); ?></p>
  <?php endif; ?>

  <button type="submit" value="yes" class="age-gate-submit-yes" name="confirm"><?php _e('Yes', 'age-gate'); ?></button>
  <button type="submit" value="no" class="age-gate-submit-no" name="confirm"><?php _e('No', 'age-gate'); ?></button>

</script>

<script type="text/twig" id="tmpl-wp-age-gate-error">
  <p class="age-gate-error">{{ error }}</p>
</script>