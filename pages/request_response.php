<?php

$title ="----";

?>

<!-- Page Content -->
<div class="container">
    <ol class="breadcrumb">
        <li><a href="index.php">Home</a></li>
        <li><a href="index.php?p=contact">Contact</a></li>
        <li><a href="index.php?p=verzoeken">Verzoeken aan secretariaat</a></li>
        <li class="active">Verzoek voor discussie over de bloementuin</li>
    </ol>

    <h4><span class="glyphicon glyphicon-align-justify"></span> Verzoek voor discussie over de bloementuin</h4>


    <div class="row">

        <div class="panel panel-default discussiontable topictable">
            <table class="table table-hover" >

                <tr>
                    <td class="message">
                        Kan er een discussie gestart worden voor de bloementuin?
                    </td>
                    <td class="person-info">
                        <p>
                            10 februari 2015, 11:00<br/><br/>
                            <a href="#">Madelief Meeldraad</a>  <br/>
                            Berichten: 10 <br/>
                            Wijk:
                    </td>

                </tr>

                <!-- RE: on first Message   -->
                <tr>
                <tr class="topic-info">
                    <td colspan="2"><span class="glyphicon glyphicon-menu-hamburger"></span>  RE: Verzoek voor discussie over de bloementuin </td>
                </tr>
                <tr>
                    <td class="message">
                        Welke bloementuin?
                    </td>
                    <td class="person-info">
                        <p>
                            10 februari 2015, 13:00<br/> <br/>
                            <a href="#">Sien Sipkema</a>  <br/>
                            Berichten: 111 <br/>
                            Wijk:
                    </td>
                </tr>
                </tr>

                <tr>
                <tr class="topic-info">
                    <td colspan="2"><span class="glyphicon glyphicon-menu-hamburger"></span>  RE: Verzoek voor discussie over de bloementuin </td>
                </tr>
                <tr>
                    <td class="message">
                        Dat weet ik ook niet...
                    </td>
                    <td class="person-info">
                        <p>
                            10 februari 2015, 15:00<br/> <br/>
                            <a href="#">Madelief Meeldraad</a>  <br/>
                            Berichten: 10 <br/>
                            Wijk:
                    </td>
                </tr>
                </tr>



            </table>
        </div>

    </div>

    <div class="row">
        <div class="col-lg-12">
            <form action="">
                <div class="form-group">
                    <label for="">Reageer</label>
                    <textarea name="" id="summernote" cols="30" rows="10" class="form-control"></textarea>
                </div>
                <button type="submit" class="btn btn-submit">Plaats reactie</button>
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

    
