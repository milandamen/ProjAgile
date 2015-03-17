<div class="container">

    <div class="row">
    <div class="col-lg-12">

    	<h2 >Introductie wijzigen</h2>
        <form name="editIntro" action="" method="post" enctype="multipart/form-data">
            <?php echo '<input type="hidden" name="pageId" value="' . $data['intro']->getPageNr() .'" >'; ?>
            <div class="row col-md-8">
                <div class="form-group">
                    <label class="label-form" for="title">Titel</label>
                    <?php echo '<input id="title" type="text" class="form-control" name="title" value="'. $data['intro']->getTitle() . '" placeholder="Titel">'; ?>
                </div>
            </div>

            <div class="row col-md-8">
                <div class="form-group">
                    <label class="label-form" for="content">Content</label>
                    <?php echo '<textarea id="content" class="form-control" rows="6" name="content">' . $data['intro']->getText() .'</textarea>' ?>
                </div>
            </div>

            <div class="row col-md-8">
            
                <input class="btn btn-danger" type="submit"  onclick="goBack()" value="Annuleer">
                <input class="btn btn-success" type="submit" onclick="validate()" value="Opslaan">

            </div>

        </form>
    </div>
        <!-- JavaScript that enables adding and removing rows -->
    <script src="/ProjAgile/public/js/introUpdate.js"></script>


