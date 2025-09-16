<?php

namespace FIN_CLI\MaintenanceMode;

use FIN_CLI;
use FIN_CLI_Command;
use FIN_Upgrader;
use FIN_Filesystem_Base;

/**
 * Activates, deactivates or checks the status of the maintenance mode of a site.
 *
 * ## EXAMPLES
 *
 *     # Activate Maintenance mode.
 *     $ fin maintenance-mode activate
 *     Enabling Maintenance mode...
 *     Success: Activated Maintenance mode.
 *
 *     # Deactivate Maintenance mode.
 *     $ fin maintenance-mode deactivate
 *     Disabling Maintenance mode...
 *     Success: Deactivated Maintenance mode.
 *
 *     # Display Maintenance mode status.
 *     $ fin maintenance-mode status
 *     Maintenance mode is active.
 *
 *     # Get Maintenance mode status for scripting purpose.
 *     $ fin maintenance-mode is-active
 *     $ echo $?
 *     1
 *
 * @when    after_fin_load
 * @package fin-cli
 */
class MaintenanceModeCommand extends FIN_CLI_Command {


	/**
	 * Instance of FIN_Upgrader.
	 *
	 * @var FIN_Upgrader
	 */
	private $upgrader;

	/**
	 * Instantiate a MaintenanceModeCommand object.
	 */
	public function __construct() {
		if ( ! class_exists( 'FIN_Upgrader' ) ) {
			require_once ABSPATH . 'fin-admin/includes/class-fin-upgrader.php';
		}
		$this->upgrader = new FIN_Upgrader( new FIN_CLI\UpgraderSkin() );
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
	 *     $ fin maintenance-mode activate
	 *     Enabling Maintenance mode...
	 *     Success: Activated Maintenance mode.
	 */
	public function activate( $_, $assoc_args ) {
		if ( $this->get_maintenance_mode_status() && ! FIN_CLI\Utils\get_flag_value( $assoc_args, 'force' ) ) {
			FIN_CLI::error( 'Maintenance mode already activated.' );
		}

		$this->upgrader->maintenance_mode( true );
		FIN_CLI::success( 'Activated Maintenance mode.' );
	}

	/**
	 * Deactivates maintenance mode.
	 *
	 * ## EXAMPLES
	 *
	 *     $ fin maintenance-mode deactivate
	 *     Disabling Maintenance mode...
	 *     Success: Deactivated Maintenance mode.
	 */
	public function deactivate() {
		if ( ! $this->get_maintenance_mode_status() ) {
			FIN_CLI::error( 'Maintenance mode already deactivated.' );
		}

		$this->upgrader->maintenance_mode( false );
		FIN_CLI::success( 'Deactivated Maintenance mode.' );
	}

	/**
	 * Displays maintenance mode status.
	 *
	 * ## EXAMPLES
	 *
	 *     $ fin maintenance-mode status
	 *     Maintenance mode is active.
	 */
	public function status() {
		$status = $this->get_maintenance_mode_status() ? 'active' : 'not active';
		FIN_CLI::line( "Maintenance mode is {$status}." );
	}

	/**
	 * Detects maintenance mode status.
	 *
	 * ## EXAMPLES
	 *
	 *     $ fin maintenance-mode is-active
	 *     $ echo $?
	 *     1
	 *
	 * @subcommand is-active
	 */
	public function is_active() {
		FIN_CLI::halt( $this->get_maintenance_mode_status() ? 0 : 1 );
	}

	/**
	 * Returns status of maintenance mode.
	 *
	 * @return bool
	 */
	private function get_maintenance_mode_status() {
		$fin_filesystem = $this->init_fin_filesystem();

		$maintenance_file = trailingslashit( $fin_filesystem->abspath() ) . '.maintenance';

		if ( ! $fin_filesystem->exists( $maintenance_file ) ) {
			return false;
		}

		// We use the timestamp defined in the .maintenance file
		// to check if the maintenance is available.
		$upgrading = 0;

		$contents = (string) $fin_filesystem->get_contents( $maintenance_file );
		$matches  = [];
		if ( preg_match( '/upgrading\s*=\s*(\d+)\s*;/i', $contents, $matches ) ) {
			$upgrading = (int) $matches[1];
		} else {
			FIN_CLI::warning( 'Unable to read the maintenance file timestamp, non-numeric value detected.' );
		}
		// The logic here is based on the core FinPress `fin_is_maintenance_mode()` function.
		if ( ( time() - $upgrading ) >= 10 * MINUTE_IN_SECONDS ) {
			return false;
		}
		return true;
	}

	/**
	 * Initializes FIN_Filesystem.
	 *
	 * @return FIN_Filesystem_Base
	 */
	protected function init_fin_filesystem() {
		global $fin_filesystem;
		FIN_Filesystem();

		return $fin_filesystem;
	}
}
