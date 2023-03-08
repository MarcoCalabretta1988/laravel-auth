@if ($project->exists)
    <form action="{{ route('admin.projects.update', $project->id) }}" method="POST">
        @method('PUT')
    @else
        <form action="{{ route('admin.projects.store') }}" method="POST" >
@endif
@csrf

{{-- ERROR ALERT --}}
@if ($errors->any())
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- FORM INPUT FIELD --}}
<div class="row py-5">
    <div class="col-4">
        <div class="mb-3">
            <label for="name" class="form-label">Name:</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name='name' placeholder="Name" minlength="1" maxlength="50"
                value="{{ old('name', $project->name) }}" required>
                @error('name')
                   <div class="invalid-feedback">{{ $message}}</div>
                @else
                  <small class="text-muted">Inserisci il nome del progetto</small>
                @enderror
        </div>
    </div>
    <div class="col-4">
        <div class="mb-3">
            <label for="image" class="form-label">Url:</label>
            <input type="url" class="form-control @error('image') is-invalid @enderror" id="image" name='image'
                value="{{ old('image', $project->image) }}">
                @error('image')
                   <div class="invalid-feedback">{{ $message}}</div>
                @else
                  <small class="text-muted">Inserisci l'imagine del progetto</small>
                @enderror
        </div>
    </div>
   
    <div class="col-12">
        <div class="mb-5">
            <label for="description" class="form-label">Description:</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" rows="3" name="description" required>{{ old('description', $project->description) }}</textarea>
            @error('description')
            <div class="invalid-feedback">{{ $message}}</div>
         @else
           <small class="text-muted">Inserisci la descrizione del progetto</small>
         @enderror
        </div>
    </div>
</div>
<div class="d-flex justify-content-end">
    <a href="{{ route('admin.projects.index')}}" class="btn btn-primary me-2"><i class="fa-solid fa-arrow-left"></i> Back </a>
    <button type="submit" class="btn btn-success"><i class="fa-regular fa-floppy-disk"></i> Save</button>
</div>
</form>
