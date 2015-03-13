<!-- Page Content -->
<div class="container">

	 <div class="row">
        <div class="col-lg-12">
<<<<<<< HEAD
            <!--<h2 class="page-header"><a href="#"><i class="fa fa-pencil-square-o"></i></a> <?php echo $data['news']->getTitle() ?></h2> WITHOUT LINK TO EDIT PAGE-->
            <?php echo '<h2 class="page-header"><a href="/projagile/public/newscontroller/edit/' . $data['news']->getId() . '"><i class="fa fa-pencil-square-o"></i></a>' . $data['news']->getTitle() . '</h2>' ?>
=======
            <h2 class="page-header">
            	<?php

            	if($data['logged']){
            	echo '<a href="#"><i class="fa fa-pencil-square-o"></i></a> ';
            	}
            	 echo $data['newsdata']['news']->getTitle() ?></h2>
>>>>>>> develop
        </div>

        <div class="col-md-8">
        	<p class="news-info"><?php echo $data['newsdata']['news']->getNormalDate() . ' | Door: ' . $data['newsdata']['news']->getAuthor()  . ' | ' . $data['newsdata']['news']->getDistrict();  ?>
        	</p>
<<<<<<< HEAD
        	<?php
            echo $data['news']->getContent() . '<br/>';

            if(count($data['files']) > 0)
            {
                echo '<br/><p>Bijlagen:</p>';
            }
=======
        	<?php echo $data['newsdata']['news']->getContent() ?>
>>>>>>> develop

            foreach($data['files'] as $file)
            {
                echo '<a href="/projagile/public/uploads/'. $file->path . '">'. $file->path . '</a><br/>';
            }

            ?>

        	<p class="goback"><a href="../../"> Terug naar de homepage </a></p>

        </div>	



