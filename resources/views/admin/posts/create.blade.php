<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <form action="{{ route('admin.posts.store', '#create') }}" method="POST">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="">Título</label>
                        <input  id="post-title" 
                            class="form-control" 
                            type="text" 
                            name="title"
                            value="{{ old('title') }}"
                            placeholder="Título de la publicacion"
                            {{-- autofocus --}}
                            {{-- required --}}
                        >
                            {!! $errors->first('title', '<span class="help-block">:message</span>')  !!} 
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('script')
<script>
    if (window.location.hash === '#create')
    {
      $('#myModal').modal('show');
    }

    $('#myModal').on('hide.bs.modal', function(){
      window.location.hash = '#';
    })
  </script>
@endpush