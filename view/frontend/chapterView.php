<?php $title = 'Billet pour l\'Alaska'; ?>

<?php  ob_start(); ?>

<div class="container">
    <div class="jumbotron jumbotron-fluid">
        <img class="col-sm-12 col-md-5" src="../../img/newYork.jpg" alt="new york">
        <h1><?= htmlspecialchars($chapter['title']) ?></h1><em> le <?= $chapter['creation_date_fr'] ?></em>
        <br>
        <p><?= nl2br(htmlspecialchars($chapter['content'])) ?></p>
    </div>
    <div class="jumbotron jumbotron-fluid">
        <h2><strong>Commentaires</strong></h2>
        <?php
         while ($comment = $comments->fetch())
        {
        ?>
        <p><strong><?= htmlspecialchars($comment['author']) ?><br></strong>le <?= $comment['comment_date_fr'] ?></p>
        <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
        <a href="index.php?action=comment&amp;id=<?= $comment['id'] ?>"> (signaler)</a>
        <br><br>
        <?php
        } 
        ?>
        <p><strong>Ajoutez un commentaire si vous le voulez!</strong></p>
            <form action="index.php?action=addComment&amp;id=<?= $chapter['id'] ?>" method="post">
                <div>
                    <label for="author">Auteur</label><br>
                    <input type="text" id="author" name="author">
                </div><br>
                <div>
                    <label for="comment">Commentaire</label><br>
                    <textarea id="comment" name="comment"></textarea>
                </div>
                <div>
                    <input type="submit" />
                </div>
            </form>
    </div>
</div>
<?php  $content = ob_get_clean(); ?>
<?php require 'view/frontend/template.php'; ?>