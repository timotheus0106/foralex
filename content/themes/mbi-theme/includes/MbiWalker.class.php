<?php
class MbiWalker extends Walker {

    // Tell Walker where to inherit it's parent and id values
    var $db_fields = array(
        'parent' => 'menu_item_parent',
        'id'     => 'db_id'
    );

    /**
     * At the start of each element, output a <li> and <a> tag structure.
     */
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        $output .= sprintf( "\n<li class='menu-item menu-item--%s%s'><a href='%s'><span class='link--slide'>%s</span></a></li>\n",
            $item->ID,
            ( $item->current ) ? ' menu-item--current' : '',
            $item->url,
            $item->title
        );
    }
}
