<?php
foreach ($companies as $broker) {
echo $this->render('_broker_card', [
        'broker' => $broker
	]);
}

if ($more > 0)  { ?>
	<div class="col-lg-12">
        <ul class="pager">
            <li class="article_more"><a class="review-more-btn" data-pos="<?= $startPos ?>" >More ...</a>
            </li>
        </ul>
    </div>
<?php } ?>
