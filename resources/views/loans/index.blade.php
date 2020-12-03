<x-app-layout>
    <x-slot name="header">
    	<div class="row">
    		<div class="col-md-8 col-12">
    			<h2 class="font-semibold text-xl text-gray-800 leading-tight">
		            {{ __('Loans') }}
		        </h2>
    		</div>
        @if (Auth::user()->hasPermissionTo('crud categories'))
    		<div class="col-md-4 col-12">
    			<button class="btn btn-primary float-right" data-toggle="modal" data-target="#addLoanModal">
    				Add Loan
    			</button> 			
    		</div>
        @endif
    	</div>     
    </x-slot>

   
    
        @if (isset($users) && count($users)>1)
        @foreach ($users as $user) 
        @if (isset($loans) && count($loans)>0)
        @foreach ($loans as $loan)  
        <table class="table table-striped table-bordered">
        @if ($user->id == $loan->user_id)
          @if (Auth::user()->hasPermissionTo('view users'))
          <h4  style="padding-top: 10px;" >{{ $user->name }}</h4>
          @endif
        @endif
           <div class="row row-cols-1 row-cols-md-3 card-deck">
      	   
		    @if (isset($books) && count($books)>0)
		    @foreach ($books as $book)
        @if (($loan->status)==('loan'))
        @if (($loan->book_id)==($book->id))
        @if (($loan->user_id)==($user->id) && Auth::user()->hasPermissionTo('view users'))
        <div class="col mb-4">
          <div class="card h-100" >
			      <img  src="{{ asset('img/books/' .$book->cover) }}" class="card-img-top p-2" alt="...">
			      <div class="card-body">
			        <h5 class="card-title">{{ $book->title }}</h5>
              <p class="card-text">Description: {{ $book->description }}</p>
			        <p class="card-text">Year: {{ $book->year }}</p>
              <p class="card-text">Pages: {{ $book->pages }}</p>
			        <p class="card-text">Isbn: {{ $book->isbn }}</p>
	            <p class="card-text">Editorial: {{ $book->editorial }}</p>
			        <p class="card-text">Edition: {{ $book->edition }}</p>
			        <p class="card-text">Autor: {{ $book->autor }}</p>
			        <p class="card-text">Category: {{ $book->category_id }}</p>
              <p class="card-text">Usuario: {{ $user->id }}</p>
			        <p class="card-text">Email: {{ $user->email }}</p>
			        <p class="card-text">Loan date: {{ $loan->loan_date }}</p>
              <p class="card-text">Return date: {{ $loan->return_date }}</p>
	            <p class="card-text">Status: {{ $loan->status }}</p>
			      </div>      
            <div align="center" style="padding-bottom: 10px;">
                      @if (Auth::user()->hasPermissionTo('delete loans')) 
                      <button onclick="removeLoan({{ $loan->id }},this)"
                       class="btn btn-danger">Remove</button>
                      @endif

			                <button onclick="returnLoan({{ $loan->id }},'{{ $loan->status = 'return' }}','{{ $date }}', this)"
                       class="btn btn-warning">Return Book</button>
			      </div>
          </div>
        </div>
        @elseif (($loan->user_id)==($currentuser->id))
        <div class="col mb-4" style="padding-top: 20px">
          <div class="card h-100" >
            <img  src="{{ asset('img/books/' .$book->cover) }}" class="card-img-top p-2" alt="...">
            <div class="card-body">
              <h5 class="card-title">{{ $book->title }}</h5>
              <p class="card-text">Description: {{ $book->description }}</p>
              <p class="card-text">Year: {{ $book->year }}</p>
              <p class="card-text">Pages: {{ $book->pages }}</p>
              <p class="card-text">Isbn: {{ $book->isbn }}</p>
              <p class="card-text">Editorial: {{ $book->editorial }}</p>
              <p class="card-text">Edition: {{ $book->edition }}</p>
              <p class="card-text">Autor: {{ $book->autor }}</p>
              <p class="card-text">Category: {{ $book->category_id }}</p>
              <p class="card-text">Email: {{ $user->email }}</p>
              <p class="card-text">Loan date: {{ $loan->loan_date }}</p>
              <p class="card-text">Return date: {{ $loan->return_date }}</p>
              <p class="card-text">Status: {{ $loan->status }}</p>
            </div>      
            <div align="center" style="padding-bottom: 10px;">
                      @if (Auth::user()->hasPermissionTo('delete loans')) 
                      <button onclick="removeLoan({{ $loan->id }},this)"
                       class="btn btn-danger">Remove</button>
                      @endif

                      <button onclick="returnLoan({{ $loan->id }},'{{ $loan->status = 'return' }}','{{ $date }}', this)"
                       class="btn btn-warning">Return Book</button>
            </div>
          </div>
        </div>
        @endif
        @endif
        @endif
        
		    @endforeach 
		    @endif
      </table>
        @endforeach 
	      @endif
        @endforeach 
	      @endif
   
        
   <div class="modal fade" id="addLoanModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-lg">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Add new Loan</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>

	      <form method="POST" action="{{ url('loans') }}">
	      	@csrf
	      	<div class="modal-body">

	      		 <div class="form-group">
                        <label for="exampleInputEmail1">Cliente</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1">@</span>
                            </div>
                            <select class="form-control" name="user_id">
                              @if (isset($users) && count($users)>0)
                              @foreach ($users as $user)

                              <option value="{{ $user->id }}"> {{ $user->name }}</option>

                              @endforeach
                              @endif
                            </select>
                          </div>                          
                      </div>
	        	
	      		 <div class="form-group">
                <label for="exampleInputEmail1">Title</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1">@</span>
                    </div>
                    <select class="form-control" name="book_id">
                              @if (isset($books) && count($books)>0)
                              @foreach ($books as $book)

                              <option value="{{ $book->id }}"> {{ $book->title }}</option>

                              @endforeach
                              @endif
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

  <x-slot name="scripts">
      <script type="text/javascript">
        function returnLoan(id,status,return_date, target) {
        swal({
                  title: "Are you sure?",
                  icon: "warning",
                  buttons: true,
                  dangerMode: false,
                })
                .then((willDelete) => {
                  if (willDelete) {
                    
                  axios.put('/loans', {
                  id: id,
                  status: status,
                  return_date: return_date
              })
              .then(function (response) {
                        if (response.data.code == 200) {
                            swal( response.data.message, {
                              icon: "success",
                            });

                            $(target).parent().parent().remove();
                        } else {
                            swal( response.data.message, {
                              icon: "error",
                            });
                        }
                      })
                      .catch(function (error) {
                        
                    });
                  }
                });
        }
        function removeLoan(id, target)
        {
          
          swal({
                  title: "Are you sure?",
                  icon: "warning",
                  buttons: true,
                  dangerMode: false,
                })
                .then((willDelete) => {
            if (willDelete) {
              axios.delete('{{ url('loans') }}/'+id, {
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
                  swal('Error ocurred',{ icon:'error'})
                });
            }
        
          });
        }
      </script>   
    </x-slot>
</x-app-layout>