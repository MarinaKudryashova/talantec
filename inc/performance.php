<?php
/**
 * Front-end performance: jQuery, unused scripts, deferred analytics.
 *
 * @package architect
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Cookie consent: true accepted, false declined, null undecided.
 *
 * @return bool|null
 */
function architect_cookie_consent() {
	if ( ! isset( $_COOKIE['cookieAccepted'] ) ) {
		return null;
	}

	$value = sanitize_text_field( wp_unslash( $_COOKIE['cookieAccepted'] ) );

	if ( $value === 'true' ) {
		return true;
	}

	if ( $value === 'false' ) {
		return false;
	}

	return null;
}

/**
 * Theme JS is vanilla. CF7 6.x does not need jQuery either.
 * Keep jQuery in wp-admin and for logged-in users (admin bar).
 */
function architect_disable_frontend_jquery() {
	if ( is_admin() || is_customize_preview() || is_user_logged_in() ) {
		return;
	}

	wp_dequeue_script( 'jquery' );
	wp_deregister_script( 'jquery' );
	wp_dequeue_script( 'jquery-core' );
	wp_deregister_script( 'jquery-core' );
	wp_dequeue_script( 'jquery-migrate' );
	wp_deregister_script( 'jquery-migrate' );
}
add_action( 'wp_enqueue_scripts', 'architect_disable_frontend_jquery', 100 );

/**
 * Drop unused default scripts that Underscores left in the theme.
 */
function architect_dequeue_unused_scripts() {
	wp_dequeue_script( 'architect-navigation' );
	wp_deregister_script( 'architect-navigation' );
}
add_action( 'wp_enqueue_scripts', 'architect_dequeue_unused_scripts', 20 );

/**
 * Do not print CF7 / wp-i18n / wp-hooks on first paint.
 * Scripts are injected when the form is near the viewport or the user focuses it.
 */
function architect_disable_cf7_global_assets() {
	add_filter( 'wpcf7_load_js', '__return_false', 100 );
	add_filter( 'wpcf7_load_css', '__return_false', 100 );
}
add_action( 'init', 'architect_disable_cf7_global_assets' );

add_action( 'wpcf7_shortcode_callback', 'architect_mark_cf7_present' );
function architect_mark_cf7_present() {
	$GLOBALS['architect_needs_cf7'] = true;
}

function architect_print_delayed_cf7() {
	if ( empty( $GLOBALS['architect_needs_cf7'] ) || ! function_exists( 'wpcf7_plugin_url' ) ) {
		return;
	}

	$cf7_ver = defined( 'WPCF7_VERSION' ) ? WPCF7_VERSION : '6';
	$swv     = wpcf7_plugin_url( 'includes/swv/js/index.js' );
	$cf7     = wpcf7_plugin_url( 'includes/js/index.js' );

	$config = array(
		'api' => array(
			'root'      => esc_url_raw( get_rest_url() ),
			'namespace' => 'contact-form-7/v1',
		),
	);

	if ( defined( 'WP_CACHE' ) && WP_CACHE ) {
		$config['cached'] = 1;
	}
	?>
	<script>
	(function () {
		var forms = document.querySelectorAll('.wpcf7');
		if (!forms.length) return;

		var loaded = false;
		function addScript(src, onload) {
			var s = document.createElement('script');
			s.src = src;
			s.async = false;
			if (onload) s.onload = onload;
			document.body.appendChild(s);
		}

		function loadCF7() {
			if (loaded) return;
			loaded = true;
			window.wp = window.wp || {};
			window.wp.i18n = window.wp.i18n || {
				__: function (str) { return str; },
				_x: function (str) { return str; },
				_n: function (str) { return str; },
				_nx: function (str) { return str; },
				sprintf: function (str) { return str; },
				setLocaleData: function () {},
				isRTL: function () { return false; }
			};
			window.wpcf7 = <?php echo wp_json_encode( $config ); ?>;
			addScript(<?php echo wp_json_encode( $swv . '?ver=' . $cf7_ver ); ?>, function () {
				addScript(<?php echo wp_json_encode( $cf7 . '?ver=' . $cf7_ver ); ?>, bootCF7Forms);
			});
		}

		function bootCF7Forms() {
			if (typeof wpcf7 === 'undefined') {
				return;
			}

			if (typeof wpcf7.init !== 'function') {
				document.dispatchEvent(new Event('DOMContentLoaded'));
				return;
			}

			document.querySelectorAll('.wpcf7 > form').forEach(function (form) {
				if (form.wpcf7) {
					return;
				}
				wpcf7.init(form);
				var wrap = form.closest('.wpcf7');
				if (wrap) {
					wrap.classList.replace('no-js', 'js');
				}
			});
		}

		function isConsentLocked(form) {
			if (!form.closest('[data-graph-target="modal-leadform"]')) {
				return false;
			}
			var checkbox = form.querySelector('.wpcf7-acceptance input[type="checkbox"]');
			return !!(checkbox && !checkbox.checked);
		}

		document.addEventListener('submit', function (e) {
			var form = e.target.closest ? e.target.closest('.wpcf7 form') : null;
			if (!form) {
				return;
			}
			if (isConsentLocked(form)) {
				e.preventDefault();
				e.stopImmediatePropagation();
				return;
			}
			if (window.wpcf7 && typeof wpcf7.submit === 'function' && form.wpcf7) {
				return;
			}
			e.preventDefault();
			loadCF7();
			var tries = 0;
			var wait = setInterval(function () {
				tries += 1;
				if (window.wpcf7 && typeof wpcf7.submit === 'function') {
					clearInterval(wait);
					if (isConsentLocked(form)) {
						return;
					}
					if (!form.wpcf7) {
						wpcf7.init(form);
					}
					wpcf7.submit(form);
				} else if (tries > 50) {
					clearInterval(wait);
				}
			}, 100);
		}, true);

		forms.forEach(function (form) {
			form.addEventListener('pointerdown', loadCF7, { once: true, passive: true });
			form.addEventListener('focusin', loadCF7, { once: true });
		});

		document.addEventListener('click', function (e) {
			if (e.target.closest('[data-graph-path]')) {
				loadCF7();
			}
		});
		document.addEventListener('architect:cf7-needed', loadCF7);

		if ('IntersectionObserver' in window) {
			var io = new IntersectionObserver(function (entries) {
				if (entries.some(function (entry) { return entry.isIntersecting; })) {
					io.disconnect();
					loadCF7();
				}
			}, { rootMargin: '300px 0px' });
			forms.forEach(function (form) { io.observe(form); });
		} else {
			window.addEventListener('load', function () {
				setTimeout(loadCF7, 4000);
			});
		}
	})();
	</script>
	<?php
}
add_action( 'wp_footer', 'architect_print_delayed_cf7', 5 );

