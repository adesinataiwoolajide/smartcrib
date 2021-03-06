<?php $body ="inner-pages"?>
@extends("design.header")
    
    @section("content")
    <section class="headings">
        <div class="text-heading text-center">
            <div class="container">
                <h1>Our Agents</h1>
                <h2><a href="{{route('index')}}">Home </a> &nbsp;/&nbsp; Our Agents </h2>
            </div>
        </div>
    </section>
    <!-- END SECTION HEADINGS -->
    
    <!-- START SECTION AGENTS -->
    <section class="team">
        <div class="container">
            <div class="section-title col-md-5">
                <h3>Meet Our</h3>
                <h2>Agents</h2>
            </div>
            @include('message');
            <div class="row team-all padding">
                @foreach($agent as $seeAgent)
                    <div class="col-lg-3 col-md-6 team-pro hover-effect" style="margin-bottom:20px">
                        <div class="team-wrap">
                            <div class="team-img">
                                <img src="{{asset('agent-logo/'.$seeAgent->agent_image)}}" style="height:270px; width:260px" alt="" />
                            </div>
                            <div class="team-content">
                                <div class="team-info">
                                    <h3>{{$seeAgent->agent_name}}</h3>
                                    <p>{{$seeAgent->category}}</p>
                                    <div class="team-socials">
                                        <ul>
                                            <li>
                                                <a href="#" title="facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                                <a href="#" title="twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                                <a href="#" title="instagran"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <span><a href="{{route('see-agent-property', $seeAgent->email)}}">View Properties</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <nav aria-label="..." class="mt-5 pagi">
                <ul class="pagination">
                    {{-- <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1">Previous</a>
                    </li>
                    <li class="page-item active">
                        <a class="page-link" href="#">1 <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">5</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li> --}}
                    {{$agent->links()}}
                </ul>
            </nav>
            
        </div>
    </section>
    <!-- END SECTION AGENTS -->
    @endsection