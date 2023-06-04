@extends('layouts.main')

{{-- Page CSS --}}
@section('head')
    <link rel="stylesheet" href="{{ asset('css/profile-edit.css') }}">
    <link rel="stylesheet" href="{{ asset('css/article.css') }}">

    <style>
        input[type="range"]:disabled {
            background-color: rgb(74, 123, 197);
        }

        input[type="range"]::-webkit-slider-thumb {
            display: none;
        }

        .active-tab-status-artikel {
            background-color: #FFD233;
            border-radius: 15px;
            padding: 5px;
            color: #000;
        }
    </style>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
@endsection

@section('container')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <section class="editprofile">
        <div class="my-width">
            <div style="display: flex;">
                @if ($user->photo)
                    <img src="{{ asset('storage/photos/' . $user->photo) }}" alt=""
                        style="width: 150px;
                    height: 150px;
                    border-radius: 50%;">
                @else
                    <img src="img/profile-pict.jpg" alt=""
                        style="width: 150px;
                height: 150px;
                border-radius: 50%;">
                @endif

                <div style="display: flex;justify-content:center;margin-left:3%;flex-direction:column;">
                    <div style="display: flex;">
                        <h4 style="font-size: 36px;">{{ $user->username }}</h4>
                        <small style="font-size: 15px;margin-top:5%;margin-left:2%;">{{ $user->tier->tier_name }}</small>
                    </div>
                    <p style="color:#BEBEBE;margin-top:3%;">{{ $user->articles()->count() }} Artikel </p>
                    <p style="margin-top:6%;">{{ $user->bio }}</p>
                </div>

                <div style="margin-left:auto;margin-top:5%;min-width: 235px;">
                    <p style="text-align: center;">{{ $user->tier->tier_name }}</p>
                    <div style="display: flex;padding:5px; background-color:#272727;width:100%;border-radius:15px;">
                        <span>
                            Poin
                        </span>
                        <input type="range" value="80" style="margin-left: 2%;margin-right: 2%;" id="range-poin"
                            disabled>
                        <span>
                            Exp : {{ $user->exp }}/100
                        </span>
                    </div>

                    <div style="text-align: right;text-align: right; margin-top: 13%;">
                        <a href="#Signup" style="padding: 10px;background-color:#FFD233;color:black;border-radius:10px;">
                            Edit Profile
                        </a>
                    </div>
                </div>
            </div>

            <div class="garis-section">
                <a href="javascript:;" style="font-size:25px;margin-left:1%;border-bottom: 3px solid #FFD233;">Artikel</a>
                {{-- <a href="{{ url('profile/diskusi') }}" style="font-size:25px;margin-left:3%;">Diskusi</a> --}}
            </div>

    </section>


    <section class="terbaru">
        @if ($articles->count() != 0)
            <div class="my-width">

                <div class="terbaru-content" style="border-top:none;margin-top: 25px;margin-bottom: 5%;">
                    <ul>
                        @foreach ($articles as $article)
                            <li>
                                <div class="karesel">
                                    <div class="kotak-terbaru">
                                        <a href="{{ url(sprintf('article/%s', $article->slug)) }}">
                                            <img src="https://source.unsplash.com/300x180/?{{ $article->tag->name }}"
                                                alt="">
                                        </a>
                                        <div class="text-terbaru">
                                            <div class="title-terbaru">
                                                <h3>{{ $article->title }}</h3>
                                            </div>
                                            <div class="waktu-upload">
                                                <p>{{ $article->created_at->diffForHumans() }}</p>
                                            </div>
                                            <div class="penulis-terbaru">
                                                <img src="img/profile-pict.jpg" alt="">
                                                <div class="akun-terbaru">
                                                    <a href="{{ route('user.show', [$article->author->id]) }}">
                                                        <div class="nama-akun"
                                                            style="margin-top: 0;
                                                            margin-bottom: 0;
                                                            font-style: unset;">
                                                            <p>{{ $article->author->name }}</p>
                                                        </div>
                                                    </a>
                                                    <div class="tier-status">
                                                        <p>Tier</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div>
                                            <a href="javascript:;"
                                                onclick="showAction(`#action-article-{{ $article->id }}`)">
                                                <img src="{{ asset('img/icons/three-dot.svg') }}" alt=""
                                                    style="height:20px;">
                                            </a>
                                            <div style="display:none;background-color: #616161;padding:10px;flex-direction:column;border-radius:10px;gap:10px;position: absolute;"
                                                id="action-article-{{ $article->id }}">
                                                <a href="javascript:;">Edit</a>
                                                <a href="javascript:;">Hapus</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif


        @if ($articles->count() == 0)
            <div class="my-width" style="min-height:340px;display:flex;justify-content:center;align-items:center;">
                <h4>Belum ada artikel</h4>
            </div>
        @endif
    </section>


    {{-- script --}}
    <script>
        const showAction = (elementID) => {
            let element = $(elementID);
            let display = element.css('display');

            if (display === 'none') {
                element.css('display', 'flex')
            } else {
                element.css('display', 'none')
            }
        }
    </script>
@endsection