<?php
/**
 * Template Name: Политики
 * Template Post Type: page
 *
 * @package architect
 */

$page_id = get_the_ID();

architect_get_header();
?>
<main class="main main--no-bg">
  <section class="page-policy">
    <div class="page-policy__container container">
      <?php get_template_part( 'template-parts/components/breadcrumbs', '', $page_id ); ?>

      <?php
      while ( have_posts() ) :
        the_post();
        ?>
        <h1 class="page-policy__title"><?php echo esc_html( get_the_title() ); ?></h1>
        <p class="page-policy__updated"><?php echo esc_html( sprintf( __( 'Редакция от %s', 'architect' ), get_the_modified_date( 'd.m.Y' ) ) ); ?></p>
        <div class="textredactor">
          <?php
          $content = wpautop( get_the_content() );
          $content = preg_replace( '/<p>\s*Редакция от\s+\d{2}\.\d{2}\.\d{4}\.\s*/u', '<p>', $content, 1 );
          $content = architect_format_textredactor_tables( $content );

          echo $content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
          ?>
        </div>
        <?php
      endwhile;
      ?>
    </div>
  </section>
</main>
<?php architect_get_footer(); ?>
