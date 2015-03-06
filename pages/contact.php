<?php  


?>

  <div class="container">
        
	<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">
					Contact
				</h1>
			</div>
			<div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4> Webmaster</h4>
                    </div>
                    <div class="panel-body">
                        <p><span class="glyphicon glyphicon-user"></span>  Willem Websma</p>
						<p><span class="glyphicon glyphicon-earphone"></span>  0612345678</p>
						<p><span class="glyphicon glyphicon-envelope"></span>  willemwebsma@gmail.com</p>
                    </div>
                </div>
            </div>
			<div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4> Discussie moderator</h4>
                    </div>
                    <div class="panel-body">
                        <p><span class="glyphicon glyphicon-user"></span>  Martin Moderati</p>
						<p><span class="glyphicon glyphicon-earphone"></span>  0687654321</p>
						<p><span class="glyphicon glyphicon-envelope"></span>  martinmoderati@gmail.com</p>
                    </div>
                </div>
            </div>
			<div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4> Content beheerder</h4>
                    </div>
                    <div class="panel-body">
                        <p><span class="glyphicon glyphicon-user"></span>  Carly Content</p>
						<p><span class="glyphicon glyphicon-earphone"></span>  0609182631</p>
						<p><span class="glyphicon glyphicon-envelope"></span>  carlycontent@gmail.com</p>
                    </div>
                </div>
            </div>
			<div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4> Secretariaat</h4>
                    </div>
                    <div class="panel-body">
                        <p><span class="glyphicon glyphicon-user"></span>  Sien Sipkema</p>
						<p><span class="glyphicon glyphicon-earphone"></span>  0739472946</p>
						<p><span class="glyphicon glyphicon-envelope"></span>  snijboontje@hotmail.com</p>
                    </div>
                </div>
            </div>
			
		</div>
		
		<hr>
		
		
		<div class="row">
            <div class="col-md-8">
                <h3>Neem direct contact op</h3>
                <form name="sentMessage" id="contactForm" novalidate>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Naam:</label>
                            <input type="text" class="form-control" id="name" required data-validation-required-message="Please enter your name.">
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Telefoon:</label>
                            <input type="tel" class="form-control" id="phone" required data-validation-required-message="Please enter your phone number.">
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Email:</label>
                            <input type="email" class="form-control" id="email" required data-validation-required-message="Please enter your email address.">
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Bericht:</label>
                            <textarea rows="10" cols="100" class="form-control" id="message" required data-validation-required-message="Please enter your message" maxlength="999" style="resize:none"></textarea>
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
							<label for="recipient">Selecteer geaddresseerde</label>
							<select class="form-control" id = "recipient" style="width:auto;">
								<option value = "1">Webmaster</option>
								<option value = "2">Discussie moderator</option>
								<option value = "3">Content beheerder</option>
								<option value = "4">Secretariaat</option>
							</select>
						</div>
                    </div>
                    <div id="success"></div>
                    <button type="submit" class="btn btn-default" style="background-color:#563D7C;color:#FFFFFF">Verzend</button>
                </form>
            </div>
