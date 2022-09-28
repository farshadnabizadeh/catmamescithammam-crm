   <div class="col-xl-4 col-md-4">
      <a href="{{ route('treatmentplan.requested') }}">
         <div class="info-box mt-3 {{ request()->is('treatmentplans/requested') ? 'info-box bg-danger text-white' : 'info-box' }}">
            <span class="info-box-icon bg-danger"><i class="fa fa-clock-o"></i></span>
            <div class="info-box-content"><span class="info-box-text {{ request()->is('treatmentplans/requested') ? 'text-white' : '' }}">Requested Treatment Plans List <br>{{ $requested_count }}</span></div>
         </div>
      </a>
   </div>
   <div class="col-xl-4 col-md-4">
      <a href="{{ route('treatmentplan.reconsult') }}">
         <div class="info-box mt-3 {{ request()->is('treatmentplans/reconsult') ? 'info-box bg-orange text-white' : 'info-box' }}">
            <span class="info-box-icon bg-orange"><i class="fa fa-arrows-h"></i></span>
            <div class="info-box-content"><span class="info-box-text {{ request()->is('treatmentplans/reconsult') ? 'text-white' : '' }}">Re Consult Requests <br>{{ $reconsult_count }}</span></div>
         </div>
      </a>
   </div>
   <div class="col-xl-4 col-md-4">
      <a href="{{ route('treatmentplan.completed') }}">
         <div class="info-box mt-3 {{ request()->is('treatmentplans/completed') ? 'info-box bg-success text-white' : 'info-box' }}">
            <span class="info-box-icon bg-success"><i class="fa fa-check"></i></span>
            <div class="info-box-content"><span class="info-box-text {{ request()->is('treatmentplans/completed') ? 'text-white' : '' }}">Completed Treatment Plans List <br>{{ $completed_count }}</span></div>
         </div>
      </a>
   </div>