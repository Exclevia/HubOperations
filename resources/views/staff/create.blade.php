@extends('layouts.app')
@if ($pagetype == 1)
	@section('title', 'Add New Sample Transporter')
@elseif($pagetype == 4)
	@section('title', 'Add New Driver')
@elseif($pagetype == 2)
	@section('title', 'Add New Sample Receptionist')
@elseif($pagetype == 5)	
	@section('title', 'Add New EOC Staff')
@else
@endif
@section('js')
<script src="{{ asset('js/bootstrapValidator.min-0.5.1.js') }}"></script>
 <script>
	$(document).ready(function() {
	$('#permitexpirydate').datepicker({
		   format: 'mm/dd/yyyy',
		   autoclose: true
		});
		
	$("input[name='hasdrivingpermit']").change(function(){
		if( $(this).is(":checked") ){ // check if the radio is checked
            var val = $(this).val(); // retrieve the value
			//alert(val);
			if(val == 1){
				$('#permitexpirydate').removeClass('hidden');
			}else{
				$('#permitexpirydate').val('');
				$('#permitexpirydate').addClass('hidden');
			}
        }	
		
	});
	$("input[name='permitexpirydate']").change(function(){
		$('#staffform').bootstrapValidator('revalidateField', 'permitexpirydate');
	});
	$("select[name='facilityid']").change(function(){
      var id = $(this).val();
      var token = $("input[name='_token']").val();
      $.ajax({
          url: "<?php echo url('staff/bikewithoutrider'); ?>",
          method: 'POST',
          data: {hubid:id, _token:token},
          success: function(data) {
			  	$("#motorbikeid").html("").prepend("<option value=''>Select One</option>"); 
			    $("select[name='motorbikeid'").html('');
				$("select[name='motorbikeid'").html(data.options);
			  }
		  });
	  });
		
		$('#staffform').bootstrapValidator({
       
        fields: {
			facilityid: {
                    validators: {
                        notEmpty: {
                            message: 'Please select a hub'
                        }
                    }
                },
                
			firstname: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter the first name'
                        }
                    }
                },
				hasdrivingpermit: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter a number'
                        }
                     }
                },
        permitexpirydate: {
            validators: {
                notEmpty: {
                    message: 'Please select the permit expiry date'
                }
             }
        },
		code: {
            validators: {
                notEmpty: {
                    message: 'Please the code the user will use to login into the mobile app'
                }
             }
        },
        isimmunizedforhb: {
            validators: {
                notEmpty: {
                    message: 'Please select whether the transporter is Immunized for HB'
                }
             }
        },
        hasdrivingpermit: {
            validators: {
                notEmpty: {
                    message: 'Please specify whether transporter has driving permit'
                }
             }
        },
        hasbbtraining: {
            validators: {
                notEmpty: {
                    message: 'Please specify whether transporter is trained in BB'
                }
             }
        },
        hasdefensiveriding: {
            validators: {
                notEmpty: {
                    message: 'Please specify whether transporter has undergone defensive driving'
                }
             }
        },
				nationalid: {
                    validators: {
						stringLength: {
							  min: 14,
							  max: 14,
							  message: 'The NIN should be 14 characters long'
						}
                    }
                },
				lastname: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter the last name'
                        }
                    }
                },
				telephonenumber: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter the telephone number'
                        }
                    }
                },
					email: {          
				validators: {
							regexp: {
							  regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
							  message: 'The value is not a valid email address'
							}
						}
					}
		}//endo of validation rules
    });// close form validation function
	});
