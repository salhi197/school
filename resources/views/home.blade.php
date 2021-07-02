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
                                        <h4>Malek School</h4>
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
                                                    <td><strong>Location :</strong> USA</td>
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
                                        <h5 class="text-uppercase"><strong>Business Location Information</strong></h5>
                                    </div>
                                    <hr class="m-0">
                                    <div class="table-responsive ">
                                        <table class="table row table-borderless">
                                            <tbody class="col-lg-12 col-xl-6 p-0">
                                                <tr>
                                                    <td><strong>Streen Name:</strong> 45 welete Streen</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>City :</strong> USA</td>
                                                </tr>
                                            </tbody>
                                            <tbody class="col-lg-12 col-xl-6 p-0">
                                                <tr>
                                                    <td><strong>Country :</strong> USA</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Postal Code :</strong> 658965</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row profie-img">
                                        <div class="col-md-12">
                                            <div class="media-heading">
                                                <h5 class="text-uppercase"><strong>Biography</strong></h5>
                                            </div>
                                            <hr class="m-0 mb-3">
                                            <p>Omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.</p>
                                            <p class="mb-0">We denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection</p>
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
