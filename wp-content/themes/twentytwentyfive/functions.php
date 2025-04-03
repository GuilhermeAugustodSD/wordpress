<?php
/**
 * Twenty Twenty-Five functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_Five
 * @since Twenty Twenty-Five 1.0
 */

// Adds theme support for post formats.
if ( ! function_exists( 'twentytwentyfive_post_format_setup' ) ) :
	/**
	 * Adds theme support for post formats.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_post_format_setup() {
		add_theme_support( 'post-formats', array( 'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video' ) );
	}
endif;
add_action( 'after_setup_theme', 'twentytwentyfive_post_format_setup' );

// Enqueues editor-style.css in the editors.
if ( ! function_exists( 'twentytwentyfive_editor_style' ) ) :
	/**
	 * Enqueues editor-style.css in the editors.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_editor_style() {
		add_editor_style( get_parent_theme_file_uri( 'assets/css/editor-style.css' ) );
	}
endif;
add_action( 'after_setup_theme', 'twentytwentyfive_editor_style' );

// Enqueues style.css on the front.
if ( ! function_exists( 'twentytwentyfive_enqueue_styles' ) ) :
	/**
	 * Enqueues style.css on the front.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_enqueue_styles() {
		wp_enqueue_style(
			'twentytwentyfive-style',
			get_parent_theme_file_uri( 'style.css' ),
			array(),
			wp_get_theme()->get( 'Version' )
		);
	}
endif;
add_action( 'wp_enqueue_scripts', 'twentytwentyfive_enqueue_styles' );

// Registers custom block styles.
if ( ! function_exists( 'twentytwentyfive_block_styles' ) ) :
	/**
	 * Registers custom block styles.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_block_styles() {
		register_block_style(
			'core/list',
			array(
				'name'         => 'checkmark-list',
				'label'        => __( 'Checkmark', 'twentytwentyfive' ),
				'inline_style' => '
				ul.is-style-checkmark-list {
					list-style-type: "\2713";
				}

				ul.is-style-checkmark-list li {
					padding-inline-start: 1ch;
				}',
			)
		);
	}
endif;
add_action( 'init', 'twentytwentyfive_block_styles' );

// Registers pattern categories.
if ( ! function_exists( 'twentytwentyfive_pattern_categories' ) ) :
	/**
	 * Registers pattern categories.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_pattern_categories() {

		register_block_pattern_category(
			'twentytwentyfive_page',
			array(
				'label'       => __( 'Pages', 'twentytwentyfive' ),
				'description' => __( 'A collection of full page layouts.', 'twentytwentyfive' ),
			)
		);

		register_block_pattern_category(
			'twentytwentyfive_post-format',
			array(
				'label'       => __( 'Post formats', 'twentytwentyfive' ),
				'description' => __( 'A collection of post format patterns.', 'twentytwentyfive' ),
			)
		);
	}
endif;
add_action( 'init', 'twentytwentyfive_pattern_categories' );

// Registers block binding sources.
if ( ! function_exists( 'twentytwentyfive_register_block_bindings' ) ) :
	/**
	 * Registers the post format block binding source.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_register_block_bindings() {
		register_block_bindings_source(
			'twentytwentyfive/format',
			array(
				'label'              => _x( 'Post format name', 'Label for the block binding placeholder in the editor', 'twentytwentyfive' ),
				'get_value_callback' => 'twentytwentyfive_format_binding',
			)
		);
	}
endif;
add_action( 'init', 'twentytwentyfive_register_block_bindings' );

// Registers block binding callback function for the post format name.
if ( ! function_exists( 'twentytwentyfive_format_binding' ) ) :
	/**
	 * Callback function for the post format name block binding source.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return string|void Post format name, or nothing if the format is 'standard'.
	 */
	function twentytwentyfive_format_binding() {
		$post_format_slug = get_post_format();

		if ( $post_format_slug && 'standard' !== $post_format_slug ) {
			return get_post_format_string( $post_format_slug );
		}
	}
endif;

