@extends('layouts.app')


@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <button id="btn_add" name="btn_add" class="btn btn-default pull-right">Add New Product</button>
            </div>
            <div class="form-group">
                <label for="sel1">Select Maximum price:</label>
                <input type="text" name="search" id="search" class="form-control" placeholder="put max item price" />
            </div>
            <div class="form-group">
                <label for="sel1">Select Aisle:</label>
                <select class="form-control" id="sel1">
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <table class="table table-striped table-hover ">
                <thead>
                    <tr class="info">
                        <th>ID </th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>Aisle</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="products-list" name="products-list">

                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Passing BASE URL to AJAX -->
<input id="url" type="hidden" value="{{ \Request::url() }}">
@endsection
@include('parts.modals')