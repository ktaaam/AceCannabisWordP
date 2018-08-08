<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://philsbury.uk
 * @since      1.0.0
 *
 * @package    Age_Gate
 * @subpackage Age_Gate/admin/partials
 */

$roles = wp_get_current_user()->roles;

?>

<?php //This file should primarily consist of HTML with a little bit of PHP. ?>
<?php $activeTab = (isset($_GET['tab']) ? $_GET['tab'] : 'general'); ?>

<div class="wrap">
  <h2><?php echo esc_html( get_admin_page_title() ); ?></h2>

  <h2 class="nav-tab-wrapper">
    <a href="admin.php?page=age-gate" class="nav-tab<?php echo ($activeTab === 'general' ? ' nav-tab-active' : ''); ?>">Settings</a>
    <?php if (in_array('administrator', $roles)): ?>
    <a href="admin.php?page=age-gate&amp;tab=css" class="nav-tab<?php echo ($activeTab === 'css' ? ' nav-tab-active' : ''); ?>">Styling</a>
    <?php endif ?>
    <a href="admin.php?page=age-gate&amp;tab=about" class="nav-tab<?php echo ($activeTab === 'about' ? ' nav-tab-active' : ''); ?>">About</a>    
  </h2>

  <?php if ($activeTab === 'general'): ?>
    <?php settings_errors(); ?>

    <form action="<?php echo admin_url() ?>options.php" method="post">
      
      <?php 
        settings_fields($this->plugin_name . '_' .  $activeTab );
        do_settings_sections( $this->plugin_name . '_' .  $activeTab );


        submit_button();
       ?>
    </form>
  <?php elseif($activeTab === 'css' && in_array('administrator', $roles)): ?>
  <div class="wrap">
    <h1><?php esc_attr_e( 'Styling information', $this->plugin_name ); ?></h1>

    <p><?php esc_attr_e( 'If you want to add your own styles to the age gate, classes have been added to the elements to make it easy for you. You can either overload the base styles or create your own custom CSS by disabling the "Layout" option in the', $this->plugin_name ); ?> <a href="admin.php?page=age-gate#wp_age_gate_text_colour"><?php esc_attr_e( 'settings', $this->plugin_name); ?></a></p>

    <p><?php esc_attr_e( 'Note that not all classes will be present based on your configuration.', $this->plugin_name ); ?></p>

    <?php include AGE_GATE_DIR . 'admin/partials/extras/css-ref.php'; ?>
    
  </div>
  <?php elseif($activeTab === 'about'): ?>
  <div class="wrap">
    <h1><?php esc_attr_e( 'Info', $this->plugin_name ); ?></h1>

    <div id="poststuff">

      <div id="post-body" class="metabox-holder columns-2">

        <!-- main content -->
        <div id="post-body-content">

          <div class="meta-box-sortables ui-sortable">

            <div class="postbox">

              <h2><span><?php _e( 'Troubleshooting', $this->plugin_name ); ?></span></h2>
              <div class="inside">
                <p><?php _e(
                    'With so many combinations of themes and plugins in Wordpress, issues will always crop up from time to time. If you find an issue, please create a <a href="https://wordpress.org/support/plugin/age-gate" title="Support forum">support topic</a>, if possible with a link to your issue as it&rsquo;s always easier to debug that way - and any info on settings, plugins, themes etc as it will speed up resolving prolems',
                    $this->plugin_name
                  ); ?></p>
              </div>

              <h2><span><?php esc_attr_e( 'Known issues', $this->plugin_name ); ?></span></h2>

              <div class="inside">
                <ul class="ul-disc">
                  <li><?php esc_attr_e( 'If using WPeCommerce, only the "Cache Bypass" version is available', $this->plugin_name ); ?></li>
                </ul>
              </div>

              <h2><span><?php esc_attr_e( 'Change log', $this->plugin_name ); ?></span></h2>

              <div class="inside">
                <?php include AGE_GATE_DIR . 'admin/partials/extras/change-log.php'; ?>
              </div>
              
              <!-- .inside -->

            </div>
            <!-- .postbox -->

          </div>
          <!-- .meta-box-sortables .ui-sortable -->

        </div>
        <!-- post-body-content -->

        <!-- sidebar -->
        <div id="postbox-container-1" class="postbox-container">
          <div class="meta-box-sortables">

            <div class="postbox">
              
              <h2><span><?php esc_attr_e(
                    'Plugin', $this->plugin_name
                  ); ?></span></h2>

              <div class="inside">
                <p><strong>Version:</strong> <?php echo $this->plugin_info['Version']; ?></p>
                
              </div>
            </div>
          </div>
          <div class="meta-box-sortables">

            <div class="postbox">

              <h2><span><?php esc_attr_e(
                    'Donate', $this->plugin_name
                  ); ?></span></h2>

              <div class="inside">
                <p><?php esc_attr_e(
                    'Age gate is free and there are no plans for that to change, no premium extras, just a free plugin. Obviously some time goes into it&rsquo;s upkeep though, so if you want to throw a few pennies into the pot, there&rsquo;ll be no complaints',
                    $this->plugin_name
                  ); ?></p>

                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                <input type="hidden" name="cmd" value="_s-xclick">
                <input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
                ">
                <input type="image" src="https://www.paypalobjects.com/en_GB/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal – The safer, easier way to pay online!">
                <img alt="" border="0" src="https://www.paypalobjects.com/en_GB/i/scr/pixel.gif" width="1" height="1">
                </form>


              </div>
              <!-- .inside -->

            </div>
            <!-- .postbox -->

          </div>
          <!-- .meta-box-sortables -->

        </div>
        <!-- #postbox-container-1 .postbox-container -->

      </div>
      <!-- #post-body .metabox-holder .columns-2 -->

      <br class="clear">
    </div>
    <!-- #poststuff -->

  </div> <!-- .wrap -->
  <?php else: ?>
  <h1><?php _e( 'Sorry, can&rsquo;t find that page', $this->plugin_name ); ?></h1>
  <?php endif ?>
  

  

</div>