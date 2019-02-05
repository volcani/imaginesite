@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">Account Manager</div>
          <div class="card-body">
            <!--
            <form method="get">
              <div class="form-group row">
                <label for="account-search" class="col-md-8  offset-md-1">Account Search</label>
                <input type="text" class="form-control col-md-8 offset-md-1" id="account-search" placeholder="Username">
                <div class="col-md-1">
                  <button type="submit" class="btn btn-primary">Search</button>
                </div>
              </div>
            </form>
            <hr>
            -->
            <table class="table table-bordered table-comp">
              <thead>
                <tr class="text-md-center">
                  <th>Username</th>
                  <th>Display Name</th>
                  <th>Email</th>
                  <th>Ticket Count</th>
                  <th>User Level</th>
                  <th>CP</th>
                  <th>Enabled</th>
                  <th>Last Login</th>
                  <th>Edit</th>
                </tr>
              </thead>
              @foreach ($users as $user)
                @include('accountcontrol.accounttableentry')
              @endforeach
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
