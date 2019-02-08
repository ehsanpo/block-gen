<?php
class post_filter_Block extends TwigBlock {
	function __construct() {
		$this->id = "filter-post_filter";
		$this->name = "Post Filter";
		$this->post_type = array (
							0 => 'post',  	// <==== Edit For Custom Post
						);
		$this->tax_type = "category";  		// <==== Edit For Custom Taxonomy
		$this->tax_order =   "term_order";	// <==== Edit For categoty list order
		parent::__construct();
	}

	function define(&$fields) {
		$fields[] = array(
			'key' => 'field_88a38dd24c477',
			'label' => 'Show filters',
			'name' => 'show_filters',
			'_name' => 'show_filters',
			'type' => 'true_false',
			'default_value' => 0,
		);
		$fields[] =array (
			'key' => 'field_5af2da467118d',
			'label' => 'Cases',
			'name' => 'cases',
			'_name' => 'cases',
			'type' => 'repeater',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'collapsed' => '',
			'min' => '',
			'max' => '',
			'layout' => 'table',
			'button_label' => 'Add Case',
			'sub_fields' => array (
				array (
					'key' => 'field_5af2da507118e',
					'label' => 'Project',
					'name' => 'project',
					'_name' => 'project',
					'type' => 'post_object',
					'instructions' => '',
					'required' => 1,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'post_type' => $this->post_type,
					'taxonomy' => array (
					),
					'allow_null' => 0,
					'multiple' => 0,
					'return_format' => 'ID',
					'ui' => 1,
				),
				array (
					'key' => 'field_5af2da7e7118f',
					'label' => 'Attribute',
					'name' => 'attribute',
					'_name' => 'attribute',
					'type' => 'text',
					'instructions' => '',
					'return_format' => 'value',
					'default_value' => '',
					'layout' => 'vertical',
				),
			),
		);
		
	}

	function get_template_data($data) {

		$terms = get_terms( array(
			"taxonomy" => $this->tax_type, 
			"orderby" =>  $this->tax_order
		));

		$posts = $data['cases'];
		for ($i=0; $i < count($posts); $i++) { 
			$post = new TimberPost($posts[$i]['project']);
			$posts[$i]['project'] = $post;
			$posts[$i]['project']->cats = str_replace(array("category-",'status-publish','has-post-thumbnail'),"",$posts[$i]['project']->class);
			
		}

		$data['cases']= $posts;
		$data['terms'] = $terms;

		return $data;
	}
}

new post_filter_Block();

