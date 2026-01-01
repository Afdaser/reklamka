<?php
/**
 * Шаблон для відображення коментарів.
 *
 * Цей шаблон показує область сторінки, що містить як наявні коментарі,
 * так і форму коментування.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WP_Bootstrap_Starter
 */

/*
 * Якщо поточний запис захищений паролем і
 * відвідувач ще не ввів пароль, виходимо раніше
 * без завантаження коментарів.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

    <?php
    // Тут можна починати редагування — включно з цим коментарем!
    if ( have_comments() ) : ?>

        <h2 class="comments-title">
            <?php
            $comments_number = get_comments_number();
            if ( '1' === $comments_number ) {
                printf(
					/* translators: 1: title. */
					esc_html__( 'Одна думка про &ldquo;%1$s&rdquo;', 'wp-bootstrap-starter' ),
					'<span>' . esc_html(get_the_title()) . '</span>'
				);
            } else {
                printf( // WPCS: XSS OK.
					/* translators: 1: comment count number, 2: title. */
					esc_html( _nx( '%1$s думка про &ldquo;%2$s&rdquo;', '%1$s думок про &ldquo;%2$s&rdquo;', $underscore_comment_count, 'comments title', 'wp-bootstrap-starter' ) ),
					esc_html( number_format_i18n( $underscore_comment_count ) ),
					'<span>' . esc_html( get_the_title() ) . '</span>'
				);
            }
            ?>
        </h2><!-- .comments-title -->


        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Чи є коментарі для навігації? ?>
            <nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
                <h2 class="screen-reader-text"><?php esc_html_e( 'Навігація коментарями', 'wp-bootstrap-starter' ); ?></h2>
                <div class="nav-links">

                    <div class="nav-previous"><?php previous_comments_link( esc_html__( 'Старіші коментарі', 'wp-bootstrap-starter' ) ); ?></div>
                    <div class="nav-next"><?php next_comments_link( esc_html__( 'Новіші коментарі', 'wp-bootstrap-starter' ) ); ?></div>

                </div><!-- .nav-links -->
            </nav><!-- #comment-nav-above -->
        <?php endif; // Перевірка навігації коментарями. ?>

        <ul class="comment-list">
            <?php
            wp_list_comments( array( 'callback' => 'wp_bootstrap_starter_comment', 'avatar_size' => 50 ));
            ?>
        </ul><!-- .comment-list -->

        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Чи є коментарі для навігації? ?>
            <nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
                <h2 class="screen-reader-text"><?php esc_html_e( 'Навігація коментарями', 'wp-bootstrap-starter' ); ?></h2>
                <div class="nav-links">

                    <div class="nav-previous"><?php previous_comments_link( esc_html__( 'Старіші коментарі', 'wp-bootstrap-starter' ) ); ?></div>
                    <div class="nav-next"><?php next_comments_link( esc_html__( 'Новіші коментарі', 'wp-bootstrap-starter' ) ); ?></div>

                </div><!-- .nav-links -->
            </nav><!-- #comment-nav-below -->
            <?php
        endif; // Перевірка навігації коментарями.

    endif; // Перевірка наявності коментарів.


    // Якщо коментарі закриті, але вони є, покажемо невеличке повідомлення.
    if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

        <p class="no-comments"><?php esc_html_e( 'Коментування закрито.', 'wp-bootstrap-starter' ); ?></p>
        <?php
    endif; ?>

    <?php comment_form( $args = array(
        'id_form'           => 'commentform',  // Значення WordPress за замовчуванням — можна видалити або змінити ;)
        'id_submit'         => 'commentsubmit',
        'title_reply'       => __( 'Залишити відповідь', 'wp-bootstrap-starter' ),  // Значення WordPress за замовчуванням — можна видалити або змінити ;)
		/* translators: 1: Reply Specific User */
        'title_reply_to'    => __( 'Залишити відповідь для %s', 'wp-bootstrap-starter' ),  // Значення WordPress за замовчуванням — можна видалити або змінити ;)
        'cancel_reply_link' => __( 'Скасувати відповідь', 'wp-bootstrap-starter' ),  // Значення WordPress за замовчуванням — можна видалити або змінити ;)
        'label_submit'      => __( 'Опублікувати коментар', 'wp-bootstrap-starter' ),  // Значення WordPress за замовчуванням — можна видалити або змінити ;)

        // Підказка в полі введення та стилі Bootstrap для текстової області.
        'comment_field' =>  '<p><textarea placeholder="Почніть вводити..." id="comment" class="form-control" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',

        // Прибираємо підказку про дозволені HTML-теги з форми коментаря.
        'comment_notes_after' => ''

        // Тут можна редагувати всі налаштування форми.
        // Документація: http://codex.wordpress.org/Function_Reference/comment_form
        // Деякі класи додаються у bootstrap-wp.js — перевірте з рядка 1.

    ));

	?>

</div><!-- #comments -->
