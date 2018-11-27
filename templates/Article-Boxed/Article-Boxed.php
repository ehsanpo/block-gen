<?php

class article_block_boxed extends TwigBlock {
	function __construct() {
		$this->id = 'article-boxed';
		$this->name = 'Article Boxed';

		parent::__construct();
	}
	function define(&$fields) {

		$fields[] = array(
			'key' => 'field_f30b6b21ddc7f',
			'label' => 'Show',
			'name' => 'show',
			'type' => 'radio',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => 33,
				'class' => '',
				'id' => '',
			),
			'choices' => array (
				'last' => 'Latest news',
				'select' => 'Selected news',
			),
			'other_choice' => 0,
			'save_other_choice' => 0,
			'default_value' => 'late',
			'layout' => 'horizontal',
		);

		$fields[] = array(
			'key' => 'field_88e6e8c91c0cd',
			'label' => 'Post list',
			'name' => 'post_list',
			'type' => 'posttype_select',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '33',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'allow_null' => 0,
			'multiple' => 0,
			'placeholder' => '',
			'disabled' => 0,
			'readonly' => 0,

		);
		
		$fields[] = array(
			'key' => 'field_abde22aeb2eb9',
			'label' => 'How many news to show',
			'name' => 'news_to_show',
			'type' => 'radio',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => 33,
				'class' => '',
				'id' => '',
			),
			'choices' => array (
				2 => 2,
				3 => 3,
				4 => 4,
				-1 => 'All'
			),
			'other_choice' => 0,
			'save_other_choice' => 0,
			'default_value' => 3,
			'layout' => 'horizontal',
		);
		$fields[] = array(
			'key' => 'field_9d239fc23c35a',
			'label' => 'Selected news list',
			'name' => 'selected_news_list',
			'type' => 'post_object',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array (
				array (
					array (
						'field' => 'field_f30b6b21ddc7f',
						'operator' => '==',
						'value' => 'select',
					),
				),
			),
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'post_type' => array (
			),
			'taxonomy' => array (
			),
			'allow_null' => 0,
			'multiple' => 1,
			'return_format' => 'object',
			'ui' => 1,
		);
	}

	function get_template_data($data) {
		return array(
			'posts' => Timber::get_posts('post_type='. $data['post_list'] .'&numberposts=' . $data['news_to_show']),
			'data' => $data
		);
	}
}

new article_block_boxed();
