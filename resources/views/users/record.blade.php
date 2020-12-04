<x-app-layout>
    <x-slot name="header">
    	<div class="row">
    		<div class="col-md-8 col-12">
    			<h2 class="font-semibold text-xl text-gray-800 leading-tight">
		            {{ __('Record user') }}
		        </h2>
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
              <th scope="col">Book</th>
              <th scope="col">Loan</th>
              <th scope="col">Return</th>
              <th scope="col">Status</th>
            </tr>
          </thead>
          <tbody>

          @if (isset($loans) && count($loans)>0)
          @foreach($loans as $loan)
            @if($user->id == $loan->user_id)
              @foreach($books as $book)
                @if($loan->book_id == $book->id)

                  <tr>

                    <th scope="row">
                      
                      {{ $book->id }}
                      
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
          @endif
          </tbody>
        </table>

            </div>
        </div>
    </div>


</x-app-layout>