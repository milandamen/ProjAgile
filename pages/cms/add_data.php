<?php   ?>
 


  <div class="container">
  <ol class="breadcrumb">
     <li><a href="index.php">Home</a></li>
     <li><a href="index.php">Content Panel</a></li>
     <li class="active">Content toevoegen </li>
    </ol>
    	 <h2>Voeg data toe aan:  </h2>
        
 <div class="row">
	<div class="col-lg-12 form-group">
 	 	<form role="form">
 			<select name="pagina" class="form-control">
  				<option value="home">Home </option>
  				<option value="Deelwijk A">Deelwijk A</option>
  				<option value="Partners">Partners </option>
  				<option value="Nieuws">Nieuws</option>
			</select> 
 	 	</form>
     </div>
 </div>


<div class="row">
    <div class="col-lg-12 form-group">

    <!--	<form role="form" class="form-control">
    	<input value="addfile" type="file" /> 
        </form>  -->

<label class="btn btn-success btn-md" for="my-file-selector">
     <span class="glyphicon glyphicon-upload" aria-hidden="true"></span><input id="my-file-selector" type="file" style="display:none;">
    Selecteer bestand
</label>
<label class="btn btn-danger btn-md">
     <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
    Verwijder bestand
</label>


    </div>
</div>



<div class="row">
    <div class="col-lg-12">
        <form action="">
            <div class="form-group">
                <label for="">Informatie</label>
                <textarea name="" id="summernote" cols="30" rows="10" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-submit">Plaats data</button>
        </form>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#summernote').summernote({
            height: 300
        });
    });


</script>
