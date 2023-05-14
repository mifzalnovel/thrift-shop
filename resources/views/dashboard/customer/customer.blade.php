@extends('dashboard.layout.dmain')

@section('dcontent')

<div class="border-bottom mb-4">
  <h2>Customer</h2>
</div>

<div class="mt-2 col-lg-10">
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Username</th>
        <th scope="col">Email</th>
        <th scope="col">Level</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($users as $user)
        <tr>
          <th>{{ $loop->iteration }}</th>
          <td>{{ $user->name }}</td>
          <td>{{ $user->username }}</td>
          <td>{{ $user->email }}</td>
          <td>{{ $user->name }}</td>
          <td>
            <a href="/dashboard/customer/{{ $user->id }}/edit" class="text-decoration-none">
              <span class="badge text-bg-warning">Edit</span>
            </a>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>

@endsection