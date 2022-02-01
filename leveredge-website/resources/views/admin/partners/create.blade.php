@extends('template.public')

@section('content')
    <div id="admin-dashboard">
        <div id="safeApp">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 col-xs-12">
                        <div class="form-partner">
                            @if(Session::has('message'))
                            <div class="alert alert-success">
                                {{ Session::get('message') }}
                            </div>
                            @endif

                            <div class="header">
                                <h1 class="h1">Create new Partner</h1>
                            </div>

                            <form action="{{ route('admin.partner.store') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Name:</label>
                                    <input type="text" name="name" id="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" autocomplete="off" placeholder="Partner Name">

                                    @if($errors->has('name'))
                                    <span class="invalid-feedback">
                                        {{ $errors->first('name') }}
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="text" name="email" id="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" autocomplete="off" placeholder="partnermail@joinjuno.com">

                                    @if($errors->has('email'))
                                    <span class="invalid-feedback">
                                        {{ $errors->first('email') }}
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="password">Password:</label>
                                    <input type="password" name="password" id="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" autocomplete="off">

                                    @if($errors->has('password'))
                                        <span class="invalid-feedback">
                                            {{ $errors->first('password') }}
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="referral_code">Referral Code:</label>
                                    <input type="text" name="referral_code" id="referral_code" class="form-control{{ $errors->has('referral_code') ? ' is-invalid' : '' }}" autocomplete="off" placeholder="partner-code">

                                    @if($errors->has('referral_code'))
                                        <span class="invalid-feedback">
                                            {{ $errors->first('referral_code') }}
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="partner_type">Partner Type:</label>
                                    <select name="partner_type" id="partner_type" class="form-control{{ $errors->has('partner_type') ? ' is-invalid' : '' }}">
                                        <option value="">-- Select a option</option>
                                        @foreach($partnerTypes as $partnerType)
                                            <option value="{{ $partnerType->id }}">{{ $partnerType->type }}</option>
                                        @endforeach
                                    </select>

                                    @if($errors->has('partner_type'))
                                        <span class="invalid-feedback">
                                            {{ $errors->first('partner_type') }}
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="contract_type">Contract Type:</label>
                                    <select name="contract_type" id="contract_type" class="form-control{{ $errors->has('contract_type') ? ' is-invalid' : '' }}">
                                        <option value="">-- Select a option</option>
                                        @foreach($contractTypes as $contractType)
                                            <option value="{{ $contractType->id }}">{{ $contractType->type }}</option>
                                        @endforeach
                                    </select>

                                    @if($errors->has('contract_type'))
                                        <span class="invalid-feedback">
                                            {{ $errors->first('contract_type') }}
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Create Partner</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-md-5 offset-md-2 col-xs-12">

                        <div class="form-contract-type">
                            <h4 class="h1 p-0 m-0 mb-3">Contract Types</h4>

                            <ul class="list-group" style="max-height: 300px; overflow-y: scroll;">
                                @foreach($contractTypes as $contractType)
                                    <li class="list-group-item">{{ $contractType->type }}</li>
                                @endforeach
                            </ul>

                            <form action="{{ route('admin.contract-type.store') }}" method="post">
                                @csrf
                                <div class="form-group mt-3">
                                    <input type="text" name="type" id="contract_name" class="form-control" autocomplete="off">
                                </div>

                                <button type="submit" class="btn btn-primary">Add Contract Type</button>
                            </form>
                        </div>

                        <div class="form-partner-type mt-5">
                            <h4 class="h1 p-0 m-0 mb-3">Partner Types</h4>

                            <ul class="list-group" style="max-height: 300px; overflow-y: scroll;">
                                @foreach($partnerTypes as $partnerType)
                                    <li class="list-group-item">{{ $partnerType->type }}</li>
                                @endforeach
                            </ul>

                            <form action="{{ route('admin.partner-type.store') }}" method="post">
                                @csrf
                                <div class="form-group mt-3">
                                    <input type="text" name="type" id="partner_name" class="form-control" autocomplete="off">
                                </div>

                                <button type="submit" class="btn btn-primary">Add Partner Type</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
