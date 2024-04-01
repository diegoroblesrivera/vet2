@extends('layouts.app')
@section('content')
<link href="{{ dsAsset('css/custom/dashboard/dashboard.css')}}" rel="stylesheet" />

<div class="panel-header bg-primary-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div>
                <h2 class="text-white pb-2 fw-bold">{{translate('Appointment Booking Dashboard')}}</h2>
            </div>
            <div class="ml-md-auto py-2 py-md-0">
                <a href="booking-calendar" class="btn btn-secondary btn-round">{{translate('Add New Booking')}}</a>
            </div>
        </div>
    </div>
</div>

<div class="page-inner mt--5">
   

   

    <div class="row">
        <div class="col-md-12   ">
            <div class="card full-height">
                <div class="card-header">
                    <div class="card-head-row">
                        <div class="card-title">{{translate('Para confirmar citas')}}</div>

                        <div class="card-tools">

                            <ul class="nav nav-pills nav-secondary nav-pills-no-bd nav-sm" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <select id="booking-info-service-status" class="form-control input-sm mt-1">
                                        <option value="">Todas Exceptos Atendidas</option>
                                        <option value="8">En Cirugia</option>
                                        <option value="7">Hospitalizacion</option>
                                        <option value="6">Atendido</option>
                                        <option value="5">En Box</option>
                                        <option value="4">En Sala</option>
                                        <option value="3">Cancelados</option>
                                        <option value="2">Confirmado</option>
                                        <option value="1">Recordatorio Enviado</option>
                                        <option value="0">Agendado</option>
                                    </select>
                                </li>
                                <li class="nav-item">
                                    <a class="booking-info-duration nav-link active" id="booking-info-duration-pill-today" data-toggle="pill" href="#pills-today" role="tab" aria-selected="true">{{translate('Today')}}</a>
                                    <input type="radio" id="booking-info-duration-radio-today" checked name="booking-info-duration-radio" value="1" />
                                </li>
                                <li class="nav-item">
                                    <a class="booking-info-duration nav-link" id="booking-info-duration-pill-month" data-toggle="pill" href="#pills-month" role="tab" aria-selected="false">{{translate('Month')}}</a>
                                    <input type="radio" id="booking-info-duration-radio-monthly" name="booking-info-duration-radio" value="2" />
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body scrollbar-outer" id="div-body-booking-info">
                    
                </div>
            </div>
        </div>

        {{-- <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">{{translate('Top Booking Service')}}</div>
                </div>
                <div class="card-body pb-0" id="div-body-top-booking-service">


                </div>
            </div>
        </div> --}}

    </div>



        <!-- Modal -->
