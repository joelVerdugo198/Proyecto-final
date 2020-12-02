<x-app-layout>
    <x-slot name="header">
    	<div class="row">
    		<div class="col-md-8 col-12">
    			<h2 class="font-semibold text-xl text-gray-800 leading-tight">
		            {{ __('Users') }}
		        </h2>
    		</div>
        <div class="col-md-4 col-12">
          <button class="btn btn-primary float-right" data-toggle="modal" data-target="#addUserModal">
            Add User
          </button>       
        </div>
    	</div>     
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

              <table class="table table-striped table-bordered">
          <thead class="thead-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Email</th>
              <th scope="col">Role</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @if (isset($users) && count($users)>0)

            @foreach($users as $user)

            @if ($user->id != $currentuser->id )

            <tr>

              <th scope="row">

                {{ $user->id }}
              </th>
              <td>
                {{ $user->name }}
              </td>
              <td>
                {{ $user->email }}
              </td>
               <td>
                {{ $user->role_id }}
              </td>
              <td>

                <button onclick="editUser({{ $user->id }},'{{ $user->name }}','{{ $user->email }}','{{ $user->password }}','{{ $user->role_id }}')"
                 class="btn btn-warning" data-toggle="modal" data-target="#editUserModal">Edit</button>

                 @php

                 $boolean = 0;

                 @endphp

                 @if(isset($loans) && count($loans)>0)
                 @foreach($loans as $loan)
                 @if($user->id == $loan->user_id && $boolean != $user->id)

                 @php

                 $boolean = $user->id;

                 @endphp

                 <button class="btn btn-primary" id="{{ $iduser = $user->id }}" data-toggle="modal" data-target="#recordUserModal">
                  Record
               </button>

                 @endif
                 @endforeach
                 @endif

                <button onclick="removeUser({{ $user->id }},this)"
                 class="btn btn-danger">Remove</button>
              </td>
              
            </tr>
            @endif
            @endforeach
            @endif
          </tbody>
        </table>

            </div>
        </div>
    </div>

    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add new user</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <form method="POST" action="{{ url('users') }}">
          @csrf
          <div class="modal-body">
            
          <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1">@</span>
                            </div>
                            <input type="text" name="name" class="form-control" placeholder="Name" aria-label="name" aria-describedby="basic-addon1">
                        </div>                          
          </div>

          <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1">@</span>
                            </div>
                            <input type="text" name="email" class="form-control" placeholder="correo@hotmail.com" aria-label="email" aria-describedby="basic-addon1">
                        </div>                          
          </div>

          <div class="form-group">
                        <label for="exampleInputEmail1">Password</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1">@</span>
                            </div>
                            <input type="password" name="password" class="form-control" placeholder="*********" aria-label="email" aria-describedby="basic-addon1">
                        </div>                          
          </div>

          <div class="form-group">
                        <label for="exampleInputEmail1">Role</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1">@</span>
                            </div>
                            <select class="form-control" name="role_id">
                             

                              <option value="{{ $user->role_id == 1 }}"> Admi </option>
                              <option value="{{ $user->role_id == 2 }}"> User </option>

                              
                            </select>
                          </div>                          
                      </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add new user</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <form method="POST" action="{{ url('users') }}">
          @csrf
          @method('PUT')
          <div class="modal-body">
            
          <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1">@</span>
                            </div>
                            <input type="text" name="name" class="form-control" placeholder="Name" aria-label="name" id="name" aria-describedby="basic-addon1">
                        </div>                          
          </div>

          <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1">@</span>
                            </div>
                            <input type="text" id="email" name="email" class="form-control" placeholder="correo@hotmail.com" aria-label="email" aria-describedby="basic-addon1">
                        </div>                          
          </div>

          <div class="form-group">
                        <label for="exampleInputEmail1">Password</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1">@</span>
                            </div>
                            <input type="password" id="password" name="password" class="form-control" placeholder="*********" aria-label="email" aria-describedby="basic-addon1">
                        </div>                          
          </div>

          <div class="form-group">
                        <label for="exampleInputEmail1">Role</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1">@</span>
                            </div>
                            <select class="form-control" name="role_id" id="role_id">
                             

                              <option value="{{ $user->role_id == 1 }}"> Admi </option>
                              <option value="{{ $user->role_id == 2 }}"> User </option>

                              
                            </select>
                          </div>                          
                      </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Save</button>
          <input type="hidden" name="id" id="id">
        </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="recordUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Record user</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

      <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

              <table class="table table-striped table-bordered">
          <thead class="thead-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Book</th>
              <th scope="col">loan</th>
              <th scope="col">return</th>
              <th scope="col">status</th>
            </tr>
          </thead>
          <tbody>

          @foreach($loans as $loan)
            @if($iduser == $loan->user_id)
              @foreach($books as $book)
                @if($loan->book_id == $book->id)

                  <tr>

                    <th scope="row">
                      <div id="id">{{ $iduser }}</div>
                      
                    </th>
                    <td>
                      {{ $book->title }}
                    </td>
                    <td>
                      {{ $loan->loan_date }}
                    </td>
                     <td>
                      {{ $loan->return_date }}
                    </td>
                    <td>
                      {{ $loan->status }}
                    
                    </td>
                    
                  </tr>
                @endif
              @endforeach
            @endif
          @endforeach

          </tbody>
        </table>

            </div>
        </div>
    </div>
      </div>
    </div>
  </div>


    <x-slot name="scripts">
      <script type="text/javascript">

        function editUser(id, name, email, password, role_id){

          $("#name").val(name)
          $("#email").val(email)
          $("#password").val(password)
          $("#role_id").val(role_id)
          $("#id").val(id)

        }

        function removeUser(id, target)
        {
          swal({
            title: "Are you sure?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              axios.delete('{{ url('users') }}/'+id, {
                  id: id,
                  _token: '{{ csrf_token() }}'
                })
                .then(function (response) {
                  console.log(response);
                  if (response.data.code ==200) {
                    swal(response.data.message, {
                      icon: "success",
                    });

                    $(target).parent().parent().remove();

                  }else{
                    swal(response.data.message, {
                      icon: "error",
                    });
                  }
                })
                .catch(function (error) {
                  console.log(error);
                  swal('Error: You have outstanding loans',{ icon:'error'})
                });
            }

          });
        }
      </script>   
    </x-slot>


</x-app-layout>