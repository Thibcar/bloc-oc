<?php // gère toutes les requêtes concernant les articles

/*require_once "model/connexion.php";*/

// récupérer le nombre d'entrées dans la bdd
function post_count() 
{
    $con = getBdd();
    $req = $con->query("SELECT post_id FROM posts");
    $posts_number = $req->rowCount();
    $req -> closeCursor();
    return $posts_number;    
}


//obtenir le contenu des articles pour index.php
function get_posts ($offset, $limit) 
{
    $con = getBdd();
    $offset = (int) $offset;
    $limit = (int) $limit;
    $req = $con->prepare("SELECT post_id, post_title, post_content, post_author, DATE_FORMAT(post_date,'%d/%m/%Y') AS post_date_fr FROM posts ORDER BY post_id DESC LIMIT :offset, :limit");
    $req->bindParam(':offset', $offset, PDO::PARAM_INT);
    $req->bindParam(':limit', $limit, PDO::PARAM_INT);
    $req->execute();
    $posts = $req->fetchAll();
    $req->closeCursor();
    return $posts;
   
}

//obtenir le contenu d'un article pour son affichage ou son édition
function get_single_post($the_post_id)
{
    $con = getBdd();
    $the_post_id = (int) $the_post_id;    
    $req = $con->prepare("SELECT post_id, post_title, post_content, post_author, DATE_FORMAT(post_date,'%d/%m/%Y') AS post_date_fr FROM posts WHERE post_id = :the_post_id ");
    $req->bindParam(':the_post_id', $the_post_id, PDO::PARAM_INT);
    $req->execute();
     
    if($req->rowCount() != 1){
        die("aucun article ne correspond à votre requête");
    } else {      
        $post = $req ->fetch();
        $req -> closeCursor();
        return $post;
    }
}


//ajouter un article
function add_post($post_title, $post_content, $post_author)
{
    $con = getBdd();
    $req = $con -> prepare("INSERT INTO posts(post_title, post_content, post_author, post_date) VALUES(:post_title, :post_content, :post_author, now())");
    $req->execute(['post_title' => $post_title, 'post_content' => $post_content, 'post_author' => $post_author]);
    $req -> closeCursor();
}


//effacer un article
function delete_post($the_post_id)
{
    $con = getBdd();
    $req = $con -> prepare("DELETE FROM posts WHERE post_id = ?");    
    $req -> execute([$the_post_id]);
    $message = "<div class='green'>Votre post a bien été effacé</div>";
    set_message($message);
    header("Location: admin.php?section=all_posts");
    $req -> closeCursor();   
}

function update_post($post_title, $post_author, $post_content,$the_post_id)
{
    $con = getBdd();
    $query = "UPDATE posts SET "
            . "post_title = :post_title, "
            . "post_author = :post_author, "    
            . "post_content = :post_content "    
            . "WHERE post_id = :post_id ";    
    
    
    $req = $con -> prepare($query);
    $req->bindParam(':post_title', $post_title, PDO::PARAM_STR);
    $req->bindParam(':post_author', $post_author, PDO::PARAM_STR);
    $req->bindParam(':post_content', $post_content, PDO::PARAM_STR);
    $req->bindParam(':post_id', $the_post_id, PDO::PARAM_INT);
    
    $req->execute();
    
}

