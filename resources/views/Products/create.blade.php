@extends('layout.app')
@section('main')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-sm-8">
        <div class="card mt-3 p-3">
            <form action="/products/store" method="POST" enctype="multipart/form-data">
                @csrf
                <label for="">Name</label>
                <input 
                type="text" 
                name="name" 
                value="{{old('name')}}"
                class="form-control"/>
                @if ($errors->has('name'))
                  <span class="text-danger">{{$errors->first('name')}}</span>
                @endif
                <label for="">Description</label>
                <textarea 
                name="description" 
                id="" 
                cols="30" 
                rows="10"
                class="form-control">
                {{old('description')}}    
                </textarea>
                @if ($errors->has('description'))
                  <span class="text-danger">{{$errors->first('description')}}</span>
                @endif
                <div class="form-group">
                    <label for="">Image</label>
                    <input 
                    type="file" 
                    name="image" 
                    value="{{old('image')}}"
                    class="form-control"/>
                    @if ($errors->has('image'))
                      <span class="text-danger">{{$errors->first('image')}}</span>
                    @endif
                </div>
                <button 
                type="submit" 
                class="btn btn-dark"
                >Submit</button>
            </form>
        </div>
    </div>
  </div>
</div>

@endsection