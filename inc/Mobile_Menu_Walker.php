<?php

class Mobile_Menu_Walker extends Walker_Nav_Menu {

    public function start_lvl(&$output, $depth = 0, $args = null) {
        if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";  
        }
        $indent = str_repeat($t, $depth);
        
        // Содержимое аккордеона
        $output .= "{$n}{$indent}<div class=\"accordion__content\" aria-hidden=\"true\">{$n}";
        $output .= "{$n}{$indent}<ul class=\"mobile-menu__nav nav\">{$n}";
    }

    public function end_lvl(&$output, $depth = 0, $args = null) {
        if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent = str_repeat($t, $depth);
        $output .= "{$indent}</ul>{$n}";
        $output .= "{$indent}</div>{$n}";
    }

    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent = str_repeat($t, $depth);

        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $has_children = in_array('menu-item-has-children', $classes);
        
        // Определяем классы для li
        $li_classes = array('mobile-menu__item');
        if ($has_children) {
            $li_classes[] = 'accordion';
        }
        
        $class_names = implode(' ', apply_filters('nav_menu_css_class', array_filter($li_classes), $item, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        $output .= $indent . '<li' . $class_names . '>';

        $atts = array();
        $atts['title'] = !empty($item->attr_title) ? $item->attr_title : '';
        $atts['target'] = !empty($item->target) ? $item->target : '';
        $atts['rel'] = !empty($item->xfn) ? $item->xfn : '';
        if ('_blank' === $item->target && empty($item->xfn)) {
            $atts['rel'] = 'noopener noreferrer';
        }
        $atts['href'] = !empty($item->url) ? $item->url : '';
        $atts['aria-current'] = $item->current ? 'page' : '';
        $atts['data-menu-item'] = '';
        $atts['data-text'] = $item->title;

        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);

        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (is_scalar($value) && '' !== $value && false !== $value) {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $title = apply_filters('the_title', $item->title, $item->ID);
        $title = apply_filters('nav_menu_item_title', $title, $item, $args, $depth);

        // Для элементов с подменю - аккордеон
        if ($has_children) {
            $item_output = $args->before;
            $item_output .= '<div class="accordion__item mobile-menu__accordion">' . $n;
            $item_output .= $indent . "\t" . '<button class="accordion__control">' . $n;
            $item_output .= $indent . "\t\t" . '<span class="accordion__title">' . $title . '</span>' . $n;
            $item_output .= $indent . "\t\t" . '<span class="accordion__icon">' . $n;
            $item_output .= $indent . "\t\t\t" . '<svg aria-hidden="true" width="24" height="24">' . $n;
            $item_output .= $indent . "\t\t\t\t" . '<use xlink:href="' . get_template_directory_uri() . '/img/sprite.svg#icon-arrow-up"></use>' . $n;
            $item_output .= $indent . "\t\t\t" . '</svg>' . $n;
            $item_output .= $indent . "\t\t" . '</span>' . $n;
            $item_output .= $indent . "\t" . '</button>' . $n;
            $item_output .= $args->after;
            
            // Сохраняем для использования в start_lvl/end_lvl
            $this->current_item = $item;
            
        } else {
            // Обычный пункт меню без подменю
            $item_output = $args->before;
            $item_output .= '<a class="mobile-menu__link"' . $attributes . '>';
            $item_output .= $args->link_before . $title . $args->link_after;
            $item_output .= '</a>';
            $item_output .= $args->after;
        }

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    public function end_el(&$output, $item, $depth = 0, $args = null) {
        if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent = str_repeat($t, $depth);
        
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $has_children = in_array('menu-item-has-children', $classes);
        
        // Закрываем div.accordion__item для элементов с детьми
        if ($has_children) {
            $output .= $indent . '</div>' . $n;
        }
        
        $output .= "</li>{$n}";
    }
}