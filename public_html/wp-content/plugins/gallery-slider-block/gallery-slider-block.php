<?php
/**
 * Плагін для блоку слайдера галереї на Bootstrap 4.5.3.
 *
 * @package GallerySliderBlock
 */

// Вихід, якщо виклик поза середовищем WordPress.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Реєстрація скриптів і стилів блоку.
add_action( 'init', function () {
	$dir_url  = plugin_dir_url( __FILE__ );
	$dir_path = plugin_dir_path( __FILE__ );
	$version  = file_exists( $dir_path . 'build.meta' ) ? trim( file_get_contents( $dir_path . 'build.meta' ) ) : '1.0.0';

	// Підключаємо Bootstrap 4.5.3 (CSS та JS).
	wp_register_style( 'gsb-bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.3/css/bootstrap.min.css', array(), '4.5.3' );
	wp_register_script( 'gsb-popper', 'https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js', array( 'jquery' ), '1.16.1', true );
	wp_register_script( 'gsb-bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.3/js/bootstrap.min.js', array( 'jquery', 'gsb-popper' ), '4.5.3', true );

	// Регіструємо скрипти редактора та фронтенду.
	wp_register_script(
		'gsb-block-editor',
		$dir_url . 'block.js',
		array( 'wp-blocks', 'wp-element', 'wp-components', 'wp-editor', 'wp-block-editor', 'wp-i18n', 'wp-data' ),
		$version,
		true
	);

	wp_register_script(
		'gsb-frontend-script',
		$dir_url . 'slider-frontend.js',
		array( 'gsb-bootstrap' ),
		$version,
		true
	);

	// Регіструємо стилі.
	wp_register_style( 'gsb-block-style', $dir_url . 'style.css', array( 'gsb-bootstrap' ), $version );
	wp_register_style( 'gsb-block-editor-style', $dir_url . 'editor.css', array( 'gsb-bootstrap' ), $version );

	register_block_type(
		'gsb/gallery-slider',
		array(
			'editor_script' => 'gsb-block-editor',
			'editor_style'  => 'gsb-block-editor-style',
			'view_script'   => 'gsb-frontend-script',
			'view_style'    => 'gsb-block-style',
		)
	);
} );
