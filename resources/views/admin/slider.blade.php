@extends('admin.layout.layout')
@section('title','Slider')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Slider Page</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Slider</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Slider</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body">

          <div class="pswp-gallery" id="my-gallery">
            <p><a
              href="https://cdn.photoswipe.com/photoswipe-demo-images/photos/1/img-2500.jpg"
              data-pswp-width="1875"
              data-pswp-height="2500"
              target="_blank"
            >
              <img
                src="https://cdn.photoswipe.com/photoswipe-demo-images/photos/1/img-200.jpg"
                alt=""
              />
            </a></p>
            <p><a
              href="https://cdn.photoswipe.com/photoswipe-demo-images/photos/2/img-2500.jpg"
              data-pswp-width="1669"
              data-pswp-height="2500"
              target="_blank"
            >
              <img
                src="https://cdn.photoswipe.com/photoswipe-demo-images/photos/2/img-200.jpg"
                alt=""
              />
            </a></p>
           <p> <a
              href="https://cdn.photoswipe.com/photoswipe-demo-images/photos/3/img-2500.jpg"
              data-pswp-width="2500"
              data-pswp-height="1666"
              target="_blank"
            >
              <img
                src="https://cdn.photoswipe.com/photoswipe-demo-images/photos/3/img-200.jpg"
                alt=""
              />
            </a></p>
          </div>


        </div>
      </div>
    </section>
  </div>
  @endsection