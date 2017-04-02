<div class="col s6 offset-s1">
 <div class="row">
    
    <div class="card" id="jobcard">
            
      <div class="card-image" id="cardImg">
        <img src="./assets/img/docker.jpg">
        <span class="card-title grey-text">Upload New Job</span>
        <a class="btn-floating halfway-fab btn-large waves-effect waves-light blue activator">
          <i class="material-icons">add</i>
        </a>
      </div>
      
      <div class="card-content">
        <p>What is Docker File and How to Upload?</p>
        <br>
        <p>
          Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
          tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
          quis nostrud exercitation ullamco laboris
        </p>
      </div>
    
      <div class="card-reveal">

          <span class="card-title grey-text text-darken-4">Upload New Job
            <i class="material-icons right">close</i>
          </span>
          <div class="row">
              &nbsp;
          </div>
          
          <div class="row">
            <form action="newJob">
            
              <div class="row">
                <div class="file-field input-field col s10 offset-s1">
                  <!-- <div class="col-s4"> -->
                    <div class="btn" id="formbtn">
                        <span>Docker File</span>
                        <input type="file">
                    </div>
                  <!-- </div> -->
                  <!-- <div class="row"> -->
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text">
                    </div>
                  <!-- </div> -->
                </div>
              </div>
              
              <div class="row">
                  <div class="file-field input-field col s10 offset-s1">
                     <!-- <div class="col-s4"> -->
                        <div class="btn" id="formbtn">
                          <span>Your Files</span>
                          <input type="file" multiple>
                        </div>
                      <!-- </div> -->
                      <!-- <div class=row> -->
                          <div class="file-path-wrapper">
                            <input class="file-path validate" type="text">
                          </div>
                      <!-- </div> -->
                  </div>
              </div>
              <button class="btn waves-effect waves-light col s4 offset-s7" type="submit" name="action">
                  Submit <i class="material-icons right">send</i>
              </button>
            </form>        
          </div>
      
      </div>
    
  
    </div>
 </div>


 <div class="row">
    <div class="card-panel grey lighten-4">

       <span class="card-title grey-text">History</span>
       <table>
        <thead>
          <tr>
              <th data-field="id">ID</th>
              <th data-field="name">Name</th>
              <th data-field="state">State</th>
              <th data-field="date">Date</th>      
          </tr>
        </thead>

        <tbody>
          <tr>
            <td>id1</td>
            <td>name1</td>
            <td>ready</td>
            <td>02.10.16</td>
          </tr>
          
          <tr>
            <td>id2</td>
            <td>name2</td>
            <td>pending</td>
            <td>06.03.17</td>
          </tr>

        </tbody>
      </table>
    </div>
 </div>
</div>
</div>
</div>
   