@extends('layout.app')
@section('main')
<br>
<div class="container">
  <div class="text-right">
    <a href="/products/create" class="btn btn-dark">New-Product</a>
  </div> 
  <table class="table table-hover mt-2">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Description</th>
        <th>Image</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($products as $product) 
      <tr>
        <td>{{$loop->index+1}}</td>
        <td>{{$product->name}}</td>
        <td>{{$product->description}}</td>
        <td>
          <img src="products/{{$product->image}}" class="rounded-circle"
          width="30" height="30"/>
        </td>
        <td>
          <a href="products/{{$product->id}}/edit" class="btn btn-dark btn-small">Edit</a>
          <a href="products/{{$product->id}}/show" class="btn btn-dark btn-small">View</a>
          
          <form action="products/{{$product->id}}/delete" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm" style="height: 37px;">Delete</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  {{$products->links()}}
</div>
@endsection
