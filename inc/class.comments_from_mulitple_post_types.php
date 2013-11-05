<?php

/**
 *  Class WP_Comments_From_Multiple_Post_Types
 */

 class WP_Comments_From_Multiple_Post_Types
 {

	static private $instance = NULL;
        
	/**
         * Instanciate the class.
	 * 
	 * @access  public
	 * @since   0.1
	 * @return  object $instance
	 */
	public function get_instance() 
	{        
		if ( NULL === self::$instance )
			self::$instance = new self;
                                    
		return self::$instance;            
	}

	/**
	 * The constructor
	 * 
	 * @access  public
	 * @since   0.1
	 * @return  void
 	 */
	public function __construct() 
	{
		// register the shortcode
		add_filter( 'comments_clauses', array( $this, 'comments_clauses' ), 99, 2 );
	}        
             
	/**
	 * Support for multiple post types for comments
	 *
	 * @access  public
	 * @since   0.1
	 * @param array $clauses
	 * @param object $wpqc WP_Comment_Query
	 * @return array $clauses
	 */
	public function comments_clauses( $clauses, $wpqc ) 
	{
		global $wpdb;
    		
		// Add the multiple post type support.    
		if( isset( $wpqc->query_vars['post_type'][0] ) )
		{       
			$join = join( "', '", array_map( 'esc_sql', $wpqc->query_vars['post_type'] ) );
 
			$from = "$wpdb->posts.post_type = '" . $wpqc->query_vars['post_type'][0] . "'";			 
			$to   = sprintf( "$wpdb->posts.post_type IN ( '%s' ) ", $join );

			$clauses['where'] = str_replace( $from, $to, $clauses['where'] );
		}  

		return $clauses;
	}
	
} // end class
