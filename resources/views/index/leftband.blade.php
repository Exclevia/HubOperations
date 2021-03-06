<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel (optional) -->     
    <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">NAVIGATION</li>
        <!-- Optionally, you can add icons to the links -->
        <li class="active"><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        @role(['eoc_admin']) <li><a href="{{ url('staff/new/5') }}">Add New EOC Staff</a></li> 
        @endrole
        <!--<li><a href="#"><i class="fa fa-link"></i> <span>Another Link</span></a></li> -->
       @role(['administrator','national_hub_coordinator']) 
       	<li class="treeview">
          <a href="#"><i class="fa fa-user"></i> <span>Access Control</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a> 
          
          <ul class="treeview-menu">
          	<li><a href="{{ route('roles.create') }}">Create Role</a></li>
           	<li><a href="{{ route('roles.index') }}">View All Roles</a></li>
            <li><a href="{{ route('permissions.create') }}">Create Permission</a></li>
            <li><a href="{{ route('permissions.index') }}">View All Permissions</a></li>
            <li><a href="{{ route('users.create') }}">Create User</a></li>
           	<li><a href="{{ route('users.index') }}">View All Users</a></li>
          </ul>
          
        </li>
       @endrole
       @permission(['view-assessment-list','create-assessment'])
        <li class="treeview" style="display:none;">
          <a href="#"><i class="fa fa-user"></i> <span>Infrastructure Assessment</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a> 
          
          <ul class="treeview-menu">
          	<li><a href="{{ route('infrastructure.create') }}">Provide Assessment</a></li>
           	<li><a href="{{ route('infrastructure.index') }}">View All Assessment</a></li>
          </ul>          
        </li>
        @endpermission
       @role(['administrator','national_hub_coordinator']) 
       <li class="treeview">
          <a href="#"><i class="fa fa-institution"></i> <span>Manage IPs</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a> 
          
          <ul class="treeview-menu">
          	<li><a href="{{ route('organization.create') }}">Add New IP</a></li>
           	<li><a href="{{ route('organization.index') }}">View All IPs</a></li>
          </ul>
          
        </li>
       <li class="treeview">
          <a href="#"><i class="fa fa-hospital-o"></i> <span>Manage Hubs</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a> 
          
          <ul class="treeview-menu">
          	<li><a href="{{ route('hub.create') }}">Add New Hub</a></li>
           	<li><a href="{{ route('hub.index') }}">View All Hubs</a></li>
          </ul>
          
        </li>@endrole
        @if(Entrust::can(['update_facility','create_facility','View_facility']))
        <li class="treeview">
          <a href="#"><i class="fa  fa-plus"></i> <span>Manage Facilities</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a> 
          
          <ul class="treeview-menu">
           	<li><a href="{{ route('facility.index') }}">View All Facilities</a></li>
            @if(Entrust::can('update_facility'))
            <li><a href="{{ route('facility.create') }}">Add Facility</a></li>
            @endif
          </ul>
          
        </li>
        @endif
        @role(['hub_coordinator','administrator','hub_coordinator'])  
        <li class="treeview">
          <a href="#"><i class="fa fa-motorcycle"></i> <span>Manage Routing</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            @if (!Auth::guest())
                @role(['hub_coordinator','administrator','hub_coordinator'])  
                	<li><a href="{{ route('equipment.create') }}">Add New Bike</a></li>
                @endrole
                	<li><a href="{{ route('equipment.index') }}">View All Bikes</a></li>
                @role('hub_coordinator') 
                	<li><a href="{{ route('routingschedule.show', ['id' => Auth::user()->hubid]) }}">Routing Schedule</a></li>
                @endrole
          @endif

          </ul>
        </li>
        @endrole
        @role(['hub_coordinator','administrator','national_hub_coordinator','cphl_sample_reception'])
        <li class="treeview">
          <a href="#"><i class="fa fa-motorcycle"></i> <span>Manage Samples</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">             
            	@role(['administrator','national_hub_coordinator','cphl_sample_reception'])
                	 @role(['cphl_sample_reception']) 
                    <li class="hidden"><a href="{{ route('samples.receive') }}">Receive Packages</a></li>
                    @endrole  
                    <li><a href="{{ route('samples.all') }}">Hub Packages</a></li>
                    <li><a href="{{ route('samples.cphl') }}">CPHL Packages</a></li>
                   
                @endrole
                @role(['hub_coordinator'])  
                    <li><a href="{{ route('samples.all') }}">My Packages</a></li>
                    <li><a href="{{ route('samples.cphl') }}">My CPHL Packages</a></li>
                @endrole       
          </ul>
        </li>
        @endrole 
         <li class="treeview" style="display:none;">
          <a href="#"><i class="fa  fa-plus"></i> <span>Manage Equipment</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a> 
          
          <ul class="treeview-menu">
          @permission('can-view-lab-equipment')
            <li><a href="{{ route('labequipment.create') }}">Add Equipment</a></li>
           @endpermission
            <li><a href="{{ route('labequipment.index') }}">View All Equipment</a></li>
          </ul>
          
        </li>
        <li class="treeview" style="display:none;">
          <a href="#"><i class="fa  fa-plus"></i> <span>Management Meetings</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a> 
          
          <ul class="treeview-menu">
          @permission('can-view-lab-equipment')
            
            <li><a href="#">Upload quartery report</a></li>
           @endpermission<li><a href="{{route('meetingreport.create')}}">Upload weekly report</a></li>
            <li><a href="#">View all reports</a></li>
          </ul>
          
        </li>
        @role(['hub_coordinator','administrator','national_hub_coordinator'])  
        <li class="treeview">
          <a href="#"><i class="fa fa-users"></i> <span>Sample Transporters</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            @if (!Auth::guest())
            
          	<li><a href="{{ url('staff/list/1') }}">View All Sample Transporters</a></li>
            @role(['national_hub_coordinator']) 
            <li><a href="{{ url('staff/new/4') }}">Add New Drive</a></li>
            <li><a href="{{ url('staff/list/4') }}">View All Drivers</a></li>
            <li><a href="{{ url('staff/new/5') }}">Add New EOC Staff</a></li> 
            <li><a href="{{ url('staff/list/4') }}">View All EOC Staff</a></li>
            @endrole
          @if(Auth::user()->can('create-sample-transporter'))
            <li><a href="{{ url('staff/new/1') }}">Add New Sample Transporter</a></li>
            @endif
          @endif

          </ul>
        </li>
        <li class="treeview">
          <a href="#"><i class="fa fa-users"></i> <span>Manage Sample Receptionist</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            @if (!Auth::guest())
            
          	<li><a href="{{ url('staff/list/2') }}">Sample Receptionists</a></li>
          @if(Auth::user()->can('create-sample-transporter'))
            <li><a href="{{ url('staff/new/2') }}">New Sample Receptionist</a></li>
            @endif
          @endif

          </ul>
        </li>
        <li class="treeview">
          <a href="#"><i class="fa fa-users"></i> <span>Manage Drivers</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            @if (!Auth::guest())
            
            <li><a href="{{ url('staff/list/4') }}">Manage Drivers</a></li>
          @if(Auth::user()->can('create-sample-transporter'))
            <li><a href="{{ url('staff/new/4') }}">New Driver</a></li>
            @endif
          @endif

          </ul>
        </li>
        <li class="treeview">
          <a href="#"><i class="fa fa-users"></i> <span>Manage Results</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
           
          	<li><a href="{{ route('results.tracking') }}">All results</a></li>
            
          </ul>
        </li>
        @endrole
        <li class="treeview" style = "display:none">
          <a href="#"><i class="fa fa-arrows"></i> <span>Sample Tracking</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            @if (!Auth::guest())
            <li><a href="{{ route('sampletracking.create') }}">Refer Sample</a></li>
          	<li><a href="{{ route('sampletracking.index') }}">All referred Samples</a></li>
          
          @endif

          </ul>
        </li>
        
      </ul>
		@role(['hub_coordinator']) 
        <div style="text-align:center; padding-top:10px;">
        	<a href="{{route('facility.printqr', Auth::user()->hubid)}}" target="_blank">{!! QrCode::size(100)->generate(Auth::user()->hubid)!!}</a>
        </div>
        @endrole
    
   
  
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>
