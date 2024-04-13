@extends('layouts.app')
@section('content')
<script src="{{ dsAsset('js/lib/country-list.js') }}"></script>
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="viewport" content="width=device-width, initial-scale=1">



<div class="page-inner">
    <style>
   

/*timeline4*/


/******************* Timeline Demo - 8 *****************/

.main-timeline4 {
    overflow: hidden;
    position: relative
}

.main-timeline4:after,
.main-timeline4:before {
    content: "";
    display: block;
    width: 100%;
    clear: both
}

.main-timeline4:before {
    content: "";
    width: 3px;
    height: 100%;
    background: #d6d5d5;
    position: absolute;
    top: 30px;
    left: 50%
}

.main-timeline4 .timeline {
    width: 50%;
    float: left;
    padding-right: 30px;
    position: relative
}

.main-timeline4 .timeline-icon {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: #fff;
    border: 3px solid #fe6847;
    position: absolute;
    top: 5.5%;
    right: -17.5px
}

.main-timeline4 .year {
    display: block;
    padding: 10px;
    margin: 0;
    font-size: 30px;
    color: #fff;
    border-radius: 0 50px 50px 0;
    background: #fe6847;
    text-align: center;
    position: relative
}

.main-timeline4 .year:before {
    content: "";
    border-top: 35px solid #f59c8b;
    border-left: 35px solid transparent;
    position: absolute;
    bottom: -35px;
    left: 0
}

.main-timeline4 .timeline-content {
    padding: 30px 20px;
    margin: 0 45px 0 35px;
    background: #f2f2f2
}

.main-timeline4 .title {
    font-size: 19px;
    font-weight: 700;
    color: #504f54;
    margin: 0 0 10px
}

.main-timeline4 .description {
    font-size: 14px;
    color: #7d7b7b;
    margin: 0
}

.main-timeline4 .timeline:nth-child(2n) {
    padding: 0 0 0 30px
}

.main-timeline4 .timeline:nth-child(2n) .timeline-icon {
    right: auto;
    left: -14.5px
}

.main-timeline4 .timeline:nth-child(2n) .year {
    border-radius: 50px 0 0 50px;
    background: #7eda99
}

.main-timeline4 .timeline:nth-child(2n) .year:before {
    border-left: none;
    border-right: 35px solid transparent;
    left: auto;
    right: 0
}

.main-timeline4 .timeline:nth-child(2n) .timeline-content {
    text-align: right;
    margin: 0 35px 0 45px
}

.main-timeline4 .timeline:nth-child(2) {
    margin-top: 170px
}

.main-timeline4 .timeline:nth-child(odd) {
    margin: -175px 0 0
}

.main-timeline4 .timeline:nth-child(even) {
    margin-bottom: 80px
}

.main-timeline4 .timeline:first-child,
.main-timeline4 .timeline:last-child:nth-child(even) {
    margin: 0
}

.main-timeline4 .timeline:nth-child(2n) .timeline-icon {
    border-color: #7eda99
}

.main-timeline4 .timeline:nth-child(2n) .year:before {
    border-top-color: #92efad
}

.main-timeline4 .timeline:nth-child(3n) .timeline-icon {
    border-color: #8a5ec1
}

.main-timeline4 .timeline:nth-child(3n) .year {
    background: #8a5ec1
}

.main-timeline4 .timeline:nth-child(3n) .year:before {
    border-top-color: #a381cf
}

.main-timeline4 .timeline:nth-child(4n) .timeline-icon {
    border-color: #f98d9c
}

.main-timeline4 .timeline:nth-child(4n) .year {
    background: #f98d9c
}

.main-timeline4 .timeline:nth-child(4n) .year:before {
    border-top-color: #f2aab3
}

@media only screen and (max-width:767px) {
    .main-timeline4 {
        overflow: visible
    }
    .main-timeline4:before {
        /* top: 0; */
        left: 0
    }
    .main-timeline4 .timeline:nth-child(2),
    .main-timeline4 .timeline:nth-child(even),
    .main-timeline4 .timeline:nth-child(odd) {
        margin: 0
    }
    .main-timeline4 .timeline {
        width: 100%;
        float: none;
        padding: 0 0 0 30px;
        margin-bottom: 20px!important
    }
    .main-timeline4 .timeline:last-child {
        margin: 0!important
    }
    .main-timeline4 .timeline-icon {
        right: auto;
        left: -14.5px
    }
    .main-timeline4 .year {
        border-radius: 50px 0 0 50px
    }
    .main-timeline4 .year:before {
        border-left: none;
        border-right: 35px solid transparent;
        left: auto;
        right: 0
    }
    .main-timeline4 .timeline-content {
        margin: 0 35px 0 45px
    }
}
/* custom-styles.css */
.modal-content {
/* From https://css.glass */
background: rgba(224, 232, 224, 0.43);
border-radius: 16px;
box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
backdrop-filter: blur(6.2px);
-webkit-backdrop-filter: blur(6.2px);
}



/*end timeline*/           

        </style>
