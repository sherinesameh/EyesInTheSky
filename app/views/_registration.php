

<!-- Modal Structure -->
<div id="registration" class="modal" style="color:#2081A0">
  <div class="modal-content">
    <form action="../app/controllers/register.php" method="POST">
    <h1 style="color:#2081A0">Registration</h1>
    <hr>

    <div class="row">   
      <div class="col s6">
        <i class="material-icons prefix">perm_identity</i>
        <div class="input-field inline">
          <input id="firstname" type="text" name="firstname" required="required">
          <label for="firstname">First Name</label>
        </div>
      </div>

      <div class="col s6">
        <i class="material-icons prefix">perm_identity</i>
        <div class="input-field inline">
          <input id="lastname" type="text" name="lastname" required="required">
          <label for="lastname">Last Name</label>
        </div>
      </div>
    </div>

    <div class="row">
      
      <div class="col s6">
        <i class="material-icons prefix">perm_identity</i>
        <div class="input-field inline">
          <input id="username" type="text" name="username" required="required">
          <label for="username">User Name</label>
        </div>
      </div>

      <div class="file-field input-field col s6">
        <div class="uploadButton">
          <span>Upload Your Image</span>
          <input type="file">
        </div>
        <div class="file-path-wrapper">
          <input class="file-path validate" type="text">
        </div>
      </div>

      <div class="row">   
        <div class="col s6">
          <i class="material-icons prefix">perm_contact_calendar</i>
          <div class="input-field inline">
            <input type="date" name="birthdate" required="required">
          </div>
        </div>

        <div class="col s6">
          <i class="material-icons prefix">email</i>
          <div class="input-field inline">
          <input id="email" type="email" name="email" required="required" class="validate">
          <label for="email" data-error="wrong" data-success="right">Email</label>
          </div>
        </div>
      </div>

    <div class="row">   
      <div class="col s6">
        <i class="material-icons prefix">lock</i>
        <div class="input-field inline">
          <input id="password" type="password" name="password" required="required">
          <label for="password">Password</label>
        </div>
      </div>

      <div class="col s6">
        <i class="material-icons prefix">lock</i>
        <div class="input-field inline">
          <input id="confirmPassword" type="password" name="confirm" required="required">
          <label for="confirmPassword">Confirm Password</label>
        </div>
      </div>
    </div>

    <hr>
    <div class="col s5">
       <p>By clicking Register, you agree on our <a href="#">terms and condition</a>.</p>
    </div>
    <div class="col s2 offset-s5">
       <input type="submit" value="Register" class="button" id="registerButton">
    </div>
    </form> 

  </div>
</div>





