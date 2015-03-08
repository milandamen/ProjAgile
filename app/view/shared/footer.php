    <!-- Footer -->
        <footer>
            <?php
            foreach($data['footerColumns'] as $footercolumn)
            {
                echo '<ul class="col-sm-4">';
                foreach($footercolumn as $item)
                {
                    $link = '#';
                    if($item->getLink() != null){
                        $link = $item->getLink();
                    }
                    echo '<li><a href="' . $link . '">' . $item->getText() . '</a></li>';
                }
                echo '</ul>';
            }
            ?>
        </footer>

    <?=var_dump($data['footerColumns'])?>

    </div>
    <!-- /.container -->

</body>
</html>


