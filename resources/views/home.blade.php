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
                            <div class="custom-input">
                                <input type="file" class="custom-file-input mt-1" id="inputGroupFile01"
                                       aria-describedby="inputGroupFileAddon01">
                                <label class="custom-file-label mt-1" for="inputGroupFile01">Choose file for upload</label>
                            </div>
                            <div class="py-2 d-none d-flex">
                                <button type="button" class="btn btn-success btn-lg flex-fill mr-1">Download</button>
                                <button type="button" class="btn btn-danger btn-lg flex-fill ml-1">Delete</button>
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
                            <tr>
                                <th scope="row">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" value="option1">
                                    </div>
                                </th>
                                <td class="item-filename">retard</td>
                                <td class="item-size" data-kbsize = "200" >200</td>
                                <td class="item-date">@mdo</td>
                            </tr>
                            <tr class="table-primary">
                                <th scope="row">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" checked value="checked">
                                    </div>
                                </th>
                                <td class="item-filename">Mark</td>
                                <td class="item-size" data-kbsize = "300" >300</td>
                                <td class="item-date">@mdo</td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" value="option1">

                                    </div>
                                </th>
                                <td class="item-filename">bih</td>
                                <td class="item-size">Ottfo</td>
                                <td class="item-date">@mdo</td>
                            </tr>
                            <tr class="table-primary">
                                <th scope="row">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" checked value="checked">
                                    </div>
                                </th>
                                <td class="item-filename">ark</td>
                                <td class="item-size" data-kbsize = "400" >400</td>
                                <td class="item-date">@mfsado</td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" value="option1">

                                    </div>
                                </th>
                                <td>Jacob</td>
                                <td class="item-size" data-kbsize = "500" >500</td>
                                <td>@fat</td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" value="option1">

                                    </div>
                                </th>
                                <td>Larry</td>
                                <td>the Bird</td>
                                <td>@twitter</td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" value="option1">

                                    </div>
                                </th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" value="option1">

                                    </div>
                                </th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Larry</td>
                                <td>the Bird</td>
                                <td>@twitter</td>
                            </tr>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Larry</td>
                                <td>the Bird</td>
                                <td>@twitter</td>
                            </tr>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Larry</td>
                                <td>the Bird</td>
                                <td>@twitter</td>
                            </tr>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Larry</td>
                                <td>the Bird</td>
                                <td>@twitter</td>
                            </tr>
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