<div class="row">
        <div class="col-md-12">
            <div class="main-card card">
                <div class="card-header">
                    <div class="container">

                        <div class="row gx-1 ">
                                
                            <div class="col-lg-6 col-md-6">
                                <div class="d-flex align-items-center">
                        
                                    {{-- <h4 class="card-title">
                                        {{translate('Detalle de mascota')}}
                                    </h4> --}}
                                   <br>
                                   <div class="card mb-3" style="max-width: 540px;">
                                    <div class="row no-gutters">
                                      <div class="col-md-4 d-flex justify-content-center align-items-center">
                                        <!-- Asegúrate de reemplazar '...' con la ruta de tu imagen -->
                                        
                                        @if ($pets->imagen_pet)
                                        <img src="{{ asset($pets->imagen_pet) }}" alt="dogo" class="img-fluid rounded-circle" style="object-fit: cover; width: 100%; max-width: 100px; height: 100px;">
                                    @else
                                        <!-- Si no hay imagen disponible, puedes mostrar una imagen por defecto o dejar en blanco -->
                                        <img src="https://storage.googleapis.com/pai-images/89d92e216f74489eb1b656fc3a395d89.jpeg" alt="dogo" class="img-fluid rounded-circle" style="object-fit: cover; width: 100%; max-width: 100px; height: 100px;">
                                    @endif
                                   
                                        
                                        
                                    </div>
                                      <div class="col-md-8">
                                        <div class="card-body">
                                          <h5 class="card-title">{{$pets->nombre}} @if($pets->estado_pet)
                                            ({{$pets->estado_pet}})
                                        @endif</h5>
                                          <p class="card-text">{{$pets->especie}}, {{$pets->sexo}}, {{$pets->raza}}</p>
                                          <p class="card-text"><small class="text-muted">
                                            @php
                                            use Carbon\Carbon;
                                            
                                            // Suponiendo que $pet_birth_date es la fecha de nacimiento de la mascota
                                            // y ya es una instancia de Carbon. Si no lo es, primero conviértelo:
                                            // $pet_birth_date = Carbon::parse($tuVariableConLaFecha);
                                            
                                            $now = Carbon::now();
                                            $years = $now->diffInYears($pets->pet_birth_date);
                                            $months = $now->copy()->subYears($years)->diffInMonths($pets->pet_birth_date);
                                            @endphp
                                            
                                            <div>
                                                <p>Edad de la mascota: {{ $years }} años y {{ $months }} meses.</p>
                                            </div>
                                            </small></p>
                                            <form id="formulario-imagen" action="{{ route('actualizar_imagen', ['id' => $id]) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <label for="input-imagen" class="boton-cambiar">
                                                    <span><i class="fas fa-edit"></i>Cambiar Imagen</span>
                                                    <input type="file" id="input-imagen" name="imagen" onchange="enviarFormulario()" hidden>
                                                </label>
                                                <div id="mensaje-carga" style="display: none;">
                                                    <i class="fas fa-spinner fa-spin"></i> Cargando imagen...
                                                </div>
                                            </form>
                                        </div>
                                        
                               
                                        
                                      </div>
                                      
                                    </div>
                                  </div>
                                  
                                    {{-- <button id="btnAdd" class="btn btn-primary btn-sm btn-round ml-auto">
                                        <i class="fa fa-plus"></i> {{translate('Add New Customer')}}
                                    </button> --}}
                                </div>
                            </div>
                            @if (auth()->user()->user_type==2)
                            <div class="col-lg-6 col-md-6 font-weight-bold">
                                <a href="{{ route('site.client.pets.listing') }}"> <button type="button" class="btn btn-info">Volver</button></a>
                            </div>
                            @else

                            <div class="col-lg-6 col-md-6 font-weight-bold">
                                <div class="btn-group ">
                                    <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Nuevo+
                                    </button>
                                <div class="dropdown-menu">
                                <a class="dropdown-item" href="#" onclick="openCancelModal()"><i class="fas fa-heartbeat"></i> Consulta</a>
                                <a class="dropdown-item" href="#" onclick="openInmu()"><i class="fas fa-shield-alt"></i> Inmunizacion</a>
                                <a class="dropdown-item" href="#" onclick="openDespa()"><i class="fas fa-bug"></i> Desparacitaciones</a>
                                <a class="dropdown-item" href="#" onclick="openCirugia()"><i class="fas fa-stethoscope"></i> Cirugia</a>
                                <a class="dropdown-item" href="#" onclick="openPeluqueria()"><i class="fas fa-cut"></i> Peluqueria</a>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#nuevofile"><i class="fas fa-save"></i> Archivo</a>

                            </div>
                                                        <!-- Botón para cambiar el estado con advertencia -->
                                                                <form id="form-cambiar-estado" method="POST" action="{{ route('cambiar_estado_ultima_cita', ['idMascota' => $id]) }}">
                                                                    @csrf
                                                                    <button type="button" class="btn btn-danger" onclick="confirmarCambioEstado()">Cambiar Estado</button>
                                                                </form>
                                                <a href="{{ route('home') }}"> <button type="button" class="btn btn-info">Volver</button></a>
                        </div>
                            </div>
                            

                        
                            </div>
                                
                            @endif


                </div>


            </div>
                
                <div class="card-body">

                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">General</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Antecedentes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">Historial</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-4" role="tab">Archivos</a>
                        </li>
                    </ul><!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                          
                                           <a href="#" onclick="opencli('{{$id}}')"> <i class="fas fa-edit"></i></a>

        
                                       
                                <div class="container">
                                    <div class="row gx-1 ">
                                
                                    <div class="col-lg-2 col-6 col-sm-6">
                                            Nombre
                                    </div>
                                
                                    <div class="col-lg-2 col-6 col-sm-6 font-weight-bold">
                                            {{$pets->nombre}}
                                    </div>
                                
                                    <div class="col-lg-2 col-6 col-sm-6 ">
                                            Especie
                                    </div>

                                    <div class="col-lg-2 col-6 col-sm-6 font-weight-bold">
                                        {{$pets->especie}}
                                    </div>
                                
                                    <div class="col-lg-2 col-6 col-sm-6">
                                            Raza
                                    </div>
                                
                                    <div class="col-lg-2 col-6 col-sm-6 font-weight-bold">
                                        {{$pets->raza}}
                                    </div>
                                
                                    </div>

                                </div>
                                <div class="container">
                                    <div class="row gx-1 ">
                                
                                    <div class="col-lg-2 col-6 col-sm-6">
                                            Sexo
                                    </div>
                                
                                    <div class="col-lg-2 col-6 col-sm-6 font-weight-bold">
                                            {{$pets->sexo}}
                                    </div>
                                
                                    <div class="col-lg-2 col-6 col-sm-6 ">
                                            Fecha Nac
                                    </div>
                                
                                    <div class="col-lg-2 col-6 col-sm-6 font-weight-bold">
                                            {{$pets->pet_birth_date}}
                                    </div>
                                
                                    <div class="col-lg-2 col-6 col-sm-6">
                                            Tamaño
                                    </div>
                                
                                    <div class="col-lg-2 col-6 col-sm-6 font-weight-bold">
                                            {{$pets->color}}
                                    </div>
                                
                                    </div>
                                </div>
                                <div class="container">
                                    <div class="row gx-1 ">
                                
                                    <div class="col-lg-3 col-md-6">
                                            Microchip
                                    </div>
                                
                                    <div class="col-lg-3 col-md-6 font-weight-bold">
                                            {{$pets->micro_num}}
                                    </div>
                                
                                    <div class="col-lg-3 col-6 col-md-6 ">
                                            Estado Repro
                                    </div>
                                
                                    <div class="col-lg-3 col-6 col-md-6 font-weight-bold">
                                            {{$pets->estado_repro}}
                                            
                                    </div>
                                
                                
                                    </div>
                                </div>

                                <hr>
                                <h3>Tutor</h3>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-2 col-6 col-sm-6">Nombre</div>
                                        <div class="col-lg-3 col-6 col-sm-6 font-weight-bold">{{$pets->owner->full_name}}</div>
                                        
                                        <div class="col-lg-1 col-6 col-sm-6">Run</div>
                                        <div class="col-lg-2 col-6 col-sm-6 font-weight-bold">{{$pets->owner->run}}</div>
                                        
                                        <div class="col-lg-1 col-6 col-sm-6">Email</div>
                                        <div class="col-lg-3 col-6 col-sm-6 font-weight-bold">{{$pets->owner->email}}</div>
                                    </div>
                                </div>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-2 col-6 col-sm-6">Direccion</div>
                                        <div class="col-lg-3 col-6 col-sm-6 font-weight-bold">{{$pets->owner->direccion}}</div>
                                        
                                        <div class="col-lg-1 col-6 col-sm-6">Celular</div>
                                        <div class="col-lg-2 col-6 col-sm-6 font-weight-bold">{{$pets->owner->phone_no}}</div>
                                        
                                        <div class="col-lg-1 col-6 col-sm-6">Ciudad</div>
                                        <div class="col-lg-3 col-6 col-sm-6 font-weight-bold">{{$pets->owner->city}}</div>
                                    </div>
                                </div>

                        </div>
                        <div class="tab-pane" id="tabs-2" role="tabpanel">
                            <a href="#" onclick="openante('{{$id}}')"> <i class="fas fa-edit"></i></a>


                            <div class="container" >
                                <div class="row gx-1 ">
                            
                                <div class="col-lg-3 col-6 col-md-6">
                                        Origen
                                </div>
                            
                                <div class="col-lg-3 col-6 col-md-6 font-weight-bold">
                                        {{$ant->origen}}
                                </div>
                            
                                <div class="col-lg-3 col-6 col-md-6 ">
                                        Habitat
                                </div>

                                <div class="col-lg-3 col-6 col-md-6 font-weight-bold">
                                    {{$ant->habitat}}
                                </div>
                            
                                <br>
                            
                                </div>
                            </div>

                            <div class="container">
                                <div class="row gx-1 ">
                            
                                <div class="col-lg-3 col-6 col-md-6">
                                        Comportamiento
                                </div>
                            
                                <div class="col-lg-3 col-6 col-md-6 font-weight-bold">
                                    {{$ant->comportamiento}}
                                </div>
                            
                                <div class="col-lg-3 col-6  col-md-6 ">
                                        Enfermedades
                                </div>

                                <div class="col-lg-3 col-6 col-md-6 font-weight-bold">
                                    {{$ant->enfermedades}}
                                </div>

                            
                                </div>
                            </div>
                                    <br>
                            
                            <div class="container">
                                <div class="row gx-1 ">
                            
                                <div class="col-lg-3 col-6 col-md-6">
                                        Alergias
                                </div>
                            
                                <div class="col-lg-3 col-6 col-md-6 font-weight-bold">
                                    {{$ant->alergias}}
                                </div>
                            
                                <div class="col-lg-3 col-6 col-md-6 ">
                                        Notas
                                </div>

                                <div class="col-lg-3 col-6  col-md-6 font-weight-bold">
                                    {{$ant->notas_ante}}
                                </div>

                            
                                </div>
                            </div>
                            <br>
                            <div class="container">
                                <div class="row gx-1 ">
                            
                                <div class="col-lg-3 col-6 col-md-6">
                                        Esterilizado 
                                </div>
                            
                                <div class="col-lg-3 col-6 col-md-6 font-weight-bold">
                                    {{-- {{$ant->esteril}} --}}
                                    {{-- <input type="checkbox"  data-toggle="toggle" data-size="sm"> --}}
                                    <input type="checkbox" id="esterilCheckbox" data-toggle="toggle" data-size="sm" 
                                    data-id-pet="{{$ant->id_pet}}" {{ $ant->esteril == 'Si' ? 'checked' : '' }}>
                                </div>
                            
                                <div class="col-lg-3 col-6 col-md-6 ">
                                        Desparasitado 
                                </div>

                                <div class="col-lg-3 col-6  col-md-6 font-weight-bold">
                                    {{-- {{$ant->despara}} --}}
                                    {{-- <input type="checkbox" checked data-toggle="toggle" data-size="sm"> --}}
                                    <input type="checkbox" id="desparaCheckbox" data-toggle="toggle" data-size="sm" 
                                    data-id-pet="{{$ant->id_pet}}" {{ $ant->despara == 'Si' ? 'checked' : '' }}>

                                </div>

                            
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane" id="tabs-3" role="tabpanel">
                            <p>Historial</p>

                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="main-timeline4">
                                            @foreach ($eventos as $evento)
                                            <div class="timeline">
                                                <span class="timeline-icon">   
                                                       </span>
                                                <span class="year">{{ \Carbon\Carbon::parse($evento->created_at)->format('M-d') }}
                                                    </span>
                                                <div class="timeline-content">
                                                    <h3 class="title">
                                                    @switch($evento->tipo_evento)
                                                        @case('Consulta')
                                                            <i class="fas fa-heartbeat"></i>
                                                            @php $main = $evento->conid; $tipoe = 'openCancelModal'; @endphp
                                                            @break
                                            
                                                        @case('Inmunización')
                                                            <i class="fas fa-shield-alt"></i>
                                                            @php $main = $evento->conid; $tipoe = 'openInmu'; @endphp
                                                            @break
                                            
                                                        @case('Desparasitación')
                                                            <i class="fas fa-bug"></i>
                                                            @php $main = $evento->conid; $tipoe = 'openDespa'; @endphp
                                                            @break
                                            
                                                        @case('Cirugía')
                                                            <i class="fas fa-stethoscope"></i>
                                                            @php $main = $evento->conid; $tipoe = 'openCirugia'; @endphp
                                                            @break
                                            
                                                        @case('Peluqueria')
                                                            <i class="fas fa-cut"></i>
                                                            @php $main = $evento->conid; $tipoe = 'openPeluqueria'; @endphp
                                                            @break
                                            
                                                        @default
                                                            <i class="fas fa-question-circle"></i>
                                                    @endswitch {{ $evento->tipo_evento }} </h3>
                                                    <p class="description">
                                                        {{ $evento->razon }}
                                                    </p>
                                                    <p>Fecha: {{ $evento->created_at }}</p>
                                                    <a href="#" onclick="{{$tipoe}}('{{$main}}')">Abrir detalle</a>
                                                </div>
                                            </div>
                                            @endforeach
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane" id="tabs-4" role="tabpanel">
                            <p>Archivos</p>

                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="main-timeline4">
                                            <form id="uploadForm1" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" id="id_mascot_id" name="id_mascot_id" value="{{$id}}">
                                                <input type="file" name="file" id="file">
                                                <input type="text" name="concepto" id="concepto" placeholder="Concepto(ej; rayos)">
                                                <button type="submit">Subir Archivo</button>
                                                
                                            </form>
                                            <div id="uploadedFiles"></div>
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Tipo</th>
                                                        <th>Nombre del Archivo</th>
                                                        <th>Concepto</th>
                                                        <th>Fecha de Carga</th>
                                                        <!-- Agrega más columnas si lo necesitas -->
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($files as $file)
                                                        <tr>
                                                            <td>
                                                                @php
                                                                    // Obtener la extensión del archivo
                                                                    $extension = pathinfo($file->url, PATHINFO_EXTENSION);
                                                                    // Definir el icono de Font Awesome basado en la extensión del archivo
                                                                    switch ($extension) {
                                                                        case 'jpg':
                                                                        case 'jpeg':
                                                                        case 'png':
                                                                        case 'gif':
                                                                            $icon = 'fas fa-image'; // Icono para imágenes
                                                                            break;
                                                                        case 'txt':
                                                                            $icon = 'fas fa-file-alt'; // Icono para archivos de texto
                                                                            break;
                                                                        case 'pdf':
                                                                            $icon = 'fas fa-file-pdf'; // Icono para archivos PDF
                                                                            break;
                                                                        default:
                                                                            $icon = 'fas fa-file'; // Icono por defecto para otros tipos de archivo
                                                                    }
                                                                @endphp
                                                                <i class="{{ $icon }}"></i>
                                                            </td>
                                                            <td><a href="{{ url($file->url) }}" target="_blank">{{ basename($file->url) }}</a>
                                                            </td> <!-- Puedes mostrar el nombre del archivo o algún otro detalle -->
                                                            <td>{{ $file->concepto }}</td>
                                                            <td>{{ $file->created_at }}</td> <!-- Muestra la fecha de carga u otra información relevante -->
                                                            <!-- Agrega más celdas si lo necesitas -->
                                                        </tr>
                                                    @endforeach
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
        </div>
    
    
