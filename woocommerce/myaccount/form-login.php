<?php

/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( is_user_logged_in() || 'no' === get_option( 'woocommerce_enable_checkout_login_reminder' ) ) {
	return;
}
$select_header = get_post_meta(get_the_ID(), 'wiki_test_select', true);
if ('header' === $select_header) {
	get_template_part('template/index', 'header');
}
$select_header1 = get_post_meta(get_the_ID(), 'wiki_test_select', true);
if ('header-1' === $select_header1) {
	get_template_part('template/index', 'header2');
}
$select_header2 = get_post_meta(get_the_ID(), 'wiki_test_select', true);
if ('header-2' === $select_header2) {
	get_template_part('template/push', 'menu');
}
if ($elementor_header = get_post_meta(get_the_ID(), 'header-elementor-select', true)) {
	$id_post = (int)$elementor_header;
	$post = get_post($id_post);
	echo apply_filters('the_content', $post->post_content);
}

do_action('woocommerce_before_customer_login_form'); ?>

<?php if ('yes' === get_option('woocommerce_enable_myaccount_registration')) : ?>
	<section class="login-netflibs-web py-5">
		<div class="container">
			<div class="u-columns col2-set row justify-content-center" id="customer_login">

				<div class="u-column1 col-12 col-md-6 zshow" id="login-box">
					<div class="login-portfol">
					<?php endif; ?>

					<h2 class="text-center"><?php esc_html_e('Login', 'woocommerce'); ?></h2>

					<form class="woocommerce-form woocommerce-form-login login" method="post">

						<?php do_action('woocommerce_login_form_start'); ?>

						<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
							<label for="username"><?php esc_html_e('Username or email address', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
							<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" autocomplete="username" value="<?php echo (!empty($_POST['username'])) ? esc_attr(wp_unslash($_POST['username'])) : ''; ?>" /><?php // @codingStandardsIgnoreLine 
																																																?>
						</p>
						<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
							<label for="password"><?php esc_html_e('Password', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
							<input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" autocomplete="current-password" />
						</p>

						<?php do_action('woocommerce_login_form'); ?>

						<p class="form-row">
							<label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
								<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span><?php esc_html_e('Remember me', 'woocommerce'); ?></span>
							</label>
							<?php wp_nonce_field('woocommerce-login', 'woocommerce-login-nonce'); ?>
							<button type="submit" class="woocommerce-button button woocommerce-form-login__submit" name="login" value="<?php esc_attr_e('Log in', 'woocommerce'); ?>"><?php esc_html_e('Log in', 'woocommerce'); ?></button>
						</p>
						<p class="woocommerce-LostPassword lost_password">
							<a href="<?php echo esc_url(wp_lostpassword_url()); ?>"><?php esc_html_e('Lost your password?', 'woocommerce'); ?></a>
						</p>

						<?php do_action('woocommerce_login_form_end'); ?>

					</form>

					<?php if ('yes' === get_option('woocommerce_enable_myaccount_registration')) : ?>
						<div class="d-flex justify-content-between align-items-center box-rl">
							<p>حساب کاربری ندارید؟</p>
							<button id="register-account" class="stl-btn">ثبت نام</button>
						</div>
					</div>
				</div>

				<div id="register-box" class="u-column2 col-12 col-md-6 d-none">
					<div class="login-portfol">
						<h2 class="text-center"><?php esc_html_e('Register', 'woocommerce'); ?></h2>

						<form method="post" class="woocommerce-form woocommerce-form-register register" <?php do_action('woocommerce_register_form_tag'); ?>>

							<?php do_action('woocommerce_register_form_start'); ?>

							<?php if ('no' === get_option('woocommerce_registration_generate_username')) : ?>

								<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
									<label for="reg_username"><?php esc_html_e('Username', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
									<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" autocomplete="username" value="<?php echo (!empty($_POST['username'])) ? esc_attr(wp_unslash($_POST['username'])) : ''; ?>" /><?php // @codingStandardsIgnoreLine 
																																																			?>
								</p>

							<?php endif; ?>

							<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
								<label for="reg_email"><?php esc_html_e('Email address', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
								<input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email" value="<?php echo (!empty($_POST['email'])) ? esc_attr(wp_unslash($_POST['email'])) : ''; ?>" /><?php // @codingStandardsIgnoreLine 
																																																?>
							</p>

							<?php if ('no' === get_option('woocommerce_registration_generate_password')) : ?>

								<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
									<label for="reg_password"><?php esc_html_e('Password', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
									<input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" autocomplete="new-password" />
								</p>

							<?php else : ?>

								<p><?php esc_html_e('A password will be sent to your email address.', 'woocommerce'); ?></p>

							<?php endif; ?>

							<?php do_action('woocommerce_register_form'); ?>

							<p class="woocommerce-form-row form-row">
								<?php wp_nonce_field('woocommerce-register', 'woocommerce-register-nonce'); ?>
								<button type="submit" class="woocommerce-Button woocommerce-button button woocommerce-form-register__submit" name="register" value="<?php esc_attr_e('Register', 'woocommerce'); ?>"><?php esc_html_e('Register', 'woocommerce'); ?></button>
							</p>

							<?php do_action('woocommerce_register_form_end'); ?>

						</form>
						<div class="d-flex justify-content-between align-items-center box-rl">
							<p class="">حساب کاربری دارید؟</p>
							<button id="login-account"  class="stl-btn">ورود</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>

<?php do_action('woocommerce_after_customer_login_form'); ?>
<?php

$select_footer = get_post_meta(get_the_ID(), 'wiki_footer_select', true);
if ('footer_1' === $select_footer) {
	get_template_part('template/index', 'footer');
}
$select_value = get_post_meta(get_the_ID(), 'wiki_test_select', true);
if ('footer_2' === $select_footer) {
	get_template_part('template/index', 'footer2');
}
$select_value = get_post_meta(get_the_ID(), 'wiki_test_select', true);
if ('footer_3' === $select_footer) {
	get_template_part('template/index', 'footer_3');
}

if ($elementor_footer = get_post_meta(get_the_ID(), 'footer_elementor_select', true)) {
	$id_post = (int)$elementor_footer;
	$term = get_post((int)$elementor_footer);
	$post = get_post($id_post);
	echo apply_filters('the_content', $post->post_content);
}
?>