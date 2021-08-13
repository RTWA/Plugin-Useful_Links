<div class="UsefulLinks">
    <?php $i = 1;
    foreach ($this->settings['items'] as $item) : ?>
        <?php $url = (strpos(strtolower($item['linkURL']), 'fireflycloud.net/resource.aspx?id=')) ? $item['linkURL'].'&officient=on' : $item['linkURL']; ?>
        <a id="item<?php echo $i; ?>" href="<?php echo $url; ?>" target="_blank"
            class="relative block hover:bg-gray-50 dark:hover:bg-gray-700 dark:text-white <?php echo isset($item['linkIcon']) ? $item['linkIcon'] : ''; ?>">
            <h5 class="font-semibold text-lg"><?php echo $item['linkName']; ?></h5>
            <?php if ($item['linkDesc'] <> '') : ?>
                <p class="mb-1"><?php echo $item['linkDesc']; ?></p>
            <?php endif; ?>
        </a>
    <?php $i++; endforeach; ?>
</div>