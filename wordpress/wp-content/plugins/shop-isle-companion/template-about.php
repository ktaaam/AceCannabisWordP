<?php
/**
 * The template for displaying about us page.
 *
 * Template Name: About us page
 *
 * @package WordPress
 * @subpackage Shop Isle
 */

get_header(); ?>
	<!-- Wrapper start -->
	<div class="main">
	
		<!-- Header section start -->
		<?php
		$shop_isle_header_image = get_the_post_thumbnail_url();
		if ( empty( $shop_isle_header_image ) ) {
			$shop_isle_header_image = get_header_image();
		}
		?>
		<section class="page-header-module module bg-dark" 
		<?php
		if ( ! empty( $shop_isle_header_image ) ) {
			echo ' data-background="' . esc_url( $shop_isle_header_image ) . '"';
		}
		?>
		>
			<div class="container">
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1">
						<h1 class="module-title font-alt"><?php the_title(); ?></h1>
						<?php
						/* Header description */
						$shop_isle_shop_id = get_the_ID();
						if ( ! empty( $shop_isle_shop_id ) ) {
							$shop_isle_page_description = get_post_meta( $shop_isle_shop_id, 'shop_isle_page_description' );
							if ( ! empty( $shop_isle_page_description[0] ) ) {
								echo '<div class="module-subtitle font-serif mb-0">' . wp_kses_post( $shop_isle_page_description[0] ) . '</div>';
							}
						}
						?>
					</div>
				</div><!-- .row -->
			</div><!-- .container -->
		</section><!-- .page-header-module -->
		<!-- Header section end -->
				
		<!-- About start -->
		<?php
		$shop_isle_content_aboutus = '';
		if ( have_posts() ) {
			while ( have_posts() ) {
				the_post();
				$shop_isle_content_aboutus = get_the_content();
			}
		}

		if ( trim( $shop_isle_content_aboutus ) != '' ) {
			echo '<section class="module">';
				echo '<div class="container">';
					echo '<div class="row">';
						echo '<div class="col-sm-12">';
							the_content();
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</section>';
		}
		?>
		<!-- About end -->
				
		<!-- Divider -->
		<hr class="divider-w">
		<!-- Divider -->

		<!-- Team start -->
		<section class="module">
			<div class="container">
				<?php
				$shop_isle_our_team_title = get_theme_mod( 'shop_isle_our_team_title', __( 'Meet our team', 'shop-isle' ) );
				$shop_isle_our_team_subtitle = get_theme_mod( 'shop_isle_our_team_subtitle',__( 'An awesome way to introduce the members of your team.', 'shop-isle' ) );

				if ( ! empty( $shop_isle_our_team_title ) || ! empty( $shop_isle_our_team_subtitle ) ) {

					echo '<div class="row">';
					echo '<div class="col-sm-6 col-sm-offset-3">';

					if ( ! empty( $shop_isle_our_team_title ) ) {
						echo '<h2 class="module-title font-alt meet-out-team-title">' . wp_kses_post( $shop_isle_our_team_title ) . '</h2>';
					}

					if ( ! empty( $shop_isle_our_team_subtitle ) ) {
						echo '<div class="module-subtitle font-serif meet-out-team-subtitle">';
						echo wp_kses_post( $shop_isle_our_team_subtitle );
						echo '</div>';
					}

					echo '</div>';
					echo '</div><!-- .row -->';
				}

				$shop_isle_team_members = get_theme_mod(
					'shop_isle_team_members',json_encode(
						array(
							array(
								'image_url' => get_template_directory_uri() . '/assets/images/team1.jpg',
								'text' => 'Eva Bean',
								'subtext' => 'Developer',
								'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit lacus, a iaculis diam.',
							),
							array(
								'image_url' => get_template_directory_uri() . '/assets/images/team2.jpg',
								'text' => 'Maria Woods',
								'subtext' => 'Designer',
								'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit lacus, a iaculis diam.',
							),
							array(
								'image_url' => get_template_directory_uri() . '/assets/images/team3.jpg',
								'text' => 'Booby Stone',
								'subtext' => 'Director',
								'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit lacus, a iaculis diam.',
							),
							array(
								'image_url' => get_template_directory_uri() . '/assets/images/team4.jpg',
								'text' => 'Anna Neaga',
								'subtext' => 'Art Director',
								'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit lacus, a iaculis diam.',
							),
						)
					)
				);

				if ( ! empty( $shop_isle_team_members ) ) {
					$shop_isle_team_members_decoded = json_decode( $shop_isle_team_members );
					if ( ! empty( $shop_isle_team_members_decoded ) ) {
						echo '<div class="row">';
						echo '<div class="hero-slider about-team-member">';
						echo '<ul class="slides">';
						foreach ( $shop_isle_team_members_decoded as $shop_isle_team_member ) {
							$image_url = ! empty( $shop_isle_team_member->image_url ) ? apply_filters( 'shop_isle_translate_single_string', $shop_isle_team_member->image_url, 'Team section' ) : '';
							$text = ! empty( $shop_isle_team_member->text ) ? apply_filters( 'shop_isle_translate_single_string', $shop_isle_team_member->text, 'Team section' ) : '';
							$description = ! empty( $shop_isle_team_member->description ) ? apply_filters( 'shop_isle_translate_single_string', $shop_isle_team_member->description, 'Team section' ) : '';
							$subtext = ! empty( $shop_isle_team_member->subtext ) ? apply_filters( 'shop_isle_translate_single_string', $shop_isle_team_member->subtext, 'Team section' ) : '';

							echo '<div class="col-sm-6 col-md-3 mb-sm-20 fadeInUp">';
							echo '<div class="team-item">';

							echo '<div class="team-image">';
							if ( ! empty( $image_url ) ) {
								if ( ! empty( $text ) ) {
									echo '<img src="' . esc_url( $image_url ) . '" alt="' . esc_html( $text ) . '">';
								} else {
									echo '<img src="' . esc_url( $image_url ) . '" alt="">';
								}
							}
							if ( ! empty( $description ) ) {
								echo '<div class="team-detail">';
								echo '<p class="font-serif">' . wp_kses_post( $description ) . '</p>';
								echo '</div><!-- .team-detail -->';
							}
							echo '</div><!-- .team-image -->';

							echo '<div class="team-descr font-alt">';
							if ( ! empty( $text ) ) {
								echo '<div class="team-name">' . wp_kses_post( $text ) . '</div>';
							}
							if ( ! empty( $subtext ) ) {
								echo '<div class="team-role">' . wp_kses_post( $subtext ) . '</div>';
							}
							echo '</div><!-- .team-descr -->';

							echo '</div><!-- .team-item -->';
							echo '</div><!-- .col-sm-6 col-md-3 mb-sm-20 fadeInUp -->';
						}
						echo '</ul>';
						echo '</div>';
						echo '</div>';
					}
				}
				?>
			</div>
		</section>
		<!-- Team end -->
				
		<!-- Video start -->
		<?php
		$shop_isle_about_page_video_background = get_theme_mod( 'shop_isle_about_page_video_background',get_template_directory_uri() . '/assets/images/background-video.jpg' );
		?>
		<section class="module bg-dark-60 about-page-video" 
		<?php
		if ( ! empty( $shop_isle_about_page_video_background ) ) {
			echo 'data-background="' . esc_url( $shop_isle_about_page_video_background ) . '"';}
