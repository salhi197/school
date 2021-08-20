@extends('layouts.app')

@section('content')

    <div class="page-header">
        <h4 class="page-title">Profile</h4>
    </div>

    <!-- PAGE-HEADER END -->

    <!-- ROW-1 OPEN -->
    <div class="row" id="user-profile">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="wideget-user">
                        <div class="row">
                            <div class="col-lg-6 col-md-12">
                                <div class="wideget-user-desc d-flex">
                                    <div class="wideget-user-img">
                                        <img class="" src="../../assets/images/users/male/32.jpg" alt="img">
                                    </div>
                                    <div class="user-wrap">
                                        <h4>Nom Ecole</h4>
                                        <h6 class="text-muted mb-3">Member Since: November 2017</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="border-top">
                    <div class="wideget-user-tab">
                        <div class="tab-menu-heading">
                            <div class="tabs-menu1">
                                <ul class="nav">
                                    <li class=""><a href="#tab-51" class="active show" data-toggle="tab">Profile</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="border-0">
                        <div class="tab-content">
                            <div class="tab-pane active show" id="tab-51">
                                <div id="profile-log-switch">
                                    <div class="media-heading">
                                        <h5 class="text-uppercase"><strong>Informations De L'école</strong></h5>
                                    </div>
                                    <hr class="m-0">
                                    <div class="table-responsive ">
                                        <table class="table row table-borderless">
                                            <tbody class="col-lg-12 col-xl-6 p-0">
                                                <tr>
                                                    <td><strong>Nom :</strong> {!! $ecole[0]->nom !!}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Location :</strong> Alger</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Languages :</strong> English, German, Spanish.</td>
                                                </tr>
                                            </tbody>
                                            <tbody class="col-lg-12 col-xl-6 p-0">
                                                <tr>
                                                    <td><strong>Website :</strong> dashr.com</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Email :</strong> georgemestayer@dashr.com</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Phone :</strong> +125 254 3562 </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="media-heading mt-3">
                                        <h5 class="text-uppercase"><strong>Business Contact Information</strong></h5>
                                    </div>
                                    <hr class="m-0">
                                    <div class="table-responsive ">
                                        <table class="table row table-borderless">
                                            <tbody class="col-lg-12 col-xl-6 p-0">
                                                <tr>
                                                    <td><strong>Business Telephone:</strong> +245 256 2458 5586</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Business Mobile :</strong> +63 548 874 9658</td>
                                                </tr>
                                            </tbody>
                                            <tbody class="col-lg-12 col-xl-6 p-0">
                                                <tr>
                                                    <td><strong>Business Fax :</strong> +63 548 874 9658</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Managers Name :</strong> Daniell Marget</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="media-heading mt-3">
                                        <h5 class="text-uppercase"><strong>Définir les frais d'inscriptions</strong></h5>
                                    </div>
                                    <hr class="m-0">
                                    <div class="table-responsive ">
                                        <table class="table row table-borderless">
                                            <tbody class="col-lg-12 col-xl-6 p-0">
                                                <tr>
                                                    <td><strong>Définition des frais d'inscriptions</strong> Année scolaire : 21/22</td>
                                                </tr>
                                            </tbody>
                                            <tbody class="col-lg-12 col-xl-6 p-0">
                                                <tr>
                                                    <td>

                                                        <form method="POST" action="/home/saisir_frais">

                                                            <strong>
                                                            
                                                                <label for="frais"> 
                                                                    
                                                                    Frais 

                                                                    <input type="number" name="frais" class="form-control" value="{{$ecole[0]->frais}}"> 
                                                                </label>
                                                            </strong>
                                                            <button class="btn btn-outline-primary">Valider</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row profie-img">
                                        <div class="col-md-12">
                                            <div class="media-heading">
                                                <h5 class="text-uppercase"><strong>Information de connexion :</strong></h5>
                                            </div>
                                            <hr class="m-0 mb-3">
                                                <form class="form-inline" id="change-password" method="post" action="/change/password">
                                                {{ csrf_field() }}  
                                                <div class="form-group col-md-4 col-sm-12">
                                                    <label for="nomduclasse">Taper Votre Nouveau Mot de passe içi : </label>
                                                    <input value="{{ $password_text }}" type="text" id="password" required="true" name="password" class="form-control">
                                                </div>
                                                <button class="btn btn-outline-primary" onclick="document.getElementById('change-password').submit();">Valider</button>

                                            </form>



                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>    
                    </div>    
                </div>    
            </div>
        </div>
    </div>            
    {{--  --}}
@endsection
