    <!-- Footer -->
        <hr>
        <footer >
            <?php
            foreach($data['footerColumns'] as $footercolumn)
            {
                $c = 0;
                echo '<div class="footerlist-container">
                        <ul class="col-sm-4">';
                foreach($footercolumn as $item)
                {
                    $link = '#';
                    if($item->getLink() != null){
                        $link = $item->getLink();
                    }
                    if($c == 0)
                    {
                        echo '<li><a href="' . $link . '"><h3>' . $item->getText() . '</h3></a></li>';
                    }
                    else
                    {
                        echo '<li><a href="' . $link . '">' . $item->getText() . '</a></li>';
                    }
                    $c++;
                }
                echo '</ul>
                        </div>';
            }
            ?>
            <div class="footer-edit-link">
                <!-- ABSOLUTE LINK!!!! Werkt mogelijk niet -->
                <a href="/ProjAgile/public/footerController/footerupdate"><i class="fa fa-pencil-square-o"></i></a>
            </div>
        </footer>
    </div>
    <!-- /.container -->

</body>
</html>


