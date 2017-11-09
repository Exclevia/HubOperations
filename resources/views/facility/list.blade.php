@extends('layouts.app')

@section('title', 'All Facilities')
@section('css')
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
@append
@section('listpagejs')
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script>
		$(document).ready(function() {
			$('#facilitylist').DataTable();
		} );
	</script>
@append

@section('content')

<div class="box box-info">
  
  <!-- /.box-header -->
  <div class="box-body table-responsive">
    <table id="facilitylist" class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>Name</th>
          <th>Hub</th>
          <th>District</th>
          <th>Level</th>
          <th>Contact Person</th>
          <th>Phone Number</th>
           <th>Actions</th>

        </tr></thead>
        <tbody>
      @foreach ($facilities as $facility)
      <tr>
        <td><a href="{{ route('facility.show', $facility->id ) }}">{{ $facility->name }}</a></td>
        <td>{{ $facility->hub }}</td>
        <td>{{ $facility->district }}</td>
        <td>{{ $facility->facilitylevel }}</td>
        <td>{{ $facility->contactperson }}</td>
        <td>{{ $facility->phonenumber }}</td>
        <td><a href="{{ route('facility.edit', $facility->id ) }}"><i class="fa fa-fw fa-edit"></i>Update</a>&nbsp;
       	<a href="{{ route('facility.edit', $facility->id ) }}"><i class="fa fa-fw fa-trash-o"></i>Delete</a>
        </td>

      </tr>
      @endforeach
        </tbody>
    </table>
  </div>
  <!-- /.box-body -->
  
</div>
@endsection