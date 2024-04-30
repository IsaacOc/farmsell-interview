
@extends('layouts.app')

@section('content')
<div class="container" style="margin-top:3em">
        <div>
                <form id="modal-useradd" class="form-horizontal" method="POST" action="{{ route('user.store') }}">
                                      {{ csrf_field() }}
                  <span class="">
                    <b> Users </b>
                  </span>
                  <a class="btn btn-brand btn-success pull-right" href="#myModal" role="button" data-toggle="modal" data-target="#myModal" style="cursor:pointer">+ Add User</a>

                  @include('Users.create')

                </form>
        </div>
        <div class="row align-items-center justify-content-between mt-5 my-lg-5 pt-5">
        
             <div class="col-md-12 table-responsive" style="margin-top:2em">
                
                
                <table class="table-striped" style="width:100%">
                  <thead class="panel-heading" style="background-color:blue;color:white" >
                  <th style="padding:0.1em">#</th>
                  <th style="padding-left:1em">Name</th>
                  <th style="padding-left:3em">Email</th>
                  <th style="padding-left:3em">Role</th>
                  <th style="padding-left:3em">Created</th>
                  <th style="padding-left:3em">Action</th>
                  </thead>
                    <tbody>
                    @foreach($userDB as $users)
                    <tr>
                    <td style="padding:0.1em">{{ $users->id }}</td>
                    <td style="padding:1em"><a href="user/{{$users->id}}/edit ">{{ $users->name }}</a></td>
                    <td style="padding-left:3em">{{ $users->email }}</td>
                    <td style="padding-left:3em">{{ $users->role }}</td>
                    <td style="padding-left:3em">{{ $users->created_at }}</td>       
                    <td style="padding-left:3em">
                
                    <a class="btn btn-brand btn-danger"  href="" 
                                onclick="
                              var result = confirm('Are you sure you wish to delete this User ?');
                            if( result){  
                                event.preventDefault();
                                document.getElementById('delete.form').submit();
                                } 

                                  ">
                    Delete</a>

                                    
                    
                    </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>

                              <form id="delete.form" action="{{ route('user.destroy',[$users->user_id]) }}"
                                     method="POST" style="display:none;">
                                  <input type="hidden" name="_method" value="delete"><!--in laravel need to tell it form is going to delete other than post n get -->
                                {{ csrf_field() }}
                              <form>

               


                
             </div>

             
             

             
        
        
        </div>

</div>
@endsection