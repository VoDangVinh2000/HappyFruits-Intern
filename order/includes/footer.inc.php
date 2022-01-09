    <?php if (!empty($js)) foreach($js as $j):?>
    <script src="<?=$j['src']?>"></script>
    <?php endforeach;?>
    <?php /*if(empty($is_selling)):?>
    <script src="<?=SITE_URL?>js/firework.js"></script>
    <canvas id="canvas" class="col-sm-8 col-sm-offset-4 col-md-9 col-md-offset-3 main"></canvas>
    <?php endif;*/?>
    <?php if (IS_LIVE && 0):?>
    <script type="text/javascript">
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-42643123-2']);
        _gaq.push(['_trackPageview']);
    
        (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();
    </script>
    <?php endif;?>
  </body>
</html>
