@extends('layouts.main')

@push('title')
    <title>
        Profile | Magical Housee
    </title>
@endpush

@section('main-section')
    <section id="start">
        <div class="container py-5">
            <div class="row text-center">
                @if ($message = Session::get('success'))
                    <div class="col-12">
                        {{ $message }}
                    </div>
                @endif
                <div class="col-12 col-md-6 col-lg-4">
                    <form action="{{ route('edit.profile', ['userId' => $user->id]) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{ $user->id }}">
                        <figure class="profile" id="profile-container">
                            <img src="{{ $user->avatar }}" alt="avatar" width="110px" id="profile-image">
                            <div class="edit-icon" id="edit-icon">&#9998;</div>
                            <input type="file" name="avatar" id="file-input" style="display: none;"
                                accept=".jpg, .jpeg, .png, .svg, .webp">
                                <div class="text-warning">
                                    @error('avatar')
                                        {{ $message }}
                                    @enderror
                                </div>
                        </figure>

                        <h2 class="text-start">Personal Info</h2>
                        <div class="form-group my-3">
                            <label for="username" class="d-flex">Username</label>
                            <input type="text" class="form-control" name="username" id="username" placeholder="Username"
                                value="{{ $user->name }}">
                                <div class="text-warning">
                                    @error('username')
                                        {{ $message }}
                                    @enderror
                                </div>
                        </div>
                        <div class="form-group my-3">
                            <label for="email" class="d-flex">Email</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email"
                                value="{{ $user->email }}">
                                <div class="text-warning">
                                    @error('email')
                                        {{ $message }}
                                    @enderror
                                </div>
                        </div>
                        <div class="form-group my-3">
                            <label for="contact" class="d-flex">Mobile Number</label>
                            <input type="number" class="form-control" name="contact" id="contact" placeholder="Contact"
                                value="{{ $user->contact }}">
                                <div class="text-warning">
                                    @error('contact')
                                        {{ $message }}
                                    @enderror
                                </div>
                        </div>
                        <div class="form-group d-flex my-3">
                            <button type="submit" class="btn-housee"><i class="fa fa-save"></i> Save</button>
                        </div>
                    </form> 
                </div>

                <div class="col-12 col-md-6 col-lg-4">
                    <div class="d-flex align-items-center flex-column mt-5" style="margin: auto;">
                        <figure class="borders">
                            <img src="{{ url('assets/img/optTicket.svg') }}" alt="image" width="200"
                                style="padding: 1.5rem;">
                        </figure>
                        <table>
                            <tr>
                                @foreach ($tickets as $row)
                                    <td>Value: {{ $row->ticketValue }}</td>
                                @endforeach
                            </tr>
                            <tr>
                                @foreach ($tickets as $row)
                                    <td> {{ $row->ticket_count }}</td>
                                @endforeach
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="d-flex align-items-center flex-column mt-5" style="margin: auto;">
                        <figure class="borders">
                            <img src="{{ url('assets/img/powers/power.png') }}" alt="image" width="100%"
                                style="padding: 1.5rem;">
                        </figure>
                        <table class="table-responsive">
                            <tr>
                                @foreach ($powers as $row)
                                    <td>{{ $row->power }}</td>
                                @endforeach
                            </tr>
                            <tr>
                                @foreach ($powers as $row)
                                    <td>{{ $row->power_count }}</td>
                                @endforeach
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Add the following JavaScript code separately

        // Get elements
        const profileContainer = document.getElementById('profile-container');
        const profileImage = document.getElementById('profile-image');
        const editIcon = document.getElementById('edit-icon');
        const fileInput = document.getElementById('file-input');

        // Function to handle the edit icon click
        function handleEditIconClick() {
            // Trigger the file input when the edit icon is clicked
            fileInput.click();
        }

        // Function to handle file selection
        function handleFileSelect() {
            const selectedFile = fileInput.files[0];
        }

        // Attach event listeners
        editIcon.addEventListener('click', handleEditIconClick);
        fileInput.addEventListener('change', handleFileSelect);

        // Add hover effect to show/hide edit icon
        profileContainer.addEventListener('mouseover', () => {
            editIcon.style.display = 'block';
            editIcon.style.cursor = 'pointer';
        });

        profileContainer.addEventListener('mouseout', () => {
            editIcon.style.display = 'none';
        });
    </script>
@endsection
