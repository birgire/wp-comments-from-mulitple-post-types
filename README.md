wp-comments-from-mulitple-post-types
=================

WordPress - Comments From Mulitple Post Types

###Description

This plugin adds multiple post types support to WP_Comment_Query() and get_comments().

Previously you could only fetch a comment from a single post type, for example:

    $args = array(
        'number'    => 5,
        'post_type' = 'post',
    );

    $comments = get_comments( $args )

But with the plugin activated you can use an array of post types:

    $args = array(
        'number'    => 5,
        'post_type' => array( 'post','authors','movies' ),
    );

    $comments = get_comments( $args )

