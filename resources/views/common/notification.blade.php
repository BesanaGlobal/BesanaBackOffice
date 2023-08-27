@if(Session::has('notification'))
<div class="bg-blue-100 border border-blue-800 text-white-200 px-4 py-3 rounded relative" role="alert">
    <strong class="font-bold">It´s great!</strong>
    <span class="block sm:inline px-2"> {{Session::get('notification')}}
    </span>
    <span class="absolute top-0 bottom-0 right-0 px-5 py-3">
      <svg id="btnCloseId" class="fill-current h-6 w-6 text-white-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
    </span>
  </div>

<script>
  const $btnClose = document.getElementById('btnCloseId')

  $btnClose.addEventListener('click',(e)=>{
    e.path[3].classList.add('hidden')
    console.log(e)
  })
</script>
@endif

