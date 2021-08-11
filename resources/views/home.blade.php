@extends('layouts.master')

@section('title', 'Dashboard')

@section('pageTitle', 'Dashboard')

@section('content')

@if (auth()->user()->type == 3)

<h3>Attendance Tiles</h3>
<br>

<div class="row">
  @foreach ($data as $row)
  <div class="col-lg-3 col-md-6 col-sm-6">
    <div class="card card-stats">
      <div class="card-header card-header-rose card-header-icon">
        <div class="card-icon">
          <i class="material-icons">equalizer</i>
        </div>
        <p class="card-category">Attendance Percentage
          <h4 class="card-title">{{ ucfirst($row->subject) }}</h4>
        </p>
        <h3 class="card-title">
          {{ 100 - round((($row->count / $row->totalWorkingDays) * 100), 2)." %" }}
        </h3>
      </div>
      <div class="card-footer">
        <div class="stats">
          <i class="material-icons">local_offer</i> For any queries, please contact the administrator
        </div>
      </div>
    </div>
  </div>


  @endforeach

  @endif

  @if (Auth()->user()->type == 1 || Auth()->user()->type == 2)

  <div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6">
      <div class="card card-stats">
        <div class="card-header card-header-warning card-header-icon">
          <div class="card-icon">
            <i class="material-icons"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="26" height="26"
                viewBox="0 0 172 172" style=" fill:#000000;">
                <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt"
                  stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0"
                  font-family="none" font-weight="none" font-size="none" text-anchor="none"
                  style="mix-blend-mode: normal">
                  <path d="M0,172v-172h172v172z" fill="none"></path>
                  <g fill="#ffffff">
                    <path
                      d="M86,1.03365c-21.00901,0 -39.07212,14.16106 -39.07212,41.34615c0,17.75301 8.32092,35.79026 19.22596,46.92788c1.75721,4.6256 1.44712,8.08834 0.41346,10.54327c1.42128,1.91226 6.95132,7.49399 16.125,8.68269c-3.38522,3.82452 -7.80408,11.73197 -11.37019,19.63942c-6.87379,-9.74219 -11.78365,-22.32692 -11.78365,-22.32692c-21.62921,8.0625 -46.10096,22.22356 -46.10096,36.17788v5.375c0,19.48438 37.78005,23.77404 72.76923,23.77404c35.04087,0 72.35577,-4.28966 72.35577,-23.77404v-5.375c0,-14.16106 -23.98077,-28.14122 -46.30769,-35.97115c0,0 -4.75481,12.45553 -11.57692,22.12019c-3.5661,-7.93329 -7.95913,-15.8149 -11.37019,-19.63942c8.83774,-1.08533 14.21274,-6.27945 15.91827,-8.47596c-0.72356,-2.40324 -0.82692,-5.73678 0.82692,-10.75c10.82753,-11.16346 19.01923,-29.2524 19.01923,-46.92788c0,-27.15926 -18.0631,-41.34615 -39.07212,-41.34615z">
                    </path>
                  </g>
                </g>
              </svg></i>
          </div>
          <p class="card-category">Number Of Students</p>
          <h3 class="card-title">{{ $studentCount }}</h3>
        </div>
        <div class="card-footer">
          <div class="stats">
            <i class="material-icons text-danger">warning</i>
            <a href="#pablo">Total students</a>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6">
      <div class="card card-stats">
        <div class="card-header card-header-rose card-header-icon">
          <div class="card-icon">
            <i class="material-icons">Teacher</i>
          </div>
          <p class="card-category">Attendance Percentage</p>
          <h3 class="card-title">
            @if ($studentCount > 0)
            {{ ($totalAbsentsToday / $studentCount) * 100 }} %
                @else 
                0 %
            @endif
          </h3>
        </div>
        <div class="card-footer">
          <div class="stats">
            <i class="material-icons">local_offer</i> Total students absent
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6">
      <div class="card card-stats">
        <div class="card-header card-header-success card-header-icon">
          <div class="card-icon">
            <i class="material-icons">store</i>
          </div>
          <p class="card-category">Departments</p>
          <h3 class="card-title">{{ $departmentCount }}</h3>
        </div>
        <div class="card-footer">
          <div class="stats">
            <i class="material-icons">date_range</i> Last 24 Hours
          </div>
        </div>
      </div>
    </div>
   </div>

  {{-- <div class="row">
    <div class="col-md-4">
      <div class="card card-chart">
        <div class="card-header card-header-rose" data-header-animation="true">
          <div class="ct-chart" id="websiteViewsChart"></div>
        </div>
        <div class="card-body">
          <div class="card-actions">
            <button type="button" class="btn btn-danger btn-link fix-broken-card">
              <i class="material-icons">build</i> Fix Header!
            </button>
            <button type="button" class="btn btn-info btn-link" rel="tooltip" data-placement="bottom" title="Refresh">
              <i class="material-icons">refresh</i>
            </button>
            <button type="button" class="btn btn-default btn-link" rel="tooltip" data-placement="bottom"
              title="Change Date">
              <i class="material-icons">edit</i>
            </button>
          </div>
          <h4 class="card-title">Monthly Attendance Graph</h4>
          <p class="card-category">Last Performance</p>
        </div>
        <div class="card-footer">
          <div class="stats">
            <i class="material-icons">access_time</i> campaign sent 2 days ago
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card card-chart">
        <div class="card-header card-header-success" data-header-animation="true">
          <div class="ct-chart" id="dailySalesChart"></div>
        </div>
        <div class="card-body">
          <div class="card-actions">
            <button type="button" class="btn btn-danger btn-link fix-broken-card">
              <i class="material-icons">build</i> Fix Header!
            </button>
            <button type="button" class="btn btn-info btn-link" rel="tooltip" data-placement="bottom" title="Refresh">
              <i class="material-icons">refresh</i>
            </button>
            <button type="button" class="btn btn-default btn-link" rel="tooltip" data-placement="bottom"
              title="Change Date">
              <i class="material-icons">edit</i>
            </button>
          </div>
          <h4 class="card-title">Daily Attendance</h4>
          <p class="card-category">
            <span class="text-success"><i class="fa fa-long-arrow-up"></i> 55% </span>
            increase in today Attendance</p>
        </div>
        <div class="card-footer">
          <div class="stats">
            <i class="material-icons">access_time</i> updated 4 minutes ago
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card card-chart">
        <div class="card-header card-header-info" data-header-animation="true">
          <div class="ct-chart" id="completedTasksChart"></div>
        </div>
        <div class="card-body">
          <div class="card-actions">
            <button type="button" class="btn btn-danger btn-link fix-broken-card">
              <i class="material-icons">build</i> Fix Header!
            </button>
            <button type="button" class="btn btn-info btn-link" rel="tooltip" data-placement="bottom" title="Refresh">
              <i class="material-icons">refresh</i>
            </button>
            <button type="button" class="btn btn-default btn-link" rel="tooltip" data-placement="bottom"
              title="Change Date">
              <i class="material-icons">edit</i>
            </button>
          </div>
          <h4 class="card-title">Completed Tasks</h4>
          <p class="card-category">Last Campaign Performance</p>
        </div>
        <div class="card-footer">
          <div class="stats">
            <i class="material-icons">access_time</i> campaign sent 2 days ago
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card ">
        <div class="card-header card-header-success card-header-icon">
          <div class="card-icon">
            <i class="material-icons"></i>
          </div>
          <h4 class="card-title">Attendance Management System</h4>
        </div>
        <div class="card-body ">
          <div class="row">

            <div class="col-md-6">
              <div class="table-responsive table-sales">
                <table class="table">
                  <tbody>
                    <tr>
                      <td>
                        <div class="flag">
                          <img src="https://demos.creative-tim.com/material-dashboard-pro/assets/img/flags/US.png"
                            </div> </td> <td>USA
                      </td>
                      <td class="text-right">
                        2.920
                      </td>
                      <td class="text-right">
                        53.23%
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="flag">
                          <img src="https://demos.creative-tim.com/material-dashboard-pro/assets/img/flags/DE.png"
                            </div> </td> <td>Germany
                      </td>
                      <td class="text-right">
                        1.300
                      </td>
                      <td class="text-right">
                        20.43%
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="flag">
                          <img src="https://demos.creative-tim.com/material-dashboard-pro/assets/img/flags/AU.png"
                            </div> </td> <td>Australia
                      </td>
                      <td class="text-right">
                        760
                      </td>
                      <td class="text-right">
                        10.35%
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="flag">
                          <img src="https://demos.creative-tim.com/material-dashboard-pro/assets/img/flags/GB.png"
                            </div> </td> <td>United Kingdom
                      </td>
                      <td class="text-right">
                        690
                      </td>
                      <td class="text-right">
                        7.87%
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="flag">
                          <img src="https://demos.creative-tim.com/material-dashboard-pro/assets/img/flags/RO.png"
                            </div> </td> <td>Romania
                      </td>
                      <td class="text-right">
                        600
                      </td>
                      <td class="text-right">
                        5.94%
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="flag">
                          <img src="https://demos.creative-tim.com/material-dashboard-pro/assets/img/flags/BR.png"
                            </div> </td> <td>Brasil
                      </td>
                      <td class="text-right">
                        550
                      </td>
                      <td class="text-right">
                        4.34%
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="col-md-6 ml-auto mr-auto">
              <div id="worldMap" style="height: 300px;"></div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div> --}}

  @endif
</div>

@endsection

@section('css')

@endsection

@section('script')

@endsection