@extends('layouts.user')

@section('content')

    <div class="main-card mb-3 card">
        <div class="card-body">
            <h5 class="card-header">Melengkapi Profile</h5>
            
           <form class="mt-4" action="">

                <div class="position-relative row form-group"><label for="whatsapp" class="col-sm-2 col-form-label">Whatsapp</label>
                    <div class="col-sm-9 offset-1"><input value="{{ $user->mahasiswa->no_wa }}" id="whatsapp" class="form-control"></div>
                </div>

                <div class="position-relative row form-group"><label for="Telegram" class="col-sm-2 col-form-label">Telegram</label>
                    <div class="col-sm-9 offset-1"><input value="{{ $user->mahasiswa->id_tele }}" id="Telegram" class="form-control"></div>
                </div>

           </form>
            
        </div>
    </div>

@endsection
