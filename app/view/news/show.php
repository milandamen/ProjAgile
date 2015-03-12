<?php ?>

<!-- Page Content -->
<div class="container">

	 <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">
            	<?php

            	if($data['logged']){
            	echo '<a href="#"><i class="fa fa-pencil-square-o"></i></a> ';
            	}
            	 echo $data['newsdata']['news']->getTitle() ?></h2>
        </div>

        <div class="col-md-8">
        	<p class="news-info"><?php echo $data['newsdata']['news']->getNormalDate() . ' | Door: ' . $data['newsdata']['news']->getAuthor()  . ' | ' . $data['newsdata']['news']->getDistrict();  ?>
        	</p>
        	<?php echo $data['newsdata']['news']->getContent() ?>


        			<br/>

        	<p class="goback"><a href="../../"> Terug naar de homepage </a></p>

        </div>	



