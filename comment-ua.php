<?php

/*
Plugin Name: Comment UserAgent
Plugin URI: http://blog.hinaloe.net/
Description: A brief description of the Plugin.
Version: 1.0
Author: hinaloe
Author URI: http://hinaloe.net/
License: GPL
*/



comment_ua::init();

/**
 * Class comment_ua
 */
class comment_ua {
    /**
     * @var comment_ua
     */
    static $ins;


    /**
     * Constructor
     */
    private function __construct()
    {
        add_action('load-edit-comments.php',array($this,'hooks'));
        add_action('load-edit-comments.php',array($this,'load_styles'));
    }

    /**
     * Add Action or Filter hooks for plugin.
     */
    public function hooks()
    {
        add_filter('comment_row_actions',array($this,'comment_ua_columns'),10,2);
//        add_action('manage_comments_custom_column',array($this,'comment_ua_column'),10,2);
    }


    /**
     * Initialize plugin.
     */
    public static  function init(){
        if (empty(self::$ins)) {
            self::$ins = new self;
        }
    }

    /**
     *
     *
     * @param   array   $actions
     * @return  array   $actions
     */
    public function comment_ua_columns ($a,$comment)
    {
        //@todo
        if($comment->comment_agent)
        echo sprintf(
          '<span class="comment-ua comment-ua-'.$comment->comment_ID.'">%s</span>',
          esc_html ( $comment->comment_agent )
        ) ;

        return $a;

    }

//    /**
//     * @param string $column
//     * @param string $post_id
//     */
//    public function comment_ua_column ($column, $post_id)
//    {
//        echo $column;
//        switch($column) {
//            case "author":
//                //@todo do something
//                $comment = get_comment($post_id);
//                echo $comment->comment_agent;
//                echo "Test!";
//                break;
//        }
//
//    }

    /**
     * Add stylesheet
     *
     */
    public function load_styles()
    {
        add_action('admin_head',function()
        {
            echo sprintf("<style>%s</style>",'.comment-ua:before{content: "UserAgent: ";font-weight: bold;font-family: arial, sans-serif}');
        }
        );
    }
}
