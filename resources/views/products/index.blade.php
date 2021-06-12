@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb mb-3">
            <div class="pull-left">
                <h2>Produtos</h2>
            </div>

            <div class="input-group col-6 my-3" >
                <input  type="search" id="searchProduct" class="form-control rounded" placeholder="Buscar Produto"
                aria-label="Buscar-Produto"
                  aria-describedby="search-addon" onkeyup="buscar(this)" />
                <button type="button" class="btn btn-outline-primary disabled">Buscar</button>
              </div>
            <div class="pull-right">
                @can('product-create')
                <a class="btn btn-success" href="{{ route('admin.products.create') }}"> Create New Product</a>
                @endcan
            </div>
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Details</th>
            <th width="280px">Action</th>
        </tr>
	    @foreach ($products as $product)
	    <tr>
	        <td>{{ $product->id}}</td>
	        <td>{{ $product->name }}</td>
	        <td>{{ $product->detail }}</td>
	        <td>
                <form action="{{ route('admin.products.destroy',$product->id) }}" method="POST">

                    @can('product-edit')
                    <a class="btn btn-primary" href="{{ route('admin.products.edit',$product->id) }}">Edit</a>
                    @endcan


                    @csrf
                    @method('DELETE')
                    @can('product-delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                    @endcan
                </form>
	        </td>
	    </tr>
	    @endforeach
    </table>

    <div>
        {!! $products->links() !!}
    </div>
    <meta name="csrf-token" content="@csrf">

@endsection

@section('js')

    <script>
       async function buscar(search){

        searchTerm = search.value;

        let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        console.log(token)

        let resultado;

        resultado = await fetch('{{route("api.products")}}',{
            headers: {
                "Content-Type": "application/json",

            "X-CSRF-Token": token
            },
            method: 'post',
            credentials: "same-origin",
            body:  JSON.stringify({
                    search: searchTerm,
                })
        })
            .then(function(response){
                response.json().then(function(response){
                    console.log(response)
                })
            })
            .catch(function(error){
                console.log(error)
            })
        }

    </script>

@endsection
