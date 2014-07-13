<div class="row">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>Register</h2>
        </div>
        <div class="panel-body">
            <form action="register.php" role="form" method="post">
                <fieldset>
                    <div class="form-group">
                        <label for="username">Username: </label>
                        <input autofocus name="username" placeholder="Enter Username" type="text"/>
                    </div>
                    <div class="form-group">
                        <label for="study">My Study Name: </label> "The
                        <input name="study" placeholder="Enter Name" type"text" /> Study"
                    </div>
                    <div class="form-group">
                        <label for="Password">Password: </label>
                        <input name="password" placeholder="Password" type="password"/>
                    </div>
                    <div class="form-group">
                        <label for="Password">Enter  Again: </label>
                        <input name="conf_pw" placeholder="Password" type="password"/>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-info">Register</button> or <a href="login.php">log in</a>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>