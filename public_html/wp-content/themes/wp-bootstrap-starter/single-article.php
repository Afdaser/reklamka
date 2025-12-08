<?php
/**
 * Шаблон для статей зі статистикою переглядів
 *
 * Template Name: Стаття зі статистикою переглядів
 * Template Post Type: post
 *
 * @package WP_Bootstrap_Starter
 */

get_header(); ?>

        <section id="primary" class="content-area col-sm-12 col-lg-8">
                <div id="main" class="site-main" role="main">

                <?php
                while ( have_posts() ) : the_post();
                        // Рахуємо перегляд лише для цього шаблону
                        track_article_view(get_the_ID());

                        get_template_part( 'template-parts/content', get_post_format() );

                        $post_id = get_the_ID();
                        $month_views = intval(get_post_meta($post_id, 'article_view_' . date('Y_m'), true));
                        $total_views = intval(get_post_meta($post_id, 'article_view_total', true));
                        ?>
                        <div class="mt-4">
                            <div class="card shadow-sm w-100">
                                <div class="card-body">
                                    <h5 class="card-title mb-3" style="font-size: 1.1rem;">Статистика переглядів статті:</h5>
                                    <!-- Лаконічний блок статистики переглядів зі смайликами для дружнього вигляду -->
                                    <p class="card-text mb-2">👁️ Переглядів за місяць: <strong><?php echo $month_views; ?></strong></p>
                                    <p class="card-text mb-0">📖 Всього переглядів: <strong><?php echo $total_views; ?></strong></p>
                                </div>
                            </div>
                        </div>
                        <?php
                            the_post_navigation();

                        // Якщо коментарі відкриті або є принаймні один, показуємо їх
                        if ( comments_open() || get_comments_number() ) :
                                comments_template();
                        endif;

                endwhile; // Кінець циклу.
                ?>

                </div><!-- #main -->
        </section><!-- #primary -->

<?php
get_sidebar();
get_footer();
