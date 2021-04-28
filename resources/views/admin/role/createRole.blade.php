@extends('admin.layouts.default')
@section('content')
    @include('admin.layouts.includes.rolePermessionbutton')

    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet kt-portlet--mobile">
            @if (session()->has('Smsg'))
                <div class="alert alert-success">
                    {{ session()->get('Smsg') }}
                </div>
            @elseif(session()->has('Fmsg'))
                <div class="alert alert-danger">
                    {{ session()->get('Fmsg') }}
                </div>
            @endif

            @if (request()->is('dashboard/role'))
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon">
                            <span class="kt-widget__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24" />
                                        <rect fill="#000000" x="4" y="5" width="16" height="3" rx="1.5" />
                                        <path
                                            d="M5.5,15 L18.5,15 C19.3284271,15 20,15.6715729 20,16.5 C20,17.3284271 19.3284271,18 18.5,18 L5.5,18 C4.67157288,18 4,17.3284271 4,16.5 C4,15.6715729 4.67157288,15 5.5,15 Z M5.5,10 L12.5,10 C13.3284271,10 14,10.6715729 14,11.5 C14,12.3284271 13.3284271,13 12.5,13 L5.5,13 C4.67157288,13 4,12.3284271 4,11.5 C4,10.6715729 4.67157288,10 5.5,10 Z"
                                            fill="#000000" opacity="0.3" />
                                    </g>
                                </svg>
                            </span>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            Create Role
                            <!-- <small>Datatable initialized from HTML table</small> -->
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">

                    <form action="{{ route('role.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Role Name</label>
                                    <input type="text" class="form-control" name="name">

                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Select Permission</label>
                                    <select class="form-control select2" multiple id="exampleFormControlSelect1"
                                        name="permissions[]">
                                        @foreach ($permissions as $permission)

                                            <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-success">save</button>
                            </div>
                        </div>
                    </form>


                    <!--begin: Search Form -->
                    <div class="kt-form kt-form--label-right mt-5">
                        <div class="row align-items-center">
                            <div class="col-xl-8 order-2 order-xl-1">

                            </div>
                            <div class="col-xl-4 order-1 order-xl-2 kt-align-right">
                                <div class="kt-input-icon kt-input-icon--left">
                                    <input type="text" class="form-control" placeholder="Search..." id="generalSearch">
                                    <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                        <span><i class="la la-search"></i></span>
                                    </span>
                                </div>

                                <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg d-xl-none">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end: Search Form -->
                </div>
            @elseif(request()->is('dashboard/role/'.$oldrole->id.'/edit'))
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon">
                            <span class="kt-widget__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24" />
                                        <rect fill="#000000" x="4" y="5" width="16" height="3" rx="1.5" />
                                        <path
                                            d="M5.5,15 L18.5,15 C19.3284271,15 20,15.6715729 20,16.5 C20,17.3284271 19.3284271,18 18.5,18 L5.5,18 C4.67157288,18 4,17.3284271 4,16.5 C4,15.6715729 4.67157288,15 5.5,15 Z M5.5,10 L12.5,10 C13.3284271,10 14,10.6715729 14,11.5 C14,12.3284271 13.3284271,13 12.5,13 L5.5,13 C4.67157288,13 4,12.3284271 4,11.5 C4,10.6715729 4.67157288,10 5.5,10 Z"
                                            fill="#000000" opacity="0.3" />
                                    </g>
                                </svg>
                            </span>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            Edit Role
                            <!-- <small>Datatable initialized from HTML table</small> -->
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <form action="{{ route('role.update', $oldrole->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Role Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ $oldrole->name }}">

                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Select Permission</label>
                                    <select class="form-control select2" multiple id="exampleFormControlSelect1"
                                        name="permissions[]">
                                        @foreach ($permissions as $permission)

                                            <option value="{{ $permission->id }}"
                                                {{ $oldrole->hasPermissionTo($permission->name) ? 'selected' : '' }}>
                                                {{ $permission->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-success">Update</button>
                            </div>
                        </div>
                    </form>


                    <!--begin: Search Form -->
                    <div class="kt-form kt-form--label-right mt-5">
                        <div class="row align-items-center">
                            <div class="col-xl-8 order-2 order-xl-1">

                            </div>
                            <div class="col-xl-4 order-1 order-xl-2 kt-align-right">
                                <div class="kt-input-icon kt-input-icon--left">
                                    <input type="text" class="form-control" placeholder="Search..." id="generalSearch">
                                    <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                        <span><i class="la la-search"></i></span>
                                    </span>
                                </div>

                                <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg d-xl-none">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end: Search Form -->
                </div>
            @endif
            <div class="kt-portlet__body kt-portlet__body--fit" style="margin-top: -20px;">
                <!--begin: Datatable -->
                <table class="kt-datatable" id="html_table" width="100%">
                    <thead>
                        <tr>
                            <th>Role name</th>
                            <th>Permission name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                            <tr>
                                <td>{{ $role->name }}</td>
                                <td>
                                    <div>

                                        @foreach ($role->getPermissionNames() as $item)
                                            <span class="badge badge-secondary mb-1">{{ $item }}</span>
                                        @endforeach
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ route('role.edit', $role->id) }}" class="btn btn-outline-primary">Edit</a>
                                    <form action="{{ route('role.destroy', $role->id) }}" method="POST" class="d-inline">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!--end: Datatable -->
            </div>
        </div>
    </div>

@endsection
