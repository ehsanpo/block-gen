<?php

class sponsor_standardBlock extends TwigBlock {
	function __construct() {
		$this->id = "sponsor-standard";
		$this->name = "Sponsor Standard";

		parent::__construct();
	}

	function define(&$fields) {
		$fields[] = array(
			'key' => 'field_5bfe9116d7dbf',
			'label' => 'Headline',
			'name' => 'headline',
			'_name' => 'headline',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		);
		$fields[] = array(
			'key' => 'field_5bfe9d0072398',
			'label' => 'Per row',
			'name' => 'per_row',
			'_name' => 'per_row',
			'type' => 'button_group',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array(
				4 => '4',
				6 => '6',
				8 => '8',
			),
			'allow_null' => 0,
			'default_value' => '',
			'layout' => 'horizontal',
			'return_format' => 'value',
		);
		$fields[] = array(
			'key' => 'field_5bfe9310d7dc1',
			'label' => 'Partners',
			'name' => 'partners',
			'_name' => 'partners',
			'type' => 'repeater',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'collapsed' => '',
			'min' => 0,
			'max' => 0,
			'layout' => 'table',
			'button_label' => '',
			'sub_fields' => array(
				array(
					'key' => 'field_5bfe9320d7dc2',
					'label' => 'Image',
					'name' => 'image',
					'_name' => 'image',
					'type' => 'image',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'return_format' => 'url',
					'preview_size' => 'head',
					'library' => 'all',
					'min_width' => '',
					'min_height' => '',
					'min_size' => '',
					'max_width' => '',
					'max_height' => '',
					'max_size' => '',
					'mime_types' => '',
				),
				array(
					'key' => 'field_5bfe9961d7dc3',
					'label' => 'Link',
					'name' => 'link',
					'_name' => 'link',
					'type' => 'url',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
				),
			)
		);
		
	}

	function get_template_data($data) {
		return $data;
	}
}

new sponsor_standardBlock();

