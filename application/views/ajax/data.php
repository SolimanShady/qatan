<style type="text/css">
.download_result{
    background: #E9ECEF;
    width: 100%;
    padding: 10px !important;
}
</style>

<ul class="download_result">

<?php if ( isset($result["videos"]) ): ?>

    <?php foreach ($result["videos"] as $video): ?>

        <li>
            <video src="<?php echo $video['url'];?>"
                   poster="<?php echo $video['poster'];?>"
                   controls="controls">
            </video>
            <a href="<?php echo $video['url'];?>"
                class="download-link"
                rel="noreferrer" download><?php echo $lang->download;?></a>
        </li>

    <?php endforeach; ?>

<?php endif; ?>

<?php if ( isset($result["photos"]) ): ?>

    <?php foreach ($result["photos"] as $photo): ?>

        <li>
            <img src="<?php echo $photo['url'];?>"
            onclick="window.open(this.src, '_blank');">
            <a href="javascript:void(0);"
                class="download-link"
                rel="noreferrer"
                onclick="saveAs('<?php echo $photo["url"];?>', '<?php echo explode("?", $photo["url"])[0];?>');">
                <?php echo $lang->download; ?>
            </a>
        </li>

    <?php endforeach; ?>

<?php endif; ?>

</ul>
