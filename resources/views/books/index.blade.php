<x-app-layout>
    <x-slot name="header">
    	<div class="row">
    		<div class="col-md-8 col-12">
    			<h2 class="font-semibold text-xl text-gray-800 leading-tight">
		            {{ __('Books') }}
		        </h2>
    		</div>
    		<div class="col-md-4 col-12">
    			<button class="btn btn-primary float-right" data-toggle="modal" data-target="#addBookModal">
    				Add Book
    			</button> 			
    		</div>
    	</div>     
    </x-slot>

    <!-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                
            	

          <table class="table table-striped table-bordered">
				  <thead class="thead-dark">
				    <tr>
				      <th scope="col">#</th>
				      <th scope="col">Title</th>
				      <th scope="col">Description</th>
				      <th scope="col">Category</th>
               <th>Action</th>
				    </tr>
				  </thead>
				  <tbody>
				  	@if (isset($books) && count($books)>0)
				  	@foreach($books as $book)
				    <tr>
				      <th scope="row">
				      	{{ $book->id }}
				      </th>
				      <td>
				      	{{ $book->title }}
				      </td>
				      <td>
				      	{{ $book->description }}
				      </td>
				      <td>
				      	{{ $book->category_id }}
				      </td>
              <td>
                <button onclick="editBook({{ $book->id }},'{{ $book->title }}','{{ $book->description }}','{{ $book->year }}','{{ $book->pages }}','{{ $book->isbn }}','{{ $book->editorial }}','{{ $book->edition }}','{{ $book->autor }}','{{ $book->cover }}','{{ $book->category_id }}')"
                 class="btn btn-warning" data-toggle="modal" data-target="#editBookModal">Edit Book</button>

                <button onclick="removeBook({{ $book->id }},this)"
                 class="btn btn-danger">Remove Book</button>
              </td>

				    </tr>
				    
				    @endforeach
				    @endif
				  </tbody>
				</table>

            </div>
        </div>
    </div> -->

  <div class="row" style="padding: 20px;">
    <div class="col-12">
      <div class="card-deck mb-4">
      @if (isset($books) && count($books)>0)
      @foreach ($books as $book)
          
            <div class="card" style="width: 18rem;" >
            <img  src="{{ asset('img/books/' .$book->cover) }}" class="card-img-top p-2" alt="...">
            
            <div class="card-body">
              <h5 class="card-title">{{ $book->title }}</h5>
              <p class="card-text">Description: {{ $book->description }}</p>
              <p class="card-text">Year: {{ $book->year }}</p>
              <p class="card-text">Pages: {{ $book->pages }}</p>
              <p class="card-text">isbn: {{ $book->isbn }}</p>
              <p class="card-text">Editorial: {{ $book->editorial }}</p>
              <p class="card-text">Edition: {{ $book->edition }}</p>
              <p class="card-text">Category: {{ $book->category_id }}</p>
            
            
              </div>      

              <div align="center" style="padding-bottom: 10px;">
                <button  onclick="editBook({{ $book->id }},'{{ $book->title }}','{{ $book->description }}','{{ $book->year }}','{{ $book->pages }}','{{ $book->isbn }}','{{ $book->editorial }}','{{ $book->edition }}','{{ $book->autor }}','{{ $book->cover }}','{{ $book->category_id }}')"
                 class="btn btn-warning" data-toggle="modal" data-target="#editBookModal">Edit</button>

                 <button onclick="detailBook({{ $book->id }},this)"
                 class="btn btn-warning" data-toggle="modal" data-target="#detailBookModal">Detail</button>

                 <button onclick="removeBook({{ $book->id }},this)"
                 class="btn btn-danger">Remove</button>
              </div>
        </div>                    
        
      @endforeach 
      @endif
      </div>
    </div>
  </div>

  //add book
  <div class="modal fade" id="addBookModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add new Book</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="{{ url('books')}}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Title</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1">@</span>
                            </div>
                            <input type="text" name="title" class="form-control" placeholder="Title" aria-label="Title" aria-describedby="basic-addon1">
                          </div>                          
                        <small id="emailHelp" class="form-text text-muted">Book title.</small>
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1">Description</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1">@</span>
                            </div>
                            <textarea class="form-control" name="description" aria-label="With textarea"></textarea>
                          </div>                          
                        <small id="emailHelp" class="form-text text-muted">Book title.</small>
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1">Year</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1">@</span>
                            </div>
                            <input type="number" name="year" class="form-control" placeholder="year" aria-label="year" aria-describedby="basic-addon1">
                          </div>                          
                        <small id="bookYear" class="form-text text-muted">Book year.</small>
                      </div>
                      
                      <div class="form-group">
                        <label for="exampleInputEmail1">Pages</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1">@</span>
                            </div>
                            <input type="number"  name="pages" class="form-control" placeholder="Pages" aria-label="Pages" aria-describedby="basic-addon1">
                          </div>                          
                        <small id="emailHelp" class="form-text text-muted">Book pages.</small>
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1">ISBN</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1">@</span>
                            </div>
                            <input type="text" name="isbn"  class="form-control" placeholder="ISBN" aria-label="ISBN" aria-describedby="basic-addon1">
                          </div>                          
                        <small id="emailHelp" class="form-text text-muted">Book ISBN.</small>
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1">Editorial</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1">@</span>
                            </div>
                            <input type="text"  name="editorial" class="form-control" placeholder="Editorial" aria-label="Editorial" aria-describedby="basic-addon1">
                          </div>                          
                        <small id="emailHelp" class="form-text text-muted">Book Editorial.</small>
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1">Edition</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1">@</span>
                            </div>
                            <input type="number"  name="edition" class="form-control" placeholder="Edition" aria-label="Edition" aria-describedby="basic-addon1">
                          </div>                          
                        <small id="emailHelp" class="form-text text-muted">Book Edition.</small>
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1">Autor</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1">@</span>
                            </div>
                            <input type="text"  name="autor" class="form-control" placeholder="Autor" aria-label="Autor" aria-describedby="basic-addon1">
                          </div>                          
                        <small id="emailHelp" class="form-text text-muted">Book Autor.</small>
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1">Cover</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1">@</span>
                            </div>
                            <input type="file"  name="cover" class="form-control" name="cover">
                          </div>                          
                        <small id="emailHelp" class="form-text text-muted">Book Cover Image.</small>
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1">Category</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1">@</span>
                            </div>
                            <select class="form-control" name="category_id">
                              @if (isset($categories) && count($categories)>0)
                              @foreach ($categories as $category)

                              <option value="{{ $category->id }}"> {{ $category->name }}</option>

                              @endforeach
                              @endif
                            </select>
                          </div>                          
                      </div>
                </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                  </div>
              </form>
        
      </div>
    </div>
  </div>
   
  //edit book
  <div class="modal fade" id="editBookModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Book</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="{{ url('books')}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Title</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1">@</span>
                            </div>
                            <input type="text" name="title" class="form-control" placeholder="Title" id="title" aria-label="Title" aria-describedby="basic-addon1">
                          </div>                          
                        <small id="emailHelp" class="form-text text-muted">Book title.</small>
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1">Description</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1">@</span>
                            </div>
                            <textarea class="form-control" name="description" id="description" aria-label="With textarea"></textarea>
                          </div>                          
                        <small id="emailHelp" class="form-text text-muted">Book title.</small>
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1">Year</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1">@</span>
                            </div>
                            <input type="number" name="year" class="form-control" placeholder="year" id="year" aria-label="year" aria-describedby="basic-addon1">
                          </div>                          
                        <small id="bookYear" class="form-text text-muted">Book year.</small>
                      </div>
                      
                      <div class="form-group">
                        <label for="exampleInputEmail1">Pages</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1">@</span>
                            </div>
                            <input type="number"  id="pages"  name="pages" class="form-control" placeholder="pages" aria-label="pages" aria-describedby="basic-addon1">
                          </div>                          
                        <small id="emailHelp" class="form-text text-muted">Book pages.</small>
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1">ISBN</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1">@</span>
                            </div>
                            <input type="text" name="isbn"  class="form-control" placeholder="ISBN" id="isbn" aria-label="ISBN" aria-describedby="basic-addon1">
                          </div>                          
                        <small id="emailHelp" class="form-text text-muted">Book ISBN.</small>
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1">Editorial</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1">@</span>
                            </div>
                            <input type="text"  name="editorial" class="form-control" placeholder="Editorial" id="editorial" aria-label="Editorial" aria-describedby="basic-addon1">
                          </div>                          
                        <small id="emailHelp" class="form-text text-muted">Book Editorial.</small>
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1">Edition</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1">@</span>
                            </div>
                            <input type="number"  name="edition" class="form-control" placeholder="Edition" id="edition" aria-label="Edition" aria-describedby="basic-addon1">
                          </div>                          
                        <small id="emailHelp" class="form-text text-muted">Book Edition.</small>
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1">Autor</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1">@</span>
                            </div>
                            <input type="text"  name="autor" class="form-control" placeholder="Autor" id="autor" aria-label="Autor" aria-describedby="basic-addon1">
                          </div>                          
                        <small id="emailHelp" class="form-text text-muted">Book Autor.</small>
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1">Cover</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1">@</span>
                            </div>
                            <input type="file"  name="cover" class="form-control" name="cover" id="cover">
                          </div>
                          <label for="exampleInputEmail1">Selecciona un archivo si deseas cambiar el actual</label>
                        <small id="emailHelp" class="form-text text-muted">Book Cover Image.</small>
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1">Category</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1">@</span>
                            </div>
                            <select class="form-control" name="category_id" id="category">
                              @if (isset($categories) && count($categories)>0)
                              @foreach ($categories as $category)

                              <option value="{{ $category->id }}"> {{ $category->name }}</option>

                              @endforeach
                              @endif
                            </select>
                          </div>                          
                      </div>
                </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                    <input type="hidden" name="id" id="id">
                  </div>
              </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="detailBookModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
           <h5 class="modal-title" id="exampleModalLabel">Detail Book</h5>
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
              <th scope="col">Name</th>
              <th scope="col">Email</th>
              <th scope="col">Loan date</th>
              <th scope="col">Delivery date</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">
               
              </th>
              <td>
              
              </td>
              <td>
                
              <td>
               
              </td>
              <td>
                
              </td>

            </tr>
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
        function editBook(id,title,description,year,pages,isbn,editorial,edition,autor,cover,category_id)
        {


          $("#title").val(title)
          $("#description").val(description)
          $("#year").val(year)
          $("#pages").val(pages)
          $("#isbn").val(isbn)
          $("#editorial").val(editorial)
          $("#edition").val(edition)
          $("#autor").val(autor)
          $("#cover").val('img/books'.cover)
          $("#category").val(category_id)
          $("#id").val(id)
        }

        function removeBook(id, target)
        {
          swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this book!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              axios.delete('{{ url('books') }}/'+id, {
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
           
              /*
            } else {
              swal("Your imaginary file is safe!");
            }*/
          });
        }
      </script>   
    </x-slot>
</x-app-layout>
