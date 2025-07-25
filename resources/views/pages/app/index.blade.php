 @extends('layouts.app')

 @section('content')
     <header class="masthead">
         <div class="container">
             <div class="masthead-subheading" id="masthead-title">Welcome To Our Studio!</div>
             <div class="masthead-heading text-uppercase" id="masthead-subtitle">It's Nice To Meet You</div>
             <a class="btn btn-primary btn-xl text-uppercase" href="#services">Tell Me More</a>
         </div>
     </header>
     <!-- Services-->
     <section class="page-section" id="services">
         <div class="container">
             <div class="text-center" style="magin-bottom:5px;">
                 <h2 class="section-heading text-uppercase">Services</h2>
                 <h2 class="section-heading text-uppercase"> </h2>
             </div>
             {{-- content services --}}
             <div id="services_content" class="row text-center">
             </div>
         </div>
     </section>
     <!-- Portfolio Grid-->
     <section class="page-section bg-light" id="portfolio">
         <div class="container">
             <div class="text-center">
                 <h2 class="section-heading text-uppercase">Portfolio</h2>
                 <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
             </div>
             {{-- content portfolio --}}
             <div class="row" id="portofolio_content">
             </div>
         </div>
     </section>
     <!-- About-->
     <section class="page-section" id="about">
         <div class="container">
             <div class="text-center">
                 <h2 class="section-heading text-uppercase">About</h2>
                 <h3 class="section-subheading text-muted"> </h3>
             </div>
             <ul id="about_content" class="timeline">

             </ul>
         </div>
     </section>
     <!-- Team-->
     <section class="page-section bg-light" id="team">
         <div class="container">
             <div class="text-center">
                 <h2 class="section-heading text-uppercase">Our Amazing Team</h2>
                 <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
             </div>
             <div class="row">
                 <div class="col-lg-4">
                     <div class="team-member">
                         <img class="mx-auto rounded-circle" src="{{ asset('template_fe/assets/img/team/1.jpg') }}"
                             alt="..." />
                         <h4>Parveen Anand</h4>
                         <p class="text-muted">Lead Designer</p>
                         <a class="btn btn-dark btn-social mx-2" href="#!"
                             aria-label="Parveen Anand Twitter Profile"><i class="fab fa-twitter"></i></a>
                         <a class="btn btn-dark btn-social mx-2" href="#!"
                             aria-label="Parveen Anand Facebook Profile"><i class="fab fa-facebook-f"></i></a>
                         <a class="btn btn-dark btn-social mx-2" href="#!"
                             aria-label="Parveen Anand LinkedIn Profile"><i class="fab fa-linkedin-in"></i></a>
                     </div>
                 </div>
                 <div class="col-lg-4">
                     <div class="team-member">
                         <img class="mx-auto rounded-circle" src="{{ asset('template_fe/assets/img/team/2.jpg') }}"
                             alt="..." />
                         <h4>Diana Petersen</h4>
                         <p class="text-muted">Lead Marketer</p>
                         <a class="btn btn-dark btn-social mx-2" href="#!"
                             aria-label="Diana Petersen Twitter Profile"><i class="fab fa-twitter"></i></a>
                         <a class="btn btn-dark btn-social mx-2" href="#!"
                             aria-label="Diana Petersen Facebook Profile"><i class="fab fa-facebook-f"></i></a>
                         <a class="btn btn-dark btn-social mx-2" href="#!"
                             aria-label="Diana Petersen LinkedIn Profile"><i class="fab fa-linkedin-in"></i></a>
                     </div>
                 </div>
                 <div class="col-lg-4">
                     <div class="team-member">
                         <img class="mx-auto rounded-circle" src="{{ asset('template_fe/assets/img/team/3.jpg') }}"
                             alt="..." />
                         <h4>Larry Parker</h4>
                         <p class="text-muted">Lead Developer</p>
                         <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Larry Parker Twitter Profile"><i
                                 class="fab fa-twitter"></i></a>
                         <a class="btn btn-dark btn-social mx-2" href="#!"
                             aria-label="Larry Parker Facebook Profile"><i class="fab fa-facebook-f"></i></a>
                         <a class="btn btn-dark btn-social mx-2" href="#!"
                             aria-label="Larry Parker LinkedIn Profile"><i class="fab fa-linkedin-in"></i></a>
                     </div>
                 </div>
             </div>
             <div class="row">
                 <div class="col-lg-8 mx-auto text-center">
                     <p class="large text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut eaque,
                         laboriosam veritatis, quos non quis ad perspiciatis, totam corporis ea, alias ut unde.</p>
                 </div>
             </div>
         </div>
     </section>
     <!-- Clients-->
     <div class="py-5">
         <div class="container">
             <div class="row align-items-center">
                 <div class="col-md-3 col-sm-6 my-3">
                     <a href="#!"><img class="img-fluid img-brand d-block mx-auto"
                             src="{{ asset('template_fe/assets/img/logos/microsoft.svg') }}" alt="..."
                             aria-label="Microsoft Logo" /></a>
                 </div>
                 <div class="col-md-3 col-sm-6 my-3">
                     <a href="#!"><img class="img-fluid img-brand d-block mx-auto"
                             src="{{ asset('template_fe/assets/img/logos/google.svg') }}" alt="..."
                             aria-label="Google Logo" /></a>
                 </div>
                 <div class="col-md-3 col-sm-6 my-3">
                     <a href="#!"><img class="img-fluid img-brand d-block mx-auto"
                             src="{{ asset('template_fe/assets/img/logos/facebook.svg') }}" alt="..."
                             aria-label="Facebook Logo" /></a>
                 </div>
                 <div class="col-md-3 col-sm-6 my-3">
                     <a href="#!"><img class="img-fluid img-brand d-block mx-auto"
                             src="{{ asset('template_fe/assets/img/logos/ibm.svg') }}" alt="..."
                             aria-label="IBM Logo" /></a>
                 </div>
             </div>
         </div>
     </div>
     <!-- Contact-->
     <section class="page-section" id="contact">
         <div class="container">
             <div class="text-center">
                 <h2 class="section-heading text-uppercase">Contact Us</h2>
                 <h3 class="section-subheading text-muted"></h3>
             </div>
             <form id="contactForm" enctype="multipart/form-data">
                 @csrf
                 <div class="row align-items-stretch mb-5">
                     <div class="col-md-6">
                         <div class="form-group">
                             <!-- Name input-->
                             <input class="form-control" id="name" name="name" type="text"
                                 placeholder="Your Name *" required />
                         </div>
                         <div class="form-group">
                             <!-- Email address input-->
                             <input class="form-control" id="email" name="email" type="email"
                                 placeholder="Your Email *" required />
                         </div>
                         <div class="form-group mb-md-0">
                             <!-- Phone number input-->
                             <div class=" row mt-1">
                                 <div class="col-sm-2">
                                     <input type="text" class="form-control" value="+62" readonly disabled>
                                 </div>
                                 <div class="col-sm-10">
                                     <input class="form-control" id="phone" name="phone" type="tel"
                                         placeholder="Your Phone *" required />

                                 </div>
                             </div>

                         </div>
                     </div>
                     <div class="col-md-6">
                         <div class="form-group form-group-textarea mb-md-0">
                             <!-- Message input-->
                             <textarea class="form-control" id="message" name="message" placeholder="Your Message *"
                                 data-sb-validations="required"></textarea>
                             <div class="invalid-feedback" required>A message is required.
                             </div>
                         </div>
                     </div>
                 </div>
                 <!-- Submit Button-->
                 <div class="text-center"><button class="btn btn-primary btn-xl text-uppercase " id="submitButton"
                         type="button">Send Message</button></div>
             </form>
         </div>
     </section>

     <!-- Portfolio item 1 modal popup-->
     <div class="portfolio-modal modal fade" id="portfolioModal" tabindex="-1" role="dialog" aria-hidden="true">
         <div class="modal-dialog">
             <div class="modal-content">
                 <div class="close-modal" data-bs-dismiss="modal"><img
                         src="{{ asset('template_fe/assets/img/close-icon.svg') }}" alt="Close modal" /></div>
                 <div class="container">
                     <div class="row justify-content-center">
                         <div class="col-lg-8">
                             <div class="modal-body">
                                 <!-- Project details-->
                                 <h2 id="portfolio_title" class="text-uppercase">Project Name</h2>
                                 <p class="item-intro text-muted"> </p>
                                 <img class="img-fluid d-block mx-auto" id="portfolio_img"
                                     src="{{ asset('template_fe/assets/img/portfolio/1.jpg') }}" alt="..." />
                                 <p id="portfolio_des">Use this area to describe your project. Lorem ipsum dolor sit amet,
                                     consectetur
                                     adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt
                                     repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae,
                                     nostrum, reiciendis facere nemo!</p>
                                 <ul class="list-inline">
                                     <li>
                                         <strong>Client:</strong>
                                         <span id="portfolio_client"></span>
                                         Threads
                                     </li>
                                     <li>
                                         <strong>Category:</strong>
                                         <span id="portfolio_category"></span>
                                         Illustration
                                     </li>
                                 </ul>
                                 <button class="btn btn-primary btn-xl text-uppercase" data-bs-dismiss="modal"
                                     type="button">
                                     <i class="fas fa-xmark me-1"></i>
                                     Close Project
                                 </button>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 @endsection
 @section('script')
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
     <script src="{{ asset('template_admin/vendor/jquery/jquery.min.js') }}"></script>
     <script src="{{ asset('template_admin/js/demo/datatables-demo.js') }}"></script>
     <script>
         $('document').ready(function(e) {
             $.ajax({
                 url: "{{ route('public.data') }}", // URL endpoint untuk controller 
                 method: 'GET',
                 beforeSend: function() {
                     $('.loader-overlay').css('display', 'flex');
                 },
                 success: function(response) {
                     console.log(response); // Tambahan: cek di browser console

                     //  untukmenampilkan data ke frontend 
                     let masterhead = response.master_head;
                     let services = response.service;
                     let portofolio = response.portofolio;
                     let about = response.about;
                     if (masterhead) {
                         $('#masthead-title').text(masterhead.title);
                         $('#masthead-subtitle').text(masterhead.subtitle);
                         $('.masthead').css({
                             'background-image': `url("/storage/${masterhead.image}")`
                         });
                     }

                     //menampikan service  
                     if (services && services.length > 0) {
                         $('#services_content').empty();
                         services.forEach(function(service) {
                             let serviceItem = `
                                <div class="col-md-4">
                                    <img src="/storage/${service.image}" alt="" class="rounded" height="130px">
                                    <h4 class="my-3">${service.title}</h4>
                                    <p class="text-muted">${service.description}</p>
                                </div>
                            `;
                             $('#services_content').append(serviceItem);
                         });
                     }

                     //menampikan portfolio  
                     if (portofolio && portofolio.length > 0) {
                         $('#portofolio_content').empty();
                         portofolio.forEach(function(portfolio) {
                             let portoItem = `
                                <div class="col-lg-4 col-sm-6 mb-4">
                                    <!-- Portfolio item 1-->
                                    <div class="portfolio-item">
                                        <a class="portfolio-link" data-slug="${portfolio.slug}" data-bs-toggle="modal" href="#portfolioModal1">
                                            <div class="portfolio-hover">
                                                <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                            </div>
                                            <img class="img-fluid" src="/storage/${portfolio.image}" alt="${portfolio.client}" />
                                        </a>
                                        <div class="portfolio-caption">
                                            <div class="portfolio-caption-heading">${portfolio.client}</div>
                                            <div class="portfolio-caption-subheading text-muted">${portfolio.category?.name ?? 'Tanpa Kategori'}</div>
                                        </div>
                                    </div>
                                </div>
                            `;
                             $('#portofolio_content').append(portoItem);
                         });
                     }

                     //  //menampikan about
                     if (about && about.length > 0) {
                         $('#about_content').empty();
                         let aboutItem = '';
                         about.forEach(function(item, index) {
                             // sintak class
                             let invertedClass = (index % 2 != 0) ? 'timeline-inverted' : '';
                             aboutItem += `
                               <li class="${invertedClass}">
                                    <div class="timeline-image"><img class="rounded-circle img-fluid"
                                           src="/storage/${item.image}" alt="..." width="200px" height="200px" /></div> 
                                    <div class="timeline-panel">
                                        <div class="timeline-heading">
                                            <h4>${item.year}</h4>
                                            <h4 class="subheading">${item.title}</h4>
                                        </div>
                                        <div class="timeline-body">
                                            <p class="text-muted">${item.description}</p>
                                        </div>
                                    </div>
                                </li>
                            `;

                         });
                         aboutItem += `
                            <li class="timeline-inverted">
                                <div class="timeline-image">
                                    <h4>
                                        Be Part
                                        <br />
                                        Of Our
                                        <br />
                                        Story!
                                    </h4>
                                </div>
                            </li>
                         `;
                         $('#about_content').append(aboutItem);
                     }
                 },
                 complete: function() {
                     $('.loader-overlay').css('display', 'none');
                 },
             });

             //  modal detail portfolio
             $(document).on('click', '.portfolio-link', function(e) {
                 e.preventDefault();
                 let slug = $(this).data('slug');
                 $.ajax({
                     url: "{{ route('detail') }}?slug=" + slug,
                     type: "GET",
                     data: {
                         "_token": "{{ csrf_token() }}",
                     },
                     dataType: "JSON",
                     cache: "false",
                     beforeSend: function() {
                         $('.loader-overlay').css('display', 'flex');
                     },
                     success: function(data) {
                         if (data.success === 1) {
                             let portofolio = data.data;
                             let title = portofolio.title;
                             let des = portofolio.des;
                             let client = portofolio.client;
                             let categoryName = portofolio.category?.name ?? 'Tanpa Kategori';
                             let image = portofolio.image;
                             $('#portfolio_title').empty().text(title);
                             $('#portfolio_img').attr('src', "{{ asset('storage') }}/" + image)
                                 .height(450);
                             $('#portfolio_des').empty().text(des);
                             $('#portfolio_client').empty().text(client);
                             $('#portfolio_category').empty().text(categoryName);
                             $('#portfolioModal').modal('show');
                         } else {
                             toastr_error(data.message);
                         }
                     },
                     complete: function(response) {
                         $('.loader-overlay').css('display', 'none');
                     }
                 })
             });

             // button send message contact
             $("#submitButton").on('click', function() {
                 let postData = new FormData($("#contactForm")[0]);
                 $.ajax({
                     url: "{{ route('send.contact') }}",
                     data: postData,
                     type: "POST",
                     cache: false,
                     contentType: false,
                     processData: false,
                     beforeSend: function() {
                         $('.loader-overlay').css('display', 'flex');
                     },
                     success: function(data) {
                         if (data.success == 1) {
                             $("#contactForm")[0].reset();
                             toastr_success(data.messages)
                         } else {
                             toastr_error(data.messages)
                         }
                     },
                     complete: function(response) {
                         $('.loader-overlay').css('display', 'none');
                     },

                 });
             });

             //  toaster
             function toastr_success(msg) {
                 const Toast = Swal.mixin({
                     toast: true,
                     position: "top-end",
                     showConfirmButton: false,
                     timer: 3000,
                     timerProgressBar: true,
                     didOpen: (toast) => {
                         toast.onmouseenter = Swal.stopTimer;
                         toast.onmouseleave = Swal.resumeTimer;
                     }
                 });
                 Toast.fire({
                     icon: "success",
                     title: msg
                 });
             }

             function toastr_error(msg) {
                 const Toast = Swal.mixin({
                     toast: true,
                     position: "top-end",
                     showConfirmButton: false,
                     timer: 3000,
                     timerProgressBar: true,
                     didOpen: (toast) => {
                         toast.onmouseenter = Swal.stopTimer;
                         toast.onmouseleave = Swal.resumeTimer;
                     }
                 });
                 Toast.fire({
                     icon: "error",
                     title: msg
                 });
             }
         });
     </script>
 @endsection
