<tr class="text-md-center" id="{{$user->username}}">
  <td>{{$user->username}}</td>
  <td>{{$user->displayName}}</td>
  <td>{{$user->email}}</td>
  <td>{{$user->ticketCount}}</td>
  <td>{{$user->userLevel}}</td>
  <td>{{$user->enabled ? 'true' : 'false'}}</td>
  <td>{{$user->lastLogin}}</td>
  <td>
    <button type="button" class="btn btn-primary editBtn">Edit</button>
  </td>
</tr>
<tr class="editTr">
  <td colspan="8" class="">
    <form id="{{$user->username}}">
      <div class="form-group row">
        <div class="form-group row col-md-4">
          <label for="disp_name" class="col-md-6 col-form-label text-md-right">Display Name</label>
          <input type="text" name="disp_name" class="form-control col-md-6" />
        </div>
        <div class="form-group row col-md-4">
          <label for="password" class="col-md-6 col-form-label text-md-right">Password</label>
          <input type="password" name="password" class="form-control col-md-6" />
        </div>
        <div class="form-group row col-md-4">
          <label for="cp" class="col-md-6 col-form-label text-md-right">CP</label>
          <input type="text" name="cp" class="form-control col-md-6" />
        </div>
        <div class="form-group row col-md-4">
          <label for="ticket_count" class="col-md-6 col-form-label text-md-right">Ticket Count</label>
          <input type="text" name="ticket_count" class="form-control col-md-6" />
        </div>
        <div class="form-group row col-md-4">
          <label for="user_level" class="col-md-6 col-form-label text-md-right">User Level</label>
          <input type="text" name="user_level" class="form-control col-md-6" />
        </div>
        <div class="form-group row col-md-4">
          <div class="col-md-6 offset-md-5">
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
              <label class="btn btn-primary active editRadio">
                  <input type="radio" name="enabled" value="enabled" checked>Enabled</input>
                </label>
              <label class="btn btn-primary editRadio">
                  <input type="radio" name="enabled" value="disabled">Disabled</input>
                </label>
            </div>
          </div>
        </div>
        <div class="editBreak col-md-10 offset-md-1"></div>
        <div class="form-group col-md-2 offset-md-4">
          <button type="button" class="btn btn-primary btn-block updateBtn">Update</button>
        </div>
        <div class="form-group col-md-2">
          <button type="button" class="btn btn-danger btn-block deleteBtn">Delete</button>
        </div>
      </div>
    </form>
  </td>
</tr>
