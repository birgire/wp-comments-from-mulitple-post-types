<?php

/**
 * No direct access
 */
defined( 'ABSPATH' ) or die( 'Nothing here!' );


/**
 * Class WP_Comments_From_Multiple_Post_Types
 *
 * @package     WordPress
 * @author	birgire
 * @since	0.1
 *
 */

 class WP_Comments_From_Multiple_Post_Types
 {

	/**
         * Store the current instance
	 * 
	 * @access  private
	 * @since   0.1
	 * @var  object $instance
	 */	
	static private $instance = NULL;
        

	/**
         * Return the current instance
	 * 
	 * @access  public
	 * @since   0.1
	 * @return  object $instance
	 */
	static public function get_instance() 
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
		// register the filter
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
 
			$from = sprintf( "$wpdb->posts.post_type = '%s'", $wpqc->query_vars['post_type'][0] );			 
			$to   = sprintf( "$wpdb->posts.post_type IN ( '%s' ) ", $join );

			$clauses['where'] = str_replace( $from, $to, $clauses['where'] );
		}  

		return $clauses;
	}
	
} // end class
