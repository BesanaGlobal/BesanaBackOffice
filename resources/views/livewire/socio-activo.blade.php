<div class="container">
    <!-- BEGIN: Login Info -->
    <div class="grid grid-cols-1 md:grid-cols-2 md:gap-4 p-2">
        <div class="col-1 p-2">
            <form wire:submit.prevent="create">
                @if (session()->has('mensaje'))
                <div class=" w-full  alert alert-success">{{ session('mensaje') }}</div>
                @endif
                @if (session()->has('error'))
                <div class=" w-full  alert alert-danger">{{ session('error') }}</div>
                @endif
                <span class="font-bold uppercase text-lg">{{__('personal information')}}:</span>
                <div class="w-full">
                    <div class="text-xl gap-2 items-center w-full ">
                        <input id="Name" placeholder="{{__('Enter your name')}}" class="-intro-x login__input form-control py-3 " type="text" wire:model="Name" :value="old('Name')" required autofocus />
                        <input id="LastName" class="-intro-x login__input form-control py-3 px-4 block mt-3" type="text" wire:model="LastName" :value="old('LastName')" required placeholder="{{__('Enter your lastname')}}" />
                    </div>
                </div>
                <div class="w-full">
                    <div class="pt-2">
                        <label class="text-gray-600 font-bold" for="DateBirth">{{__('Birthday')}}:</label>
                        <input id="DateBirth" class="-intro-x login__input form-control py-3 w-full" type="date" wire:model="DateBirth" :value="old('DateBirth')" required />
                    </div>
                </div>
                <div class="-intro-x grid grid-cols-1 lg:grid-cols-2 lg:gap-4 pb-4">
                    <div class="pt-2">
                        <label class="text-gray-600 font-bold" for="city-select">{{__('Origin')}}:</label>
                        <select name="city-select" id="city-select" class="form-control" wire:model="selectCity" required>
                            <option value="1">EE UU</option>
                            <option value="2">MEXICO</option>
                            <option value="3">GUATEMALA</option>
                            <option value="4">PANAMÁ</option>
                        </select>
                    </div>
                    @if($selectCity == 1)
                    <div class="pt-2" id="SSN-DIV">
                        <label class="text-gray-600 font-bold" for="SSN">{{__('Enter your SSN')}}:</label>
                        <input id="SSN" class="-intro-x  form-control w-full" type="text" wire:model="SSN" placeholder="{{__('Enter your SSN')}}" />
                        @error('SSN')
                        <div class="intro-x bg-red-600 p-2 rounded-lg ">
                            <span class="-intro-x bg-red-500 p-2 rounded-lg text-white">{{ $message }}</span>
                        </div>
                        @enderror
                    </div>
                    @endif
                    @if($selectCity == 2)
                    <div class="pt-2" id="RFC-DIV">
                        <label class="text-gray-600 font-bold" for="RFC">{{__('Enter your RFC')}}:</label>
                        <input id="RFC" class="-intro-x  form-control w-full" wire:model="RFC" type="text" placeholder="{{__('Enter your RFC')}}" />
                        @error('RFC')
                        <div class="intro-x bg-red-600 p-2 rounded-lg ">
                            <span class="-intro-x bg-red-500 p-2 rounded-lg text-white">{{ $message }}</span>
                        </div>
                        @enderror
                    </div>
                    <div class="pt-2" id="CURP-DIV">
                        <label class="text-gray-600 font-bold" for="CURP">{{__('Enter your CURP')}}:</label>
                        <input id="CURP" class="-intro-x  form-control w-full" wire:model="CURP" type="text" placeholder="{{__('Enter your CURP')}}" />
                        @error('CURP')
                        <div class="intro-x bg-red-600 p-2 rounded-lg ">
                            <span class="-intro-x bg-red-500 p-2 rounded-lg text-white">{{ $message }}</span>
                        </div>
                        @enderror
                    </div>
                    @endif
                    @if($selectCity == 3)
                    <div class="pt-2" id="DPI-DIV">
                        <label class="text-gray-600 font-bold" for="DPI">{{__('Enter your DPI')}}:</label>
                        <input id="DPI" class="-intro-x  form-control w-full" wire:model="DPI" type="text" placeholder="{{__('Enter your DPI')}}" />
                        @error('DPI')
                        <div class="intro-x bg-red-600 p-2 rounded-lg ">
                            <span class="-intro-x bg-red-500 p-2 rounded-lg text-white">{{ $message }}</span>
                        </div>
                        @enderror
                    </div>
                    @endif
                    @if($selectCity == 4)
                    <div class="pt-2" id="DPI-DIV">
                        <label class="text-white" for="DPI">{{__('Enter your ID Personal')}}:</label>
                        <input id="IP" class="-intro-x  form-control w-full" wire:model="IP" type="text" placeholder="{{__('Enter your ID Personal')}}" />
                        @error('IP')
                        <div class="intro-x bg-red-600 p-2 rounded-lg ">
                            <span class="-intro-x bg-red-500 p-2 rounded-lg text-white">{{ $message }}</span>
                        </div>
                        @enderror
                    </div>
                    @endif
                </div>
                {{-- DATOS DEL SISTEMA --}}
                <span class="-intro-x font-bold uppercase text-lg pt-5">{{__('System Data')}}:</span>
                <div class=" w-full">
                    <div class="py-2">
                        <label class="text-gray-600 font-bold" for="fechaingreso">{{__('date of admission')}}:</label>
                        <input id="fechaingreso" class="-intro-x login__input form-control py-3 px-4 block" type="date" wire:model="fechaingreso" :value="old('$fechaingreso')" required />
                    </div>
                </div>
                <div class="-intro-x grid grid-cols-1 lg:grid-cols-2 lg:gap-4">
                    <div class="w-full">
                        <label class="text-gray-600 font-bold" for="Invitedby"> {{__('Invited by')}}:</label>
                        <input id="Invitedby" class="-intro-x login__input form-control py-3" type="text" wire:model="invitedby" wire:change="datahijos" :value="old('invitedby')" required />
                        @if ($nohijos)
                        <div class="intro-x bg-red-600 p-2 rounded-lg ">
                            <span class="-intro-x bg-red-500 p-2 rounded-lg text-white">Socio No Existe</span>
                        </div>
                        @endif
                    </div>
                    <div class="w-full mt-2 lg:mt-0">
                        <div class="col-1">
                            <label class="text-gray-600 font-bold" for="Invitedby">{{__('Username')}}:</label>
                        </div>
                        <div class="col-2">
                            <input id="userName" class="-intro-x form-control py-3 " type="text" wire:model="userName" :value="old('userName')" required placeholder="{{__('Username')}}" />
                            @error('userName')
                            <div class="intro-x bg-red-600 p-2 rounded-lg ">
                                <span class="-intro-x bg-red-500 p-2 rounded-lg text-white">{{ $message }}</span>
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                {{-- caja para password y confirm password --}}
                <div class="-intro-x grid grid-cols-1 lg:grid-cols-2 gap-2 mt-3">
                    <div>
                        <label for="Password" class="-intro-x text-gray-600 font-bold">{{__('Password')}}</label>
                        <input id="Password" class="-intro-x  form-control py-3" type="text" wire:model="Password" required />
                        @error('Password')
                        <div class="intro-x bg-red-600 p-2 rounded-lg ">
                            <span class="-intro-x bg-red-500 p-2 rounded-lg text-white ml-4">{{ $message }}</span>
                        </div>
                        @enderror
                    </div>
                    <!-- Confirm Password -->
                    <div class="-intro-x w-full ">
                        <label for="password_confirmation" class="-intro-x text-gray-600 font-bold">{{__('Confirm Password')}}</label>
                        <input id="password_confirmation" class="-intro-x  form-control py-3" type="text" placeholder="Besanabg2023" required wire:model="password_confirmation" />
                        @error('password_confirmation')
                        <div class="intro-x bg-red-600 p-2 rounded-lg ">
                            <span class="-intro-x bg-red-500 p-2 rounded-lg text-white ml-4">{{ $message }}</span>
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="-intro-x grid grid-cols-2 gap-2 mt-3">
                    <div class="w-full p-3">
                        <input type="checkbox" class="-intro-x bg-primary " style="background-color:green;" wire:model="asignarSocio">
                        <span>{{__('Do you want to make a placement')}}?</span>
                        @if ($asignarSocio)
                        <div wire:ignore>
                            <select class="form-control" id="select2-dropdown" wire:model='asignacionSocio'>
                                <option value="">{{__('Select Partner')}}</option>
                                @foreach($SonAfiliate as $item)
                                <option value="{{ $item->idAffiliated}}">{{ $item->userName}}</option>
                                @endforeach
                            </select>
                        </div>
                        @endif
                    </div>
                </div>
        </div>
        {{-- fin columna uno --}}
        <div class="col-2  bg-gray-300 md:border-l-4 md:border-primary p-2">
            <span class="-intro-x  font-bold uppercase text-lg ">{{__('CONTACT INFORMATION')}}:</span>
            <div class=" grid grid-cols-1 lg:grid-cols-2 gap-4 w-full">
                <input id="AlternativePhone" class="-intro-x login__input form-control py-3 block" type="number" wire:model="AlternativePhone" :value="old('AlternativePhone')" required autofocus placeholder="{{__('Cell phone')}}" />
                <input id="WorkPhone" class="-intro-x login__input form-control py-3 block" type="number" wire:model="WorkPhone" :value="old('WorkPhone')" autofocus placeholder="{{__('Phone')}}" required />
            </div>
            {{-- Email  --}}
            <div class="w-full mt-2">
                <label class="-intro-x text-gray-600 font-bold" for="Email"> {{__('Email')}}:</label>
                <input id="Email" class="-intro-x login__input form-control py-3 block" type="Email" wire:model="Email" :value="old('Email')" required autofocus placeholder="{{__('Email')}}" />
                @error('Email')
                <div class="intro-x bg-red-600 p-2 rounded-lg ">
                    <span class="-intro-x bg-red-500 p-2 rounded-lg text-white">{{ $message }}</span>
                </div>
                @enderror
            </div>
            {{-- confirm email --}}
            <div class="w-full mt-2 mb-3">
                <label class="-intro-x text-gray-600 font-bold" for="confirmEmail"> {{__('Confirm Email')}}:</label>
                <input id="confirmEmail" class="-intro-x login__input form-control py-3 block" type="email" wire:model="confirmEmail" :value="old('confirmEmail')" required autofocus placeholder="{{__('Confirm Email')}}" />
                @error('confirmEmail')
                <div class="intro-x bg-red-600 p-2 rounded-lg ">
                    <span class="-intro-x bg-red-500 p-2 rounded-lg text-white">{{ $message }}</span>
                </div>
                @enderror
            </div>
            {{-- addres  --}}
            <span class="-intro-x  font-bold uppercase text-lg ">{{__('LOCATION DATA')}}:</span>
            <div class="w-full grid grid-cols-1">
                <label class="-intro-x text-gray-600 font-bold" for="Address"> {{__('Address')}}: </label>
                <input placeholder="{{__('Address')}}" id="Address" class="-intro-x login__input form-control py-3 block" type="text" wire:model="Address" :value="old('Address')" required autofocus />
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2">
                <div class="grid grid-cols-1">
                    <label class="-intro-x text-gray-600 font-bold" for="Country"> {{__('Country')}}:</label>
                    <select wire:model="selectedCountry" id="Country" class="form-control">
                        <option  selected disabled>Selecciona un País</option>
                        <option ></option>
                        @foreach($Countries as $country => $value)
                        <option value="{{ $country }}">{{ $country }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- State/Province -->
                <div class="grid grid-cols-1 ml-0 lg:ml-2">
                    <label class="-intro-x text-gray-600 font-bold" for="State"> {{__('State')}}:</label>
                    
                    <select wire:model="selectedState" id="State" class="form-control">
                        <option selected disabled>Selecciona un Estado</option>
                        <option></option>
                        @if (!is_null($States))
                        @foreach($States as $state)
                        <option value="{{ $state }}">{{ $state }}</option>
                        @endforeach
                        @endif
                    </select>
                   
                </div>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 mt-3">
                <div class="grid grid-cols-1">
                    <label class="-intro-x text-gray-600 font-bold" for="City"> {{__('City')}}:</label>
                    <input type="text" class="form-control" wire:model="selectedCity" :value="old('selectCity')" required>
                </div>
                <div class="grid grid-cols-1 ml-0 lg:ml-2">
                    <label class="-intro-x text-gray-600 font-bold" for="ZipCode"> {{__('ZipCode')}}:</label>
                    <input id="ZipCode" class="-intro-x login__input form-control py-3 block" type="text" wire:model="ZipCode" :value="old('ZipCode')" required autofocus />
                </div>
            </div>
            <div class="flex flex-col lg:flex-row lg:justify-evenly p-4">
                <div>
                    <input type="checkbox" class="-intro-x bg-primary" style="input:checked {background-color:green;}" wire:model="terminos">
                    <span class="fw-bold">{{__('Accept to')}}
                        <button class="intro-x underline text-sm text-info fw-bold hover:text-gray-900" wire:model="terminos" onclick="terminos()">{{__('Terms and Conditions')}}</button>
                    </span>
                </div>
                <a class="intro-x login__input underline text-sm text-gray-600 hover:text-gray-900 mr-3 text-center" href="{{ route('login.register') }}"> {{__('You are already registered')}}? </a>
            </div>

            <div class="flex justify-center lg:justify-end">
                <button @if ($terminos==false) disabled @else @endif class="btn btn-primary py-3 px-4 w-full lg:w-32" type="submit">
                    {{__('Register')}}
                </button>
            </div>
        </div>
        </form>
    </div>
</div>
</div>






<script>
    $('#select2-dropdown').select2();
    $('#select2-dropdown').on('change', function(e) {
        var data = $('#select2-dropdown').select2("val");
        @this.set('ottPlatform', data);
    });
</script>
<script>
    function fireModal(action = 1) {
        if (action == 1) {
            document.querySelector('.modal').classList.add('show')
            document.querySelector('.modal').style.display = 'block'
        } else {
            document.querySelector('.modal').classList.add('hide')
            document.querySelector('.modal').style.display = 'none'
        }
    }

    window.addEventListener('modal-open', event => {
        fireModal(1)
    })

    window.addEventListener('noty', event => {
        Swal.fire(
            'Mensaje',
            event.detail.msg,
            'info'
        ).then(result => {
            if (result.isConfirmed) {
                // window.location = '/socioactivo'
            }
        })
    })

    window.addEventListener('error', event => {
        Swal.fire(
            'Error',
            event.detail.msg,
            'error'
        ).then(result => {
            if (result.isConfirmed) {

            }
        })
    })

    function terminos() {
        const texto = `POLITICAS Y PROCEDIMIENTOS.
                    Estos términos y condiciones (los "Términos y Condiciones") rigen el uso de www.besanaglobal.com (el "Sitio"). Este Sitio es propiedad y está operado por BESANA GLOBAL. Este Sitio es un sitio web de comercio electrónico. Al usar este Sitio, usted indica que ha leído y comprende estos Términos y condiciones y acepta cumplirlos en todo momento.ESTOS TÉRMINOS Y CONDICIONES CONTIENEN UNA CLÁUSULA DE RESOLUCIÓN DE DISPUTAS QUE AFECTA SUS DERECHOS SOBRE CÓMO RESOLVER DISPUTAS. POR FAVOR LÉALO CUIDADOSAMENTE.PROPIEDAD INTELECTUALTodo el contenido publicado y puesto a disposición en nuestro Sitio es propiedad de BESANA GLOBAL y de los creadores del Sitio. Esto incluye, entre otros, imágenes, texto, logotipos, documentos, archivos descargable y cualquier cosa que contribuya a la composición de nuestro Sitio.cuentasCuando crea una cuenta en nuestro Sitio, acepta lo siguiente:Usted es el único responsable de su cuenta y de la seguridad y privacidad de su cuenta, incluidas las contraseñas o la información confidencial adjunta a esa cuenta; yToda la información personal que nos proporciona a través de su cuenta está actualizada, es precisa y veraz, y actualizará su información personal si cambia.Nos reservamos el derecho de suspender o cancelar su cuenta si está utilizando nuestro Sitio ilegalmente o si viola estos Términos y condiciones.Limitación de responsabilidadBESANA GLOBAL y nuestros directores, funcionarios, agentes, empleados, subsidiarias y afiliadas no serán responsables de ninguna acción, reclamo, pérdida, daño, responsabilidad y gasto, incluidos los honorarios legales, derivados de su uso del Sitio.IndemnidadExcepto donde lo prohíba la ley, al usar este Sitio usted indemniza y exime a BESANA GLOBAL y a nuestros directores, funcionarios, agentes, empleados, subsidiarias y afiliados de cualquier acción, reclamo, pérdida, daño, responsabilidad y gasto, incluidos los honorarios legales que surjan de su uso de nuestro Sitio o su violación de estos Términos y Condiciones.Ley aplicableEstos Términos y Condiciones se rigen por las leyes del Estado de Nevada.Resolución de conflictosSujeto a las excepciones especificadas en estos Términos y condiciones, si usted y BESANA GLOBAL no pueden resolver una disputa a través de una discusión informal, entonces usted y BESANA GLOBAL acuerdan presentar el problema primero ante un mediador no vinculante y ante un árbitro en el caso esa mediación falla. La decisión del árbitro será definitiva y vinculante. Cualquier mediador o árbitro debe ser una parte neutral aceptable tanto para usted como para BESANA GLOBAL.Sin perjuicio de cualquier otra disposición en estos Términos y condiciones, usted y BESANA GLOBAL acuerdan que ambos conservan el derecho de iniciar una acción en un tribunal de reclamos menores y presentar una acción por medida cautelar o infracción de propiedad intelectual. Términos y Condiciones Adicionales sobre el Plan de Compensación
                    DEFINICIONES:
                    PLAN DE COMPENSACION: El plan de compensación es el sistema de premiación que ofrecemos a nuestros promotores activos para valorar su esfuerzo. Es uno de nuestros pilares fundamentales ya que definirá el crecimiento de los distribuidores y de la empresa.
                    UNI NIVEL: Esta estructura permite que un distribuidor construya un negocio agregando miembros uno a la vez. No hay límite de ancho en este plan y la comisión normalmente distribuye a una profundidad de nivel especificada.
                    MEMBRESÍA: Una membresía es la cuenta y los beneficios recibidos que una persona obtiene al aceptar las políticas y procedimientos de BESANA GLOBAL cuando a realizado su primera compra.                                                                                                                         AFILIAR:  Afiliación es el acto y el resultado de afiliar. Este verbo hace referencia a la acción de adherir, apuntar, inscribir, anotar o sumar a un individuo a una asociación u organización.                                                                                                                                           CLIENTE: Un cliente es una persona o entidad que compra los productos que ofrece BESANA GLOBAL.                                         CLIENTE PREFERENCIAL: Estos Clientes Preferenciales participan en programas interactivos, proveen los datos respectivos, y a cambio disfrutan los beneficios de las promociones de nuestros productos y mucho más.
                    NOMBRE DE USUARIO: El nombre de usuario es un nombre único con qué se identifica a cada persona que se asocia a BESANA GLOBAL. los nombres de usuario son elegidos por cada  persona que se registra en nuestra plataforma.
                    SOCIO ACTIVO: Persona, individuo, entidad organizacional, que ha comprado uno de nuestros  productos ( Besana Global) compra mínima de 70 puntos, los cual te mantendrá activo por 30 días y elegible para ganar comisiones.                                                                                      P
                    SOCIO INACTIVO: Se considera un socio  inactivo  cuando NO tiene el mínimo de 70 puntos de consumo personal, por lo tanto no es elegible para ganar comisiones.
                    SOCIO PROMOTOR: Se considera un socio promotor a toda persona, individuo, entidad organizacional, que ha pagado $ 24.95  por  membresía anual el cual se le hace elegible para ganar comisiones del 35% de todo lo que se promueva en su tienda en línea, el socio promotor no tiene la obligación de ser un socio activo para poder generar ingresos de tienda en línea.
                    TIENDA EN LINEA: Una tienda en línea o también conocida como tienda Online, tienda virtual o tienda electrónica, se refiere a un tipo de comercio que se usa como medio principal para realizar transacciones de compra y venta de productos, BESANA GLOBAL pone a disposición de sus asociados una réplica de página web en la que pueden promover los productos de Besana global y a la vez generar ingresos.
                    NIVEL DESCENDENTE: Una línea descendente es un término generalmente usado en marketing Multi Nivel (MLM) para describir a los consultores o los representantes que trabajan con otro representante. Por ejemplo, Elizabeth empieza a trabajar para una empresa y luego afilia  a otras cinco personas para trabajar en ella en la misma empresa, esas cinco personas son su línea descendente. Esas cinco personas pasarían hacer su nivel uno descendente. 
                    NIVEL ASCENDENTE: Son todas las personas que se encuentran por encima de ti en la organización. Es decir, desde tu patrocinador hacia arriba. 
                    PATROCINADOR: Es tu línea ascendente, la persona que te invito o te afilio personalmente a BESANA GLOBAL Y te transformaste en en su primer nivel descendente.
                    PUNTOS: En BESANA GLOBAL asignamos  un valor en Puntos de Volumen que es igual en los países que tenemos presencia. Conforme sus clientes o socios de negocio adquieren nuestros productos, usted acumula cantidad de Puntos de Volumen que corresponden a los productos pedidos. Estos Puntos de Volumen son su producción de ventas y son usados con propósitos de calificaciones y comisiones..
                    VP (VOLUMEN PERSONAL)  Es el volumen de puntos que usted debe de tener de su compra personal para estar calificado para generar comisiones.
                    VG (VOLUMEN GRUPAL) Es el volumen de puntos que usted acumula de todas las compras generadas en su línea descendente para propósito de comisiones y calificaciones para rangos.
                    BONOS DE INICIO: El Bono de Inicio Rápido está diseñado para proporcionar ganancias inmediatas a los socios promotores cuando inscriben personalmente a socios activos. El Patrocinador del nuevo socio recibe un porcentaje del (VP) del  pedido que el nuevo Distribuidor coloca en sus primeros 30 días.
                    RESIDUAL MENSUAL:  El ingreso residual consiste en realizar un trabajo por una sola vez y continuar recibiendo ingresos sin necesidad de nuestra presencia física para continuar disfrutando de las permanentes regalías. Nuestro término residual mensual nos referimos al porcentaje que tú cobras de todas las re-compras que se realicen en tu líneas descendentes. (Consulta nuestra tabla de residual mensual para ver calificación de niveles) Puedes solicitarla a info@besanaglobal.com
                    IGUALACION DE CHEQUE: En la industria del Network marketing se usa el término de igualación de cheque,  y para Besana Global es el porcentaje que tú recibes de tu primer nivel descendente y de tu segundo nivel descendente, éste porcentaje está basado en la cantidad que tu primer nivel descendente y tu segundo nivel descendente ganan del residual mensual. 
                    RANGOS: Para el ser humano el reconocimiento es algo fundamental,  en Besana Global este reconocimiento se da en base a rangos alcanzados gracias a tu esfuerzo y el esfuerzo de tu equipo podrás alcanzar el  rango que tú te propongas.
                    BONOS DE RANGOS: En Besana Global reconocemos y valoramos el esfuerzo de cada uno de nuestros socios y es por eso que premiamos cada rango que tú alcanzas con un bono por alcanzar dicho rango. (Importante saber que el bono que se paga por el rango obtenido se cobra una sola vez y NO es recurrente) 
                    FONDO GLOBAL DE LIDERAZGO: De ventas totales de la empresa se toma un 5% y se asigna para distribuirlo entre personas con un rango de liderazgo. (Consulta nuestros rangos calificaciones)
                    GANANCIA DE TIENDA EN LINEA: Como socio activo, o únicamente socio promotor  en la empresa podrás promover todos nuestros productos y a la vez generar un 35% de comisiones de todo lo que tus clientes compren.
                    BILLETERA DIGITAL: Es una billetera electrónica que está asociada con tu membresía a la cual se puede enviar las comisiones generadas.
                    COLOCACION: BESANA GLOBAL ha proporcionado una herramienta para que cada uno de nuestros miembros activos tengan el derecho de dar la ubicación necesaria a cualquier persona de su primer nivel descendente.
                    PROMOCIÓN DE PRODUCTOS Y OPORTUNIDAD DE INGRESOS
                    BG alienta a los Miembros a promover el producto, y la oportunidad comercial de conformidad con las pautas apropiadas emitidas por BG. Estas pautas son necesarias para que BG garantice el cumplimiento por parte de los Miembros y de BG de la gran cantidad de leyes que rigen la publicidad de los productos  y la oportunidad comercial de BG. El incumplimiento de estas pautas puede resultar en violaciones de las leyes locales y nacionales, lo que puede resultar en daños a la reputación de BG, así como restricciones sobre BG, Miembros y productos de BG que podrían generar publicidad no deseada y posibles multas, sanciones y /o acciones legales.
                    NOMBRES DE PROPIEDAD Y DERECHOS DE PROPIEDAD INTELECTUAL.
                    Un miembro no puede usar los nombres de los empleados, las marcas registradas, las marcas de servicio, la imagen comercial o los nombres comerciales, los nombres de dominio, los logotipos, los medios de BG o los eventos de relaciones públicas, o cualquier frase distintiva o sonido usado por BG, para promover el negocio del miembro antes de recibir información por escrito. permiso de BG. El uso no autorizado de materiales puede resultar en una acción disciplinaria. Si el Miembro tiene alguna pregunta con respecto a lo que es aceptable, el Miembro puede comunicarse con el departamento de Cumplimiento de BG para obtener una aclaración. Para proteger los derechos de propiedad de BG, un miembro no puede obtener mediante la solicitud de una patente, marca comercial, nombre de dominio de Internet o derechos de autor, ningún derecho, título o interés en los nombres, nombres de dominio, marcas comerciales, logotipos o derechos comerciales, nombres, o cualquier derivación de cualquiera de los anteriores, de BG y sus productos. Cuando BG cambie o abandone cualquiera de sus nombres comerciales o marcas, un miembro también acepta cambiar o abandonar el uso de dichos nombres comerciales o marcas. En caso de que un Miembro posea o controle cualquier derecho de propiedad intelectual de BG,  o tome posesión o control de dichas marcas u otra propiedad, el Miembro acepta ceder dichos derechos de propiedad intelectual sin cargo ni demora a BG.
                     Reclamos de Ingresos y Oportunidades. En su entusiasmo por inscribir a posibles Miembros, algunos Miembros ocasionalmente se ven tentados a hacer declaraciones de ingresos o representaciones de ganancias para demostrar el poder inherente del mercadeo en red. Esto es contraproducente ya que los nuevos miembros pueden sentirse decepcionados si sus resultados no son tan extensos o rápidos como los resultados que otros han logrado. Un miembro no puede realizar afirmaciones irrazonables o engañosas o tergiversar intencionalmente las ganancias o los ingresos potenciales. Las garantías de ingresos de cualquier tipo están prohibidas por el Contrato y por la ley, así como la exhibición de cheques de Comisión o declaraciones de ganancias reales o copias. Las representaciones de ingresos deben ser honestas y basadas en hechos. Además, las representaciones de ingresos deben incluir descargos de responsabilidad de que las ganancias pueden variar según el grado de esfuerzo empleado. No se garantizan ganancias y no se garantiza que un miembro alcance un cierto nivel de compensación.
                    BONOS Y COMISIONES
                    En Besana Global reconocemos tu esfuerzo y por lo mismo te ofrecemos seis forma de generar ingresos
                    1. BONO DE INICIO RAPIDO POR RECOMENDACION: Este bono de inicio rápido es únicamente para el socio activo que ha hecho una compra personal de 70 puntos dentro de 30 días por lo cual le da la oportunidad de generar 40% de todas las ventas que realicé o refiera personalmente. Además generará 15% de todas las ventas que genere  su línea descendente. (primer nivel) Este bono es aplicable únicamente en la primera compra de los socios invitados, ya que contamos con un segundo bono de comisión y es aplicable para las segundas compras. Para cobrar  este bono No necesita ningún tipo de rango.
                    2. RESIDUAL DE EQUIPOS: De las segundas compras realizadas en tus 9 niveles descendentes generas 7% el cual se paga el tercer miércoles de cada mes. ( consulta la calificación de rangos para ver para cuantos niveles calificas para dicho ingreso) O comunícate con Besana Global para más detalles. 
                    3. PORSENTAJE DE IGUALACION DE CHEQUE: Cuándo tu línea descendente (primer nivel) y tu línea descendente (segundo nivel) generan ganancias del ingreso residual de equipos una cantidad o  X cantidad tú generas el 35% de tu línea descendente (primer nivel)  y 25% de tu línea descendente (segundo nivel ). No se requiere ningún rango para generar el 35% de tu primer nivel. Para generar el 25% de tu segundo nivel tú tienes que obtener el rango de Safiro.
                    4. BONOS DE RANGO: En Besana Global contamos con 10 rangos Socio Activo, Director, Jade, Safiro azul, Rubí, Esmeralda, Diamante, Diamante Azul, Diamante Corona. Cada rango alcanzado generas un bono, pero Besana Global requiere que tú cumplas con esos rangos de los cuales necesitas alcanzar ciertos requisitos consulta con Besana Global para más detalles.
                    5. FONDO GLOBAL DE LIDERAZGO:

                    TERMINOS DE LA MEMBRESIA.
                    ACEPTACIÓN: Besana Global podrá modificar el contrato, las políticas y los procedimientos  el plan de compensación de Besana Global en cualquier momento a su discreción. La continuación de un negocio de Besana Global por parte de un miembro y/o la aceptación de cualquier ganancia de conformidad con el plan de compensación de besana Global y aceptación de cualquier otro beneficio bajo contrato constituye la aceptación del contrato en su totalidad junto con todas y cada una de las enmiendas mencionadas.
                    CONTRATISTA INDEPENDIENTE:
                     Los miembros son contratistas independientes y no son compradores de una franquicia u oportunidad comercial. El acuerdo entre BG y sus Miembros no crea una relación de empleador/empleado, agencia, sociedad o empresa conjunta entre la Compañía y el Miembro. Los miembros no serán tratados como empleados por sus servicios para propósitos de impuestos federales o locales. Todos los miembros son responsables de pagar los impuestos locales, estatales (provinciales) y federales adeudados por toda la compensación obtenida como miembro de la Compañía. El Miembro no tiene autoridad (expresa o implícita) para obligar a la Compañía a ninguna obligación. Cada miembro establecerá sus propios objetivos, horas y métodos de venta, siempre y cuando cumpla con los términos del Acuerdo de miembro, estas Políticas y procedimientos y la ley aplicable.
                    IDENTIFICACIÓN FISCAL REQUERIDA:
                    Cuando un Miembro gana $600 USD acumulados o más en comisiones, se debe proporcionar una identificación fiscal válida a BG.BG se reserva el derecho de exigir documentación acreditativa que demuestre que la información es válida y pertenece al socio. Si no proporciona la identificación requerida al alcanzar uno o ambos umbrales establecidos, se retendrá la comisión. BG puede ajustar las comisiones según las leyes locales.
                     El Miembro que celebra este Contrato dan su consentimiento irrevocable para resolver cualquier demanda, acción o procedimiento que surja del Contrato o se relacione con él mediante arbitraje vinculante en el Estado de NEVADA y de cualquier tribunal federal en el Estado de NEVADA. Cada parte que tenga una inquietud deberá primero dar aviso de la ofensa y esperar por lo menos treinta (60) días para que la otra parte la subsane. En caso de disputa, la otra parte reembolsará a la parte vencedora los honorarios de los abogados y los gastos razonables de viaje y alojamiento.
                    CAMBIOSEstos Términos y condiciones pueden modificarse ocasionalmente para mantener el cumplimiento de la ley y reflejar cualquier cambio en la forma en que operamos nuestro Sitio y la forma en que esperamos que los usuarios se comporten en nuestro Sitio. Notificaremos a los usuarios por correo electrónico sobre los cambios en estos Términos y condiciones o publicaremos un aviso en nuestro Sitio.

                    Si en algún momento se determina que alguna de las disposiciones establecidas en estos Términos y condiciones es inconsistente o inválida según las leyes aplicables, dichas disposiciones se considerarán nulas y se eliminarán de estos Términos y condiciones. Todas las demás disposiciones no se verán afectadas por la eliminación y el resto de estos Términos y condiciones seguirán considerándose válidos.

                    Detalles de contactoPóngase en contacto con nosotros si tiene alguna pregunta o inquietud. Nuestros datos de contacto son los siguientes:
                    (888) 294-2285info@besanaglobal.comLas Vegas  Nv 89128
                    Una vez que haya revisado las Políticas, y si acepta cumplirlas, haga clic en el cuadro "Acepto" que se encuentra a continuación y continúe con su solicitud para convertirse en distribuidor independiente. TENGA EN CUENTA QUE AL HACER CLIC EN "ACEPTO" INDICA QUE HA LEÍDO Y COMPRENDIDOTambién puede ponerse en contacto con nosotros a través de NUESTRO CHAT disponible en nuestro Sitio.
                    Fecha de vigencia: 1 de junio de 2023
                    ©2021 - 2023 Besana Global`;
        Swal.fire({
            title: 'Terminos y Condiciones',
            text: texto,
            // imageUrl: 'https://unsplash.it/400/200',
            // imageWidth: 400,
            // imageHeight: 200,
            // imageAlt: 'Custom image',
        })
    }
</script>