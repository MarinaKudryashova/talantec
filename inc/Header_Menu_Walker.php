<?php
class Header_Menu_Walker extends Walker_Nav_Menu {
  public function start_lvl( &$output, $depth = 0, $args = null ) {
    $args = architect_nav_menu_args( $args );
    $output .= '<div class="header__submenu"><ul class="header__submenu-list">';
  }

  public function end_lvl( &$output, $depth = 0, $args = null ) {
    $args = architect_nav_menu_args( $args );
    $output .= '</ul></div>';
  }

  public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
    $args = architect_nav_menu_args( $args );

    $classes      = empty( $item->classes ) ? array() : (array) $item->classes;
    $has_children = in_array( 'menu-item-has-children', $classes, true );
    $title        = apply_filters( 'the_title', $item->title, $item->ID );

    $output .= $has_children ? '<li class="menu-item-has-children">' : '<li>';

    $attributes  = '';
    $attributes .= ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) . '"' : '';
    $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target ) . '"' : '';
    $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn ) . '"' : '';
    $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url ) . '"' : '';
    $attributes .= ' data-menu-item data-text="' . esc_attr( $item->title ) . '"';

    if ( $has_children ) {
      $attributes .= ' aria-haspopup="true"';
    }

    $item_output  = $args->before;
    $item_output .= '<a' . $attributes . '>';
    $item_output .= '<span class="header__menu-text"><span data-text="' . esc_attr( $item->title ) . '">';
    $item_output .= $args->link_before . $title . $args->link_after;
    $item_output .= '</span></span>';

    if ( $has_children ) {
      $item_output .= '<span class="header__caret" aria-hidden="true"></span>';
    }

    $item_output .= '</a>';
    $item_output .= $args->after;

    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
  }
}