<div class="modal fade bd-example-modal-lg"  id="cancelModal" tabindex="-1" role="dialog" aria-labelledby="cancelModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="cancelModalLabel">Registrar Consulta</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link " id="home-tab" data-toggle="tab" data-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Sala de Espera</button>
            </li>
            <li class="nav-item active" role="presentation">
              <button class="nav-link" id="profile-tab" data-toggle="tab" data-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Pre Anamnesis</button>
            </li>
            {{-- <li class="nav-item" role="presentation">
                <button class="nav-link" id="contact-tab" data-toggle="tab" data-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Anamnesis</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="contact-tab" data-toggle="tab" data-target="#prediag" type="button" role="tab" aria-controls="prediag" aria-selected="false">Pre Diagnostico</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="contact-tab" data-toggle="tab" data-target="#diag" type="button" role="tab" aria-controls="diag" aria-selected="false">Diagnostico</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="contact-tab" data-toggle="tab" data-target="#historial" type="button" role="tab" aria-controls="historial" aria-selected="false">Historial</button> --}}
              </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade " id="home" role="tabpanel" aria-labelledby="home-tab"><h3>Sala de espera</h3>
                {{-- <form class="form-horizontal" id="cancelForm" novalidate="novalidate" enctype="multipart/form-data" > --}}
                    <form class="form-horizontal" id="cancelForm" action="{{ route('customer.citaStore') }}" method="post">
                        @csrf
                <!-- Campo oculto para el ID del servicio -->
                {{ csrf_field() }}
                <input type="hidden" id="serviceId" name="serviceId" value="">
                <input type="hidden" id="cmn_pet_id" name="cmn_pet_id" value="">
                <input type="hidden" id="id" name="id" value="">
                <input type="hidden" id="tiene" name="tiene" value="">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
    
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group control-group form-inline controls">
                            <label>{{translate('Peso')}}</label>
                            <input type="text" id="peso" name="peso" class="form-control input-full"  />
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group control-group form-inline controls">
                            <label>{{translate('¿Vive con otros animales?')}}</label>
                            <input type="text" id="vive_otros" name="vive_otros" class="form-control input-full" />
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group control-group form-inline controls">
                            <label>{{translate('Si es si ¿cuántos y de qué tipo?')}}</label>
                            <input type="text" id="vive_otrosn" name="vive_otrosn" class="form-control input-full" />
                            <span class="help-block"></span>
                        </div>
                    </div>
                </div>
    
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group control-group form-inline controls">
                            <label>{{translate('¿qué tipo de alimentación tiene?')}}</label>
                            
                            <select class="form-control" id="tipo_alim" name="tipo_alim">
                                <option value="Pellet (croquetas)">Pellet (croquetas)</option>
                                <option value="Alimento húmedo (sobres, latas)">Alimento húmedo (sobres, latas)</option>
                                <option value="Comida casera">Comida casera</option>
                                <option value="Dieta BARF">Dieta BARF</option>
                                <option value="Pellet + comida casera">Pellet + comida casera</option>
                                <option value="Pellet + alimento húmedo">Pellet + alimento húmedo</option>
                              </select>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group control-group form-inline controls">
                            <label>{{translate('¿de qué marca es el alimento?')}}</label>
                            <input type="text" id="tipo_alim_marca" name="tipo_alim_marca" class="form-control input-full" />
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group control-group form-inline controls">
                            <label>{{translate('Deposisiones ')}}</label> <a  type="text"
                            data-toggle="modal" data-target="#exampleModal">
                              Ver ejemplo
                        </a>
                            {{-- <input type="text" id="depo" name="depo" class="form-control input-full" /> --}}
                            <select class="form-control" id="depo" name="depo">
                                <option value="Tipo 1">Tipo 1</option>
                                <option value="Tipo 2">Tipo 2</option>
                                <option value="Tipo 3">Tipo 3</option>
                                <option value="Tipo 4">Tipo 4</option>
                                <option value="Tipo 5">Tipo 5</option>
                                <option value="Tipo 6">Tipo 6</option>
                                <option value="Tipo 7">Tipo 7</option>
                              </select>
                            <span class="help-block"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                 <h3> Pre-Anamnesis</h3>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group control-group form-inline controls">
                            <label>{{translate('Temperatura')}}</label>
                            <input type="text" id="temperatura" name="temperatura" class="form-control input-full" />
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group control-group form-inline controls">
                            <label>{{translate('Ganglios Retrofaringeos')}}</label>
                            <input type="text" id="ganglios_r" name="ganglios_r" class="form-control input-full" />
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group control-group form-inline controls">
                            <label>{{translate('Ganglios Propliteos')}}</label>
                            <input type="text" id="ganglios_p" name="ganglios_p" class="form-control input-full" />
                            <span class="help-block"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group control-group form-inline controls">
                            <label>{{translate('Fonendo')}}</label>
                            <input type="text" id="fonendo" name="fonendo" class="form-control input-full" />
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group control-group form-inline controls">
                            <label>{{translate('Palpitacion abdominal')}}</label>
                            <input type="text" id="palpitacion_abd" name="palpitacion_abd" class="form-control input-full" />
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group control-group form-inline controls">
                            <label>{{translate('Piel y anejos')}}</label>
                            <input type="text" id="piel" name="piel" class="form-control input-full" />
                            <span class="help-block"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group control-group form-inline controls">
                            <label>{{translate('peso_2?')}}</label>
                            <input type="text" id="peso_2" name="peso_2" class="form-control input-full" />
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group control-group form-inline controls">
                            <label>{{translate('Obeso')}}</label>
                            <input type="text" id="obeso" name="obeso" class="form-control input-full" />
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group control-group form-inline controls">
                            <label>{{translate('imagenes ?')}}</label>
                            <input type="text" id="imagenes" name="imagenes" class="form-control input-full" />
                            <span class="help-block"></span>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">     
                    <h3> Anamnesis</h3>

                    <div class="row">
                            <div class="col-md-6">
                                <div class="form-group control-group form-inline controls">
                                    <label>{{translate('Desicion Tratamiento')}}</label>
                                    {{-- <input type="text" id="country" name="country" class="form-control input-full" /> --}}
                                    {{-- <textarea class="form-control" id="reason1" name="reason1" rows="8"></textarea> --
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        
                    </div>
            </div>
            <div class="tab-pane fade" id="prediag" role="tabpanel" aria-labelledby="prediag-tab"> 
                <h3> Pre-Diagnostico</h3>    
                        <div class="form-group">
                            <label for="reason2">Observaciones:</label>
                            {{-- <textarea class="form-control" id="reason2" name="reason2" rows="8"></textarea> --
                        </div> 
            </div>
            <div class="tab-pane fade" id="diag" role="tabpanel" aria-labelledby="diag-tab">     
                <h3> Diagnostico</h3>

                <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="reason">Observaciones:</label>
                                <textarea class="form-control" id="obs" name="obs" rows="8"></textarea>
                            </div> 
                        </div>
                    
                </div>
            </div> --}}

            <div class="tab-pane fade" id="historial" role="tabpanel" aria-labelledby="historial-tab">     
                <h3> Historial</h3>

                <div class="row">
                        <div class="col-md-12">
                            <table class="table table-dark">
                                <thead>
                                  <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">First</th>
                                    <th scope="col">Last</th>
                                    <th scope="col">Handle</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">2</th>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td>@fat</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">3</th>
                                    <td>Larry</td>
                                    <td>the Bird</td>
                                    <td>@twitter</td>
                                  </tr>
                                </tbody>
                              </table>  
                        </div>
                    
                </div>
            </div>




          </div>



            
            
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">{{translate('Close')}}</button>
                <button type="submit" class="btn btn-success btn-sm">{{translate('Save Change')}}</button>
        </div>
            <!-- Agrega aquí más campos si es necesario -->
          </form>
        </div>

      </div>
    </div>
  </div>
  

</div>



@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<!--Bootstrap modal -->
<div class="modal fade " id="exampleModal" tabindex="-1"
role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <!-- Modal heading -->
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
                Tipo de depociciones
            </h5>
            <button type="button" class="close"
                data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">
                    ×
                </span>
            </button>
        </div>
        <!-- Modal body with image -->
        <div class="modal-body">
            {{-- <img src="{{ asset('/images/brsitol.jpg') }}" alt="" title=""> --}}
            <img src="{{ asset('img/bristol.jpg') }}"  width="450" height="540" alt="Tipo de deposiciones">
        </div>
    </div>
</div>
</div>


<!-- Chart JS -->
<script src="{{ dsAsset('js/lib/assets/js/plugin/chart.js/chart.min.js') }}"></script>

<!-- jQuery Sparkline -->
<script src="{{ dsAsset('js/lib/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

<!-- Chart Circle -->
<script src="{{ dsAsset('js/lib/assets/js/plugin/chart-circle/circles.min.js') }}"></script>
<!-- jQuery Vector Maps -->
<script src="{{ dsAsset('js/lib/assets/js/plugin/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ dsAsset('js/lib/assets/js/plugin/jqvmap/maps/jquery.vmap.world.js') }}"></script>

<!-- dashboard JS -->
<script src="{{ dsAsset('js/custom/dashboard/main-dashboard_cn.js')}}"></script>


@endsection