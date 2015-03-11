<div class="container">
<div class="row">
    <div class="col-md-8">
        <h3>Log in</h3>
        <form method="post" action="" name="login" id="loginform">
            <div class="control-group form-group">
                <div class="controls">
                    <label>Gebruikersnaam:</label>
                    <input type="text" class="form-control" name="username" required>
                    <p class="help-block"></p>
                </div>
            </div>
            <div class="control-group form-group">
                <div class="controls">
                    <label>Wachtwoord:</label>
                    <input type="password" class="form-control" name="password" required>
                </div>
            </div>
            <div class="control-group form-group">
                <div class="controls">
                    <input type="checkbox" id="rememberme" style="margin-right: 10px;"><label>Onthoud mij</label>
                </div>
            </div>
            <div id="success"></div>
            <button type="submit" class="btn btn-default" style="background-color:#563D7C;color:#FFFFFF">Log in</button>
        </form>
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function()
        {
            var elements = document.getElementsByTagName("INPUT");

            for (var i = 0; i < elements.length; i++)
            {
                elements[i].oninvalid = function(e)
                {
                    e.target.setCustomValidity("");
                    if (!e.target.validity.valid)
                    {
                        e.target.setCustomValidity("Dit veld is verplicht!");
                    }
                };
                elements[i].oninput = function(e)
                {
                    e.target.setCustomValidity("");
                };
            }
        })
    </script>