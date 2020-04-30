<?php

class faq_block {

	function __construct() {
		$this->id = "faq";
		$this->name = __("FAQ", "bl");

		//parent::__construct();
		$this->define();
		$this->register();
	}
	function define() {

		acf_add_local_field_group(array(
			'key' => 'group_5d19bedbadfdb',
			'title' => 'faq',
			'fields' => array(
				array(
					'key' => 'field_5d19beece2dcc',
					'label' => 'Questions',
					'name' => 'questions',
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
							'key' => 'field_5d19bf58e2dcd',
							'label' => 'Question',
							'name' => 'question',
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
							'key' => 'field_5d19bf84e2dce',
							'label' => 'Answer',
							'name' => 'answer',
							'type' => 'wysiwyg',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'tabs' => 'all',
							'toolbar' => 'full',
							'media_upload' => 1,
							'delay' => 0,
						),
					),
				),
			),
			'location' => array(
				array(
					array(
						'param' => 'block',
						'operator' => '==',
						'value' => 'acf/faq',
					),
				),
			),
			'menu_order' => 0,
			'position' => 'normal',
			'style' => 'default',
			'label_placement' => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen' => '',
			'active' => true,
			'description' => '',
		));

	}
	function register() {

		// Register a new block.
		acf_register_block(array(
			"name" => $this->id,
			"title" => $this->name,
			"description" => __("A custom example block.", "bl"),
			"render_callback" => [$this, "render"],
			"category" => "formatting",
			"icon" => "admin-comments",
		));

	}
	function get_template_data() {

		return $data;
	}
	function render($block, $content = "", $is_preview = false) {
		$context = Timber::get_context();
		// Store block values.
		$context["block"] = $block;

		// Store field values.
		$context["fields"] = get_fields();

		// Store $is_preview value.
		$context["is_preview"] = $is_preview;

		// Render the block.
		Timber::render("blocks/faq-block.twig", $context);
	}

}

new faq_block();
