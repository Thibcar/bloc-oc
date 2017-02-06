<?php // gère toutes les requêtes concernant les commentaires

// fonction de récupération des options

function get_options($name)
{
    $con = getBdd();
    $req = $con->prepare("SELECT * FROM options WHERE option_name = :option_name");
    $req -> bindParam(':option_name', $name, PDO::PARAM_STR);
    $req -> execute();
    $options = $req->fetch();
    $req->closeCursor();
    return $options;
}

// update les options de modération
function update_options($name, $value)
{
    $con = getBdd();
    $req = $con -> prepare("UPDATE options SET  option_value = :option_value WHERE option_name = :option_name");
    $req -> bindParam(':option_value', $value, PDO::PARAM_INT );
    $req -> bindParam(':option_name', $name, PDO::PARAM_STR );
    $req -> execute();
    $req -> closeCursor();
}


// récupérer les commentaires pour l'affichage sous les articles
function get_comments($the_post_id){
    $con = getBdd();
    $the_post_id = (int) $the_post_id;
    $comments = $con->prepare("SELECT com_id, com_author, com_author_email, com_message, DATE_FORMAT(com_date, '%d/%m/%Y') AS com_date_fr, com_post_id, com_statut FROM comments WHERE com_post_id = ? AND com_statut = 1 ORDER BY com_date DESC");
    $comments->execute([$the_post_id]);    
    return $comments;    
}

// récupérer le nombre de commentaires par article
function get_comments_count($the_post_id) {
    $con = getBdd();    
    $req = $con->query("SELECT com_id FROM comments WHERE com_post_id = " . $the_post_id . " AND com_statut = 1");
    $comments_count = $req->rowCount();
    return $comments_count;    
    
}

//ajouter des commentaires depuis le formulaire

function add_comment($name, $email, $comment, $the_post_id, $com_statut){
    $con = getBdd();
    $req = $con->prepare("INSERT INTO comments (com_author, com_author_email, com_message, com_date, com_post_id, com_statut) VALUES (:auth_name, :email, :comment, now(), :post_id, :com_statut)");
    $req->execute(['auth_name' => $name, 'email' => $email, 'comment' => $comment, 'post_id' => $the_post_id, 'com_statut' => $com_statut]);
}

// récupérer les commentaires pour l'administration
function get_all_comments($offset, $limit){
    $con = getBdd();
    $req = $con->prepare("SELECT com_id, com_author, com_author_email, com_message, DATE_FORMAT(com_date, '%d/%m/%Y') AS com_date_fr, com_post_id, com_statut FROM comments ORDER BY com_date DESC LIMIT :offset, :limit");
    $req->bindParam(':offset', $offset, PDO::PARAM_INT);
    $req->bindParam(':limit', $limit, PDO::PARAM_INT);
    $req->execute();
    $comments = $req->fetchAll();
    $req->closeCursor();
    return $comments;    
}

//approuver un commentaire
function approve_comment($the_com_id)
{
    $con = getBdd();
    $req = $con->prepare("UPDATE comments SET com_statut = 1 WHERE com_id = ?");
    $req->execute([$the_com_id]);
    $req->closeCursor();
}

//désapprouver un commentaire
function unapprove_comment($the_com_id)
{
    $con = getBdd();
    $req = $con->prepare("UPDATE comments SET com_statut = 0 WHERE com_id = ?");
    $req->execute([$the_com_id]);
    $req->closeCursor();
}

//effacer un commentaire
function delete_comment($the_com_id)
{
     $con = getBdd();
    $req = $con -> prepare("DELETE FROM comments WHERE com_id = ?");    
    $req -> execute([$the_com_id]);
    $req -> closeCursor();   
}
