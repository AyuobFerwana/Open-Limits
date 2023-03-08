@extends('ase.dashboard')

@section('title', 'Reset-Password')

@section('style')

@endsection

@section('content')
<div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">User/</span> Reset Password</h4>
    <div class="row">
      <div class="col-xl">
        <div class="card mb-4">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Reset-Password</h5>
          </div>
          <div class="card-body">
            <form>

              {{-- Old Password --}}
              <div class="mb-3">
                <label class="form-label" for="basic-default-fullname">Enter the Old Password</label>
                <input type="password" id="password" class="form-control" name="password"
                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                    aria-describedby="password" />
                  <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>

              </div>

              {{-- New Password --}}
              <div class="mb-3">
                <label class="form-label" for="basic-default-fullname">New Password</label>
                <input type="password" class="form-control" id="new-password" placeholder="abc123@$&456" />
              </div>

              {{-- Password Confirmation --}}
              <div class="mb-3">
                <label class="form-label" for="basic-default-fullname">Password Confirmation</label>
                <input type="password" class="form-control" id="password-confermation" placeholder="abc123@$&456" />
              </div>
              <button type="submit" class="btn btn-primary">Reste</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection

@section('script')

@endsection