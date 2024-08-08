@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Импортировать товары</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="file">Выберите файл</label>
                                <input type="file" name="file" class="form-control-file" id="file" required>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Импортировать</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
