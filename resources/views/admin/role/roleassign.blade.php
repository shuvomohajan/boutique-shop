@extends('admin.layouts.default')
@push('css')
   
    <style>
        .border{
            border-bottom: 1px solid gray !important !;
        }
    </style>
@endpush
@section('content')
    @include('admin.layouts.includes.rolePermessionbutton')
    <div class="container bg-white p-4 shadow-sm">
        <div class="row">
            <div class="col-4">
                <form action="{{ route('store.assign') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Select User</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="user">
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Select Role</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="roles[]" multiple>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}" >{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">save</button>
                </form>
            </div>
            <div class="col-8">
                <table id="myTable" class="display" width="100%">
                    <thead>
                        <tr>
                            <th>User Name</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="border">
                                @if (count($user->getRoleNames())>0)
                                    
                                <td>{{ $user->name }}</td>
                                <td>
                                    @foreach ($user->getRoleNames() as $item)
                                        <span class="badge badge-danger">{{ $item }}</span>
                                    @endforeach
                                </td>
                                <td><a href="" class="btn btn-outline-danger">Delete</a></td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


    </div>
@endsection
@push('script')

@endpush
