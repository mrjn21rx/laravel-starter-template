<div class="card">
    <div class="card-body">
        <form action="{{ route('app.roles.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Nama Hak Akses</label>
                <input type="text" class="form-control" required="" value="{{ $data->name }}">
            </div>
            <div class="text-right mt-3">
                <button class="btn btn-sm btn-primary" type="submit">Submit</button>
                <button class="btn btn-sm btn-warning" type="reset">Reset</button>
            </div>
        </form>
    </div>
</div>
