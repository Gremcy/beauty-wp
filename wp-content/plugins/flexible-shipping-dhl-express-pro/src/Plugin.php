<?php
/**
 * Plugin main class.
 *
 * @package WPDesk\FlexibleShippingDhlExpressPro
 */

namespace WPDesk\FlexibleShippingDhlExpressPro;

use FlexibleShippingDhlExpressProVendor\Octolize\Tracker\TrackerInitializer;
use FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Settings\SettingsValuesAsArray;
use FlexibleShippingDhlExpressProVendor\WPDesk\Beacon\BeaconGetShouldShowStrategy;
use FlexibleShippingDhlExpressProVendor\WPDesk\Beacon\BeaconPro;
use FlexibleShippingDhlExpressProVendor\WPDesk\DhlExpressShippingService\DhlSettingsDefinition;
use FlexibleShippingDhlExpressProVendor\WPDesk\DhlExpressShippingService\DhlShippingService;
use FlexibleShippingDhlExpressProVendor\WPDesk\Logger\WPDeskLoggerFactory;
use FlexibleShippingDhlExpressProVendor\WPDesk\PluginBuilder\Plugin\AbstractPlugin;
use FlexibleShippingDhlExpressProVendor\WPDesk\PluginBuilder\Plugin\HookableCollection;
use FlexibleShippingDhlExpressProVendor\WPDesk\PluginBuilder\Plugin\HookableParent;
use FlexibleShippingDhlExpressProVendor\WPDesk\PluginBuilder\Plugin\TemplateLoad;
use FlexibleShippingDhlExpressProVendor\WPDesk\View\Renderer\Renderer;
use FlexibleShippingDhlExpressProVendor\WPDesk\View\Renderer\SimplePhpRenderer;
use FlexibleShippingDhlExpressProVendor\WPDesk\View\Resolver\ChainResolver;
use FlexibleShippingDhlExpressProVendor\WPDesk\View\Resolver\DirResolver;
use FlexibleShippingDhlExpressProVendor\WPDesk\View\Resolver\WPThemeResolver;
use FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShipping\ActivePayments\Integration;
use FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShipping\Assets;
use FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShipping\CustomFields\ApiStatus\FieldApiStatusAjax;
use FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShipping\DhlExpress\DhlShippingMethod;
use FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShipping\DhlExpress\ShippingZoneMethods;
use FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShipping\EstimatedDelivery\EstimatedDeliveryDatesDisplay;
use FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShipping\OrderMetaData\AdminOrderMetaDataDisplay;
use FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShipping\OrderMetaData\FrontOrderMetaDataDisplay;
use FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShipping\OrderMetaData\SingleAdminOrderMetaDataInterpreterImplementation;
use FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShipping\PluginShippingDecisions;
use FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShipping\ShippingBuilder\WooCommerceShippingMetaDataBuilder;
use FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShipping\ShopSettings;
use FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShipping\Ups\MetaDataInterpreters\FallbackAdminMetaDataInterpreter;
use FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShipping\Ups\MetaDataInterpreters\PackedPackagesAdminMetaDataInterpreter;
use FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShippingPro\CustomFields\ShippingBoxes;
use FlexibleShippingDhlExpressProVendor\WPDesk_Plugin_Info;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Psr\Log\NullLogger;
use WPDesk\FlexibleShippingDhlExpressPro\DhlExpressProShippingService\DhlExpressProShippingService;
use WPDesk\FlexibleShippingDhlExpressPro\ShippingMethod\DhlExpressProShippingMethod;

/**
 * Main plugin class. The most important flow decisions are made here.
 *
 * @package WPDesk\FlexibleShippingDhlExpressPro
 */
class Plugin extends AbstractPlugin implements LoggerAwareInterface, HookableCollection {

	/**
	 * Renderer.
	 *
	 * @var Renderer
	 */
	private $renderer;

	use LoggerAwareTrait;
	use HookableParent;
	use TemplateLoad;

	/**
	 * Scripts version.
	 *
	 * @var string
	 */
	private $scripts_version = '1';

