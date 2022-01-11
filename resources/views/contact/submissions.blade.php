@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <table class="contact-table">
                <tr>
                    <td>ID</td>
                    <td>Title</td>
                    <td>Description</td>
                    <td>Author Name</td>
                    <td>Created At</td>
                </tr>

                @foreach($submissions as $submission)
                    <tr>
                        <td>{{ $submission->id }}</td>
                        <td class="title">{{ $submission->title }}</td>
                        <td class="description">{{ $submission->description }}</td>
                        <td>{{ $submission->author_name }}</td>
                        <td>{{ $submission->created_at }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection
