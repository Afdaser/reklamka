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
                        <div class="container mt-4">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title mb-3">Статистика переглядів статті</h5>
                                    <div class="table-responsive">
                                        <table class="table table-sm mb-0">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Період</th>
                                                    <th scope="col">Кількість переглядів</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="row">За місяць</th>
                                                    <td><?php echo $month_views; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Всього</th>
                                                    <td><?php echo $total_views; ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <p class="text-muted small mb-0">Дані оновлюються при кожному перегляді цієї статті.</p>
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
