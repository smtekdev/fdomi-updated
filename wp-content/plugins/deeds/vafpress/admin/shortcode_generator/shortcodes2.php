<?php



return array(



	'Layout' => array(

		'elements' => array(



			'row' => array(

				'title'   => __('Row', 'wp-deeds'),

				'code'    => '[row][/row]',

			),



			'column' => array(

				'title'   => __('Column', 'wp-deeds'),

				'code'    => '[column][/column]',

				'attributes' => array(

					array(

						'name'    => 'grid',

						'type'    => 'slider',

						'label'   => __('Grid', 'wp-deeds'),

						'min'     => 1,

						'max'     => 12,

						'default' => 12,

					),

					array(

						'name'    => 'offset',

						'type'    => 'slider',

						'label'   => __('Offset', 'wp-deeds'),

						'min'     => 0,

						'max'     => 11,

						'default' => 0,

					),

				),

			),



			'spacer' => array(

				'title'   => __('Inner Spacer', 'wp-deeds'),

				'code'    => '[spacer]',

				'attributes' => array(

					array(

						'name'    => 'size',

						'type'    => 'slider',

						'label'   => __('Size', 'wp-deeds'),

						'default' => 0,

						'min'     => 0,

						'max'     => 500,

					),

				),

			),

		),

	),



);



/**

 * EOF

 */