	/**
	 * Plugin constructor.
	 *
	 * @param WPDesk_Plugin_Info $plugin_info Plugin info.
	 */
	public function __construct( WPDesk_Plugin_Info $plugin_info ) {
		if ( defined( 'FLEXIBLE_SHIPPING_DHL_EXPRESS_PRO_VERSION' ) ) {
			$this->scripts_version = FLEXIBLE_SHIPPING_DHL_EXPRESS_PRO_VERSION . '.' . $this->scripts_version;
		}
		parent::__construct( $plugin_info );
		$this->setLogger( $this->is_debug_mode() ? ( new WPDeskLoggerFactory() )->createWPDeskLogger( 'dhl-express' ) : new NullLogger() );

		$this->plugin_url       = $this->plugin_info->get_plugin_url();
		$this->plugin_namespace = $this->plugin_info->get_text_domain();
	}

	/**
	 * Returns true when debug mode is on.
	 *
	 * @return bool
	 */
	private function is_debug_mode() {
		$global_dhl_settings = $this->get_global_dhl_settings();

		return isset( $global_dhl_settings['debug_mode'] ) && 'yes' === $global_dhl_settings['debug_mode'];
	}


	/**
	 * Get global DHL settings.
	 *
	 * @return string[]
	 */
	private function get_global_dhl_settings() {
		/* @phpstan-ignore-next-line */
		return get_option( 'woocommerce_' . DhlShippingService::UNIQUE_ID . '_settings', [] );
	}

	/**
	 * Init base variables for plugin
	 */
	public function init_base_variables() {
		$this->plugin_url       = $this->plugin_info->get_plugin_url();
		$this->plugin_path      = $this->plugin_info->get_plugin_dir();
		$this->template_path    = $this->plugin_info->get_text_domain();
		$this->plugin_namespace = $this->plugin_info->get_text_domain();
	}

	/**
	 * Init plugin
	 */
	public function init() {

		$this->init_renderer();

		$global_dhl_settings = new SettingsValuesAsArray( $this->get_global_dhl_settings() );

		/** @phpstan-ignore-next-line */
		$dhl_service = apply_filters( 'flexible_shipping_dhl_pro_shipping_service', new DhlExpressProShippingService( $this->logger, new ShopSettings( DhlShippingService::UNIQUE_ID ) ) );

		$this->add_hookable(
			new Assets( $this->get_plugin_url() . 'vendor_prefixed/wpdesk/wp-woocommerce-shipping/assets', 'dhl' )
		);

		$this->add_hookable(
			new \FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShipping\DhlExpress\Assets(
				$this->get_plugin_url() . 'vendor_prefixed/wpdesk/wp-dhl-express-shipping-method/assets',
				$this->scripts_version
			)
		);

		$admin_meta_data_interpreter = new AdminOrderMetaDataDisplay( DhlExpressProShippingMethod::UNIQUE_ID );
		$admin_meta_data_interpreter->add_interpreter(
			new SingleAdminOrderMetaDataInterpreterImplementation(
				WooCommerceShippingMetaDataBuilder::SERVICE_TYPE,
				__( 'Service Code', 'flexible-shipping-dhl-express-pro' )
			)
		);
		$admin_meta_data_interpreter->add_interpreter( new FallbackAdminMetaDataInterpreter() );
		$admin_meta_data_interpreter->add_hidden_order_item_meta_key( WooCommerceShippingMetaDataBuilder::COLLECTION_POINT );
		$admin_meta_data_interpreter->add_interpreter( new PackedPackagesAdminMetaDataInterpreter() );
		$this->add_hookable( $admin_meta_data_interpreter );

		$meta_data_interpreter = new FrontOrderMetaDataDisplay( DhlExpressProShippingMethod::UNIQUE_ID );
		$this->add_hookable( $meta_data_interpreter );

		$this->add_hookable( new EstimatedDeliveryDatesDisplay( $this->renderer, DhlExpressProShippingService::UNIQUE_ID ) );

		/**
		 * Handles API Status AJAX requests.
		 *
		 * @var FieldApiStatusAjax $api_ajax_status_handler .
		 * @phpstan-ignore-next-line
		 */
		$api_ajax_status_handler = new FieldApiStatusAjax( $dhl_service, $global_dhl_settings, $this->logger );
		$this->add_hookable( $api_ajax_status_handler );

		/** @phpstan-ignore-next-line */
		$plugin_shipping_decisions = new PluginShippingDecisions( $dhl_service, $this->logger );
		$plugin_shipping_decisions->set_field_api_status_ajax( $api_ajax_status_handler );

		DhlExpressProShippingMethod::set_plugin_shipping_decisions( $plugin_shipping_decisions );

		$this->add_hookable( new Integration( DhlShippingMethod::UNIQUE_ID ) );

		$this->add_hookable( new SettingsSidebar() );

		if ( DhlSettingsDefinition::ENABLE_SHIPPING_METHOD_DEFAULT !== $global_dhl_settings->get_value( DhlSettingsDefinition::ENABLE_SHIPPING_METHOD, DhlSettingsDefinition::ENABLE_SHIPPING_METHOD_DEFAULT ) ) {
			$this->add_hookable( new ShippingZoneMethods() );
		}

		$beacon = new BeaconPro(
			'65dc4b83-7e99-4d44-b682-090048ce82db',
			new BeaconGetShouldShowStrategy(
				[
					[
						'page'    => 'wc-settings',
						'tab'     => 'shipping',
						'section' => 'flexible_shipping_dhl_express',
					],
				]
			),
			$this->get_plugin_url() . 'vendor_prefixed/wpdesk/wp-helpscout-beacon/assets/'
		);
		$beacon->hooks();

		$this->init_tracker();

		parent::init();
	}