</div>





    <!-- Modal para Inmunización -->
    <div class="modal fade bd-example-modal-lg" id="inmuModal" tabindex="-1" role="dialog" aria-labelledby="modalInmunizacionLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <h1>Inmunizacion</h1>
            <div class="modal-header">
                <h5 class="modal-title" id="cancelModalLabel">Inmunizacion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="inmuForm" action="{{ route('customer.inmuStore') }}" method="post">
                    @csrf
                <!-- Campo oculto para el ID del servicio -->
                {{ csrf_field() }}
                <input type="hidden" id="serviceIdinmu" name="serviceIdinmu" value="">
                <input type="hidden" id="cmn_pet_idinmu" name="cmn_pet_idinmu" value="{{$id}}">
                <input type="hidden" id="idinmu" name="idinmu" value="">
                <input type="hidden" id="tieneinmu" name="tieneinmu" value="">
                <input type="hidden" name="_tokeninmu" value="{{ csrf_token() }}">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group control-group form-inline controls">
                            <label>{{translate('Nombre Vacuna')}}</label>
                            <input type="text" id="nombre_vacuna" name="nombre_vacuna" class="form-control input-full" required />
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group control-group form-inline controls">
                            <label>{{translate('N° Serie')}}</label>
                            <input type="text" id="n_serie" name="n_serie" class="form-control input-full" />
                            <span class="help-block"></span>
                        </div>
                    </div>

                </div>
                <h3>Periodo de protección</h3>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group control-group form-inline controls">
                            <label>{{translate('Cantidad')}}</label>
                            <input type="number" id="inmu_cant" name="inmu_cant" class="form-control input-full" required />
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inmu_unidad">{{translate('Unidad')}}</label>
                            <select id="inmu_unidad" name="inmu_unidad" class="form-control mt-0">
                                <option value="Semana">Semanas</option>
                                <option value="Meses">Meses</option>
                                <option value="Anos">Años</option>
                            </select>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    

                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="anam">Notas:</label>
                            <textarea class="form-control" id="notas_inmu" name="notas_inmu" rows="8"></textarea>
                        </div> 
                    </div>

                </div>


            </div>
                <div class="modal-footer">

                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">{{translate('Cerrar')}}</button>
                <button type="submit" class="btn btn-success btn-sm">{{translate('Guardar')}}</button>
            </div>
            <!-- Agrega aquí más campos si es necesario -->
        </form>
        </div>
        </div>
    </div>
    
    <!-- Final Modal para Inmunización... -->

    
    <!-- Modal para Desparazitacion -->
    <div class="modal fade bd-example-modal-lg" id="despaModal" tabindex="-1" role="dialog" aria-labelledby="modalInmunizacionLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <h1>Desparacitaciones</h1>
            <div class="modal-header">
                {{-- <h5 class="modal-title" id="Desparacitaciones">Inmunizacion</h5> --}}
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="despaForm" action="{{ route('customer.despastore') }}" method="post">
                    @csrf
                <!-- Campo oculto para el ID del servicio -->
                {{ csrf_field() }}
                <input type="hidden" id="serviceIddespa" name="serviceIddespa" value="">
                <input type="hidden" id="cmn_pet_iddespa" name="cmn_pet_iddespa" value="{{$id}}">
                <input type="hidden" id="iddespa" name="iddespa" value="">
                <input type="hidden" id="tienedespa" name="tienedespa" value="">
                <input type="hidden" name="_tokendespa" value="{{ csrf_token() }}">

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group control-group form-inline controls">
                            <label>{{translate('Nombre del desparasitante')}}</label>
                            <input type="text" id="nombre_despa" name="nombre_despa" class="form-control input-full" required />
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group control-group form-inline controls">
                            <label>{{translate('Dosis')}}</label>
                            <input type="text" id="dosis" name="dosis" class="form-control input-full" required />
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group control-group form-inline controls">
                            <label>{{translate('Presentacion')}}</label>
                            <input type="text" id="presentacion" name="presentacion" class="form-control input-full" />
                            <span class="help-block"></span>
                        </div>
                    </div>

                </div>
                <h3>Periodo de protección</h3>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group control-group form-inline controls">
                            <label>{{translate('Cantidad')}}</label>
                            <input type="number" id="despa_cant" name="despa_cant" class="form-control input-full" required />
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="despa_unidad">{{translate('Unidad')}}</label>
                            <select id="despa_unidad" name="despa_unidad" class="form-control mt-0">
                                <option value="Semana">Semanas</option>
                                <option value="Meses">Meses</option>
                                <option value="Anos">Años</option>
                            </select>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    

                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="anam">Notas:</label>
                            <textarea class="form-control" id="notas_despa" name="notas_despa" rows="8"></textarea>
                        </div> 
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="anti_in" name="anti_in" value="1" >
                                <label class="custom-control-label" for="anti_in">Antiparasitario interno</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="anti_ex" name="anti_ex" value="1">
                                <label class="custom-control-label" for="anti_ex">Antiparasitario externo</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="anti_recorda" name="anti_recorda"value="1">
                                <label class="custom-control-label" for="anti_recorda">Establecer un recordatorio para cuando se deba aplicar nuevamente la desparasitación</label>
                            </div>
                        </div> 
                    </div>

                </div>


            </div>
                <div class="modal-footer">

                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">{{translate('Cerrar')}}</button>
                <button type="submit" class="btn btn-success btn-sm">{{translate('Guardar')}}</button>
            </div>
            <!-- Agrega aquí más campos si es necesario -->
        </form>
        </div>
        </div>
    </div>

    <!-- Modal para Cirugia -->
    <div class="modal fade bd-example-modal-lg" id="cirugiaModal" tabindex="-1" role="dialog" aria-labelledby="modalInmunizacionLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <h1>Cirugia</h1>
            <div class="modal-header">
                {{-- <h5 class="modal-title" id="cirugiaracitaciones">Inmunizacion</h5> --}}
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="cirugiaForm" action="{{ route('customer.cirugiaStore') }}" method="post">
                    @csrf
                <!-- Campo oculto para el ID del servicio -->
                {{ csrf_field() }}
                <input type="hidden" id="serviceIdcirugia" name="serviceIdcirugia" value="">
                <input type="hidden" id="cmn_pet_idcirugia" name="cmn_pet_idcirugia" value="{{$id}}">
                <input type="hidden" id="idcirugia" name="idcirugia" value="">
                <input type="hidden" id="tienecirugia" name="tienecirugia" value="">
                <input type="hidden" name="_tokencirugia" value="{{ csrf_token() }}">

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group control-group controls">
                            <label>{{translate('Nombre del Cirugia')}}</label>
                            {{-- <input type="text" id="nombre_cirugia" name="nombre_cirugia" class="form-control input-full" required /> --}}
                            <span class="help-block"></span>
                            <select name="nombre_cirugia" id="nombre_cirugia" class="form-control">
                                <option value="">Seleccione una cirugia</option>
                    
                                @foreach($examenes as $categoria)
                                <option value="{{ $categoria->nombre_examen_list }}">{{ $categoria->nombre_examen_list }}</option>
                            @endforeach
                                
                            </select>
                            
                        </div>
                    </div>


                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="anam">Evaluacion Anestésica</label>
                            <textarea class="form-control" id="eval_anestesica" name="eval_anestesica" rows="4"></textarea>
                        </div> 
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="anam">Evaluacion ASA</label>
                            <textarea class="form-control" id="eval_asa" name="eval_asa" rows="2"></textarea>
                        </div> 
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="anam">Notas:</label>
                            <textarea class="form-control" id="notas_cirugia" name="notas_cirugia" rows="4"></textarea>
                        </div> 
                    </div>

                </div>



            </div>
                <div class="modal-footer">

                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">{{translate('Cerrar')}}</button>
                <button type="submit" class="btn btn-success btn-sm">{{translate('Guardar')}}</button>
            </div>
            <!-- Agrega aquí más campos si es necesario -->
        </form>
        </div>
        </div>
    </div>

    <!-- Modal para Peluqueria -->
    <div class="modal fade bd-example-modal-lg" id="peluModal" tabindex="-1" role="dialog" aria-labelledby="modalInmunizacionLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <h1> Peluqueria</h1>
            <div class="modal-header">
                {{-- <h5 class="modal-title" id="peluracitaciones">Inmunizacion</h5> --}}
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="peluForm" action="{{ route('customer.peluStore') }}" method="post">
                    @csrf
                <!-- Campo oculto para el ID del servicio -->
                {{ csrf_field() }}
                <input type="hidden" id="serviceIdpelu" name="serviceIdpelu" value="">
                <input type="hidden" id="cmn_pet_idpelu" name="cmn_pet_idpelu"  value="{{$id}}" >
                <input type="hidden" id="idpelu" name="idpelu" value="">
                <input type="hidden" id="tienepelu" name="tienepelu" value="">
                <input type="hidden" name="_tokenpelu" value="{{ csrf_token() }}">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group control-group controls">
                            <label>{{translate('Tipo de Corte')}}</label>
                            <select name="tipo_corte" id="tipo_corte" class="form-control">
                                <option value="">Seleccione un corte</option>
                                
                                    <option value="Corte de Raza">Corte de Raza</option>
                                    <option value="Corte de Cachorro">Corte de Cachorro</option>
                                    <option value="Rebaje">Rebaje</option>

                            </select>
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group control-group controls">
                            <label>{{translate('Tipo de baño')}}</label>
                            <select name="tipo_bano" id="tipo_bano" class="form-control">
                                <option value="">Seleccione una cirugia</option>
                                
                                    <option value="Baño medicado">Baño medicado</option>
                                    <option value="Baño belleza">Baño belleza</option>

                            </select>
                            
                        </div>
                    </div>



                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="notas_pelu">Notas:</label>
                            <textarea class="form-control" id="notas_pelu" name="notas_pelu" rows="4"></textarea>
                        </div> 
                    </div>

                </div>



            </div>
                <div class="modal-footer">

                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">{{translate('Cerrar')}}</button>
                <button type="submit" class="btn btn-success btn-sm">{{translate('Guardar')}}</button>
            </div>
            <!-- Agrega aquí más campos si es necesario -->
        </form>
        </div>
        </div>
    </div>

        <!-- Modal Consulta-->
        <div class="modal fade bd-example-modal-lg"  id="cancelModal" tabindex="-1" role="dialog" aria-labelledby="cancelModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cancelModalLabel">Registrar Consulta </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                <button class="nav-link" id="home-tab" data-toggle="tab" data-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Antecedentes</button>
                </li>
                                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-toggle="tab" data-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Examen Fisico</button>
                </li>
                {{-- <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-toggle="tab" data-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Pre Anamnesis</button>
                </li> --}}
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="consulta-tab" data-toggle="tab" data-target="#consulta" type="button" role="tab" aria-controls="consulta" aria-selected="false">Consulta</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" data-toggle="tab" data-target="#prediag" type="button" role="tab" aria-controls="prediag" aria-selected="false">Pre Diagnostico</button>
                </li>
                {{-- <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="contact-tab" data-toggle="tab" data-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Anamnesis</button>
                </li> --}}
                </li>


                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" data-toggle="tab" data-target="#exam" type="button" role="tab" aria-controls="exam" aria-selected="false">Examenes</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" data-toggle="tab" data-target="#diag" type="button" role="tab" aria-controls="diag" aria-selected="false">Diagnostico</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" data-toggle="tab" data-target="#trata" type="button" role="tab" aria-controls="trata" aria-selected="false">Tratamientos</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade " id="home" role="tabpanel" aria-labelledby="home-tab"><h3>Antecedentes</h3>
                    {{-- <form class="form-horizontal" id="cancelForm" novalidate="novalidate" enctype="multipart/form-data" > --}}
                        <form class="form-horizontal" id="cancelForm" action="{{ route('customer.citaStore') }}" method="post">
                            @csrf
                    <!-- Campo oculto para el ID del servicio -->
                    {{ csrf_field() }}
                    <input type="hidden" id="serviceIdconsu" name="serviceIdconsu" value="">
                    <input type="hidden" id="cmn_pet_idconsu" name="cmn_pet_idconsu" value="{{$id}}" >
                    <input type="hidden" id="id_consu" name="id_consu" value="">
                    <input type="hidden" id="tieneconsu" name="tieneconsu" value="">
                    <input type="hidden" name="_tokenconsu" value="{{ csrf_token() }}">

        
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
                <div class="tab-pane fade show active" id="consulta" role="tabpanel" aria-labelledby="consulta-tab">
                    <h3> Consulta</h3>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group control-group form-inline controls">
                                <label>Razón</label>
                                <input type="text" id="razon" name="razon" class="form-control input-full" />
                                <span class="help-block"></span>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group control-group form-inline controls">
                                <label>Anamnesis</label>
                                <textarea type="text" id="anamnesis" name="anamnesis" class="form-control input-full"  rows="8"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group control-group form-inline controls">
                                <label>Notas</label>
                                <input type="text" id="notas_anam" name="notas_anam" class="form-control input-full" />
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <h3> Examen Fisico</h3>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group control-group form-inline controls">
                                <label>{{translate('Peso')}}</label>
                                <input type="text" id="peso_2" name="peso_2" class="form-control input-full" />
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group control-group form-inline controls">
                                <label>{{translate('Temperatura')}}</label>
                                <input type="text" id="temperatura" name="temperatura" class="form-control input-full" />
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group control-group form-inline controls">
                                <label>{{translate('Mucosa')}}</label>
                                <input type="text" id="mucosa" name="mucosa" class="form-control input-full" />
                                <span class="help-block"></span>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group control-group form-inline controls">
                                <label>{{translate('Timepo de llenado capilar')}}</label>
                                <input type="text" id="tiempo_cap" name="ganglios_p" class="form-control input-full" />
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group control-group form-inline controls">
                                <label>{{translate('Frecuencia Respiratoria')}}</label>
                                <input type="text" id="frecuencia_resp" name="frecuencia_resp" class="form-control input-full" />
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group control-group form-inline controls">
                                <label>{{translate('Frecuencia Cardiaca')}}</label>
                                <input type="text" id="frecuencia_car" name="frecuencia_car" class="form-control input-full" />
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-2">
                            <div class="form-group control-group form-inline controls">
                                <label>{{translate('Presion')}}</label>
                                <input type="text" id="presion" name="presion" class="form-control input-full" />
                                <span class="help-block"></span>
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="form-group control-group form-inline controls">
                                <label>{{translate('Condicion corporal')}}</label>
                                <input type="text" id="condicion_corp" name="condicion_corp" class="form-control input-full" />
                                <span class="help-block"></span>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-group control-group form-inline controls">
                                <label>{{translate('Hidratacion')}}</label>
                                <input type="text" id="desidra" name="desidra" class="form-control input-full" />
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group control-group form-inline controls">
                                <label>{{translate('Nivel DesHidratacion')}}</label>
                                <input type="text" id="ndesidra" name="ndesidra" class="form-control input-full" />
                                <span class="help-block"></span>
                            </div>
                        </div>
    
                    </div>
                </div>
                <div class="tab-pane fade show "  id="contact" role="tabpanel" aria-labelledby="contact-tab">     
                        <h3> Anamnesis</h3>
                        <div class="row">
                            <div class="col-4">
                                <ul class="list-unstyled">
                                <li class="text-muted">Peso: <span style="color:#e99d05;" ><label id="pesoLabel"></label></span></li>
                                <li class="text-muted">Temperatura:<label id="temperatural"></label></li>
                                <li class="text-muted">Edad: <label id="pet_birth_date"></label></li>
                                <li class="text-muted">Ganglios R: <label id="ganglios_rl"></label></li>
                                
                                </ul>
                            </div>
                            <div class="col-xl-4">
                                <ul class="list-unstyled">
                                <li class="text-muted">Ganglios P: <label id="ganglios_pl"></label></li>
                            
                                <li class="text-muted">Fonendo :<label id="fonendol"></label></li>

                                </ul>
                            </div>
                            <div class="col-xl-4">
                                <ul class="list-unstyled">
                                    <li class="text-muted">Palpitacion Abdominal:<label id="palpitacion_abdl"></label></li>
                                    <li class="text-muted">Piel y Anejos :<label id="piell"></label></li>
                                <li class="text-muted">Obeso :<label id="obesol"></label></li>
                                </ul>
                            </div>
    

                            {{-- <div class="col-xl-4">
                            <p class="text-muted">Invoice</p>
                            <ul class="list-unstyled">
                                <li class="text-muted"><i class="fas fa-circle" style="color:#8f8061 ;"></i> <span
                                    class="fw-bold">ID:</span>#123-456</li>
                                <li class="text-muted"><i class="fas fa-circle" style="color:#8f8061 ;"></i> <span
                                    class="fw-bold">Creation Date: </span>Jun 23,2021</li>
                                <li class="text-muted"><i class="fas fa-circle" style="color:#8f8061;"></i> <span
                                    class="me-1 fw-bold">Status:</span><span class="badge bg-warning text-black fw-bold">
                                    Unpaid</span></li>
                            </ul>
                            </div> --}}
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="anam">Observaciones:</label>
                                    <textarea class="form-control" id="anam" name="anam" rows="8"></textarea>
                                </div> 
                            </div>
                            
                        </div>
                </div>
                <div class="tab-pane fade" id="prediag" role="tabpanel" aria-labelledby="prediag-tab"> 
                    <h3> Pre-Diagnostico</h3>    
                            <div class="form-group">
                                <label for="notas_prediag">Observaciones:</label>

        
                                <textarea class="form-control" id="notas_prediag" name="notas_prediag" rows="8"></textarea>
                            </div> 
                </div>
                <div class="tab-pane fade" id="exam" role="tabpanel" aria-labelledby="exam-tab">     
                    <h3> Examenes</h3>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <select class="form-control" id="examen" name="examen">

                                    <option value="Examen 1">Examen 1</option>
                                    <option value="Examen 2">Examen 2</option>
                                    <option value="Examen 3">Examen 3</option>
                                    <option value="Examen 4">Examen 4</option>
                                    <option value="Examen 5">Examen 5</option>
                                    <option value="Examen 6">Examen 6</option>
                                    <option value="Examen 7">Examen 7</option>
                                </select>
                                <span class="help-block"></span>
                            </div> 
                        </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="notas_examen">Observaciones:</label>
                                    <textarea class="form-control" id="notas_examen" name="notas_examen" rows="8"></textarea>
                                </div> 
                            </div>
                        
                    </div>
                </div>

                <div class="tab-pane fade" id="diag" role="tabpanel" aria-labelledby="diag-tab">     
                    <h3> Diagnostico</h3>

                    <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="obs">Observaciones:</label>
                                    <textarea class="form-control" id="obs" name="obs" rows="8"></textarea>
                                </div> 
                            </div>
                        
                    </div>
                </div>

                <div class="tab-pane fade" id="trata" role="tabpanel" aria-labelledby="trata-tab">     
                    <h3> Tratamiento</h3>

                    <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="notas_trata">Observaciones:</label>
                                    <textarea class="form-control" id="notas_trata" name="notas_trata" rows="8"></textarea>
                                </div> 
                                        
                                         <button class="btn btn-info"  id="pdf" >Imprimir PDF</button>
                            </div>
                        
                    </div>
                </div>

                <div class="tab-pane fade" id="exam" role="tabpanel" aria-labelledby="exam-tab">     
                    <h3> Examenes</h3>

                    <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="examenes">Examenes:</label>
                                    <textarea class="form-control" id="examenes" name="examenes" rows="8"></textarea>
                                </div> 
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

    <!--modal para actualizar cliente y mascota a la par -->

    <div class="modal fade bd-example-modal-lg" id="cliModal" tabindex="-1" role="dialog" aria-labelledby="modalclinizacionLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="cancelModalLabel">Datos mascota</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="cliForm" action="{{ route('customer.cliStore') }}" method="post">
                    @csrf
                <!-- Campo oculto para el ID del servicio -->
                {{ csrf_field() }}
                <input type="hidden" id="id_dueno" name="id_dueno" value="">
                <input type="hidden" id="cmn_pet_idcli" name="cmn_pet_idcli" value="{{$id}}">
                <input type="hidden" id="idcli" name="idcli" value="">
                <input type="hidden" id="tienecli" name="tienecli" value="">
                <input type="hidden" name="_tokencli" value="{{ csrf_token() }}">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group control-group form-inline controls">
                            <label>Nombre Mascota</label>
                            <input type="text" id="nombrepet" name="nombrepet" class="form-control input-full" required />
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group control-group form-inline controls">
                            <label>Espacie</label>
                            <input type="text" id="especiecli" name="especiecli" class="form-control input-full" />
                            <span class="help-block"></span>
                        </div>
                    </div>


                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group control-group form-inline controls">
                            <div><label>Sexo</label></div>
                            <select  id="sexocli" name="sexocli" class="form-control input-full"  >
                                                    
                                <option value="Macho" selected>Macho</option>
                                <option value="Hembra">Hembra</option>
                              </select>
                            {{-- <input type="text" id="sexocli" name="sexocli" class="form-control input-full"  /> --}}
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group control-group form-inline controls">
                            <label>Fecha nac</label>
                            <input type="date" id="pet_birth_datecli" name="pet_birth_datecli" class="form-control input-full" />
                            <span class="help-block"></span>
                        </div>
                    </div>
                </div>



                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group control-group form-inline controls">
                            <label>Raza</label>
                            <input type="text" id="razacli" name="razacli" class="form-control input-full"  />
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group control-group form-inline controls">
                            <label>Color</label>
                            <input type="text" id="colorcli" name="colorcli" class="form-control input-full" />
                            <span class="help-block"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group control-group form-inline controls">
                            <label>Microchip</label>
                            <input type="text" id="microcli" name="microcli" class="form-control input-full"  />
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group control-group form-inline controls">
                            <label>Estado Repro</label>
                            <select id="estado_reprocli" name="estado_reprocli" class="form-control input-full" >
                                                    
                                <option value="Fertil" selected>Fertil</option>
                                <option value="Castrado/Esterilizado">Castrado/Esterilizado</option>
                                <option value="No lo sé">No lo sé</option>
                              </select>
                            {{-- <input type="text" id="estado_reprocli" name="estado_reprocli" class="form-control input-full" /> --}}
                            <span class="help-block"></span>
                        </div>
                    </div>


                </div>
                <h3>Datos Tutor</h3>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group control-group form-inline controls">
                            <label>Nombre</label>
                            <input type="text" id="nombrecli" name="nombrecli" class="form-control input-full"  />
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group control-group form-inline controls">
                            <label>RUN</label>
                            <input type="text" id="runcli" name="runcli" class="form-control input-full" readonly />
                            <span class="help-block"></span>
                        </div>
                    </div>


                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group control-group form-inline controls">
                            <label>Direccion</label>
                            <input type="text" id="direccioncli" name="direccioncli" class="form-control input-full"  />
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group control-group form-inline controls">
                            <label>Celular</label>
                            <input type="text" id="phone_nocli" name="phone_nocli" class="form-control input-full"  />
                            <span class="help-block"></span>
                        </div>
                    </div>


                </div>


            </div>
                <div class="modal-footer">

                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">{{translate('Cerrar')}}</button>
                <button type="submit" class="btn btn-success btn-sm">{{translate('Guardar')}}</button>
            </div>
            <!-- Agrega aquí más campos si es necesario -->
        </form>
        </div>
        </div>
    </div>
