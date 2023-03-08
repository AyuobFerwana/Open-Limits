@extends('ase.dashboard')
@section('title', 'Edit Account User')


@section('style')

@endsection


@section('content')

<!-- Content wrapper -->
<div class="content-wrapper">
  <!-- Content -->

  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Account</h4>

    <div class="row">
      <div class="col-md-12">
        <div class="card mb-4">
          <h5 class="card-header">Profile Details</h5>
          <!-- Account -->
          <form id="form" onsubmit="event.preventDefault(); updateUser();">
            @csrf
            <div class="card-body">
              <div class="d-flex align-items-start align-items-sm-center gap-4">
                <img
                  src="{{auth()->user()->image_url}}"
                  alt="user-avatar"
                  class="d-block rounded"
                  height="100"
                  width="100"
                  id="uploadedAvatar"
                />
                <div class="button-wrapper">
                  <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                    <span class="d-none d-sm-block">Upload new photo</span>
                    <i class="bx bx-upload d-block d-sm-none"></i>
                    <input
                      type="file"
                      id="upload"
                      class="account-file-input"
                      hidden
                      accept="image/png, image/jpeg"
                    />
                  </label>
                  <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                    <i class="bx bx-reset d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Reset</span>
                  </button>

                  <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                </div>
              </div>
            </div>
            <hr class="my-0" />
            <div class="card-body">
              <div class="row">

                <div class="mb-3 col-md-8">
                  <label for="firstName" class="form-label">Full Name</label>
                  <input class="form-control" type="text" id="UsersName" value="{{ auth()->user()->UsersName }}" />
                </div>

                <div class="mb-3 col-md-8">
                  <label for="email" class="form-label">E-mail</label>
                  <input disabled class="form-control" type="email" id="email" value="{{ auth()->user()->email }}"
                    placeholder="email@example.com" />
                </div>

                <div class="mb-3 col-md-8">
                  <label class="form-label" for="phoneNumber">Phone Number</label>
                  <div class="input-group input-group-merge">
                    <input type="number" id="phone" value="{{ auth()->user()->phone }}" name="phoneNumber"
                      class="form-control" placeholder="202 555 0111" />
                  </div>
                </div>

              </div>

              <div class="mt-2">
                <button type="submit" class="btn btn-primary me-2">Save changes</button>
                <a href="{{ url()->previous() }}" class="btn btn-dark">Cancel</a>
              </div>
            </div>
          </form>
          <!-- /Account -->
        </div>
      </div>
    </div>
  </div>
  <!-- / Content -->

  <!-- Footer -->
  <footer class="content-footer footer bg-footer-theme">
    <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
      <div class="mb-2 mb-md-0">
        ©
        <script>
          document.write(new Date().getFullYear());
        </script>
        , made with ❤️ by
        <a target="_blank" class="footer-link fw-bolder">Ayuob Ferwana</a>
      </div>
    </div>
  </footer>
  <!-- / Footer -->

  <div class="content-backdrop fade"></div>
</div>
<!-- Content wrapper -->

@endsection


@section('script')
<script>
  function updateUser() {
            let formData = new FormData();
            formData.append('_method', 'PUT');
            formData.append('UsersName', document.getElementById('UsersName').value);
            formData.append('email', document.getElementById('email').value);
            formData.append('phone', document.getElementById('phone').value);

            if (document.getElementById('upload').files.length > 0) {
                formData.append('image', document.getElementById('upload').files[0]);
            }
            axios.post('{{ route('users.accountUpdate',$users) }}', formData)
                .then(function(response) {
                    toastr.success(response.data.message);
                    console.log(response);
                    document.getElementById('form');
                })
                .catch(function(error) {
                    toastr.error(error.response.data.message);
                    console.log(error);
                });
        }


        document.addEventListener('DOMContentLoaded', function (e) {
          (function () {
            const deactivateAcc = document.querySelector('#formAccountDeactivation');
        
            // Update/reset user image of account page
            let accountUserImage = document.getElementById('uploadedAvatar');
            const fileInput = document.querySelector('.account-file-input'),
              resetFileInput = document.querySelector('.account-image-reset');
        
            if (accountUserImage) {
              const resetImage = accountUserImage.src;
              fileInput.onchange = () => {
                if (fileInput.files[0]) {
                  accountUserImage.src = window.URL.createObjectURL(fileInput.files[0]);
                }
              };
              resetFileInput.onclick = () => {
                fileInput.value = '';
                accountUserImage.src = resetImage;
              };
            }
          })();
        });
</script>

@endsection