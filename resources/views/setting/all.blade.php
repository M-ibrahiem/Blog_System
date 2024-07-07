@extends('custom layouts.dash.app')

@section('title', 'settings')
@section('content')

                    <div class="card col-12">
                        <div class="card-body pa-0">
                            <div class="table-wrap">
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <div class="custom-control custom-checkbox checkbox-primary">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="customCheck4">
                                                        <label class="custom-control-label" for="customCheck4">Lead
                                                            Title</label>
                                                    </div>
                                                </th>
                                                <th>Sales</th>
                                                <th>Company</th>
                                                <th>Date Created</th>
                                                <th>Lead Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="custom-control custom-checkbox checkbox-primary">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="customCheck41" checked="">
                                                        <label class="custom-control-label" for="customCheck41"><span
                                                                class="w-130p d-block text-truncate">connar_weiked@ae.com</span></label>
                                                    </div>
                                                </td>
                                                <td>$2000</td>
                                                <td>
                                                    <div class="media align-items-center">
                                                        <div class="media-img-wrap d-flex mr-10">
                                                            <div class="avatar avatar-xs">
                                                                <span
                                                                    class="avatar-text avatar-text-primary rounded-circle"><span
                                                                        class="initial-wrap"><span>A</span></span></span>
                                                            </div>
                                                        </div>
                                                        <div class="media-body">
                                                            <span class="d-block">American Express</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    22/10/2018
                                                </td>
                                                <td><span class="badge badge-primary">On track</span></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="custom-control custom-checkbox checkbox-primary">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="customCheck42">
                                                        <label class="custom-control-label" for="customCheck42"><span
                                                                class="w-130p d-block text-truncate">express_notingham@em.au</span></label>
                                                    </div>
                                                </td>
                                                <td>$1600</td>
                                                <td>
                                                    <div class="media align-items-center">
                                                        <div class="media-img-wrap d-flex mr-10">
                                                            <div class="avatar avatar-xs">
                                                                <span
                                                                    class="avatar-text avatar-text-danger rounded-circle"><span
                                                                        class="initial-wrap"><span>M</span></span></span>
                                                            </div>
                                                        </div>
                                                        <div class="media-body">
                                                            <span class="d-block">Exxon Mobil</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    15/09/2018
                                                </td>
                                                <td><span class="badge badge-primary">On track</span></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="custom-control custom-checkbox checkbox-primary">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="customCheck43">
                                                        <label class="custom-control-label" for="customCheck43"><span
                                                                class="w-130p d-block text-truncate">locast12_host@nova.com</span></label>
                                                    </div>
                                                </td>
                                                <td>$1265</td>
                                                <td>
                                                    <div class="media align-items-center">
                                                        <div class="media-img-wrap d-flex mr-10">
                                                            <div class="avatar avatar-xs">
                                                                <span
                                                                    class="avatar-text avatar-text-teal rounded-circle"><span
                                                                        class="initial-wrap"><span>B</span></span></span>
                                                            </div>
                                                        </div>
                                                        <div class="media-body">
                                                            <span class="d-block">Big Blackship</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    30/08/2018
                                                </td>
                                                <td><span class="badge badge-danger">Behind</span></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="custom-control custom-checkbox checkbox-primary">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="customCheck44">
                                                        <label class="custom-control-label" for="customCheck44"><span
                                                                class="w-130p d-block text-truncate">grillmac@sundance.co.in</span></label>
                                                    </div>
                                                </td>
                                                <td>$4562</td>
                                                <td>
                                                    <div class="media align-items-center">
                                                        <div class="media-img-wrap d-flex mr-10">
                                                            <div class="avatar avatar-xs">
                                                                <span
                                                                    class="avatar-text avatar-text-indigo rounded-circle"><span
                                                                        class="initial-wrap"><span>F</span></span></span>
                                                            </div>
                                                        </div>
                                                        <div class="media-body">
                                                            <span class="d-block">Folkswagan</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    14/03/2018
                                                </td>
                                                <td><span class="badge badge-purple">Negotiation</span></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="custom-control custom-checkbox checkbox-primary">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="customCheck45">
                                                        <label class="custom-control-label" for="customCheck45"><span
                                                                class="w-130p d-block text-truncate">admin@novotel.inc</span></label>
                                                    </div>
                                                </td>
                                                <td>$5012</td>
                                                <td>
                                                    <div class="media align-items-center">
                                                        <div class="media-img-wrap d-flex mr-10">
                                                            <div class="avatar avatar-xs">
                                                                <span
                                                                    class="avatar-text avatar-text-purple rounded-circle"><span
                                                                        class="initial-wrap"><span>N</span></span></span>
                                                            </div>
                                                        </div>
                                                        <div class="media-body">
                                                            <span class="d-block">Novotel</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    21/02/2018
                                                </td>
                                                <td><span class="badge badge-orange">Offer Made</span></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="custom-control custom-checkbox checkbox-primary">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="customCheck46">
                                                        <label class="custom-control-label" for="customCheck46"><span
                                                                class="w-130p d-block text-truncate">displaypic@ho.au</span></label>
                                                    </div>
                                                </td>
                                                <td>$1245</td>
                                                <td>
                                                    <div class="media align-items-center">
                                                        <div class="media-img-wrap d-flex mr-10">
                                                            <div class="avatar avatar-xs">
                                                                <span
                                                                    class="avatar-text avatar-text-pink rounded-circle"><span
                                                                        class="initial-wrap"><span>D</span></span></span>
                                                            </div>
                                                        </div>
                                                        <div class="media-body">
                                                            <span class="d-block">Displaypic</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    3/02/2018
                                                </td>
                                                <td><span class="badge badge-orange">Offer Made</span></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="custom-control custom-checkbox checkbox-primary">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="customCheck47">
                                                        <label class="custom-control-label" for="customCheck47"><span
                                                                class="w-130p d-block text-truncate">manager@cobito.com</span></label>
                                                    </div>
                                                </td>
                                                <td>$1245</td>
                                                <td>
                                                    <div class="media align-items-center">
                                                        <div class="media-img-wrap d-flex mr-10">
                                                            <div class="avatar avatar-xs">
                                                                <span
                                                                    class="avatar-text avatar-text-yellow rounded-circle"><span
                                                                        class="initial-wrap"><span>C</span></span></span>
                                                            </div>
                                                        </div>
                                                        <div class="media-body">
                                                            <span class="d-block">Cobito co.</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    18/01/2018
                                                </td>
                                                <td><span class="badge badge-danger">Behind</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
