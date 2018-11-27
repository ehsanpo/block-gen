<?php

class cta_boxed_block extends TwigBlock {
	function __construct() {
		$this->id = "cta-boxed";
		$this->name = "CTA Boxed";

		parent::__construct();
	}

	function define(&$fields) {
		$fields[] = array(
			'key' => 'field_b1c5965028144',
			'label' => 'image',
			'name' => 'image',
			'_name' => 'image',
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
		$fields[] = array(
			'key' => 'field_7afbfac943eb2',
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
		$fields[] = array(
			'key' => 'field_670e613bb8236',
			'label' => 'Sub headline',
			'name' => 'cta_subheadline',
			'name' => 'cta_subheadline',
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
			'key' => 'field_8d93837f10b06',
			'label' => 'Links',
			'name' => 'stn_link',
			'_name' => 'stn_link',
			'type' => 'repeater',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'min' => 1,
			'max' => '',
			'layout' => 'block',
			'button_label' => 'Add another link',
			'sub_fields' => array (
				array (
					'key' => 'field_b71593e6b90c8',
					'label' => 'Type',
					'name' => 'link_type',
					'_name' => 'link_type',
					'type' => 'radio',
					'required' => 1,
					'choices' => array (
						'page' => 'Page',
						'url' => 'URL',
					),
					'other_choice' => 0,
					'save_other_choice' => 0,
					'layout' => 'horizontal',
				),
				array (
					'key' => 'field_8a122752cfd7e',
					'label' => 'Text',
					'name' => 'link_text',
					'_name' => 'link_text',
					'type' => 'text',
					'required' => 1,
					'wrapper' => array (
						'width' => 50,
					),
				),
				array (
					'key' => 'field_5e2666fab6c42',
					'label' => 'Internal Page',
					'name' => 'link_page',
					'_name' => 'link_page',
					'type' => 'page_link',
					'conditional_logic' => array (
						array (
							array (
								'field' => 'field_b71593e6b90c8',
								'operator' => '==',
								'value' => 'page',
							),
						),
					),
					'wrapper' => array (
						'width' => 50,
					),
					'post_type' => array (
						0 => 'page',
						1 => 'post',
					),
					'taxonomy' => array (
					),
					'allow_null' => 0,
					'multiple' => 0,
				),
				array (
					'key' => 'field_5341645110322',
					'label' => 'External URL',
					'name' => 'link_url',
					'_name' => 'link_url',
					'type' => 'url',
					'required' => 0,
					'conditional_logic' => array (
						array (
							array (
								'field' => 'field_b71593e6b90c8',
								'operator' => '==',
								'value' => 'url',
							),
						),
					),
					'wrapper' => array (
						'width' => 50,
					),
					'placeholder' => 'http://',
					'default_value' => 'http://',
				),
			),
		);

		
	}

	function get_template_data($data) {
		return $data;
	}
}

new cta_boxed_block();
