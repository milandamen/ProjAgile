 </div>
    <!-- /.row -->   
    <!-- if this ends in index.php the sidebar can't be included properly in the actioncontroller. -->
    	<!-- Script to Activate the Carousel -->
    <script>
        $('.carousel').carousel({
            interval: 5000 //changes the speed
        })
    </script>


    <!-- Footer -->
        <hr>
        <div class="col-md-12 footer panel panel-default">
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
                <?php
                if($data['logged']){

                global $Base_URI;
                echo '<a href="' . $Base_URI . 'footerController/footerupdate"><i class="fa fa-pencil-square-o"></i></a>';
                } ?>
            </div>

    </div>
    <!-- /.container -->

</body>
</html>


