<div class="container">
    <ol class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li><a href="#">Content Panel</a></li>
        <li class="active">Nieuws wijzigen</li>
    </ol>

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Nieuws wijzigen</h1>
        </div>
    </div>

    <div class="col-lg-12">
        <form name="editNews" onsubmit="return validate()" action="/projagile/public/NewsController/save/false" method="post" enctype="multipart/form-data">
            <?php echo '<input type="hidden" name="newsId" value="' . $data['news']->getId() .'" >'; ?>
            <div class="row">
                <div class="form-group">
                    <label class="label-form" for="title">Titel</label>
                    <?php echo '<input id="title" type="text" class="form-control" name="title" value="'. $data['news']->getTitle() . '" placeholder="Titel">'; ?>
                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <label class="label-form" for="content">Content</label>
                    <?php echo '<textarea id="content" class="form-control" rows="6" name="content">' . $data['news']->getContent() .'</textarea>' ?>
                </div>
            </div>

            <div class="row">
                <label class="label-form" for="Sectie">Sectie</label>
                <select name="district" class="form-control">
                    <option value="0">Home</option>
                    <?php
                    foreach($data['sections'] as $section)
                    {
                        echo '<option value="'. $section->getId() .'">' . $section->getName() . '</option>';
                    }
                    ?>
                </select>
            </div>

            <?php
            #If there are uploaded files
            if(count($data['files']) > 0)
            {
                echo '<div class="row">
                <br/>
                <p>Bestanden die gekoppeld zijn aan dit artikel:</p>';
                foreach($data['files'] as $file)
                {
                    echo '<p>' . $file->path .'</p>';
                }
                echo '<label for="keepFiles" class="control-label input-group">Wilt u deze bestanden behouden?</label>
                <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-default active">
                        <input type="radio" name="keepFiles" value="true" checked="true">Ja
                    </label>
                    <label class="btn btn-default">
                        <input type="radio" name="keepFiles" value="false">Nee
                    </label>
                </div>
            </div>';
            }
            ?>

            <div class="row">
                <br/>
                <input  id="upload" type='file' name='file[]' multiple>
                <br/>
                <label class="btn btn-danger btn-md" id="cancel"> Verwijder bestanden</label>
            </div>

            <div class="row">
                <br/>
                <label for="hidden" class="control-label input-group">Verborgen</label>
                <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-default">
                        <input type="radio" name="hidden" value="true">Ja
                    </label>
                    <label class="btn btn-default active">
                        <input type="radio" name="hidden" value="false" checked="true">Nee
                    </label>
                </div>
            </div>
            <div class="row">
                <br/>
                <input class="btn btn-submit" type="submit" value="opslaan">
            </div>
        </form>

        <script src="/ProjAgile/public/js/newsValidate.js"></script>