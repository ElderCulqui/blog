@extends('admin.layout')

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.1/dropzone.min.css">
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
<form action="{{ route('admin.posts.update',$post) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-md-8">
            <div class="card card-success">
                
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Título</label>
                        <input class="form-control" 
                            type="text" name="title"
                            value="{{ old('title', $post->title) }}"
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
                                {{ old('body', $post->body) }}
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
                            value="{{ old('published_at', optional($post->published_at ?? null)->format('Y-m-d') ?? null) }}"
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
                                    {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}
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
                                    {{ collect(old('tags', $post->tags->pluck('id')))->contains($tag->id) ? 'selected' : '' }}
                                >
                                    {{ $tag->name }}
                                </option>
                            @endforeach

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Extracto</label>
                        <textarea class="form-control" name="excerpt">{{ old('excerpt', $post->excerpt) }}</textarea>
                    </div>
                    <div class="form-group">
                        <div class="dropzone"></div>
                    </div>
                    <button type="submit" class="btn btn-success btn-block">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.1/dropzone.min.js"></script>
    <script src="{{asset('adminlte/plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('adminlte/plugins/summernote/summernote-bs4.min.js')}}"></script>
    <script>
        
        Dropzone.autoDiscover = false;

        $(document).ready(function () {
        
            $('#body').summernote();

            $('.select2bs4').select2({
              theme: 'bootstrap4'
            })

            $(".dropzone").dropzone({ 
                url: '/admin/posts/{{ $post->url }}/photos',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                dictDefaultMessage: "Arrastre las fotos aquí para subirlas"
            });

        })
    </script>
@endpush
