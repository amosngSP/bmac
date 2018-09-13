@extends('layouts.app')

@section('content')
    @if (count($errors) > 0)
        <div class="alert alert-dismissible alert-danger">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $booking->event->name }} | My reservation</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('booking.cancel',$booking) }}">
                        @csrf
                        @method('PUT')
                        {{--Callsign--}}
                        <div class="form-group row">
                            <label for="callsign" class="col-md-4 col-form-label text-md-right">Callsign</label>

                            <div class="col-md-6">
                                <div class="form-control-plaintext"><strong>{{ $booking->callsign }}</strong></div>
                            </div>
                        </div>

                        {{--CTOT--}}
                        <div class="form-group row">
                            <label for="ctot" class="col-md-4 col-form-label text-md-right"> CTOT</label>

                            <div class="col-md-6">
                                <div class="form-control-plaintext"><strong>{{ $booking->ctot }}</strong></div>

                            </div>
                        </div>

                        {{--ADEP--}}
                        <div class="form-group row">
                            <label for="adep" class="col-md-4 col-form-label text-md-right">ADEP</label>

                            <div class="col-md-6">
                                <div class="form-control-plaintext"><strong>{{ $booking->dep }}</strong></div>

                            </div>
                        </div>

                        {{--ADES--}}
                        <div class="form-group row">
                            <label for="ades" class="col-md-4 col-form-label text-md-right">ADES</label>

                            <div class="col-md-6">
                                <div class="form-control-plaintext"><strong>{{ $booking->arr }}</strong></div>

                            </div>
                        </div>

                        {{--PIC--}}
                        <div class="form-group row">
                            <label for="pic" class="col-md-4 col-form-label text-md-right">PIC</label>

                            <div class="col-md-6">
                                <div class="form-control-plaintext">
                                    <strong>{{ $booking->bookedBy ? $booking->bookedBy->pic : $booking->reservedBy->pic }}</strong>
                                </div>
                            </div>
                        </div>

                        {{--Route--}}
                        <div class="form-group row">
                            <label for="route" class="col-md-4 col-form-label text-md-right">Route</label>

                            <div class="col-md-6">
                                <div class="form-control-plaintext">
                                    <strong>{{ $booking->route ?: 'T.B.D. / Available on day of event at 0600z' }}</strong>
                                </div>

                            </div>
                        </div>

                        {{--Track--}}
                        <div class="form-group row">
                            <label for="track" class="col-md-4 col-form-label text-md-right">Track</label>

                            <div class="col-md-6">
                                <div class="form-control-plaintext">
                                    <strong>{{ $booking->oceanicTrack ?:  'T.B.D. / Available on day of event at 0600z' }}</strong>
                                </div>

                            </div>
                        </div>

                        {{--Oceanic Entry FL--}}
                        <div class="form-group row">
                            <label for="track" class="col-md-4 col-form-label text-md-right">Oceanic Entry FL</label>

                            <div class="col-md-6">
                                <div class="form-control-plaintext"><strong>{{ $booking->oceanicFL }}</strong></div>

                            </div>
                        </div>

                        {{--Aircraft--}}
                        <div class="form-group row">
                            <label for="aircraft" class="col-md-4 col-form-label text-md-right">Aircraft</label>

                            <div class="col-md-6">
                                <div class="form-control-plaintext"><strong>{{ $booking->acType }}</strong></div>
                            </div>
                        </div>

                        {{--SELCAL--}}
                        <div class="form-group row">
                            <label for="selcal" class="col-md-4 col-form-label text-md-right">SELCAL</label>

                            <div class="col-md-6">
                                <div class="form-control-plaintext"><strong>{{ $booking->selcal }}</strong></div>
                            </div>
                        </div>

                        @foreach($booking->airportDep->links as $link)
                            <div class="form-group row">
                                <label for="{{ $link->type->name  . $link->airport->icao  }}" class="col-md-4 col-form-label text-md-right">{{ $link->name ?? $link->type->name . ' ' . $link->airport->icao }}</label>

                                <div class="col-md-6">
                                    <div class="form-control-plaintext"><a
                                            href="{{ $link->url }}"
                                            target="_blank">Link</a></div>
                                </div>
                            </div>
                        @endforeach

                        {{--Oceanic sheet--}}
                        <div class="form-group row">
                            <label for="chartsEHAM" class="col-md-4 col-form-label text-md-right">Oceanic sheet</label>

                            <div class="col-md-6">
                                <div class="form-control-plaintext"><a
                                        href="https://ctp.vatsim.net/system/view/includes/Transatlantic_Radio_Operations_Checksheet.pdf"
                                        target="_blank">Link</a></div>
                            </div>
                        </div>

                        @foreach($booking->airportArr->links as $link)
                            <div class="form-group row">
                                <label for="{{ $link->type->name  . $link->airport->icao  }}" class="col-md-4 col-form-label text-md-right">{{ $link->name ?? $link->type->name . ' ' . $link->airport->icao }}</label>

                                <div class="col-md-6">
                                    <div class="form-control-plaintext"><a
                                            href="{{ $link->url }}"
                                            target="_blank">Link</a></div>
                                </div>
                            </div>
                        @endforeach

                        {{--Cancel Booking--}}
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-danger">
                                    Cancel Booking
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
