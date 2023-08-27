@extends('../layout/side-menu')

@section('subcontent')
<style>
    #tree{
    width:100%;
    height:100%;
    background-color: #535050
  }
  
  .chart-menu {
    border-width: 10px !important; 
    border-color: #aeaeae !important; 
    border: 1px solid #aeaeae !important
  }
  
  [data-item] {
    border-width: 0px !important; 
    padding: 20px !important;
  }
  
  [data-tlbr] {
    margin: 20px !important;
  }
  
  [data-tlbr="layout"] {
      transform: rotate(0deg) translateX(0px) translateY(0px) !important;
  }
  
  .shadow {
    -webkit-filter: drop-shadow( 3px 3px 2px rgba(0, 0, 0, .25));
    filter: drop-shadow( 3px 3px 2px rgba(0, 0, 0, .25));
  }
</style>
<div >
 

    <div data-tree="{{$data}}" id="tree" class="partner_tree object-cover" style="height: max-content"></div>
  
</div>


<script src="{{asset('js/balkan/orgchart.js')}}" ></script>


<script src="{{asset('js/balkan/prueba.js')}}" ></script>


@endsection
