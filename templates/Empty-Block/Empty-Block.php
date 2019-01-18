<?php

class empty_block extends TwigBlock {
	function __construct() {
		$this->id = "empty-block";
		$this->name = "Empty Block";

		parent::__construct();
	}

	function define(&$fields) {

		$fields[] = array(
			'key' => 'field_9aa7e7d76d158',
			'label' => 'Headline',
			'name' => 'cta_headline',
			'_name' => 'cta_headline',
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
		
	}

	function get_template_data($data) {
		return $data;
	}
}

new empty_block();