<!-- Finodal mascota y cliente -->

    <!--modal para actualizar antecedentes-->

    <div class="modal fade bd-example-modal-lg" id="anteModal" tabindex="-1" role="dialog" aria-labelledby="modalantenizacionLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="cancelModalLabel">Datos mascota</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="anteForm" action="{{ route('customer.anteStore') }}" method="post">
                    @csrf
                <!-- Campo oculto para el ID del servicio -->
                {{ csrf_field() }}
                <input type="hidden" id="id_dueno" name="id_dueno" value="">
                <input type="hidden" id="cmn_pet_idante" name="cmn_pet_idante" value="{{$id}}">
                <input type="hidden" id="id_petante" name="id_petante" value="">
                <input type="hidden" id="tieneante" name="tieneante" value="">
                <input type="hidden" name="_tokenante" value="{{ csrf_token() }}">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group control-group form-inline controls">
                            <label>Origen</label>
                            <input type="text" id="origenante" name="origenante" class="form-control input-full" required />
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group control-group form-inline controls">
                            <label>Habitat</label>
                            <input type="text" id="habitatante" name="habitatante" class="form-control input-full" />
                            <span class="help-block"></span>
                        </div>
                    </div>


                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group control-group form-inline controls">
                            <label>Comportamiento</label>
                            <input type="text" id="comportamientoante" name="comportamientoante" class="form-control input-full"  />
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group control-group form-inline controls">
                            <label>Enfermedades</label>
                            <input type="text" id="enfermedadesante" name="enfermedadesante" class="form-control input-full" />
                            <span class="help-block"></span>
                        </div>
                    </div>
                </div>



                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group control-group form-inline controls">
                            <label>Alergias</label>
                            <input type="text" id="alergiasante" name="alergiasante" class="form-control input-full"  />
                            <span class="help-block"></span>
                        </div>
                    </div>

                </div>
                




            </div>
                <div class="modal-footer">

                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">{{translate('Cerrar')}}</button>
                <button type="submit" class="btn btn-success btn-sm">{{translate('Guardar')}}</button>
            </div>
            <!-- Agrega aquí más campos si es necesario -->
        </form>
        </div>
        </div>
    </div>
