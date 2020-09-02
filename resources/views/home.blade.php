@extends('layouts.app')

@section('content')
    <div class="container">

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-error" role="alert">
                {{ session('error') }}
            </div>
        @endif
        @error('upload')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
        <div class="sticky-top bg-white">
            <form id="upload-form" action="/upload" method="post" enctype="multipart/form-data">
                @csrf
                <div class="input-group">
                    <div class="custom-file">
                        <input multiple name="upload[]" id="file-upload" type="file" class="custom-file-input">
                        <label class="custom-file-label" for="file-upload">{{__("folder.choosefile")}}</label>
                    </div>
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-outline-secondary">{{__("folder.upload.action")}}</button>
                    </div>
                </div>
            </form>
            <div class="py-2 d-none d-flex">
                <button id="download-button" type="button"
                        class="btn btn-success btn-lg flex-fill mr-1">{{__("folder.download")}}</button>
                <button id="delete-button" type="button"
                        class="btn btn-danger btn-lg flex-fill ml-1">{{__("folder.delete")}}</button>
            </div>
        </div>

        <table id="files-table" class="table table-striped table-hover"
               data-sort-by="{{$order ? $order->by : "filename"}}"
               data-sort-order="{{$order ? $order->order : "DESC"}}">
            <thead>
            <tr>
                <th scope="col">
                    <div class="form-check form-check-inline">
                        <input id="head-checkbox" class="form-check-input" type="checkbox" value="option1">
                    </div>
                </th>
                <th scope="col" class="sortable" data-name="filename">
                    <div class="d-flex">
                        <span>{{__("folder.filename")}}</span>
                        <div class="table-icons">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-down d-none"
                                 fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                      d="M4.646 9.646a.5.5 0 0 1 .708 0L8 12.293l2.646-2.647a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 0 1 0-.708z" />
                                <path fill-rule="evenodd"
                                      d="M8 2.5a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-1 0V3a.5.5 0 0 1 .5-.5z" />
                            </svg>
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-up d-none"
                                 fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                      d="M8 3.5a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-1 0V4a.5.5 0 0 1 .5-.5z" />
                                <path fill-rule="evenodd"
                                      d="M7.646 2.646a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8 3.707 5.354 6.354a.5.5 0 1 1-.708-.708l3-3z" />
                            </svg>
                        </div>
                    </div>
                </th>
                <th scope="col" class="sortable" data-name="size">
                    <div class="d-flex">
                        <span>{{__("folder.size")}}</span>
                        <div class="table-icons">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-down d-none"
                                 fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                      d="M4.646 9.646a.5.5 0 0 1 .708 0L8 12.293l2.646-2.647a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 0 1 0-.708z" />
                                <path fill-rule="evenodd"
                                      d="M8 2.5a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-1 0V3a.5.5 0 0 1 .5-.5z" />
                            </svg>
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-up d-none"
                                 fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                      d="M8 3.5a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-1 0V4a.5.5 0 0 1 .5-.5z" />
                                <path fill-rule="evenodd"
                                      d="M7.646 2.646a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8 3.707 5.354 6.354a.5.5 0 1 1-.708-.708l3-3z" />
                            </svg>
                        </div>
                    </div>
                </th>
                <th scope="col" class="sortable" data-name="date">
                    <div class="d-flex">
                        <span>{{__("folder.date")}}</span>
                        <div class="table-icons">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-down d-none"
                                 fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                      d="M4.646 9.646a.5.5 0 0 1 .708 0L8 12.293l2.646-2.647a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 0 1 0-.708z" />
                                <path fill-rule="evenodd"
                                      d="M8 2.5a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-1 0V3a.5.5 0 0 1 .5-.5z" />
                            </svg>
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-up d-none"
                                 fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                      d="M8 3.5a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-1 0V4a.5.5 0 0 1 .5-.5z" />
                                <path fill-rule="evenodd"
                                      d="M7.646 2.646a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8 3.707 5.354 6.354a.5.5 0 1 1-.708-.708l3-3z" />
                            </svg>
                        </div>
                    </div>
                </th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($files as $file)
                <tr>
                    <th scope="row">
                        <div class="form-check form-check-inline">
                            <input data-id="{{$file->id}}" class="form-check-input" type="checkbox" value="option1">
                        </div>
                    </th>
                    <td class="item-filename">{{$file->real_name}}</td>
                    <td class="item-size" data-kbsize="{{$file->size}}">{{$file->formattedSize()}}</td>
                    <td class="item-date">{{$file->created_at}}</td>
                    <td class="">
                        <div class="edit-icon" data-toggle="modal" data-target="#editModal" data-item-id="{{$file->id}}">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square edit-btn"
                                 fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z">
                                </path>
                                <path fill-rule="evenodd"
                                      d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z">
                                </path>
                            </svg>
                        </div>
                        <div class="link-icon">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-link link-btn"
                                 fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M6.354 5.5H4a3 3 0 0 0 0 6h3a3 3 0 0 0 2.83-4H9c-.086 0-.17.01-.25.031A2 2 0 0 1 7 10.5H4a2 2 0 1 1 0-4h1.535c.218-.376.495-.714.82-1z">
                                </path>
                                <path
                                    d="M9 5.5a3 3 0 0 0-2.83 4h1.098A2 2 0 0 1 9 6.5h3a2 2 0 1 1 0 4h-1.535a4.02 4.02 0 0 1-.82 1H12a3 3 0 1 0 0-6H9z">
                                </path>
                            </svg>
                            <span class="link-tooltip" data-placement="left" title="{{__("folder.copiedtoclipboard")}}"></span>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
    @yield('edit-modal', View::make('components.edit-modal'))
@endsection
