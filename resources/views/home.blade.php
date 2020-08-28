@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>
                    <div class="card-body">

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="sticky-top bg-white">

                                <form id="upload-form" method="post" action="/upload" enctype="multipart/form-data">
                                    @csrf
                                    <div class="input-group">

                                        <div class="custom-file">
                                            <input multiple name="upload[]" type="file" class="custom-file-input" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04">
                                            <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                                        </div>
                                        <div class="input-group-append">
                                            <button onClick = "document.getElementById('upload-form').submit()" class="btn btn-outline-secondary" type="button" id="inputGroupFileAddon04">Button</button>
                                        </div>
                                    </div>
                                </form>


                            <div class="py-2 d-none d-flex">
                                <button type="button" id="download-button" class="btn btn-success btn-lg flex-fill mr-1">Download</button>
                                <button type="button" id="delete-button" class="btn btn-danger btn-lg flex-fill ml-1">Delete</button>
                            </div>
                        </div>

                        <table id="files-table" class="table table-striped" data-sort-by="date" data-sort-order="">
                            <thead>
                            <tr>
                                <th scope="col">
                                    <div class="form-check form-check-inline">
                                        <input id="head-checkbox" class="form-check-input" type="checkbox" value="option1">
                                    </div>
                                </th>
                                <th scope="col" class="sortable" data-name="filename">
                                    <div class="d-flex">
                                        Filename
                                        <div class="table-icons">
                                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-down"
                                                 fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                      d="M4.646 9.646a.5.5 0 0 1 .708 0L8 12.293l2.646-2.647a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 0 1 0-.708z" />
                                                <path fill-rule="evenodd"
                                                      d="M8 2.5a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-1 0V3a.5.5 0 0 1 .5-.5z" />
                                            </svg>
                                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-up"
                                                 fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                      d="M8 3.5a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-1 0V4a.5.5 0 0 1 .5-.5z" />
                                                <path fill-rule="evenodd"
                                                      d="M7.646 2.646a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8 3.707 5.354 6.354a.5.5 0 1 1-.708-.708l3-3z" />
                                            </svg>
                                        </div>
                                    </div>
                                </th>
                                <th scope="col"  class="sortable" data-name="size">
                                    <div class="d-flex">
                                        <div>Size</div>
                                        <div class="table-icons">
                                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-down"
                                                 fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                      d="M4.646 9.646a.5.5 0 0 1 .708 0L8 12.293l2.646-2.647a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 0 1 0-.708z" />
                                                <path fill-rule="evenodd"
                                                      d="M8 2.5a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-1 0V3a.5.5 0 0 1 .5-.5z" />
                                            </svg>
                                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-up"
                                                 fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                      d="M8 3.5a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-1 0V4a.5.5 0 0 1 .5-.5z" />
                                                <path fill-rule="evenodd"
                                                      d="M7.646 2.646a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8 3.707 5.354 6.354a.5.5 0 1 1-.708-.708l3-3z" />
                                            </svg>
                                        </div>
                                    </div>
                                </th>
                                <th scope="col"  class="sortable" data-name="date">
                                    <div class="d-flex">
                                        Upload date
                                        <div class="table-icons">
                                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-down"
                                                 fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                      d="M4.646 9.646a.5.5 0 0 1 .708 0L8 12.293l2.646-2.647a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 0 1 0-.708z" />
                                                <path fill-rule="evenodd"
                                                      d="M8 2.5a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-1 0V3a.5.5 0 0 1 .5-.5z" />
                                            </svg>
                                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-up"
                                                 fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                      d="M8 3.5a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-1 0V4a.5.5 0 0 1 .5-.5z" />
                                                <path fill-rule="evenodd"
                                                      d="M7.646 2.646a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8 3.707 5.354 6.354a.5.5 0 1 1-.708-.708l3-3z" />
                                            </svg>
                                        </div>
                                    </div>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($files as $file)
                            <tr>
                                <th scope="row">
                                    <div class="form-check form-check-inline">
                                        <input data-id = "{{$file->id}}" class ="form-check-input" type="checkbox" value="option1">
                                    </div>
                                </th>
                                <td class="item-filename">{{$file->real_name}}</td>
                                <td class="item-size" data-kbsize = "{{$file->size}}" >{{$file->formattedSize()}}</td>
                                <td class="item-date">{{$file->created_at}}</td>
                            </tr>
                            @endforeach
                            </tbody>
                            <div>

                            </div>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
