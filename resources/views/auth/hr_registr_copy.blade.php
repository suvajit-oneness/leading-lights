@extends('auth.layout.master')
@section('content')
    <img src="{{ asset('frontend/images/dot2.png') }}" class="img-fluid post-img">
    <div class="ripple" style="animation-delay: 0s"></div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-10 offset-sm-1">
                <div class="sign-in-box">
                    <a href="{{ route('land_page') }}"><i title="Home Page"
                            class="fa fa-home text-primary fa-2x float-right mr-3 mt-3 shadow-sm text-info"></i></a>
                    <div class="row align-items-center jusify-content-center">
                        <div class="col-lg-5">
                            <img src="{{ asset('frontend/images/sign-in-hr.png') }}" class="img-fluid">
                        </div>
                        <div class="col-lg-7 form-div wow fadeInRight">
                            <div class="heading">
                                <h1>Register Now :)</h1>
                            </div>
                            <form class="cd-form" method="POST" action="{{ route('hr_register') }}"
                                enctype="multipart/form-data" id="registrationForm">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-sm-6">
                                        <label for="first_name">First Name<span class="text-danger">*</span> </label>
                                        <input class="form-control" id="first_name" name="first_name" type="text"
                                            placeholder="" value="{{ old('first_name') }}">
                                        <div class="error" style="color : red;">Please Fill This field.</div>
                                        @error('first_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <span class="cd-error-message">Error message here!</span>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="last_name">Last Name<span class="text-danger">*</span></label>
                                        <input class="form-control" id="last_name" name="last_name" type="text"
                                            placeholder="" value="{{ old('last_name') }}">
                                        <div class="error" style="color : red;">Please Fill This field.</div>
                                        @error('last_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-sm-6">
                                        <label for="email">Email address<span class="text-danger">*</span></label>
                                        <input class=" form-control" type="email" name="email" id="email"
                                            value="{{ old('email') }}">
                                        <div class="error" style="color : red;">Please Fill This field.</div>
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <span class="text-danger email-err"></span>
                                        <span class="text-success email-success"></span>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="mobile">Phone Number<span class="text-danger">*</span></label>
                                        <input class=" form-control" type="number" name="mobile" id="mobile"
                                            value="{{ old('mobile') }}" onkeyup="mobileValidation()">
                                        <div class="error" style="color : red;">Please Fill This field.</div>
                                        <span style="color: red;" id="digit_error"></span>
                                        @error('mobile')
                                            <span class="text-danger" id="mobile_err">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-sm-6">
                                        <label for="gender">Gender<span class="text-danger">*</span></label>
                                        <select name="gender" id="gender" class="form-control">
                                            <option value="">Select Gender</option>
                                            <option value="Male" @if (old('gender') == 'Male')  selected @endif>Male</option>
                                            <option value="Female" value="Female" @if (old('gender') == 'Female')  selected @endif>Female</option>
                                        </select>
                                        <div class="error" style="color : red;">Please Fill This field.</div>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="">Date Of Joining<span class="text-danger">*</span></label>
                                        <input class="form-control datepicker" type="text" name="doj"
                                            value="{{ old('doj') }}">
                                        <div class="error" style="color : red;">Please Fill This field.</div>
                                        @error('doj')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-sm-6">
                                        <label for="">Academic Qualification<span class="text-danger">*</span></label>
                                        <select name="qualification" class="form-control" id="qualification">
                                            <option value="">Select Qualification</option>

                                            <option value="Others">Others</option>
                                        </select>
                                        <div class="error" style="color : red;">Please Fill This field.</div>
                                    </div>
                                    <div class="form-group col-sm-6" id="other_qualification">
                                        <label for="image">Other Academic Qualification</label>
                                        <input type="text" class="form-control" name="other_qualification">
                                        <div class="error" style="color : red;">Please Fill This field.</div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-sm-6">
                                        <label for="image">Upload Profile Picture(png,jpg,jpeg only)<span
                                                class="text-danger">*</span></label>
                                        <input type="file" class="form-control" name="image"
                                            value="{{ old('image') }}">
                                        <div class="error" style="color : red;">Please Fill This field.</div>
                                        @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="certificate">Upload Documents(pdf only)<span
                                                class="text-danger">*</span></label>
                                        <input type="file" class="form-control" name="certificate"
                                            value="{{ old('certificate') }}">
                                        <div class="error" style="color : red;">Please Fill This field.</div>
                                        @error('certificate')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row mt-2">
                                    <div class="form-group col-sm-12">
                                        <button class="btn btn-login mt-2 float-right" type="submit"
                                            id="btn_submit">Submit</button>
                                        <a href="{{ route('hr_login') }}" class="btn btn-create mt-2" type="button"
                                            value="Login"><span></span>Back to login</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
    <script>
        $(document).ready(function() {
            $('#other_qualification').hide();
            var validated = false;
            $('.error').hide();
        });
        $('#qualification').on('change', function(e) {
            let qualification = $('#qualification').val();
            if (qualification === 'Others') {
                $('#other_qualification').show();
            } else {
                $('#other_qualification').hide();
            }
        })

        //Email availability
        $('#email').on('keyup', function() {
            let email = $('#email').val();
            $('input[name="email"]').next('.error').html('');
            if (email) {
                if (IsEmail(email) == false) {
                    $(".email-success").html('');
                    $(".email-err").html('');
                    $('.email-err').html('Invalid Email Address!').fadeIn(100);
                } else {
                    $.ajax({
                        url: "{{ route('checkEmailExistence') }}",
                        data: {
                            _token: "{{ csrf_token() }}",
                            email: email
                        },
                        dataType: 'json',
                        type: 'post',
                        beforeSend: function() {
                            $(".email-success").html('Loading....');
                        },
                        success: function(response) {
                            if (response.msg == 'success') {
                                $(".email-err").html('');
                                $(".email-success").html('Available');
                                document.getElementById("btn_submit").disabled = false;
                                document.getElementById("btn_submit").style.cursor = 'pointer';

                            } else {
                                $(".email-success").html('');
                                $(".email-err").html('Already exist!!');
                                document.getElementById("btn_submit").disabled = true;
                                document.getElementById("btn_submit").style.cursor = 'no-drop';
                            }
                        }
                    });
                }
            } else {
                $(".email-success").html('');
                $(".email-err").html('');
                document.getElementById("btn_submit").disabled = false;
                document.getElementById("btn_submit").style.cursor = 'pointer';
            }
        });

        //Email Validation
        function IsEmail(eml) {
            var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (!regex.test(eml)) {
                return false;
            } else {
                return true;
            }
        }

        function mobileValidation() {
            if ($('[name=mobile]').val().length > 10) {
                $('#digit_error').html('Please enter 10 digit number');
                $('#mobile').focus();
                $('#mobile_err').html('');
                document.getElementById("btn_submit").disabled = true;
                document.getElementById("btn_submit").style.cursor = 'no-drop';
            } else {
                $('#digit_error').html('');
                document.getElementById("btn_submit").disabled = false;
                document.getElementById("btn_submit").style.cursor = 'pointer';
            }
        }
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            startDate: '+1 day',
            daysOfWeekDisabled: [0]
        });

        $('#btn_submit').on('click', function(e) {
            e.preventDefault();
            var errorFlagOne = 0;

            var email = $('[name="email"]').val(),
                mobile = $('[name="mobile"]').val(),
                first_name = $('[name="first_name"]').val(),
                last_name = $('[name="last_name"]').val(),
                country_code = $('[name="country_code"]').val(),
                gender = $('[name="gender"]').val(),
                doj = $('[name="doj"]').val(),
                class_id = $('[name="class"]').val(),
                qualification = $('[name="qualification"]').val(),
                other_qualification = $('[name="other_qualification"]').val(),
                image = $('[name="image"]').val(),
                certificate = $('[name="certificate"]').val();

            if (!first_name) {
                $('[name="first_name"]').next('.error').fadeIn(100);
                errorFlagOne = 1;
            } else {
                $('[name="first_name"]').next('.error').fadeOut(100);
            }

            if (!last_name) {
                $('[name="last_name"]').next('.error').fadeIn(100);
                errorFlagOne = 1;
            } else {
                $('[name="last_name"]').next('.error').fadeOut(100);
            }

            if (!email) {
                $('input[name="email"]').next('.error').html('Please Fill This field.').fadeIn(100);
                errorFlagOne = 1;
            } else {
                $('input[name="email"]').next('.error').fadeOut(100);
            }

            if (!mobile) {
                $('[name="mobile"]').next('.error').fadeIn(100);
                errorFlagOne = 1;
            } else {
                $('[name="mobile"]').next('.error').fadeOut(100);
            }

            if (!mobile.match(/^\d{10}$/)) {
                $('[name="mobile"]').next('.error').next('.digit_error').fadeIn(100);
                errorFlagOne = 1;
            } else {
                $('[name="mobile"]').next('.error').next('.digit_error').fadeOut(100);
            }

            if (!country_code) {
                $('[name="country_code"]').next('.error').fadeIn(100);
                errorFlagOne = 1;
            } else {
                $('[name="country_code"]').next('.error').fadeOut(100);
            }

            if (!gender) {
                $('[name="gender"]').next('.error').fadeIn(100);
                errorFlagOne = 1;
            } else {
                $('[name="gender"]').next('.error').fadeOut(100);
            }
            if (!doj) {
                $('[name="doj"]').next('.error').fadeIn(100);
                errorFlagOne = 1;
            } else {
                $('[name="doj"]').next('.error').fadeOut(100);
            }
            if (!class_id) {
                $('[name="class"]').next('.error').fadeIn(100);
                errorFlagOne = 1;
            } else {
                $('[name="class"]').next('.error').fadeOut(100);
            }
            if (!qualification) {
                $('[name="qualification"]').next('.error').fadeIn(100);
                errorFlagOne = 1;
            } else {
                if (qualification === 'Others') {
                    if (!other_qualification) {
                        $('[name="other_qualification"]').next('.error').fadeIn(100);
                    } else {
                        $('[name="other_qualification"]').next('.error').fadeOut(100);
                    }
                } else {
                    $('[name="qualification"]').next('.error').fadeOut(100);
                }
                // $('[name="qualification"]').next('.error').fadeOut(100);
            }
            if (!image) {
                $('[name="image"]').next('.error').fadeIn(100);
                errorFlagOne = 1;
            } else {
                $('[name="image"]').next('.error').fadeOut(100);
            }

            var allowedImageExtensions = /(\.jpg|\.jpeg|\.png)$/i;
            if (!allowedImageExtensions.exec(image) && image != '') {
                $('[name="image"]').next('.error').html(
                    'Please upload file having jpg,jpeg and png extensions').fadeIn(100);
                errorFlagOne = 1;
            }

            if (!certificate) {
                $('[name="certificate"]').next('.error').fadeIn(100);
                errorFlagOne = 1;
            } else {
                $('[name="certificate"]').next('.error').fadeOut(100);
            }

            var allowedExtensions = /(\.pdf)$/i;
            if (!allowedExtensions.exec(certificate) && certificate != '') {
                $('[name="certificate"]').next('.error').html(
                    'Please upload file having pdf extensions').fadeIn(100);
                errorFlagOne = 1;
            }

            if (errorFlagOne == 1) {
                return false;
            } else {
                $("#registrationForm").submit();
            }
        });
    </script>
@endsection
