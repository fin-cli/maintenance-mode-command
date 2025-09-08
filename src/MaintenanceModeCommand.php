<?php

namespace FP_CLI\MaintenanceMode;

use FP_CLI;
use FP_CLI_Command;
use FP_Upgrader;
use FP_Filesystem_Base;

/**
 * Activates, deactivates or checks the status of the maintenance mode of a site.
 *
 * ## EXAMPLES
 *
 *     # Activate Maintenance mode.
 *     $ fp maintenance-mode activate
 *     Enabling Maintenance mode...
 *     Success: Activated Maintenance mode.
 *
 *     # Deactivate Maintenance mode.
 *     $ fp maintenance-mode deactivate
 *     Disabling Maintenance mode...
 *     Success: Deactivated Maintenance mode.
 *
 *     # Display Maintenance mode status.
 *     $ fp maintenance-mode status
 *     Maintenance mode is active.
 *
 *     # Get Maintenance mode status for scripting purpose.
 *     $ fp maintenance-mode is-active
 *     $ echo $?
 *     1
 *
 * @when    after_fp_load
 * @package fp-cli
 */
class MaintenanceModeCommand extends FP_CLI_Command {


	/**
	 * Instance of FP_Upgrader.
	 *
	 * @var FP_Upgrader
	 */
	private $upgrader;

	/**
	 * Instantiate a MaintenanceModeCommand object.
	 */
	public function __construct() {
		if ( ! class_exists( 'FP_Upgrader' ) ) {
			require_once ABSPATH . 'fp-admin/includes/class-fp-upgrader.php';
		}
		$this->upgrader = new FP_Upgrader( new FP_CLI\UpgraderSkin() );
		$this->upgrader->init();
	}

	/**
	 * Activates maintenance mode.
	 *
	 * ## OPTIONS
	 *
	 * [--force]
	 * : Force maintenance mode activation operation.
	 *
	 * ## EXAMPLES
	 *
	 *     $ fp maintenance-mode activate
	 *     Enabling Maintenance mode...
	 *     Success: Activated Maintenance mode.
	 */
	public function activate( $_, $assoc_args ) {
		if ( $this->get_maintenance_mode_status() && ! FP_CLI\Utils\get_flag_value( $assoc_args, 'force' ) ) {
			FP_CLI::error( 'Maintenance mode already activated.' );
		}

		$this->upgrader->maintenance_mode( true );
		FP_CLI::success( 'Activated Maintenance mode.' );
	}

	/**
	 * Deactivates maintenance mode.
	 *
	 * ## EXAMPLES
	 *
	 *     $ fp maintenance-mode deactivate
	 *     Disabling Maintenance mode...
	 *     Success: Deactivated Maintenance mode.
	 */
	public function deactivate() {
		if ( ! $this->get_maintenance_mode_status() ) {
			FP_CLI::error( 'Maintenance mode already deactivated.' );
		}

		$this->upgrader->maintenance_mode( false );
		FP_CLI::success( 'Deactivated Maintenance mode.' );
	}

	/**
	 * Displays maintenance mode status.
	 *
	 * ## EXAMPLES
	 *
	 *     $ fp maintenance-mode status
	 *     Maintenance mode is active.
	 */
	public function status() {
		$status = $this->get_maintenance_mode_status() ? 'active' : 'not active';
		FP_CLI::line( "Maintenance mode is {$status}." );
	}

	/**
	 * Detects maintenance mode status.
	 *
	 * ## EXAMPLES
	 *
	 *     $ fp maintenance-mode is-active
	 *     $ echo $?
	 *     1
	 *
	 * @subcommand is-active
	 */
	public function is_active() {
		FP_CLI::halt( $this->get_maintenance_mode_status() ? 0 : 1 );
	}

	/**
	 * Returns status of maintenance mode.
	 *
	 * @return bool
	 */
	private function get_maintenance_mode_status() {
		$fp_filesystem = $this->init_fp_filesystem();

		$maintenance_file = trailingslashit( $fp_filesystem->abspath() ) . '.maintenance';

		if ( ! $fp_filesystem->exists( $maintenance_file ) ) {
			return false;
		}

		// We use the timestamp defined in the .maintenance file
		// to check if the maintenance is available.
		$upgrading = 0;

		$contents = (string) $fp_filesystem->get_contents( $maintenance_file );
		$matches  = [];
		if ( preg_match( '/upgrading\s*=\s*(\d+)\s*;/i', $contents, $matches ) ) {
			$upgrading = (int) $matches[1];
		} else {
			FP_CLI::warning( 'Unable to read the maintenance file timestamp, non-numeric value detected.' );
		}
		// The logic here is based on the core FinPress `fp_is_maintenance_mode()` function.
		if ( ( time() - $upgrading ) >= 10 * MINUTE_IN_SECONDS ) {
			return false;
		}
		return true;
	}

	/**
	 * Initializes FP_Filesystem.
	 *
	 * @return FP_Filesystem_Base
	 */
	protected function init_fp_filesystem() {
		global $fp_filesystem;
		FP_Filesystem();

		return $fp_filesystem;
	}
}
