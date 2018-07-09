<?php
require_once 'model/ChapterManager.php';
require_once 'model/CommentManager.php';
require_once 'model/AdminManager.php';

function listChaptersBackend()
{
    $chapterManager = new \Alaska\Blog\Model\ChapterManager();
    $chapters = $chapterManager->getChapters();

    include 'view/backend/listChaptersView.php';
}

function chapterBackend()
{
    $chapterManager = new \Alaska\Blog\Model\ChapterManager();
    $commentManager = new \Alaska\Blog\Model\CommentManager();

    $chapter = $chapterManager->getChapter($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);

    include 'view/backend/chapterView.php';
}

function addChapter($title, $content)
{
    $chapterManager = new \Alaska\Blog\Model\ChapterManager();

    $affectedLines = $chapterManager->ajoutChapter($title, $content);
   
    if ($affectedLines === true) {
        header('Location: index.php?action=listChaptersBackend');
        
    } else {
        throw new Exception('Impossible d\'ajouter le chapitre !');
    }
}

function modifyChapter($id, $title, $content)
{    
    $chapterManager = new \Alaska\Blog\Model\ChapterManager();
    
    $affectedLines = $chapterManager->updateChapter($id, $title, $content);
    
    if($affectedLines === false) {
        throw new Exception('Impossible de modifier ce chapitre !');
    } else {
        header('Location: index.php?action=listChaptersBackend');
    }
}

function deleteChapter($id)
{
    $chapterManager = new \Alaska\Blog\Model\ChapterManager();
    $supprimChapter = $chapterManager->deleteChapter($id);
    
    if ($supprimChapter > 0) {
        header('Location: index.php?action=listChaptersBackend');
    } else {
        throw new Exception('Impossible de supprimer ce chapitre !');
    }

}

function commentBackend($id)
{
    $commentManager = new \Alaska\Blog\Model\CommentManager();
    $comment = $commentManager->getComment($_GET['id']);

    include 'view/frontend/commentView.php';
}

function signalCommentBackend() 
{
    $commentManager = new \Alaska\Blog\Model\CommentManager();
    $comments = $commentManager->getSignalComments();
    
    include 'view/backend/signalCommentView.php';
}

function logOut()
{
    session_destroy();
    header('Location:index.php');
}


