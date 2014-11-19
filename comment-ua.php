<?php

/*
Plugin Name: Comment Ua
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: A brief description of the Plugin.
Version: 1.0
Author: hinaloe
Author URI: http://hinaloe.net/
License: GPL
*/

class comment_ua {
    static $ins;
    private function __construct()
    {
        add_action('admin_init',array($this,'hooks'));
    }

    public function hooks()
    {
//        add_filter('comment_row_actions',array($this,'comment_ua_columns'));
        add_action('manage_comments_custom_column',array($this,'comment_ua_column'),10,2);
    }

    public function init(){
        if (!empty($this::ins)) {
            $this::ins = new $this;
        }
    }

    /**
     *
     *
     * @param   array   $actions
     * @return  array   $actions
     */
    public function comment_ua_columns ($actions)
    {
        //@todo
        $actions["user_agent"]="";

        return $actions;

    }

    /**
     * @param string $column
     * @param string $post_id
     */
    public function comment_ua_column ($column, $post_id)
    {
        switch($column) {
            case "author":
                //@todo do something
                $comment = get_comment($post_id);
                echo $comment->comment_agent;
                break;
        }

    }
}