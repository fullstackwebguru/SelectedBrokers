<?php
foreach ($guides as $guide) {
echo $this->render('_guide_card', [
        'guide' => $guide
	]);
}

if ($more > 0)  { ?>
	<div class="col-lg-12">
        <ul class="pager">
            <li class="article_more"><a class="news-more-btn" data-pos="<?= $startPos ?>" >More ...</a>
            </li>
        </ul>
    </div>
<?php } ?>
