<x-app-layout>
    <x-slot name="header">
    	<div class="row">
    		<div class="col-md-8 col-12">
    			<h2 class="font-semibold text-xl text-gray-800 leading-tight">
		            {{ __('Loans') }}
		        </h2>
    		</div>
        
    	</div>     
    </x-slot>

   
    
        @if (isset($users) && count($users)>1)
        @foreach ($users as $user) 
        <table class="table table-striped table-bordered">
          @if (Auth::user()->hasPermissionTo('view users'))
          <h4>{{ $user->name }}</h4>
          @endif
          <div class="row row-cols-1 row-cols-md-3 card-deck">
        @if (isset($loans) && count($loans)>0)
        @foreach ($loans as $loan)  
   
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
      
        @endforeach 
	      @endif
        </div>
      </table>
        @endforeach 
	      @endif
   
        
   

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