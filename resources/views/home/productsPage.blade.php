@include('home.css')

<body>

    @include('sweetalert::alert')

    @include('home.header')
    <section class="inner_page_head">
             <div class="container_fuild">
                <div class="row">
                   <div class="col-md-12">
                      <div class="full">
                         <h3>Product Grid</h3>
                      </div>
                   </div>
                </div>
             </div>
          </section>


    @include('home.product')
    @include('home.footer')
    @include('home.script')
</body>