</script>
@append
@section('content')
	<div class="box box-info">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
         @endif
            
            <!-- /.box-header -->
            <!-- form start -->
            {{-- Using the Laravel HTML Form Collective to create our form --}}
    		{{ Form::open(array('route' => 'staff.store', 'class' => 'form-horizontal', 'id' => 'staffform')) }}
            	{{ csrf_field() }}
              <div class="box-body">
              @role('Admin','Regional_hub_coordinator','Program_officer')
              <div class="form-group">
                  <label for="facility" class="col-sm-2 control-label">{{ Form::label('facility', 'Hub') }}</label>

                  <div class="col-sm-10">
                    {{ Form::select('facilityid', $hubsdropdown, null, ['class' => 'form-control', 'id' => 'facilityid']) }}
                     
                  </div>
                </div>             
                @endrole
                @if ($pagetype == 1)
                 <div class="form-group">
                  <label for="motorbikeid" class="col-sm-2 control-label">{{ Form::label('bikes', 'Motor Bike') }}</label>

                  <div class="col-sm-10">
                    {{ Form::select('motorbikeid', $bikes, null, ['class' => 'form-control']) }}
                     
                  </div>
                </div>
                @endif
              @if ($pagetype == 2)
              	<div class="form-group" style="display:none">
                  <label for="designation" class="col-sm-2 control-label">{{ Form::label('designation', 'Designation') }}</label>

                  <div class="col-sm-10">
                    {{ Form::select('designation', $designation, null, ['class' => 'form-control']) }}
                     
                  </div>
                </div>
              @endif
                <div class="form-group">
                  <label for="firstname" class="col-sm-2 control-label">{{ Form::label('firstname', 'First Name') }}</label>

                  <div class="col-sm-10">
                    {{ Form::text('firstname', null, array('class' => 'form-control', 'id' => 'firstname')) }}
                  </div>
                </div>
               <div class="form-group">
                  <label for="lastname" class="col-sm-2 control-label">{{ Form::label('lastname', 'Last Name') }}</label>

                  <div class="col-sm-10">
                    {{ Form::text('lastname', null, array('class' => 'form-control', 'id' => 'lastname')) }}
                  </div>
                </div>
                <div class="form-group">
                  <label for="othernames" class="col-sm-2 control-label">{{ Form::label('othernames', 'Other Names') }}</label>

                  <div class="col-sm-10">
                    {{ Form::text('othernames', null, array('class' => 'form-control', 'id' => 'othernames')) }}
                  </div>
                </div>
                <div class="form-group">
                  <label for="emailaddress" class="col-sm-2 control-label">{{ Form::label('emailaddress', 'Email Address') }}</label>

                  <div class="col-sm-10">
                    {{ Form::text('emailaddress', null, array('class' => 'form-control', 'id' => 'emailaddress')) }}
                  </div>
                </div>
                <div class="form-group">
                  <label for="telephonenumber" class="col-sm-2 control-label">{{ Form::label('telephonenumber', 'Telephone Number') }}</label>

                  <div class="col-sm-10">
                    {{ Form::text('telephonenumber', null, array('class' => 'form-control', 'id' => 'telephonenumber')) }}
                  </div>
                </div>
                <div class="form-group">
                  <label for="logincode" class="col-sm-2 control-label">{{ Form::label('logincode', 'Mobile App Login Code') }}</label>

                  <div class="col-sm-10">
                    {{ Form::text('code', null, array('class' => 'form-control', 'id' => 'code', 'placeholder' => 'e.g., 345')) }}
                  </div>
                </div>
                @if ($pagetype == 1)
                    <div class="form-group">
                      <label for="drivingpermit" class="col-sm-2 control-label">{{ Form::label('drivingpermit', 'Has Driving Permit') }}</label>
    
                      <div class="col-sm-3">
                        {!!generateRationInput($yes_no, 'hasdrivingpermit')!!}
                        @if ($errors->has('hasdrivingpermit'))
                            <span class="help-block">
                                <strong>{{ $errors->first('hasdrivingpermit') }}</strong>
                            </span>
                        @endif
                      </div>
                      <div class="col-sm-3">
                        {{ Form::text('permitexpirydate', null, array('class' => 'form-control hidden', 'id' => 'permitexpirydate', 'placeholder' => 'Expiry Date')) }}
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="hasdefensiveriding" class="col-sm-2 control-label">{{ Form::label('hasdefensiveriding', 'Has Defensive Driving') }}</label>

                      <div class="col-sm-10">
                        {!!generateRationInput($yes_no, 'hasdefensiveriding')!!}
                        @if ($errors->has('hasdefensiveriding'))
                            <span class="help-block">
                                <strong>{{ $errors->first('hasdefensiveriding') }}</strong>
                            </span>
                        @endif
                      </div>
                    </div> 
                    <div class="form-group">
                      <label for="hasbbtraining" class="col-sm-2 control-label">{{ Form::label('hasbbtraining', 'Has BB Training') }}</label>

                      <div class="col-sm-10">
                        {!!generateRationInput($yes_no, 'hasbbtraining')!!}
                        @if ($errors->has('hasbbtraining'))
                            <span class="help-block">
                                <strong>{{ $errors->first('hasbbtraining') }}</strong>
                            </span>
                        @endif
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="isimmunizedforhb" class="col-sm-2 control-label">{{ Form::label('isimmunizedforhb', 'Is Immunized for Hepatitis B') }}</label>

                      <div class="col-sm-10">
                        {!!generateRationInput($yes_no, 'isimmunizedforhb')!!}
                        @if ($errors->has('isimmunizedforhb'))
                            <span class="help-block">
                                <strong>{{ $errors->first('isimmunizedforhb') }}</strong>
                            </span>
                        @endif
                      </div>
                    </div>  
                 @endif
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                {{Form::hidden('type', $pagetype)}}
                <a class="btn btn-sm btn-danger" href="{{ URL::previous() }}">Cancel</a>
               
                {{ Form::submit('Create', array('class' => 'btn btn-sm btn-info pull-right')) }}
                
              </div>
              <!-- /.box-footer -->
            
            {{ Form::close() }}
          </div>
@endsection 