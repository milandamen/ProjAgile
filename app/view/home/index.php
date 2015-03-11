<header>

</header>
<!-- Page Content -->
<?php require_once 'carousel.php'; ?>

<div class="container">

    <!-- Features Section -->
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">De Bunders</h2>
        </div>

		<?php require_once 'module-news.php'; ?>

	</div>
    <!-- /.row -->
    	<!-- Script to Activate the Carousel -->
    <script>
        $('.carousel').carousel({
            interval: 5000 //changes the speed
        })
    </script>