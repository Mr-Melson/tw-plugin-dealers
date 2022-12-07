<?php global $post_info; ?>

<div class="col-6 dealer_toogle" data-town="<?= $post_info['cities']; ?>">
    <div class="dealer_single">

        <h3>
            <?= $post_info['title']; ?>
        </h3>

        <div class="content">
            <?= $post_info['content']; ?>
        </div>

    </div>
</div>
