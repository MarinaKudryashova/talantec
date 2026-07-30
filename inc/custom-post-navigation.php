<?php 

function custom_post_navigation() {
    $prev_post = get_previous_post();
    $next_post = get_next_post();
    
    if( !$prev_post && !$next_post ) {
        return;
    }
    ?>
    <div class="navigation" aria-label="Постраничная навигация" data-aos="fade-up" data-aos-delay="300">
        <?php if( $prev_post ) : ?>
            <a href="<?php echo get_permalink($prev_post); ?>" class="navigation__link prev">
                <svg class="navigation__icon">
                    <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#chevrons-right"></use>
                </svg>
                <span>Предыдущая</span>
            </a>
        <?php else : ?>
            <a href="#" class="navigation__link navigation__link--disabled prev">
                <svg class="navigation__icon">
                    <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#chevrons-right"></use>
                </svg>
                <span>Предыдущая</span>
            </a>
        <?php endif; ?>
        
        <?php if( $next_post ) : ?>
            <a href="<?php echo get_permalink($next_post); ?>" class="navigation__link next">
                <span>Следующая</span>
                <svg class="navigation__icon">
                    <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#chevrons-right"></use>
                </svg>
            </a>
        <?php else : ?>
            <a href="#" class="navigation__link navigation__link--disabled next">
                <span>Следующая</span>
                <svg class="navigation__icon">
                    <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#chevrons-right"></use>
                </svg>
            </a>
        <?php endif; ?>
    </div>
    <?php
}