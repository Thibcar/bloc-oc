<?php 



//afficher les articles
function display_posts_data()
{
    $per_page = 10;
    $posts_number = post_count();
    $pages_number = ceil($posts_number / $per_page);
    $page = get_page();
      
     $options = array(
        'options' => array(
            'min_range' => 0,
            'max_range' => $pages_number
        )
    ); 
    if(filter_var($page, FILTER_VALIDATE_INT, $options) !== false) {    
        if($page == 0 || $page == 1) {
            $offset = 0;
        } else {
            $offset = ($page * $per_page) - $per_page;
        }            
            
    $posts_data = get_posts($offset, $per_page);
    require "view/admin/all_posts.php";    
    }
}


//éditer un article
function edit_post()
{
    if(isset($_GET['post_id'])) 
    {
        $the_post_id = intval($_GET['post_id']);
        $post = get_single_post($the_post_id);
        $post_title = htmlspecialchars($post['post_title']);
        $post_author = htmlspecialchars($post['post_author']);
        $post_content = nl2br(htmlspecialchars($post['post_content']));
    
        require "view/admin/edit_post.php";
    }
    
}

//récupérer les données des commentaires
function display_comments_data()
{
    $per_page = 10;
    $posts_number = post_count();
    $pages_number = ceil($posts_number / $per_page);
    $page = get_page();
      
     $options = array(
        'options' => array(
            'min_range' => 0,
            'max_range' => $pages_number
        )
    ); 
    if(filter_var($page, FILTER_VALIDATE_INT, $options) !== false) {    
        if($page == 0 || $page == 1) {
            $offset = 0;
        } else {
            $offset = ($page * $per_page) - $per_page;
        }            
            
    $comments = get_all_comments($offset, $per_page);
    require "view/admin/all_comments.php";    
    }
}

