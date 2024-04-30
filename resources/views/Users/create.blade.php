<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"aria-hidden="true">×</button>
                <h3 id="myModal" class="model-title">Add User</h3>               
            </div>

            <div class="modal-body">
                
                    <div class="form-group{{ $errors->has('Name') ? ' has-error' : '' }}">
                        <div class="col-md-12">
                            <label for="Name" class="control-label">Name</label>
                            <input id="Name" type="text" class="form-control" name="Name" placeholder="Full Name" required>

                            @if ($errors->has('Name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('Name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('Email') ? ' has-error' : '' }}">
                        <div class="col-md-12">
                            <label for="Email" class="control-label">Email</label>
                            <input id="Email" type="Email" class="form-control" name="Email" placeholder="Email" required>

                            @if ($errors->has('Email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('Email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                        <label for="Password" class="control-label">Password</label>
                            <input id="Password" type="Password" class="form-control"  name="Password" placeholder="Password" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="radio"data-toggle="buttons-radio">
                                <label>
                                    <input type="radio" name="role" value="admin" required> Admin&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="radio" name="role" value="user" required> User
                                </label>
                            </div>
                        </div>
                    </div>                   
                
            
            </div>

            <div class="modal-footer">
            
                    <div class="form-group">
                        <div class="col-md-9 pull-left">
                            <button class="btn" data-dismiss="modal" aria-hidden="true">
                                Close
                            </button>                                        
                        </div>
                        
                        <div class="col-md-3 ">
                            <button type="submit" class="btn btn-brand btn-success"  >
                                + Add User
                            </button>         
                        </div>
                    </div>

            </div>


        </div>
    </div>
</div>

@section('scripts')@if($errors->has('email') || $errors->has('password'))<script>
$(function(){
    $('#myModal').modal({show:true});
});</script>@endif
@endsection