function registrar_taxonomia_categoria_atuacao()
{
  $labels = array(
    'name'              => _x('Categorias de Atuação', 'taxonomy general name', 'text_domain'),
    'singular_name'     => _x('Categoria de Atuação', 'taxonomy singular name', 'text_domain'),
    'search_items'      => __('Pesquisar Categorias', 'text_domain'),
    'all_items'         => __('Todas as Categorias', 'text_domain'),
    'parent_item'       => __('Categoria Pai', 'text_domain'),
    'parent_item_colon' => __('Categoria Pai:', 'text_domain'),
    'edit_item'         => __('Editar Categoria', 'text_domain'),
    'update_item'       => __('Atualizar Categoria', 'text_domain'),
    'add_new_item'      => __('Adicionar Nova Categoria', 'text_domain'),
    'new_item_name'     => __('Nova Categoria', 'text_domain'),
    'menu_name'         => __('Categorias', 'text_domain'),
  );

  $args = array(
    'hierarchical'      => true,
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array('slug' => 'categoria-atuacao'),
  );

  register_taxonomy('categoria_atuacao', array('atuacao'), $args);
}
add_action('init', 'registrar_taxonomia_categoria_atuacao', 0);

function registrar_cpt_atuacao()
{
  $labels = array(
    'name'                  => _x('Áreas de Atuação', 'Post Type General Name', 'text_domain'),
    'singular_name'         => _x('Área de Atuação', 'Post Type Singular Name', 'text_domain'),
    'menu_name'             => __('Áreas de Atuação', 'text_domain'),
    'name_admin_bar'        => __('Área de Atuação', 'text_domain'),
    'archives'              => __('Arquivo de Áreas de Atuação', 'text_domain'),
    'attributes'            => __('Atributos de Área de Atuação', 'text_domain'),
    'parent_item_colon'     => __('Área de Atuação Pai:', 'text_domain'),
    'all_items'             => __('Todas as Áreas de Atuação', 'text_domain'),
    'add_new_item'          => __('Adicionar Nova Área de Atuação', 'text_domain'),
    'add_new'               => __('Adicionar Novo', 'text_domain'),
    'new_item'              => __('Nova Área de Atuação', 'text_domain'),
    'edit_item'             => __('Editar Área de Atuação', 'text_domain'),
    'update_item'           => __('Atualizar Área de Atuação', 'text_domain'),
    'view_item'             => __('Visualizar Área de Atuação', 'text_domain'),
    'view_items'            => __('Visualizar Áreas de Atuação', 'text_domain'),
    'search_items'          => __('Pesquisar Áreas de Atuação', 'text_domain'),
    'not_found'             => __('Não encontrado', 'text_domain'),
    'not_found_in_trash'    => __('Não encontrado na lixeira', 'text_domain'),
    'featured_image'        => __('Imagem em destaque', 'text_domain'),
    'set_featured_image'    => __('Definir imagem em destaque', 'text_domain'),
    'remove_featured_image' => __('Remover imagem em destaque', 'text_domain'),
    'use_featured_image'    => __('Usar como imagem em destaque', 'text_domain'),
    'insert_into_item'      => __('Inserir na área de atuação', 'text_domain'),
    'uploaded_to_this_item' => __('Carregado para esta área de atuação', 'text_domain'),
    'items_list'            => __('Lista de áreas de atuação', 'text_domain'),
    'items_list_navigation' => __('Navegação da lista de áreas de atuação', 'text_domain'),
    'filter_items_list'     => __('Filtrar lista de áreas de atuação', 'text_domain'),
  );

  $args = array(
    'label'                 => __('Área de Atuação', 'text_domain'),
    'description'           => __('CPT para Áreas de Atuação', 'text_domain'),
    'labels'                => $labels,
    'supports'              => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
    'taxonomies'            => array('categoria_atuacao', 'post_tag'),
    'hierarchical'          => false,
    'public'                => true,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'menu_position'         => 5,
    'show_in_admin_bar'     => true,
    'show_in_nav_menus'     => true,
    'can_export'            => true,
    'has_archive'           => true,
    'exclude_from_search'   => false,
    'publicly_queryable'    => true,
    'capability_type'       => 'post',
    'show_in_rest'          => true,
    'rewrite'               => array('slug' => 'atuacao'),
  );

  register_post_type('atuacao', $args);
}
add_action('init', 'registrar_cpt_atuacao', 0);

function exibir_meta_box_categoria_atuacao() {
  add_meta_box(
    'categorydiv-categoria_atuacao',
    __('Categoria de Atuação', 'text_domain'),
    'post_categories_meta_box',
    'atuacao',
    'side',
    'default',
    array('taxonomy' => 'categoria_atuacao')
  );
}
add_action('add_meta_boxes', 'exibir_meta_box_categoria_atuacao');