<!-- Fin modal antecedentes-->

<!-- Modal Archivos-->
<div class="modal fade" id="nuevofile" tabindex="-1" role="dialog" aria-labelledby="nuevofileLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="nuevofileLabel">Agregar archivos nuevos</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form id="uploadForm2" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="id_mascot_id" name="id_mascot_id" value="{{$id}}">
                <div class="form-group">
                    <label for="file">Seleccionar Archivo</label>
                    <input type="file" class="form-control-file" id="file" name="file" required>
                </div>
                <div class="form-group">
                    <label for="concepto">Concepto</label>
                    <input type="text" class="form-control" id="concepto" name="concepto" placeholder="Concepto (ej; rayos)" required>
                </div>
                {{-- <button type="submit" class="btn btn-primary">Subir Archivo</button> --}}
                
                <br>
                <div id="successAlert" style="padding-top: 12px"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </div>
            </form>
            
        </div>
      </div>
    </div>
  </div>
  <!-- Final Modal Archivos-->


<script src="{{dsAsset('js/custom/pet/pets2.js')}}"></script>
<script>
$("#pdf").on('click', function () {
    // Obtener los valores de los campos del formulario
    var campo1 = $("#notas_trata").val();
    var campo2 = {{$id}};
    var campo3 = $("#campo3").val();

    // Codificar el texto con saltos de línea
    var campo1Encoded = encodeURIComponent(campo1);

    // Construir la URL con los datos del formulario
    var url = JsManager.BaseUrl() + '/receta';
    url += '?campo1=' + campo1Encoded + '&campo2=' + campo2 + '&campo3=' + campo3;

    // Abrir la nueva ventana con la URL que incluye los datos del formulario
    window.open(url);
});





    function enviarFormulario() {
        document.getElementById('formulario-imagen').submit();
    }

    // Escuchar el evento de cambio en el input de tipo archivo y actualizar el texto del label
    document.getElementById('input-imagen').addEventListener('change', function(event) {
        var label = event.target.parentNode;
        var span = label.querySelector('span');
        if (event.target.files.length > 0) {
            // Si se selecciona un archivo, mostrar el nombre del archivo seleccionado
            span.textContent = event.target.files[0].name;
        } else {
            // Si no se selecciona ningún archivo, restaurar el texto por defecto "Cambiar"
            span.textContent = 'Cambiar';
        }
    });
