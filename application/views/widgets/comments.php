<div id="alithemes_comment-1" class="sidebar-widget widget_alithemes_comment clr">
    <h4><span>Comments</span></h4>
    <ul class="alith-recent-comments-widget alith-clr">
        <?php
        $last_comments = $this->CommentsModel->getLast(3);
        foreach ($last_comments as $comment) {
        $comment_page = $this->Contents->getById($comment->content_id);
        ?>
        <li class="alith-clr">
            <a href="<?= $langlink.$comment_page->shortcut?>" title="<?= $comment->name?>" class="alith-avatar"><img src="<?= base_url()?>public/style/images/comments.png" width="50" height="50" alt="" class="avatar avatar-50 wp-user-avatar wp-user-avatar-50 photo avatar-default"></a>
            <div class="alith-details">
                <strong><?= $comment->name?>:</strong>
                <span><?= word_limiter($comment->message,10)?></span>
                <a href="<?= $langlink.$comment_page->shortcut?>" title="more" class="alith-more"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
            </div>
        </li>
        <?php
        }
        ?>
    </ul>
</div>
