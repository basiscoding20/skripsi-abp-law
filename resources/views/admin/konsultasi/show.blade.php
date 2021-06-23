@extends('layouts.backEnd')

@section('title', 'EDIT USER | ABP LAW FIRM')

@push('css_down')
    <style>
        .msg_card_body {
            max-height: 400px;
            overflow-y: auto;
        }
    </style>
@endpush

@section('content')
<div class="main-body">
    <div class="page-wrapper">

        {{-- components breadcrumb --}}
        <x-breadcrumb title="Pengajuan" label="Pengajuan" url="pengajuan" label-active="Edit Pengajuan"/>

        <div class="page-body">
            <div class="card">
                <div class="card-header">
                    <h5>Konsultasi Pengajuan</h5>
                </div>
                <div class="card-block">
                    {{-- {!! Form::open() !!} --}}
                    <div class="col-md-8">
                        <div class="form-group row">
                            {!! Form::label('no_pengajuan', 'No Pengajuan:', ['class' => 'col-sm-2 col-form-label']) !!}
                            <div class="col-sm-10">
                                {!! Form::text('no_pengajuan', $file->no_pengajuan, ['class' => 'form-control text-capitalize', 'readonly']) !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            {!! Form::label('category_id', 'Kategori:', ['class' => 'col-sm-2 col-form-label']) !!}
                            <div class="col-sm-10">
                                {!! Form::text('category_id', $file->category->name, ['class' => 'form-control text-capitalize', 'readonly']) !!}
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            {!! Form::label('', '', ['class' => 'col-sm-2']) !!}
                            <div class="col-sm-10">
                                <a href="{{ route('konsultasi.index') }}" class="btn btn-inverse btn-sm">Kembali</a>
                            </div>
                        </div>
                    </div>
                    {{-- {!! Form::close() !!} --}}
                </div>
            </div>
            <div class="card">
                <div class="card-block">
                    <div class="col-md-8">
                        <div class="media chat-inner-header">
                            <a class="back_chatBox">
                                <i class="feather icon-chevron-left"></i> Konsultasi
                            </a>
                        </div>
                        @if ($file->status == 0)
                        <div class="p-b-20">
                            <div class="right-icon-control">
                                <input type="text" name="chat" class="form-control search-text" placeholder="Enter your chat">
                                <div class="form-icon" id="send_message" style="cursor: pointer;">
                                    <i class="feather icon-navigation"></i>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="msg_card_body">
                            {{-- chat ajax --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>

    $('#send_message').click(function(e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        if ($("input[name='chat']").val() != '') {
            $.ajax({
                type: 'POST',
                url: '{{url("pengajuan/".$file->id."/chat")}}',
                data: {
                    'chat': $("input[name='chat']").val()
                },
                success: function(data) {
                    AllData();
                    $("input[name='chat']").val('');
                }
            });
        }
    });

    function AllData() {
        $.ajax({
            url: '{{url("pengajuan/".$file->id."/chat")}}',
            dataType: 'json',
            success: function(response) {
                // json response
                let chats = response.chats, chat = '',
                    image = '{{asset("backEnd/img/avatar.jpg")}}';

                $.each(chats, function(index, value) {
                    if (value.is_admin == 0) {
                        chat += `
                        <div class="col-md-8 mb-3 mt-3">
                            <div class="media chat-messages">
                                <a class="media-left photo-table" href="#!">
                                    <img class="media-object img-radius img-radius m-t-5" src="${image}" alt="Generic placeholder image">
                                </a>
                                <div class="media-body chat-menu-content">
                                    <div class="">
                                        <p class="chat-cont mb-0">${value.chat}</p>
                                        <p class="chat-time" style="font-size: 11px;">${value.user.name} | ${value.format_date}</p>
                                    </div>
                                </div>
                            </div>
                        </div>`;
                    }

                    if (value.is_admin == 1) {
                        chat += `
                        <div class="col-md-8 offset-md-4 mt-3 mb-3">
                            <div class="media chat-messages">
                                <div class="media-body chat-menu-reply">
                                    <div class="">
                                        <p class="chat-cont mb-0">${value.chat}</p>
                                        <p class="chat-time" style="font-size: 11px;">${value.user.name} | ${value.format_date}</p>
                                    </div>
                                </div>
                                <div class="media-right photo-table">
                                    <a href="#!">
                                        <img class="media-object img-radius img-radius m-t-5" src="${image}" alt="Generic placeholder image">
                                    </a>
                                </div>
                            </div>
                        </div>`;
                    }
                    $('.msg_card_body').html(chat);
                    $('.msg_card_body').scrollTop($('.msg_card_body')[0].scrollHeight);
                });
                // ===============================================================================\
            }
        })
    };

    AllData();

    setInterval(function() {
        AllData();
    }, 3000);
    
</script>   
@endpush
