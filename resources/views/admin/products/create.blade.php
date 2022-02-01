@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col">
                <form action="">
                    <div class="form-group">
                        <label for="category_id">Categoría</label>
                        <select name="category_id" id="category_id" class="form-control" required>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->description }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="currency_id">Currencies</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
