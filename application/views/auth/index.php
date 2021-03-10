<div class="container-fluid">
  <div class="row justify-content-center" style="height: 100vh">
    <div class="align-self-center">
      <div class="row">
        <div class="card">
          <div class="card-body">
            <div class="row justify-content-center">
              <div class=" align-self-center">
                <img class="mb-3" src="<?= base_url('assets') ?>/img/cvmajulancar.png" alt="logo">
              </div>
            </div>

            <form method="post" action="<?= base_url('auth') ?>">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="material-icons">person</i>
                  </span>
                </div>
                <input value="teknik" name="username" id="username" type="text" class="form-control" placeholder="username" autofocus>
              </div>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="material-icons">lock</i>
                  </span>
                </div>
                <input value="unwahas" id="myPassword" name="password" id="password" type="password" class="form-control" placeholder="password">
              </div>
              <div class="form-check ml-4 mt-4">
                <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" onclick="showPassword()" value="">
                  Tampilkan password
                  <span class="form-check-sign">
                    <span class="check"></span>
                  </span>
                </label>
              </div>
              <div class="row justify-content-center">
                <div class=" align-self-center">
                  <button type="submit" name="submit" class="btn btn-primary ml-4">Login</button>
                </div>
              </div>
            </form>
            <?= $this->session->flashdata('message'); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    function showPassword() {
      var x = document.getElementById("myPassword");
      if (x.type == "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    }
  </script>