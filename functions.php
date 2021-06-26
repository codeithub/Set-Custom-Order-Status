add_filter( 'woocommerce_register_shop_order_post_statuses', 'codeithub_register_custom_order_status' );
 
function codeithub_register_custom_order_status( $order_statuses ){
    
   $order_statuses['wc-custom-status'] = array(                                 
   'label'                     => _x( 'Custom Status', 'Order status', 'woocommerce' ),
   'public'                    => false,                                 
   'exclude_from_search'       => false,                                 
   'show_in_admin_all_list'    => true,                                 
   'show_in_admin_status_list' => true,                                 
   'label_count'               => _n_noop( 'Custom Status <span class="count">(%s)</span>', 'Custom Status <span class="count">(%s)</span>', 'woocommerce' ),                              
   );      
   return $order_statuses;
}
 
add_filter( 'wc_order_statuses', 'codeithub_show_custom_order_status' );
 
function codeithub_show_custom_order_status( $order_statuses ) {      
   $order_statuses['wc-custom-status'] = _x( 'Custom Status', 'Order status', 'woocommerce' );       
   return $order_statuses;
}
 
add_filter( 'bulk_actions-edit-shop_order', 'codeithub_get_custom_order_status_bulk' );
 
function codeithub_get_custom_order_status_bulk( $bulk_actions ) {
   // Note: "mark_" must be there instead of "wc"
   $bulk_actions['mark_custom-status'] = 'Change status to custom status';
   return $bulk_actions;
}
 
 
add_action( 'woocommerce_thankyou', 'codeithub_thankyou_change_order_status' );
 
function codeithub_thankyou_change_order_status( $order_id ){
   if( ! $order_id ) return;
   $order = wc_get_order( $order_id );
 
   // Status without the "wc-" prefix
   $order->update_status( 'custom-status' );
}
