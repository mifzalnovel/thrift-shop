@extends('layout.main')

@section('content')

<div class="m-5 col-lg-5">
  <div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="name" class="form-control" value="{{ $user->name }}" readonly>
  </div>
  <div class="mb-3">
    <label for="username" class="form-label">Username</label>
    <input type="username" class="form-control" value="{{ $user->username }}" readonly>
  </div>
  <div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" class="form-control" value="{{ $user->email }}" readonly>
  </div>
  <div class="d-flex justify-content-end">
    <a href="{{ route('user.detail.profile') }}" class="btn btn-primary border-0">Detail Data User</a>
  </div>
  <div class="d-flex justify-content-end mt-3">
    <a href="{{ route('order.user') }}" class="btn btn-info border-0">Your Order</a>
  </div>
</div>

@endsection