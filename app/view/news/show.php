<?php ?>

<!-- Page Content -->
<div class="container">

	 <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header"><a href="#"><span class="glyphicon glyphicon-new-window" aria-hidden="true"></span></a> <?php echo $data['news']->getTitle() ?></h2>
        </div>

        <div class="col-md-8">
        	<p class="news-info"><?php echo $data['news']->getNormalDate() . ' | Door: ' . $data['news']->getAuthor()  . ' | ' . $data['news']->getDistrict();  ?>
        	</p>
        	<?php echo $data['news']->getContent() ?>


        			<br/>

        	<p class="goback"><a href="../../"> Terug naar de homepage </a></p>

        </div>	


	</div>

