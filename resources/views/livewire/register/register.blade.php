<div class="grid grid-cols-1  ">
<div class="flex flex-col md:flex-row justify-center text-center ">
    <div class="flex justify-center p-2 text-center">
        <img src=" {{asset('img/LogoWhite.png')}}" class="-intro-x object-fit h-32 w-64 " alt="besanaglobal">

    </div>
    <div class="w-full text-center md:mt-4">
        @include('../layout/change')
    </div>
    
</div>           
 

<div class="grid grid-cols-1 md:grid-cols-2 gap-1 h-screen  overflow-y-scroll p-3 ">
    <div class="bg-slate-700 bg-opacity-70 p-4">
        
        <form method="POST" wire:submit.prevent="create" >
            @csrf
      
   
        <span class="-intro-x  text-white  font-bold uppercase text-lg ">
           {{__('personal information')}}
        
        </span>
        <div class="w-full">                         
           
            <input  id="Name"
                placeholder="{{__('Enter your name')}}"
                class="-intro-x login__input form-control py-3 " type="text" wire:model="Name" :value="old('Name')"
                required autofocus />
        </div>

        <div class="mt-2 w-full">
            <div class="flex text-xl gap-2 items-center">
                <input id="LastName" class="-intro-x login__input form-control py-3 " type="text"
                wire:model="LastName" :value="old('LastName')" required 
                    placeholder="{{__('Last Name')}}"
                />
            </div>
        </div>
        <div class=" -intro-x grid grid-cols-1 md:grid-cols-2 gap-2 mt-3"> 
                    <div class="flex flex-col">
                        <label class="text-white" for="DateBirth">
                            {{__('Birthday')}}
                        </label>
                        <input id="DateBirth" class="-intro-x  form-control py-3" type="date" wire:model="DateBirth" :value="old('DateBirth')" required /> 
                    </div>                                
                    <div class="flex flex-col md:ml-3">
                        <label class="text-white" for="SSN">
                            {{__('Enter your SSN')}}
                        </label>
                        <input id="SSN" class="-intro-x  form-control form-control py-3 "
                            type="text" wire:model="SSN" :value="old('SSN')" required
                                placeholder="{{__('Enter your SSN')}}"
                                />
                        @error('SSN') <div class="intro-x bg-red-600 p-2 rounded-lg ">
                            <span class="-intro-x bg-red-500 p-2 rounded-lg text-white">{{ $message }}</span>
                        </div>  @enderror
                    </div>
        </div>

        <span class="-intro-x mt-4 text-white p-2 font-bold uppercase text-lg ">{{__('System Data')}}:</span>    
        <div class=" -intro-x grid grid-cols-1 md:grid-cols-2 gap-2"> 
            <div class="flex flex-col">
                <label class="text-white" for="Invitedby"> {{__('Invited by')}}:</label>
                <input id="Invitedby" class="-intro-x  form-control py-3" type="text"
                wire:model="invitedby"  :value="old('invitedby')" required />
                   
            </div>                          
            <div class="flex flex-col md:ml-3">
                <label class="text-white" for="Invitedby">{{__('Username')}}:</label>
                <input id="userName" class="-intro-x  form-control py-3  " type="text" wire:model="userName" :value="old('userName')" required placeholder="{{__('Username')}}" />
                @error('userName') 
                <div class="intro-x bg-red-600 p-2 rounded-lg ">
                 <span class="-intro-x bg-red-500 p-2 rounded-lg text-white">{{ $message }}
                </span>
                </div>  
                @enderror
            </div> 
        </div>
        <div class="-intro-x grid grid-cols-1 md:grid-cols-2 gap-2">
            <div class="flex flex-col">
                <label for="Password" class="-intro-x text-white"> 
                        {{__('Password')}}
                </label>
                <input id="Password" class="-intro-x  form-control py-3" type="password" wire:model="Password" required />
                @error('Password') 
                    <div class="intro-x bg-red-600 p-2 rounded-lg ">
                        <span class="-intro-x bg-red-500 p-2 rounded-lg text-white ml-4">{{ $message }}</span>
                    </div>  
                @enderror
            </div>
            <div class="-intro-x flex flex-col md:ml-3 ">
                <label for="password_confirmation" class="-intro-x text-white"> 
                            {{__('Confirm Password')}}
                </label>
                <input id="password_confirmation" class="-intro-x  form-control py-3" type="password" wire:model="password_confirmation"  required />
                    @error('password_confirmation') 
                        <div class="intro-x bg-red-600 p-2 rounded-lg ">
                            <span class="-intro-x bg-red-500 p-2 rounded-lg text-white ml-4">{{ $message }}</span>
                        </div>  
                    @enderror
            </div>   
        </div>
    </div>
    <div class= "bg-slate-800 bg-opacity-70 p-4">
        
        <span class="-intro-x  text-white font-bold uppercase text-lg">{{__('CONTACT INFORMATION')}}:</span>  
        <div class="-intro-x grid grid-cols-1 md:grid-cols-2 gap-2">
            <div class="-intro-x flex flex-col">
                <label class="-intro-x text-white" for="Workphone"> {{__('Cell phone')}}:</label>
                <input id="Workphone" class="-intro-x  form-control py-3 " type="number" wire:model="Phone" :value="old('Workphone')" required autofocus />
            </div>
            <!-- PHONE -->
            <div class="-intro-x flex flex-col md:ml-3">
                <label class="-intro-x text-white" for="Phone"> {{__('Phone')}}:</label>
                <input id="Phone" class="-intro-x  form-control py-3" type="number" wire:model="Workphone"
                        :value="old('Phone')"  autofocus />
            </div>
        </div> 
        <div class="flex flex-col mt-3">
            <input id="Email" class="-intro-x  form-control py-3" type="Email" wire:model="Email"
                    :value="old('Email')" required autofocus placeholder={{__('Email')}} />
                    @error('Email') <div class="intro-x bg-red-600 p-2 rounded-lg ">
                        <span class="-intro-x bg-red-500 p-2 rounded-lg text-white">{{ $message }}</span>
                    </div>  @enderror
        </div>
        <div class="flex flex-col mt-3">
            <input id="confirmEmail" class="-intro-x  form-control py-3" type="email" wire:model="confirmEmail"
                    :value="old('confirmEmail')" required autofocus placeholder="{{__('Confirm Email')}}"/>
                    @error('confirmEmail') <div class="intro-x bg-red-600 p-2 rounded-lg ">
                        <span class="-intro-x bg-red-500 p-2 rounded-lg text-white">{{ $message }}</span>
                    </div>  @enderror
        </div>  
            
        <span class="-intro-x  text-white font-bold uppercase text-lg">{{__('LOCATION DATA')}}:</span>  
        <div class="w-full mt-2">
            <div class="flex flex-col">
                <label class="-intro-x text-white"  for="Address"> 
                        {{__('Address')}}:
                </label>
                <input placeholder="{{__('Address')}}" id="Address" class="-intro-x  form-control py-3" type="text" wire:model="Address" :value="old('Address')" required autofocus />
            </div>           
        </div>
        <div class="-intro-x grid grid-cols-1 md:grid-cols-2 gap-2">
            <div class="flex flex-col mt-3 md:mt-0">
                <label class="text-white" for="Country">
                    {{__('Country')}}
                </label>
                <input id="Country" class="-intro-x  form-control py-3" type="text" wire:model="Country"
                        :value="old('Country')" required autofocus />
            </div>
            <!-- State/Province -->
            <div class="flex flex-col md:ml-3">
                <label class="text-white" for="State"> {{__('State')}}:</label>
                <input id="State" class="-intro-x  form-control py-3" type="text" wire:model="State"
                        :value="old('State')" required autofocus />
            </div>
        </div>

        <div class="-intro-x grid grid-cols-1 md:grid-cols-2 gap-2">
            <div class="flex flex-col">
                <label class="text-white" for="City"> {{__('City')}}:</label>
                <div class="flex text-xl gap-2 items-center">
                    <input id="City" class="-intro-x  form-control py-3" type="text" wire:model="City"
                        :value="old('City')" required autofocus />
                </div>
            </div>
            <!-- Zip -->
            <div class="flex flex-col md:ml-3">
                <label class="text-white" for="ZipCode">{{__('ZipCode')}}:</label>
                    <input id="ZipCode" class="-intro-x  form-control py-3" type="text" wire:model="ZipCode"
                        :value="old('ZipCode')" required autofocus />

            </div>
        </div>
        <div class="w-full p-3">
            <input type="checkbox" class="-intro-x bg-white " style=" input:checked {
                background-color:green;
            }" wire:model="terminos">
            <span class="text-white">{{__('Accept to')}} <button onclick="terminos()">{{__('Terms and Conditions')}}</button> </span>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <button 
                @if ($terminos==false)
                    disabled
                @else 
                @endif
            class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top" wire:click="create()">
               {{__('Register')}}
            </button>
            <a class="intro-x login__input underline text-sm text-white hover:text-gray-900 mr-3" href="{{ route('login') }}">
                Ya estas registrado?
            </a>
        </div>
         </form>

    </div>
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
            // Swal.fire('', event.detail.msg)
            // if (event.detail.action == 'close-modal') fireModal(0)
                Swal.fire(
                'Good job!',
                event.detail.msg,
                'success'
                ).then(result => {
                    if(result.isConfirmed){
                        window.location = '/login'
                    }
                }
                    
                )
            
        })
        
        function terminos(){
            const texto=`POLITICAS Y PROCEDIMIENTOS.
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
        // window.onload = () => {
        // const myInput = document.getElementById('confirmEmail');
        // myInput.onpaste = e => e.preventDefault();
        // }
        
    </script>
  </div>
</div>

    
   
               
                
    

        
        
     
               
              