@extends('student.layouts.master')
@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                            <i class="fa fa-graduation-cap"></i>
                        </div>
                        <div>Diary
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <div id="dairy_calendar"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <div class="media flex-wrap w-100 align-items-center">
                                <div class="media-body">
                                    <a href="javascript:void(0)">Summer Camp</a>
                                </div>
                                <div class="text-muted small">
                                    <div><strong>01/12/2017</strong></div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <p>This is Photoshop's version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet.
                                Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem
                                nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan
                                ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non mauris vitae erat
                                consequat auctor eu in elit. Class aptent taciti sociosqu ad litora torquent per conubia
                                nostra, per inceptos himenaeos. Mauris in erat justo. Nullam ac urna eu felis dapibus
                                condimentum sit amet a augue. Sed non neque elit. Sed ut imperdiet nisi. Proin condimentum
                                fermentum nunc. Etiam pharetra, erat sed fermentum feugiat, velit mauris egestas quam, ut
                                aliquam massa nisl quis neque. Suspendisse in orci enim. </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        @include('teacher.layouts.static_footer')
    </div>
    <script src='https://unpkg.com/tooltip.js/dist/umd/tooltip.min.js'></script>

    <script>
        $(document).ready(function() {
            $('#dairy_calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                displayEventTime: true,
                themeSystem: 'bootstrap4',
                events: "{{ route('user.dairy') }}",

                eventRender: function(event, element) {
                    element.find('.fc-title').append("<br/>" + event.description);
                },
                // eventMouseover: function(calEvent, jsEvent) {
                //     var tooltip =
                //         '<div class="tooltipevent" style="width:100px;height:100px;background:#ccc;position:absolute;z-index:10001;">' +
                //         calEvent.end_time + '</div>';
                //     var $tooltip = $(tooltip).appendTo('body');

                //     $(this).mouseover(function(e) {
                //         $(this).css('z-index', 10000);
                //         $tooltip.fadeIn('500');
                //         $tooltip.fadeTo('10', 1.9);
                //     }).mousemove(function(e) {
                //         $tooltip.css('top', e.pageY + 10);
                //         $tooltip.css('left', e.pageX + 20);
                //     });
                // },
                // eventMouseout: function(calEvent, jsEvent) {
                //     $(this).css('z-index', 8);
                //     $('.tooltipevent').remove();
                // },
            });
        })
    </script>
@endsection
