@extends('app.bootstrap.template')

@section('title', 'Admin Panel | Luxury Escapes')

@section('content')
<div class="container py-5 mt-5">
    <div class="row mb-5">
        <div class="col-12">
            <h1 class="display-5 font-serif">Admin Panel</h1>
        </div>
    </div>

    <div class="d-flex justify-content-end mb-4 gap-3">
        <a href="{{ route('user.index') }}" class="btn btn-luxury">Manage Users</a>
        <a href="{{ route('vacaciones.admin_index') }}" class="btn btn-outline-luxury">Manage Experiences</a>
    </div>

    <ul class="nav nav-pills mb-5" id="adminTab" role="tablist">
      <li class="nav-item me-2">
        <button class="nav-link active rounded-0 text-uppercase ls-1 py-3 px-4" id="reservas-tab" data-bs-toggle="tab" data-bs-target="#reservas" type="button">Reservations</button>
      </li>
      <li class="nav-item">
        <button class="nav-link rounded-0 text-uppercase ls-1 py-3 px-4" id="users-tab" data-bs-toggle="tab" data-bs-target="#users" type="button">Recent Clients</button>
      </li>
    </ul>

    <div class="tab-content" id="adminTabContent">
      <div class="tab-pane fade show active" id="reservas">
          <div class="card card-luxury border-0 shadow-sm p-4">
              <table class="table table-hover align-middle">
                  <thead class="table-dark">
                      <tr class="text-uppercase small ls-1">
                          <th class="py-3">ID</th>
                          <th class="py-3">Client</th>
                          <th class="py-3">Experience</th>
                          <th class="py-3">Date</th>
                          <th class="py-3 text-end">Action</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach($reservas as $reserva)
                      <tr>
                          <td class="fw-bold text-accent">#{{ $reserva->id }}</td>
                          <td>
                              <div class="d-flex align-items-center">
                                  <div class="bg-secondary text-white rounded-circle p-2 me-3 small">User</div>
                                  <div>
                                      <div class="fw-bold">{{ $reserva->user->name }}</div>
                                      <div class="text-muted small">{{ $reserva->user->email }}</div>
                                  </div>
                              </div>
                          </td>
                          <td>{{ $reserva->vacacion->titulo }}</td>
                          <td class="text-muted">{{ $reserva->created_at->format('d M, Y') }}</td>
                          <td class="text-end">
                              <button type="button" 
                                      class="btn btn-outline-danger btn-sm text-uppercase ls-1" 
                                      data-bs-toggle="modal" 
                                      data-bs-target="#confirmationModal" 
                                      data-action="{{ route('reservas.destroy', $reserva->id) }}"
                                      data-message="Are you sure you want to cancel this reservation for {{ $reserva->user->name }}?">
                                  Cancel
                              </button>
                          </td>
                      </tr>
                      @endforeach
                  </tbody>
              </table>
              <div class="mt-4">
                  {{ $reservas->links('pagination::bootstrap-5') }}
              </div>
          </div>
      </div>
      <div class="tab-pane fade" id="users">
          <div class="card card-luxury border-0 shadow-sm p-4">
               <table class="table table-hover align-middle">
                  <thead class="table-dark">
                      <tr class="text-uppercase small ls-1">
                          <th class="py-3">ID</th>
                          <th class="py-3">Name</th>
                          <th class="py-3">Email</th>
                          <th class="py-3">Role</th>
                          <th class="py-3">Member Since</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach($users as $user)
                      <tr>
                          <td>{{ $user->id }}</td>
                          <td class="fw-bold">{{ $user->name }}</td>
                          <td>{{ $user->email }}</td>
                          <td><span class="badge bg-secondary rounded-0 fw-normal text-uppercase">{{ $user->rol }}</span></td>
                          <td class="text-muted">{{ $user->created_at->format('d M, Y') }}</td>
                      </tr>
                      @endforeach
                  </tbody>
              </table>
          </div>
      </div>
    </div>
</div>
@endsection
