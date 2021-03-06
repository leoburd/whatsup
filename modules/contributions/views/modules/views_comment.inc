<?php
// $Id: views_comment.inc,v 1.3 2006/06/23 22:12:23 merlinofchaos Exp $

/**
 * This include file implements views functionality on behalf of comment.module
 */

function comment_views_tables() {
  $tables['comments'] = array(
    'name' => 'comments',
    'provider' => 'internal',
    'join' => array(
      'left' => array(
        'table' => 'node',
        'field' => 'nid'
      ),
      'right' => array(
        'field' => 'nid'
      ),
    ),
  );

  $tables['node_comment_statistics'] = array(
    'name' => 'node_comment_statistics',
    'provider' => 'internal',
    'join' => array(
      'left' => array(
        'table' => 'node',
        'field' => 'nid'
      ),
      'right' => array(
        'field' => 'nid'
      ),
    ),
    'fields' => array(
      'last_comment_timestamp' => array(
        'name' => t('Comment: Last Comment Time'),
        'sortable' => true,
        'handler' => views_handler_field_dates(),
        'option' => 'string',
        'help' => t('This will display the last comment time.'),
       ),
      'last_comment_name' => array(
        'name' => t('Comment: Last Comment Author'),
        'handler' => 'views_handler_field_username',
        'sortable' => true,
        'uid' => 'last_comment_uid',
        'addlfields' => array('last_comment_uid'),
        'help' => t('This will display the name of the last user to comment on the post.'),
      ),
      'comment_count' => array(
        'name' => t('Comment: Count'),
        'sortable' => true,
        'handler' => array(
          'views_handler_field_int'         => t('Normal'),
          'views_handler_comments_with_new' => t('With New Count')
        ),
        'help' => t('This will display the comment count.'),
      ),
    ),
    'filters' => array(
      'comment_count' => array(
        'name' => t('Node: Comment Count'),
        'operator' => 'views_handler_operator_gtlt',
        'option' => 'integer',
        'help' => t('This filter allows you to filter by the amount of comments.'),
      ),
    ),
    'sorts' => array(
      'last_comment_timestamp' => array(
        'name' => t('Comment: Last Comment Date'),
        'help' => t('This will allow you to sort by the date of the most recent comment on a node.')
      ),
    ),
  );
  return $tables;
}

/*
function comment_views_arguments() {

}

function comment_views_default_views() {

}
*/
