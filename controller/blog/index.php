<?php



// gère la page d'accueil du blog
function get_index($pages_number, $per_page) {    
    $page = get_page();    
    // on s'assure que $page est bien un entier compris entre 0 et le nombre de pages    
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
        try {            
            $posts = get_posts($offset, $per_page); 
            
            foreach($posts as $key => $post) {
            
            $posts[$key]['post_id'] = intval($post['post_id']);
            $posts[$key]['post_title'] = htmlspecialchars($post['post_title']);
            $posts[$key]['post_author'] = htmlspecialchars($post['post_author']);
            $posts[$key]['post_content'] = nl2br(htmlspecialchars($post['post_content']));       
            }
            require "view/blog/index.php";      
        }
        catch(Exception $e) {
            $msgErreur = $e->getMessage();
            require "view/blog/erreur.php";
        }
    } else {
        require "view/blog/404.php";        
    }
}


//affichage d'un seul post
function single_post($the_post_id) {
    $post = get_single_post($the_post_id);
    $comments_count = get_comments_count($the_post_id);
    $post_title = htmlspecialchars($post['post_title']);
    $post_author = htmlspecialchars($post['post_author']);
    $post_content = nl2br(htmlspecialchars($post['post_content']));
    require "view/blog/post.php";    
}

//affichage des commentaires
function display_comments($the_post_id) {
    $comments = get_comments($the_post_id)->fetchAll();
    foreach($comments as $comment){
        
        $com_author = htmlspecialchars($comment['com_author']);
        $com_message = nl2br(htmlspecialchars($comment['com_message']));
        $com_author_email = htmlspecialchars($comment['com_author_email']);
        $grav_url = "https://www.gravatar.com/avatar/" . md5(strtolower(trim($com_author_email))) . "?d=monsterid";
        
        include "view/blog/comments.php";        
    }
}