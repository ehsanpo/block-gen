<?php

class testimonials_standardBlock extends TwigBlock {
	function __construct() {
		$this->id = "testimonials-standard";
		$this->name = "Testimonials Standard";

		parent::__construct();
	}

	function define(&$fields) {
		$fields[] = array(
		'key' => 'field_5bfea3c871521',
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
			'key' => 'field_5bfea3ce71522',
			'label' => 'Description',
			'name' => 'description',
			'_name' => 'description',
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
			'key' => 'field_5bfea3e271523',
			'label' => 'Testimonials',
			'name' => 'testimonials',
			'_name' => 'testimonials',
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
					'key' => 'field_5bfea3f971524',
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
					'preview_size' => 'body',
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
					'key' => 'field_5bfea42271525',
					'label' => 'Name',
					'name' => 'name',
					'_name' => 'name',
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
				),
				array(
					'key' => 'field_5bfea43d71528',
					'label' => 'Description',
					'name' => 'description',
					'_name' => 'description',
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
				),
				array(
					'key' => 'field_5bfea4da71529',
					'label' => 'Testimonial',
					'name' => 'testimonial',
					'_name' => 'testimonial',
					'type' => 'textarea',
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
					'maxlength' => '',
					'rows' => '',
					'new_lines' => '',
				),
			)
		);
		
	}

	function get_template_data($data) {
		return $data;
	}
}

new testimonials_standardBlock();