?>
>
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<div class="video-box">
							<?php
							$shop_isle_about_page_video_link = get_theme_mod( 'shop_isle_about_page_video_link' );
							if ( ! empty( $shop_isle_about_page_video_link ) ) :
								echo '<div class="video-box-icon">';
								echo '<a href="' . esc_url( $shop_isle_about_page_video_link ) . '" class="video-pop-up"><span class="social_youtube_square"></span></a>';
								echo '</div>';
							endif;
							if ( empty( $shop_isle_about_page_video_link ) && is_customize_preview() ) :
								echo '<div class="video-box-icon shop_isle_hidden_if_not_customizer">';
								echo '<a href="' . esc_url( $shop_isle_about_page_video_link ) . '" class="video-pop-up"><span class="social_youtube_square"></span></a>';
								echo '</div>';
							endif;

							$shop_isle_about_page_video_title = get_theme_mod( 'shop_isle_about_page_video_title',__( 'Presentation', 'shop-isle' ) );
							$shop_isle_about_page_video_subtitle = get_theme_mod( 'shop_isle_about_page_video_subtitle',__( 'What the video about our new products', 'shop-isle' ) );

							if ( ! empty( $shop_isle_about_page_video_title ) ) :
								echo '<div class="video-title font-alt">' . wp_kses_post( $shop_isle_about_page_video_title ) . '</div>';
							endif;

							if ( ! empty( $shop_isle_about_page_video_subtitle ) ) :
								echo '<div class="video-subtitle font-alt">' . wp_kses_post( $shop_isle_about_page_video_subtitle ) . '</div>';
							endif;
							?>
						</div>
					</div>
				</div><!-- .row -->
			</div>
		</section>
		<!-- Video end -->

		<!-- Features start -->
		<section class="module module-advantages">
			<div class="container">
				<?php
				$shop_isle_our_advantages_title = get_theme_mod( 'shop_isle_our_advantages_title',__( 'Our advantages', 'shop-isle' ) );
				if ( ! empty( $shop_isle_our_advantages_title ) ) :
					echo '<div class="row">';
						echo '<div class="col-sm-6 col-sm-offset-3">';
							echo '<h2 class="module-title font-alt our_advantages">' . wp_kses_post( $shop_isle_our_advantages_title ) . '</h2>';
						echo '</div>';
					echo '</div>';
				endif;

				$shop_isle_advantages = get_theme_mod(
					'shop_isle_advantages',json_encode(
						array(
							array(
								'icon_value' => 'icon_lightbulb',
								'text' => __( 'Ideas and concepts','shop-isle' ),
								'subtext' => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.','shop-isle' ),
							),
							array(
								'icon_value' => 'icon_tools',
								'text' => __( 'Designs & interfaces','shop-isle' ),
								'subtext' => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.','shop-isle' ),
							),
							array(
								'icon_value' => 'icon_cogs',
								'text' => __( 'Highly customizable','shop-isle' ),
								'subtext' => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.','shop-isle' ),
							),
							array(
								'icon_value' => 'icon_like',
								'text' => __( 'Easy to use','shop-isle' ),
								'subtext' => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.','shop-isle' ),
							),
						)
					)
				);

				if ( ! empty( $shop_isle_advantages ) ) :

					$shop_isle_advantages_decoded = json_decode( $shop_isle_advantages );

					if ( ! empty( $shop_isle_advantages_decoded ) ) :

						echo '<div class="row multi-columns-row">';

						foreach ( $shop_isle_advantages_decoded as $shop_isle_advantage ) :

							$icon_value = ! empty( $shop_isle_advantage->icon_value ) ? apply_filters( 'shop_isle_translate_single_string', $shop_isle_advantage->icon_value, 'Advantages section' ) : '';
							$text = ! empty( $shop_isle_advantage->text ) ? apply_filters( 'shop_isle_translate_single_string', $shop_isle_advantage->text, 'Advantages section' ) : '';
							$subtext = ! empty( $shop_isle_advantage->subtext ) ? apply_filters( 'shop_isle_translate_single_string', $shop_isle_advantage->subtext, 'Advantages section' ) : '';

							echo '<div class="col-sm-6 col-md-3 col-lg-3">';
							echo '<div class="features-item">';


							if ( ! empty( $icon_value ) ) :
								echo '<div class="features-icon">';
								echo '<span class="' . esc_attr( $icon_value ) . '"></span>';
								echo '</div>';
								endif;

							if ( ! empty( $text ) ) :
								echo '<h3 class="features-title font-alt">' . wp_kses_post( $text ) . '</h3>';
								endif;

							if ( ! empty( $subtext ) ) :
								echo wp_kses_post( $subtext );
								endif;

							echo '</div>';
							echo '</div>';

							endforeach;

						echo '</div>';
					endif;
				endif;
				?>
			</div><!-- .container -->
		</section>
		<!-- Features end -->
	
<?php get_footer(); ?>
