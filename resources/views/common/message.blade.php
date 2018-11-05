@if (session('flash_message'))
    <div class="alert alert-{{ session('flash_level') }}">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ ucfirst(session('flash_level') === 'danger' ? 'error' : session('flash_level') ) }}! </strong> {{session('flash_message')}}
    </div>
@endif
