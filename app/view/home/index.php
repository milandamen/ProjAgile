
<!-- Header Carousel -->
<header id="carousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#carousel" data-slide-to="0" class="active"></li>
        <li data-target="#carousel" data-slide-to="1"></li>
        <li data-target="#carousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
        <div class="item active">
            <img src="/ProjAgile/public/img/slide1.jpg" alt="...">
            <div class="carousel-caption">
                <h3>Actueel Item 1</h3>
            </div>
        </div>
        <div class="item">
            <img src="/ProjAgile/public/img/slide2.jpg" alt="...">
            <div class="carousel-caption">
                <h3>Actueel Item 2</h3>
            </div>
        </div>
        <div class="item">
            <img src="/ProjAgile/public/img/slide3.jpg" alt="...">
            <div class="carousel-caption">
                <h3>Actueel Item 3</h3>
            </div>
        </div>
    </div>

    <!-- Controls -->
    <a class="left carousel-control" href="#carousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
    </a>
    <a class="right carousel-control" href="#carousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
    </a>
</header>

<!-- Page Content -->
<div class="container">

    <!-- Features Section -->
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">De Bunders</h2>
        </div>

        <div class="col-md-8">
		<?php require_once 'module-introduction.php'; ?>
		<?php require_once 'module-news.php'; ?>

		</div>
		
	