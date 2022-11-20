@extends('personal.layouts.main')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">My commentaries</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('personal.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">Commentaries</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-12">
                        <form  action="{{ route('personal.comments.update', $comment->id) }}" method="POST" class="w-50">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label>New category name</label>
                                <textarea name="message" cols="30" rows="10" class="form-control">{{$comment->message}}</textarea>
                                @error('message')
                                <div class="text-danger">
                                    This field needs to be filled!
                                </div>
                                @enderror
                            </div>
                            <input type="submit" class="btn btn-block btn-success btn-xs" value="Update">
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection