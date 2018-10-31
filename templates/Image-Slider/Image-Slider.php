<?php

class image_slider extends TwigBlock {
	function __construct() {
		$this->id = 'Image-slider';
		$this->name = 'Image Slider';

		parent::__construct();
	}

	function define(&$fields) {
		$fields[] = array(
			'key' => 'field_5bc732545afac',
			'label' => 'slides',
			'name' => 'slides',
			'_name' => 'slides',
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
			'layout' => 'row',
			'button_label' => '',
			'sub_fields' => array(
				array(
					'key' => 'field_5bc72fbd99e27',
					'label' => 'Link',
					'name' => 'link',
					'_name' => 'link',
					'type' => 'page_link',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '50',
						'class' => '',
						'id' => '',
					),
					'post_type' => '',
					'taxonomy' => '',
					'allow_null' => 0,
					'allow_archives' => 1,
					'multiple' => 0,
				),
				array(
					'key' => 'field_5bc72ea599e24',
					'label' => 'image',
					'name' => 'image',
					'_name' => 'image',
					'type' => 'image',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '50',
						'class' => '',
						'id' => '',
					),
					'return_format' => 'array',
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
					'key' => 'field_5bc72ebc99e25',
					'label' => 'Headline',
					'name' => 'headline',
					'_name' => 'headline',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '50',
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
					'key' => 'field_5bc72f1199e26',
					'label' => 'Date',
					'name' => 'date',
					'_name' => 'date',
					'type' => 'date_picker',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '50',
						'class' => '',
						'id' => '',
					),
					'display_format' => 'F j, Y',
					'return_format' => 'F j, Y',
					'first_day' => 1,
				),
			),
		);
	}

	function get_template_data($data) {
		return $data;
	}
}

new image_slider();
