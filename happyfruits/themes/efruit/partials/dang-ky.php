<?php
    
?>
<div class="customer-account">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2">
                <div class="form-account">
                    <div class="header-create-account">
                        <h2>Create Account</h2>
                        <p>Please Register using account detail bellow.</p>
                    </div>
                    <!--Form action register-->
                    <form action="" method="post">
                        <div class="main-create-account-fillout">
                            <div class="error-fillout-createaccount">
                            </div>
                            <label for="username"></label>
                            <input id="username" type="text" name="username" class="input-account" autocapitalize="words" autofocus placeholder="Username" required>

                            <label for="password"></label>
                            <input pattern="[a-zA-Z0-9_-]{6,}" id="password" type="password" name="password" class="input-account" autocapitalize="words" placeholder="Password" required>

                            <label for="phone"></label>
                            <input id="phone" type="text" name="phone" class="input-account" autocapitalize="words" placeholder="Phone number" required>
                            
                            <label for="email"></label>
                            <input id="email" type="email" name="email" class="input-account" autocapitalize="words" placeholder="Email" required>
                        </div>
                        <div class="input-submit-account">
                            <input id="" type="submit" value="Create" name="register">
                        </div>
                    </form>
                    <div class="end-form-createaccount">
                        <a href="#">Return to Store</a>
                        <div class="link-to-login">
                            <span>Already have an account?</span>
                           
                            <a href="">Sign in</a>.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>