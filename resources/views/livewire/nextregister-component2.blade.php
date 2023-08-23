<div class=" max-sm:m-0 bg-white max-md:p-0 max-md:ml-2 p-5  h-screen w-full md:bg-imgfondo bg-no-repeat bg-cover bg-right " 
>
  <div class="flex flex-col z-10 max-sm:px-4 ">
    <div class="titulos flex flex-col justify-center items-center md:w-3/4 xl:w-3/4 h-32 gap-2 mt-4 max-sm:mt-4 max-md:mt-4"> 
     
      <h1 class="  max-md:text-xl text-5xl text-black uppercase">SIMPLE PRICING</h1>
        <h2 class="max-sm:text-lg max-md:text-6xl max-md:text-2xl text-6xl text-black uppercase font-black">Select your subscription</h2>
    </div>
    {{-- IMAGEN PARA CELULAR --}}
    <div class="cel-imagen ">
      <img class="sm:hidden sm:object-fill" src="{{asset('img/paquetes/dospersonas.png')}}" alt="">
    </div>
    <div class="imgenes max-sm:w-full max-xl:w-full w-full  mt-5 pr-10">
      <div class="cardsfull max-sm:m-0 max-sm:p-2 flex max-md:flex-col  gap-2 w-full max-md:ml-2  ml-5 ">
        
        {{-- MEMBERSHIP --}}
        <div class="max-w-sm:w-4/5 bg-gray-100 rounded-xl overflow-hidden shadow-2xl w-full md:w-1/5">
          <img class="w-full" src="{{asset('img/paquetes/sucription.png')}}" alt="Sunset in the mountains">
          <div class="flex flex-col justify-center items-center mt-4">
            <div class="font-bold text-xl ">PROMOTER</div>
            <div class="font-bold text-xl ">PARTNER</div>
            <div class="font-bold text-xl ">MEMBERSHIP</div>
          </div>
          <div class="flex flex-col justify-center items-center">
            <span class=" text-sm font-semibold text-gray-700 ">Online store for 1 year</span>
            <span class=" text-sm font-semibold text-gray-700 ">24 hour acces to your virtual office</span>
            <span class=" text-sm font-semibold text-gray-700 ">35% profit on all your sales</span>
            <span class=" text-sm font-semibold text-gray-700 ">15% discount on all personal purchases</span>
            <span class=" text-sm font-semibold text-gray-700 ">1 Serum Treatment</span>
            <span class=" text-sm font-black text-gray-700 ">Membership for 1 year</span>
            <span class=" text-4xl font-black text-besana mt-2 ">$24.95</span>
            <span class=" text-sm font-black text-gray-700 ">Plus shipping + tax</span>
          </div>
          <div class="flex flex-col justify-center items-center my-4">
            <button class="bg-besana h-16 w-16  rounded-full p-3 flex items-center justify-center" onclick="addcartjs(1,'MEMBERSHIP',24.95,1,{{$cantidadProductos}},0)" >
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-white">
                <path d="M2.25 2.25a.75.75 0 000 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 00-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 000-1.5H5.378A2.25 2.25 0 017.5 15h11.218a.75.75 0 00.674-.421 60.358 60.358 0 002.96-7.228.75.75 0 00-.525-.965A60.864 60.864 0 005.68 4.509l-.232-.867A1.875 1.875 0 003.636 2.25H2.25zM3.75 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM16.5 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z" />
              </svg>  
            </button>
          </div>
        </div>
        {{-- BESANA BEAUTY --}}
        <div class="max-w-sm:block bg-gray-100 rounded-xl overflow-hidden shadow-2xl w-full md:w-1/5">
          <img class="w-full" src="{{asset('img/paquetes/package2.png')}}" alt="Sunset in the mountains">
          <div class="flex flex-col justify-center items-center mb-7 mt-4">
            <div class="font-bold text-xl ">BESANA</div>
            <div class="font-bold text-xl ">PACKAGE</div>
          </div>
          <div class="flex flex-col justify-center items-center">
            <span class=" text-sm font-semibold text-gray-700 ">1 Day Cream</span>
            <span class=" text-sm font-semibold text-gray-700 ">1 Night Cream</span>
            <span class=" text-sm font-semibold text-gray-700 ">1 Facial Cleanser</span>
            <span class=" text-sm font-semibold text-gray-700 ">1 Eye Cream</span>
            <span class=" text-sm font-semibold text-gray-700 ">1 Serum Treatment</span>
            <span class=" text-sm font-black text-gray-700 ">Membership for 1 year</span>
            <span class=" text-4xl font-black text-besana mt-2 ">$214.90</span>
            <span class=" text-sm font-black text-gray-700 ">Plus shipping + tax</span>
          </div>
          <div class="flex flex-col justify-center items-center my-4" >
            <button class="bg-besana h-16 w-16  rounded-full p-3 flex items-center justify-center"  onclick="addcartjs(2,'BESANA PACKAGE',214.90,2,{{$cantidadProductos}},190)" >
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-white">
                <path d="M2.25 2.25a.75.75 0 000 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 00-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 000-1.5H5.378A2.25 2.25 0 017.5 15h11.218a.75.75 0 00.674-.421 60.358 60.358 0 002.96-7.228.75.75 0 00-.525-.965A60.864 60.864 0 005.68 4.509l-.232-.867A1.875 1.875 0 003.636 2.25H2.25zM3.75 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM16.5 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z" />
              </svg>
            </button>
          </div>
        </div>
        {{-- CBG/5 --}}
        <div class="max-w-sm:block bg-gray-100 rounded-xl overflow-hidden shadow-2xl w-full md:w-1/5">
          <img class="w-full" src="{{asset('img/paquetes/package5.png')}}" alt="Sunset in the mountains">
          <div class="flex flex-col justify-center items-center mb-12">
            <div class="font-bold text-xl mt-4">CBG/5</div>
          </div>
          <div class="flex flex-col justify-center items-center mt-5">
            <span class=" text-sm font-semibold text-gray-700 ">30 ML. Hemp oil</span>
            <span class=" text-sm font-semibold text-gray-700 ">CBD 17 MG</span>
            <span class=" text-sm font-semibold text-gray-700 ">CBG 27 MG</span>
            <span class=" text-sm font-semibold text-gray-700 ">CBN 3.3 MG</span>
            <span class=" text-sm font-semibold text-gray-700 ">CBC 3.3 MG</span>
            <span class=" text-sm font-black text-gray-700 ">Membership for 1 year</span>
            <span class=" text-4xl font-black text-besana mt-2 ">$124.90</span>
            <span class=" text-sm font-black text-gray-700 ">Plus shipping + tax</span>
          </div>
          <div class="flex flex-col justify-center items-center my-4">
            <button class="bg-besana h-16 w-16  rounded-full p-3 flex items-center justify-center" onclick="addcartjs(3,'CBG/5',124.90,2,{{$cantidadProductos}},100)" >
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-white">
                <path d="M2.25 2.25a.75.75 0 000 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 00-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 000-1.5H5.378A2.25 2.25 0 017.5 15h11.218a.75.75 0 00.674-.421 60.358 60.358 0 002.96-7.228.75.75 0 00-.525-.965A60.864 60.864 0 005.68 4.509l-.232-.867A1.875 1.875 0 003.636 2.25H2.25zM3.75 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM16.5 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z" />
              </svg>
            </button>
          </div>
        </div>
        {{-- B-MAX --}}

        <div class="max-w-sm:block bg-gray-100 rounded-xl overflow-hidden shadow-2xl w-full md:w-1/5 z-20">
          <img class="w-full" src="{{asset('img/paquetes/package3.png')}}" alt="Sunset in the mountains">
          <div class="flex flex-col justify-center items-center mt-4 ">
            <div class="font-bold text-xl ">B-MAX</div>
            
          </div>
          <div class="flex flex-col justify-center items-center mt-12">
            <span class=" text-sm font-semibold text-gray-700 ">60 Veggie Capsules</span>
            <span class=" text-sm font-semibold text-gray-700 ">Libido </span>
            <span class=" text-sm font-semibold text-gray-700 ">Energy</span>
            <span class=" text-sm font-semibold text-gray-700 mb-4">Stamina</span>
           
            <span class=" text-sm font-black text-gray-700 ">Membership for 1 year</span>
            <span class=" text-4xl font-black text-besana mt-2 ">$94.90</span>
            <span class=" text-sm font-black text-gray-700 ">Plus shipping + tax</span>
          </div>
          <div class="flex flex-col justify-center items-center my-4">
            <button class="bg-besana h-16 w-16  rounded-full p-3 flex items-center justify-center" onclick="addcartjs(4,'B-MAX',94.90,2,{{$cantidadProductos}},70)" >
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-white">
                <path d="M2.25 2.25a.75.75 0 000 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 00-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 000-1.5H5.378A2.25 2.25 0 017.5 15h11.218a.75.75 0 00.674-.421 60.358 60.358 0 002.96-7.228.75.75 0 00-.525-.965A60.864 60.864 0 005.68 4.509l-.232-.867A1.875 1.875 0 003.636 2.25H2.25zM3.75 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM16.5 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z" />
              </svg>   
            </button>
          </div>
        </div>
        {{-- COMPLETE PACKAGE --}}

        <div class="max-w-sm:block bg-gray-100 rounded-xl overflow-hidden shadow-2xl w-full md:w-1/5 z-20">
          <img class="w-full" src="{{asset('img/paquetes/package4.png')}}" alt="Sunset in the mountains">
          <div class="flex flex-col justify-center items-center mt-4">
            <div class="font-bold text-xl ">COMPLETE</div>
            <div class="font-bold text-xl ">PACKAGE</div>
            
          </div>
          <div class="flex flex-col justify-center items-center mt-7">
            <span class=" text-sm font-semibold text-gray-700 ">Online store for 1 year</span>
            <span class=" text-sm font-semibold text-gray-700 ">24 hour acces to your virtual office</span>
            <span class=" text-sm font-semibold text-gray-700 ">35% profit on all your sales</span>
            <span class=" text-sm font-semibold text-gray-700 ">15% discount on all personal purchases</span>
            <span class=" text-sm font-semibold text-gray-700 ">1 Serum Treatment</span>
            <span class=" text-sm font-black text-gray-700 ">Membership for 1 year</span>
            <span class=" text-4xl font-black text-besana mt-2 ">$355.90</span>
            <span class=" text-sm font-black text-gray-700 ">Plus shipping + tax</span>
          </div>
          <div class="flex flex-col justify-center items-center my-4">
            <button class="bg-besana h-16 w-16  rounded-full p-3 flex items-center justify-center" onclick="addcartjs(5,'COMPLETE PACKAGE',355.90,3,{{$cantidadProductos}},330)" >
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-white">
                <path d="M2.25 2.25a.75.75 0 000 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 00-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 000-1.5H5.378A2.25 2.25 0 017.5 15h11.218a.75.75 0 00.674-.421 60.358 60.358 0 002.96-7.228.75.75 0 00-.525-.965A60.864 60.864 0 005.68 4.509l-.232-.867A1.875 1.875 0 003.636 2.25H2.25zM3.75 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM16.5 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z" />
              </svg>  
            </button>
          </div>
        </div>

      </div>
    </div>
    <div class="personas w-full max-md:hidden">
      <img class="absolute max-sm:hidden  xl:-right-40 md:-right-40 bottom-1 z-0 w-2/5" src="{{ asset('img/paquetes/dospersonas.png')}}" alt="">
    </div>
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
        Swal.fire('', event.detail.msg)
        if (event.detail.action == 'close-modal') fireModal(0)
    })
  
  
    
    function addcartjs(id,paquete,price,onzas,cantidad,puntos) {
      if (cantidad>=1) {
        Swal.fire('', 'Ya existe un paquete Seleccionado')
        if (event.detail.action == 'close-modal') fireModal(0)
        window.location.href = "{{ route('cart-pay')}}";
        return;
        sleep(1000)
      }
        Swal.fire({
            title: 'CONFIRM',
            text: "¿Add Package: "+paquete,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Accept'
        }).then((result) => {
          console.log('puntos: '+puntos)
            if (result.isConfirmed) {
                 Swal.fire(paquete, 'Your package is added.', 'success')
                window.livewire.emit('addCart',id,paquete,price,onzas,cantidad,puntos) // 1,2 ,3
               
            }
        })
    }
    
  </script>
</div>
