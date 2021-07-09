<?php
    session_start();
    include("funcs.php");
    loginCheck();
   
    $id = $_SESSION["id"];

    try {
        $pdo = new PDO('mysql:dbname=dog_db;charset=utf8;host=localhost', 'root', 'root');
    } catch (PDOException $e) {
        exit('DbConnectError:'.$e->getMessage());
    }

    $stmt = $pdo->prepare("DELETE FROM t_table WHERE id=:id");
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $status = $stmt->execute();

    if ($status==false) {
        $error = $stmt->errorInfo();
        exit("QueryError:".$error[2]);
    } else {

        $_SESSION = array();

        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time()-42000, '/');
        }

        session_destroy();

        header("Location: login.php");
        exit;
    }

?>