<?php global $cities, $posts_query; ?>

<section id="dealers_list">

    <div class="container">

        <div class="row">
            <div class="col-12">
                <h2>Дилеры</h2>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <select name="cities" id="cities">
                    <option selected value="-1">Все города</option>

                    <?php foreach ($cities as $city): ?>
                        <option value="<?= $city->term_id; ?>"><?= $city->name; ?></option>
                    <?php endforeach; ?>

                </select>
            </div>
        </div>

        <div class="row">

            <?php while ($posts_query->have_posts()):

                $posts_query->the_post();

                global $post_info;
                $post_info = $this->getDealerSingleInfo(get_the_ID());

                include __DIR__ . '/dealer-single.php';

            endwhile; ?>

        </div>

    </div>

</section>
