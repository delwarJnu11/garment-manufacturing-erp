@extends('layout.backend.main')
@section('page_content')
@section('css')
    <style>
        body {}

        #clock {
            font-family: Arial, sans-serif;
            font-size: 1.3rem;
            font-weight: bold;
        }

        #day {
            font-size: .8rem;
            /* color: bl; */
        }
    </style>
@endsection

<div class="container-fluid mt-3 mb-3">
    <div class="row align-items-center header-bar">
        <div class="col-md-6">
            <h4>Welcome to Lunea Todd</h4>
        </div>
        <div class="col-md-3  text-center">
            <div id="clock"></div>
            <div id="day"></div>
        </div>
        <div class="col-md-3 text-end">
            {{-- <a id="clockButton" class="btn btn-warning btn-lg" href="#" onclick="toggleClock()">Clock In</a> --}}
            <a id="clockButton" class="btn btn-warning btn-lg" href="javascript:void(0);" onclick="clockIn()">Clock In</a>
            <a id="clockOutButton" class="btn btn-danger btn-lg" href="javascript:void(0);" onclick="clockOut()" style="display:none;">Clock Out</a>
        </div>
    </div>
</div>

<div class="container">
    <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-4">
        <div class="col">
            <div class="card text-center bg-warning">
                <div class="card-header border-0 pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="mb-0 text-white fs-5">Employee</h6>
                    </div>
                    <div class="card-header-right">
                        <div class="btn-group card-option">
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="#" class="dropdown-item"><i class="ti ti-edit"></i> Edit</a>
                                <form method="POST" action="#">
                                    <input name="_method" type="hidden" value="DELETE">
                                    <a href="#" class="dropdown-item" title="Delete"><i class="ti ti-trash"></i>
                                        Delete</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="avatar">
                        <img src="https://demo.workdo.io/hrmgo/storage/uploads/avatar/user-2.jpg"
                            class="img-fluid mx-4 rounded border-2 border-primary" width="130px" style="height: 130px">
                    </div>
                    <h4 class="mt-2 text-primary justify-content-center text-white">Lunea Todd</h4>
                    <small class="text-white">CEO</small>
                    <div class="row mt-2">
                        <div class="col-12">
                            <a class="btn btn-outline-primary text-white mx-5" href="#">#EMP0000002</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card rounded-1 bg-danger">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="text-white">
                            <h2 class="mb-0 text-center">12</h2>
                            <p class="mb-1">Total Task</p>
                            <p class="mb-0 mt-2 font-13"><i class="bi bi-arrow-up"></i><span>From last Month</span></p>
                        </div>
                        <div class="ms-auto widget-icon bg-info text-white">
                            <i class="nav-icon fas fa-people-carry"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card rounded-1 bg-primary">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="text-white">
                            <h2 class="mb-0 text-center">5</h2>
                            <p class="mb-1">Total Project</p>
                            <p class="mb-0 mt-2 font-13"><i class="bi bi-arrow-up"></i><span>From last Month</span></p>
                        </div>
                        <div class="ms-auto widget-icon bg-info text-white">
                            <i class="fa-solid fa-person-military-pointing"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card rounded-1 bg-success">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="text-white ">
                            <h2 class="mb-0 text-center">12</h2>
                            <p class="mb-1">Total Leave</p>
                            <p class="mb-0 mt-2 font-13"><i class="bi bi-arrow-up"></i><span>From last Month</span></p>
                        </div>
                        <div class="ms-auto widget-icon bg-info text-white">
                            <i class="nav-icon fas fa-chart-bar"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function updateTime() {
        const now = new Date();
        const days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
        const day = days[now.getDay()];

        let hours = now.getHours();
        const minutes = now.getMinutes().toString().padStart(2, '0');
        const seconds = now.getSeconds().toString().padStart(2, '0');
        const ampm = hours >= 12 ? 'pm' : 'am';
        hours = hours % 12 || 12;

        document.getElementById('day').textContent = day;
        document.getElementById('clock').textContent = `${hours}:${minutes}:${seconds} ${ampm}`;
    }

    setInterval(updateTime, 1000);
    updateTime();


    // function toggleClock() {
    //     let button = document.getElementById("clockButton");

    //     if (button.textContent === "Clock In") {
    //         button.textContent = "Clock Out";
    //         button.classList.remove("btn-warning");
    //         button.classList.add("btn-danger");
    //     } else {
    //         button.textContent = "Clock In";
    //         button.classList.remove("btn-danger");
    //         button.classList.add("btn-warning");
    //     }
    // }

    // $(function() {
    //     let clockStatus = localStorage.setItem('EmpStatus', "ClockOut");
    //     // alert()
    //     // $('#clockButton').hide();

    //     if (localStorage['EmpStatus'] == "ClockOut") {
    //         $('#clockButton').show();
    //         // $('#clockButton').hide();
    //         $('#clockOutButton').hide();
    //     } else {
    //         $('#clockButton').hide();
    //         $('#clockOutButton').show();
    //     }



    // })
    // function clockIn() {
    //     let clockStatus = localStorage.setItem('EmpStatus', "ClockOut");
    //     $.ajax({
    //         url: '/hrm_attendance_list/clock-in',
    //         method: 'POST',
    //         data: {
    //             _token: '{{ csrf_token() }}',
    //             employee_id: {{ Auth::user()->id }}, // Pass employee_id if necessary
    //         },
    //         success: function(response) {
    //             if (response.status === 'success') {
    //                 localStorage.setItem('EmpStatus', "ClockIn")
    //                 $('#clockButton').hide();
    //                 $('#clockOutButton').show();
    //                 alert(response.message);
    //             } else {
    //                 alert('Error clocking in.');
    //             }
    //         },
    //         error: function(error) {
    //             // alert('An error occurred. Please try again.');
    //             console.log(error);

    //         }
    //     });
    // }

    // function clockOut() {


    //     $.ajax({
    //         url: '/hrm_attendance_list/clock-out',
    //         method: 'POST',
    //         data: {
    //             _token: '{{ csrf_token() }}',
    //             employee_id: {{ Auth::user()->id }}, // Pass employee_id if necessary
    //         },
    //         success: function(response) {
    //             if (response.status === 'success') {
    //                 localStorage.setItem('EmpStatus', "ClockOut")
    //                 $('#clockOutButton').hide();
    //                 $('#clockButton').show();
    //                 alert(response.message);
    //             } else {
    //                 alert('Error clocking out.');
    //             }
    //         },
    //         error: function() {
    //             alert('An error occurred. Please try again.');
    //         }
    //     });
    // }

    $(function() {
    // Check if EmpStatus exists in localStorage; if not, set a default value.
    if (!localStorage.getItem('EmpStatus')) {
        localStorage.setItem('EmpStatus', "clockOut");
    }

    // Control button visibility based on EmpStatus
    // if (localStorage.getItem('EmpStatus') === "clockOut") {
    //     $('#clockButton').show();
    //     $('#clockOutButton').hide();
    // } else {
    //     $('#clockButton').hide();
    //     $('#clockOutButton').show();
    // }

    if (localStorage.getItem('EmpStatus') === "ClockOut") {
    $('#clockButton').show();
    $('#clockOutButton').hide();
    }
    else if (localStorage.getItem('EmpStatus') === "ClockIn") {
        $('#clockButton').hide();
        $('#clockOutButton').show();
    }


});

function clockIn() {
    $.ajax({
        url: '/hrm_attendance_list/clock-in',
        method: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            employee_id: {{Auth::user()->id}},
        },
        success: function(response) {
            if (response.status === 'success') {
                localStorage.setItem('EmpStatus', "clockIn");
                $('#clockButton').hide();
                $('#clockOutButton').show();
                alert(response.message);
            } else {
                alert('Error clocking in.');
            }
        },
        error: function(error) {
            console.log(error);
            alert('An error occurred. Please try again.');
        }
    });
}

function clockOut() {
    $.ajax({
        url: '/hrm_attendance_list/clock-out',
        method: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            employee_id: {{Auth::user()->id}}, // Pass employee_id if necessary
        },
        success: function(response) {
            if (response.status === 'success') {
                localStorage.setItem('EmpStatus', "clockOut"); // Correctly update status
                $('#clockButton').show();
                $('#clockOutButton').hide();
                alert(response.message);
            } else {
                alert('Error clocking out.');
            }
        },
        error: function() {
            alert('An error occurred. Please try again.');
        }
    });
}



    // Clock Out
</script>
@endsection
