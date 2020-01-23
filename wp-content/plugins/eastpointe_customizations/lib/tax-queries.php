<?php 

/* Return not in sold or rented categories tax query
------------------------------------------------------------------*/
function eapt_not_in_sold_or_rented_tax_query_array() {
  return array(
    'taxonomy' => 'property_category',
    'terms' => array( 'rented', 'sold' ),
    'field' => 'slug',
    'operator' => 'NOT IN',
  );
}