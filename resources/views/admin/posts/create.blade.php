@extends('admin.layout')

@push('css')
    <link rel="stylesheet" href="{{asset('adminlte/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('adminlte/plugins/summernote/summernote-bs4.css')}}">
@endpush

@section('header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">Posts</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.')}}">Inicio</a></li>
          <li class="breadcrumb-item"><a href="{{ route('admin.posts.index')}}">Posts</a></li>
          <li class="breadcrumb-item active">Inicio</li>
        </ol>
    </div>
</div>  
@endsection
@section('content')
<form action="{{ route('admin.posts.store') }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-md-8">
            <div class="card card-success">
                
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Título</label>
                        <input class="form-control" 
                            type="text" name="title"
                            value="{{ old('title') }}"
                            placeholder="Título de la publicacion" 
                        >
                    </div>
                    <div class="form-group">
                        <label for="">Contenido</label>
                        <div>
                            <textarea class="textarea"
                                id="body" 
                                name="body" 
                                placeholder="Contenido de la publicación"
                                style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"    
                            >
                                {{ old('body') }}
                            </textarea>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-primary">
                <div class="card-body">
                    <div class="form-group">
                        <label>Fecha de Publicación:</label>
                        <input type="date" 
                            class="form-control datetimepicker-input" 
                            name="published_at" 
                            value="{{ old('published_at') }}"
                        >
                    </div>
                    <div class="form-group">
                        <label for="">Categorías</label>
                        <select name="category_id" 
                            class="form-control"
                            value="{{ old('category_id') }}"
                        >
                            <option value="">Seleccionar</option>
                            
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}
                                >
                                    {{ $category->name }}
                                </option>
                            @endforeach

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Etiquetas</label>
                        <select name="tags[]" 
                            class="form-control select2bs4" 
                            multiple="multiple"
                            {{-- value="{{ old('tags') }}" --}}
                        >
                            <option value="">Seleccionar</option>
                            
                            @foreach ($tags as $tag)
                                <option value="{{ $tag->id }}"
                                    {{ collect(old('tags'))->contains($tag->id) ? 'selected' : '' }}
                                >
                                    {{ $tag->name }}
                                </option>
                            @endforeach

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Extracto</label>
                        <textarea class="form-control" 
                            name="excerpt"
                        >
                            {{ old('excerpt') }}
                        </textarea>
                    </div>
                    <button type="submit" class="btn btn-success btn-block">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@push('script')
    <script src="{{asset('adminlte/plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('adminlte/plugins/summernote/summernote-bs4.min.js')}}"></script>
    <script>
        $(document).ready(function () {
        
            $('#body').summernote();

            $('.select2bs4').select2({
              theme: 'bootstrap4'
            })
        })
    </script>
@endpush