	/**
	 * @return void
	 */
	private function init_tracker() {
		$this->add_hookable( TrackerInitializer::create_from_plugin_info_for_shipping_method( $this->plugin_info, DhlShippingService::UNIQUE_ID ) );
	}

	/**
	 * Init hooks.
	 */
	public function hooks() {
		parent::hooks();

		add_filter( 'woocommerce_shipping_methods', [ $this, 'woocommerce_shipping_methods_filter' ], 20, 1 );

		$this->hooks_on_hookable_objects();
	}


	/**
	 * Adds shipping method to Woocommerce.
	 *
	 * @param string[] $methods Methods.
	 *
	 * @return string[]
	 */
	public function woocommerce_shipping_methods_filter( $methods ) {
		$methods[ DhlShippingService::UNIQUE_ID ] = DhlExpressProShippingMethod::class;

		return $methods;
	}

	/**
	 * Quick links on plugins page.
	 *
	 * @param string[] $links .
	 *
	 * @return string[]
	 */
	public function links_filter( $links ) {
		$docs_link    = 'https://octol.io/dhl-express-docs';
		$support_link = 'https://octol.io/dhl-express-repo-support';
		$settings_url = admin_url( 'admin.php?page=wc-settings&tab=shipping&section=flexible_shipping_dhl_express' );

		$external_attributes = ' target="_blank" ';

		$plugin_links = [
			'<a href="' . $settings_url . '">' . __( 'Settings', 'flexible-shipping-dhl-express-pro' ) . '</a>',
			'<a href="' . $docs_link . '"' . $external_attributes . '>' . __( 'Docs', 'flexible-shipping-dhl-express-pro' ) . '</a>',
			'<a href="' . $support_link . '"' . $external_attributes . '>' . __( 'Support', 'flexible-shipping-dhl-express-pro' ) . '</a>',
		];

		return array_merge( $plugin_links, $links );
	}

	/**
	 * Admin enqueue scripts.
	 *
	 * @param string $hook_suffix
	 */
	public function admin_enqueue_scripts( $hook_suffix = '' ) {
		parent::admin_enqueue_scripts();
		ShippingBoxes::enqueue_scripts( $this->get_plugin_assets_url() );
	}

	/**
	 * Init renderer.
	 *
	 * @return void
	 */
	private function init_renderer() {
		$resolver = new ChainResolver();
		$resolver->appendResolver( new WPThemeResolver( $this->get_template_path() ) );
		$resolver->appendResolver( new DirResolver( trailingslashit( $this->plugin_path ) . 'templates' ) );
		$resolver->appendResolver( new DirResolver( trailingslashit( $this->plugin_path ) . 'vendor_prefixed/wpdesk/wp-woocommerce-shipping/templates' ) );
		$this->renderer = new SimplePhpRenderer( $resolver );
	}
}
