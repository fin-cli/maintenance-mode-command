<?php

if ( ! class_exists( 'FIN_CLI' ) ) {
	return;
}

$fincli_maintenance_mode_autoloader = __DIR__ . '/vendor/autoload.php';

if ( file_exists( $fincli_maintenance_mode_autoloader ) ) {
	require_once $fincli_maintenance_mode_autoloader;
}

FIN_CLI::add_command( 'maintenance-mode', '\FIN_CLI\MaintenanceMode\MaintenanceModeCommand' );