/**
 * Delay known analytics URLs if a plugin enqueues them immediately.
 *
 * @param string $tag    Script tag.
 * @param string $handle Script handle.
 * @param string $src    Script URL.
 * @return string
 */
function architect_delay_enqueued_analytics( $tag, $handle, $src ) {
	if ( empty( $src ) ) {
		return $tag;
	}

	$patterns = array(
		'mc.yandex.ru',
		'yandex.ru/metrika',
		'googletagmanager.com',
		'google-analytics.com',
		'gtag/js',
	);

	$is_analytics = false;
	foreach ( $patterns as $pattern ) {
		if ( strpos( $src, $pattern ) !== false ) {
			$is_analytics = true;
			break;
		}
	}

	if ( ! $is_analytics ) {
		return $tag;
	}

	$safe_src = esc_url( $src );

	return sprintf(
		'<script>(function(){var done=false;function load(){if(done)return;done=true;var s=document.createElement("script");s.src="%1$s";s.async=true;document.head.appendChild(s);}function hasConsent(){try{if(localStorage.getItem("cookieAccepted")==="true")return true;}catch(e){}return document.cookie.split("; ").indexOf("cookieAccepted=true")!==-1;}window.addEventListener("architect:cookie-consent",function(e){if(e.detail&&e.detail.accepted)load();});if(hasConsent()){window.addEventListener("load",function(){setTimeout(load,3500);});}})();</script>' . "\n",
		esc_js( $safe_src )
	);
}
add_filter( 'script_loader_tag', 'architect_delay_enqueued_analytics', 20, 3 );

/**
 * Lazy-load Yandex Metrika and Google Analytics after cookie consent.
 */
function architect_deferred_analytics() {
	$metrika_id = absint( get_theme_mod( 'yandex_metrika_id', '' ) );
	$ga_id      = sanitize_text_field( get_theme_mod( 'google_analytics_id', '' ) );

	if ( ! $metrika_id && $ga_id === '' ) {
		return;
	}
	?>
	<script>
	(function () {
		var loaded = false;
		function hasConsent() {
			try {
				if (localStorage.getItem('cookieAccepted') === 'true') return true;
			} catch (e) {}
			return document.cookie.split('; ').indexOf('cookieAccepted=true') !== -1;
		}
		function loadMetrics() {
			if (loaded || !hasConsent()) return;
			loaded = true;
			<?php if ( $metrika_id ) : ?>
			(function (m, e, t, r, i, k, a) {
				m[i] = m[i] || function () { (m[i].a = m[i].a || []).push(arguments); };
				m[i].l = 1 * new Date();
				for (var j = 0; j < document.scripts.length; j++) {
					if (document.scripts[j].src === r) { return; }
				}
				k = e.createElement(t);
				a = e.getElementsByTagName(t)[0];
				k.async = 1;
				k.src = r;
				a.parentNode.insertBefore(k, a);
			})(window, document, 'script', 'https://mc.yandex.ru/metrika/tag.js', 'ym');
			ym(<?php echo (int) $metrika_id; ?>, 'init', {
				clickmap: true,
				trackLinks: true,
				accurateTrackBounce: true,
				webvisor: true
			});
			<?php endif; ?>
			<?php if ( $ga_id !== '' ) : ?>
			var g = document.createElement('script');
			g.async = true;
			g.src = 'https://www.googletagmanager.com/gtag/js?id=<?php echo esc_js( $ga_id ); ?>';
			document.head.appendChild(g);
			window.dataLayer = window.dataLayer || [];
			function gtag(){ dataLayer.push(arguments); }
			window.gtag = gtag;
			gtag('js', new Date());
			gtag('config', '<?php echo esc_js( $ga_id ); ?>');
			<?php endif; ?>
		}
		function boot() {
			if (!hasConsent()) return;
			var opts = { once: true, passive: true };
			['pointerdown', 'scroll', 'keydown', 'touchstart'].forEach(function (evt) {
				window.addEventListener(evt, loadMetrics, opts);
			});
			setTimeout(loadMetrics, 3500);
		}
		window.addEventListener('architect:cookie-consent', function (e) {
			if (e.detail && e.detail.accepted) loadMetrics();
		});
		boot();
	})();
	</script>
	<?php if ( $metrika_id && architect_cookie_consent() === true ) : ?>
	<noscript><div><img src="https://mc.yandex.ru/watch/<?php echo (int) $metrika_id; ?>" style="position:absolute;left:-9999px;" alt=""></div></noscript>
	<?php endif; ?>
	<?php
}
add_action( 'wp_footer', 'architect_deferred_analytics', 99 );