</script>
<script>

    function enviarFormulario() {
        document.getElementById('mensaje-carga').style.display = 'block'; // Mostrar el mensaje de carga
        document.getElementById('formulario-imagen').submit(); // Enviar el formulario
    }
// Función para manejar el envío de formularios
function handleFormSubmit(event) {
    event.preventDefault();

    // Obtener el formulario que se está enviando
    var form = this;

    // Crear un objeto FormData con los datos del formulario
    var formData = new FormData(form);


    // Realizar la solicitud AJAX
    $.ajax({
        url: '{{ route("customer.guardararchivo") }}',
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            // Manejar la respuesta de éxito
            $('#uploadedFiles').append('<p>Archivo subido: <a href="' + response.url + '">' + response.filename + '</a></p>');
            $('#successAlert').show().html('<div class="alert alert-success" role="alert"> Subido Exitosamente </div>');
            document.getElementById('uploadForm2').reset();
            setTimeout(function() {
                $('#successAlert').fadeOut();
            }, 5000);

        },
        error: function(xhr, status, error) {
            // Manejar errores
            console.error(xhr.responseText);
        }
    });
}

// Agregar un evento de envío de formulario a cada formulario
document.getElementById('uploadForm1').addEventListener('submit', handleFormSubmit);
document.getElementById('uploadForm2').addEventListener('submit', handleFormSubmit);

</script>




@endsection