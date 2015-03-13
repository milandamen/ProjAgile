<div class="container">
    <ol class="breadcrumb">
        <li><a href="index.php">Home</a></li>
        <li><a href="index.php">Content Panel</a></li>
        <li class="active">Nieuws toevoegen</li>
    </ol>

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Nieuws toevoegen</h1>
        </div>
    </div>

        <div class="col-lg-12">
            <form name="createNews" onsubmit="return validate()" action="/projagile/public/NewsController/save/true" method="post" enctype="multipart/form-data">

                <div class="row">
                    <div class="form-group">
                        <label class="label-form" for="title">Titel</label>
                        <input id="title" type="text" class="form-control" name="title" placeholder="Titel">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <label class="label-form" for="content">Content</label>
                        <textarea id="content" class="form-control" rows="6" name="content"></textarea>
                    </div>
                </div>

                <div class="row">
                    <label class="label-form" for="Sectie">Sectie</label>
                    <select name="district" class="form-control">
                        <option value="0">Home</option>
                        <?php
                        foreach($data as $section)
                        {
                            echo '<option value="'. $section->getId() .'">' . $section->getName() . '</option>';
                        }
                        ?>
                    </select>
                </div>

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

<script type="text/javascript" >
    $("#cancel").click(function(){
        document.getElementById("upload").value = "";
    });

    function validate() {
        if (document.getElementById("title").value == "") {
            alert("Vul a.u.b. een titel in.");
            return false;
        }
        if(document.getElementById("content").value == "")
        {
            alert("Vul a.u.b. een content in.");
            return false;
        }
    }
</script>