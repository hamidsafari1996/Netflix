<?php

function worldsub_taxonomy() {

    $labels = array(
      'name'                       => _x( 'برچسب', 'Taxonomy General Name', 'text_domain' ),
      'singular_name'              => _x( 'برچسب ها', 'Taxonomy Singular Name', 'text_domain' ),
      'menu_name'                  => __( 'بر چسب‌ها', 'text_domain' ),
      'all_items'                  => __( 'تمام برچسب ها', 'text_domain' ),
      'parent_item'                => __( 'Parent Item', 'text_domain' ),
      'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
      'new_item_name'              => __( 'New Item Name', 'text_domain' ),
      'add_new_item'               => __( 'افزودن برچسب جدید', 'text_domain' ),
      'edit_item'                  => __( 'ویرایش برچسب', 'text_domain' ),
      'update_item'                => __( 'بروزرسانی', 'text_domain' ),
      'view_item'                  => __( 'برچسب', 'text_domain' ),
      'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
      'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
      'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
      'popular_items'              => __( 'برچسب های محبوب', 'text_domain' ),
      'search_items'               => __( 'جستجوی برچسب', 'text_domain' ),
      'not_found'                  => __( 'برچسب پیدا نشد', 'text_domain' ),
      'no_terms'                   => __( 'برچسب وجود ندارد', 'text_domain' ),
      'items_list'                 => __( 'لیست برچسب‌ها', 'text_domain' ),
      'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
    );
    $args = array(
      'labels'                     => $labels,
      'hierarchical'               => false,
      'public'                     => true,
      'show_ui'                    => true,
      'show_admin_column'          => true,
      'show_in_nav_menus'          => true,
      'show_tagcloud'              => true,
      'rewrite'                       => array( 'slug' => 'tags'),
    );
    
    register_taxonomy( 'worldsub_tag', array( 'coagex_movie' ), $args );
  }
  add_action( 'init', 'worldsub_taxonomy', 0 );

?>