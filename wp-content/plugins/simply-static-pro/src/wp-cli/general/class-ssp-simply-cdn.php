<?php

namespace simply_static_pro\commands\general;

use Simply_Static\Simply_CDN_Api;
use simply_static_pro\commands\Update_Command;

class Simply_CDN extends Update_Command {

	protected $section = 'general';

	protected $name = 'simply-cdn';

	protected $option_name = 'sch_token';

	protected $description = 'Connect to Simply CDN.';

	public function get_synopsis() {

		$synopsis = [
			array(
				'type'        => 'positional',
				'name'        => 'token',
				'description' => "The token to save for Simply CDN & try to Connect",
				'optional'    => false,
				'repeating'   => false,
			)
		];

		return array_merge( $synopsis, parent::get_synopsis() ); // TODO: Change the autogenerated stub
	}

	/**
	 * Run
	 *
	 * @param $args
	 * @param $options
	 *
	 * @return void
	 */
	public function run( $args, $options ) {
		$token = $args[0];

		$data = Simply_CDN_Api::get_data( $token );

		if ( $data && ! empty( $data->cdn->url ) ) {

			$this->update( $token );
			\WP_CLI::success( 'Connected & Updated!' );
		} else {
			\WP_CLI::error( 'There is something wrong with that security token.' );
		}
	}
}