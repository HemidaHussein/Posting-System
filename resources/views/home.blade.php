<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@extends('layouts.app')
</head>
@section('content')

<div class="container">
    <div class="row">

        <div class="col-md-8 col-md-offset-2">
            <passport-personal-access-tokens v-show="activeItem == 'oauth'"></passport-personal-access-tokens>
            <post-table v-show="activeItem == 'posts'"></post-table>

        </div>
    </div>
</div>

@endsection

<!-- or use the specify version -->
<script src="https://unpkg.com/vuejs-paginate@0.9.0"></script>

