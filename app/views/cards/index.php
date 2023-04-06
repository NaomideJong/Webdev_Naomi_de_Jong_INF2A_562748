<?php
$url = "https://api.magicthegathering.io/v1/cards?random=true&pageSize=5";
$data = file_get_contents($url);
$cards = json_decode($data)->cards;?>
<div class="row">
    <?php foreach ($cards as $card): ?>
        <div class="card mb-3" style="max-width: 540px;">
            <div class="row g-0">
                <div class="col-md-4">
                    <?php if (isset($card->imageUrl)): ?>
                        <img src="<?php echo $card->imageUrl; ?>" alt="<?php echo $card->name; ?>">
                    <?php else: ?>
                        <img src="/images/card.jpg" alt="<?php echo $card->name; ?>">
                    <?php endif; ?>
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $card->name; ?></h5>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

</div>
