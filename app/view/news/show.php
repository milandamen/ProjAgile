<div class="container">

	 <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">
            	<?php
            	if($data['loggedIn']){
            	echo '<a href="/projagile/public/newscontroller/edit/' . $data['newsdata']['news']->getId() . '"><i class="fa fa-pencil-square-o"></i></a> ';
            	}
            	 echo $data['newsdata']['news']->getTitle() ?></h2>
        </div>

        <div class="col-md-8">
        	<p class="news-info"><?php echo $data['newsdata']['news']->getNormalDate() . ' | Door: ' . $data['newsdata']['news']->getAuthor()  . ' | ' . $data['newsdata']['news']->getDistrict();  ?>
        	</p>

        	<?php
            echo $data['newsdata']['news']->getContent() . '<br/>';

            if(count($data['files']) > 0)
            {
                echo '<br/><p>Bijlagen:</p>';
            }

            foreach($data['files'] as $file)
            {
                $withoutId = substr($file->path, stripos($file->path, 'd') + 1);
                echo '<a href="/projagile/public/uploads/'. $file->path . '">'. $withoutId . '</a><br/>';
            }

            ?>

        	<p class="goback"><a href="../../"> Terug naar de homepage </a></p>

        </div>



