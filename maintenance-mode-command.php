<?php

if ( ! class_exists( 'FP_CLI' ) ) {
	return;
}

$fpcli_maintenance_mode_autoloader = __DIR__ . '/vendor/autoload.php';

if ( file_exists( $fpcli_maintenance_mode_autoloader ) ) {
	require_once $fpcli_maintenance_mode_autoloader;
}

FP_CLI::add_command( 'maintenance-mode', '\FP_CLI\MaintenanceMode\MaintenanceModeCommand' );
