<?php

class cta_block extends TwigBlock {
	function __construct() {
		$this->id = "cta-block";
		$this->name = "CTA Block";

		parent::__construct();
	}

	function define(&$fields) {
		$fields[] = array(
			'key' => 'field_5aa7e7d76d158',
			'label' => 'Headline',
			'name' => 'cta2_headline',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
			'readonly' => 0,
			'disabled' => 0,
		);
		$fields[] = array(
			'key' => 'field_5aa7e82e6d159',
			'label' => 'Subheadline',
			'name' => 'cta2_subheadline',
			'type' => 'wysiwyg',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
			'readonly' => 0,
			'disabled' => 0,
			'tabs' => 'all',
			'toolbar' => 'full',
			'media_upload' => 1,
		);
		$fields[] = array(
			'key' => 'field_5aa7e87f6d15a',
			'label' => 'button text',
			'name' => 'cta2_button_text',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
			'readonly' => 0,
			'disabled' => 0,
		);
		$fields[] = array(
			'key' => 'field_5aa7e8ac6d15b',
			'label' => 'Button link',
			'name' => 'cta2_button_link',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
			'readonly' => 0,
			'disabled' => 0,
		);
		$fields[] = array(
			'key' => 'field_5afd44d0901f1',
			'label' => 'image',
			'name' => 'image',
			'type' => 'image',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '50%',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'id',
			'library' => 'all',
			'min_size' => '',
			'max_size' => '',
			'mime_types' => '',
		);
		
	}

	function get_template_data($data) {
		return $data;
	}
}

new cta_block();

